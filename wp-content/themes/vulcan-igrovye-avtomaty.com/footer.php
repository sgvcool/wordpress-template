		<footer>
			<!-- footer menu-->
			<div class='footer-menu'>
				<?php wp_nav_menu('menu=footer'); ?>
			</div>
			<!-- footer menu-->
			
			<div class='pay'></div>
			<div class='copy'><?=date('Y');?> Все права защищены</div>
		</footer>
	</div>		  
	<script type="text/javascript">
		$('.win-now ul').bxSlider({
		  auto: true,
		  mode: 'vertical',
		  autoControls: false,
		  slideWidth:332,
		  maxSlides: 5,
		  slideMargin: 0,
		  minSlides: 5
		});
		
		$('.slider').bxSlider({
			  autoControls: false,
			  auto: true,
			  minSlides: 1,
			  maxSlides: 1,
			  moveSlides: 1
		  });
		
		$('.slot-slider').bxSlider({
			autoControls: false,
			auto: true,
			minSlides: 4,
			slideWidth:240,
			maxSlides: 4,
			moveSlides: 1
		});
	</script>
	<?php wp_footer(); ?>
</body>
</html>