# VahedClassify

A comprehensive end-to-end data pipeline and search engine for university professor reviews. This project extracts raw data from a Telegram channel, processes it through a custom LLM-based sentiment analysis pipeline, normalizes the Persian text for fuzzy matching, and serves it via a FastAPI backend.

## Architecture & Workflow

```text
[1_telegram_scraper]
       │
       ▼
[2_filter_noise_data (Rust)]
       │
       ▼
[3_conver_to_json (Rust)]
       │
       ▼
[3_remove_duplicates (Python)]
       │
       ▼
[llm_process (Qwen-2.5 + Embeddings)]
       │
       ▼
[search_normalization (6-Step Pipeline)]
       │
       ▼
[api (FastAPI)] ──▶ [frontend]
```

## Project Breakdown

### 1. Data Preparation (`data_preparation/`)

- **`1_telegram_scraper/`**: A Python script designed for Google Colab. Uses Telethon to scrape all historical messages from the `@ui_ostad` Telegram channel, saving them to a local database and exporting to `export.txt`.
- **`2_filter_noise_data/`**: A high-performance Rust application that filters out noise (e.g., advertisements, irrelevant messages) by isolating messages containing specific bot tags.
- **`3_conver_to_json/`**: A Rust application that parses the heavily formatted Telegram output (emojis, box-drawing characters, Persian numbers) into a clean, structured `reviews_fa.json` file.
- **`3_remove_duplicates/`**: A Python script that removes identical reviews submitted multiple times. It smartly ignores the timestamp field during comparison so accidental double-submissions are caught regardless of the few seconds between them.

### 2. LLM & Sentiment Processing (`llm_process/`)

Instead of traditional ML classifiers, this module uses a local LLM for deep contextual understanding:

- **Model:** Uses `Qwen-2.5` (7B) for sentiment extraction.
- **Performance Optimization:** Applied prompt engineering to reduce inference time from ~35 seconds down to 3-4 seconds per record.
- **Bias Prevention:** Professor names, course names, and faculties are stripped from the LLM input prompt to ensure the model judges the _content_ of the review, not preconceived notions about the professor.
- **Missing Data Imputation:** Uses statistical averaging to intelligently fill in missing values for the 6 standard evaluation factors.
- **Entity Resolution:** Utilizes an embedding model to consolidate entities with identical semantic meanings (e.g., mapping "ریاضی ۱" and "ریاضی عمومی ۱", or "دکتر محمودی" and "محمودی" to a single canonical ID).

### 3. Search Normalization (`search_normalization/`)

A strict 6-step Python pipeline designed to bloat text with variants, making the dataset highly resilient to messy user input for the fuzzy search API:

1.  **`1_remove_special_chars.py`**: Strips punctuation to prevent word concatenation.
2.  **`2_convert_words_to_digits.py`**: Changes written Persian numbers (یک، دو، سه) to standard digits.
3.  **`3_fix_letter_digit_spacing.py`**: Ensures spaces exist between letters and numbers (e.g., `کلاس20` -> `کلاس 20`).
4.  **`4_sync_bilingual_digits.py`**: Appends English equivalents next to Persian digits (and vice versa) so searches match regardless of keyboard layout.
5.  **`5_generate_character_variants.py`**: Expands strings to include interchangeable Persian/Arabic characters (e.g., ا/آ, ک/ك, ی/ي) using Cartesian products.
6.  **`6_expand_half_spaces.py`**: Duplicates words containing ZWNJ (`می‌روم`) into a spaced version (`می روم`).

### 4. API & Frontend (`api/` & `frontend/`)

- **Backend (`api/`)**: A FastAPI application that loads the final `data_no_zwnj.json` into memory. It features a custom fuzzy matching algorithm that parses user queries for professor names, course levels (e.g., distinguishing intro "1" from advanced "2+"), and handles the spelling variants generated in the previous step to return aggregated positive/negative sentiment scores.
- **Frontend (`frontend/`)**: Web interface that consumes the API.

## Tech Stack

- **Data Extraction:** Python, Telethon, SQLite
- **Data Parsing:** Rust
- **NLP / LLM:** Qwen-2.5 (7B), Sentence-Transformers
- **Search Prep:** Python, Regex, itertools
- **Backend:** Python, FastAPI, Uvicorn
- **Frontend:** HTML/CSS/JS

## Local Setup

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/Owurk/VahedClassify.git
    ```
2.  **Data Preparation:**
    - Run the script in `data_preparation/1_telegram_scraper` via Google Colab to generate `export.txt`.
    - Build and run the Rust executables in `data_preparation/2_filter_noise_data` and `data_preparation/3_conver_to_json`.
    - Run the Python script in `data_preparation/3_remove_duplicates`.
3.  **LLM Processing:**
    - Follow the notebook in `llm_process/` (Requires local LLM setup via Ollama or similar for Qwen-2.5).
4.  **Normalization:**
    - Run the 6 Python scripts in `search_normalization/` sequentially (they are numbered).
5.  **API:**
    ```bash
    cd api
    pip install -r requirements.txt
    uvicorn main:app --host 0.0.0.0 --port 8000
    ```
