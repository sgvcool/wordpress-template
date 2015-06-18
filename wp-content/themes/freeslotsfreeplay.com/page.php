<?php get_header(); ?>
    <div class='wrapper'>
        <div class='wrapper-content'>
			<div class='slot'>
				<div class='headline-slot'><h1><?php the_title(); ?></h1></div>
				<?php
				if(!in_category(42)){?>
					<div class='demo'>
						<?php $field = get_post_meta($post->ID, "wpcf-slot", true);
						if(stristr($field, '<embed') === FALSE & stristr($field, '<iframe') === FALSE) { ?>
							<iframe src="<?php echo $field; ?>" style="width: 706px; height: 480px;" scrolling="no"></iframe>
						<?php } else { echo $field;}?>
					</div>
					<a href='<?php echo get_post_meta($post->ID, 'wpcf-href-value', true); ?>' class='demo-btn'></a>
				<?php }?>
				
				<div class='clear'></div>
				<div class='slot-text'>
					<div class='slot-img'>
						<?php the_post_thumbnail();?>
						<div class='clear'></div>
						<div class='rating'><?php if(function_exists('the_ratings')) { the_ratings(); } ?></div>
					</div>
					
					<?php
					if ( have_posts() ) while ( have_posts() ) : the_post();
						the_content();
					endwhile; ?>
				</div>
			</div>
			
			<div class='clear' style='height: 5px'></div>
			<div class='headline'>Игровые автоматы бесплатно и без регистрации</div>
			<div class='clear' style='height: 5px'></div>
			<div class='automat-cont'>
			<?php
				$page = (get_query_var('page')) ? get_query_var('page') : 1;
				$args = array(
					'cat' => '-1,-42',
					'posts_per_page' => 8,
					'post_status'=>'publish',
					'meta_key' =>'ratings_average',
					'orderby' => 'meta_value_num',
					'order'    => 'DESC'
				);
				query_posts($args);
				$i=0;
				if ( have_posts() ) while ( have_posts() ) : the_post();
				$i++;?>
				<a href='<?php the_permalink(); ?>'>
					<div class='automat-item <?php if($i%4==0){echo "last";}?>'>
						<div class='automat'>
							<?php the_post_thumbnail('preview');?>
						</div>
						<div class='short-text'><?php echo get_post_meta($post->ID, 'wpcf-short-text', true); ?></div>
						<a href="<?php the_permalink(); ?>" class='cash'>Играть</a>
						<div class='rating'><?php echo the_ratings_results($post->ID, 0,0,0,1); ?></div>
					</div>
				</a>
				<?php endwhile;
				wp_reset_query();
			?>
			</div>
			<div class='clear'></div>

        </div>
        <?php get_sidebar();?>
    </div><!-- wrapper-->
	<div class='clear'></div>
<?php get_footer();