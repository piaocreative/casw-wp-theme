<?php
/**
 * The template for resource post type
 *
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$resource_type_terms = get_the_terms( get_the_ID(), 'resource-type' );
$resource_type_id = $resource_type_terms[0]->term_id;
$resource_type = $resource_type_terms[0]->name;
$resource_color = get_field( 'color', 'term_' . $resource_type_id );
$resource_icon = get_field( 'icon', 'term_' . $resource_type_id );


// ACF Fields
// $resource_type = get_field( 'resource_type', get_the_ID() ); 
$organization = get_field( 'organization', get_the_ID() );
$location = get_field( 'location', get_the_ID() );
$date_start = get_field( 'date_start', get_the_ID() );
$date_end = get_field( 'date_end', get_the_ID() );
$author = get_field( 'author', get_the_ID() );
$published_by = get_field( 'published_by', get_the_ID() );
$published_date = get_field( 'published_date', get_the_ID() );
// $resource_for = get_field( 'resource_for', get_the_ID() );
$resource_link = get_field( 'resource_link', get_the_ID() );
$annotated_by = get_field( 'annotated_by', get_the_ID() );

$resource_categories = get_the_terms( get_the_ID(), 'resource-category' );
$resource_audience = get_the_terms( get_the_ID(), 'resource-audience' );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <div class="entry-header" style="background-color: <?php echo $resource_color; ?>;">
        <img src="<?php echo esc_url( $resource_icon ); ?>" class="resource-icon">
        <span><?php echo $resource_type; ?></span>
    </div>

    <div class="entry-content">
        <h3 class="post-title"><?php echo get_the_title(); ?></h3>
        
        <?php if ( $organization ) : ?>
            <p class="organization"><?php echo $organization; ?></p>
        <?php endif; ?>
        
        <div class="post-content">
            <?php echo get_the_content(); ?>
        </div>
        <button class="btn btn-dark more-btn text-uppercase">More</button>
    </div>
    
    <div class="modal-html">
        <div class="modal-header" style="background-color: <?php echo $resource_color; ?>;">
            <img src="<?php echo esc_url( $resource_icon ); ?>" class="resource-icon">
            <span><?php echo $resource_type; ?></span>
        </div>
        <div class="modal-body">            
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="resource-thumbnail">
                    <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>" alt="modal-image" height="200">
                </div>
            <?php endif; ?>
            
            <div class="resource-content">
                <div class="resource-info">
                    <div class="text-white comment"></div>
                    <h2 class="post-title info"><?php echo get_the_title(); ?></h2>
                </div>
                <div class="resource-info">
                    <div class="text-white comment">Summary:</div>
                    <p class="resource-summary info"><?php echo get_the_content(); ?></p>
                </div>
                <?php if ( $organization ) : ?>
                    <div class="resource-info">
                        <div class="text-white comment">Organization:</div>
                        <p class="resource-organization info"><?php echo $organization; ?></p>
                    </div>
                <?php endif; ?>
                <?php if ( $location ) : ?>
                    <div class="resource-info">
                        <div class="text-white comment">Location:</div>
                        <p class="resource-location info"><?php echo $location; ?></p>
                    </div>
                <?php endif; ?>
                <?php if ( $resource_type == 'Conference' ) : ?>
                    <div class="resource-info">
                        <div class="text-white comment">Dates:</div>
                        <p class="resource-date info"><?php echo $date_start; ?><?php echo $date_end ? ' - ' . $date_end : ''; ?></p>
                    </div>
                <?php endif; ?>
                <?php if ( $author ) : ?>
                    <div class="resource-info">
                        <div class="text-white comment">Author:</div>
                        <p class="resource-author info"><?php echo $author; ?></p>
                    </div>
                <?php endif; ?>                
                <?php if ( $published_by ) : ?>
                    <div class="resource-info">
                        <div class="text-white comment">Published By:</div>
                        <p class="resource-published-by info"><?php echo $published_by; ?></p>
                    </div>
                <?php endif; ?>                
                <?php if ( $published_date ) : ?>
                    <div class="resource-info">
                        <div class="text-white comment">Date:</div>
                        <p class="resource-published-date info"><?php echo $published_date; ?></p>
                    </div>
                <?php endif; ?>
                <?php if ( $annotated_by ) : ?>
                    <div class="resource-info">
                        <div class="text-white comment">Annotated by:</div>
                        <p class="resource-annotated-by info"><?php echo $annotated_by; ?></p>
                    </div>
                <?php endif; ?>
                <?php if ( $resource_categories && !empty( $resource_categories ) ) : ?>
                    <div class="resource-info">
                        <div class="text-white comment">Category:</div>
                        <div class="resource-category info">
                            <ul>
                                <?php foreach ( $resource_categories as $category ) : ?>
                                    <li style="background-color: <?php echo $resource_color; ?>;">
                                        <a href="<?php echo esc_url( get_term_link( $category->term_id, 'resource-category' ) ); ?>"><?php echo $category->name; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ( $resource_audience && !empty( $resource_audience ) ) : ?>
                    <div class="resource-info">
                        <div class="text-white comment">For:</div>
                        <div class="resource-for info">
                            <ul>
                                <?php foreach ( $resource_audience as $audience ) : ?>
                                    <li>
                                        <a href="<?php echo esc_url( get_term_link( $audience->term_id, 'resource-audience' ) ); ?>"><?php echo $audience->name; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- <p class="resource-for info"><?php echo $resource_for; ?></p> -->
                    </div>
                <?php endif; ?>
                <?php if ( $resource_link ) : ?>
                    <div class="resource-info">
                        <div class="text-white comment"></div>
                        <div class="info text-center">
                            <a href="<?php echo esc_url( $resource_link ); ?>" class="btn btn-dark resource-link" target="_blank">VISIT <i class="fa fa-external-link"></i></a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->