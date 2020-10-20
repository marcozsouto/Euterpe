<!DOCTYPE html>
<html >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/FormPlaylist.css') }}">
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

        <div id="form-playlist" class="form-playlist">
        
        <form action="{{route('euterpe.playlist.new.do')}}" method='post' enctype="multipart/form-data" id="form">
        <span class="close">&times;</span>
        @csrf
            <h1 class="playlist">Create Playlist.</h1>
            <label class="name-playlist" for="name">Name</label></br>
            <input class="name-playlist" type="text" name="name" value="{{$playlist->name}}"/>    
        </br>
        <label class="description-playlist" for="description">Description</label></br>
            <textarea class="description-playlist" rows="4" cols="50" name="description" form="form"></textarea>         
        </br>

            <input class="icon-playlist" type="file" name="icon" id="icon-playlist"/>
            <img class="icon-playlist" /> 
            <div class="overlay-playlist">
                <label class="icon-playlist" for="icon-playlist">Add</label></br>
            </div>

        <input class="submit-playlist" type="submit" value="submit" />

        </form>
        </div>

        <script>
            $("#textare").text("{{$playlist->description}}");
        </script>
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                    $(input).next()
                    .attr('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
                }
                else {
                    var img = input.value;
                    $(input).next().attr('src',img);
                }
            } 

            function iconchange(){
                $('#icon').each(function(index){
                    if ($('#icon').eq(index).val() != ""){
                        readURL(this);
                        $('.hide').show();
                    }
                });
            }

            $('#icon').on("change", function(){
            iconchange();
            });
        </script>

    </body>
</html>