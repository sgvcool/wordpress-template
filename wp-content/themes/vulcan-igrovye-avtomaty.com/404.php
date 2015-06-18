<?php get_header(); ?>
<div class='wrapper'>
	<div class='contant-block'>
		<div class='text'>
			<div class='errorcode'>
				404
			</div>
			<p>
				К сожалению, такой страницы не существует. Вы можете попробовать вернуться назад или перейти на главную страницу сайта. <a href='/'>Главная</a>
			</p>
		</div>
	</div>
	<div class='contant-block'>
		<p class='bk-title'>Топ лучших игр клуба</p>
		<ul class='bl-list-slots'>
			<?php
			$args = array(
				'cat' => '-1,-78',
				'posts_per_page' => 15,
				'post_status'=>'publish',
				'meta_key' => 'views',
				'orderby' => 'meta_value_num',
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
	</div>
	
	
	<div class='line'></div>
<?php get_footer();