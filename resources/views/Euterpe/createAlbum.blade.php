<!DOCTYPE html>
<html >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
        <form action="{{route('euterpe.album.new.do')}}" method='post' enctype="multipart/form-data" id="form">
        @csrf
            <div class="data">
            <label class = "name" for="name">name</label></br>
            <input class = "name" type="text" name="name"/>    
       
            <label class = "description" for="description">description</label></br>
            <textarea class = "description" rows="4" cols="50" name="description" form="form"></textarea>               
            
            <label class = "gender" for="gender">gender</label></br>
            <input class = "gender" type="text" name="gender"/>    
       
            <label class = "releaseDate" for="releaseDate">release date</label></br>
            <input class = "releaseDate" type="date"  class = "releaseDate" name="releaseDate"/>
        
            <label class = "artist" for="artist_id">Artist</label></br>    
            <select id="artist_id" name="artist_id" style="width: 400px">
                @foreach($artists as $artist)
                    <option value="{{$artist->id}}">{{$artist->name}}</option>
                @endforeach
            </select>  

            <input class="icon" type="file" name="icon" id="icon"/>
            <img class="icon" /> 
            <div class="overlay">
                <label class="icon" for="icon">Add</label></br>
            </div>

        <input type="submit" value="submit" />
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

           

            $(document).ready(function (){
                
                var count = 1;
                dynamic_field(count);

                function dynamic_field(number){
                    var html = '<tr>';
                    html += '<td><input class="music_name" type="text" name="music_name['+ number +']"></td>';
                    html += '<td><input class="music_time" type="time" name="music_time['+ number +']"</td>';
                    html += '<td><label class ="music_file" for="music_file[' + number +']"></label><input id="music_file['+ number +']" type="file" name="music_file['+ number +']"</td>';
                    html += '<td><input class="music_description" type="text" name="music_description['+ number +']"</td>';
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