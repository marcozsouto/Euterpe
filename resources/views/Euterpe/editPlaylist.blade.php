<!DOCTYPE html>
<html >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <head>
        <title>Music for Everyone - Euterpe</title>
    </head>
    <body>
        
        @if ($errors->any())
            <div>
                @foreach($errors->all() as $error)
                <p>{{$error}}</p>
                @endforeach
            </div>
        @endif  

        <form action="{{route('euterpe.playlist.edit.do')}}" method='post' enctype="multipart/form-data" id="form">
        @csrf
            <input type="hidden" name="id" value="{{$playlist->id}}">
            <label for="name">name</label></br>
            <input type="text" name="name" value="{{$playlist->name}}"/>    
        </br>
        <label for="description">description</label></br>
            <textarea rows="4" cols="50" name="description" form="form" id="textare"></textarea>         
        </br>
            <label for="icon">icon</label></br>
            <input type="file" name="icon" id="icon" value="{{$playlist->icon}}"/>   
        </br>
        <input type="submit" value="submit" />

        </form>
        <script>
            $("#textare").text("{{$playlist->description}}");
        </script>

    </body>
</html>