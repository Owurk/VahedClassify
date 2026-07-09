# ==============================================================================
# IMPORTANT: this script must be run inside google colab
# standard python does not allow top-level "await" statements, but colab does
# do not run this file locally using "python script.py" or it will throw a syntax error
# 
# steps to run:
# 1. upload this file to google colab
# 2. fill in your API_ID and API_HASH below
# 3. run the script (runtime -> run all)
# 4. a prompt will appear to authenticate with your telegram account
# ==============================================================================

import subprocess
import sys

# install dependencies silently
subprocess.run([sys.executable, "-m", "pip", "install", "-q", "telethon", "nest_asyncio", "tqdm"], stdout=subprocess.DEVNULL)

from google.colab import drive
drive.mount('/content/drive', force_remount=True)

import asyncio, json, os, sqlite3
import nest_asyncio
from telethon import TelegramClient
from telethon.errors import FloodWaitError
from tqdm.auto import tqdm

nest_asyncio.apply()

API_ID   =              # <-- your api_id
API_HASH = ""     # <-- your api_hash

# on drive so they survive runtime resets
SESSION = "/content/drive/MyDrive/tg_crawler/session"
DB_PATH = "/content/drive/MyDrive/tg_crawler/telegram_crawl.db"
os.makedirs(os.path.dirname(DB_PATH), exist_ok=True)

def db_connect():
    conn = sqlite3.connect(DB_PATH)
    conn.execute("""CREATE TABLE IF NOT EXISTS messages(
        channel TEXT, id INTEGER, date TEXT, text TEXT,
        is_forward INTEGER, fwd_from TEXT, has_media INTEGER,
        PRIMARY KEY(channel, id))""")
    conn.execute("CREATE TABLE IF NOT EXISTS meta(key TEXT PRIMARY KEY, value TEXT)")
    conn.commit()
    return conn

def get_last_id(conn, channel):
    r = conn.execute("SELECT value FROM meta WHERE key=?",
                     (f"last_id:{channel}",)).fetchone()
    return int(r[0]) if r else 0

def set_last_id(conn, channel, last_id):
    conn.execute("INSERT INTO meta(key,value) VALUES(?,?) "
                 "ON CONFLICT(key) DO UPDATE SET value=excluded.value",
                 (f"last_id:{channel}", str(last_id)))

client = TelegramClient(SESSION, API_ID, API_HASH)
client.flood_sleep_threshold = 24 * 60 * 60
await client.start()
print("Connected.")

async def crawl(channel):
    conn = db_connect()
    last_id = get_last_id(conn, channel)
    entity = await client.get_entity(channel)
    total = (await client.get_messages(entity, limit=0)).total
    already = conn.execute("SELECT COUNT(*) FROM messages WHERE channel=?",
                           (channel,)).fetchone()[0]

    pbar = tqdm(total=total, initial=already, desc=channel, unit="msg")
    count = 0
    try:
        async for msg in client.iter_messages(entity, reverse=True, min_id=last_id):
            text = msg.text or ""
            fwd = None
            if msg.forward:
                fwd = getattr(msg.forward, "from_name", None) or \
                      (msg.forward.chat.title
                       if getattr(msg.forward, "chat", None) else None)
            conn.execute("INSERT OR REPLACE INTO messages VALUES(?,?,?,?,?,?,?)",
                (channel, msg.id, msg.date.isoformat() if msg.date else None,
                 text, 1 if msg.forward else 0, fwd, 1 if msg.media else 0))
            last_id = msg.id
            count += 1
            pbar.update(1)
            if count % 50 == 0:
                set_last_id(conn, channel, last_id); conn.commit()
            if count % 200 == 0:
                await asyncio.sleep(1)
    except FloodWaitError as e:
        print(f"\nflood wait {e.seconds}s exceeded threshold saved re run to resume")
    except KeyboardInterrupt:
        print("\npaused progress saved re run this cell to resume")
    finally:
        set_last_id(conn, channel, last_id); conn.commit()
        pbar.close(); conn.close()
        print(f"this run added {count} new messages resume point {last_id}")

CHANNEL = "@ui_ostad"
await crawl(CHANNEL)

def status(channel):
    conn = db_connect()
    row = conn.execute(
        "SELECT COUNT(*), MIN(id), MAX(id) FROM messages WHERE channel=?",
        (channel,)).fetchone()
    last_id = get_last_id(conn, channel)
    conn.close()
    print(f"channel:     {channel}")
    print(f"stored msgs: {row[0]}")
    print(f"id range:    {row[1]} .. {row[2]}")
    print(f"resume point:{last_id}")

status(CHANNEL)

def export(channel, outfile="/content/drive/MyDrive/tg_crawler/export.txt", fmt="txt"):
    conn = db_connect()
    rows = conn.execute(
        "SELECT id, date, text FROM messages WHERE channel=? ORDER BY id",
        (channel,)).fetchall()
    conn.close()
    n = 0
    with open(outfile, "w", encoding="utf-8") as f:
        for mid, date, text in rows:
            if fmt == "jsonl":
                f.write(json.dumps({"id": mid, "date": date, "text": text},
                                   ensure_ascii=False) + "\n")
            else:
                f.write(f"--- [{mid}] {date} ---\n{text}\n\n")
            n += 1
    print(f"exported {n} messages to {outfile}")

export(CHANNEL)