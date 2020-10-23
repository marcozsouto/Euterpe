<link rel="stylesheet" href="{{ asset('css/sidebarUser.css') }}">
@extends('user.createPlaylist')
<div class="sidebar">
        
        <input type="text" id="search_sidebar" class="search_sidebar" placeholder="Search"> 

        <a href="/home">
            <button class="euterpe-btm">Euterpe</button>
        </a>
        <h1 class="libray">LIBRAY</h1>
        <a href="/home/artist">
            <button class="artist-btm">Artists</button>
        </a>
        <a href="/home/album">
            <button class="album-btm">Albums</button>
        </a>
        <a href="/home/playlist">
        <button class="playlist-btm">Playlists</button>
        </a>
            
        <button  id ="playlist-create" class="playlist-create">New Playlist</button>
            
</div>        

<div class="content" id="content">

</div>

<script type="text/javascript">

            
                $(document).on('click','.open_modal',function(){
                    var url = "home/playlist/new";
                    var tour_id= $(this).val(); 
                });
    
                function fetch_customer_data(query){
                    $.ajax({
                        url:"{{ route('user.search.do') }}",
                        method:'GET',
                        data:{query:query},
                        dataType:'json',
                        success:function(data)
                    {
                        $('#content').html(data.value);
                    }
                    })
                }

                $(document).on('keyup', '#search_sidebar', function(){
                    
                    if ($.trim($('#search_sidebar').val()).length) {
                        $('#content').addClass('content-active');
                    } else {
                        $('#content').removeClass('content-active');
                    }
                    
                    var query = $(this).val();
                    fetch_customer_data(query);
                    
                });

</script>