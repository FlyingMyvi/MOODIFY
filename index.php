<?php
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
// index.php - Backend PHP untuk susun lagu & semak fail MP3 dalam folder moodify
$tracksData = [
    // 1. POP
    [
        "id" => 0,
        "title" => "As It Was",
        "artist" => "Harry Styles",
        "genre" => "Pop",
        "file" => "music/pop/asitwas.mp3",
        "views" => "3.2M",
        "emoji" => "✨",
        "color" => "linear-gradient(135deg, #1b1b2f, #CCCCFF)",
        "annotation" => "Genius Verified: A bittersweet synth-pop anthem about emotional isolation and transition.",
        "feedback" => [["user" => "@PopFan", "text" => "Vibes lagu ni memang tak pernah bosan!"]]
    ],
    [
        "id" => 1,
        "title" => "I Think He Knows",
        "artist" => "Taylor Swift",
        "genre" => "Pop",
        "file" => "music/pop/ithinkheknows.mp3",
        "views" => "2.1M",
        "emoji" => "💖",
        "color" => "linear-gradient(135deg, #2b1b26, #ffcce6)",
        "annotation" => "Genius Verified: Upbeat falsetto-heavy track capturing the spark of a new crush.",
        "feedback" => [["user" => "@Swiftie99", "text" => "Lover album punya hidden gem ni!"]]
    ],
    [
        "id" => 2,
        "title" => "All Too Well (10 Minute Version)",
        "artist" => "Taylor Swift",
        "genre" => "Pop",
        "file" => "music/pop/alltoowell.mp3", // Letak fail mp3 kalau ada nanti
        "views" => "4.5M",
        "emoji" => "🧣",
        "color" => "linear-gradient(135deg, #261b1b, #ffd9cc)",
        "annotation" => "Genius Verified: A lyrical masterpiece depicting emotional storytelling and heartbreak.",
        "feedback" => [["user" => "@SadGirlAutumn", "text" => "10 minit pun tak terasa lama."]]
    ],
    [
        "id" => 3,
        "title" => "Dancing On My Own",
        "artist" => "Robyn / Calum Scott",
        "genre" => "Pop",
        "file" => "music/pop/dancingonmyown.mp3",
        "views" => "2.8M",
        "emoji" => "🪩",
        "color" => "linear-gradient(135deg, #1b262b, #cce6ff)",
        "annotation" => "Genius Verified: The ultimate club heartbreak anthem.",
        "feedback" => [["user" => "@DanceVibes", "text" => "Menitis air mata dengar lagu ni."]]
    ],
    [
        "id" => 4,
        "title" => "Quit Playing Games (With My Heart)",
        "artist" => "Backstreet Boys",
        "genre" => "Pop",
        "file" => "music/pop/quitplayinggames.mp3",
        "views" => "1.9M",
        "emoji" => "🌹",
        "color" => "linear-gradient(135deg, #2a2015, #ffedd5)",
        "annotation" => "Genius Verified: 90s boyband pop perfection.",
        "feedback" => [["user" => "@RetroKing", "text" => "Nostalgia zaman 90an!"]]
    ],

    // 2. K-POP
    [
        "id" => 5,
        "title" => "The First Snow (첫 눈)",
        "artist" => "EXO",
        "genre" => "K-Pop",
        "file" => "music/kpop/thefirstsnow.mp3",
        "views" => "5.1M",
        "emoji" => "❄️",
        "color" => "linear-gradient(135deg, #16222b, #cce6ff)",
        "annotation" => "Genius Verified: EXO's iconic winter seasonal masterpiece.",
        "feedback" => [["user" => "@Exo_L", "text" => "Wajib dengar setiap kali musim salji/hujan!"]]
    ],
    [
        "id" => 6,
        "title" => "Just Us 2 (있어 희미하게)",
        "artist" => "EXO-SC",
        "genre" => "K-Pop",
        "file" => "music/kpop/exosc.mp3",
        "views" => "1.4M",
        "emoji" => "🎧",
        "color" => "linear-gradient(135deg, #1c1b2b, #e0cffc)",
        "annotation" => "Genius Verified: Chill summer hip-hop/pop vibe by Sehun & Chanyeol.",
        "feedback" => [["user" => "@Sehunnie", "text" => "Beat santai gila."]]
    ],
    [
        "id" => 7,
        "title" => "Psycho",
        "artist" => "Red Velvet",
        "genre" => "K-Pop",
        "file" => "music/kpop/redvelvetpsyhco.mp3", // Ikut ejaan tepat dalam folder kau
        "views" => "6.3M",
        "emoji" => "🦇",
        "color" => "linear-gradient(135deg, #2b1616, #ffcccc)",
        "annotation" => "Genius Verified: Dark orchestral pop hook and intricate vocal layering.",
        "feedback" => [["user" => "@ReVeluv", "text" => "Queen of velvet concept!"]]
    ],
    [
        "id" => 8,
        "title" => "So Let's Love",
        "artist" => "DAY6",
        "genre" => "K-Pop",
        "file" => "music/kpop/solet'slove.mp3", // Ikut ejaan tepat ada apostrof dalam folder kau
        "views" => "1.7M",
        "emoji" => "🎸",
        "color" => "linear-gradient(135deg, #282b16, #f2ffcc)",
        "annotation" => "Genius Verified: Melodic rock-pop anthem about holding on through hardships.",
        "feedback" => [["user" => "@MyDay", "text" => "DAY6 lagu band memang tak pernah gagal."]]
    ],
    [
        "id" => 9,
        "title" => "Blind",
        "artist" => "ENHYPEN",
        "genre" => "K-Pop",
        "file" => "music/kpop/blind.mp3",
        "views" => "2.2M",
        "emoji" => "🖤",
        "color" => "linear-gradient(135deg, #181818, #d4d4d4)",
        "annotation" => "Genius Verified: Dark atmospheric modern pop-R&B crossover.",
        "feedback" => [["user" => "@Engene", "text" => "Vocal line dia gila sedap."]]
    ],

    // 3. R&B
    [
        "id" => 10,
        "title" => "Like I Want You",
        "artist" => "Giveon",
        "genre" => "R&B",
        "file" => "music/rnb/likeiwantyou.mp3",
        "views" => "3.0M",
        "emoji" => "🤎",
        "color" => "linear-gradient(135deg, #2b221b, #fce4cc)",
        "annotation" => "Genius Verified: Deep baritone soulful R&B masterpiece.",
        "feedback" => [["user" => "@RnBFan", "text" => "Baritone voice dia smooth sangat."]]
    ],
    [
        "id" => 11,
        "title" => "I Swear I'll Never Leave Again",
        "artist" => "Keshi",
        "genre" => "R&B",
        "file" => "music/rnb/keshi.mp3",
        "views" => "2.4M",
        "emoji" => "🥀",
        "color" => "linear-gradient(135deg, #261b22, #fcdce8)",
        "annotation" => "Genius Verified: Intimate lo-fi bedroom R&B aesthetics.",
        "feedback" => [["user" => "@KeshiStan", "text" => "Lagu tidur paling best."]]
    ],
    [
        "id" => 12,
        "title" => "Best Part",
        "artist" => "Daniel Caesar & H.E.R.",
        "genre" => "R&B",
        "file" => "music/rnb/bestpart.mp3",
        "views" => "7.8M",
        "emoji" => "☀️",
        "color" => "linear-gradient(135deg, #2b2816, #fcf6cc)",
        "annotation" => "Genius Verified: Acoustic neo-soul duet classic.",
        "feedback" => [["user" => "@SoulVibes", "text" => "Aura romantik dia memang top tier."]]
    ],
    [
        "id" => 13,
        "title" => "Folded",
        "artist" => "Kehlani",
        "genre" => "R&B",
        "file" => "music/rnb/folded.mp3",
        "views" => "1.3M",
        "emoji" => "🕊️",
        "color" => "linear-gradient(135deg, #1b212b, #cce0ff)",
        "annotation" => "Genius Verified: Smooth contemporary R&B vocal delivery.",
        "feedback" => [["user" => "@KehlaniDaily", "text" => "Vocals clean gila!"]]
    ],
    [
        "id" => 14,
        "title" => "Open Arms",
        "artist" => "SZA feat. Travis Scott",
        "genre" => "R&B",
        "file" => "music/rnb/openarms.mp3",
        "views" => "4.2M",
        "emoji" => "🌅",
        "color" => "linear-gradient(135deg, #2b1b22, #ffd6e0)",
        "annotation" => "Genius Verified: Ethereal and vulnerable modern R&B collaboration.",
        "feedback" => [["user" => "@SzaUpdate", "text" => "Collab SZA & Travis selalu on point."]]
    ],

    // 4. HIP HOP
    [
        "id" => 15,
        "title" => "Ingat",
        "artist" => "Alyph",
        "genre" => "Hip-Hop",
        "file" => "music/hiphop/ingat.mp3",
        "views" => "2.5M",
        "emoji" => "🔥",
        "color" => "linear-gradient(135deg, #2b1b1b, #ffcccc)",
        "annotation" => "Genius Verified: Southeast Asian hip-hop/R&B fusion hit with catchy hooks.",
        "feedback" => [["user" => "@MalaysianHipHop", "text" => "Alyph beat memang selalu power!"]]
    ],
    [
        "id" => 16,
        "title" => "I KNOW ?",
        "artist" => "Travis Scott",
        "genre" => "Hip-Hop",
        "file" => "music/hiphop/iknow.mp3",
        "views" => "8.9M",
        "emoji" => "🌵",
        "color" => "linear-gradient(135deg, #211b2b, #e2ccff)",
        "annotation" => "Genius Verified: Standout hypnotic trap production from Utopia.",
        "feedback" => [["user" => "@TravisFan", "text" => "Utopia album punya highlight ni."]]
    ],
    [
        "id" => 17,
        "title" => "Lose My Mind",
        "artist" => "Don Toliver feat. Doja Cat",
        "genre" => "Hip-Hop",
        "file" => "music/hiphop/losemymind.mp3",
        "views" => "3.6M",
        "emoji" => "🌀",
        "color" => "linear-gradient(135deg, #1b2b2b, #ccfffa)",
        "annotation" => "Genius Verified: Melodic rap rhythm and atmospheric synth melodies.",
        "feedback" => [["user" => "@RapCaviar", "text" => "Vibe driving malam."]]
    ],
    [
        "id" => 18,
        "title" => "Psycho",
        "artist" => "Post Malone feat. Ty Dolla \$ign",
        "genre" => "Hip-Hop",
        "file" => "music/hiphop/psychopost.mp3",
        "views" => "9.2M",
        "emoji" => "💊",
        "color" => "linear-gradient(135deg, #2b2416, #ffeacc)",
        "annotation" => "Genius Verified: Laid-back trap beat paired with melodic cadence.",
        "feedback" => [["user" => "@PostyNation", "text" => "Classic timeless banger."]]
    ],
    [
        "id" => 19,
        "title" => "luther",
        "artist" => "Kendrick Lamar & SZA",
        "genre" => "Hip-Hop",
        "file" => "music/hiphop/luther.mp3",
        "views" => "6.7M",
        "emoji" => "👑",
        "color" => "linear-gradient(135deg, #1b1b2b, #ccccff)",
        "annotation" => "Genius Verified: Soul-sampled lyrical hip-hop mastery.",
        "feedback" => [["user" => "@KendrickStan", "text" => "Lagu ni punya sample memang gila sedap."]]
    ]
];

// PHP menyemak sama ada fail .mp3 wujud dalam folder server
foreach ($tracksData as &$track) {
    $track['exists'] = file_exists(__DIR__ . '/' . $track['file']);
}
unset($track);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Cache-Control" content="no-store" />
  <meta http-equiv="Pragma" content="no-cache" />
  <title>MOODIFY - Music Player</title>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@800&display=swap" rel="stylesheet" />
  <style>
    :root {
      --bg-black: #000000;
      --bg-panel: #08080C;
      --bg-surface: #111118;
      --bg-elevated: #1A1A24;
      --accent-pop: #CCCCFF;
      --accent-glow: rgba(204, 204, 255, 0.35);
      --border-subtle: rgba(204, 204, 255, 0.16);
      --text-primary: #FFFFFF;
      --text-secondary: #9E9EB5;
      --text-on-accent: #050508;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "Segoe UI", Roboto, sans-serif;
    }

    body {
      background-color: var(--bg-black);
      color: var(--text-primary);
      height: 100vh;
      display: grid;
      grid-template-columns: 245px 1fr 320px;
      grid-template-areas: "sidebar main queue";
      overflow: hidden;
    }

    /* ================= LEFT SIDEBAR ================= */
    .sidebar {
      grid-area: sidebar;
      background-color: var(--bg-panel);
      border-right: 1px solid var(--border-subtle);
      display: flex;
      flex-direction: column;
      padding: 20px 14px;
      gap: 18px;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      font-size: 18px;
      padding: 0 8px;
      color: var(--accent-pop);
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    .brand-orb {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: var(--accent-pop);
      box-shadow: 0 0 16px var(--accent-pop);
    }

    .nav-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 12px;
      border-radius: 10px;
      color: var(--text-secondary);
      font-weight: 600;
      font-size: 13px;
      cursor: pointer;
      transition: all 0.2s;
      border: 1px solid transparent;
    }

    .nav-item:hover, .nav-item.active {
      background-color: var(--bg-elevated);
      color: var(--accent-pop);
      border-color: rgba(204, 204, 255, 0.25);
    }

    .library-section {
      flex: 1;
      overflow-y: auto;
      border-top: 1px solid var(--border-subtle);
      padding-top: 14px;
    }

    .library-title {
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1.2px;
      color: var(--text-secondary);
      padding: 0 10px 10px;
      font-weight: 700;
    }

    .lib-item {
      display: flex;
      align-items: center;
      gap: 11px;
      padding: 8px 10px;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.2s;
      margin-bottom: 4px;
    }

    .lib-item:hover, .lib-item.selected {
      background-color: var(--bg-surface);
      box-shadow: inset 0 0 0 1px rgba(204, 204, 255, 0.25);
    }

    .lib-thumb {
      width: 40px;
      height: 40px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      border: 1px solid rgba(204, 204, 255, 0.3);
      background-color: var(--bg-elevated);
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .lib-thumb.genre-pop {
      background-image: url("https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=240&q=80");
    }

    .lib-thumb.genre-kpop {
      background-image: url("https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=240&q=80");
    }

    .lib-thumb.genre-rnb {
      background-image: url("https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=240&q=80");
    }

    .lib-thumb.genre-hiphop {
      background-image: url("https://images.unsplash.com/photo-1519608487953-e999c86e7455?auto=format&fit=crop&w=240&q=80");
    }

    .lib-info h4 { font-size: 13px; font-weight: 700; }
    .lib-info p { font-size: 11px; color: var(--text-secondary); }

    /* ================= MAIN VIEW ================= */
    .main-view {
      grid-area: main;
      background-color: var(--bg-black);
      background-image: 
        radial-gradient(circle at 15% 10%, rgba(204, 204, 255, 0.14), transparent 40%),
        linear-gradient(rgba(204, 204, 255, 0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(204, 204, 255, 0.03) 1px, transparent 1px);
      background-size: 100% 100%, 36px 36px, 36px 36px;
      overflow-y: auto;
      padding: 22px 26px 130px;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 14px;
      margin-bottom: 20px;
    }

    .mode-switcher {
      display: flex;
      background: var(--bg-surface);
      padding: 4px;
      border-radius: 500px;
      border: 1px solid var(--border-subtle);
    }

    .mode-btn {
      background: none;
      border: none;
      color: var(--text-secondary);
      padding: 7px 16px;
      border-radius: 500px;
      font-size: 12px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s;
    }

    .mode-btn.active {
      background: var(--accent-pop);
      color: var(--text-on-accent);
      box-shadow: 0 0 14px var(--accent-glow);
    }

    .search-box {
      background-color: var(--bg-surface);
      border: 1px solid var(--border-subtle);
      border-radius: 500px;
      padding: 8px 16px;
      color: var(--text-primary);
      width: 240px;
      font-size: 12px;
      outline: none;
    }

    .search-box:focus { border-color: var(--accent-pop); }

    .futuristic-hero {
      background: linear-gradient(125deg, rgba(204, 204, 255, 0.16), rgba(17, 17, 24, 0.92));
      border: 1px solid rgba(204, 204, 255, 0.3);
      border-radius: 16px;
      padding: 20px 24px;
      margin-bottom: 22px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.7), inset 0 0 24px rgba(204, 204, 255, 0.08);
    }

    .hero-tag {
      display: inline-block;
      font-size: 10px;
      font-weight: 800;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: var(--text-on-accent);
      background: var(--accent-pop);
      padding: 3px 10px;
      border-radius: 4px;
      margin-bottom: 8px;
    }

    .futuristic-hero h1 { font-size: 22px; font-weight: 800; margin-bottom: 4px; }
    .futuristic-hero p { font-size: 12px; color: var(--text-secondary); }

    .hero-play-btn {
      background: var(--accent-pop);
      color: var(--text-on-accent);
      border: none;
      padding: 11px 22px;
      border-radius: 500px;
      font-weight: 800;
      font-size: 13px;
      cursor: pointer;
      box-shadow: 0 0 20px var(--accent-glow);
      transition: transform 0.2s;
    }

    .hero-play-btn:hover { transform: scale(1.05); }

    .filter-pills { display: flex; gap: 8px; margin-bottom: 20px; }

    .pill {
      background-color: var(--bg-surface);
      color: var(--text-primary);
      border: 1px solid var(--border-subtle);
      padding: 6px 16px;
      border-radius: 500px;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
    }

    .pill.active, .pill:hover {
      background-color: var(--accent-pop);
      color: var(--text-on-accent);
      border-color: var(--accent-pop);
      font-weight: 700;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 22px 0 14px;
    }

    .section-header h2 { font-size: 18px; font-weight: 800; letter-spacing: -0.2px; }
    .section-sub { font-size: 11px; color: var(--accent-pop); text-transform: uppercase; letter-spacing: 1px; font-weight: 700; }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(165px, 1fr));
      gap: 16px;
    }

    .card {
      background-color: var(--bg-surface);
      border: 1px solid rgba(204, 204, 255, 0.12);
      padding: 13px;
      border-radius: 14px;
      cursor: pointer;
      transition: all 0.25s ease;
      position: relative;
    }

    .card:hover {
      background-color: var(--bg-elevated);
      border-color: var(--accent-pop);
      transform: translateY(-4px);
      box-shadow: 0 10px 24px rgba(204, 204, 255, 0.15);
    }

    .card-art {
      width: 100%;
      aspect-ratio: 1 / 1;
      border-radius: 10px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 34px;
      position: relative;
      overflow: hidden;
    }

    .card-art > img,
    .queue-thumb > img,
    .apple-now-art > img,
    .lcd-art > img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: inherit;
      z-index: 1;
    }

    .card-art .status-badge,
    .card-art .spotify-fab { z-index: 2; }

    .queue-thumb,
    .apple-now-art,
    .lcd-art {
      position: relative;
      overflow: hidden;
    }

    .status-badge {
      position: absolute;
      top: 8px;
      left: 8px;
      font-size: 9px;
      font-weight: 800;
      padding: 3px 7px;
      border-radius: 6px;
      text-transform: uppercase;
    }
    .status-ready { background: rgba(74, 222, 128, 0.2); color: #4ade80; border: 1px solid rgba(74, 222, 128, 0.4); }
    .status-missing { background: rgba(248, 113, 113, 0.2); color: #f87171; border: 1px solid rgba(248, 113, 113, 0.4); }

    .spotify-fab {
      position: absolute;
      bottom: 8px;
      right: 8px;
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background-color: var(--accent-pop);
      color: var(--text-on-accent);
      border: none;
      font-size: 15px;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      opacity: 0;
      transform: translateY(6px);
      transition: all 0.2s;
    }

    .card:hover .spotify-fab { opacity: 1; transform: translateY(0); }
    .card h3 { font-size: 14px; font-weight: 700; margin-bottom: 3px; }
    .card p { font-size: 11px; color: var(--text-secondary); }

    /* ================= GENIUS CHARTS + FEEDBACK ================= */
    .genius-split { display: grid; grid-template-columns: 1.1fr 1fr; gap: 16px; margin-top: 10px; }
    .genius-box { background: var(--bg-surface); border: 1px solid var(--border-subtle); border-radius: 14px; padding: 16px; }
    .genius-box-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid rgba(255, 255, 255, 0.08); }
    .genius-pill { background: rgba(204, 204, 255, 0.15); color: var(--accent-pop); font-size: 10px; font-weight: 800; padding: 3px 8px; border-radius: 4px; letter-spacing: 0.8px; }
    .chart-row { display: flex; align-items: center; justify-content: space-between; padding: 8px 6px; border-radius: 8px; cursor: pointer; transition: background 0.15s; }
    .chart-row:hover { background: var(--bg-elevated); }
    .chart-left { display: flex; align-items: center; gap: 10px; }
    .chart-rank { font-weight: 800; font-size: 14px; color: var(--accent-pop); width: 20px; }
    .chart-meta h4 { font-size: 13px; font-weight: 700; }
    .chart-meta span { font-size: 11px; color: var(--text-secondary); }
    .chart-views { font-size: 11px; color: var(--accent-pop); font-weight: 600; }
    .annotation-card { background: rgba(204, 204, 255, 0.08); border-left: 3px solid var(--accent-pop); padding: 10px 12px; border-radius: 6px; font-size: 12px; line-height: 1.45; margin-bottom: 12px; color: #E6E6FA; }
    .feedback-list { max-height: 130px; overflow-y: auto; display: flex; flex-direction: column; gap: 8px; margin-bottom: 10px; }
    .feedback-item { background: var(--bg-black); border: 1px solid rgba(255, 255, 255, 0.07); padding: 8px 10px; border-radius: 8px; font-size: 12px; }
    .feedback-item strong { color: var(--accent-pop); font-size: 11px; }
    .feedback-form { display: flex; gap: 6px; }
    .feedback-input { flex: 1; background: var(--bg-black); border: 1px solid var(--border-subtle); border-radius: 8px; padding: 7px 10px; color: #fff; font-size: 12px; outline: none; }
    .feedback-btn { background: var(--accent-pop); color: var(--text-on-accent); border: none; border-radius: 8px; padding: 0 12px; font-weight: 700; font-size: 12px; cursor: pointer; }

    /* ================= LIVE LYRICS VIEW ================= */
    .lyrics-container {
      display: none;
      background: linear-gradient(160deg, rgba(204, 204, 255, 0.16), #08080C 65%);
      border: 1px solid rgba(204, 204, 255, 0.25);
      border-radius: 18px;
      padding: 28px;
      min-height: 440px;
    }
    .lyrics-container.active { display: block; }
    .lyrics-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; }
    .lyric-line { font-size: 20px; font-weight: 800; color: rgba(255, 255, 255, 0.35); margin-bottom: 14px; transition: all 0.3s ease; cursor: pointer; }
    .lyric-line.current { color: var(--accent-pop); transform: scale(1.02); text-shadow: 0 0 18px rgba(204, 204, 255, 0.45); }
    .lyrics-header-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; justify-content: flex-end; }
    .lyric-offset { display: flex; align-items: center; gap: 6px; }
    .lyric-offset .pill { padding: 5px 10px; font-size: 11px; }
    .lyric-offset button:disabled { opacity: .4; cursor: not-allowed; }
    #lyricOffsetLabel { font-size: 11px; color: var(--text-secondary); min-width: 72px; text-align: center; }

    /* ================= RIGHT QUEUE PANEL ================= */
    .apple-queue-panel {
      grid-area: queue;
      background-color: var(--bg-panel);
      border-left: 1px solid var(--border-subtle);
      padding: 20px 16px 120px;
      display: flex;
      flex-direction: column;
      overflow-y: auto;
    }
    .queue-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
    .queue-header h3 { font-size: 15px; font-weight: 700; }
    .queue-badge { font-size: 10px; background: rgba(204, 204, 255, 0.14); color: var(--accent-pop); border: 1px solid rgba(204, 204, 255, 0.3); padding: 3px 9px; border-radius: 6px; font-weight: 700; }
    .apple-now-card { background: linear-gradient(145deg, #181822, #0C0C12); border: 1px solid var(--accent-pop); border-radius: 14px; padding: 14px; margin-bottom: 20px; box-shadow: 0 8px 24px rgba(204, 204, 255, 0.14); }
    .apple-now-label { font-size: 10px; text-transform: uppercase; letter-spacing: 1.2px; color: var(--accent-pop); font-weight: 700; margin-bottom: 10px; display: flex; align-items: center; gap: 6px; }
    .pulse-dot { width: 7px; height: 7px; border-radius: 50%; background-color: var(--accent-pop); box-shadow: 0 0 10px var(--accent-pop); }
    .apple-now-row { display: flex; align-items: center; gap: 12px; }
    .apple-now-art { width: 52px; height: 52px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
    .apple-now-meta h4 { font-size: 14px; font-weight: 700; color: var(--accent-pop); margin-bottom: 2px; }
    .apple-now-meta p { font-size: 11px; color: var(--text-secondary); }
    .next-list-label { font-size: 11px; font-weight: 700; color: var(--text-secondary); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.9px; }
    .queue-list { display: flex; flex-direction: column; gap: 6px; }
    .queue-item { display: flex; align-items: center; justify-content: space-between; padding: 8px 10px; border-radius: 10px; cursor: pointer; border: 1px solid transparent; transition: all 0.2s; }
    .queue-item:hover { background-color: var(--bg-surface); border-color: rgba(204, 204, 255, 0.25); }
    .queue-item-left { display: flex; align-items: center; gap: 10px; overflow: hidden; }
    .queue-thumb { width: 36px; height: 36px; border-radius: 7px; display: flex; align-items: center; justify-content: center; font-size: 15px; flex-shrink: 0; }
    .queue-text h5 { font-size: 12px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .queue-text span { font-size: 10px; color: var(--text-secondary); }

    /* ================= FLOATING PLAYER DOCK ================= */
    .apple-player-dock {
      position: fixed;
      bottom: 16px;
      left: 50%;
      transform: translateX(-50%);
      width: min(880px, calc(100% - 40px));
      height: 74px;
      background: rgba(12, 12, 18, 0.85);
      backdrop-filter: blur(22px);
      -webkit-backdrop-filter: blur(22px);
      border: 1px solid rgba(204, 204, 255, 0.28);
      border-radius: 18px;
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.85), 0 0 24px rgba(204, 204, 255, 0.12);
      display: grid;
      grid-template-columns: 170px 1fr 140px;
      align-items: center;
      padding: 0 18px;
      z-index: 100;
    }
    .apple-controls { display: flex; align-items: center; gap: 14px; }
    .am-btn { background: none; border: none; color: var(--text-primary); font-size: 17px; cursor: pointer; transition: color 0.15s, transform 0.15s; }
    .am-btn:hover { color: var(--accent-pop); transform: scale(1.1); }
    .am-play-btn { width: 38px; height: 38px; border-radius: 50%; background-color: var(--accent-pop); color: var(--text-on-accent); border: none; font-size: 15px; font-weight: bold; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 0 16px rgba(204, 204, 255, 0.45); }
    .apple-lcd-pill { background-color: #050508; border: 1px solid rgba(204, 204, 255, 0.2); border-radius: 10px; height: 52px; display: flex; align-items: center; padding: 0 12px; gap: 12px; }
    .lcd-art { width: 36px; height: 36px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 17px; }
    .lcd-center { flex: 1; display: flex; flex-direction: column; gap: 4px; }
    .lcd-title-row { display: flex; justify-content: space-between; font-size: 12px; }
    .lcd-title-row strong { color: var(--accent-pop); }
    .lcd-title-row span { color: var(--text-secondary); font-size: 11px; }
    .lcd-scrubber { display: flex; align-items: center; gap: 8px; font-size: 10px; color: var(--text-secondary); }
    input[type="range"] { -webkit-appearance: none; appearance: none; background: rgba(204, 204, 255, 0.22); height: 4px; border-radius: 4px; cursor: pointer; }
    input[type="range"]::-webkit-slider-thumb { -webkit-appearance: none; width: 11px; height: 11px; border-radius: 50%; background: var(--accent-pop); }
    .lcd-progress { flex: 1; }
    .apple-volume { display: flex; align-items: center; justify-content: flex-end; gap: 8px; color: var(--accent-pop); font-size: 13px; }
    .apple-volume input { width: 72px; }
    .player-notice {
      position: fixed;
      left: 50%;
      bottom: 100px;
      transform: translateX(-50%) translateY(8px);
      background: var(--bg-elevated);
      color: var(--text-primary);
      border: 1px solid var(--accent-pop);
      border-radius: 12px;
      padding: 10px 16px;
      font-size: 13px;
      font-weight: 600;
      z-index: 300;
      opacity: 0;
      pointer-events: none;
      transition: opacity .2s, transform .2s;
      max-width: calc(100% - 32px);
      text-align: center;
    }
    .player-notice.show { opacity: 1; transform: translateX(-50%) translateY(0); }
  </style>
<link rel="stylesheet" href="logo.css" />
</head>
<body>

  <!-- LEFT SIDEBAR -->
  <aside class="sidebar">
    <a href="index.html" class="moodify-logo moodify-logo-sm">MOODI<span>FY</span></a>

    <div class="nav-group">
      <div class="nav-item active" id="navHome" onclick="window.switchMainView('home')">Futuristic Home</div>
      <div class="nav-item" id="navLyrics" onclick="window.switchMainView('lyrics')">MOODIFY Live Lyrics</div>
    </div>

    <div class="library-section">
      <div class="library-title">Playlists by Genre</div>
      <div id="sidebarLibrary"></div>
    </div>
  </aside>

  <!-- CENTER VIEW -->
  <main class="main-view">
    <div class="topbar">
      <div class="mode-switcher">
        <button class="mode-btn active" id="tabHomeBtn" onclick="window.switchMainView('home')">Home & Charts</button>
        <button class="mode-btn" id="tabLyricsBtn" onclick="window.switchMainView('lyrics')">Live Lyrics</button>
      </div>
      <input type="text" id="searchInput" class="search-box" placeholder="Search Pop, K-Pop, R&B, Hip-Hop..." oninput="window.filterTracks()" />
    </div>

    <!-- VIEW 1: HOME -->
    <div id="homeView">
      <div class="futuristic-hero">
        <div>
          <span class="hero-tag">PHP + HTML5 AUDIO ENGINE</span>
          <h1 id="heroTitle">Pop Future Mix</h1>
          <p id="heroSubtitle">Klik mana-mana kad lagu untuk mainkan fail MP3 dari folder tempatan anda.</p>
        </div>
        <button class="hero-play-btn" onclick="window.playCurrentGenre()">▶ Stream Playlist</button>
      </div>

      <div class="filter-pills">
        <button class="pill active" onclick="window.setGenreFilter('Pop')">Pop</button>
        <button class="pill" onclick="window.setGenreFilter('K-Pop')">K-Pop</button>
        <button class="pill" onclick="window.setGenreFilter('R&B')">R&B</button>
        <button class="pill" onclick="window.setGenreFilter('Hip-Hop')">Hip-Hop</button>
      </div>

      <div class="section-header">
        <h2 id="feedHeading">Pop Playlists & Tracks</h2>
        <span class="section-sub">Local MP3 Library</span>
      </div>
      <div class="card-grid" id="spotifyCardGrid"></div>

      <div class="section-header">
        <h2>Genius Charts & Lyric Feedback</h2>
        <span class="section-sub">Verified Annotations</span>
      </div>
      <div class="genius-split">
        <div class="genius-box">
          <div class="genius-box-header">
            <strong style="font-size: 13px;">Trending Top Charts</strong>
            <span class="genius-pill">GENIUS CHARTS</span>
          </div>
          <div id="geniusChartList"></div>
        </div>

        <div class="genius-box">
          <div class="genius-box-header">
            <strong style="font-size: 13px;" id="annotationTrackTitle">Lyric Meaning & Feedback</strong>
            <span class="genius-pill">VERIFIED</span>
          </div>
          <div class="annotation-card" id="geniusAnnotationText"></div>
          <div class="feedback-list" id="feedbackList"></div>
          <form class="feedback-form" onsubmit="window.addFeedback(event)">
            <input type="text" id="feedbackInput" class="feedback-input" placeholder="Drop your review or lyric breakdown..." required />
            <button type="submit" class="feedback-btn">Post</button>
          </form>
        </div>
      </div>
    </div>

    <!-- VIEW 2: LIVE LYRICS -->
    <div id="lyricsView" class="lyrics-container">
      <div class="lyrics-header">
        <div>
          <span class="hero-tag">MOODIFY REAL-TIME LYRICS</span>
          <h2 id="lyricsSongTitle" style="font-size: 22px; margin-top: 6px;">Loading...</h2>
        </div>
        <div class="lyrics-header-actions">
          <div class="lyric-offset">
            <button type="button" class="pill" onclick="window.adjustLyricOffset(-0.5)" title="Show lyrics later">-0.5s</button>
            <span id="lyricOffsetLabel">Sync 0.0s</span>
            <button type="button" class="pill" onclick="window.adjustLyricOffset(0.5)" title="Show lyrics earlier">+0.5s</button>
          </div>
          <button class="pill active" onclick="window.switchMainView('home')">← Back to Home</button>
        </div>
      </div>
      <div id="lyricsLinesBox"></div>
    </div>
  </main>

  <!-- RIGHT QUEUE PANEL -->
  <aside class="apple-queue-panel">
    <div class="queue-header">
      <h3>Playing Next</h3>
      <span class="queue-badge">MOODIFY Queue</span>
    </div>

    <div class="apple-now-card">
      <div class="apple-now-label">
        <div class="pulse-dot"></div>
        <span>Current Playing</span>
      </div>
      <div class="apple-now-row">
        <div class="apple-now-art" id="queueNowArt">✨</div>
        <div class="apple-now-meta">
          <h4 id="queueNowTitle">As It Was</h4>
          <p id="queueNowArtist">Harry Styles • Pop</p>
        </div>
      </div>
    </div>

    <div class="next-list-label">Next in Queue</div>
    <div class="queue-list" id="appleQueueList"></div>
  </aside>

  <div id="playerNotice" class="player-notice"></div>

  <!-- FLOATING PLAYER DOCK -->
  <div class="apple-player-dock">
    <div class="apple-controls">
      <button class="am-btn" onclick="window.prevTrack()" title="Previous">⏮</button>
      <button class="am-play-btn" id="playPauseBtn" onclick="window.togglePlay()">▶</button>
      <button class="am-btn" onclick="window.nextTrack()" title="Next">⏭</button>
    </div>

    <div class="apple-lcd-pill">
      <div class="lcd-art" id="lcdArt">✨</div>
      <div class="lcd-center">
        <div class="lcd-title-row">
          <strong id="lcdTitle">As It Was</strong>
          <span id="lcdArtist">Harry Styles — Pop</span>
        </div>
        <div class="lcd-scrubber">
          <span id="currentTime">0:00</span>
          <input type="range" id="progressBar" class="lcd-progress" value="0" min="0" max="100" oninput="window.seekTrack(this.value)" />
          <span id="totalTime">0:00</span>
        </div>
      </div>
    </div>

    <div class="apple-volume">
      <span>🔉</span>
      <input type="range" id="volumeSlider" min="0" max="1" step="0.01" value="0.7" oninput="window.setVolume(this.value)" />
    </div>
  </div>

  <!-- ELEMEN AUDIO HTML5 SEBENAR -->
  <audio id="realAudioPlayer" preload="metadata"></audio>

  <script src="lyrics-timed.js?v=3"></script>

  <script type="module">
    // Cuba import lyrics.js kalau wujud, kalau ada ralat sintaks dalam lyrics.js dia guna fallback supaya player tak rosak
    let songLyricsDatabase = {};
    try {
      await import('./lyrics.js');
      songLyricsDatabase = window.songLyricsDatabase || {};
    } catch (err) {
      console.warn("Amaran: Fail lyrics.js ada ralat sintaks (cth: baris tak ada tanda petik). Sila pastikan setiap baris lirik ada tanda petik \"...\".", err);
    }

    // Terima data lagu dari PHP
    const tracks = <?php echo json_encode($tracksData, JSON_UNESCAPED_UNICODE); ?>;

    // Local artwork downloaded by image.php (MOODIFY_IMAGES/songs)
    const coverArtByTrackId = [
      "MOODIFY_IMAGES/songs/01_as_it_was.jpg",
      "MOODIFY_IMAGES/songs/02_i_think_he_knows.jpg",
      "MOODIFY_IMAGES/songs/03_all_too_well_10_min.jpg",
      "MOODIFY_IMAGES/songs/04_dancing_on_my_own.jpg",
      "MOODIFY_IMAGES/songs/05_quit_playing_games.jpg",
      "MOODIFY_IMAGES/songs/06_the_first_snow.jpg",
      "MOODIFY_IMAGES/songs/07_just_us_2.jpg",
      "MOODIFY_IMAGES/songs/08_psycho_red_velvet.jpg",
      "MOODIFY_IMAGES/songs/09_so_lets_love.jpg",
      "MOODIFY_IMAGES/songs/10_blind.jpg",
      "MOODIFY_IMAGES/songs/11_like_i_want_you.jpg",
      "MOODIFY_IMAGES/songs/12_i_swear_ill_never_leave_again.jpg",
      "MOODIFY_IMAGES/songs/13_best_part.jpg",
      "MOODIFY_IMAGES/songs/14_folded.jpg",
      "MOODIFY_IMAGES/songs/15_open_arms.jpg",
      "MOODIFY_IMAGES/songs/16_ingat.jpg",
      "MOODIFY_IMAGES/songs/17_i_know.jpg",
      "MOODIFY_IMAGES/songs/18_lose_my_mind.jpg",
      "MOODIFY_IMAGES/songs/19_psycho_post_malone.jpg",
      "MOODIFY_IMAGES/songs/20_luther.jpg"
    ];

    tracks.forEach(track => {
      track.art = coverArtByTrackId[track.id] || '';
    });

    function coverMarkup(track) {
      if (!track.art) return '';
      const alt = String(track.title).replace(/"/g, '&quot;') + ' cover';
      return `<img src="${track.art}" alt="${alt}" loading="lazy" onerror="this.remove()">`;
    }

    function setArtwork(element, track) {
      element.innerHTML = `<span>${track.emoji}</span>${coverMarkup(track)}`;
      element.style.background = track.color;
    }

    const genres = [
      { name: "Pop", desc: "Futuristic synth & vocal hits", imageClass: "genre-pop" },
      { name: "K-Pop", desc: "Seoul stadium anthems", imageClass: "genre-kpop" },
      { name: "R&B", desc: "Smooth midnight neo-soul", imageClass: "genre-rnb" },
      { name: "Hip-Hop", desc: "Heavy 808s & lyrical flow", imageClass: "genre-hiphop" }
    ];

    let activeGenre = "Pop";
    let currentTrackIndex = 0;
    let isPlaying = false;

    // Synced lyrics state
    let currentTimedLyrics = null;
    let currentTimedMode = false;
    let lyricOffset = 0;
    let activeTimedIndex = -1;
    const LYRIC_OFFSET_KEY = 'moodify_php_lyric_offsets';
    let lyricOffsets = JSON.parse(localStorage.getItem(LYRIC_OFFSET_KEY) || '{}');
    const timedKeyByTrack = {
      0: 0, 1: 1, 2: 9, 3: 2, 4: 10,
      5: 8, 6: 5, 7: 6, 8: 7, 9: 3, 10: 4,
      11: 11, 12: 12, 13: 13, 14: 14, 15: 15,
      16: 16, 17: 17, 18: 18, 19: 19
    };

    const audio = document.getElementById('realAudioPlayer');
    audio.volume = 0.7;

    function formatTime(sec) {
      if (isNaN(sec) || !isFinite(sec)) return "0:00";
      const m = Math.floor(sec / 60);
      const s = Math.floor(sec % 60);
      return `${m}:${s < 10 ? '0' : ''}${s}`;
    }

    let noticeTimer = null;
    function showNotice(text) {
      const el = document.getElementById('playerNotice');
      if (!el) { console.warn(text); return; }
      el.textContent = text;
      el.classList.add('show');
      clearTimeout(noticeTimer);
      noticeTimer = setTimeout(() => el.classList.remove('show'), 3500);
    }

    // Event Listeners untuk HTML5 Audio sebenar
    audio.addEventListener('loadedmetadata', () => {
      document.getElementById('totalTime').textContent = formatTime(audio.duration);
      document.getElementById('progressBar').max = Math.floor(audio.duration);
    });

    audio.addEventListener('timeupdate', () => {
      document.getElementById('progressBar').value = Math.floor(audio.currentTime);
      document.getElementById('currentTime').textContent = formatTime(audio.currentTime);
      if (currentTimedMode) updateTimedHighlight();
      else renderLiveLyrics();
    });

    audio.addEventListener('ended', () => {
      window.nextTrack();
    });

    audio.addEventListener('error', () => {
      const t = tracks[currentTrackIndex];
      showNotice(t ? `"${t.file}" is not available yet.` : 'Audio is not available.');
      isPlaying = false;
      document.getElementById('playPauseBtn').textContent = '▶';
    });

    async function syncTrackExistence() {
      if (window.location.protocol === 'file:') return false;

      let changed = false;
      await Promise.all(tracks.map(async (track) => {
        const previous = track.exists;
        try {
          const response = await fetch(encodeURI(track.file), {
            method: 'HEAD',
            cache: 'no-store'
          });
          track.exists = response.ok;
        } catch (err) {
          track.exists = false;
        }
        if (track.exists !== previous) changed = true;
      }));
      return changed;
    }

    function getRequestedTrackId() {
      const raw = new URLSearchParams(window.location.search).get('play');
      if (raw === null || raw === '') return null;
      const id = Number(raw);
      return Number.isInteger(id) && id >= 0 && id < tracks.length ? id : null;
    }

    function playRequestedTrack(id) {
      if (id === null) return false;
      const track = tracks[id];
      if (!track) return false;
      if (!track.exists) {
        showNotice(`"${track.title}" has no MP3 yet.`);
        return false;
      }
      if (activeGenre !== track.genre) {
        window.setGenreFilter(track.genre);
      }
      loadTrackSource(id, true);
      return true;
    }

    function initApp() {
      renderSidebarLibrary();
      renderGenreCards(activeGenre);
      updateGeniusSection();
      updateAppleQueue();

      const requestedId = getRequestedTrackId();
      if (!playRequestedTrack(requestedId)) {
        loadTrackSource(0, false);
      }

      if (window.location.hash === '#lyrics') {
        window.switchMainView('lyrics');
      }

      syncTrackExistence().then((changed) => {
        if (!changed) return;
        renderSidebarLibrary();
        renderGenreCards(activeGenre);
        updateGeniusSection();
        updateAppleQueue();
        if (requestedId !== null && tracks[requestedId] && tracks[requestedId].exists && currentTrackIndex !== requestedId) {
          loadTrackSource(requestedId, true);
        }
      });
    }

    function loadTrackSource(id, autoPlay = true) {
      const t = tracks[id];
      if (!t || !t.exists) {
        if (t) showNotice(`"${t.title}" has no MP3 yet.`);
        return;
      }

      currentTrackIndex = id;
      // Guna encodeURIComponent supaya simbol seperti apostrof dalam solet'slove.mp3 dibaca dengan selamat
      audio.src = encodeURI(t.file);
      updatePlayerDockMeta();
      updateGeniusSection();
      updateAppleQueue();
      renderLiveLyrics();

      if (autoPlay) {
        audio.play().then(() => {
          isPlaying = true;
          document.getElementById('playPauseBtn').textContent = '❚❚';
        }).catch(err => {
          console.error("Gagal mainkan audio:", err);
          isPlaying = false;
          document.getElementById('playPauseBtn').textContent = '▶';
          showNotice(`Press ▶ to play "${t.title}".`);
        });
      }
    }

    function renderSidebarLibrary() {
      const container = document.getElementById("sidebarLibrary");
      container.innerHTML = genres.map(g => `
        <div class="lib-item ${g.name === activeGenre ? 'selected' : ''}" onclick="window.setGenreFilter('${g.name}')">
          <div class="lib-thumb ${g.imageClass}" aria-hidden="true"></div>
          <div class="lib-info">
            <h4>${g.name} Mix</h4>
            <p>${g.desc}</p>
          </div>
        </div>
      `).join('');
    }

    window.setGenreFilter = function(genreName) {
      activeGenre = genreName;
      document.querySelectorAll('.filter-pills .pill').forEach(p => {
        p.classList.toggle('active', p.textContent.trim() === genreName);
      });
      document.getElementById('feedHeading').textContent = `${genreName} Playlists & Tracks`;
      document.getElementById('heroTitle').textContent = `${genreName} Future Mix`;
      renderSidebarLibrary();
      renderGenreCards(genreName);
    };

    function renderGenreCards(genre) {
      const grid = document.getElementById("spotifyCardGrid");
      const filtered = tracks.filter(t => t.genre === genre);
      grid.innerHTML = filtered.map(t => `
        <div class="card" onclick="window.selectAndPlayTrack(${t.id})">
          <div class="card-art" style="background: ${t.color}">
            <span class="status-badge ${t.exists ? 'status-ready' : 'status-missing'}">
              ${t.exists ? 'MP3 READY' : 'NO MP3'}
            </span>
            ${t.emoji}
            ${coverMarkup(t)}
            <button class="spotify-fab" onclick="event.stopPropagation(); window.selectAndPlayTrack(${t.id})">▶</button>
          </div>
          <h3>${t.title}</h3>
          <p>${t.artist}</p>
        </div>
      `).join('');
    }

    window.filterTracks = function() {
      const query = document.getElementById("searchInput").value.toLowerCase();
      const grid = document.getElementById("spotifyCardGrid");
      const filtered = tracks.filter(t => 
        t.title.toLowerCase().includes(query) || 
        t.artist.toLowerCase().includes(query) || 
        t.genre.toLowerCase().includes(query)
      );
      grid.innerHTML = filtered.map(t => `
        <div class="card" onclick="window.selectAndPlayTrack(${t.id})">
          <div class="card-art" style="background: ${t.color}">
            <span class="status-badge ${t.exists ? 'status-ready' : 'status-missing'}">
              ${t.exists ? 'MP3 READY' : 'NO MP3'}
            </span>
            ${t.emoji}
            ${coverMarkup(t)}
            <button class="spotify-fab" onclick="event.stopPropagation(); window.selectAndPlayTrack(${t.id})">▶</button>
          </div>
          <h3>${t.title}</h3>
          <p>${t.artist} • ${t.genre}</p>
        </div>
      `).join('');
    };

    window.selectAndPlayTrack = function(id) {
      const t = tracks[id];
      if (!t) return;
      if (!t.exists) {
        showNotice(`"${t.title}" has no MP3 yet.`);
        return;
      }
      loadTrackSource(id, true);
      try {
        const url = new URL(window.location.href);
        url.searchParams.set('play', String(id));
        window.history.replaceState(null, '', url);
      } catch (err) {}
    };

    window.playCurrentGenre = function() {
      const filtered = tracks.filter(t => t.genre === activeGenre && t.exists);
      if (!filtered.length) {
        showNotice(`No MP3s in ${activeGenre} yet.`);
        return;
      }
      loadTrackSource(filtered[0].id, true);
    };

    function updatePlayerDockMeta() {
      const t = tracks[currentTrackIndex];
      document.getElementById('lcdTitle').textContent = t.title;
      document.getElementById('lcdArtist').textContent = `${t.artist} — ${t.genre}`;
      setArtwork(document.getElementById('lcdArt'), t);

      document.getElementById('queueNowTitle').textContent = t.title;
      document.getElementById('queueNowArtist').textContent = `${t.artist} • ${t.genre}`;
      setArtwork(document.getElementById('queueNowArt'), t);
    }

    function updateGeniusSection() {
      const t = tracks[currentTrackIndex];
      const topTracks = [...tracks].sort((a, b) => parseFloat(b.views) - parseFloat(a.views)).slice(0, 4);
      const chartContainer = document.getElementById("geniusChartList");
      chartContainer.innerHTML = topTracks.map((tr, idx) => `
        <div class="chart-row" onclick="window.selectAndPlayTrack(${tr.id})">
          <div class="chart-left">
            <span class="chart-rank">#${idx + 1}</span>
            <div class="chart-meta">
              <h4>${tr.title}</h4>
              <span>${tr.artist}</span>
            </div>
          </div>
          <span class="chart-views">${tr.views}</span>
        </div>
      `).join('');

      document.getElementById('annotationTrackTitle').textContent = `${t.title} — Meaning & Feedback`;
      document.getElementById('geniusAnnotationText').textContent = t.annotation;
      renderFeedbackList();
    }

    function renderFeedbackList() {
      const t = tracks[currentTrackIndex];
      const list = document.getElementById("feedbackList");
      list.innerHTML = t.feedback.map(f => `
        <div class="feedback-item">
          <strong>${f.user}</strong>: ${f.text}
        </div>
      `).join('');
    }

    window.addFeedback = function(event) {
      event.preventDefault();
      const input = document.getElementById("feedbackInput");
      const val = input.value.trim();
      if (!val) return;
      tracks[currentTrackIndex].feedback.unshift({ user: "@You (Listener)", text: val });
      input.value = "";
      renderFeedbackList();
    };

    function updateAppleQueue() {
      const queueList = document.getElementById("appleQueueList");
      const nextTracks = [];
      for (let i = 1; i <= 4; i++) {
        let nextIdx = (currentTrackIndex + i) % tracks.length;
        nextTracks.push(tracks[nextIdx]);
      }
      queueList.innerHTML = nextTracks.map((tr) => `
        <div class="queue-item" onclick="window.selectAndPlayTrack(${tr.id})">
          <div class="queue-item-left">
            <div class="queue-thumb" style="background: ${tr.color}">
              <span>${tr.emoji}</span>
              ${coverMarkup(tr)}
            </div>
            <div class="queue-text">
              <h5>${tr.title}</h5>
              <span>${tr.artist} ${tr.exists ? '• MP3' : '• NO MP3'}</span>
            </div>
          </div>
        </div>
      `).join('');
    }

    window.switchMainView = function(viewName) {
      const homeView = document.getElementById("homeView");
      const lyricsView = document.getElementById("lyricsView");
      const tabHomeBtn = document.getElementById("tabHomeBtn");
      const tabLyricsBtn = document.getElementById("tabLyricsBtn");
      const navHome = document.getElementById("navHome");
      const navLyrics = document.getElementById("navLyrics");

      if (viewName === 'lyrics') {
        homeView.style.display = 'none';
        lyricsView.classList.add('active');
        tabHomeBtn.classList.remove('active');
        tabLyricsBtn.classList.add('active');
        navHome.classList.remove('active');
        navLyrics.classList.add('active');
        renderLiveLyrics();
      } else {
        homeView.style.display = 'block';
        lyricsView.classList.remove('active');
        tabHomeBtn.classList.add('active');
        tabLyricsBtn.classList.remove('active');
        navHome.classList.add('active');
        navLyrics.classList.remove('active');
      }
    };

    function escapeHtml(value) {
      return String(value).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
    }

    function updateLyricOffsetLabel() {
      const label = document.getElementById('lyricOffsetLabel');
      if (!label) return;
      label.textContent = currentTimedMode
        ? 'Sync ' + (lyricOffset > 0 ? '+' : '') + lyricOffset.toFixed(1) + 's'
        : 'No sync data';
      document.querySelectorAll('.lyric-offset button').forEach(b => { b.disabled = !currentTimedMode; });
    }

    function updateTimedHighlight() {
      if (!currentTimedMode || !currentTimedLyrics || !currentTimedLyrics.length) return;
      const t = audio.currentTime + lyricOffset;
      let idx = 0;
      for (let k = 0; k < currentTimedLyrics.length; k++) {
        if (currentTimedLyrics[k].t <= t) idx = k;
        else break;
      }
      if (idx === activeTimedIndex) return;

      const lines = document.querySelectorAll('#lyricsLinesBox .lyric-line');
      if (activeTimedIndex >= 0 && lines[activeTimedIndex]) lines[activeTimedIndex].classList.remove('current');
      activeTimedIndex = idx;
      if (lines[idx]) {
        lines[idx].classList.add('current');
        lines[idx].scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    }

    window.adjustLyricOffset = function(delta) {
      if (!currentTimedMode) return;
      lyricOffset = Math.max(-10, Math.min(10, Math.round((lyricOffset + delta) * 10) / 10));
      lyricOffsets[currentTrackIndex] = lyricOffset;
      localStorage.setItem(LYRIC_OFFSET_KEY, JSON.stringify(lyricOffsets));
      updateLyricOffsetLabel();
      updateTimedHighlight();
    };

    function renderLiveLyrics() {
      const t = tracks[currentTrackIndex];
      document.getElementById('lyricsSongTitle').textContent = `${t.title} — ${t.artist}`;
      const box = document.getElementById('lyricsLinesBox');

      currentTimedLyrics = null;
      currentTimedMode = false;
      activeTimedIndex = -1;

      const timedKey = timedKeyByTrack[currentTrackIndex];
      const timed = (timedKey !== undefined && window.timedLyrics) ? window.timedLyrics[timedKey] : null;

      if (timed && Array.isArray(timed.lines) && timed.lines.length) {
        currentTimedMode = true;
        currentTimedLyrics = timed.lines;
        lyricOffset = Number(lyricOffsets[currentTrackIndex] || 0);
        updateLyricOffsetLabel();

        box.innerHTML = currentTimedLyrics.map((line, idx) => `
          <div class="lyric-line" id="php-line-${idx}" data-time="${line.t}" onclick="window.jumpToLyric(${idx}, ${currentTimedLyrics.length})">
            ${escapeHtml(line.text)}
          </div>
        `).join('');

        updateTimedHighlight();
        return;
      }

      // Fallback: older plain lyrics without timestamps
      const songData = songLyricsDatabase[currentTrackIndex];
      lyricOffset = 0;
      updateLyricOffsetLabel();

      if (!songData || !songData.lines) {
        box.innerHTML = `<div class="lyric-line current">Lyrics not available for this song.</div>`;
        return;
      }

      let linesArray = [];
      songData.lines.forEach(item => {
        linesArray.push(...item.split('\n').filter(l => l.trim() !== ''));
      });

      const totalDur = audio.duration || 180;
      const progressRatio = audio.currentTime / totalDur;
      const activeLineIdx = Math.min(Math.floor(progressRatio * linesArray.length), linesArray.length - 1);

      box.innerHTML = linesArray.map((line, idx) => `
        <div class="lyric-line ${idx === activeLineIdx ? 'current' : ''}" onclick="window.jumpToLyric(${idx}, ${linesArray.length})">
          ${escapeHtml(line)}
        </div>
      `).join('');
    }

    window.jumpToLyric = function(idx, totalLines) {
      if (!audio.duration) return;

      if (currentTimedMode && currentTimedLyrics && currentTimedLyrics[idx]) {
        audio.currentTime = Math.max(0, currentTimedLyrics[idx].t - lyricOffset);
        updateTimedHighlight();
        return;
      }

      audio.currentTime = (idx / totalLines) * audio.duration;
      renderLiveLyrics();
    };

    window.togglePlay = function() {
      const btn = document.getElementById('playPauseBtn');
      const t = tracks[currentTrackIndex];
      if (!t || !t.exists) {
        showNotice('This track has no MP3 yet.');
        return;
      }
      if (audio.paused) {
        audio.play().then(() => {
          isPlaying = true;
          btn.textContent = '❚❚';
        }).catch(e => console.error(e));
      } else {
        audio.pause();
        isPlaying = false;
        btn.textContent = '▶';
      }
    };

    window.nextTrack = function() {
      for (let i = 1; i <= tracks.length; i++) {
        const nextIdx = (currentTrackIndex + i) % tracks.length;
        if (tracks[nextIdx].exists) {
          loadTrackSource(nextIdx, true);
          return;
        }
      }
      showNotice('No playable MP3s in the library.');
    };

    window.prevTrack = function() {
      for (let i = 1; i <= tracks.length; i++) {
        const prevIdx = (currentTrackIndex - i + tracks.length) % tracks.length;
        if (tracks[prevIdx].exists) {
          loadTrackSource(prevIdx, true);
          return;
        }
      }
      showNotice('No playable MP3s in the library.');
    };

    window.seekTrack = function(val) {
      audio.currentTime = parseFloat(val);
    };

    window.setVolume = function(val) {
      audio.volume = parseFloat(val);
    };

    initApp();
  </script>
</body>
</html>
