<form role="search" method="get" id="searchform" onclick="event.stopPropagation();" class="searchform search-bar" action="<?php echo home_url( '/' ); ?>">
    <input value="" name="s" id="s" type="text" class="search-key" />
    <button id="searchsubmit" value="Search" type="submit" class="search-btn">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/search.svg" alt="">
    </button>
</form>
<script>
    document.getElementById('searchform').onsubmit = function(e){
        if(document.getElementById('s').value == ''){
            e.preventDefault();
        }
    };
</script>