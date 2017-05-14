<?php get_header(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
		<script> var bio_bg = "<?php echo get_the_post_thumbnail_uri( get_the_post_thumbnail() ) ?>";</script>
		<article>
			<h2><span class="underline"><?php the_title(); ?></span></h2>
			
			<div class="lang_chooser">
				<ul class="clearfix">
					<li><a class="active" href="#en" data-lang="en">EN</a></li>
					<li><a href="#fr" data-lang="fr">FR</a></li>
					<li><a href="#nl" data-lang="nl">NL</a></li>
				</ul>
			</div>

			<div class="lang_wrapper">
				<div class="en active"><?php echo get_field('bio_en'); ?></div>
				<div class="fr"><?php echo get_field('bio_fr'); ?></div>
				<div class="nl"><?php echo get_field('bio_nl'); ?></div>
			</div>
		</article>

	<?php endwhile; ?>

<?php get_footer(); ?>