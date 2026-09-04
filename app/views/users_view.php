<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Directory | LavaLust</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f3f6fb;
            --panel: #ffffff;
            --panel-soft: #f8fafc;
            --line: #e7edf5;
            --ink: #17212b;
            --muted: #64748b;
            --primary: #0f766e;
            --primary-deep: #145a58;
            --accent: #facc15;
            --shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
            --sidebar: linear-gradient(180deg, #102b2d 0%, #183f43 100%);
            --sidebar-text: #d6eff1;
            --success-bg: rgba(16, 185, 129, 0.12);
            --success-text: #047857;
            --chip-shadow: rgba(15, 118, 110, 0.18);
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            min-height: 100%;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: radial-gradient(circle at top, rgba(16, 185, 129, 0.08), transparent 30%), var(--bg);
            color: var(--ink);
        }

        a { color: inherit; text-decoration: none; }

        .shell {
            min-height: 100vh;
            max-width: 1500px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 240px minmax(0, 1fr);
        }

        .sidebar {
            background: var(--sidebar);
            color: var(--sidebar-text);
            padding: 28px 18px 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 8px 42px;
            color: #fff;
        }

        .brand-mark {
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: linear-gradient(135deg, #f5d76d, #f4b942);
            color: var(--ink);
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            box-shadow: 0 8px 18px rgba(245, 199, 91, 0.35);
        }

        .brand-name {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            letter-spacing: -0.04em;
            font-size: 1.15rem;
        }

        .nav {
            display: grid;
            gap: 8px;
        }

        .nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.92rem;
            transition: all 0.2s ease;
        }

        .nav a:hover,
        .nav a.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .main {
            padding: 32px clamp(20px, 3vw, 60px) 48px;
        }

        .topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .page-header {
            display: grid;
            gap: 8px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            width: fit-content;
            padding: 7px 10px;
            border-radius: 999px;
            background: rgba(15, 118, 110, 0.09);
            color: var(--primary-deep);
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            letter-spacing: -0.05em;
            font-size: clamp(2.1rem, 3vw, 3rem);
            line-height: 1.05;
        }

        .subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 0.98rem;
        }

        .action-btn {
            border: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-deep));
            color: #fff;
            font: inherit;
            font-weight: 700;
            padding: 12px 18px;
            box-shadow: 0 12px 24px rgba(15, 118, 110, 0.25);
            cursor: pointer;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 26px;
        }

        .stat-card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: var(--shadow);
            padding: 20px 20px 18px;
        }

        .stat-label {
            display: block;
            color: var(--muted);
            font-size: 0.78rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .stat-value {
            display: block;
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(1.8rem, 2vw, 2.4rem);
            font-weight: 700;
            letter-spacing: -0.05em;
            margin-bottom: 6px;
        }

        .stat-detail {
            color: var(--muted);
            font-size: 0.85rem;
        }

        .table-card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 20px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .table-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 22px 22px 18px;
            border-bottom: 1px solid var(--line);
            background: rgba(248, 250, 252, 0.9);
        }

        .section-label {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .section-title {
            margin: 0;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: -0.04em;
        }

        .section-meta {
            color: var(--muted);
            font-size: 0.82rem;
        }

        .search-wrap {
            position: relative;
            width: min(100%, 320px);
        }

        .search-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            stroke: var(--muted);
        }

        .search-wrap input {
            width: 100%;
            border: 1px solid var(--line);
            background: #fff;
            border-radius: 12px;
            padding: 12px 14px 12px 42px;
            color: var(--ink);
            font: inherit;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .search-wrap input:focus {
            border-color: rgba(15, 118, 110, 0.45);
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.08);
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 760px;
        }

        thead th {
            padding: 15px 20px;
            text-align: left;
            font-size: 0.74rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            background: #f8fafc;
            color: var(--muted);
        }

        tbody td {
            padding: 18px 20px;
            border-top: 1px solid var(--line);
            vertical-align: middle;
        }

        tbody tr:hover {
            background: rgba(15, 118, 110, 0.02);
        }

        .person {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, rgba(15, 118, 110, 0.18), rgba(250, 204, 21, 0.26));
            color: var(--primary-deep);
            font-weight: 700;
            font-size: 0.82rem;
        }

        .person-meta {
            display: grid;
            gap: 2px;
        }

        .name {
            font-weight: 700;
            color: var(--ink);
        }

        .subtext {
            color: var(--muted);
            font-size: 0.8rem;
        }

        .email,
        .username,
        .id {
            color: var(--muted);
        }

        .pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 12px;
            border-radius: 999px;
            background: var(--success-bg);
            color: var(--success-text);
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .empty {
            padding: 32px 20px;
            text-align: center;
            color: var(--muted);
            font-size: 0.95rem;
        }

        @media (max-width: 980px) {
            .shell {
                grid-template-columns: 1fr;
            }

            .sidebar {
                padding-bottom: 18px;
            }

            .nav {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }

            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .table-head {
                flex-direction: column;
                align-items: stretch;
            }

            .search-wrap {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="shell">
        <aside class="sidebar">
            <a href="/" class="brand" aria-label="LavaLust home">
                <span class="brand-mark">L</span>
                <span class="brand-name">LavaLust</span>
            </a>

            <nav class="nav" aria-label="Sidebar navigation">
                <a href="/">Overview</a>
                <a href="/users" class="active">Members</a>
            </nav>
        </aside>

        <main class="main">
            <header class="topbar">
                <div class="page-header">
                    <span class="eyebrow">Directory</span>
                    <h1 class="page-title">Users</h1>
                    <p class="subtitle">Manage your team and review active members.</p>
                </div>
                <button class="action-btn" type="button">+ Invite member</button>
            </header>

            <section class="stats" aria-label="User stats">
                <?php $memberCount = is_array($users ?? null) ? count($users) : 0; ?>
                <article class="stat-card">
                    <span class="stat-label">Total members</span>
                    <strong class="stat-value"><?= htmlspecialchars((string) $memberCount); ?></strong>
                    <span class="stat-detail">Across all accounts</span>
                </article>
                <article class="stat-card">
                    <span class="stat-label">Active</span>
                    <strong class="stat-value"><?= htmlspecialchars((string) min($memberCount, 18)); ?></strong>
                    <span class="stat-detail">Online this week</span>
                </article>
                <article class="stat-card">
                    <span class="stat-label">Admins</span>
                    <strong class="stat-value"><?= htmlspecialchars((string) min($memberCount, 3)); ?></strong>
                    <span class="stat-detail">With full access</span>
                </article>
                <article class="stat-card">
                    <span class="stat-label">New this month</span>
                    <strong class="stat-value"><?= htmlspecialchars((string) min($memberCount, 5)); ?></strong>
                    <span class="stat-detail">Recently onboarded</span>
                </article>
            </section>

            <section class="table-card" aria-label="User directory table">
                <div class="table-head">
                    <div class="section-label">
                        <h2 class="section-title">Team members</h2>
                        <span class="section-meta">Showing <?= htmlspecialchars((string) $memberCount); ?> members</span>
                    </div>

                    <label class="search-wrap" aria-label="Search users">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="7"></circle>
                            <path d="M20 20L16.65 16.65"></path>
                        </svg>
                        <input id="user-search" type="search" placeholder="Search members..." />
                    </label>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Member</th>
                                <th scope="col">Email</th>
                                <th scope="col">Username</th>
                                <th scope="col">Member ID</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody id="user-rows">
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <?php
                                        $firstName = trim((string) ($user['firstname'] ?? ''));
                                        $lastName = trim((string) ($user['lastname'] ?? ''));
                                        $fullName = trim($firstName . ' ' . $lastName);
                                        if ($fullName === '') {
                                            $fullName = 'Unknown User';
                                        }
                                        $initials = strtoupper(substr($firstName ?: 'U', 0, 1) . substr($lastName ?: 'S', 0, 1));
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="person">
                                                <span class="avatar"><?= htmlspecialchars($initials); ?></span>
                                                <div class="person-meta">
                                                    <span class="name"><?= htmlspecialchars($fullName); ?></span>
                                                    <span class="subtext"><?= htmlspecialchars((string) ($user['username'] ?? 'member')); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="email"><?= htmlspecialchars((string) ($user['email'] ?? 'No email provided')); ?></td>
                                        <td class="username">@<?= htmlspecialchars((string) ($user['username'] ?? 'unknown')); ?></td>
                                        <td class="id">#<?= htmlspecialchars((string) ($user['id'] ?? 'N/A')); ?></td>
                                        <td><span class="pill">Active</span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="empty">No users found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script>
        const search = document.getElementById('user-search');
        const rows = document.querySelectorAll('#user-rows tr');

        if (search) {
            search.addEventListener('input', function () {
                const term = this.value.trim().toLowerCase();

                rows.forEach(function (row) {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(term) ? '' : 'none';
                });
            });
        }
    </script>
</body>
</html>
