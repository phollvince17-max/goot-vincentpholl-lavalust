<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$is_admin = (($_SESSION['role'] ?? null) === 'admin');
$products = is_array($products ?? null) ? $products : [];
$product_count = count($products);
$inventory_units = array_sum(array_map(static function ($product) {
    return (int) ($product['quantity'] ?? 0);
}, $products));
$inventory_value = array_sum(array_map(static function ($product) {
    return (float) ($product['price'] ?? 0) * (int) ($product['quantity'] ?? 0);
}, $products));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | LavaLust Inventory</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #13232c;
            --muted: #6b7c82;
            --paper: #f4f6f2;
            --panel: #ffffff;
            --line: #dce5e1;
            --teal: #087f76;
            --teal-deep: #07544f;
            --coral: #ee735f;
            --gold: #f4bf55;
            --shadow: 0 18px 45px rgba(27, 61, 58, .10);
        }

        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; color: var(--ink); font-family: 'DM Sans', sans-serif; background: var(--paper); }
        body::before { content: ''; position: fixed; inset: 0; pointer-events: none; background: radial-gradient(circle at 92% 5%, rgba(244, 191, 85, .25), transparent 28%), radial-gradient(circle at 3% 96%, rgba(8, 127, 118, .11), transparent 25%); }
        a { color: inherit; }
        button, input { font: inherit; }
        .shell { position: relative; display: grid; grid-template-columns: 244px minmax(0, 1fr); min-height: 100vh; }
        .sidebar { display: flex; flex-direction: column; padding: 30px 18px; color: #dff3ef; background: var(--teal-deep); }
        .brand { display: flex; align-items: center; gap: 11px; margin: 0 10px 52px; color: #fff; text-decoration: none; }
        .brand-mark { display: grid; place-items: center; width: 38px; height: 38px; color: var(--ink); font: 700 1.1rem 'Space Grotesk', sans-serif; border-radius: 11px; background: var(--gold); }
        .brand-name { font: 700 1.15rem 'Space Grotesk', sans-serif; }
        .nav-label { margin: 0 12px 12px; color: #86bdb7; font-size: .7rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; }
        .nav { display: grid; gap: 7px; }
        .nav a { display: flex; align-items: center; gap: 12px; padding: 12px; color: #b8d8d4; font-size: .9rem; text-decoration: none; border: 1px solid transparent; border-radius: 9px; }
        .nav a.active, .nav a:hover { color: #fff; background: rgba(255,255,255,.10); border-color: rgba(255,255,255,.10); }
        .nav-icon { width: 20px; color: var(--gold); text-align: center; font-size: 1rem; }
        .sidebar-footer { margin-top: auto; padding: 16px 12px 0; color: #86bdb7; font-size: .78rem; line-height: 1.6; border-top: 1px solid rgba(255,255,255,.12); }
        .main { width: min(1250px, 100%); margin: 0 auto; padding: 42px clamp(22px, 4vw, 62px) 58px; }
        .topbar { display: flex; align-items: flex-start; justify-content: space-between; gap: 24px; margin-bottom: 34px; }
        .eyebrow { margin: 0 0 8px; color: var(--teal); font-size: .72rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; }
        h1 { margin: 0; color: var(--ink); font: 700 clamp(2rem, 4vw, 3.25rem)/1 'Space Grotesk', sans-serif; }
        .intro { max-width: 520px; margin: 12px 0 0; color: var(--muted); font-size: .98rem; }
        .top-actions { display: flex; align-items: center; gap: 14px; }
        .signed-in { color: var(--muted); font-size: .82rem; text-align: right; }
        .signed-in strong { display: block; color: var(--ink); font-size: .9rem; }
        .button { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 42px; padding: 0 16px; color: #fff; font-size: .86rem; font-weight: 700; text-decoration: none; border: 0; border-radius: 7px; background: var(--teal); box-shadow: 0 8px 16px rgba(8, 127, 118, .18); cursor: pointer; }
        .button:hover { background: #066b64; }
        .button-quiet { color: var(--ink); background: transparent; border: 1px solid var(--line); box-shadow: none; }
        .button-quiet:hover { background: #fff; }
        .notice { margin-bottom: 22px; padding: 13px 16px; color: #13614c; font-size: .9rem; border: 1px solid #bde1d0; border-left: 4px solid #2a9d72; border-radius: 7px; background: #eefaf4; }
        .notice.error { color: #9b392c; border-color: #f0c5bb; border-left-color: var(--coral); background: #fff3f0; }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 28px; }
        .stat { position: relative; overflow: hidden; padding: 20px 22px; background: var(--panel); border: 1px solid var(--line); border-radius: 10px; box-shadow: 0 8px 20px rgba(27, 61, 58, .05); }
        .stat::after { content: ''; position: absolute; right: -18px; bottom: -32px; width: 88px; height: 88px; border: 13px solid rgba(8, 127, 118, .08); border-radius: 50%; }
        .stat-label { color: var(--muted); font-size: .75rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        .stat-value { display: block; margin-top: 8px; font: 700 1.75rem 'Space Grotesk', sans-serif; }
        .inventory { overflow: hidden; background: var(--panel); border: 1px solid var(--line); border-radius: 10px; box-shadow: var(--shadow); }
        .inventory-head { display: flex; align-items: center; justify-content: space-between; gap: 18px; padding: 21px 24px; border-bottom: 1px solid var(--line); }
        .section-title { margin: 0; font: 600 1.18rem 'Space Grotesk', sans-serif; }
        .section-note { margin: 5px 0 0; color: var(--muted); font-size: .82rem; }
        .search { width: min(260px, 100%); padding: 11px 13px 11px 38px; color: var(--ink); border: 1px solid var(--line); border-radius: 7px; outline: none; background: #fbfcfb; }
        .search:focus { border-color: var(--teal); box-shadow: 0 0 0 3px rgba(8, 127, 118, .12); }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; min-width: 760px; border-collapse: collapse; }
        th { padding: 14px 24px; color: var(--muted); font-size: .69rem; font-weight: 700; letter-spacing: .1em; text-align: left; text-transform: uppercase; background: #f7faf8; }
        td { padding: 17px 24px; vertical-align: middle; border-top: 1px solid #edf1ef; font-size: .9rem; }
        tbody tr:hover { background: #fbfdfc; }
        .id { color: #93a3a5; font-size: .78rem; font-weight: 700; }
        .product-name { font-weight: 700; }
        .description { max-width: 285px; color: var(--muted); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .price { color: var(--teal-deep); font-weight: 700; }
        .quantity { display: inline-flex; min-width: 38px; justify-content: center; padding: 4px 8px; color: var(--teal-deep); font-size: .78rem; font-weight: 700; border-radius: 5px; background: #e3f3ed; }
        .date { color: var(--muted); font-size: .82rem; white-space: nowrap; }
        .row-actions { display: flex; align-items: center; gap: 12px; white-space: nowrap; }
        .action-link { color: var(--teal); font-size: .82rem; font-weight: 700; text-decoration: none; }
        .action-link:hover, .delete:hover { text-decoration: underline; }
        .delete { padding: 0; color: var(--coral); font-size: .82rem; font-weight: 700; border: 0; background: none; cursor: pointer; }
        .empty { padding: 56px 24px; color: var(--muted); text-align: center; }
        .empty strong { display: block; margin-bottom: 6px; color: var(--ink); font: 600 1.05rem 'Space Grotesk', sans-serif; }
        .footer { margin-top: 22px; color: var(--muted); font-size: .76rem; }
        .hidden-row { display: none; }
        .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0; }
        @media (max-width: 820px) { .shell { display: block; } .sidebar { padding: 16px 20px; } .brand { margin: 0 0 16px; } .nav-label, .sidebar-footer { display: none; } .nav { display: flex; gap: 5px; overflow-x: auto; } .nav a { padding: 9px 11px; white-space: nowrap; } .main { padding-top: 30px; } }
        @media (max-width: 620px) { .topbar, .inventory-head { align-items: flex-start; flex-direction: column; } .top-actions { width: 100%; justify-content: space-between; } .signed-in { text-align: left; } .stats { grid-template-columns: 1fr; } .stat { padding: 16px 18px; } .inventory-head { padding: 18px; } .search { width: 100%; } th, td { padding-right: 18px; padding-left: 18px; } }
    </style>
</head>
<body>
<div class="shell">
    <aside class="sidebar">
        <a class="brand" href="<?= base_url('products'); ?>"><span class="brand-mark">L</span><span class="brand-name">LavaLust</span></a>
        <p class="nav-label">Workspace</p>
        <nav class="nav" aria-label="Primary navigation">
            <a class="active" href="<?= base_url('products'); ?>"><span class="nav-icon">+</span> Products</a>
            <?php if ($is_admin): ?><a href="<?= base_url('products/create'); ?>"><span class="nav-icon">&#8599;</span> Add product</a><?php endif; ?>
        </nav>
        <div class="sidebar-footer">Inventory workspace<br>Keep your catalogue moving.</div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <p class="eyebrow">Inventory / Overview</p>
                <h1>Products</h1>
                <p class="intro">A clear view of what is in stock, what it is worth, and what needs your attention.</p>
            </div>
            <div class="top-actions">
                <div class="signed-in">Signed in as<strong><?= htmlspecialchars($_SESSION['username'] ?? 'user'); ?></strong></div>
                <?php if ($is_admin): ?><a class="button" href="<?= base_url('products/create'); ?>"><span>+</span> Add product</a><?php endif; ?>
                <a class="button button-quiet" href="<?= base_url('logout'); ?>">Sign out</a>
            </div>
        </header>

        <?php if (!empty($success)): ?><div class="notice" role="status"><?= htmlspecialchars($success); ?></div><?php endif; ?>
        <?php if (!empty($error)): ?><div class="notice error" role="alert"><?= htmlspecialchars($error); ?></div><?php endif; ?>

        <section class="stats" aria-label="Inventory summary">
            <div class="stat"><span class="stat-label">Catalogued products</span><strong class="stat-value"><?= $product_count; ?></strong></div>
            <div class="stat"><span class="stat-label">Units in stock</span><strong class="stat-value"><?= number_format($inventory_units); ?></strong></div>
            <div class="stat"><span class="stat-label">Inventory value</span><strong class="stat-value">&#8369;<?= number_format($inventory_value, 2); ?></strong></div>
        </section>

        <section class="inventory" aria-labelledby="inventory-title">
            <div class="inventory-head">
                <div><h2 class="section-title" id="inventory-title">Product catalogue</h2><p class="section-note"><?= $product_count; ?> <?= $product_count === 1 ? 'item' : 'items'; ?> currently listed</p></div>
                <label><span class="sr-only">Search products</span><input class="search" id="product-search" type="search" placeholder="Search products..." autocomplete="off"></label>
            </div>
            <div class="table-scroll">
                <table>
                    <thead><tr><th scope="col">ID</th><th scope="col">Product</th><th scope="col">Description</th><th scope="col">Price</th><th scope="col">Stock</th><th scope="col">Added</th><?php if ($is_admin): ?><th scope="col">Manage</th><?php endif; ?></tr></thead>
                    <tbody id="product-list">
                    <?php if (!empty($products)): foreach ($products as $product): ?>
                        <tr class="product-row" data-search="<?= htmlspecialchars(strtolower(($product['product_name'] ?? '') . ' ' . ($product['description'] ?? ''))); ?>">
                            <td class="id">#<?= htmlspecialchars($product['id']); ?></td>
                            <td class="product-name"><?= htmlspecialchars($product['product_name']); ?></td>
                            <td class="description" title="<?= htmlspecialchars($product['description'] ?? ''); ?>"><?= htmlspecialchars($product['description'] ?? 'No description'); ?></td>
                            <td class="price">&#8369;<?= number_format((float) $product['price'], 2); ?></td>
                            <td><span class="quantity"><?= (int) $product['quantity']; ?></span></td>
                            <td class="date"><?= htmlspecialchars($product['created_at'] ?? ''); ?></td>
                            <?php if ($is_admin): ?><td><div class="row-actions"><a class="action-link" href="<?= base_url('products/edit/' . (int) $product['id']); ?>">Edit</a><form method="post" action="<?= base_url('products/delete/' . (int) $product['id']); ?>" onsubmit="return confirm('Delete this product?');"><button class="delete" type="submit">Delete</button></form></div></td><?php endif; ?>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td class="empty" colspan="<?= $is_admin ? 7 : 6; ?>"><strong>Your catalogue is empty</strong><?= $is_admin ? 'Add your first product to start tracking inventory.' : 'No products have been added yet.'; ?></td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <p class="footer">LavaLust inventory workspace</p>
    </main>
</div>
<script>
    const search = document.getElementById('product-search');
    const rows = Array.from(document.querySelectorAll('.product-row'));
    search?.addEventListener('input', () => {
        const query = search.value.trim().toLowerCase();
        rows.forEach((row) => row.classList.toggle('hidden-row', query !== '' && !row.dataset.search.includes(query)));
    });
</script>
</body>
</html>
