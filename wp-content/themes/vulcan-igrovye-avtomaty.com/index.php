<?php get_header(); ?>
    <div class='hm-wrapper'>
        <div class='hm-wrapper-content'>
			<div class='hm-automat-container'>
			<?php
				$ref_link = get_option('ref_link');
				query_posts($query_string ."&cat=-1&posts_per_page=28&post-type='post'");
				$i=0;
				if ( have_posts() ) { 
					while ( have_posts() ) : the_post();
					$i++;?>
						<div class='hm-automat-item'>
							<div class='hm-automat'>
								<?php the_post_thumbnail('',array('class'=>'hm-slot-img'));?>
								<div class='hm-short-text'><?php echo get_post_meta($post->ID, 'wpcf-short-text', true); ?></div>
								<a href="<?php the_permalink(); ?>" class='hm-cash'>Играть</a>
								<div class='hm-rating'><?php echo the_ratings_results($post->ID, 0,0,0,1); ?></div>
							</div>
						</div>
					<?php endwhile;
					wp_reset_query();
				} else { 
					echo "<h3 class='gradient' style='text-align:center;'>Ничего не найдено</h3>";
				}
            ?>
			</div>
		</div><!-- wrapper-content-->	
		<?php get_sidebar();?>
		</div><!-- wrapper-content-->	
		
		<div class='clear'></div>
<?php get_footer();