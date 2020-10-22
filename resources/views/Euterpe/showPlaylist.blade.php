<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/showPlaylist.css') }}">
    </head>
        <body>
            <header>
                    <div class="bar">
                </div>
            </header>
                @extends('euterpe.sidebar')
                @extends('euterpe.editPlaylist')
                <div class="box-1">
                    <div class="playlist-icon-overlay">
                        <button  id ="playlist-edit" class="playlist-edit"></button>
                    </div>
                    <img class="playlist-icon" src="http://127.0.0.1:8000/storage/playlist/icon/{{$playlist->icon}}">
                    <h1 class="playlist-name">{{$playlist->name}}</h1>    
                    <h2 class="playlist-user-name">{{$playlist->user->name}}</h2>
                    <h3 class="playlist-description">{{$playlist->description}}</h3>
                    <button class="play">Play</button>        
                    <div class="playlist-line"></div>
                    <h4 class="playlist-song">SONG</h4>
                    <h4 class="playlist-album">ALBUM</h4>
                    <div class="playlist-line-2"></div>
                    <div class="playlist-musics">
                        @foreach($playlist->music as $music)
                            <div class="musics">
                                <div class="music-playlist-line"></div>
                                <img class ="playlist-music-icon" src = "http://127.0.0.1:8000/storage/album/icon/{{$music->album->icon}}">
                                <h4 class="playlist-music-name">{{$music->name}}</h4>
                                <h4 class="playlist-music-artist-name">{{$music->album->artist->name}}</h4>
                                <h4 class="playlist-music-album-name">{{$music->album->name}}</h4>
                                <a href="/euterpe/playlist/remove/{{$playlist->id}}/{{$music->id}}" class="remove-to-playlist"></a>
                            </div>
                        @endforeach 
                    </div>
                </div>

                <script>
                    $(document).on('click','.open_modal',function(){
                    var url = "euterpe/playlist/new";
                    var tour_id= $(this).val(); 
                    });

                    
                </script>
        </body>
</html>