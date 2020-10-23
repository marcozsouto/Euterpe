<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/showArtist.css') }}">
    </head>
        <body>
            @include('user.topbar')
            @extends('user.sidebar')
            <div class="box-1">
                <img class="artist-cover" src="http://127.0.0.1:8000/storage/artist/cover/{{$artist->cover}}">
                <img class="artist-icon" src="http://127.0.0.1:8000/storage/artist/icon/{{$artist->icon}}">
                <a href="/home/artist/add/{{$artist->id}}" class="button-add-to-user"></a>  
                <h1 class="artist-name">{{$artist->name}}</h1> 
                <h1 class="artist-albums-h1">Albums</h1> 
                <div class="artist-albums-line"></div>

                <div class="artist-albums">    
                    @foreach($artist->album as $album)
                        <div class="slide-artistpage">         
                        <img class="artist-album-cover" src="http://127.0.0.1:8000/storage/album/icon/{{$album->icon}}">
                        <a href="/home/album/{{$album->id}}"class="artist-album-name">{{$album->name}}</a>
                        </div> 
                    @endforeach
                </div>

                <div class="Arrow" id="prevArrow"></div>
                <div class="Arrow" id="nextArrow"></div>

                
            </div>

            <script type="text/javascript">          
                $('.artist-albums').slick({
                    infinite: true,
                    slidesToShow: 8,
                    slidesToScroll: 3,
                    variableWidth: true,
                    prevArrow: $("#prevArrow"),
                    nextArrow: $("#nextArrow"),
                });
                
              
                </script>
        </body>
</html>