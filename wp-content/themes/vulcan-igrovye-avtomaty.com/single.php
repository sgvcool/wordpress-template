<?php get_header();

/*
 * choose news or not
 */
if( in_category(78)){
	get_template_part('new');
}else{ ?>
<div class='wrapper'>
	<div class='contant-block'>
		<h1 class='headline'><?php the_title(); ?></h1>
		<noindex>
			<?php
			$field1 = get_post_meta($post->ID, "wpcf-demo-slot", true);
			$field2 = get_post_meta($post->ID, "wpcf-slot-demo", true);
			
			/*
			 * проверяем есть ли второе поле для демки слота
			 */
			if(!empty($field2)){
				$field = $field2;
			}else{
				$field = $field1;
			}
			
			if(stristr($field, '<embed') === FALSE & stristr($field, '<iframe') === FALSE) { ?>
				<iframe src="<?php echo $field; ?>" class='bm-demo' scrolling="no"></iframe>
			<?php } else { echo $field;}?>
		</noindex>
	</div>
	
	<div class='contant-block'>
		<p class='bk-title'>Другие игровые автоматы</p>
		<ul class='bl-list-slots slot-slider'>
			<?php
			$args = array(
				'cat' => '-1,-78',
				'posts_per_page' => -1,
				'post_status'=>'publish',
				'orderby'=>'post_date',
				'order'    => 'DESC'
			);
			query_posts($args);
			if ( have_posts() ) while ( have_posts() ) : the_post() ?>
				<li>
					<div class='item-slot-cont'>
						<a href='<?php the_permalink(); ?>'><?php the_post_thumbnail('',array('class'=>'img'));?></a>
					</div>
					<div class='slot-name'><?php echo get_the_title( $post->ID); ?></div>
				</li>
			<?php
				endwhile;
				wp_reset_query(); 
			?>
		</ul>

		<div class='text'>
			<?php the_content();?>
		</div>
	</div>
	<div class='line'></div>
<?php
}
get_footer();