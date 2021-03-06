<?php get_header(); ?>
	
	<div class="clearfix">
		<article class="video">
			<div class="alignment">
				<h2><span class="underline">Video</span></h2>
				<div class="clearfix">
				<ul>
				<?php 
					// The Query
					$query = new WP_Query( array(
						'cat' => 4,
						'posts_per_page' => -1
					));

					//The Loop
					while ( $query->have_posts() ) {
						$query->the_post();
					
						$youtube_link = get_field('youtube_link');


						parse_str( parse_url( $youtube_link, PHP_URL_QUERY ), $yt_array );

						$youtube_id = $yt_array['v'];
					?>
					
					<li>
						<div class="border">
						 	<a href="http://www.youtube.com/embed/<?php echo $youtube_id; ?>?autoplay=1" class="fancybox.iframe">
						 		<img src="http://img.youtube.com/vi/<?php echo $youtube_id; ?>/0.jpg" width="242"/>
						 		<span class="play_btn"></span>
						 	</a>
						</div>
					 	<a class="fancybox.iframe" href="http://www.youtube.com/embed/<?php echo $youtube_id; ?>?autoplay=1" >
					 		<?php the_title(); ?>
					 	</a>
					</li>
					<?php
					}
					/* Restore original Post Data */
					wp_reset_postdata();
				?>
				</ul>
				</div>
			</div>
		</article>
	</div>
<?php get_footer(); ?>