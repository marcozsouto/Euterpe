<!DOCTYPE html>
<html >
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <title>Music for Everyone - Euterpe</title>
        <link rel="stylesheet" href="{{ asset('css/homepageUser.css') }}">
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
        <script type="text/javascript" src="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">

    </head>
    <body>
        @include('user.topbar')
        @extends('user.sidebar')   
    <div class="box1">
    ''<h1 class="welcome">Welcome, {{Auth::user()->firstName()}}.</h1>
            <div class="line-home" id="home"></div>

            
                
                        <button class="Playlists-homepage">For you</button>
                    
            
                <div class="line-home" id="playlist"></div>
                
                <div class="playlist-homepage" id="playlist"> 
                    @foreach($playlists as $playlist)
                        <div class="slide-homepage">
                        <img class="playlists-homepage" src="http://127.0.0.1:8000/storage/playlist/icon/{{$playlist->icon}}">
                        <a href="home/playlist/{{$playlist->id}}"class="playlist-homepage-user">{{$playlist->name}}</a>
                        </div>  
                    @endforeach
                </div>

                <div class="Arrow" id="p_prevArrow"></div>
                <div class="Arrow" id="p_nextArrow"></div>

                    <a href="{{ url('home/album') }}">
                        <button class="Albums-homepage" >Albums</button>
                    </a>
            
                <div class="line-home" id="album"></div>

                <div class="album-homepage" id="album">    
                    @foreach($albums as $album)
                        <div class="slide-homepage">         
                        <img class="albums-homepage" src="http://127.0.0.1:8000/storage/album/icon/{{$album->icon}}">
                        <h2 class="albums-homepage">{{$album->name}}</h2>
                        </div> 
                    @endforeach
                </div>
                
                <div class="Arrow" id="alb_prevArrow"></div>
                <div class="Arrow" id="alb_nextArrow"></div>

            
                    <a href="{{ url('home/artist') }}">
                        <button class="Artists-homepage">Artists</button>
                    </a>
            
                <div class="line-home" id="artist"></div>

                <div class="artist-homepage" id="artist"> 
                    @foreach($artists as $artist)
                        <div class="slide-homepage">
                        <img class="artists-homepage" src="http://127.0.0.1:8000/storage/artist/icon/{{$artist->icon}}">
                        <h2 class="artist-homepage">{{$artist->name}}</h2>
                        </div>  
                    @endforeach
                </div>

                <div class="Arrow" id="art_prevArrow"></div>
                <div class="Arrow" id="art_nextArrow"></div>

                <script type="text/javascript">
                
                $('.playlist-homepage').slick({
                    infinite: true,
                    slidesToShow: 8,
                    slidesToScroll: 2,
                    variableWidth: true,
                    prevArrow: $("#p_prevArrow"),
                    nextArrow: $("#p_nextArrow"),
                });
                
                $('.album-homepage').slick({
                    infinite: true,
                    slidesToShow: 8,
                    slidesToScroll: 2,
                    variableWidth: true,
                    prevArrow: $("#alb_prevArrow"),
                    nextArrow: $("#alb_nextArrow"),
                });
                
                $('.artist-homepage').slick({
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