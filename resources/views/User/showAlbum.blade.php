<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/showAlbumUser.css') }}">
    </head>
    <body>
        @include('user.topbar')
        @extends('user.sidebar')
        <div class="box-1">
        <div class="album-icon-overlay">
        <a href="/home/album/add/{{$album->id}}" class="button-add-to-user"></a>    
        </div>
        <img class="album-icon" src="http://127.0.0.1:8000/storage/album/icon/{{$album->icon}}">
        <h1 class="album-name">{{$album->name}}</h1>    
        <h2 class="artist-album-name">{{$album->artist->name}}</h2>
        <h3 class="album-description">{{$album->description}}</h3>
        <h4  class="album-gender">{{$album->gender}} · {{substr($album->releaseDate,0,4)}}</h4>
        <button class="play">Play</button>
        <div class="album-line"></div>
        {{$index = 0}}
        <div class="album-musics">
            @foreach($album->music as $music)
                <div class="musics">
                    <div class="music-album-line"></div>
                    <button class="play-music-album" id="{{$index}}" music_name = "{{$music->name}}" music_artist ="{{$album->artist->name}}" music_icon ="{{$album->icon}}" music_music ="{{$music->music}}"></button>
                    <a class="index">{{$index = $index + 1}}</a>
                    <h4 class="music-name">{{$music->name}}</h4>
                    <button class="add-to-playlist" id="{{$index}}" ></button>
                        <div class="options-playlist" id="{{$index}}">
                        <h3 class="title-playlist">Add to your playlist</h3> 
                        <div class="playlists-name">
                        @foreach($playlists as $playlist)         
                        <a href="/home/playlist/add/{{$playlist->id}}/{{$music->id}}" class = "playlist-name">
                        <button class="playlist-name">{{$playlist->name}}</button></a>
                        </br>
                        @endforeach   
                        </div>
                        </div>
                </div>
            @endforeach
        </div>
        
        </div>

        
        <script>
            $('html').click(function(e) { 
                if(!$(e.target).hasClass('add-to-playlist')){
                    var cusid_ele = document.getElementsByClassName('options-playlist');
                    for (var i = 0; i < cusid_ele.length; ++i) {
                        document.getElementsByClassName("options-playlist")[i].style.display = "none";
                    }     
                }                  
            });
            
            $('.add-to-playlist').click(function() {
               
                var innerDivId = $(this).attr('id');
                var cusid_ele = document.getElementsByClassName('options-playlist');
                for (var i = 0; i < cusid_ele.length; ++i) {
                    if(i == innerDivId - 1){
                        document.getElementsByClassName("options-playlist")[innerDivId - 1 ].style.display = "block";
                    }else{
                        document.getElementsByClassName("options-playlist")[i].style.display = "none";
                    }  
                } 
            });

            $('.play-music-album').click(function() {
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