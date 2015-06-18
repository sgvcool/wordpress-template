<?php get_header(); ?>
<div class='col-md-12 padding0'>
	<div class='col-md-3 '>
		<?php get_sidebar();?>
	</div>
	
	<div class='col-md-9 '>
		<div class="bm-little-slider">
			<?php
			$page = (get_query_var('page')) ? get_query_var('page') : 1;
			$args = array(
				'cat' => '-1',
				'posts_per_page' => 150,
				'post_status'=>'publish',
				'orderby'=>'post_date',
				'paged'=> $page,
				'order'    => 'DESC'
			);
			query_posts($args);
			if ( have_posts() ) while ( have_posts() ) : the_post();
				$thumb = get_post_meta($post->ID, 'wpcf-oval-picture', true);
				$titleThumb = get_the_title( $post->ID);
				?>
				<div class='bm-over-little-picture'>
					<a href='<?php the_permalink(); ?>'>
						<img alt='<?=$titleThumb?>' title='<?=$titleThumb?>' class='bm-thumb' src='<?=$thumb?>' />
					</a>
				</div>
				<?php
				endwhile;
				wp_reset_query(); 
			?>
		</div>
	</div>
	
	<div class='col-md-9 '>
		<div class='text-container'>
			<h1 class='headline'><?php the_title(); ?></h1>
		</div>
	</div>

	<div class='col-md-9 list-slots'>
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
	
	<div class='col-md-9 '>
		<div class='text-container'>
			<?php the_content();?>
		</div>
		<div class='sub-head'>Похожие игровые автоматы</div>
		
		<div class='list-slots'>
			<?php
			$page = (get_query_var('page')) ? get_query_var('page') : 1;
			$args = array(
				'cat' => '-1',
				'posts_per_page' => 6,
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
</div>
<?php get_footer();