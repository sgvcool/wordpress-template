<?php get_header(); ?>
<div class='wrapper'>
	<div class='contant-block'>
		<h1 class='headline'><?php the_title(); ?></h1>
		<div class='text'>
			<?php
			wp_reset_query();
			the_content();?>
		</div>
	</div>
	<div class='line'></div>
<?php get_footer();