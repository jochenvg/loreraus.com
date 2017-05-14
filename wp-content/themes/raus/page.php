<?php get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
	
		<?php 
			if( is_home() || is_front_page() ){
				?><script> var home_bg = "<?php echo get_the_post_thumbnail_uri( get_the_post_thumbnail() ) ?>";</script><?php
			}

			if( is_page(9) ){
				?><script> var contact_bg = "<?php echo get_the_post_thumbnail_uri( get_the_post_thumbnail() ) ?>";</script><?php
			}
		?>
		<article>
			<h2><span class="underline"><?php the_title(); ?></span></h2>
			<?php the_content(); ?>
			<?php if( is_page(81) ): ?>
					<article class="audio">
						<div class="alignment">
							<ul>
							<?php 
								// The Query
								$query = new WP_Query( array(
									'cat' => 3,
									'posts_per_page' => -1
								));

								//The Loop
								while ( $query->have_posts() ) {
									$query->the_post();
								?>
								<li>
									<a href="<?php echo get_field('audio_file'); ?>" class="sm2_button"></a><?php the_title(); ?>
									
								</li>
								<?php
								}
								/* Restore original Post Data */
								wp_reset_postdata();
							?>
							</ul>
						</div>
					</article>
		<?php endif; ?>
			<?php if( is_page(9) ): ?>
				<div class="social_channels">
					<a href="<?php the_field('facebook') ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_static/img/soc_fb.png"/></a>
					<a href="<?php the_field('youtube') ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_static/img/soc_yt.png"/></a>
				</div>
			<?php endif; ?>
		</article>

	<?php endwhile; ?>

<?php get_footer(); ?>