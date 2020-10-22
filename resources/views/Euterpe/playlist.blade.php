<!DOCTYPE html>
<html >
    <head>
        <title>Music for Everyone - Euterpe</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/playlistEuterpe.css') }}">
    </head>
    <body>
        <header>
            <div class="bar">
            </div>
        </header>
        @extends('euterpe.sidebar')
        <div class="box">
        <h1>Playlists</h1>
        <div class="new"></div>
        <input type="text" id="search" class="search" placeholder="Type here.."> 

        <div id="playlists" class="playlists">
        </div>
    </div>
        <script type="text/javascript">
        $(document).ready(function(){

            fetch_customer_data();

            function fetch_customer_data(query){
                $.ajax({
                    url:"{{ route('euterpe.playlist.search.do') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                {
                    $('#playlists').html(data.value);
                }
                })
            }

            $(document).on('keyup', '#search', function(){
                var query = $(this).val();
                fetch_customer_data(query);
            });
        });
        </script>

    </body>
</html>