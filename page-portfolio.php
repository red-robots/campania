<?php
/**
 * Template Name: Portfolio
 */
get_header();
$filter_category = ( isset($_GET['category']) && $_GET['category'] ) ? $_GET['category'] : '';
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$repeatable_blocks = get_field('flexible_content');
$flexible_content_internal = get_field('subpage_flexible_content');
$taxonomy = 'portfolio-categories';
$post_type = 'portfolio';
$perpageOption = get_field('portfolio_perpage','option');
$perpage = ($perpageOption) ? $perpageOption : '12';
$currentPageLink = get_permalink();
if($filter_category) {
  $currentPageLink = get_permalink() . '?category=' . $filter_category;
}
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
      'post_types' => array($post_type), 
      'taxonomy' => $taxonomy
    ));
    $current_name = 'All';
    if ($filter_category) {
      if($terms) {
        foreach ($terms as $tm) { 
          if($filter_category==$tm->slug) {
            $is_current_name = $tm->name;
          }
        }
      }
    }
    if($terms) { ?>
    <div class="categories">
      <ul>
        <li>
          <a href="<?php echo get_permalink() ?>" class="term-link term-all<?php echo (empty($filter_category)) ? ' current':''; ?>"><span>All</span></a>
        </li>
      <?php foreach($terms as $term) { 
        $term_slug = $term->slug;
        $term_name = $term->name;
        $term_link = get_term_link($term);
        $is_current = ($filter_category==$term_slug) ? ' current':'';
        $pagelink = get_permalink() . '?category=' . $term_slug;
        ?>
        <li>
          <a href="<?php echo $pagelink ?>" class="term-link term-<?php echo $term_slug . $is_current?>"><span><?php echo $term_name; ?></span></a>
        </li>
      <?php } ?>
      </ul>
    </div>
    <?php } ?>

    <?php
      $args = array(
        'post_type'      => 'portfolio',         // Fetch standard posts (change to 'any' or custom post type if needed)
        'posts_per_page' => $perpage,             // Number of posts to display
        'paged'          => $paged, 
        'post_status'    => 'publish',      // Only get published posts 
        'meta_query'     => array(
            array(
                'key'     => '_thumbnail_id', // This key only exists if a featured image is set
                'compare' => 'EXISTS',        // Ensures the key is present in the database
            ),
        ),
      );

      if($filter_category) {
        $args['tax_query'] = array(
          array(
            'taxonomy' => $taxonomy,
            'terms' => $filter_category,
            'field' => 'slug',
            'include_children' => true,
            'operator' => 'IN'
          )
        );
      }

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
