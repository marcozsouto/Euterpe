<!DOCTYPE html>
<html >
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

        <form action="{{route('euterpe.playlist.new.do')}}" method='post' enctype="multipart/form-data" id="form">
        @csrf

            <label for="name">name</label></br>
            <input type="text" name="name"/>    
        </br>
        <label for="description">description</label></br>
            <textarea rows="4" cols="50" name="description" form="form"></textarea>         
        </br>
            <label for="icon">icon</label></br>
            <input type="file" name="icon" id="icon"/>   
        </br>
        <input type="submit" value="submit" />

        </form>


    </body>
</html>