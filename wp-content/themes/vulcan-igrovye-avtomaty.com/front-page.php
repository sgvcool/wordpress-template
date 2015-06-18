<?php get_header(); ?>
<div class='wrapper'>
	<div class='foreHeader'>
		<div class='left-side-forheader'>
			<ul>
				<li>Вулкан мощный игровой центр</li>
				<li>Вулкан мощный игровой центр</li>
				<li>Вулкан мощный игровой центр</li>
				<li>Вулкан мощный игровой центр</li>
			</ul>
		</div>
		<div class='right-side-forheader'>
			<div class='win-now'>
				<p>Сейчас выигрывают:</p>
				<ul>
					<?php
					$names = array('asket***', 'spange***', 'diana***', 'gamer***', 'alex111***', 'inna4e***', 'liverpoo***', 'lucky***', 'Bastar***', 'Stepa***', 'Mihail***', 'loli***', 'Ronny***', 'bober1***', 'Erik***', 'Gavriil***', 'Danila19***', 'Skalola***');
					$args = array(
						'cat' => '-1',
						'posts_per_page' => -1,
						'orderby'=>'title',
						'order'    => 'ASC'
					);
					query_posts($args);
					if ( have_posts() ) while ( have_posts() ) : the_post();
						$title = get_the_title($post->ID);
						$summary = rand(1,1000);
						$picture = get_post_meta($post->ID, 'wpcf-oval-picture', true); ?> 
							<li class='one-item'>
								<span class='gamer'><?php echo $names[array_rand($names)]; ?></span>
								<span class='money'><?=$summary?>р.</span>
							</li>
					<?php
						endwhile;
						wp_reset_query();
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class='line'></div>
	<div class='slider-cont'>
		<ul class='slider'>
			<li><img src='<?php echo get_template_directory_uri(); ?>/img/slids/book_of_ra_deluxe.png' /></li>
			<li><img src='<?php echo get_template_directory_uri(); ?>/img/slids/hot_city.png' /></li>
			<li><img src='<?php echo get_template_directory_uri(); ?>/img/slids/just_jewels.png' /></li>
			<li><img src='<?php echo get_template_directory_uri(); ?>/img/slids/lucky_ladys_charm.png' /></li>
			<li><img src='<?php echo get_template_directory_uri(); ?>/img/slids/starburst.png' /></li>
		</ul>
	</div>
	<div class='line'></div>
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
	
	<div class='contant-block'>
		<p class='bk-title'>Популярные автоматы вулакана</p>
		<ul class='bl-list-slots'>
			<?php
			$args = array(
				'cat' => '-1,-78',
				'posts_per_page' => 15,
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
	</div>
	
	<div class='contant-block'>
		<p class='bk-title'>Новости</p>
		<ul class='list-news'>
			<?php
			$args = array(
				'cat' => '78',
				'posts_per_page' => 12,
				'post_status'=>'publish',
				'orderby'=>'post_date',
				'order'    => 'DESC'
			);
			query_posts($args);
			if ( have_posts() ) while ( have_posts() ) : the_post() ?>
				<li>
					<div class='news-name'><?php echo get_the_title( $post->ID); ?></div>
				</li>
			<?php
				endwhile;
				wp_reset_query(); 
			?>
		</ul>
		
		<div class='text'>
			<h1 class='headline'><?php the_title(); ?></h1>
			<?php the_content();?>
		</div>
	</div>
	
	<div class='line'></div>
<?php get_footer();