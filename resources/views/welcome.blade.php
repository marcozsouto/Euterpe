<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
        <link rel="stylesheet" href="{{ asset('css/welcomepage.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="logo"></div>
            <div class="bar">
                <label class='help'>
                <a href="{{ url('/help') }}">
                    <button>Help</button>
                </a>
                </label>
                <label class='signup'>
                @if(Auth::check())
                <a href="{{ url('/logout') }}">
                    <button>Log out</button>
                </a>
                @else
                <a href="{{ url('/signup') }}">
                    <button>Sign Up</button>
                </a>
                @endif
                </label>
                <label class='login'>
                @if(Auth::check() and Auth::user()->username == "euterpe")
                    <a href="{{ url('/euterpe') }}">
                        <button>{{Auth::user()->firstName()}}</button>
                    </a>
                @endif
                @if(Auth::check() and Auth::user()->username != "euterpe")
                    <a href="{{ url('/foryou') }}">
                        <button>{{Auth::user()->firstName()}}</button>
                    </a>    
                @endif
                @if(!Auth::check())
                    <a href="{{ url('/login') }}">
                        <button>Log in</button>
                    </a>
                @endif
                </label>
            </div>
        </header>
        <div class="box1">
            <ul class ="bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            <h1>Conect to Euterpe</h1>
            <h3>Listen, stream and share your favourie artists for free.</h3>
            <label class='button1'>
                <a href="{{ url('/signup') }}">
                    <button>SIGN UP</button>
                </a>
            </label>
            <label class='button2'>
                <a href="{{ url('/login') }}">
                    <button>LEARN MORE</button>
                </a>
            </label>
        </div>
        <div class="box2">
            <h2>Why join us?</h2>
            <h4>Play any song from your favourite artists</h4>
            <div class="photos" align="center">
                <div class = "a">
                    <div class="container">    
                        <img src="{{ asset('css/img/ariana.jpg') }}">
                        <div class = "overlay">
                            <div class = "text">Discover more from Ariana Grande.</div>
                        </div>
                    </div>
                    <div class="container">    
                        <img src="{{ asset('css/img/beyonce.jpg') }}">
                        <div class = "overlay">
                            <div class = "text">Discover more from Beyoncé.</div>
                        </div>
                    </div>
                    <div class="container">    
                        <img src="{{ asset('css/img/blackpink.jpg') }}">
                        <div class = "overlay">
                            <div class = "text">Discover more from BLACKPINK.</div>
                        </div>
                    </div>
                    <div class="container">    
                        <img src="{{ asset('css/img/charli.jpg') }}">
                        <div class = "overlay">
                            <div class = "text">Discover more from Charli XCX.</div>
                        </div>
                    </div>
                    <div class="container">    
                        <img src="{{ asset('css/img/dua-lipa.jpg') }}">
                        <div class = "overlay">
                            <div class = "text">Discover more from Dua Lipa.</div>
                        </div>
                    </div>
                </div>
                <div class ="b">
                    <div class="container">    
                        <img src="{{ asset('css/img/harry.jpeg') }}">
                        <div class = "overlay">
                            <div class = "text">Discover more from Harry Styles.</div>
                        </div>
                    </div>
                    <div class="container">    
                        <img src="{{ asset('css/img/itzy.jpg') }}">
                        <div class = "overlay">
                            <div class = "text">Discover more from ITZY.</div>
                        </div>
                    </div>
                    <div class="container">    
                        <img src="{{ asset('css/img/red-velvet.jpg') }}">
                            <div class = "overlay">
                                <div class = "text">Discover more from Red Velvet.</div>
                            </div>
                    </div>
                    <div class="container">    
                        <img src="{{ asset('css/img/the-weeknd.jpg') }}">
                            <div class = "overlay">
                                <div class = "text">Discover more from The Weeknd.</div>
                            </div>
                    </div>
                    <div class="container">    
                        <img src="{{ asset('css/img/Twice.jpg') }}">
                            <div class = "overlay">
                                <div class = "text">Discover more from TWICE.</div>
                            </div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="box3"></div>
    </body>
</html>
