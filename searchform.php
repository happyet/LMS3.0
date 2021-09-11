<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
    <input type="text" class="search-input" value="<?php the_search_query(); ?>" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="<?php _e('Search'); ?>" />
</form>

