<?php get_header(); ?>

    <article>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

                <?php if( has_post_thumbnail() ) the_post_thumbnail(); ?>

                <?php get_template_part( 'template-parts/meta' ); ?>

                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>

        <?php get_template_part( 'template-parts/nav' ); ?>

        <?php else : ?>
            <h2>Not Found</h2>
        <?php endif; ?>
    </article>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
