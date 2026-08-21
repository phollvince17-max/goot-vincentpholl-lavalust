<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Home</title>
    <style>
        :root { --ink: #18252b; --muted: #6b7876; --cream: #f5f1e8; --paper: #fffdf8; --teal: #0e6b68; --coral: #e76f51; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { min-height: 100vh; background: var(--cream); color: var(--ink); font-family: Georgia, 'Times New Roman', serif; }
        .portal { min-height: 100vh; display: grid; grid-template-columns: 250px 1fr; }
        .rail { background: var(--teal); color: #fffdf8; padding: 2rem 1.5rem; display: flex; flex-direction: column; }
        .brand { border-bottom: 1px solid rgba(255,255,255,.25); padding-bottom: 2rem; }
        .brand-mark { color: #f4bd67; font: 700 2.1rem Arial, sans-serif; letter-spacing: -.08em; }
        .brand h2 { font-size: 1.1rem; margin-top: .75rem; }
        .brand p { color: #b9d6d1; font: .72rem Arial, sans-serif; margin-top: .35rem; text-transform: uppercase; letter-spacing: .12em; }
        nav { display: grid; gap: .5rem; margin-top: 2rem; }
        nav a { color: #d9ebe5; text-decoration: none; font: 700 .87rem Arial, sans-serif; padding: .85rem 1rem; border-left: 3px solid transparent; }
        nav a.active, nav a:hover { background: rgba(255,255,255,.11); border-left-color: #f4bd67; color: #fff; }
        .rail-footer { margin-top: auto; color: #b9d6d1; font: .75rem Arial, sans-serif; line-height: 1.5; }
        main { padding: 3.5rem clamp(2rem, 6vw, 7rem); background: radial-gradient(circle at 90% 10%, #ead9b9 0, transparent 28%), var(--cream); }
        .eyebrow { color: var(--coral); font: 700 .75rem Arial, sans-serif; letter-spacing: .18em; text-transform: uppercase; }
        h1 { font-size: clamp(2.5rem, 5vw, 5.4rem); line-height: .95; max-width: 760px; margin: 1.2rem 0 1.5rem; font-weight: 400; }
        .intro { max-width: 590px; color: var(--muted); font: 1.05rem/1.7 Arial, sans-serif; }
        .content-grid { display: grid; grid-template-columns: minmax(0, 1fr) 260px; gap: 2rem; align-items: end; margin-top: 5rem; max-width: 950px; }
        .feature { background: var(--paper); border: 1px solid #e6dece; padding: 2rem; box-shadow: 12px 12px 0 #d9c8a8; }
        .feature h2 { font-size: 1.7rem; font-weight: 400; margin-bottom: .8rem; }
        .feature p { color: var(--muted); font: .92rem/1.6 Arial, sans-serif; }
        .btn { display: inline-block; margin-top: 1.5rem; background: var(--coral); color: #fff; padding: .9rem 1.2rem; text-decoration: none; font: 700 .82rem Arial, sans-serif; }
        .btn:hover { background: #c9573d; }
        .status { border-top: 4px solid var(--teal); padding: 1.2rem 0 0; }
        .status strong { display: block; font-size: 2.5rem; font-weight: 400; color: var(--teal); }
        .status span { color: var(--muted); font: .76rem Arial, sans-serif; text-transform: uppercase; letter-spacing: .1em; }
        .notice { margin-top: 1.5rem; padding: 1rem; color: #8a402d; background: #f7d8cc; font: .85rem/1.5 Arial, sans-serif; }
        @media (max-width: 720px) { .portal { display: block; } .rail { padding: 1.25rem 1.5rem; } .brand { border: 0; padding: 0; display: flex; align-items: center; gap: .8rem; } .brand p { display: none; } nav { display: flex; margin-top: 1.25rem; gap: .25rem; overflow-x: auto; } nav a { white-space: nowrap; padding: .65rem .75rem; } .rail-footer { display: none; } main { padding: 3rem 1.5rem 4rem; } .content-grid { grid-template-columns: 1fr; margin-top: 3rem; } }
    </style>
</head>
<body>
<div class="portal">
    <aside class="rail">
        <div class="brand"><span class="brand-mark">LL</span><div><h2>Student Portal</h2><p>LavaLust campus</p></div></div>
        <nav><a class="active" href="<?= site_url('student'); ?>">01 &nbsp; Home</a><a href="<?= site_url('student/profile'); ?>">02 &nbsp; My profile</a></nav>
        <p class="rail-footer">A quiet place for your<br>campus essentials.</p>
    </aside>
    <main>
        <p class="eyebrow">Good to see you</p>
        <h1>Welcome,<br><?= htmlspecialchars($name); ?>.</h1>
        <p class="intro">Your student space is ready. Check your personal information and keep your campus details close at hand.</p>
        <div class="content-grid">
            <section class="feature"><h2>Open your student profile</h2><p>Review your course, contact details, skills, and other information saved in the portal.</p><a class="btn" href="<?= site_url('student/profile'); ?>">VIEW MY PROFILE &rarr;</a>
            <?php if ($denied): ?><div class="notice">Your access badge is active now. You can try the profile page again.</div><?php endif; ?></section>
            <div class="status"><strong>Active</strong><span>Profile access badge</span></div>
        </div>
    </main>
</div>
</body>
</html>
