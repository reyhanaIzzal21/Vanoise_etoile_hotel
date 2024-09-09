<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vanoise Etoile Hotel</title>
    <style>
        :root{
            --yellow: rgb(239, 213, 16);
            --orange: #F2910A;
            --black: #000;
            --white: #dddddd;
        }
        body{
            background-color: transparent;
            margin: 0;
            padding: 0;
        }

        .background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Ensure video stays in the background */
        }

        /* Content styling */
        .content-wrapper {
            position: absolute;
            width: 100%;
            right: 0;
            left: 0;
            z-index: 1; 
            padding: 20px;
            color: #FFFFFF; 
            text-align: center; 
        }

        .h1-header, .reservation {
            margin: 10px 0;
        }
        .container-home .h1-header{
            margin: 100px 0 0 0;
            font-weight: bold;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .container-home .h1-header .item.one{
            font-size: 150px;
            text-shadow: 0 0 1rem #fff;
        }
        .container-home .h1-header .item.two{
            bottom: 45px;
            font-size: 50px;
            position: relative;
            color: var(--yellow);
            text-shadow: 0 0 1rem var(--yellow);
        }

        /* button start */
        /* From Uiverse.io by cssbuttons-io */ 
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
 bottom: 35px;
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
        /* button end */
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    
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
            <a class="reservation" href="{{route('guests.create')}}">
                <button class="btn-reservation">RESERVATION NOW</button>
            </a>            
        </div>
    </section>
    @endsection
</body>
</html>
