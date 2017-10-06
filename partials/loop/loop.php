<?php
/**
 * Loop Template fallback
 *
 * @since       1.1.0
 * @package     Inosencio
 * @subpackage  Inosencio/partials/loop
 */

defined( 'ABSPATH' ) || die();

$date_format = get_option( 'date_format', 'F j, Y' );

if ( have_posts() ) : ?>

    <div class="row">
        
        <div class="small-12 <?php echo ( is_active_sidebar( 'page' ) ) ? 'medium-8': 'no-sidebar'; ?> columns">

            <?php while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( array() ); ?>>
					
					<h1 class="post-title">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h1>
					<span class="timestamp"><span class="fa fa-clock-o"></span>&nbsp;<?php the_time( $date_format ); ?></span>
					<br /><br />

                    <div class="media-object stack-for-small">

                        <div class="media-object-section image-section">

                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="thumbnail">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php the_post_thumbnail( 'medium' ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                        </div>

                        <div class="media-object-section main-section">

                            <div class="page-content">
								<?php the_excerpt(); ?>
							</div>

                            <a href="<?php the_permalink(); ?>" class="button secondary alignright">
                                Read More
                            </a>

                        </div>

                    </div>

                </article>
            <?php endwhile; ?>
            
        </div>
        
        <?php if ( is_active_sidebar( 'page' ) ) : ?>
    
            <?php get_sidebar(); ?>

        <?php endif; ?>
        
    </div>

    <div class="row">

        <div class="columns small-12">
        <?php
            the_posts_pagination( array(
                'prev_text'          => 'Previous Page',
                'next_text'          => 'Next Page',
                'before_page_number' => '<span class="meta-nav screen-reader-text">Page</span>',
            ) );
            ?>
        </div>
        
    </div>

<?php else: ?>

    <div class="row">

        <div class="columns small-12">
            Nothing found, sorry!
        </div>
        
    </div>

<?php endif; ?>