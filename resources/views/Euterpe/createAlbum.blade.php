<!DOCTYPE html>
<html >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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
            <label for="name">name</label></br>
            <input type="text" name="name"/>    
        </br>
            <label for="description">description</label></br>
            <textarea rows="4" cols="50" name="description" form="form"></textarea>         
        </br>        
        </br>
            <label for="icon">icon</label></br>
            <input type="file" name="icon" id="icon"/>   
        </br>
            <label for="gender">gender</label></br>
            <input type="text" name="gender"/>    
        </br>
            <label for="releaseDate">Release Date</label></br>
            <input type="date" name="releaseDate"/>     
        </br>
            <label for="artist_id">Artist</label></br>    
            <select id="artist_id" name="artist_id" style="width: 200px">
                @foreach($artists as $artist)
                    <option value="{{$artist->id}}">{{$artist->name}}</option>
                @endforeach
            </select>  
            </br>
        <input type="submit" value="submit" />
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
        <table>
        <script>
            $(document).ready(function (){
                var count = 1;
                dynamic_field(count);

                function dynamic_field(number){
                    var html = '<tr>';
                    html += '<td><input type="text" name="music_name['+ number +']"</td>';
                    html += '<td><input type="time" name="music_time['+ number +']"</td>';
                    html += '<td><input type="file" name="music_file['+ number +']"</td>';
                    html += '<td><input type="text" name="music_description['+ number +']"</td>';
                    if(number > 1)
                    {
                        html += '<td><button type="button" name = "remove" id = "" class="btn btn-danger remove">Remove</button></td></tr>'; 
                        $('tbody').append(html);
                    }
                    else
                    {
                        html += '<td><button type="button" name = "add" id = "add" class="btn btn-sucess">Add</button></td></tr>'; 
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
        <script>
            $("#artist_id").select2();
        </script>
        </form>
    </body>
</html>