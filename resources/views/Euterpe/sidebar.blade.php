
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
@extends('euterpe.createPlaylist')
<div class="sidebar">
        
        <input type="text" id="search_sidebar" class="search_sidebar" placeholder="Search"> 

        <a href="/euterpe/artist">
            <button class="artist-btm">ARTISTS</button>
        </a>
            <a href="/euterpe/artist/new">
                <button class="artist-create">Create</button>
            </a>
        <a href="/euterpe/album">
            <button class="album-btm">ALBUMS</button>
        </a>
            <a href="/euterpe/album/new">
                <button class="album-create">Create</button>
            </a>
        <a href="/euterpe/playlist">
        <button class="playlist-btm">PLAYLISTS</button>
        </a>
        <a href="/logout">
        <button class="logout-btm">Log out</button>
        </a>
        <a href="/euterpe">
            <button class="euterpe-btm">Euterpe</button>
        </a>
            
        <button  id ="playlist-create" class="playlist-create">Create</button>
            
</div>        

<div class="content" id="content">

</div>

<script type="text/javascript">

                $(document).on('click','.open_modal',function(){
                    var url = "euterpe/playlist/new";
                    var tour_id= $(this).val(); 
                });
    
                function fetch_customer_data(query){
                    $.ajax({
                        url:"{{ route('euterpe.search.do') }}",
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