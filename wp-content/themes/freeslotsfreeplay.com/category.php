<?php get_header(); ?>
<div class='col-md-12 padding0'>
	<div class='col-md-3 '>
		<?php get_sidebar();?>
	</div>
	<div class='col-md-9 '>
		<div class='text-container'>
			<h1 class='headline'><?php echo single_cat_title( $prefix = '', $display = true ) ?></h1>
		</div>
	</div>
	
	<div class='col-md-9 list-slots'>
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
		$i=0;
		if ( have_posts() ) while ( have_posts() ) : the_post()?>
			<div class='col-md-4 automat-item-container'>
				<div class='automat-picture-container'>
					<?php the_post_thumbnail('',array('class'=>'bm-slot-img'));?>
					<a href="<?php the_permalink(); ?>" class='bm-cash'></a>
				</div>
				<div class='bm-name-slots'>
					<?php echo get_the_title( $post->ID); ?>
				</div>
			</div>
		<?php
			endwhile;
			if ( function_exists( 'wp_pagenavi' ) ) wp_pagenavi();
		?>
	</div>
	<div class='col-md-9 '>
		<div class='text-container'>
			<?php echo category_description();?>
		</div>
	</div>
</div>
<?php get_footer();