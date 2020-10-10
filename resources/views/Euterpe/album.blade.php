<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
    </head>
    <body>
    <p>Albums</p>
    @foreach($albums as $album)
        <tr>
            <td><img src="album_image/{{$album->id}}" width="50" height="50"></td>
            <td><a href="album/edit/{{$album->id}}">Edit</a></td>
        </tr>
    @endforeach

    </body>
</html>