<!DOCTYPE html>
<html >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/FormAlbum.css') }}">
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
        <form action="{{route('euterpe.album.edit.do')}}" method='post' enctype="multipart/form-data" id="form">
        @csrf
        <div class="data">

            <input type="hidden" name="id" value="{{$album->id}}">
            <label class = "name"for="name">name</label></br>
            <input class = "name" type="text" name="name" value="{{$album->name}}"/>    
      
            <label class = "description" for="description">description</label></br>
            <textarea class = "description" id='textare' rows="4" cols="50" name="description" form="form"></textarea>         

            <label class = "gender" for="gender">gender</label></br>
            <input class = "gender" type="text" name="gender" value="{{$album->gender}}"/>    
      
            <label class = "releaseDate" for="releaseDate">Release Date</label></br>
            <input class = "releaseDate" type="date" name="releaseDate" value="{{$album->releaseDate}}"/>     
    
            <label class = "artist" for="artist_id">Artist</label></br>    
            <select id="artist_id" name="artist_id" style="width: 400px">
                @foreach($artists as $a)
                    @if($a->id == $album->artist_id)
                        <option value="{{$a->id}}" selected>{{$a->name}}</option>
                    @else
                    <option value="{{$a->id}}">{{$a->name}}</option>
                    @endif
                @endforeach
            </select> 
            
            <input class="icon" type="file" name="icon" id="icon"/>
            <img class="icon" /> 
            <div class="overlay">
                <label class="icon" for="icon">Add</label></br>
            </div>

                <input type="submit" class ="edit"value="Edit" />
                <a href="/euterpe/album/delete/{{$album->id}}" class="button">Delete</a>
            </div>
        <table>
            <thead>
                <tr>
                    <th>Music name</th>
                    <th>Music time</th>
                    <th>Music file</th>
                    <th>Music description</th>            
                </tr>
            </thead>
            <tbody>

            </tbody> 
        </table>
        <script>
             $('#icon').next().attr('src',"http://127.0.0.1:8000/storage/album/icon/{{$album->icon}}");
             $("#textare").text("{{$album->description}}");
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
            })
        
            $(document).ready(function (){
                
                var count = 1;
                var num = {!! json_encode($album->numberOfTracks) !!};
                for(i=1; i<=num; i++){
                    var count = count + 1;
                    dynamic_field(i);
                    
                }
                

                function dynamic_field(number){
                    var html = '<tr>';
                    var num = {!! json_encode($album->numberOfTracks) !!};
                    var music= {!!json_encode($musics) !!};
                    
                    if(number <= num){
                        
                        html += '<td><input class="music_name" type="text" name="music_name['+ number +']" value="'+ music[number-1]['name'] +'"></td>';
                        html += '<td><input class="music_time" type="time" name="music_time['+ number +']" value="'+ music[number-1]['time'] +'"</td>';
                        html += '<td><label class ="music_file" for="music_file[' + number +']"></label><input id="music_file['+ number +']" type="file" name="music_file['+ number +']"</td>';
                        html += '<td><input class="music_description" type="text" name="music_description['+ number +']" value="'+ music[number-1]['description'] +'"></td>';
                    }if(number > num){
                        html += '<td><input class="music_name" type="text" name="music_name['+ (number-1) +']"></td>';
                        html += '<td><input class="music_time" type="time" name="music_time['+ (number-1) +']"</td>';
                        html += '<td><label class ="music_file" for="music_file[' + (number-1) +']"></label><input id="music_file['+ (number-1) +']" type="file" name="music_file['+ (number-1) +']"</td>';
                        html += '<td><input class="music_description" type="text" name="music_description['+ (number-1) +']"</td>';
                    }
                    
                    if(number > 1)
                    {
                        html += '<td><button type="button" class="remove" name = "remove" id = "" class="btn btn-danger remove">Remove</button></td></tr>'; 
                        $('tbody').append(html);
                    }
                    else
                    {
                        html += '<td><button type="button" class="add" name = "add" id = "add" class="btn btn-sucess">Add</button></td></tr>'; 
                        $('tbody').html(html);
                    }
                }

                $(document).on('click', '#add', function(){
                    count++;
                    dynamic_field(count);
                });

                $(document).on('click', '.remove', function(){
                    count--;
                    $(this).closest("tr").remove();
                });

            });
        </script>
        </form>
    </body>
</html>