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
        <form action="{{route('euterpe.album.new.do')}}" method='post' enctype="multipart/form-data">
        @csrf
            <input type="text" name="name"/>    
        </br>
            <input type="text" name="description"/>         
        </br>
            <input type="file" name="icon" id="icon"/>   
        </br>
            <input type="number" name="numberOfTracks" id="numberOfTracks"/>   
        </br>
            <input type="text" name="gender"/>    
        </br>
            <input type="date" name="releaseDate"/>     
        </br>
            <input type="text" name="artist_id"/>     
        </br>
        <input type="submit" value="submit" />
        
        <div id ="musics">

        </div>

        <script>
            $(document).ready(function (){
                load();
            });
            
            function load(){
                $(':input[type="number"]').click(function () {
                    var str = $(":input[type='number']").val();
                    if(str > 0){
                        createtables(str);
                    }
                });
            }

            function createtables(str){
                var tb ="";
                $('#musics').empty(tb);
                tb = "<table>";
                for(i=0;i<str;i++){
                tb+= "<tr>"+
                        '<td>'+i+"</td>"+
                        "<td>"+
                        "<input type='text' name='music_name["+i+"]'/>"+
                        "</td>"+
                        "<td>"+
                        "<input type='time' name='music_time["+i+"]'/>"+
                        "</td>"+
                        "<td>"+
                        "<input type='file' name='music_music["+i+"]'/>"+
                        "</td>"+
                        "<td>"+
                        "<input type='text' name='music_description["+i+"]'/>"+
                        "</td>";
                }
                tb += "</table>";
                $('#musics').append(tb);
            }
        </script>



        </form>

    </body>
</html>