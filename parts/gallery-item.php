<div id="post-item-<?php the_ID(); ?>" data-label="<?php the_title_attribute(); ?>" class="grid-item">
  <div class="post-thumbnail">
    <a href="<?php echo $imageUrl?>" data-fancybox="gallery">
      <?php the_post_thumbnail('medium'); ?>
    </a>
  </div>
</div>