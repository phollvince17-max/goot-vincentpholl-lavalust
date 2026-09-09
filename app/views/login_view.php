```php
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Product Manager</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;

            /* Ocean background */
            background:
                radial-gradient(circle at 20% 20%, rgba(255,255,255,.25) 0 6px, transparent 7px),
                radial-gradient(circle at 80% 70%, rgba(255,255,255,.20) 0 8px, transparent 9px),
                linear-gradient(180deg, #19c9e8 0%, #0b9dcc 50%, #0879ad 100%);

            background-size: 150px 150px, 220px 220px, 100% 100%;

            color: #263238;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        /* Decorative bubbles */
        body::before,
        body::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            border: 3px solid rgba(255,255,255,.35);
            pointer-events: none;
        }

        body::before {
            width: 90px;
            height: 90px;
            left: 8%;
            top: 15%;
            box-shadow:
                120px 250px 0 -25px rgba(255,255,255,.25),
                850px 80px 0 -15px rgba(255,255,255,.25),
                700px 500px 0 -30px rgba(255,255,255,.20);
        }

        body::after {
            width: 35px;
            height: 35px;
            right: 15%;
            bottom: 15%;
            box-shadow:
                -120px -300px 0 5px rgba(255,255,255,.20),
                -650px -100px 0 10px rgba(255,255,255,.18);
        }

        .card {
            position: relative;
            z-index: 2;

            background: #fff8bd;

            width: 100%;
            max-width: 390px;

            padding: 2.4rem 2rem;

            border-radius: 25px;

            border: 5px solid #f2b705;

            box-shadow:
                0 12px 0 #b87900,
                0 20px 35px rgba(0, 60, 100, .35);

            /* Slight pineapple-like texture */
            background-image:
                radial-gradient(#e7ca52 1.5px, transparent 1.5px);
            background-size: 18px 18px;
        }

        /* Decorative pineapple leaves */
        .card::before {
            content: "🍍";
            position: absolute;
            font-size: 55px;
            top: -48px;
            left: 50%;
            transform: translateX(-50%);
            filter: drop-shadow(0 4px 2px rgba(0,0,0,.2));
        }

        h1 {
            text-align: center;

            font-size: 1.8rem;
            font-weight: 900;

            color: #e69b00;

            margin-bottom: .3rem;

            text-shadow:
                2px 2px 0 #fff,
                3px 3px 0 rgba(0,0,0,.12);
        }

        p.subtitle {
            text-align: center;

            color: #176b85;
            font-size: .9rem;

            font-weight: 600;

            margin-bottom: 1.7rem;
        }

        label {
            display: block;

            font-size: .9rem;
            font-weight: 800;

            color: #155e75;

            margin-bottom: .4rem;
        }

        input {
            width: 100%;

            padding: .75rem .9rem;

            border: 3px solid #20a8c7;
            border-radius: 12px;

            background: #fff;

            font-size: .95rem;

            margin-bottom: 1rem;

            color: #263238;

            transition: .2s ease;
        }

        input:focus {
            outline: none;

            border-color: #f2b705;

            box-shadow:
                0 0 0 4px rgba(242,183,5,.2);
        }

        input::placeholder {
            color: #9ca3af;
        }

        button {
            width: 100%;

            padding: .8rem;

            background: #eab308;

            color: #513900;

            border: 3px solid #bd8500;

            border-radius: 12px;

            font-size: 1rem;
            font-weight: 900;

            cursor: pointer;

            box-shadow: 0 4px 0 #9a6900;

            transition: .15s ease;
        }

        button:hover {
            background: #facc15;
            transform: translateY(-2px);
            box-shadow: 0 6px 0 #9a6900;
        }

        button:active {
            transform: translateY(3px);
            box-shadow: 0 1px 0 #9a6900;
        }

        .msg {
            padding: .75rem .9rem;

            border-radius: 12px;

            font-size: .85rem;
            font-weight: 600;

            margin-bottom: 1rem;

            border: 2px solid;
        }

        .msg.error {
            background: #fee2e2;
            color: #991b1b;
            border-color: #ef4444;
        }

        .msg.info {
            background: #dff6ff;
            color: #075985;
            border-color: #22b8cf;
        }

        .msg.success {
            background: #dcfce7;
            color: #166534;
            border-color: #22c55e;
        }

        .footer-link {
            text-align: center;

            margin-top: 1.5rem;

            font-size: .88rem;

            color: #176b85;

            font-weight: 600;
        }

        .footer-link a {
            color: #e69b00;

            text-decoration: none;

            font-weight: 900;
        }

        .footer-link a:hover {
            color: #c77f00;
            text-decoration: underline;
        }

        /* Small seaweed decorations */
        .seaweed {
            position: fixed;
            bottom: -10px;

            font-size: 60px;

            opacity: .6;

            z-index: 1;
        }

        .seaweed.left {
            left: 4%;
        }

        .seaweed.right {
            right: 4%;
        }

        @media (max-width: 500px) {
            .card {
                padding: 2.2rem 1.5rem;
            }

            h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>

<div class="seaweed left">🌿</div>
<div class="seaweed right">🌿</div>

<div class="card">

    <h1>Welcome Back!</h1>

    <p class="subtitle">
        Ready to manage your products?
    </p>

    <?php if (!empty($denied)): ?>
        <div class="msg info">
            Please log in to continue.
        </div>
    <?php endif; ?>

    <?php if (!empty($registered)): ?>
        <div class="msg success">
            Account created. You can now log in.
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="msg error">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('login'); ?>">

        <label for="username">
            Username
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
            Password
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
