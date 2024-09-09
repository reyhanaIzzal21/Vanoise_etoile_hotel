<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vanoise Etoile Hotel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        body {
            background-color: #000;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        header {
            z-index: 999;
            padding: 0 30px;
            margin: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            background-color: rgba(0, 0, 0, .7);
        }
        header .logo-vanoise {
            width: 180px;
        }
        header nav {
            margin: 0;
        }
        header nav .btn-login {
            margin-right: 30px;
        }
        header nav a {
            text-decoration: none;
            color: #F2910A;
            font-size: 15px;
            transition: .3s;
            padding-bottom: 2px;
        }
        header nav a:hover {
            color: #E94822;
            text-shadow: 0 0 1rem #F2910A;
            border-bottom: 2px solid #E94822;
        }

        .background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .content-wrapper {
            position: absolute;
            width: 100%;
            right: 0;
            left: 0;
            z-index: 1;
            color: #FFFFFF;
            text-align: center;
        }

        .h1-header {
            margin: 150px 0 0 0;
            font-weight: bold;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .h1-header .item.one {
            font-size: 150px;
            text-shadow: 0 0 1rem #fff;
        }
        .h1-header .item.two {
            bottom: 25px;
            font-size: 50px;
            position: relative;
            color: #F2910A;
            text-shadow: 0 0 1rem #F2910A;
        }

        .btn-reservation {
            --glow-color: #EFD510;
            --glow-spread-color: rgba(239, 213, 16, 0.781);
            --enhanced-glow-color: #EFD510;
            --btn-color: #fff;
            border: .25em solid var(--glow-color);
            padding: 1em 3em;
            color: var(--glow-color);
            font-size: 15px;
            font-weight: bold;
            background-color: var(--btn-color);
            border-radius: 1em;
            outline: none;
            box-shadow: 0 0 1em .25em var(--glow-color),
                        0 0 4em 1em var(--glow-spread-color),
                        inset 0 0 .75em .25em var(--glow-color);
            text-shadow: 0 0 .5em var(--glow-color);
            position: relative;
            transition: all 0.3s;
            bottom: 10px;
        }

        .btn-reservation::after {
            pointer-events: none;
            content: "";
            position: absolute;
            top: 120%;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: var(--glow-spread-color);
            filter: blur(2em);
            opacity: .7;
            transform: perspective(1.5em) rotateX(35deg) scale(1, .6);
        }

        .btn-reservation:hover {
            color: var(--btn-color);
            background-color: var(--glow-color);
            box-shadow: 0 0 1em .25em var(--glow-color),
                        0 0 4em 2em var(--glow-spread-color),
                        inset 0 0 .75em .25em var(--glow-color);
        }

        .btn-reservation:active {
            box-shadow: 0 0 0.6em .25em var(--glow-color),
                        0 0 2.5em 2em var(--glow-spread-color),
                        inset 0 0 .5em .25em var(--glow-color);
        }

        .container-home {
            padding: 100px 0 0 0;
            text-align: center;
        }
    </style>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <header>
        <img class="logo-vanoise" src="aset/logo-vanoise.png" alt="">
        @if (Route::has('login'))
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}">Beranda</a>
                @else
                    <a href="{{ route('login') }}" class="btn-login">Sign in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Sign Up</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <section class="container-home">
        <video class="background-video" autoplay loop muted>
            <source src="aset/video-home.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        
        <div class="content-wrapper">
            <h1 class="h1-header">
                <span class="item one">VANOISE</span>
                <span class="item two">ÉTOILE HOTEL</span>
            </h1>
            <a class="reservation" href="{{ route('guests.create') }}">
                <button class="btn-reservation">RESERVATION NOW</button>
            </a>
        </div>
    </section>
</body>
</html>
