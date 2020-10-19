
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

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
            <a href="/euterpe/playlist/new">
                <button class="playlist-create">Create</button>
            </a>
</div>        
           

<div class="content" id="content">

</div>

<script type="text/javascript">
    
                function fetch_customer_data(query){
                    $.ajax({
                        url:"{{ route('euterpe.music.search.do') }}",
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