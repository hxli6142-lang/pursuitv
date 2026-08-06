<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PursuitV · FiveM PvP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:#111; color:#eaeef2; overflow-x:hidden; scroll-behavior:smooth; }
        ::-webkit-scrollbar { width:8px; }
        ::-webkit-scrollbar-track { background:#1a1a1a; border-radius:20px; }
        ::-webkit-scrollbar-thumb { background:#7C3AED; border-radius:20px; }

        .glass { background:rgba(255,255,255,0.04); backdrop-filter:blur(12px); border:1px solid rgba(255,255,255,0.06); box-shadow:0 15px 40px -10px rgba(0,0,0,0.6); border-radius:24px; }
        .btn { border-radius:40px; padding:14px 38px; font-weight:600; transition:all 0.3s ease; border:none; cursor:pointer; background:#7C3AED; color:#fff; display:inline-flex; align-items:center; gap:10px; font-size:1rem; letter-spacing:0.3px; }
        .btn:hover { background:#6d2de8; transform:scale(1.04); box-shadow:0 12px 30px -8px rgba(124,58,237,0.5); }

        /* language overlay */
        #langOverlay { position:fixed; inset:0; background:#111; z-index:9999; display:flex; align-items:center; justify-content:center; transition:opacity 0.8s ease, transform 0.8s ease; opacity:1; pointer-events:auto; }
        #langOverlay.hidden { opacity:0; pointer-events:none; transform:scale(0.96); }
        .lang-card { background:rgba(255,255,255,0.04); backdrop-filter:blur(12px); border:1px solid rgba(255,255,255,0.06); border-radius:40px; padding:48px 64px; text-align:center; max-width:560px; width:90%; box-shadow:0 30px 60px -20px rgba(0,0,0,0.8); }
        .lang-card h2 { font-weight:500; font-size:1.6rem; letter-spacing:-0.3px; margin-bottom:32px; color:#c8d0dc; }
        .lang-buttons { display:flex; flex-wrap:wrap; justify-content:center; gap:16px; }
        .lang-btn { background:rgba(255,255,255,0.04); backdrop-filter:blur(4px); border:1px solid rgba(255,255,255,0.08); padding:18px 40px; border-radius:60px; font-size:1.2rem; font-weight:600; color:#eaeef2; cursor:pointer; transition:0.3s ease; display:flex; align-items:center; gap:12px; flex:1 1 auto; justify-content:center; min-width:140px; }
        .lang-btn:hover { background:rgba(124,58,237,0.2); border-color:#7C3AED; transform:translateY(-4px); box-shadow:0 12px 30px -12px rgba(124,58,237,0.3); }

        #app { opacity:0; transition:opacity 0.9s ease; }
        #app.visible { opacity:1; }

        /* nav */
        nav { position:sticky; top:16px; z-index:100; margin:0 20px; padding:8px 16px; background:rgba(17,17,17,0.6); backdrop-filter:blur(16px); border:1px solid rgba(255,255,255,0.05); border-radius:60px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:8px 16px; box-shadow:0 15px 40px -12px rgba(0,0,0,0.7); }
        .nav-logo { display:flex; align-items:center; gap:10px; font-weight:700; font-size:1.4rem; letter-spacing:-0.5px; color:#fff; }
        .nav-logo .pv { background:#7C3AED; color:#fff; width:44px; height:44px; display:flex; align-items:center; justify-content:center; border-radius:18px; font-size:1.6rem; font-weight:800; letter-spacing:-1px; box-shadow:0 6px 14px rgba(124,58,237,0.3); }
        .nav-links { display:flex; flex-wrap:wrap; align-items:center; gap:4px 12px; list-style:none; }
        .nav-links li a { padding:8px 16px; border-radius:40px; font-weight:500; font-size:0.9rem; transition:0.25s ease; color:#b0b8c5; }
        .nav-links li a:hover, .nav-links li a.active { background:rgba(124,58,237,0.2); color:#fff; }

        /* hero */
        .hero { min-height:92vh; display:flex; align-items:center; justify-content:center; text-align:center; padding:40px 20px; position:relative; overflow:hidden; }
        .hero-bg { position:absolute; inset:0; z-index:0; background:radial-gradient(circle at 30% 40%, #1f0f3a 0%, #111111 70%); opacity:0.6; }
        .hero-content { position:relative; z-index:2; max-width:820px; }
        .hero .pv-big { display:inline-block; background:#7C3AED; font-size:5rem; font-weight:900; padding:10px 32px; border-radius:60px; letter-spacing:-3px; color:#fff; box-shadow:0 20px 50px -12px rgba(124,58,237,0.4); margin-bottom:20px; }
        .hero h1 { font-size:clamp(2.4rem,8vw,4.2rem); font-weight:700; letter-spacing:-1.5px; line-height:1.1; margin:20px 0 16px; }
        .hero h1 span { color:#7C3AED; }
        .hero p { font-size:1.2rem; color:#b0b8c5; max-width:600px; margin:0 auto 32px; line-height:1.6; }

        section { padding:80px 24px; max-width:1280px; margin:0 auto; }
        .section-title { font-size:2.4rem; font-weight:700; letter-spacing:-1px; margin-bottom:40px; display:flex; align-items:center; gap:12px; }
        .section-title i { color:#7C3AED; }

        /* features */
        .feature-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(210px,1fr)); gap:28px; }
        .feature-card { background:rgba(255,255,255,0.03); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.05); padding:30px 18px; border-radius:28px; text-align:center; transition:0.35s ease; box-shadow:0 10px 30px -12px rgba(0,0,0,0.5); }
        .feature-card:hover { transform:translateY(-12px); background:rgba(124,58,237,0.08); border-color:rgba(124,58,237,0.2); box-shadow:0 20px 40px -12px rgba(124,58,237,0.2); }
        .feature-card i { font-size:2.8rem; color:#7C3AED; margin-bottom:16px; }
        .feature-card h3 { font-weight:600; margin-bottom:8px; }
        .feature-card p { color:#9aa3b0; font-size:0.9rem; }

        /* stats */
        .stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:24px; }
        .stat-card { background:rgba(255,255,255,0.03); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.04); padding:28px 12px; border-radius:28px; text-align:center; transition:0.3s; }
        .stat-card:hover { background:rgba(124,58,237,0.06); }
        .stat-number { font-size:2.6rem; font-weight:800; color:#fff; letter-spacing:-1px; }
        .stat-label { color:#9aa3b0; font-weight:500; margin-top:4px; }

        /* leaderboard */
        .lb-container { background:rgba(255,255,255,0.03); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.04); border-radius:32px; overflow:hidden; padding:8px 0; }
        .lb-row { display:grid; grid-template-columns:60px 2fr 1fr 1fr 1fr 1fr; padding:14px 24px; align-items:center; border-bottom:1px solid rgba(255,255,255,0.03); transition:0.2s; border-radius:0; font-weight:500; }
        .lb-row.header { color:#9aa3b0; font-weight:600; font-size:0.85rem; text-transform:uppercase; letter-spacing:0.5px; border-bottom:1px solid rgba(255,255,255,0.06); }
        .lb-row:not(.header):hover { background:rgba(124,58,237,0.08); border-radius:20px; margin:0 6px; transform:scale(1.01); }
        .lb-rank { font-weight:700; color:#7C3AED; }

        /* gallery / screenshots */
        .screenshot-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:24px; }
        .screenshot-card { background:rgba(255,255,255,0.03); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.05); border-radius:28px; overflow:hidden; transition:0.3s ease; box-shadow:0 10px 30px -12px rgba(0,0,0,0.5); }
        .screenshot-card:hover { transform:scale(1.02); border-color:#7C3AED; box-shadow:0 20px 40px -12px rgba(124,58,237,0.15); }
        .screenshot-card img { width:100%; height:180px; object-fit:cover; display:block; }
        .screenshot-card .caption { padding:16px 18px; font-weight:500; color:#b0b8c5; font-size:0.9rem; }

        /* footer */
        footer { padding:40px 24px 24px; border-top:1px solid rgba(255,255,255,0.04); text-align:center; margin-top:40px; }
        .footer-socials { display:flex; justify-content:center; gap:24px; margin-bottom:18px; flex-wrap:wrap; }
        .footer-socials a { background:rgba(255,255,255,0.04); width:52px; height:52px; border-radius:40px; display:flex; align-items:center; justify-content:center; font-size:1.5rem; transition:0.25s; border:1px solid rgba(255,255,255,0.04); color:#b0b8c5; }
        .footer-socials a:hover { background:#7C3AED; color:#fff; transform:translateY(-6px); box-shadow:0 12px 30px -12px #7C3AED; }
        footer p { color:#6b7380; font-size:0.9rem; }

        @media (max-width:700px) {
            nav { border-radius:40px; padding:10px 14px; margin:12px; flex-direction:column; align-items:stretch; }
            .nav-links { justify-content:center; }
            .nav-links li a { padding:6px 12px; font-size:0.8rem; }
            .hero .pv-big { font-size:3.4rem; padding:8px 20px; }
            .lang-card { padding:32px 20px; }
            .lang-btn { min-width:120px; padding:14px 18px; }
            .lb-row { grid-template-columns:40px 1.4fr 0.8fr 0.8fr 0.8fr 0.8fr; padding:12px 14px; font-size:0.8rem; }
        }
        @media (max-width:480px) {
            .lb-row { grid-template-columns:30px 1.2fr 0.7fr 0.7fr 0.7fr 0.7fr; font-size:0.7rem; padding:10px 8px; }
            .screenshot-grid { grid-template-columns:1fr; }
        }
        .text-purple { color:#7C3AED; }
        .fade-up { opacity:0; transform:translateY(30px); transition:opacity 0.8s ease, transform 0.8s ease; }
        .fade-up.visible { opacity:1; transform:translateY(0); }
        .logo{
    width:48px;
    height:48px;
    object-fit:contain;
}
.hero-logo{
    width:220px;
    height:auto;
    margin-bottom:30px;
    user-select:none;
    pointer-events:none;
}
    </style>
</head>
<body>

    <!-- LANGUAGE OVERLAY -->
    <div id="langOverlay">
        <div class="lang-card">
            <h2 id="langTitle">Kérlek válassz nyelvet</h2>
            <div class="lang-buttons">
                <button class="lang-btn" data-lang="hu"><span>🇭🇺</span> Magyar</button>
                <button class="lang-btn" data-lang="en"><span>🇬🇧</span> English</button>
            </div>
        </div>
    </div>

    <!-- MAIN APP -->
    <div id="app">
        <nav>
<div class="nav-logo">
    <img src="logo.png" class="logo" alt="PursuitV Logo">
    <span>PursuitV</span>
</div>
            <ul class="nav-links">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#leaderboard">Leaderboards</a></li>
                <li><a href="#rules">Rules</a></li>
                <li><a href="#shop">Shop</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#connect">Connect</a></li>
            </ul>
        </nav>

        <!-- HERO -->
        <section id="home" class="hero">
            <div class="hero-bg"></div>
            <div class="hero-content">
                <img src="logo.png" class="hero-logo" alt="PursuitV Logo">
                <h1>The Ultimate <span>FiveM</span> Pursuit Experience</h1>
                <p>Competitive PvP, ranked battles, and an immersive pursuit world. Dominate the leaderboard.</p>
                <button class="btn"><i class="fas fa-play"></i> Play Now</button>
            </div>
        </section>

        <!-- FEATURES -->
        <section id="features">
            <div class="section-title"><i class="fas fa-bolt"></i> Features</div>
            <div class="feature-grid">
                <div class="feature-card"><i class="fas fa-crosshairs"></i><h3>Fast PvP</h3><p>Instant action, low TTK</p></div>
                <div class="feature-card"><i class="fas fa-trophy"></i><h3>Ranked System</h3><p>Climb tiers &amp; earn rewards</p></div>
                <div class="feature-card"><i class="fas fa-gun"></i><h3>Weapon Upgrades</h3><p>Customize your loadout</p></div>
                <div class="feature-card"><i class="fas fa-gem"></i><h3>Daily Rewards</h3><p>Log in &amp; claim bonuses</p></div>
                <div class="feature-card"><i class="fas fa-list-ol"></i><h3>Leaderboards</h3><p>Compete globally</p></div>
                <div class="feature-card"><i class="fas fa-paint-brush"></i><h3>Premium UI</h3><p>Sleek, immersive interface</p></div>
            </div>
        </section>

        <!-- STATISTICS -->
        <section>
            <div class="section-title"><i class="fas fa-chart-line"></i> Statistics</div>
            <div class="stats-grid" id="statsGrid">
                <div class="stat-card"><div class="stat-number" data-count="842">0</div><div class="stat-label">Players Online</div></div>
                <div class="stat-card"><div class="stat-number" data-count="12473">0</div><div class="stat-label">Registered Players</div></div>
                <div class="stat-card"><div class="stat-number" data-count="58102">0</div><div class="stat-label">Matches Played</div></div>
                <div class="stat-card"><div class="stat-number" data-count="392k">0</div><div class="stat-label">Total Kills</div></div>
            </div>
        </section>

        <!-- LEADERBOARD -->
        <section id="leaderboard">
            <div class="section-title"><i class="fas fa-crown"></i> Leaderboard</div>
            <div class="lb-container">
                <div class="lb-row header"><span>#</span><span>Player</span><span>Level</span><span>Kills</span><span>Deaths</span><span>K/D</span></div>
                <div class="lb-row"><span class="lb-rank">1</span><span>❄️ Frost</span><span>89</span><span>1,240</span><span>382</span><span>3.24</span></div>
                <div class="lb-row"><span class="lb-rank">2</span><span>🔥 Venom</span><span>77</span><span>982</span><span>310</span><span>3.16</span></div>
                <div class="lb-row"><span class="lb-rank">3</span><span>⚡ Raptor</span><span>72</span><span>871</span><span>290</span><span>3.00</span></div>
                <div class="lb-row"><span class="lb-rank">4</span><span>🌀 Nexus</span><span>68</span><span>795</span><span>276</span><span>2.88</span></div>
                <div class="lb-row"><span class="lb-rank">5</span><span>🕶️ Shadow</span><span>62</span><span>702</span><span>258</span><span>2.72</span></div>
            </div>
        </section>

        <!-- GALLERY / SCREENSHOTS -->
        <section id="gallery">
            <div class="section-title"><i class="fas fa-images"></i> Screenshots</div>
            <div class="screenshot-grid">
                <div class="screenshot-card"><img src="https://picsum.photos/seed/pursuit1/400/250" alt="gameplay 1" /><div class="caption">🔥 Urban pursuit</div></div>
                <div class="screenshot-card"><img src="https://picsum.photos/seed/pursuit2/400/250" alt="gameplay 2" /><div class="caption">⚡ High-speed chase</div></div>
                <div class="screenshot-card"><img src="https://picsum.photos/seed/pursuit3/400/250" alt="gameplay 3" /><div class="caption">🏆 Ranked arena</div></div>
                <div class="screenshot-card"><img src="https://picsum.photos/seed/pursuit4/400/250" alt="gameplay 4" /><div class="caption">🎯 Tactical combat</div></div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer>
            <div class="footer-socials">
                <a href="#"><i class="fab fa-discord"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
            </div>
            <p>© PursuitV · premium FiveM PvP</p>
        </footer>
    </div>

    <script>
        (function() {
            'use strict';

            const overlay = document.getElementById('langOverlay');
            const app = document.getElementById('app');
            const langTitle = document.getElementById('langTitle');
            const langBtns = document.querySelectorAll('.lang-btn');

            let selectedLang = localStorage.getItem('pursuitv-lang') || 'en';

            function setLanguage(lang) {
                selectedLang = lang;
                localStorage.setItem('pursuitv-lang', lang);
                langTitle.textContent = lang === 'hu' ? 'Kérlek válassz nyelvet' : 'Please choose your language';
                overlay.classList.add('hidden');
                setTimeout(() => {
                    overlay.style.display = 'none';
                    app.classList.add('visible');
                    initCounters();
                    observeFade();
                }, 700);
            }

            if (selectedLang) {
                overlay.style.display = 'none';
                app.classList.add('visible');
                langTitle.textContent = selectedLang === 'hu' ? 'Kérlek válassz nyelvet' : 'Please choose your language';
                setTimeout(initCounters, 300);
                setTimeout(observeFade, 400);
            } else {
                langTitle.textContent = 'Please choose your language';
            }

            langBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    setLanguage(this.dataset.lang);
                });
            });

            function initCounters() {
                document.querySelectorAll('.stat-number').forEach(counter => {
                    const target = counter.dataset.count;
                    if (!target) return;
                    const isK = target.includes('k');
                    const num = parseFloat(target.replace('k', '')) * (isK ? 1000 : 1);
                    let current = 0;
                    const increment = Math.ceil(num / 60);
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= num) { current = num; clearInterval(timer); }
                        counter.textContent = isK ? (current / 1000).toFixed(1) + 'k' : Math.floor(current).toLocaleString();
                    }, 20);
                });
            }

            function observeFade() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
                }, { threshold: 0.2 });
                document.querySelectorAll('.feature-card, .stat-card, .lb-container, .screenshot-card, .hero-content').forEach(el => {
                    el.classList.add('fade-up');
                    observer.observe(el);
                });
            }

            // nav active
            document.querySelectorAll('.nav-links a').forEach(link => {
                link.addEventListener('click', function() {
                    document.querySelectorAll('.nav-links a').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            if (app.classList.contains('visible')) {
                setTimeout(initCounters, 400);
                setTimeout(observeFade, 500);
            }
        })();
    </script>
</body>
</html>