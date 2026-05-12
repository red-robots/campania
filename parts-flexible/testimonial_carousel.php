<?php if( get_row_layout() == 'testimonial_carousel' ) {  
  $testimonials = get_sub_field('testimonials');
  if($testimonials) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?>">
    <div class="testimonial-swiper">
      <div class="swiper-wrapper">
      <?php $ti=1; foreach ($testimonials as $t) { 
        $text = $t['text'];
        $author = $t['author'];
        if($text) { ?>
        <div class="swiper-slide testimonial-item testimonial-item-<?php echo $ti ?>">
          <div class="wrap">
            <div class="text"><?php echo $text ?></div>
            <?php if ($author) { ?>
            <div class="author"><?php echo $author ?></div>
            <?php } ?>
          </div>
        </div>
        <?php $ti++; } ?>
      <?php } ?>
      </div>

      <?php if ( count($testimonials) > 1 ) { ?>
      <div class="testimonial-button-prev"></div>
      <div class="testimonial-button-next"></div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
<?php } ?>