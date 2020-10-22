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

        <div id="form-edit-playlist" class="form-edit-playlist">
        
        <form action="{{route('euterpe.playlist.edit.do')}}" method='post' enctype="multipart/form-data" id="form-edit-playlist">
        <span class="close-edit">&times;</span>
        @csrf
            <h1 class="playlist">Edit Playlist.</h1>
            <input type="hidden" name="id" value="{{$playlist->id}}">
            <label class="name-playlist" for="name">Name</label></br>
            <input class="name-playlist" type="text" name="name" value="{{$playlist->name}}"/>    
        </br>
        <label class="description-playlist" for="description">Description</label></br>
            <textarea id="description-playlist" class="description-playlist" rows="4" cols="50" name="description"></textarea>         
        </br>
            <input class="icon-playlist-edit" type="file" name="icon" id="icon-playlist-edit"/>
            <img class="icon-playlist-edit" /> 
            <div class="overlay-playlist-edit">
                <label class="icon-playlist-edit" for="icon-playlist-edit">Add</label></br>
            </div>

        <input class="submit-playlist" type="submit" value="submit" />

        </form>
        <a href="/euterpe/playlist/delete/{{$playlist->id}}" class="remove-playlist">Delete</a>
        </div>

        <script>
            $("#description-playlist").text("{{$playlist->description}}");
            $('#icon-playlist-edit').next().attr('src',"http://127.0.0.1:8000/storage/playlist/icon/{{$playlist->icon}}");
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

            function icon_edit_change(){
                $('#icon-playlist-edit').each(function(index){
                    if ($('#icon-playlist-edit').eq(index).val() != ""){
                        readURL(this);
                        $('.hide').show();
                    }
                });
            }

            $('#icon-playlist-edit').on("change", function(){
            icon_edit_change();
            });


            var modal_edit = document.getElementById("form-edit-playlist");

            // Get the button that opens the modal
            var btn_edit = document.getElementById("playlist-edit");

            var span_edit = document.getElementsByClassName("close-edit")[0];
            // When the user clicks on the button, open the modal
            btn_edit.onclick = function() {
            modal_edit.style.display = "block";
            }

            span_edit.onclick = function() {
                modal_edit.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
            if (event.target == modal) {
                modal_edit.style.display = "none";
                }
            }
        </script>

    </body>
</html>