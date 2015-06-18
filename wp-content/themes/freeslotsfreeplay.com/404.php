<?php get_header(); ?>
<div class='col-md-12 padding0'>
	<div class='col-md-3 '>
		<?php get_sidebar();?>
	</div>
	<div class='col-md-9 '>
		<div class='text-container'>
			<div class='bm-errorcode'>
				404
			</div>
			<p class='bm-errortext'>
				К сожалению, такой страницы не существует. Вы можете попробовать вернуться назад или перейти на главную страницу сайта. <a href='/'>Главная</a>
			</p>
		</div>
	</div>
	<div class='col-md-9 list-slots'>
		<?php
		$page = (get_query_var('page')) ? get_query_var('page') : 1;
		$args = array(
			'cat' => '-1',
			'posts_per_page' => 50,
			'post_status'=>'publish',
			'orderby'=>'post_date',
			'paged'=> $page,
			'order'    => 'DESC'
		);
		query_posts($args);
		if ( have_posts() ) while ( have_posts() ) : the_post() ?>
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
			wp_reset_query(); 
		?>
	</div>
</div>
<?php get_footer();