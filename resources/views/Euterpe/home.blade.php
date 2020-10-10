<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
    </head>
    <body>
    <a href="{{ url('euterpe/playlist') }}">
        <button>Playlists</button>
    </a>   
    @foreach($playlists as $playlist)
        <tr>
            <td><img src="euterpe/playlist_image/{{$playlist->id}}" width="50" height="50"></td>
            <td><a href="euterpe/playlist/edit/{{$playlist->id}}">Edit</a></td>
        </tr>
    @endforeach
    <br>
    <a href="{{ url('euterpe/album') }}">
        <button>Albums</button>
    </a>
    @foreach($albums as $album)
        <tr>
            <td><img src="euterpe/album_image/{{$album->id}}" width="50" height="50"></td>
            <td><a href="euterpe/album/edit/{{$album->id}}">Edit</a></td>
        </tr>
    @endforeach
    <br>
    <a href="{{ url('euterpe/artist') }}">
        <button>Artist</button>
    </a>
    @foreach($artists as $artist)
        <tr>
            <td><img src="euterpe/artist_image/{{$artist->id}}" width="50" height="50"></td>
            <td><a href="euterpe/artist/edit/{{$artist->id}}">Edit</a></td>
        </tr>
    @endforeach

    </body>
</html>