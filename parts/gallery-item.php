<?php
$taxonomy = 'portfolio-categories';
$terms = get_the_terms( get_the_ID(), $taxonomy );
$termName = ($terms) ? $terms[0]->name : '';
?>
<div id="post-item-<?php the_ID(); ?>" data-label="<?php the_title_attribute(); ?>" class="grid-item">
  <div class="post-thumbnail">

    <a href="javascript:;" class="open-btn" data-fancybox="gallery" data-src="#popup-item-<?php the_ID(); ?>">
      <img src="<?php echo $imageUrl?>" alt="<?php echo get_the_title() ?>">
    </a>

  </div>
</div>

<div id="popup-item-<?php the_ID(); ?>" class="custom-fancybox-popup" style="display: none;">
  <div class="popup-container">
    <div class="popup-image-side">
      <img src="<?php echo $imageUrl?>" alt="<?php echo get_the_title() ?>">
    </div>
    <div class="popup-info-side">
      <?php if( $termName || get_the_content() ) { ?>
        <div class="info-box">
          <?php if( $termName ) { ?>
            <div class="category"><?php echo $termName?></div>
          <?php } ?>
          <?php if( get_the_content() ) { ?>
            <div class="description"><?php the_content() ?></div>
          <?php } ?>
        </div>
      <?php } ?>
      <div class="custom-nav-wrapper">
        <div class="custom-nav">
            <button class="nav-btn prev-btn"><span class="sr-only">Previous</span></button>
            <button class="nav-btn next-btn"><span class="sr-only">Next</span></button>
        </div>
      </div>
    </div>
  </div>
</div>