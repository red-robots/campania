<?php if( get_row_layout() == 'hero' ) {
  $title = get_sub_field('title');
  $image = get_sub_field('image');
  $hero_title = ($title) ? $title : get_the_title();
  if($image) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?> internalHero">
    <div class="heroImage" style="background-image:url('<?php echo $image['url']?>');"></div>
    <div class="heroText">
      <div class="text">
        <h1><?php echo $hero_title ?></h1>
      </div>
    </div>
  </div>
  <?php } ?>
<?php } ?>