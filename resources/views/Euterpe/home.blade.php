<!DOCTYPE html>
<html >
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <title>Music for Everyone - Euterpe</title>
        <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
        <script type="text/javascript" src="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">

    </head>
    <body>
        <header>
        <div class="bar">
        </div>
        </header>
        @extends('euterpe.sidebar')   
    <div class="box1">

            ''<h1 class="welcome">Welcome, {{Auth::user()->firstName()}}.</h1>
            <div class="line-home" id="home"></div>

            
                    <a href="{{ url('euterpe/playlist') }}">
                        <button class="Playlists">Playlists</button>
                    </a>  
            
                <div class="line-home" id="playlist"></div>
                
                <div class="playlist" id="playlist"> 
                    @foreach($playlists as $playlist)
                        <div class="slide">
                        <img class="playlists" src="http://127.0.0.1:8000/storage/playlist/icon/{{$playlist->icon}}">
                        <h2 class="playlist">{{$playlist->name}}</h2>
                        </div>  
                    @endforeach
                </div>

                <div class="Arrow" id="p_prevArrow"></div>
                <div class="Arrow" id="p_nextArrow"></div>

                    <a href="{{ url('euterpe/album') }}">
                        <button class="Albums" >Albums</button>
                    </a>
            
                <div class="line-home" id="album"></div>

                <div class="album" id="album">    
                    @foreach($albums as $album)
                        <div class="slide">         
                        <img class="albums" src="http://127.0.0.1:8000/storage/album/icon/{{$album->icon}}">
                        <h2 class="albums">{{$album->name}}</h2>
                        </div> 
                    @endforeach
                </div>
                
                <div class="Arrow" id="alb_prevArrow"></div>
                <div class="Arrow" id="alb_nextArrow"></div>

            
                    <a href="{{ url('euterpe/artist') }}">
                        <button class="Artists">Artists</button>
                    </a>
            
                <div class="line-home" id="artist"></div>

                <div class="artist" id="artist"> 
                    @foreach($artists as $artist)
                        <div class="slide">
                        <img class="artists" src="http://127.0.0.1:8000/storage/artist/icon/{{$artist->icon}}">
                        <h2 class="artist">{{$artist->name}}</h2>
                        </div>  
                    @endforeach
                </div>

                <div class="Arrow" id="art_prevArrow"></div>
                <div class="Arrow" id="art_nextArrow"></div>

                <script type="text/javascript">
                
                $('.playlist').slick({
                    infinite: true,
                    slidesToShow: 8,
                    slidesToScroll: 2,
                    variableWidth: true,
                    prevArrow: $("#p_prevArrow"),
                    nextArrow: $("#p_nextArrow"),
                });
                
                $('.album').slick({
                    infinite: true,
                    slidesToShow: 8,
                    slidesToScroll: 2,
                    variableWidth: true,
                    prevArrow: $("#alb_prevArrow"),
                    nextArrow: $("#alb_nextArrow"),
                });
                
                $('.artist').slick({
                    infinite: true,
                    slidesToShow: 8,
                    slidesToScroll: 2,
                    variableWidth: true,
                    prevArrow: $("#art_prevArrow"),
                    nextArrow: $("#art_nextArrow"),
                });
                </script>
    
        </div>
    </body>
</html>