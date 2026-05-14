<?php if( get_row_layout() == 'grid_layout_image_icon' ) {
  $grid_items = get_sub_field('grid_items');
  if($grid_items) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?>">
		<div class="container">
			<div class="infoBlocks">
			<?php foreach ($grid_items as $grid) {
				$display_type = $grid['display_type'];
				$image_block = $grid['image_block'];
				$icon_block = $grid['icon_block'];
				if($display_type=='image' && isset($image_block['image']) ) {
					$imgUrl = $image_block['image']['url'];
					$imgAlt = $image_block['image']['title'];
					$link = $image_block['link'];
					$a_url = (isset($link['url']) && $link['url']) ? $link['url'] : '';
					$a_title = (isset($link['title']) && $link['title']) ? $link['title'] : '';
					$a_target = (isset($link['target']) && $link['target']) ? $link['target'] : '_self';
					$ariaLabel = ($a_title) ? ' aria-label="'.$a_title.'"' : '';
					?>
					<div class="infoBlock type-<?php echo $display_type ?>">
						<div class="inside">
						<?php if ($a_url) { ?>
							<a href="<?php echo $a_url ?>" target="<?php echo $a_target ?>" class="blockLink"<?php echo $ariaLabel ?>>
								<img src="<?php echo $imgUrl ?>" alt="<?php echo $imgAlt ?>">
							</a>
						<?php } else { ?>
							<img src="<?php echo $imgUrl ?>" alt="<?php echo $imgAlt ?>">
						<?php } ?>
						</div>
					</div>
				<?php }
				else if($display_type=='icon' && isset($icon_block['icon']) ) {
					$imgUrl = $icon_block['icon']['url'];
					$imgAlt = $icon_block['icon']['title'];
					$link = $icon_block['link'];
					$a_url = (isset($link['url']) && $link['url']) ? $link['url'] : '';
					$a_title = (isset($link['title']) && $link['title']) ? $link['title'] : '';
					$a_target = (isset($link['target']) && $link['target']) ? $link['target'] : '_self';
					$custom_title = $icon_block['title'];
					if(empty($a_title) && $custom_title) {
						$a_title = $custom_title;
					}
					?>
					<div class="infoBlock type-<?php echo $display_type ?>">
						<div class="inside">
						<?php if ($a_url) { ?>
							<a href="<?php echo $a_url ?>" target="<?php echo $a_target ?>" class="blockLink">
								<div class="icon">
									<img src="<?php echo $imgUrl ?>" alt="<?php echo $imgAlt ?>" role="decoration">
								</div>
								<div class="title"><?php echo $a_title ?></div>
							</a>
						<?php } else { ?>
							<div class="icon">
								<img src="<?php echo $imgUrl ?>" alt="<?php echo $imgAlt ?>" role="decoration">
							</div>
							<?php if ($custom_title) { ?>
							<div class="title"><?php echo $custom_title ?></div>
							<?php } ?>
						<?php } ?>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
			</div>
		</div>
  </div>
  <?php } ?>
<?php } ?>
