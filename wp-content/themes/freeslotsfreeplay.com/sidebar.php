<div class='sidebar-container'>
	<p class='sidebar-title-block'>TOP автоматов</p>
	<ul class='list-sidebar-automats'>
		<?php
		$args = array(
			'cat' => '-1',
			'posts_per_page' => 10,
			'post_status'=>'publish',
			'orderby'=>'post_date',
			'paged'=> $page,
			'order'    => 'DESC'
		);
		query_posts($args);
		if ( have_posts() ) while ( have_posts() ) : the_post();
			$picture = get_post_meta($post->ID, 'wpcf-oval-picture', true);
			$title = get_the_title( $post->ID);
			?>
			<li>
				<div class='picture'>
					<a href='<?php the_permalink(); ?>'>
						<img src='<?=$picture?>' title='<?=$title?>' alt='<?=$title?>' />
					</a>
				</div>
				<div class='slot-description'>
					<p class='priwie-name'><?=$title?></p>
					<p class='rating'><?php echo the_ratings_results($post->ID, 0,0,0,1); ?></p>
				</div>
			</li>
		<?php
		endwhile;
		wp_reset_query();
		?>
	</ul>
</div>
<div class='sidebar-container'>
	<p class='sidebar-title-block'>Сейчас выигрывают</p>
	<ul class='list-sidebar-automats'>
		<?php
		$names = array('asket***', 'spange***', 'diana***', 'gamer***', 'alex111***', 'inna4e***', 'liverpoo***', 'lucky***', 'Bastar***', 'Stepa***', 'Mihail***', 'loli***', 'Ronny***', 'bober1***', 'Erik***', 'Gavriil***', 'Danila19***', 'Skalola***');
		$args = array(
			'cat' => '-1',
			'posts_per_page' => 42,
			'orderby'=>'title',
			'order'    => 'ASC'
		);
		query_posts($args);
		if ( have_posts() ) while ( have_posts() ) : the_post();
			$title = get_the_title($post->ID);
			$summary = rand(1,99);
			$picture = get_post_meta($post->ID, 'wpcf-oval-picture', true);
			?> 
			<li class='bg-black'>
				<div class='picture'>
					<a href='<?php the_permalink(); ?>'>
						<img src='<?=$picture?>' title='<?=$title?>' alt='<?=$title?>' />
					</a>
				</div>
				<div class='slot-description'>
					<p class='priwie-name'><?=$title?></p>
					<p class='rating author'><?php echo $names[array_rand($names)]; ?></p>
				</div>
				<p class='summary'><?=$summary?>$</p>
			</li>
		<?php
			endwhile;
			wp_reset_query();
		?>
	</ul>
</div>
<div class='sidebar-container'>
	<p class='sidebar-title-block'>Акции</p>
	<ul class='list-sidebar-automats'>
		<?php
		$args = array(
			'cat' => '-1',
			'posts_per_page' => 3,
			'post_status'=>'publish',
			'orderby'=>'post_date',
			'paged'=> $page,
			'order'    => 'DESC'
		);
		query_posts($args);
		if ( have_posts() ) while ( have_posts() ) : the_post();
			$picture = get_post_meta($post->ID, 'wpcf-oval-picture', true);
			$title = get_the_title( $post->ID);
			?>
			<li>
				<div class='picture'>
					<a href='<?php the_permalink(); ?>'>
						<img src='<?=$picture?>' title='<?=$title?>' alt='<?=$title?>' />
					</a>
				</div>
				<div class='slot-description'>
					<p class='priwie-name'><?=$title?></p>
					<p class='rating'><?php echo the_ratings_results($post->ID, 0,0,0,1); ?></p>
				</div>
			</li>
		<?php
		endwhile;
		wp_reset_query();
		?>
	</ul>
</div>
