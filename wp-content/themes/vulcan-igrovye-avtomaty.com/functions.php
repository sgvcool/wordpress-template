<?php
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
//remove_filter('template_redirect', 'redirect_canonical'); 
function do_excerpt($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if (count($words) > $word_limit)
		array_pop($words);
	echo implode(' ', $words).' ';
	echo '...';
}
function custom_excerpt_length( $length ) {
	return 10;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
/*
* Menus
*
*/
add_theme_support( 'menus' );

/***
 *	Убираем [...] в the_excerpt()
 */
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

///* Id posts */
//function true_id($args){
//	$args['post_page_id'] = 'ID';
//	return $args;
//}
//function true_custom($column, $id){
//	if($column === 'post_page_id'){
//		echo $id;
//	}
//}
//add_filter('manage_posts_columns', 'true_id', 5);
//add_action('manage_posts_custom_column', 'true_custom', 5, 2);

add_theme_support( 'post-thumbnails' );
add_image_size( 'preview', 50, 50, true );
add_image_size( 'new', 250, 200, true );

function get_thumbnail_link(){
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id,'large');
	return $image_url = $image_url[0];
}
function wp_corenavi($max = null) {
	global $wp_query, $wp_rewrite;
	$pages = '';
	if($max === null) $max = $wp_query->max_num_pages;
	//echo $max;
	if (!$current = get_query_var('paged')) $current = 1;
	$a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
	$a['total'] = $max;
	$a['current'] = $current;

	$total = 0; //1 - ???????? ????? "???????? N ?? N", 0 - ?? ????????
	$a['mid_size'] = 3; //??????? ?????? ?????????? ????? ? ?????? ?? ???????
	$a['end_size'] = 1; //??????? ?????? ?????????? ? ?????? ? ? ?????
	$a['prev_text'] = '&laquo;'; //????? ?????? "?????????? ????????"
	$a['next_text'] = '&raquo;'; //????? ?????? "????????? ????????"

	if ($max > 1) echo '<div class="navigation">';
	if ($total == 1 && $max > 1) $pages = '<span class="pages">???????? ' . $current . ' ?? ' . $max . '</span>'."\r\n";
	echo $pages . paginate_links($a);
	if ($max > 1) echo '</div>';
}

function getCurrentCatID(){
	global $wp_query;
	if(is_category() || is_single()){
		$cat_ID = get_query_var('cat');
	}
	return $cat_ID;
}
/**
 * Добавляем настройки в админке
 *
 */
add_action('admin_menu', 'nbcore_menu');
function nbcore_menu() {
    add_theme_page('Настройки слотов', 'goldslot', 8, 'goldslot', 'Goldslot_options');
}

// function custom_posts
function posts_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'id' => '0',
        'type' => 'default'
    ), $atts ) );
    if($id != 0){
        $args = array(
            'include' => $id
        );
        $custom_posts = get_posts($args);
        wp_reset_query();
        wp_reset_postdata();
        if($type == 'default'){
            $html = "<div clas='automat-cont'>";
			$i=0;
            foreach($custom_posts as $post): setup_postdata($post);
				$i++;
                $meta = get_post_meta($post->ID);
                $link = get_permalink($post->ID);
				$rating = the_ratings_results($post->ID, 0,0,0,1);
				
                $short_name = $meta['wpcf-short-text'][0];
                $ref_link = $meta['wpcf-href-value'][0];
				
				
				if($i%4==0){$html .= "<a href='$link'><div class='automat-item last'><div class='automat'>";}
				else{$html .= "<a href='$link'><div class='automat-item'><div class='automat'>";}
				
				
				$ttl = get_the_title($post->ID);
                if ( has_post_thumbnail($post->ID) ) {
                    $def_args = array(
                        'alt' => '"Игровой автомат '.$ttl. '"',
                        'title' => '"Игровой автомат '.$ttl. '"'
                    );
                    $html .= get_the_post_thumbnail($post->ID, 'preview', $def_args);
                }
				$html.= "</div>";
				
				$html.= "<div class='short-text'>";
				$html.= $short_name;
				$html.= "</div>";
				
				$html .= "<a href='$link' class='cash'>Играть</a>";
				$html .= "<div class='rating'>$rating</div>";
				
				$html .= "</div></a>";	
            endforeach; wp_reset_postdata();
            $html .= "</div><div class='clear'></div>";
        } /*else {
            $html = '<div class="slot_list_vertical">';
            foreach($custom_posts as $post): setup_postdata($post);
                $meta = get_post_meta($post->ID);
                $link = get_permalink($post->ID);
                $img  = $meta['wpcf-vertical-image'][0];
                $name = $meta['wpcf-english-name'][0] ? $meta['wpcf-english-name'][0] : $meta['wpcf-cyr-name'][0];

                $html .= '<a href="'.$link.'" class="each_slot">';
                $html .= '<img src="'.$img.'" alt="'.$name.'" title="'.$name.'" >';
                $html .= '</a>';
            endforeach; wp_reset_postdata();
            $html .= '</ul>';
        }*/
    }

    return $html;
}

add_shortcode('posts', 'posts_shortcode');

//хлебные крошки
function the_breadcrumb() {
   // echo 'You are here: ';
    if (!is_front_page()) {
        echo '<a href="';
        //echo get_option('home');
        echo '">Главная';
        echo "</a> < ";
        if (is_category() || is_single()) {
            the_category(' ');
            if (is_single()) {
                //echo " < ";
                //the_title();
            }
        } elseif (is_page()) {
           // echo the_title();
        }
    }
    else {
        echo 'Главная';
    }
}

/**
 * Функция для отображение настроек темы
 *
 * бутстрап можно и отключить
 */
function Goldslot_options() { ?>
    <h1>Настрой шаблона</h1>
    <form method="post" action="options.php">
        <?php wp_nonce_field('update-options'); ?>
        <!--p>Игровые автоматы</p>
        <input type="text" name="popular_slots" value="<?php echo get_option('popular_slots'); ?>" style="width:400px;"><br><br-->
        <!--p>Популярная игра</p>
        <input type="text" name="club_of_month" value="<?php echo get_option('club_of_month'); ?>" style="width:400px;"><br><br-->
        <!--p>TOP видео в записи</p>
		<input type="text" name="videos_on_single" value="<?php echo get_option('videos_on_single'); ?>" style="width:400px;"><br><br-->
		
		<input type="hidden" name="action" value="update" />
        <!--input type="hidden" name="page_options" value="popular_slots,club_of_month,videos_on_single" /-->
		<input type="hidden" name="page_options" value="club_of_month" />
        <input type="submit" class="btn btn-success" value="<?php _e('Save Changes') ?>">
    </form>
<?php }

function canonical(){
	$page = (get_query_var('page')) ? get_query_var('page') : 1;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if(is_front_page() && $page>1){
		echo "<link rel='canonical' href='http://$_SERVER[SERVER_NAME]/' />";
	}

	if(is_category()){
		$category = get_category( get_query_var( 'cat' ) );
		$cat_id = $category->cat_ID;
		$category_link = get_category_link($cat_id);
		echo "<link rel='canonical' href='".$category_link."' />";
	}
}

?>