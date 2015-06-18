<?php get_header();
$category = getCurrentCatID();
	
/*
 * choose news or not
 */
if($category == 78){
	get_template_part('news');
}else{ ?>
	<div class='wrapper'>
		<div class='contant-block'>
			<h1 class='headline'><?php echo single_cat_title( $prefix = '', $display = true ) ?></h1>
			<ul class='bl-list-slots'>
				<?php
				$category = getCurrentCatID();
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
					'cat' => $category,
					'posts_per_page' => 30,
					'post_status'=>'publish',
					'orderby'=>'post_date',
					'paged'=> $paged,
					'order'    => 'DESC'
				);
				query_posts($args);
				if ( have_posts() ) while ( have_posts() ) : the_post();?>
					<li>
						<div class='item-slot-cont'>
							<a href='<?php the_permalink(); ?>'><?php the_post_thumbnail('',array('class'=>'img'));?></a>
						</div>
						<div class='slot-name'><?php echo get_the_title( $post->ID); ?></div>
					</li>
				<?php
				endwhile;
			?>
			</ul>
			<?php
			if ( function_exists( 'wp_pagenavi' ) ) wp_pagenavi();
			wp_reset_query(); 
			?>
			<div class='text'>
				<?php echo category_description();?>
			</div>
		</div>
		<div class='line'></div>
<?php
}
get_footer();