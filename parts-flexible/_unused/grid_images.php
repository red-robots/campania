<?php if( get_row_layout() == 'grid_images' ) {
	$images = get_sub_field('images');
  $numcol = get_sub_field('numcol');
	$numcol = ($numcol) ? $numcol : '3';
  if($images) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?>">
		<div class="grid-images numcol-<?php echo $numcol?>">
		<?php foreach ($images as $img) {
			$bgImgUrl = ( isset($img['bg_image']['url']) && $img['bg_image']['url'] ) ? $img['bg_image']['url'] : '';
			$logoUrl = ( isset($img['overlay_logo']['url']) && $img['overlay_logo']['url'] ) ? $img['overlay_logo']['url'] : '';
			$link = $img['link'];
			$grid_url = (isset($link['url']) && $link['url']) ? $link['url'] : '';
			$grid_title = (isset($link['title']) && $link['title']) ? $link['title'] : '';
			$grid_target = (isset($link['target']) && $link['target']) ? $link['target'] : '_self';
			if( $bgImgUrl ||  $logoUrl) { ?>
			<div class="grid">
				<?php if($grid_url) { ?>
				<a href="<?php echo $grid_url?>" target="<?php echo $grid_target?>" aria-label="<?php echo $grid_title?>" class="itemLink">
					<figure class="imageBlock">
						<?php if ($bgImgUrl) { ?>
						<div class="bgImage" style="background-image:url('<?php echo $bgImgUrl?>')"></div>
						<?php } ?>
						<?php if ($logoUrl) { ?>
							<img src="<?php echo $logoUrl?>" alt="<?php echo $img['overlay_logo']['title'] ?>" class="overlay-logo" />
						<?php } ?>
					</figure>
				</a>
				<?php } else { ?>
				<figure class="imageBlock">
					<?php if ($bgImgUrl) { ?>
					<div class="bgImage" style="background-image:url('<?php echo $bgImgUrl?>')"></div>
					<?php } ?>
					<?php if ($logoUrl) { ?>
						<img src="<?php echo $logoUrl?>" alt="<?php echo $img['overlay_logo']['title'] ?>" class="overlay-logo" />
					<?php } ?>
				</figure>
				<?php } ?>
			</div>
			<?php } ?>
		<?php } ?>
		</div>
  </div>
  <?php } ?>
<?php } ?>
