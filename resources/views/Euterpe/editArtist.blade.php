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
   
        <form action="{{route('euterpe.artist.edit.do')}}" method='post' enctype="multipart/form-data" id="form">
        @csrf
            <input type="hidden" name="id" value="{{$artist->id}}">
            <label for="name">name</label></br>
            <input type="text" name="name" value="{{$artist->name}}"/>    
        </br>
            <label for="description">description</label></br>
            <textarea rows="4" cols="50" id='textare' name="description" form="form"></textarea>         
        </br>
            <label for="musicGender">Music Gender</label></br>
            <input type="text" name="musicGender" value="{{$artist->musicGender}}"/>    
        </br>
            <label for="icon">icon</label></br>
            <input type="file" name="icon" id="icon" value="{{$artist->icon}}"/>   
        </br>
            <label for="cover">cover</label></br>
            <input type="file" name="cover" id="cover" value="{{$artist->cover}}"/>   
        </br>
        <input type="submit" value="submit" />

        </form>

        <script>
            $("#textare").text("{{$artist->description}}");
        </script>

    </body>
</html>