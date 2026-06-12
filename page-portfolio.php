<?php
/**
 * Template Name: Portfolio
 */
get_header();
$repeatable_blocks = get_field('flexible_content');
$flexible_content_internal = get_field('subpage_flexible_content');
$taxonomy = 'portfolio-categories';
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <?php if($flexible_content_internal) { ?>
      <div class="flexible-content-internal">
        <?php include( locate_template('repeatable-blocks-internal.php') ); ?>
      </div>
    <?php } ?>

    <?php
    $terms = get_terms( array(
      'orderby' => 'term_order',
      'order' => 'ASC',
      'hide_empty' => true,
      'taxonomy' => $taxonomy
    ));
    if($terms) { ?>
    <div class="categories">
      <ul>
      <?php foreach($terms as $term) { ?>
        <li>
          <a href="#"><span><?php echo $term->name; ?></span></a>
        </li>
      <?php } ?>
      </ul>
    </div>
    <?php } ?>

    <?php
      $args = array(
        'post_type'      => 'portfolio',         // Fetch standard posts (change to 'any' or custom post type if needed)
        'posts_per_page' => 3,             // Number of posts to display
        'post_status'    => 'publish',      // Only get published posts
        'meta_query'     => array(
            array(
                'key'     => '_thumbnail_id', // This key only exists if a featured image is set
                'compare' => 'EXISTS',        // Ensures the key is present in the database
            ),
        ),
      );
      $initial_query = new WP_Query($args);
      if ($initial_query->have_posts()) { ?>
      <div class="gallery-container">
        <div class="masonry-grid">
          <div class="grid-sizer"></div>
          <?php while ($initial_query->have_posts()) { $initial_query->the_post(); 
            $imageUrl = get_the_post_thumbnail_url(get_the_ID()); 
            include( locate_template('parts/gallery-item.php') ); ?> 
          <?php } wp_reset_postdata(); ?>
        </div>

        <?php if ($initial_query->max_num_pages > 1) { ?>
          <div class="load-more-wrapper">
            <button id="load-more-btn" class="btn" data-default-label="Load More">Load More</button>
          </div>
        <?php } ?>
      </div>
      <?php } ?>
  </main>
</div>
<?php
get_footer();
