<?php if( get_row_layout() == 'static_hero' ) {
  $bgImage = get_sub_field('background_image');
  $hero_title = get_sub_field('hero_title');
  if($bgImage || $hero_title) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?>">
    <?php if ($bgImage) { ?>
		<div class="bgImage" style="background-image:url('<?php echo $bgImage['url'] ?>')"></div>
    <?php } ?>
    <?php if ($hero_title) { ?>
    <div class="heroText">
			<div class="wrap">
				<h1><?php echo $hero_title ?></h1>
				<div class="circle"></div>
			</div>
    </div>
    <?php } ?>
  </div>
  <?php } ?>
<?php } ?>
