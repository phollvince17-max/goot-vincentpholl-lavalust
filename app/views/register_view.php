```php
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Bikini Bottom</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Trebuchet MS', 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            color: #17324d;
            overflow-x: hidden;

            background:
                radial-gradient(circle at 15% 20%, rgba(255,255,255,.45) 0 12px, transparent 13px),
                radial-gradient(circle at 85% 30%, rgba(255,255,255,.35) 0 18px, transparent 19px),
                radial-gradient(circle at 25% 75%, rgba(255,255,255,.30) 0 9px, transparent 10px),
                linear-gradient(
                    to bottom,
                    #29d9f5 0%,
                    #16c4e8 45%,
                    #0798c5 75%,
                    #08749b 100%
                );
            position: relative;
        }

        /* Bubbles */
        body::before,
        body::after {
            content: "";
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            opacity: .45;
            border: 3px solid rgba(255,255,255,.7);
        }

        body::before {
            width: 55px;
            height: 55px;
            top: 10%;
            left: 8%;
            box-shadow:
                90px 80px 0 -15px rgba(255,255,255,.35),
                180px 20px 0 -22px rgba(255,255,255,.3),
                820px 130px 0 -10px rgba(255,255,255,.35);
        }

        body::after {
            width: 30px;
            height: 30px;
            bottom: 18%;
            right: 10%;
            box-shadow:
                -100px -70px 0 -7px rgba(255,255,255,.4),
                -180px -20px 0 -12px rgba(255,255,255,.3);
        }

        /* Sand floor */
        .sand {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background:
                radial-gradient(circle, rgba(190,140,40,.25) 2px, transparent 3px),
                #e7c56a;
            background-size: 25px 25px;
            border-top: 5px solid #c69b45;
            z-index: 0;
        }

        /* Seaweed decorations */
        .seaweed {
            position: fixed;
            bottom: 45px;
            font-size: 4rem;
            z-index: 0;
            opacity: .8;
        }

        .seaweed.left {
            left: 3%;
            transform: rotate(-10deg);
        }

        .seaweed.right {
            right: 3%;
            transform: rotate(10deg);
        }

        .card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 410px;
            padding: 2.3rem 2.2rem;
            background: #fff7b8;
            border: 5px solid #e5a92f;
            border-radius: 22px;
            box-shadow:
                0 12px 0 #b87922,
                0 22px 35px rgba(0, 50, 80, .25);
        }

        /* Pineapple icon */
        .logo {
            width: 78px;
            height: 78px;
            margin: -62px auto 1rem;
            border-radius: 50%;
            background: #f6a928;
            border: 5px solid #e5a92f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.7rem;
            box-shadow: 0 5px 0 #b87922;
        }

        h1 {
            text-align: center;
            font-size: 1.75rem;
            font-weight: 900;
            text-transform: uppercase;
            color: #0875b5;
            letter-spacing: .5px;
            text-shadow: 2px 2px 0 #ffe43b;
            margin-bottom: .35rem;
        }

        p.subtitle {
            text-align: center;
            color: #6b5b25;
            font-size: .9rem;
            font-weight: 600;
            margin-bottom: 1.6rem;
        }

        .krusty {
            text-align: center;
            margin-bottom: 1.2rem;
            color: #d47719;
            font-size: .8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        label {
            display: block;
            font-size: .85rem;
            font-weight: 800;
            color: #174d68;
            margin-bottom: .4rem;
        }

        .input-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .input-icon {
            position: absolute;
            left: .85rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            pointer-events: none;
        }

        input {
            width: 100%;
            padding: .75rem .8rem .75rem 2.5rem;
            border: 3px solid #e0bd4d;
            border-radius: 12px;
            background: #fffef0;
            color: #17324d;
            font-size: .95rem;
            font-family: inherit;
            outline: none;
            transition: .2s ease;
        }

        input:focus {
            border-color: #10a9d2;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(16,169,210,.18);
            transform: translateY(-1px);
        }

        input::placeholder {
            color: #9a8d59;
        }

        button {
            width: 100%;
            padding: .85rem;
            margin-top: .35rem;
            background: #f2a51d;
            color: #ffffff;
            border: 3px solid #c8790e;
            border-radius: 13px;
            font-size: 1rem;
            font-family: inherit;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .5px;
            cursor: pointer;
            box-shadow: 0 5px 0 #a85e0b;
            transition: .15s ease;
        }

        button:hover {
            background: #ffb82e;
            transform: translateY(-2px);
            box-shadow: 0 7px 0 #a85e0b;
        }

        button:active {
            transform: translateY(3px);
            box-shadow: 0 2px 0 #a85e0b;
        }

        .msg.error {
            padding: .8rem .9rem;
            border-radius: 12px;
            font-size: .85rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: #ffd4d4;
            color: #a52626;
            border: 3px solid #ed7777;
        }

        .footer-link {
            text-align: center;
            margin-top: 1.4rem;
            padding-top: 1rem;
            border-top: 2px dashed #d8b84d;
            font-size: .85rem;
            color: #6b5b25;
        }

        .footer-link a {
            color: #0788bd;
            text-decoration: none;
            font-weight: 900;
        }

        .footer-link a:hover {
            color: #f08b16;
            text-decoration: underline;
        }

        .bottom-text {
            text-align: center;
            margin-top: 1rem;
            color: #fff;
            font-size: .75rem;
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0,0,0,.4);
        }

        @media (max-width: 480px) {
            body {
                padding: 2rem .8rem 5rem;
            }

            .card {
                padding: 2rem 1.4rem;
            }

            .logo {
                margin-top: -55px;
            }

            h1 {
                font-size: 1.45rem;
            }

            .seaweed {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="seaweed left">🌿</div>
<div class="seaweed right">🌿</div>

<div class="card">

    <div class="logo">🍍</div>

    <div class="krusty">🌊 Welcome to Bikini Bottom 🌊</div>

    <h1>Create Account</h1>

    <p class="subtitle">
        Join the crew and start managing your products!
    </p>

    <?php if (!empty($error)): ?>
        <div class="msg error">
            ⚠️ <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('register'); ?>">

        <label for="username">👤 Username</label>
        <div class="input-group">
            <span class="input-icon">🧽</span>
            <input
                type="text"
                id="username"
                name="username"
                autocomplete="username"
                placeholder="Enter your username"
                required
                autofocus
            >
        </div>

        <label for="email">📧 Email</label>
        <div class="input-group">
            <span class="input-icon">🐌</span>
            <input
                type="email"
                id="email"
                name="email"
                autocomplete="email"
                placeholder="Enter your email"
                required
            >
        </div>

        <label for="password">🔑 Password</label>
        <div class="input-group">
            <span class="input-icon">🗝️</span>
            <input
                type="password"
                id="password"
                name="password"
                autocomplete="new-password"
                minlength="6"
                placeholder="Create a password"
                required
            >
        </div>

        <button type="submit">
            🍔 Register Now!
        </button>

    </form>

    <div class="footer-link">
        Already have an account?
        <a href="<?= base_url('login'); ?>">Log in</a>
    </div>

</div>

<div class="sand"></div>

</body>
</html>
```
