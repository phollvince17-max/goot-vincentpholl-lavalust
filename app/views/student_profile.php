<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - <?= htmlspecialchars($name); ?></title>
    <style>
        :root { --ink: #18252b; --muted: #6b7876; --cream: #f5f1e8; --paper: #fffdf8; --teal: #0e6b68; --coral: #e76f51; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { min-height: 100vh; background: var(--cream); color: var(--ink); font-family: Georgia, 'Times New Roman', serif; }
        .portal { min-height: 100vh; display: grid; grid-template-columns: 250px 1fr; }
        .rail { background: var(--teal); color: #fffdf8; padding: 2rem 1.5rem; display: flex; flex-direction: column; }
        .brand { border-bottom: 1px solid rgba(255,255,255,.25); padding-bottom: 2rem; }
        .brand-mark { color: #f4bd67; font: 700 2.1rem Arial, sans-serif; letter-spacing: -.08em; }
        .brand h2 { font-size: 1.1rem; margin-top: .75rem; }.brand p { color: #b9d6d1; font: .72rem Arial, sans-serif; margin-top: .35rem; text-transform: uppercase; letter-spacing: .12em; }
        nav { display: grid; gap: .5rem; margin-top: 2rem; } nav a { color: #d9ebe5; text-decoration: none; font: 700 .87rem Arial, sans-serif; padding: .85rem 1rem; border-left: 3px solid transparent; } nav a.active, nav a:hover { background: rgba(255,255,255,.11); border-left-color: #f4bd67; color: #fff; }
        .rail-footer { margin-top: auto; color: #b9d6d1; font: .75rem Arial, sans-serif; line-height: 1.5; }
        main { padding: 3.5rem clamp(2rem, 6vw, 7rem); background: radial-gradient(circle at 90% 10%, #ead9b9 0, transparent 28%), var(--cream); }
        .topline { display: flex; justify-content: space-between; align-items: end; border-bottom: 1px solid #d9cdb8; padding-bottom: 1.5rem; max-width: 1000px; }.eyebrow { color: var(--coral); font: 700 .75rem Arial, sans-serif; letter-spacing: .18em; text-transform: uppercase; }.topline p:last-child { color: var(--muted); font: .8rem Arial, sans-serif; }
        h1 { font-size: clamp(2.4rem, 5vw, 5rem); line-height: .95; font-weight: 400; margin: 1.4rem 0 3rem; max-width: 800px; }
        .profile-layout { display: grid; grid-template-columns: 180px minmax(0, 650px); gap: clamp(2rem, 6vw, 6rem); align-items: start; max-width: 1000px; }
        .identity { background: var(--teal); color: #fffdf8; padding: 1.5rem; min-height: 210px; box-shadow: 12px 12px 0 #d9c8a8; }.avatar { width: 76px; height: 76px; display: grid; place-items: center; background: #f4bd67; color: var(--teal); font: 700 2.3rem Arial, sans-serif; }.identity strong { display: block; margin-top: 2.5rem; font-size: 1.05rem; }.identity span { color: #b9d6d1; font: .72rem Arial, sans-serif; }
        .details { background: var(--paper); border-top: 4px solid var(--coral); padding: .5rem 1.5rem 1.5rem; }.row { display: grid; grid-template-columns: 150px 1fr; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid #e8e0d1; font: .92rem Arial, sans-serif; }.label { color: var(--muted); text-transform: uppercase; font-size: .68rem; letter-spacing: .1em; }.value { overflow-wrap: anywhere; }.bio { color: var(--muted); font: italic 1rem/1.6 Georgia, serif; padding-top: 1.5rem; }
        @media (max-width: 720px) { .portal { display: block; } .rail { padding: 1.25rem 1.5rem; }.brand { border: 0; padding: 0; display: flex; align-items: center; gap: .8rem; }.brand p { display: none; } nav { display: flex; margin-top: 1.25rem; gap: .25rem; overflow-x: auto; } nav a { white-space: nowrap; padding: .65rem .75rem; }.rail-footer { display: none; } main { padding: 3rem 1.5rem 4rem; }.topline { display: block; }.topline p:last-child { margin-top: .75rem; }.profile-layout { grid-template-columns: 1fr; gap: 2rem; }.identity { min-height: 0; display: grid; grid-template-columns: 76px 1fr; gap: 1rem; align-items: center; }.identity strong { margin-top: 0; } .row { grid-template-columns: 1fr; gap: .35rem; } }
    </style>
</head>
<body>
<div class="portal">
    <aside class="rail">
        <div class="brand"><span class="brand-mark">LL</span><div><h2>Student Portal</h2><p>LavaLust campus</p></div></div>
        <nav><a href="<?= site_url('student'); ?>">01 &nbsp; Home</a><a class="active" href="<?= site_url('student/profile'); ?>">02 &nbsp; My profile</a></nav>
        <p class="rail-footer">A quiet place for your<br>campus essentials.</p>
    </aside>
    <main>
        <div class="topline"><p class="eyebrow">Student record</p><p>Personal information</p></div>
        <h1>My profile.</h1>
        <div class="profile-layout">
            <section class="identity"><div class="avatar"><?= htmlspecialchars(strtoupper(substr($name, 0, 1))); ?></div><div><strong><?= htmlspecialchars($name); ?></strong><span><?= htmlspecialchars($student_id); ?></span></div></section>
            <section class="details">
                <div class="row"><span class="label">Name</span><span class="value"><?= htmlspecialchars($name); ?></span></div>
                <div class="row"><span class="label">Course</span><span class="value"><?= htmlspecialchars($course); ?></span></div>
                <div class="row"><span class="label">Year / section</span><span class="value"><?= htmlspecialchars($year); ?> / <?= htmlspecialchars($section); ?></span></div>
                <div class="row"><span class="label">Email</span><span class="value"><?= htmlspecialchars($email); ?></span></div>
                <div class="row"><span class="label">Address</span><span class="value"><?= htmlspecialchars($address); ?></span></div>
                <div class="row"><span class="label">Contact</span><span class="value"><?= htmlspecialchars($contact); ?></span></div>
                <div class="row"><span class="label">Skills</span><span class="value"><?= htmlspecialchars($skills); ?></span></div>
                <p class="bio">&ldquo;<?= htmlspecialchars($bio); ?>&rdquo;</p>
            </section>
        </div>
    </main>
</div>
</body>
</html>
