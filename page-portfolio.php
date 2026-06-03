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
  </main>
</div>
<?php
get_footer();
