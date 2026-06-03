<?php if( get_row_layout() == 'overlapping_image_and_title' ) {  
  $no_margin_top = get_sub_field('no_margin_top');
  $no_margin_bottom = get_sub_field('no_margin_bottom');
  $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $caption = get_sub_field('caption');
  $image = get_sub_field('image');
  $title = (isset($caption['title']) && $caption['title']) ? $caption['title'] : '';
  $text = (isset($caption['text']) && $caption['text']) ? $caption['text'] : '';
  if(  $image || ($title || $text) ) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?>">
    <div class="flexwrap">
      <?php if ($title || $text) { ?>
        <div class="textCol">
          <div class="wrap">
            <?php if ($title) { ?>
              <h2 class="title"><?php echo anti_email_spam($title) ?></h2>
            <?php } ?>
            <?php if ($text) { ?>
              <div class="text"><?php echo anti_email_spam($text) ?></div>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
      <?php if ($image) { ?>
      <div class="imageCol">
        <div class="image" style="background-image:url('<?php echo $image['url']?>')"></div>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
<?php } ?>