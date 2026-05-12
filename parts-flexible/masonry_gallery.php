<?php if( get_row_layout() == 'masonry_gallery' ) {
	$images = get_sub_field('gallery');
  if($images) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?>">
		<div class="wrapper">
			<div class="masonry-images">
				<div class="grid-sizer"></div>
				<?php foreach ($images as $img) { ?>
					<?php if( isset($img['url']) ) { ?>
					<div class="masonry-item">
						<a href="<?php echo $img['url']?>" class="popup-image" data-fancybox="gallery" data-rel="masonry-group-<?php echo $i ?>">
							<img src="<?php echo $img['url']?>" alt="<?php echo $img['title']?>">
						</a>
					</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
  </div>
  <?php } ?>
<?php } ?>
