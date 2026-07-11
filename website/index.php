<?php
 $site_name   = "VahedClassify";
 $university  = "دانشگاه اصفهان";
 $uni_short   = "UI";
 $version     = "v1.0.0";
 $launch_year = "1406";

 $metrics = [
    ["label" => "Accuracy",  "value" => 92,  "color" => "blue",   "desc" => "دقت کلی"],
    ["label" => "Precision", "value" => 94,  "color" => "green",  "desc" => "صحت پیش‌بینی"],
    ["label" => "Recall",    "value" => 85,  "color" => "purple", "desc" => "بازیابی"],
];

 $developers = [
    [
        "alias"    => "Jacky",
        "name"     => "Radin",
        "role"     => "AI Engineer",
        "bio"      => "کار با LLM ها و فاین تیون کردن مدل ها برای وظیفه خاص",
        "skills"   => ["VLM","Deep Learning","LLM"],
        "avatar"   => "OIP.jpg",
        "github"   => "https://github.com/JackyJa",
        "linkedin" => "https://www.linkedin.com/in/radin-abdi-b03445323",
        "telegram" => "https://t.me/jacky_hard",
    ],
    [
        "alias"    => "SynTax",
        "name"     => "Ahura",
        "role"     => "Network Security Engineer",
        "bio"      => "کرال کردن سایت ها و استخراج دیتا برای استفاده در هر موضوعی",
        "skills"   => ["Crawler Developer","FastAPI","WebScraper"],
        "avatar"   => "Ahura.jpg",
        "telegram" => "https://t.me/IXLNIXML",
    ],
];
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!-- Favicon (SVG Embedded) -->
<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop offset='0' stop-color='%234F7CFF'/%3E%3Cstop offset='1' stop-color='%238B5CF6'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='100' height='100' rx='25' fill='url(%23g)'/%3E%3Ctext x='50' y='72' font-family='Arial' font-weight='bold' font-size='52' fill='white' text-anchor='middle'%3EVC%3C/text%3E%3C/svg%3E">
<title><?= htmlspecialchars($site_name) ?> · <?= $university ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Vazirmatn:wght@300;400;500;600;700&family=Baloo+Bhaijaan+2:wght@400;500;600;700;800&family=Markazi+Text:wght@400;500;600;700&family=Fira+Code:wght@400;500;600&display=swap" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/twemoji@14.0.2/dist/twemoji.min.js"></script>
<script>
  window.addEventListener('DOMContentLoaded', function() {
    twemoji.parse(document.body, {
      base: 'https://cdn.jsdelivr.net/npm/emoji-datasource-apple@15.0.1/',
      folder: 'img/apple/64',
      ext: '.png'
    });
  });
</script>

<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
:root{
    --bg:#050810;--card:#0C1220;
    --blue:#4F7CFF;--blue-lo:rgba(79,124,255,.13);--blue-glow:rgba(79,124,255,.22);
    --green:#2ECC71;--green-lo:rgba(46,204,113,.12);
    --red:#E74C3C;--red-lo:rgba(231,76,60,.12);
    --gold:#F5A623;--gold-lo:rgba(245,166,35,.1);
    --purple:#8B5CF6;--purple-lo:rgba(139,92,246,.12);
    --hi:#ECF0FF;--mid:#7A8BAD;--lo:#3A4560;
    --border:rgba(255,255,255,0.08);
    --r-lg:22px;--r-md:14px;
}
html{scroll-behavior:smooth;}
body{font-family:'Vazirmatn','Inter',sans-serif;background:var(--bg);color:var(--hi);min-height:100vh;overflow-x:hidden;direction:rtl;padding-bottom: 30px;}

/* Custom Neon Scrollbar */
::-webkit-scrollbar { width: 8px; }
::-webkit-scrollbar-track { background: #050810; }
::-webkit-scrollbar-thumb { background: linear-gradient(var(--blue), var(--purple)); border-radius: 10px; border: 2px solid #050810; }
::-webkit-scrollbar-thumb:hover { background: var(--purple); }

/* Scroll Progress Bar */
#scroll-progress {
    position: fixed;
    top: 0;
    left: 0;
    width: 0%;
    height: 3px;
    background: linear-gradient(90deg, var(--blue), var(--purple), var(--gold));
    z-index: 10001;
    box-shadow: 0 0 10px var(--blue);
    transition: width 0.1s ease-out, background 1s ease;
}
body.theme-positive #scroll-progress { background: linear-gradient(90deg, var(--green), #2ecc71); box-shadow: 0 0 10px var(--green); }
body.theme-negative #scroll-progress { background: linear-gradient(90deg, var(--red), #e74c3c); box-shadow: 0 0 10px var(--red); }

/* Custom Cursor */
* { cursor: none; }
.cursor-dot, .cursor-outline { position: fixed; top: 0; left: 0; border-radius: 50%; pointer-events: none; z-index: 9999; transform: translate(-50%, -50%); mix-blend-mode: screen; }
.cursor-dot { width: 6px; height: 6px; background: #fff; transition: transform 0.1s ease; }
.cursor-outline { width: 35px; height: 35px; border: 1.5px solid rgba(79,124,255,0.6); transition: all 0.2s ease; }
.cursor-outline.hover { width: 60px; height: 60px; border-color: var(--purple); background: rgba(139,92,246,0.1); }

/* Preloader */
#preloader { position: fixed; inset: 0; z-index: 10000; background: #050810; display: flex; align-items: center; justify-content: center; transition: opacity 0.5s ease, visibility 0.5s ease; }
#preloader.hidden { opacity: 0; visibility: hidden; }
.glitch-text { font-family: 'Space Grotesk', sans-serif; font-size: 4rem; font-weight: 700; color: transparent; background: linear-gradient(135deg, var(--blue) 0%, var(--purple) 60%, var(--gold) 100%); -webkit-background-clip: text; background-clip: text; position: relative; filter: drop-shadow(0 0 10px rgba(79,124,255,0.8)); }
.glitch-text::before, .glitch-text::after { content: 'VC'; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, var(--blue) 0%, var(--purple) 60%, var(--gold) 100%); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
.glitch-text::before { color: var(--blue); -webkit-text-fill-color: var(--blue); animation: glitch-1 0.5s infinite; clip-path: polygon(0 0, 100% 0, 100% 45%, 0 45%); }
.glitch-text::after { color: var(--purple); -webkit-text-fill-color: var(--purple); animation: glitch-2 0.5s infinite; clip-path: polygon(0 60%, 100% 60%, 100% 100%, 0 100%); }
@keyframes glitch-1 { 0% { transform: translate(0); } 20% { transform: translate(-3px, 3px); } 40% { transform: translate(3px, -3px); } 60% { transform: translate(0); } }
@keyframes glitch-2 { 0% { transform: translate(0); } 20% { transform: translate(3px, -3px); } 40% { transform: translate(-3px, 3px); } 60% { transform: translate(0); } }

/* Background Elements */
#particleCanvas{position:fixed;inset:0;z-index:0;pointer-events:none;}
.aurora{position:fixed;inset:0;z-index:0;pointer-events:none;overflow:hidden;}
.aurora-orb{position:absolute;border-radius:50%;filter:blur(90px);transition: background 1.5s ease-in-out;}
.aurora-orb.a{width:800px;height:800px;top:-250px;right:-200px;background:radial-gradient(circle,rgba(79,124,255,.18) 0%,transparent 65%);animation:orb-a 25s ease-in-out infinite alternate;}
.aurora-orb.b{width:700px;height:700px;bottom:-200px;left:-150px;background:radial-gradient(circle,rgba(139,92,246,.14) 0%,transparent 65%);animation:orb-b 30s ease-in-out infinite alternate;}
@keyframes orb-a{from{transform:translate(0,0) scale(1);}to{transform:translate(80px,100px) scale(1.18);}}
@keyframes orb-b{from{transform:translate(0,0) scale(1);}to{transform:translate(-60px,-70px) scale(1.14);}}
.dot-grid{position:fixed;inset:0;z-index:0;pointer-events:none;background-image:radial-gradient(rgba(255,255,255,0.07) 1px,transparent 1px);background-size:40px 40px;mask-image:radial-gradient(ellipse 80% 80% at 50% 50%,black 40%,transparent 100%);-webkit-mask-image:radial-gradient(ellipse 80% 80% at 50% 50%,black 40%,transparent 100%);}

/* Emotional Theme Shift */
body.theme-positive .aurora-orb.a { background: radial-gradient(circle, rgba(46, 204, 113, 0.25) 0%, transparent 65%); }
body.theme-positive .aurora-orb.b { background: radial-gradient(circle, rgba(46, 204, 113, 0.15) 0%, transparent 65%); }
body.theme-negative .aurora-orb.a { background: radial-gradient(circle, rgba(231, 76, 60, 0.25) 0%, transparent 65%); }
body.theme-negative .aurora-orb.b { background: radial-gradient(circle, rgba(231, 76, 60, 0.15) 0%, transparent 65%); }

.wrap{position:relative;z-index:2;max-width:1080px;margin:0 auto;padding:0 24px;}

/* Navigation */
nav{position:sticky;top:0;z-index:200;background:rgba(5,8,16,.75);backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);border-bottom:1px solid var(--border);}
.nav-in{display:flex;align-items:center;justify-content:space-between;max-width:1080px;margin:0 auto;padding:15px 24px;}
.logo{display:flex;align-items:center;gap:10px;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.15rem;color:var(--hi);text-decoration:none;direction:ltr;}
.logo-icon{width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,var(--blue),var(--purple));display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:900;color:#fff;box-shadow:0 4px 16px var(--blue-glow);}
.nav-pill{font-family:'Fira Code',monospace;font-size:.7rem;color:var(--gold);border:1px solid rgba(245,166,35,.3);padding:6px 14px;border-radius:20px;background:var(--gold-lo);direction:ltr;}

/* Hero */
.hero{padding:120px 0 80px;text-align:center;}
.eyebrow{display:inline-flex;align-items:center;gap:8px;font-family:'Fira Code',monospace;font-size:.72rem;letter-spacing:.13em;text-transform:uppercase;color:var(--blue);background:var(--blue-lo);border:1px solid rgba(79,124,255,.28);padding:8px 20px;border-radius:30px;margin-bottom:32px;}
.blink{animation:blink-kf 1.5s step-end infinite;}
@keyframes blink-kf{0%,100%{opacity:1}50%{opacity:.15}}
.hero h1{font-family:'Space Grotesk',sans-serif;font-size:clamp(2.8rem, 7vw, 4.5rem);font-weight:700;line-height:1.12;margin-bottom:16px;direction:ltr;min-height: 80px;}
.gradient-text {background: linear-gradient(135deg, var(--blue) 0%, var(--purple) 60%, var(--gold) 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;background-clip: text;}
.type-cursor { display: inline-block; width: 4px; height: 1em; background: var(--blue); margin-right: 4px; animation: blink 1s infinite; vertical-align: text-bottom; transform: translateY(4px); }
.h1-gray{color:var(--mid);font-size:60%;font-weight:300;letter-spacing:.04em;display:block;margin-top:10px;}
.hero-sub{font-size:1.1rem;color:var(--mid);line-height:1.85;margin-bottom:32px;font-weight:300;}
.domain-badge{display:inline-block;font-family:'Fira Code',monospace;font-size:.82rem;color:var(--green);border:1px solid rgba(46,204,113,.3);padding:8px 22px;border-radius:20px;background:var(--green-lo);margin-bottom:52px;direction:ltr;letter-spacing:.04em;cursor:pointer;transition:all 0.3s;}
.domain-badge:hover {background: rgba(46,204,113,.2); box-shadow: 0 0 20px rgba(46,204,113,.2);}

.wave-wrap{position:relative;max-width:700px;margin:0 auto 60px;height:90px;}
#sentWave{width:100%;height:100%;display:block;}
.wave-lbl{position:absolute;bottom:-26px;left:50%;transform:translateX(-50%);font-family:'Fira Code',monospace;font-size:.67rem;color:var(--lo);letter-spacing:.1em;text-transform:uppercase;white-space:nowrap;}

/* Metrics */
.metrics-row{display:flex;justify-content:center;gap:20px;max-width:780px;margin:0 auto 24px;flex-wrap:wrap;}
.tilt-card{transform-style:preserve-3d;transition:transform 0.1s ease;}
.metric-card{flex:1;min-width:180px;background:rgba(12, 18, 32, 0.7);backdrop-filter: blur(16px);border:1px solid var(--border);border-radius:var(--r-lg);padding:28px 20px 24px;text-align:center;position:relative;overflow:hidden;transition:box-shadow .35s, border-color .3s;}
.metric-card:hover{border-color: rgba(255,255,255,0.2);}
.metric-card.mc-blue ::before,.metric-card.mc-blue{--mc:var(--blue);--mc-lo:var(--blue-lo);--mc-glow:var(--blue-glow);}
.metric-card.mc-green{--mc:var(--green);--mc-lo:var(--green-lo);--mc-glow:rgba(46,204,113,.25);}
.metric-card.mc-purple{--mc:var(--purple);--mc-lo:var(--purple-lo);--mc-glow:rgba(139,92,246,.25);}
.metric-card::after{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--mc),transparent);}
.metric-card:hover{box-shadow:0 20px 50px rgba(0,0,0,.5),0 0 30px var(--mc-glow);}
/* Light edge tracking */
.tilt-card::before { content: ''; position: absolute; inset: 0; border-radius: inherit; background: radial-gradient(circle 150px at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(255,255,255,0.1), transparent 80%); opacity: 0; transition: opacity 0.3s; pointer-events: none; z-index: 2; }
.tilt-card:hover::before { opacity: 1; }

.gauge-wrap{position:relative;width:96px;height:96px;margin:0 auto 16px;}
.gauge-wrap svg{transform:rotate(-90deg);}
.gauge-bg{fill:none;stroke:rgba(255,255,255,.06);stroke-width:7;}
.gauge-fill{fill:none;stroke-width:7;stroke-linecap:round;transition:stroke-dashoffset 1.4s cubic-bezier(.22,1,.36,1);filter: drop-shadow(0 0 6px var(--mc));}
.mc-blue .gauge-fill{stroke:var(--blue);}.mc-green .gauge-fill{stroke:var(--green);}.mc-purple .gauge-fill{stroke:var(--purple);}
.gauge-val{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-size:1.45rem;font-weight:700;direction:ltr;line-height:1;}
.mc-blue .gauge-val{color:var(--blue);}.mc-green .gauge-val{color:var(--green);}.mc-purple .gauge-val{color:var(--purple);}
.gauge-pct{font-size:.6rem;color:var(--mid);margin-top:2px;}
.metric-label{font-family:'Space Grotesk',sans-serif;font-size:.78rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;margin-bottom:4px;direction:ltr;}
.mc-blue .metric-label{color:var(--blue);}.mc-green .metric-label{color:var(--green);}.mc-purple .metric-label{color:var(--purple);}
.metric-desc{font-size:.8rem;color:var(--mid);}

.mini-stats{display:flex;justify-content:center;gap:0;border:1px solid var(--border);border-radius:var(--r-md);overflow:hidden;max-width:680px;margin:0 auto;background:rgba(12, 18, 32, 0.7);backdrop-filter: blur(12px);}
.mini-stat{flex:1;padding:18px 12px;text-align:center;border-left:1px solid var(--border);transition: background 0.3s;}
.mini-stat:last-child{border-left:none;}
.mini-stat:hover{background:rgba(79,124,255,.07);}
.mini-n{display:block;font-family:'Space Grotesk',sans-serif;font-size:1.4rem;font-weight:700;direction:ltr;}
.mini-n.c-gold{color:var(--gold);}.mini-n.c-green{color:var(--green);}
.mini-l{display:block;font-size:.72rem;color:var(--mid);margin-top:4px;}

hr.div{border:none;border-top:1px solid var(--border);margin: 40px 0;}
.sec{padding:80px 0;}
.sec-lbl{font-family:'Baloo Bhaijaan 2',sans-serif;font-size:.85rem;font-weight:600;color:var(--gold);margin-bottom:10px;}
.sec-title{font-family:'Space Grotesk',sans-serif;font-size:clamp(1.8rem, 4vw, 2.5rem);font-weight:700;color:var(--hi);margin-bottom:16px;}
.sec-desc{font-size:1rem;color:var(--mid);line-height:1.85;max-width:650px;}

/* Features & Cards */
.feat-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px;margin-top:46px;}
.feat-card{background:rgba(12, 18, 32, 0.6);backdrop-filter: blur(14px);border:1px solid var(--border);border-radius:var(--r-md);padding:30px 24px;transition:transform .1s,border-color .3s,box-shadow .3s;position:relative;overflow:hidden;}
.feat-card::after{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(79,124,255,.04),transparent 60%);opacity:0;transition:opacity .3s;pointer-events:none;}
.feat-card:hover{border-color:rgba(79,124,255,.4);box-shadow:0 20px 40px rgba(0,0,0,.4);}
.feat-card:hover::after{opacity:1;}
.feat-ico{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:20px;transform: translateZ(40px);}
.feat-ico.b{background:var(--blue-lo);}.feat-ico.g{background:var(--green-lo);}.feat-ico.p{background:var(--purple-lo);}.feat-ico.r{background:var(--red-lo);}
.feat-t{font-weight:600;font-size:1rem;margin-bottom:10px;transform: translateZ(20px);}.feat-d{font-size:.86rem;color:var(--mid);line-height:1.75;transform: translateZ(10px);}

/* Classification Visuals */
.clf-visual{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:46px;}
@media(max-width:580px){.clf-visual{grid-template-columns:1fr;}}
.clf-card{background:rgba(12, 18, 32, 0.6);backdrop-filter: blur(14px);border:1px solid var(--border);border-radius:var(--r-md);padding:32px 28px;display:flex;flex-direction:column;align-items:flex-start;gap:14px;position:relative;overflow:hidden;transition:transform .1s,box-shadow .3s;}
.clf-card.pos{border-color:rgba(46,204,113,.2);}.clf-card.neg{border-color:rgba(231,76,60,.18);}
.clf-card::after{content:'';position:absolute;top:0;left:0;right:0;height:3px;pointer-events:none;}
.clf-card.pos::after{background:linear-gradient(90deg,var(--green),transparent);}.clf-card.neg::after{background:linear-gradient(90deg,var(--red),transparent);}
.clf-icon{font-size:2.2rem;transform: translateZ(40px);}.clf-name{font-family:'Space Grotesk',sans-serif;font-size:1.2rem;font-weight:700;transform: translateZ(30px);}
.clf-card.pos .clf-name{color:var(--green);}.clf-card.neg .clf-name{color:var(--red);}
.clf-desc{font-size:.88rem;color:var(--mid);line-height:1.7;transform: translateZ(20px);}
.clf-ex{font-family:'Baloo Bhaijaan 2',sans-serif;font-size:1.2rem;padding:10px 16px;border-radius:8px;line-height:1.6;direction:rtl;width: 100%;transform: translateZ(10px);}
.clf-card.pos .clf-ex{background:var(--green-lo);color:var(--green);border:1px solid rgba(46,204,113,.2);}
.clf-card.neg .clf-ex{background:var(--red-lo);color:var(--red);border:1px solid rgba(231,76,60,.18);}

/* Team */
.team-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:24px;margin-top:46px;}
.dev-card{background:rgba(12, 18, 32, 0.7);backdrop-filter: blur(18px);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;transition:transform .1s,border-color .35s,box-shadow .35s;position:relative;}
.dev-card:hover{border-color:rgba(79,124,255,.5);box-shadow:0 30px 60px rgba(0,0,0,.5),0 0 40px rgba(79,124,255,.15);}
.dev-card:nth-child(1) .dev-top{background:linear-gradient(135deg,rgba(79,124,255,.4),rgba(139,92,246,.2));}
.dev-card:nth-child(2) .dev-top{background:linear-gradient(135deg,rgba(245,166,35,.3),rgba(79,124,255,.15));}
.dev-top{height:100px;position:relative;}
.dev-top::after{content:'';position:absolute;inset:0;background:linear-gradient(90deg,transparent,rgba(255,255,255,.06),transparent);background-size:200% 100%;animation:shimmer 3s ease-in-out infinite;}
@keyframes shimmer{0%{background-position:200% 0;}100%{background-position:-200% 0;}}
.dev-av{position:absolute;bottom:-44px;right:28px;width:88px;height:88px;border-radius:50%;border:4px solid var(--card);overflow:hidden;background:var(--bg);box-shadow: 0 8px 20px rgba(0,0,0,0.3);transform: translateZ(50px);}
.dev-av img{width:100%;height:100%;object-fit:cover;display:block;}
.dev-av .av-ph{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-size:1.6rem;font-weight:700;color:var(--blue);background:var(--blue-lo);}
.dev-body{padding:56px 28px 28px;transform: translateZ(20px);}
.dev-realname{font-size:.85rem;color:var(--mid);direction:ltr;margin-bottom:4px;}
.dev-alias{font-family:'Space Grotesk',sans-serif;font-size:1.5rem;font-weight:700;direction:ltr;margin-bottom:6px;}
.dev-alias .at{color:var(--blue);}.dev-role{font-size:.82rem;color:var(--gold);margin-bottom:18px;font-weight:500;}
.dev-bio{font-size:.9rem;color:var(--mid);line-height:1.8;margin-bottom:22px;}
.dev-skills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:24px;}
.sk{font-family:'Fira Code',monospace;font-size:.72rem;direction:ltr;padding:6px 14px;border-radius:20px;background:rgba(255,255,255,.04);border:1px solid var(--border);color:var(--mid);transition:all .2s;}
.sk:hover{background:var(--blue-lo);border-color:rgba(79,124,255,.4);color:var(--blue);}
.dev-socials{display:flex;gap:10px;flex-wrap:wrap;}
.soc-btn{display:inline-flex;align-items:center;gap:7px;font-size:.8rem;color:var(--mid);text-decoration:none;padding:10px 18px;border:1px solid var(--border);border-radius:12px;transition:all .25s;direction:ltr;background: rgba(255,255,255,0.02);}
.soc-btn.gh:hover{border-color:rgba(255,255,255,.3);color:var(--hi);background:rgba(255,255,255,.05);}
.soc-btn.li:hover{border-color:rgba(10,102,194,.6);color:#0A66C2;background:rgba(10,102,194,.1);}
.soc-btn.tg:hover{border-color:rgba(41,182,246,.6);color:#29B6F6;background:rgba(41,182,246,.1);}

/* Cyberpunk Terminal */
.terminal-window { background: #0a0e17; border: 1px solid var(--border); border-radius: 12px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.5); position: relative; }
.terminal-window::before { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, transparent, rgba(79,124,255,0.03)); pointer-events: none; }
.term-header { display: flex; align-items: center; gap: 8px; padding: 12px 18px; background: #111720; border-bottom: 1px solid var(--border); }
.term-dot { width: 12px; height: 12px; border-radius: 50%; }
.term-dot.r { background: #ff5f56; } .term-dot.y { background: #ffbd2e; } .term-dot.g { background: #27c93f; }
.term-body { padding: 24px; font-family: 'Fira Code', monospace; font-size: 0.9rem; color: #a5b3ce; min-height: 250px; position: relative; }
.term-line { margin-bottom: 16px; display: flex; align-items: center; flex-wrap: wrap; gap: 10px; direction: ltr; justify-content: flex-start; }
.term-prompt { color: var(--green); }
.term-input { background: transparent; border: none; color: var(--hi); font-family: 'Baloo Bhaijaan 2', sans-serif; font-size: 0.9rem; outline: none; flex-grow: 1; border-bottom: 1px solid var(--lo); padding-bottom: 4px; direction: rtl; text-align: left; }
.term-input::placeholder { font-family: 'Baloo Bhaijaan 2', sans-serif; color: var(--lo); opacity: 0.8; }

/* Magnetic Button */
.magnetic-btn { display: inline-block; padding: 8px 24px; background: transparent; border: 1px solid var(--blue); color: var(--blue); border-radius: 6px; font-family: 'Fira Code', monospace; font-weight: 600; cursor: pointer; transition: all 0.2s ease-out, transform 0.3s ease-out; font-size: 0.85rem; position: relative; }
.magnetic-btn:hover { background: var(--blue); color: #fff; box-shadow: 0 0 15px var(--blue-glow); }
.magnetic-btn.large { padding: 12px 40px; font-size: 1rem; }

.term-output { margin-top: 20px; background: #06080d; padding: 18px; border-radius: 8px; border-left: 3px solid var(--blue); line-height: 1.8; }
.term-output.error { border-color: var(--red); }
.compare-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 20px; }
@media(max-width:600px){ .compare-grid { grid-template-columns: 1fr; } }
.compare-box { background: #06080d; padding: 18px; border-radius: 8px; border: 1px solid var(--border); text-align: center; }
.compare-box.winner { border-color: var(--green); box-shadow: 0 0 20px rgba(46,204,113,0.2); }
.compare-box h4 { color: var(--hi); margin-bottom: 8px; font-family: 'Vazirmatn', sans-serif; }
.compare-box small { color: var(--mid); display: block; margin-bottom: 12px; }

/* JSON Syntax Highlighting */
.json-string { color: var(--green); }
.json-number { color: var(--gold); }
.json-key { color: var(--blue); }

/* Progress */
.progress-container {margin: 18px 0;height: 10px;background: rgba(255,255,255,0.08);border-radius: 30px;overflow:hidden;border: 1px solid rgba(255,255,255,0.03);}
.progress-bar {height: 100%;background: linear-gradient(90deg, var(--blue), var(--green));border-radius: 30px;transition: width 1.2s cubic-bezier(0.34, 1.56, 0.64, 1);box-shadow: 0 0 15px rgba(46, 204, 113, 0.6);}

/* Footer */
footer{border-top:1px solid var(--border);padding:50px 0;margin-top:60px;position: relative; z-index: 2; background: rgba(5,8,16,0.6); backdrop-filter: blur(10px);}
.foot-in{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;max-width:1080px;margin:0 auto;padding:0 24px;}
.foot-brand{font-family:'Space Grotesk',sans-serif;font-weight:600;font-size:1rem;direction:ltr;}
.foot-brand span{color:var(--blue);}
.foot-online{font-family:'Fira Code',monospace;font-size:.75rem;color:var(--green);border:1px solid rgba(46,204,113,.25);padding:6px 14px;border-radius:20px;background:var(--green-lo);display:flex;align-items:center;gap:8px;}
.foot-online::before{content:'';width:6px;height:6px;border-radius:50%;background:var(--green);animation:pulse-dot 2s ease-in-out infinite;}
@keyframes pulse-dot{0%,100%{box-shadow:0 0 0 0 rgba(46,204,113,.6);}50%{box-shadow:0 0 0 6px rgba(46,204,113,0);}}
.foot-copy{font-size:.8rem;color:var(--lo);}

/* Status Bar (VS Code Style) */
.status-bar { position: fixed; bottom: 0; left: 0; right: 0; height: 24px; background: rgba(17, 23, 32, 0.95); backdrop-filter: blur(16px); border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 15px; font-family: 'Fira Code', sans-serif; font-size: 0.65rem; color: var(--mid); z-index: 1000; direction: ltr; }
.status-item { display: flex; align-items: center; gap: 6px; }
.status-item span { color: var(--hi); }
.status-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--green); box-shadow: 0 0 6px var(--green); animation: pulse-dot 2s infinite; }
.latency-flash { animation: flash-green 0.5s ease-out; }
@keyframes flash-green { 0% { color: var(--green); text-shadow: 0 0 8px var(--green); } 100% { color: var(--hi); text-shadow: none; } }

/* Cinematic Blur Reveal Animation */
.reveal {
    opacity: 0;
    transform: translateY(40px) scale(0.98);
    filter: blur(12px);
    transition: opacity 1s cubic-bezier(0.25, 0.1, 0.25, 1), transform 1s cubic-bezier(0.25, 0.1, 0.25, 1), filter 1s cubic-bezier(0.25, 0.1, 0.25, 1);
}
.reveal.active {
    opacity: 1;
    transform: translateY(0) scale(1);
    filter: blur(0);
}

/* Neon Pulsing Border for Tilt Cards */
@keyframes neon-pulse {
    0% { border-color: var(--blue); box-shadow: 0 20px 50px rgba(0,0,0,.5), 0 0 15px var(--blue-glow), inset 0 0 10px rgba(79,124,255,0.1); }
    50% { border-color: var(--purple); box-shadow: 0 20px 50px rgba(0,0,0,.5), 0 0 25px var(--purple-glow), inset 0 0 15px rgba(139,92,246,0.2); }
    100% { border-color: var(--blue); box-shadow: 0 20px 50px rgba(0,0,0,.5), 0 0 15px var(--blue-glow), inset 0 0 10px rgba(79,124,255,0.1); }
}
.metric-card:hover, .feat-card:hover, .clf-card:hover, .dev-card:hover {
    animation: neon-pulse 3s ease-in-out infinite;
    border-color: transparent; /* Let animation handle it */
}

@media(max-width:600px){.metrics-row{flex-direction:column;align-items:center;}.mini-stats{flex-direction:column;}.mini-stat{border-left:none;border-bottom:1px solid var(--border);}.mini-stat:last-child{border-bottom:none;}}
img.emoji {height: 1em;width: 1em;margin: 0 .05em 0 .1em;vertical-align: -0.1em;}
</style>
</head>
<body>

<!-- Scroll Progress Bar -->
<div id="scroll-progress"></div>

<!-- Preloader -->
<div id="preloader"><div class="glitch-text">VC</div></div>

<!-- Custom Cursor -->
<div class="cursor-dot"></div>
<div class="cursor-outline"></div>

<canvas id="particleCanvas"></canvas>
<div class="aurora">
    <div class="aurora-orb a"></div>
    <div class="aurora-orb b"></div>
</div>
<div class="dot-grid"></div>

<nav>
    <div class="nav-in">
        <a href="#" class="logo">
            <div class="logo-icon">VC</div>
            <?= htmlspecialchars($site_name) ?>
        </a>
        <span class="nav-pill"><?= $version ?> · <?= $uni_short ?></span>
    </div>
</nav>

<section class="hero">
    <div class="wrap">
        <div class="eyebrow"><span class="blink">▮</span> Sentiment Analysis · <?= $university ?></div>
        <h1>
            <span id="typing-text" class="gradient-text"></span><span class="type-cursor"></span>
            <span class="h1-gray">University of Isfahan</span>
        </h1>
        <p class="hero-sub">تحلیل هوشمند احساسات نظرات اساتید<br/>با پردازش زبان طبیعی فارسی (NLP)</p>

        <small style="display:block;font-size:.7rem;color:#4A5568;margin-bottom:10px;letter-spacing:.05em;">👇 بزن روش تا کپی بشه</small>
        <div class="domain-badge" onclick="
            var tmp=document.createElement('textarea');
            tmp.value='api.vahedclassifyui.ir?prof_name=...&course_name=...';
            document.body.appendChild(tmp);tmp.select();document.execCommand('copy');document.body.removeChild(tmp);
            this.innerText='✅ کپی شد!';
            twemoji.parse(this);
            setTimeout(()=>{
                this.innerText='🌐 api.vahedclassifyui.ir?prof_name=...&course_name=...';
                twemoji.parse(this);
            },2000);">🌐 api.vahedclassifyui.ir?prof_name=...&course_name=...</div>

        <div class="wave-wrap">
            <canvas id="sentWave"></canvas>
            <span class="wave-lbl">LIVE SENTIMENT PULSE · NLP ENGINE ACTIVE</span>
        </div>

        <div class="metrics-row reveal">
            <?php foreach($metrics as $m): ?>
            <div class="metric-card tilt-card mc-<?= $m['color'] ?>" data-value="<?= $m['value'] ?>">
                <div class="gauge-wrap">
                    <svg width="96" height="96" viewBox="0 0 96 96">
                        <circle class="gauge-bg" cx="48" cy="48" r="38"/>
                        <circle class="gauge-fill" cx="48" cy="48" r="38"
                            stroke-dasharray="<?= 2*M_PI*38 ?>"
                            stroke-dashoffset="<?= 2*M_PI*38 ?>"
                            data-full="<?= 2*M_PI*38 ?>"
                            data-pct="<?= $m['value'] ?>"/>
                    </svg>
                    <div class="gauge-val">
                        <span class="gauge-num" data-target="<?= $m['value'] ?>">0</span>
                        <span class="gauge-pct">%</span>
                    </div>
                </div>
                <div class="metric-label"><?= $m['label'] ?></div>
                <div class="metric-desc"><?= $m['desc'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="mini-stats reveal">
            <div class="mini-stat">
                <span class="mini-n c-gold" data-target="2">0</span>
                <span class="mini-l">کلاس احساسی</span>
            </div>
            <div class="mini-stat">
                <span class="mini-n c-green" data-target="2">0</span>
                <span class="mini-l">توسعه‌دهنده</span>
            </div>
            <div class="mini-stat">
                <span class="mini-n" style="color:var(--gold);" data-target="1406">0</span>
                <span class="mini-l">سال انتشار</span>
            </div>
        </div>
    </div>
</section>

<hr class="div"/>

<section class="sec">
    <div class="wrap">
        <div class="reveal">
            <p class="sec-lbl">درباره پروژه</p>
            <h2 class="sec-title">چرا VahedClassify؟</h2>
            <p class="sec-desc">این API امکان آنالیز خودکار نظرات دانشجویان درباره اساتید دانشگاه اصفهان را فراهم می‌کند. متن فارسی به‌صورت real-time پردازش شده و احساس مثبت یا منفی استخراج می‌گردد.</p>
        </div>
        <div class="feat-grid">
            <div class="feat-card tilt-card reveal"><div class="feat-ico b">🧠</div><div class="feat-t">پردازش زبان طبیعی فارسی</div><div class="feat-d">مدل آموزش‌دیده روی داده‌های نظرات دانشجویی با درک عمیق ادبیات فارسی دانشگاهی</div></div>
            <div class="feat-card tilt-card reveal"><div class="feat-ico g">⚡</div><div class="feat-t">پاسخ Real-time</div><div class="feat-d">تحلیل آنی از طریق API ساده با میانگین زمان پاسخ کمتر از 1000ms</div></div>
            <div class="feat-card tilt-card reveal"><div class="feat-ico p">🎯</div><div class="feat-t">دقت ۹۲ درصدی</div><div class="feat-d">نتایج آزمون روی داده‌های واقعی دانشگاه اصفهان — دقت ۹۲٪ روی تست‌ست</div></div>
            <div class="feat-card tilt-card reveal"><div class="feat-ico r">🔗</div><div class="feat-t">یکپارچه با گلستان</div><div class="feat-d">طراحی شده برای اتصال مستقیم به پلتفرم گلستان دانشگاه اصفهان</div></div>
        </div>
    </div>
</section>

<hr class="div"/>

<section class="sec">
    <div class="wrap">
        <div class="reveal">
            <p class="sec-lbl">کلاس‌های طبقه‌بندی</p>
            <h2 class="sec-title">دو کلاس احساسی</h2>
            <p class="sec-desc">مدل هر نظر را در یکی از دو کلاس زیر طبقه‌بندی می‌کند.</p>
        </div>
        <div class="clf-visual">
            <div class="clf-card pos tilt-card reveal"><div class="clf-icon">😊</div><div class="clf-name">Positive · مثبت</div><div class="clf-desc">نظراتی که رضایت، تشویق یا ارزیابی مطلوب دانشجو را نشان می‌دهند.</div><div class="clf-ex">«استاد خیلی خوب تدریس می‌کنند و کلاس‌هاشون عالیه»</div></div>
            <div class="clf-card neg tilt-card reveal"><div class="clf-icon">😞</div><div class="clf-name">Negative · منفی</div><div class="clf-desc">نظراتی که نارضایتی، انتقاد یا تجربه نامطلوب دانشجو را بیان می‌کنند.</div><div class="clf-ex">«امتحانات خیلی سخت بود و توضیحات کافی نبود»</div></div>
        </div>
    </div>
</section>

<hr class="div"/>
<section class="sec">
    <div class="wrap">
        <div class="reveal">
            <p class="sec-lbl">ابزارهای تعاملی</p>
            <h2 class="sec-title">تست زنده API</h2>
            <p class="sec-desc">با وارد کردن نام استاد و درس، قدرت مدل را محک بزنید و دو استاد را با هم مقایسه کنید.</p>
        </div>

        <!-- Cyberpunk Terminal -->
        <div class="reveal" style="margin-top: 40px;">
            <div class="terminal-window">
                <div class="term-header">
                    <div class="term-dot r"></div>
                    <div class="term-dot y"></div>
                    <div class="term-dot g"></div>
                </div>
                <div class="term-body">
                    <div class="term-line">
                        <span class="term-prompt">$</span>
                        <span>execute --prof</span>
                        <input type="text" id="prof-name" class="term-input" placeholder="نام استاد" dir="rtl">
                    </div>
                    <div class="term-line">
                        <span class="term-prompt">$</span>
                        <span>--course</span>
                        <input type="text" id="course-name" class="term-input" placeholder="نام درس" dir="rtl">
                    </div>
                    <div class="term-line">
                        <button onclick="testAPI()" class="magnetic-btn">▶ RUN QUERY</button>
                    </div>
                    <div id="api-result" class="term-output" style="display:none;"></div>
                </div>
            </div>
        </div>

        <div style="margin-top:50px;" class="reveal">
            <h3 style="text-align:center; margin-bottom:24px; color:var(--gold); font-size: 1.2rem; font-family: 'Baloo Bhaijaan 2', sans-serif;">مقایسه اساتید</h3>
            <div class="compare-grid">
                <div class="terminal-window">
                    <div class="term-header">
                        <div class="term-dot r"></div><div class="term-dot y"></div><div class="term-dot g"></div>
                    </div>
                    <div class="term-body">
                        <div class="term-line"><span class="term-prompt">></span><input type="text" id="prof1" class="term-input" placeholder="نام استاد اول" dir="rtl"></div>
                        <div class="term-line"><span class="term-prompt">></span><input type="text" id="course1" class="term-input" placeholder="نام درس" dir="rtl"></div>
                    </div>
                </div>
                <div class="terminal-window">
                    <div class="term-header">
                        <div class="term-dot r"></div><div class="term-dot y"></div><div class="term-dot g"></div>
                    </div>
                    <div class="term-body">
                        <div class="term-line"><span class="term-prompt">></span><input type="text" id="prof2" class="term-input" placeholder="نام استاد دوم" dir="rtl"></div>
                        <div class="term-line"><span class="term-prompt">></span><input type="text" id="course2" class="term-input" placeholder="نام درس" dir="rtl"></div>
                    </div>
                </div>
            </div>
            <div style="text-align:center; margin:30px 0;">
                <button onclick="compareProfessors()" class="magnetic-btn large">⚖ EXECUTE COMPARISON</button>
            </div>
            <div id="compare-result" style="display:none;"></div>
        </div>
    </div>
</section>
<hr class="div"/>

<section class="sec">
    <div class="wrap">
        <div class="reveal">
            <p class="sec-lbl">تیم توسعه</p>
            <h2 class="sec-title">توسعه‌دهندگان API</h2>
            <p class="sec-desc">این API توسط دو نفر طراحی، آموزش داده و پیاده‌سازی شده است.</p>
        </div>
        <div class="team-grid">
        <?php foreach($developers as $i => $dev): ?>
            <div class="dev-card tilt-card reveal">
                <div class="dev-top">
                    <div class="dev-av">
                        <?php if(!empty($dev['avatar'])): ?>
                            <img src="<?= htmlspecialchars($dev['avatar']) ?>" alt="<?= htmlspecialchars($dev['name']) ?>" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"/>
                            <div class="av-ph" style="display:none;"><?= strtoupper(substr($dev['name'],0,1)) ?></div>
                        <?php else: ?>
                            <div class="av-ph"><?= strtoupper(substr($dev['name'],0,1)) ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="dev-body">
                    <div class="dev-realname"><?= htmlspecialchars($dev['name']) ?></div>
                    <div class="dev-alias"><span class="at"></span><?= htmlspecialchars($dev['alias']) ?></div>
                    <div class="dev-role"><?= htmlspecialchars($dev['role']) ?></div>
                    <div class="dev-bio"><?= htmlspecialchars($dev['bio']) ?></div>
                    <div class="dev-skills"><?php foreach($dev['skills'] as $sk): ?><span class="sk"><?= htmlspecialchars($sk) ?></span><?php endforeach; ?></div>
                    <div class="dev-socials">
                        <?php if(!empty($dev['github'])): ?><a href="<?= htmlspecialchars($dev['github']) ?>" class="soc-btn gh"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/></svg>GitHub</a><?php endif; ?>
                        <?php if(!empty($dev['linkedin'])): ?><a href="<?= htmlspecialchars($dev['linkedin']) ?>" class="soc-btn li"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>LinkedIn</a><?php endif; ?>
                        <?php if(!empty($dev['telegram'])): ?><a href="<?= htmlspecialchars($dev['telegram']) ?>" class="soc-btn tg"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>Telegram</a><?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</section>

<footer>
    <div class="foot-in">
        <div class="foot-brand"><span>Vahed</span>Classify · <?= $university ?></div>
        <span class="foot-online">API ONLINE</span>
        <div class="foot-copy">Built by Jacky &amp; SynTax · <?= $launch_year ?></div>
    </div>
</footer>

<!-- VS Code Style Status Bar -->
<div class="status-bar">
    <div class="status-item">
        <div class="status-dot"></div> API Status: <span>Operational</span>
    </div>
    <div class="status-item">
        Last Ping: <span id="latency-val">--</span>
    </div>

</div>

<script>
// ==================== PRELOADER ====================
window.addEventListener('load', () => {
    setTimeout(() => {
        document.getElementById('preloader').classList.add('hidden');
        typingEffect();
    }, 1500);
});

// ==================== SCROLL PROGRESS BAR ====================
const scrollProgress = document.getElementById('scroll-progress');
window.addEventListener('scroll', () => {
    const h = document.documentElement;
    const b = document.body;
    const st = 'scrollTop';
    const sh = 'scrollHeight';
    const percent = (h[st]||b[st]) / ((h[sh]||b[sh]) - h.clientHeight) * 100;
    scrollProgress.style.width = percent + '%';
});

// ==================== CUSTOM CURSOR ====================
const dot = document.querySelector('.cursor-dot');
const outline = document.querySelector('.cursor-outline');
let mouseX = 0, mouseY = 0, outlineX = 0, outlineY = 0;

document.addEventListener('mousemove', e => {
    mouseX = e.clientX;
    mouseY = e.clientY;
    dot.style.left = mouseX + 'px';
    dot.style.top = mouseY + 'px';
});

function animateCursor() {
    outlineX += (mouseX - outlineX) * 0.15;
    outlineY += (mouseY - outlineY) * 0.15;
    outline.style.left = outlineX + 'px';
    outline.style.top = outlineY + 'px';
    requestAnimationFrame(animateCursor);
}
animateCursor();

document.querySelectorAll('a, button, input, .domain-badge, .metric-card, .feat-card, .clf-card, .dev-card').forEach(el => {
    el.addEventListener('mouseenter', () => outline.classList.add('hover'));
    el.addEventListener('mouseleave', () => outline.classList.remove('hover'));
});

// ==================== MAGNETIC BUTTONS ====================
document.querySelectorAll('.magnetic-btn').forEach(btn => {
    btn.addEventListener('mousemove', e => {
        const rect = btn.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;
        btn.style.transform = `translate(${x * 0.3}px, ${y * 0.4}px)`;
    });
    btn.addEventListener('mouseleave', () => {
        btn.style.transform = 'translate(0px, 0px)';
    });
});

// ==================== 3D TILT EFFECT ====================
document.querySelectorAll('.tilt-card').forEach(card => {
    card.addEventListener('mousemove', e => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const cx = rect.width / 2;
        const cy = rect.height / 2;
        const rx = (y - cy) / 18;
        const ry = (cx - x) / 18;
        card.style.transform = `perspective(1000px) rotateX(${rx}deg) rotateY(${ry}deg) scale(1.02)`;
        card.style.setProperty('--mouse-x', `${x}px`);
        card.style.setProperty('--mouse-y', `${y}px`);
    });
    card.addEventListener('mouseleave', () => {
        card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale(1)';
    });
});

// ==================== TYPING EFFECT ====================
function typingEffect() {
    const textEl = document.getElementById('typing-text');
    const text = "VahedClassify";
    let i = 0;
    textEl.textContent = "";
    function type() {
        if (i < text.length) {
            textEl.textContent += text.charAt(i);
            i++;
            setTimeout(type, 120);
        }
    }
    type();
}

// ==================== NEURAL NETWORK CANVAS ====================
(function(){
    const canvas=document.getElementById('particleCanvas');
    const ctx=canvas.getContext('2d');
    let W,H,nodes=[],mouse={x:null,y:null,radius:150};
    const COUNT=60;

    function resize(){W=canvas.width=window.innerWidth;H=canvas.height=window.innerHeight;}
    window.addEventListener('resize',resize);resize();

    class Node {
        constructor(){
            this.x=Math.random()*W;
            this.y=Math.random()*H;
            this.vx=(Math.random()-.5)*.3;
            this.vy=(Math.random()-.5)*.3;
            this.r=Math.random()*1.5+.5;
        }
        update(){
            this.x+=this.vx;this.y+=this.vy;
            if(this.x<0||this.x>W)this.vx*=-1;
            if(this.y<0||this.y>H)this.vy*=-1;
        }
        draw(){
            ctx.beginPath();
            ctx.arc(this.x,this.y,Math.max(0.1,this.r),0,Math.PI*2);
            ctx.fillStyle='rgba(79,124,255,0.5)';
            ctx.fill();
        }
    }

    function init(){nodes=[];for(let i=0;i<COUNT;i++){nodes.push(new Node());}}
    init();

    function connect(){
        for(let i=0;i<nodes.length;i++){
            for(let j=i+1;j<nodes.length;j++){
                const dx=nodes[i].x-nodes[j].x, dy=nodes[i].y-nodes[j].y;
                const dist=Math.sqrt(dx*dx+dy*dy);
                if(dist<140){
                    ctx.beginPath();
                    ctx.moveTo(nodes[i].x,nodes[i].y);
                    ctx.lineTo(nodes[j].x,nodes[j].y);
                    ctx.strokeStyle=`rgba(79,124,255,${0.15*(1-dist/140)})`;
                    ctx.lineWidth=1;
                    ctx.stroke();
                }
            }
            if(mouse.x!=null){
                const dx=nodes[i].x-mouse.x, dy=nodes[i].y-mouse.y;
                const dist=Math.sqrt(dx*dx+dy*dy);
                if(dist<mouse.radius){
                    ctx.beginPath();
                    ctx.moveTo(nodes[i].x,nodes[i].y);
                    ctx.lineTo(mouse.x,mouse.y);
                    ctx.strokeStyle=`rgba(245,166,35,${0.4*(1-dist/mouse.radius)})`;
                    ctx.lineWidth=1.2;
                    ctx.stroke();
                    
                    ctx.beginPath();
                    ctx.arc(nodes[i].x,nodes[i].y,Math.max(0.1,nodes[i].r*2),0,Math.PI*2);
                    ctx.fillStyle='rgba(245,166,35,0.8)';
                    ctx.fill();
                }
            }
        }
    }

    function draw(){
        ctx.clearRect(0,0,W,H);
        nodes.forEach(n=>{n.update();n.draw();});
        connect();
        requestAnimationFrame(draw);
    }
    draw();

    window.addEventListener('mousemove',e=>{mouse.x=e.clientX;mouse.y=e.clientY;});
    window.addEventListener('mouseout',()=>{mouse.x=null;mouse.y=null;});
})();

// ==================== WAVE ANIMATION ====================
(function(){
    const canvas=document.getElementById('sentWave');
    const ctx=canvas.getContext('2d');
    let t=0;
    function resize(){canvas.width=canvas.offsetWidth*devicePixelRatio;canvas.height=canvas.offsetHeight*devicePixelRatio;ctx.scale(devicePixelRatio,devicePixelRatio);}
    window.addEventListener('resize',resize);resize();
    const waves=[{color:'#2ECC71',amp:22,freq:.023,speed:.032,phase:0},{color:'#E74C3C',amp:16,freq:.017,speed:.042,phase:3.3}];
    function draw(){
        const W=canvas.offsetWidth,H=canvas.offsetHeight;
        ctx.clearRect(0,0,W,H);
        waves.forEach(w=>{
            ctx.beginPath();
            for(let x=0;x<=W;x+=2){const y=H/2+Math.sin(x*w.freq+t*w.speed+w.phase)*w.amp+Math.sin(x*w.freq*2.5+t*w.speed*1.6)*(w.amp*.28);x===0?ctx.moveTo(x,y):ctx.lineTo(x,y);}
            ctx.strokeStyle=w.color;ctx.lineWidth=2;ctx.globalAlpha=.72;ctx.stroke();
            ctx.beginPath();
            for(let x=0;x<=W;x+=2){const y=H/2+Math.sin(x*w.freq+t*w.speed+w.phase)*w.amp+Math.sin(x*w.freq*2.5+t*w.speed*1.6)*(w.amp*.28);x===0?ctx.moveTo(x,y):ctx.lineTo(x,y);}
            ctx.strokeStyle=w.color;ctx.lineWidth=7;ctx.globalAlpha=.1;ctx.stroke();
            ctx.globalAlpha=1;
        });
        t++;requestAnimationFrame(draw);
    }
    draw();
})();

// ==================== COUNTER & GAUGE ====================
(function(){
    function animateNumber(el,end,duration=1400){
        let start=null;
        function step(ts){
            if(!start) start=ts;
            const p=Math.min((ts-start)/duration,1);
            const ease=1-Math.pow(1-p,3);
            el.textContent=Math.round(end*ease);
            if(p<1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }
    const observer=new IntersectionObserver(entries=>{
        entries.forEach(entry=>{
            const el=entry.target;
            if(entry.isIntersecting){
                const arc=el.querySelector('.gauge-fill');
                if(arc){
                    const full=parseFloat(arc.dataset.full);
                    const pct=parseFloat(arc.dataset.pct)/100;
                    arc.style.strokeDashoffset=full*(1-pct);
                }
                const num=el.querySelector('.gauge-num');
                if(num){animateNumber(num,parseFloat(num.dataset.target));}
                if(el.dataset.target && !el.classList.contains('gauge-num')){animateNumber(el,parseFloat(el.dataset.target),1200);}
            }else{
                const arc=el.querySelector('.gauge-fill');
                if(arc) arc.style.strokeDashoffset=arc.dataset.full;
                const num=el.querySelector('.gauge-num');
                if(num) num.textContent="0";
                if(el.dataset.target && !el.classList.contains('gauge-num')){el.textContent="0";}
            }
        });
    },{threshold:.5});
    document.querySelectorAll('.metric-card').forEach(el=>observer.observe(el));
    document.querySelectorAll('.mini-n').forEach(el=>observer.observe(el));
})();

// ==================== SCROLL REVEAL ====================
function handleReveal() {
    document.querySelectorAll('.reveal').forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight * 0.9) {
            el.classList.add('active');
        }
    });
}
window.addEventListener('scroll', handleReveal);
window.addEventListener('load', handleReveal);

// ==================== LATENCY UPDATER HELPER ====================
function updateLatency(duration) {
    const el = document.getElementById('latency-val');
    el.innerText = duration + 'ms';
    el.classList.remove('latency-flash');
    void el.offsetWidth; // Trigger reflow to restart animation
    el.classList.add('latency-flash');
}

// ==================== EMOTIONAL THEME SHIFT HELPER ====================
function applyEmotionalTheme(positive, negative) {
    document.body.classList.remove('theme-positive', 'theme-negative');
    if (positive > negative) {
        document.body.classList.add('theme-positive');
    } else if (negative > positive) {
        document.body.classList.add('theme-negative');
    }
    // Remove the class after 5 seconds to return to normal
    setTimeout(() => {
        document.body.classList.remove('theme-positive', 'theme-negative');
    }, 5000);
}

// ==================== JSON SYNTAX HIGHLIGHTER ====================
function syntaxHighlight(json) {
    if (typeof json != 'string') {
        json = JSON.stringify(json, null, 2);
    }
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        let cls = 'json-number';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'json-key';
            } else {
                cls = 'json-string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'json-boolean';
        } else if (/null/.test(match)) {
            cls = 'json-boolean';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}

// ==================== API LOGIC (TERMINAL) ====================
async function testAPI() {
    const profName = document.getElementById('prof-name').value.trim();
    const courseName = document.getElementById('course-name').value.trim();
    const resultBox = document.getElementById('api-result');

    if (!profName) {
        resultBox.style.display = 'block';
        resultBox.className = 'term-output error';
        resultBox.innerHTML = `<span style="color:#ff6b6b;">[ERROR] Parameter 'prof_name' is required.</span>`;
        return;
    }

    resultBox.style.display = 'block';
    resultBox.className = 'term-output';
    resultBox.innerHTML = `<span style="color:var(--blue);">> Establishing connection...</span><br><span style="color:var(--gold);">> Fetching data for ${profName}...</span>`;

    try {
        let url = `http://api.vahedclassifyui.ir/?prof_name=${encodeURIComponent(profName)}&course_name=${encodeURIComponent(courseName)}`;
        
        const startTime = performance.now();
        const response = await fetch(url, { method: 'GET', headers: { 'Accept': 'application/json' } });
        const endTime = performance.now();
        const duration = Math.round(endTime - startTime);
        updateLatency(duration);

        // بررسی کدهای خطای 404 و 400 (یعنی استاد یا درس پیدا نشد)
        if (!response.ok) {
            if (response.status === 404 || response.status === 400 || response.status === 422) {
                throw new Error("NOT_FOUND");
            }
            throw new Error(`HTTP Error: ${response.status}`);
        }
        
        const data = await response.json();

        const positive = data.results?.positive ?? data.positive ?? 0;
        const negative = data.results?.negative ?? data.negative ?? 0;
        const total = positive + negative;
        
        // اگه کل نظرات صفر باشه یعنی دیتاست برای این استاد خالیه
        if (total === 0) {
            resultBox.className = 'term-output error';
            resultBox.innerHTML = `<div style="font-family:'Vazirmatn',sans-serif; direction:rtl; text-align:right; color:#ff6b6b;">⚠️ فعلاً نظری برای این استاد/درس ثبت نشده است.</div>`;
            twemoji.parse(resultBox);
            return;
        }

        const percentage = total > 0 ? Math.round((positive / total) * 100) : 0;
        const prof = data.requested_professor || data.professor || profName;
        const course = data.requested_course || data.course || courseName;

        // Apply Emotional Theme
        applyEmotionalTheme(positive, negative);

        resultBox.innerHTML = `
            <div style="color:var(--green); direction: ltr; text-align: left;">> SUCCESS! Data retrieved in ${duration}ms.</div><br>
            <div style="color:var(--mid); direction: ltr; text-align: left;"> Raw JSON Response:</div>
            <pre style="background:#050810; padding:12px; border-radius:6px; margin:10px 0; font-size:0.8rem; overflow-x:auto; direction: ltr; text-align: left;">${syntaxHighlight(data)}</pre>
            <br>
            <div style="font-family:'Vazirmatn',sans-serif; font-size:1rem;">
                <div class="progress-container" style="margin-top:10px;">
                    <div class="progress-bar" style="width: ${percentage}%"></div>
                </div>
                <div style="display:flex;justify-content:space-between;">
                    <span>✅ مثبت: <strong>${positive}</strong></span>
                    <span style="color:var(--green);font-weight:700;">${percentage}%</span>
                </div>
                <div>❌ منفی: <strong>${negative}</strong></div>
            </div>
        `;
        twemoji.parse(resultBox);

    } catch (error) {
        console.error(error);
        resultBox.className = 'term-output error';
        // اگر خطای پیدا نشدن بود، پیام فارسی چاپ میشه، در غیر این صورت پیام قطع ارتباط
        if (error.message === 'NOT_FOUND') {
            resultBox.innerHTML = `<div style="font-family:'Vazirmatn',sans-serif; direction:rtl; text-align:right; color:#ff6b6b;">⚠️ فعلاً نظری برای این استاد/درس ثبت نشده است.</div>`;
        } else {
            resultBox.innerHTML = `<span style="color:#ff6b6b;">[FATAL ERROR] Connection failed.<br>Check network or parameters.</span>`;
        }
    }
}

// ==================== COMPARE LOGIC ====================
async function compareProfessors() {
    const prof1 = document.getElementById('prof1').value.trim();
    const prof2 = document.getElementById('prof2').value.trim();
    const course1 = document.getElementById('course1').value.trim();
    const course2 = document.getElementById('course2').value.trim();
    const resultDiv = document.getElementById('compare-result');

    if (!prof1 || !prof2) {
        resultDiv.style.display = 'block';
        resultDiv.innerHTML = `<div class="term-output error"><span style="color:#ff6b6b;">[ERROR] Both targets are required for comparison.</span></div>`;
        return;
    }

    resultDiv.style.display = 'block';
    resultDiv.innerHTML = `<div class="term-output"><span style="color:var(--blue);">> Running comparative analysis...</span></div>`;

    try {
        const url1 = `http://api.vahedclassifyui.ir/?prof_name=${encodeURIComponent(prof1)}&course_name=${encodeURIComponent(course1 || 'ریاضی عمومی 1')}`;
        const url2 = `http://api.vahedclassifyui.ir/?prof_name=${encodeURIComponent(prof2)}&course_name=${encodeURIComponent(course2 || 'ریاضی عمومی 1')}`;
        
        const startTime = performance.now();
        const [res1, res2] = await Promise.all([fetch(url1), fetch(url2)]);
        const endTime = performance.now();
        const duration = Math.round(endTime - startTime);
        updateLatency(duration);

        const data1 = await res1.json();
        const data2 = await res2.json();

        const pos1 = data1.results?.positive ?? 0, neg1 = data1.results?.negative ?? 0;
        const per1 = (pos1 + neg1) > 0 ? Math.round((pos1 / (pos1 + neg1)) * 100) : 0;
        const pos2 = data2.results?.positive ?? 0, neg2 = data2.results?.negative ?? 0;
        const per2 = (pos2 + neg2) > 0 ? Math.round((pos2 / (pos2 + neg2)) * 100) : 0;
        const winner = per1 > per2 ? 1 : per2 > per1 ? 2 : 0;

        // Apply Emotional Theme based on combined results
        const totalPos = pos1 + pos2;
        const totalNeg = neg1 + neg2;
        applyEmotionalTheme(totalPos, totalNeg);

        resultDiv.innerHTML = `
            <div class="compare-grid">
                <div class="compare-box ${winner===1 ? 'winner' : ''}">
                    <h4>${data1.requested_professor || prof1}</h4>
                    <small>${course1 || 'ریاضی عمومی 1'}</small>
                    <div class="progress-container"><div class="progress-bar" style="width:${per1}%"></div></div>
                    <strong style="color:var(--green);font-size:1.5rem;display:block;margin-top:10px;">${per1}%</strong>
                    <small style="color:var(--mid);">${pos1} مثبت • ${neg1} منفی</small>
                </div>
                <div class="compare-box ${winner===2 ? 'winner' : ''}">
                    <h4>${data2.requested_professor || prof2}</h4>
                    <small>${course2 || 'ریاضی عمومی 1'}</small>
                    <div class="progress-container"><div class="progress-bar" style="width:${per2}%"></div></div>
                    <strong style="color:var(--green);font-size:1.5rem;display:block;margin-top:10px;">${per2}%</strong>
                    <small style="color:var(--mid);">${pos2} مثبت • ${neg2} منفی</small>
                </div>
            </div>
            ${winner !== 0 ? 
                `<p style="text-align:center;margin-top:25px;font-size:1.2rem;color:var(--gold);font-family:'Vazirmatn',sans-serif;">🏆 استاد ${winner === 1 ? prof1 : prof2} برنده است!</p>` : 
                `<p style="text-align:center;margin-top:25px;color:var(--gold);font-family:'Vazirmatn',sans-serif;">دو استاد عملکرد مشابهی دارند.</p>`}
        `;
        twemoji.parse(resultDiv);
    } catch (err) {
        resultDiv.innerHTML = `<div class="term-output error"><span style="color:#ff6b6b;">[FATAL ERROR] Connection failed.</span></div>`;
    }
}

// ==================== BACKGROUND HEARTBEAT (AUTO PING) ====================
async function performBackgroundPing() {
    // یک نام استاد تستی برای پینگ گرفتن
    const pingUrl = `http://api.vahedclassifyui.ir/?prof_name=ping&course_name=ping`;
    try {
        const startTime = performance.now();
        // درخواست به سرور
        await fetch(pingUrl, { method: 'GET', headers: { 'Accept': 'application/json' } });
        const endTime = performance.now();
        const duration = Math.round(endTime - startTime);
        
        // آپدیت کردن عدد در نوار پایین
        updateLatency(duration);
    } catch (error) {
        // اگه اینترنت قطع بود یا سرور خاموش بود
        const el = document.getElementById('latency-val');
        if(el) el.innerText = 'Timeout';
    }
}

// اولین پینگ ۲ ثانیه بعد از لود سایت انجام بشه
setTimeout(performBackgroundPing, 2000);
// تکرار پینگ هر ۳۰ ثانیه یک‌بار
setInterval(performBackgroundPing, 30000);

</script>
</body>
</html>