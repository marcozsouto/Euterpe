<!DOCTYPE html>
<html >
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/FormArtist.css') }}">
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
   
        <form action="{{route('euterpe.artist.new.do')}}" method='post' enctype="multipart/form-data" id="form">
        @csrf
            <label class="cover" for="cover"></label></br>
            <input  class="cover" type="file" name="cover" id="cover"/>    
            <img class="cover" />
            <div class="cover-right"></div>
                
            <div class="cover-bottom"></div>
            <div class="cover-left"></div>  

            <label class="name" for="name">name</label></br>
            <input type="text" class="name" name="name"/>    
        </br>
            <label class="description" for="description">description</label></br>
            <textarea class="description" rows="4" cols="50" name="description" form="form"></textarea>         
        </br>
            <label class="musicGender" for="musicGender">Music Gender</label></br>
            <input class="musicGender" type="text" name="musicGender"/>    
        </br>
            <input class="icon" type="file" name="icon" id="icon"/>
            <img class="icon" /> 
            <div class="overlay">
            <label class="icon" for="icon">Add</label></br>
            </div>  
        </br>
        
        <input type="submit" value="Add" />

        </form>
        
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

            function coverchange(){
                $('#cover').each(function(index){
                    if ($('#cover').eq(index).val() != ""){
                        readURL(this);
                        $('.hide-1').show();
                    }
                });
            }

            $('#icon').on("change", function(){
            iconchange();
            });

            $('#cover').on("change", function(){
            coverchange();
            });
        </script>


    </body>
</html>