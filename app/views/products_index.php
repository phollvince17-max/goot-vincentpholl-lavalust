<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$is_admin = (($_SESSION['role'] ?? null) === 'admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Bikini Bottom Product Manager</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Trebuchet MS", "Segoe UI", Arial, sans-serif;
            min-height: 100vh;
            padding: 35px 20px 100px;
            color: #17445a;
            position: relative;
            overflow-x: hidden;

            /* Underwater background */
            background:
                radial-gradient(circle at 10% 15%,
                    rgba(255,255,255,.35) 0 5px,
                    transparent 6px),
                radial-gradient(circle at 85% 20%,
                    rgba(255,255,255,.3) 0 8px,
                    transparent 9px),
                radial-gradient(circle at 65% 65%,
                    rgba(255,255,255,.25) 0 6px,
                    transparent 7px),
                linear-gradient(
                    to bottom,
                    #2bd5f3 0%,
                    #0db6dc 45%,
                    #087da7 100%
                );
        }

        /* Bubbles */
        body::before {
            content: "";
            position: fixed;
            width: 65px;
            height: 65px;
            border: 4px solid rgba(255,255,255,.35);
            border-radius: 50%;
            left: 5%;
            top: 10%;
            pointer-events: none;

            box-shadow:
                100px 180px 0 -20px rgba(255,255,255,.25),
                700px 100px 0 -10px rgba(255,255,255,.25),
                800px 400px 0 -17px rgba(255,255,255,.2),
                -20px 500px 0 -22px rgba(255,255,255,.2);
        }

        body::after {
            content: "";
            position: fixed;
            width: 25px;
            height: 25px;
            border: 3px solid rgba(255,255,255,.4);
            border-radius: 50%;
            right: 8%;
            top: 28%;
            pointer-events: none;

            box-shadow:
                -120px 180px 0 8px rgba(255,255,255,.18),
                80px 280px 0 5px rgba(255,255,255,.2),
                -500px 350px 0 10px rgba(255,255,255,.18);
        }

        /* Sandy floor */
        .sand {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 70px;

            background:
                radial-gradient(
                    circle,
                    rgba(170,120,45,.35) 0 3px,
                    transparent 4px
                ),
                #e8c96d;

            background-size: 35px 30px;
            border-top: 5px solid #c3a04b;
            z-index: 1;
        }

        /* Seaweed */
        .seaweed {
            position: fixed;
            bottom: 38px;
            font-size: 75px;
            opacity: .8;
            z-index: 2;
            filter: drop-shadow(3px 4px 2px rgba(0,0,0,.2));
        }

        .seaweed.left {
            left: 3%;
        }

        .seaweed.right {
            right: 3%;
        }

        /* Main wrapper */
        .wrap {
            max-width: 1150px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        /* Header */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;

            background: #ffe94a;
            border: 5px solid #d49a00;
            border-radius: 22px;
            padding: 18px 22px;

            box-shadow:
                0 7px 0 #a86e00,
                0 15px 30px rgba(0,60,90,.3);

            background-image:
                radial-gradient(
                    circle,
                    rgba(190,145,0,.22) 0 3px,
                    transparent 4px
                );

            background-size: 35px 35px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .brand-icon {
            width: 58px;
            height: 58px;

            display: flex;
            justify-content: center;
            align-items: center;

            background: #f4a900;
            border: 4px solid #b87500;
            border-radius: 50%;

            font-size: 31px;

            box-shadow:
                0 4px 0 #8e5d00;
        }

        h1 {
            font-size: 1.7rem;
            font-weight: 900;
            color: #075a7b;
            text-transform: uppercase;

            text-shadow:
                2px 2px 0 #fff7a5,
                3px 3px 0 rgba(0,0,0,.12);
        }

        .subtitle {
            color: #765100;
            font-size: .82rem;
            font-weight: 700;
            margin-top: 2px;
        }

        /* Header actions */
        .actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;
            flex-wrap: wrap;
        }

        .user-info {
            font-size: .82rem;
            color: #705000;
            font-weight: 700;
            margin-right: 5px;
        }

        .user-info strong {
            color: #075a7b;
        }

        .view-only {
            background: #d9f7ff;
            color: #075b78;
            padding: 4px 8px;
            border-radius: 7px;
            font-size: .7rem;
            font-weight: 900;
            margin-left: 5px;
            border: 2px solid #168bb0;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 9px 14px;
            border-radius: 11px;

            font-size: .82rem;
            font-weight: 900;

            text-decoration: none;
            border: 3px solid;
            cursor: pointer;

            transition: .15s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background: #e8a900;
            color: #fff;
            border-color: #966300;

            box-shadow:
                0 4px 0 #805400;
        }

        .btn-primary:hover {
            background: #ffc400;
        }

        .btn-muted {
            background: #d9f6ff;
            color: #075b78;
            border-color: #1686aa;

            box-shadow:
                0 4px 0 #08617e;
        }

        .btn-muted:hover {
            background: #fff;
        }

        .btn-danger {
            background: #e33c35;
            color: #fff;
            border-color: #a5211c;

            box-shadow:
                0 4px 0 #7f1714;
        }

        .btn-danger:hover {
            background: #ff5048;
        }

        .btn-sm {
            padding: 7px 11px;
            font-size: .75rem;
        }

        /* Messages */
        .msg {
            padding: 12px 15px;
            border-radius: 13px;
            font-size: .85rem;
            font-weight: 800;
            margin-bottom: 18px;
            border: 3px solid;
        }

        .msg.success {
            background: #d9ffd9;
            color: #176b25;
            border-color: #2ba548;
        }

        .msg.success::before {
            content: "⭐ ";
        }

        .msg.error {
            background: #ffd6d6;
            color: #991b1b;
            border-color: #df3333;
        }

        .msg.error::before {
            content: "⚠️ ";
        }

        /* Product panel */
        .panel {
            background: #fff8c7;
            border: 5px solid #d49a00;
            border-radius: 22px;
            overflow: hidden;

            box-shadow:
                0 8px 0 #a86e00,
                0 18px 35px rgba(0,60,90,.35);
        }

        /* Panel header */
        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 15px 20px;

            background: #087da5;
            color: #fff;

            border-bottom: 5px solid #075c79;
        }

        .panel-title {
            font-size: 1rem;
            font-weight: 900;
            text-transform: uppercase;
        }

        .panel-title::before {
            content: "🍍 ";
        }

        .panel-note {
            font-size: .75rem;
            font-weight: 700;
            opacity: .9;
        }

        /* Table */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th,
        td {
            padding: 14px 13px;
            text-align: left;
            font-size: .85rem;
        }

        th {
            background: #ffe33e;
            color: #075a7b;
            font-weight: 900;
            text-transform: uppercase;
            font-size: .76rem;

            border-bottom: 4px solid #d49a00;
        }

        tbody tr {
            background: #fffdf0;
            transition: .15s ease;
        }

        tbody tr:nth-child(even) {
            background: #fff6c5;
        }

        tbody tr:hover {
            background: #dff8ff;
        }

        td {
            border-bottom: 2px solid #f0df91;
            color: #28576a;
            font-weight: 600;
        }

        td:first-child {
            font-weight: 900;
            color: #08739a;
        }

        td:nth-child(2) {
            font-weight: 900;
            color: #075a7b;
        }

        td.desc {
            max-width: 260px;
            color: #527080;
        }

        td.numeric {
            text-align: right;
            white-space: nowrap;
        }

        /* Price */
        .price {
            color: #087b4b;
            font-weight: 900;
        }

        /* Quantity badge */
        .quantity {
            display: inline-block;
            min-width: 40px;
            text-align: center;

            background: #d8f7ff;
            color: #075b78;

            padding: 5px 8px;
            border-radius: 8px;

            border: 2px solid #168bb0;

            font-weight: 900;
        }

        /* Actions */
        .row-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        form.inline {
            display: inline;
        }

        /* Empty table */
        .empty {
            padding: 50px 20px !important;
            text-align: center;
            color: #6b7e86;
            font-weight: 700;
        }

        .empty::before {
            content: "🍍";
            display: block;
            font-size: 45px;
            margin-bottom: 10px;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 22px;

            color: #eaffff;
            font-size: .8rem;
            font-weight: 700;

            text-shadow: 1px 1px 2px rgba(0,0,0,.25);
        }

        /* Responsive */
        @media (max-width: 850px) {
            .topbar {
                align-items: flex-start;
            }

            .actions {
                width: 100%;
                justify-content: flex-start;
            }

            .user-info {
                width: 100%;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 20px 10px 90px;
            }

            .topbar {
                padding: 16px;
            }

            .brand {
                width: 100%;
            }

            .brand-icon {
                width: 50px;
                height: 50px;
                font-size: 27px;
            }

            h1 {
                font-size: 1.35rem;
            }

            .subtitle {
                font-size: .72rem;
            }

            .actions {
                flex-direction: column;
                align-items: stretch;
            }

            .actions .btn {
                text-align: center;
            }

            .user-info {
                text-align: center;
            }

            .panel {
                border-radius: 17px;
            }

            .panel-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

            .seaweed {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Ocean floor -->
    <div class="sand"></div>

    <!-- Decorative seaweed -->
    <div class="seaweed left">🌿</div>
    <div class="seaweed right">🌿</div>

    <div class="wrap">

        <!-- Top Header -->
        <div class="topbar">

            <div class="brand">

                <div class="brand-icon">
                    🍍
                </div>

                <div>
                    <h1>Products</h1>

                    <div class="subtitle">
                        Bikini Bottom Product Manager
                    </div>
                </div>

            </div>

            <div class="actions">

                <span class="user-info">
                    🌊 Signed in as
                    <strong>
                        <?= htmlspecialchars($_SESSION['username'] ?? ''); ?>
                    </strong>

                    <?php if (!$is_admin): ?>
                        <span class="view-only">
                            VIEW ONLY
                        </span>
                    <?php endif; ?>
                </span>

                <?php if ($is_admin): ?>

                    <a
                        class="btn btn-primary"
                        href="<?= base_url('products/create'); ?>"
                    >
                        🍍 Add Product
                    </a>

                <?php endif; ?>

                <a
                    class="btn btn-muted"
                    href="<?= base_url('logout'); ?>"
                >
                    🚪 Logout
                </a>

            </div>

        </div>

        <!-- Messages -->
        <?php if (!empty($success)): ?>

            <div class="msg success">
                <?= htmlspecialchars($success); ?>
            </div>

        <?php endif; ?>

        <?php if (!empty($error)): ?>

            <div class="msg error">
                <?= htmlspecialchars($error); ?>
            </div>

        <?php endif; ?>


        <!-- Products Panel -->
        <div class="panel">

            <div class="panel-header">

                <div class="panel-title">
                    Krusty Krab Product Inventory
                </div>

                <div class="panel-note">
                    🐚 Manage your products below
                </div>

            </div>

            <div class="table-container">

                <table>

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Created</th>

                            <?php if ($is_admin): ?>
                                <th>Actions</th>
                            <?php endif; ?>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($products)): ?>

                            <?php foreach ($products as $product): ?>

                                <tr>

                                    <td>
                                        #<?= htmlspecialchars($product['id']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($product['product_name']); ?>
                                    </td>

                                    <td class="desc">
                                        <?= htmlspecialchars($product['description']); ?>
                                    </td>

                                    <td class="numeric price">
                                        ₱<?= number_format((float) $product['price'], 2); ?>
                                    </td>

                                    <td class="numeric">
                                        <span class="quantity">
                                            <?= htmlspecialchars($product['quantity']); ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($product['created_at'] ?? ''); ?>
                                    </td>

                                    <?php if ($is_admin): ?>

                                        <td>

                                            <div class="row-actions">

                                                <a
                                                    class="btn btn-muted btn-sm"
                                                    href="<?= base_url('products/edit/' . $product['id']); ?>"
                                                >
                                                    ✏️ Edit
                                                </a>

                                                <form
                                                    class="inline"
                                                    method="post"
                                                    action="<?= base_url('products/delete/' . $product['id']); ?>"
                                                    onsubmit="return confirm('Delete this product?');"
                                                >

                                                    <button
                                                        type="submit"
                                                        class="btn btn-danger btn-sm"
                                                    >
                                                        🗑️ Delete
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    <?php endif; ?>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td
                                    colspan="<?= $is_admin ? 7 : 6; ?>"
                                    class="empty"
                                >

                                    <?= $is_admin
                                        ? 'No products yet. Click "Add Product" to create one.'
                                        : 'No products yet.'; ?>

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

        <div class="footer">
            🌊 Welcome to Bikini Bottom! • Product Management System 🍍
        </div>

    </div>

</body>
</html>
