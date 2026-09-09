```php
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Bikini Bottom Product Manager</title>

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
            align-items: center;
            justify-content: center;
            padding: 30px;

            /* Ocean */
            background:
                radial-gradient(circle at 15% 20%,
                    rgba(255,255,255,.35) 0 4px,
                    transparent 5px),
                radial-gradient(circle at 80% 30%,
                    rgba(255,255,255,.3) 0 7px,
                    transparent 8px),
                radial-gradient(circle at 65% 75%,
                    rgba(255,255,255,.25) 0 5px,
                    transparent 6px),
                linear-gradient(
                    to bottom,
                    #35d5f2 0%,
                    #16b8df 45%,
                    #078dbd 100%
                );

            position: relative;
            overflow: hidden;
        }


        /* =========================================
           BUBBLES
        ========================================= */

        body::before {
            content: "";
            position: absolute;

            width: 70px;
            height: 70px;

            border: 4px solid rgba(255,255,255,.35);
            border-radius: 50%;

            left: 8%;
            top: 12%;

            box-shadow:
                90px 150px 0 -20px rgba(255,255,255,.25),
                650px 80px 0 -10px rgba(255,255,255,.25),
                750px 400px 0 -18px rgba(255,255,255,.25),
                -20px 450px 0 -25px rgba(255,255,255,.2);
        }


        body::after {
            content: "";
            position: absolute;

            width: 25px;
            height: 25px;

            border: 3px solid rgba(255,255,255,.4);
            border-radius: 50%;

            right: 12%;
            top: 20%;

            box-shadow:
                -100px 200px 0 8px rgba(255,255,255,.18),
                100px 330px 0 5px rgba(255,255,255,.2),
                -500px 400px 0 12px rgba(255,255,255,.18);
        }


        /* =========================================
           SANDY OCEAN FLOOR
        ========================================= */

        .sand {
            position: fixed;
            bottom: 0;
            left: 0;

            width: 100%;
            height: 70px;

            background:
                radial-gradient(circle,
                    rgba(170,120,45,.35) 0 3px,
                    transparent 4px),
                #e8c96c;

            background-size: 35px 30px;

            border-top: 5px solid #c5a54e;

            z-index: 0;
        }


        /* =========================================
           SEAWEED
        ========================================= */

        .seaweed {
            position: fixed;
            bottom: 45px;

            font-size: 75px;

            z-index: 1;

            opacity: .8;

            filter: drop-shadow(
                3px 4px 2px rgba(0,0,0,.15)
            );
        }

        .seaweed.left {
            left: 5%;
        }

        .seaweed.right {
            right: 5%;
        }


        /* =========================================
           MAIN LOGIN CARD
        ========================================= */

        .card {
            position: relative;

            z-index: 5;

            width: 100%;
            max-width: 410px;

            padding: 50px 32px 30px;

            background: #ffe94a;

            border: 5px solid #d99c00;

            border-radius: 28px;

            box-shadow:
                0 10px 0 #a86e00,
                0 20px 35px rgba(0,70,100,.35);

            /* Sponge-like dots */
            background-image:
                radial-gradient(
                    circle,
                    rgba(198,151,0,.28) 0 3px,
                    transparent 4px
                );

            background-size: 35px 35px;
        }


        /* Sponge holes */

        .card::after {
            content: "";

            position: absolute;

            width: 35px;
            height: 20px;

            border-radius: 50%;

            background: rgba(193,145,0,.25);

            top: 80px;
            left: 25px;

            box-shadow:
                280px 30px 0 8px rgba(193,145,0,.2),
                310px 180px 0 5px rgba(193,145,0,.2),
                30px 260px 0 6px rgba(193,145,0,.18);
        }


        /* =========================================
           PINEAPPLE ICON
        ========================================= */

        .pineapple {
            position: absolute;

            top: -58px;
            left: 50%;

            transform: translateX(-50%);

            width: 75px;
            height: 75px;

            background: #f5a900;

            border: 4px solid #b87300;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 42px;

            box-shadow:
                0 5px 0 #8e5d00,
                0 8px 15px rgba(0,0,0,.25);
        }


        /* =========================================
           HEADER
        ========================================= */

        h1 {
            text-align: center;

            font-size: 2rem;

            font-weight: 900;

            color: #005b83;

            margin-bottom: 5px;

            text-transform: uppercase;

            text-shadow:
                2px 2px 0 #fff6a3,
                3px 3px 0 rgba(0,0,0,.12);
        }

        .subtitle {
            text-align: center;

            color: #704c00;

            font-size: .9rem;

            font-weight: 700;

            margin-bottom: 25px;
        }


        /* =========================================
           LABELS
        ========================================= */

        label {
            display: block;

            color: #075b78;

            font-size: .9rem;

            font-weight: 900;

            margin-bottom: 6px;
        }


        /* =========================================
           INPUTS
        ========================================= */

        input {
            width: 100%;

            padding: 13px 14px;

            border-radius: 12px;

            border: 3px solid #087ea6;

            background: #ffffff;

            color: #263238;

            font-size: .95rem;

            font-weight: 600;

            margin-bottom: 17px;

            transition: .2s ease;
        }

        input::placeholder {
            color: #8b9aa1;
        }

        input:focus {
            outline: none;

            border-color: #e19a00;

            box-shadow:
                0 0 0 4px rgba(225,154,0,.2);

            transform: translateY(-1px);
        }


        /* =========================================
           LOGIN BUTTON
        ========================================= */

        button {
            width: 100%;

            padding: 13px;

            border-radius: 13px;

            border: 3px solid #9b6700;

            background: #e9a900;

            color: #fff;

            font-size: 1rem;

            font-weight: 900;

            cursor: pointer;

            text-transform: uppercase;

            box-shadow:
                0 5px 0 #855600;

            transition: .15s ease;
        }

        button:hover {
            background: #ffc400;

            transform: translateY(-2px);

            box-shadow:
                0 7px 0 #855600;
        }

        button:active {
            transform: translateY(3px);

            box-shadow:
                0 2px 0 #855600;
        }


        /* =========================================
           MESSAGES
        ========================================= */

        .msg {
            padding: 11px 13px;

            border-radius: 12px;

            font-size: .85rem;

            font-weight: 700;

            margin-bottom: 15px;

            border: 3px solid;
        }

        .msg.error {
            background: #ffd5d5;

            color: #9b1c1c;

            border-color: #e33;
        }

        .msg.info {
            background: #d7f5ff;

            color: #075b78;

            border-color: #17a8d1;
        }

        .msg.success {
            background: #d9ffd9;

            color: #176b25;

            border-color: #28a745;
        }


        /* =========================================
           REGISTER LINK
        ========================================= */

        .footer-link {
            text-align: center;

            margin-top: 22px;

            color: #704c00;

            font-size: .88rem;

            font-weight: 700;
        }

        .footer-link a {
            color: #006b96;

            font-weight: 900;

            text-decoration: none;
        }

        .footer-link a:hover {
            color: #004b6b;

            text-decoration: underline;
        }


        /* =========================================
           MOBILE
        ========================================= */

        @media (max-width: 500px) {

            body {
                padding: 20px;
            }

            .card {
                padding: 45px 22px 25px;
            }

            h1 {
                font-size: 1.55rem;
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

    <!-- Seaweed decorations -->
    <div class="seaweed left">🌿</div>
    <div class="seaweed right">🌿</div>


    <!-- LOGIN CARD -->
    <div class="card">

        <div class="pineapple">
            🍍
        </div>

        <h1>Welcome Back!</h1>

        <p class="subtitle">
            Welcome to your underwater product manager!
        </p>


        <?php if (!empty($denied)): ?>
            <div class="msg info">
                🌊 Please log in to continue.
            </div>
        <?php endif; ?>


        <?php if (!empty($registered)): ?>
            <div class="msg success">
                ⭐ Account created! You can now log in.
            </div>
        <?php endif; ?>


        <?php if (!empty($error)): ?>
            <div class="msg error">
                ⚠️ <?= htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>


        <form method="post" action="<?= base_url('login'); ?>">

            <label for="username">
                👤 Username
            </label>

            <input
                type="text"
                id="username"
                name="username"
                autocomplete="username"
                placeholder="Enter your username"
                required
                autofocus
            >


            <label for="password">
                🔑 Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                autocomplete="current-password"
                placeholder="Enter your password"
                required
            >


            <button type="submit">
                🍍 LOG IN
            </button>

        </form>


        <div class="footer-link">
            Don't have an account?
            <a href="<?= base_url('register'); ?>">
                Register
            </a>
        </div>

    </div>

</body>
</html>
```
