<?php get_header(); ?>

	<article role="article">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<?php if( has_post_thumbnail() ) the_post_thumbnail(); ?>

				<h1><?php the_title(); ?></h1>

				<?php the_content(); ?>

				<?php edit_post_link( 'Edit this entry.', '<hr><p>', '</p>' ); ?>
			</div>
		<?php endwhile; endif; ?>
	</article>

<?php get_sidebar( 'page' ); ?>

<?php get_footer(); ?>
