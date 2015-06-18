<div class='wrapper'>
		<div class='contant-block'>
			<h1 class='headline'><?php echo single_cat_title( $prefix = '', $display = true ) ?></h1>
			<ul class='list-news-category'>
				<?php
				$category = getCurrentCatID();
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
					'cat' => $category,
					'posts_per_page' => 10,
					'post_status'=>'publish',
					'orderby'=>'post_date',
					'paged'=> $paged,
					'order'    => 'DESC'
				);
				query_posts($args);
				if ( have_posts() ) while ( have_posts() ) : the_post();?>
					<li>
						<div class='news-picture'>
							<a href='<?php the_permalink(); ?>'>
								<?php the_post_thumbnail('new',array('class'=>'img'));?>
							</a>
						</div>
						<div class='text-new-item'>
							<div class='name-news-item'><?php echo get_the_title( $post->ID); ?></div>
							<?php echo mb_substr( strip_tags( get_the_content() ), 0, 500 ); ?>
							<a href='<?php the_permalink(); ?>' class='detail'>Подробней</a>
						</div>
						
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