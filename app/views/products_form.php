<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$is_edit = ($mode === 'edit');
$form_action = $is_edit ? base_url('products/edit/' . $product['id']) : base_url('products/create');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $is_edit ? 'Edit Product' : 'Add Product'; ?> | Bikini Bottom</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Trebuchet MS", "Segoe UI", Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;

            /* Bikini Bottom ocean background */
            background:
                radial-gradient(circle at 15% 20%,
                    rgba(255,255,255,.35) 0 5px,
                    transparent 6px),
                radial-gradient(circle at 80% 15%,
                    rgba(255,255,255,.3) 0 8px,
                    transparent 9px),
                radial-gradient(circle at 70% 70%,
                    rgba(255,255,255,.25) 0 6px,
                    transparent 7px),
                linear-gradient(
                    to bottom,
                    #29d4f2 0%,
                    #0db5dc 45%,
                    #087da8 100%
                );
        }

        /* Extra bubbles */
        body::before {
            content: "";
            position: fixed;
            width: 55px;
            height: 55px;
            border: 4px solid rgba(255,255,255,.35);
            border-radius: 50%;
            left: 8%;
            top: 12%;

            box-shadow:
                80px 150px 0 -18px rgba(255,255,255,.25),
                650px 80px 0 -8px rgba(255,255,255,.3),
                720px 350px 0 -15px rgba(255,255,255,.25),
                -20px 430px 0 -20px rgba(255,255,255,.2);
        }

        body::after {
            content: "";
            position: fixed;
            width: 22px;
            height: 22px;
            border: 3px solid rgba(255,255,255,.4);
            border-radius: 50%;
            right: 12%;
            top: 20%;

            box-shadow:
                -100px 200px 0 7px rgba(255,255,255,.18),
                90px 300px 0 5px rgba(255,255,255,.2),
                -500px 350px 0 10px rgba(255,255,255,.18);
        }

        /* Sandy ocean floor */
        .sand {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 65px;

            background:
                radial-gradient(
                    circle,
                    rgba(170,120,45,.35) 0 3px,
                    transparent 4px
                ),
                #e8ca70;

            background-size: 35px 30px;
            border-top: 5px solid #c4a34d;
            z-index: 1;
        }

        /* Decorative seaweed */
        .seaweed {
            position: fixed;
            bottom: 35px;
            font-size: 70px;
            z-index: 2;
            opacity: .8;
            filter: drop-shadow(3px 4px 2px rgba(0,0,0,.2));
        }

        .seaweed.left {
            left: 5%;
        }

        .seaweed.right {
            right: 5%;
        }

        /* Main card */
        .card {
            position: relative;
            z-index: 10;

            width: 100%;
            max-width: 550px;

            padding: 55px 35px 35px;

            background: #ffe94a;

            border: 5px solid #d59b00;
            border-radius: 28px;

            box-shadow:
                0 9px 0 #a96f00,
                0 20px 40px rgba(0,65,90,.4);

            /* Sponge-like dots */
            background-image:
                radial-gradient(
                    circle,
                    rgba(190,145,0,.25) 0 3px,
                    transparent 4px
                );

            background-size: 34px 34px;
        }

        /* Pineapple decoration */
        .pineapple {
            position: absolute;
            top: -48px;
            left: 50%;
            transform: translateX(-50%);

            width: 78px;
            height: 78px;

            display: flex;
            justify-content: center;
            align-items: center;

            background: #f4a900;

            border: 4px solid #b87500;
            border-radius: 50%;

            font-size: 42px;

            box-shadow:
                0 5px 0 #8d5d00,
                0 8px 18px rgba(0,0,0,.25);
        }

        /* Header */
        .topline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 25px;
        }

        h1 {
            font-size: 1.8rem;
            font-weight: 900;
            color: #075b7b;
            text-transform: uppercase;

            text-shadow:
                2px 2px 0 #fff7a5,
                3px 3px 0 rgba(0,0,0,.12);
        }

        a.back {
            font-size: .85rem;
            color: #006b91;
            text-decoration: none;
            font-weight: 900;

            background: #d9f8ff;
            padding: 8px 12px;

            border: 2px solid #087da6;
            border-radius: 10px;

            transition: .2s ease;
        }

        a.back:hover {
            background: #ffffff;
            transform: translateY(-2px);
        }

        /* Labels */
        label {
            display: block;
            color: #075b78;
            font-size: .9rem;
            font-weight: 900;
            margin-bottom: 7px;
        }

        /* Inputs */
        input,
        textarea {
            width: 100%;

            padding: 13px 14px;

            border: 3px solid #0a7da5;
            border-radius: 12px;

            background: #ffffff;

            color: #263238;

            font-size: .95rem;
            font-family: inherit;
            font-weight: 600;

            margin-bottom: 18px;

            transition: .2s ease;
        }

        textarea {
            resize: vertical;
            min-height: 110px;
        }

        input::placeholder,
        textarea::placeholder {
            color: #9aa6ab;
        }

        input:focus,
        textarea:focus {
            outline: none;

            border-color: #e0a000;

            box-shadow:
                0 0 0 4px rgba(224,160,0,.2);

            transform: translateY(-1px);
        }

        /* Price + quantity */
        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        /* Main button */
        button {
            width: 100%;

            padding: 14px;

            margin-top: 5px;

            background: #e7a900;
            color: #ffffff;

            border: 3px solid #966300;
            border-radius: 13px;

            font-size: 1rem;
            font-weight: 900;

            cursor: pointer;
            text-transform: uppercase;

            box-shadow:
                0 5px 0 #805400;

            transition: .15s ease;
        }

        button:hover {
            background: #ffc400;

            transform: translateY(-2px);

            box-shadow:
                0 7px 0 #805400;
        }

        button:active {
            transform: translateY(3px);

            box-shadow:
                0 2px 0 #805400;
        }

        /* Messages */
        .msg {
            padding: 12px 14px;

            border-radius: 12px;

            font-size: .85rem;
            font-weight: 800;

            margin-bottom: 18px;

            border: 3px solid;
        }

        .msg.error {
            background: #ffd6d6;
            color: #991b1b;
            border-color: #df3333;
        }

        .msg.success {
            background: #d8ffd9;
            color: #176b25;
            border-color: #2ba548;
        }

        /* Footer decoration */
        .footer-note {
            text-align: center;
            margin-top: 18px;

            color: #755000;

            font-size: .8rem;
            font-weight: 700;
        }

        /* Mobile */
        @media (max-width: 600px) {
            body {
                padding: 30px 15px;
            }

            .card {
                padding: 50px 22px 28px;
            }

            .topline {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }

            h1 {
                font-size: 1.5rem;
            }

            a.back {
                display: block;
                text-align: center;
            }

            .row {
                grid-template-columns: 1fr;
                gap: 0;
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

    <!-- Main card -->
    <div class="card">

        <!-- Pineapple -->
        <div class="pineapple">
            🍍
        </div>

        <div class="topline">

            <h1>
                <?= $is_edit ? 'Edit Product' : 'Add Product'; ?>
            </h1>

            <a class="back" href="<?= base_url('products'); ?>">
                🌊 Back to List
            </a>

        </div>

        <!-- Error -->
        <?php if (!empty($error)): ?>
            <div class="msg error">
                ⚠️ <?= htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <!-- Success -->
        <?php if (!empty($success)): ?>
            <div class="msg success">
                ⭐ <?= htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= $form_action; ?>">

            <!-- Product Name -->
            <label for="product_name">
                🍍 Product Name
            </label>

            <input
                type="text"
                id="product_name"
                name="product_name"
                maxlength="100"
                required
                placeholder="Enter product name"
                value="<?= htmlspecialchars($product['product_name'] ?? ''); ?>"
                autofocus
            >

            <!-- Description -->
            <label for="description">
                📝 Description
            </label>

            <textarea
                id="description"
                name="description"
                placeholder="Describe your product..."
            ><?= htmlspecialchars($product['description'] ?? ''); ?></textarea>

            <!-- Price and Quantity -->
            <div class="row">

                <div>
                    <label for="price">
                        💰 Price
                    </label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        step="0.01"
                        min="0"
                        required
                        placeholder="0.00"
                        value="<?= htmlspecialchars($product['price'] ?? ''); ?>"
                    >
                </div>

                <div>
                    <label for="quantity">
                        📦 Quantity
                    </label>

                    <input
                        type="number"
                        id="quantity"
                        name="quantity"
                        step="1"
                        min="0"
                        required
                        placeholder="0"
                        value="<?= htmlspecialchars($product['quantity'] ?? ''); ?>"
                    >
                </div>

            </div>

            <!-- Submit -->
            <button type="submit">
                <?= $is_edit ? '⭐ Save Changes' : '🍍 Add Product'; ?>
            </button>

        </form>

        <div class="footer-note">
            🌊 Welcome to Bikini Bottom Product Manager!
        </div>

    </div>

</body>
</html>
