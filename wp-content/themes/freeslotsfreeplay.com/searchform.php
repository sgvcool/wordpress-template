<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
	<input class='search-input' type="text" value="<?php echo get_search_query() ?>" name="s" id="s" />
	<input class='search-submit' type="submit" id="searchsubmit" value="Поиск" />
</form>