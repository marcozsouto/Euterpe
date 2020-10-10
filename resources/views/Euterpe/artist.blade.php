<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
    </head>
    <body>
    <p>Artists</p>
    @foreach($artists as $artist)
        <tr>
            <td><img src="artist_image/{{$artist->id}}" width="50" height="50"></td>
            <td><a href="artist/edit/{{$artist->id}}">Edit</a></td>
        </tr>
    @endforeach

    </body>
</html>