<?php get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
	
		<article>
			<h2><span class="underline"><?php the_title(); ?></span></h2>

			<div class="gallery_container">
				<ul class="gallery">
				<?php 
					$gallery = get_field('gallery');

					foreach( $gallery as $image )
					{
					?>
					<li>
						<a href="<?php echo $image['url']; ?>" rel="gallery">
							<img src="<?php echo $image['sizes']['medium'] ?>" height="300" />
						</a>
					</li>
					<?php
					}
				?>
				</ul>
			</div>
			<div class="gallery_controls">
				<a href="#prev" class="prev disable">previous</a>
				<a href="#next" class="next">next</a> 
			</div>
		</article>

	<?php endwhile; ?>

<?php get_footer(); ?>