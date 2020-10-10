<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
    </head>
    <body>
    <p>Playlists</p>
    @foreach($playlists as $playlist)
        <tr>
            <td><img src="playlist_image/{{$playlist->id}}" width="50" height="50"></td>
            <td><a href="playlist/edit/{{$playlist->id}}">Edit</a></td>
        </tr>
    @endforeach

    </body>
</html>