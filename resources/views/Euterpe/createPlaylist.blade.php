<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/FormPlaylist.css') }}">
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
            <input class="name-playlist" type="text" name="name"/>    
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

            function iconchangeplaylist(){
                $('#icon-playlist').each(function(index){
                    if ($('#icon-playlist').eq(index).val() != ""){
                        readURL(this);
                        $('.hide').show();
                    }
                });
            }

            $('#icon-playlist').on("change", function(){
            iconchangeplaylist();
            });
        </script>

        <script>
            var modal = document.getElementById("form-playlist");

            // Get the button that opens the modal
            var btn = document.getElementById("playlist-create");

            var span = document.getElementsByClassName("close")[0];
            // When the user clicks on the button, open the modal
            btn.onclick = function() {
            modal.style.display = "block";
            }

            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                }
            }

        </script>
    
    </body>
</html>