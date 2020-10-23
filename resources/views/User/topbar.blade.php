<link rel="stylesheet" href="{{ asset('css/topbar.css') }}">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<div class="topbar">
<div class="icon-overlay">
<a href="/logout">
    <button class="logout-btm">Log out</button>
</a>
</div>
<img class="user-icon" src="http://127.0.0.1:8000/storage/user/icon/{{Auth::user()->icon}}">

<div class="music-player">
<img class="music-icon-play" id="music-icon-play">
<h1 class="music-name-play"></h1>
<h1 class="music-artist-play" id="music-artist-play"></h1>
<div class="player">
    <audio id="audio" type="audio/x-m4a"></audio>
    <button  id="play-music" class = "play-music" onclick="playPause()" type="button"></button>
    <input
        type="range"
        id="progress-bar"
        min="0"
        max="0"
        value="0"
        onchange="changeProgressBar()"
        /> 
        <div class="currentTime"></div>
        <div class="durationTime"></div>
</div>
</div>

<script>
    let playing = false;
    const progressBar = document.querySelector('#progress-bar');
    const song = document.querySelector('#audio');
    songIndex = 0;

    function playPause() {
        if(playing){  
            document.getElementById("play-music").style.backgroundImage = 'url({{ asset("css/img/pause.svg") }})';         
            song.play(); 
            playing = false;
            setInterval(updateProgressValue, 500);
        } 
        else{
            document.getElementById("play-music").style.backgroundImage = 'url({{ asset("css/img/play.svg") }})';
            song.pause();
            playing = true;
        } 
    }

    function updateProgressValue() {
        progressBar.max = song.duration;
        progressBar.value = song.currentTime;
        document.querySelector('.currentTime').innerHTML = (formatTime(Math.floor(song.currentTime)));
        if (document.querySelector('.durationTime').innerHTML === "NaN:NaN") {
            //document.querySelector('.durationTime').innerHTML = "0:00";
        } 
            document.querySelector('.durationTime').innerHTML = (formatTime(Math.floor(song.duration)));
        
    };

    function formatTime(seconds) {
        let min = Math.floor((seconds / 60));
        let sec = Math.floor(seconds - (min * 60));
        if (sec < 10){ 
            sec  = `0${sec}`;
        };
        return `${min}:${sec}`;
    };

    

  
 
    
    

    function changeProgressBar() {
        song.currentTime = progressBar.value;
    };
</script>

</div>