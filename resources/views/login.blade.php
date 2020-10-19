<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="overlay"></div>
        <div class="container">
            <img src="css/img/ariana.jpg">
            <img src="css/img/beyonce.jpg">
            <img src="css/img/blackpink.jpg">
            <img src="css/img/charli.jpg">
            <img src="css/img/dua-lipa.jpg">
            <img src="css/img/itzy.jpg">
            <img src="css/img/red-velvet.jpg">
            <img src="css/img/the-weeknd.jpg">
            <img src="css/img/twice.jpg">
            <img src="css/img/ariana.jpg">
            <img src="css/img/beyonce.jpg">
            <img src="css/img/blackpink.jpg">
            <img src="css/img/charli.jpg">
            <img src="css/img/dua-lipa.jpg">
            <img src="css/img/itzy.jpg">
            <img src="css/img/red-velvet.jpg">
            <img src="css/img/the-weeknd.jpg">
            <img src="css/img/twice.jpg">
            <img src="css/img/ariana.jpg">
            <img src="css/img/beyonce.jpg">
            <img src="css/img/blackpink.jpg">
            <img src="css/img/charli.jpg">
            <img src="css/img/dua-lipa.jpg">
            <img src="css/img/itzy.jpg"> 
            <img src="css/img/red-velvet.jpg">
            <img src="css/img/the-weeknd.jpg">
            <img src="css/img/twice.jpg">
            <img src="css/img/ariana.jpg">
            <img src="css/img/beyonce.jpg">
            <img src="css/img/blackpink.jpg">
            <img src="css/img/charli.jpg">
            <img src="css/img/dua-lipa.jpg">
            <img src="css/img/itzy.jpg">
            <img src="css/img/red-velvet.jpg">
            <img src="css/img/the-weeknd.jpg">
            <img src="css/img/twice.jpg">
            <img src="css/img/ariana.jpg">
            <img src="css/img/beyonce.jpg">
            <img src="css/img/blackpink.jpg">
            <img src="css/img/charli.jpg">
            <img src="css/img/dua-lipa.jpg">
            <img src="css/img/itzy.jpg">           
        </div>
        <div class="box2">
        <h1>Log in</h1>
        <form action="{{route('login.do')}}" method="post" >
        @csrf
            <label class="username" for="username">Username</label><br>
            <input type="text" name="username" placeholder="Enter your username."></input>
            </br>
            <label class="password" for="password" >Password</label><br>
            <input type="password" name="password" placeholder="Enter your password."></input>
            </br>
            <input type="submit" value="Log In"></input>
            <div class="line"></div>
        </form>
        <h2>Don't have a account?</h2>
            <a href="{{ url('/signup') }}">
                <button>SIGN UP</button>
            </a>
        </div>
    </body>
</html>