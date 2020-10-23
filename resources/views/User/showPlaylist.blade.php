<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/showPlaylistUser.css') }}">
    </head>
        <body>
                @include('user.topbar')
                @extends('user.sidebar')
                @extends('user.editPlaylist')
                <div class="box-1">
                    <div class="playlist-icon-overlay">
                        @if($playlist->user_id == Auth::user()->id)
                        <button  id ="playlist-edit" class="playlist-edit"></button>
                        @endif
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
                                <button class="play-music-playlist" music_name = "{{$music->name}}" music_artist ="{{$music->album->artist->name}}" music_icon ="{{$music->album->icon}}" music_music ="{{$music->music}}"></button>
                                <h4 class="playlist-music-name">{{$music->name}}</h4>
                                <h4 class="playlist-music-artist-name">{{$music->album->artist->name}}</h4>
                                <h4 class="playlist-music-album-name">{{$music->album->name}}</h4>
                                @if($playlist->user_id == Auth::user()->id)
                                <a href="/home/playlist/remove/{{$playlist->id}}/{{$music->id}}" class="remove-to-playlist"></a>
                                @endif
                            </div>
                        @endforeach 
                    </div>
                </div>

                <script>
                    $(document).on('click','.open_modal',function(){
                    var url = "home/playlist/new";
                    var tour_id= $(this).val(); 
                    });

                    $('.play-music-playlist').click(function() {
                            var music_name = $(this).attr('music_name');
                            var music_artist = $(this).attr('music_artist');
                            var music_icon = $(this).attr('music_icon');
                            var music_file = $(this).attr('music_music');
                
                            document.querySelector('.music-name-play').innerHTML= music_name;
                            document.querySelector('.music-artist-play').innerHTML= music_artist;
                            document.getElementById("music-icon-play").src = "http://127.0.0.1:8000/storage/album/icon/"+music_icon;
                            document.getElementById("audio").src = "http://127.0.0.1:8000/storage/album/music/"+music_file;
                            playPause();
                            playPause();
                    });
                </script>
        </body>
</html>