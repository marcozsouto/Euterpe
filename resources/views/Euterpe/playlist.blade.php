<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">

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