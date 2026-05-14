<?php if( get_row_layout() == 'two_column_image_text_block_style1' ) {
  $spacing = get_sub_field('topbottom_spacing');
  $sp_top = (isset($spacing['remove_top_spacing']) && $spacing['remove_top_spacing']) ? true : false;
  $sp_bottom = (isset($spacing['remove_bottom_spacing']) && $spacing['remove_bottom_spacing']) ? true : false;

  $img = get_sub_field('image_block');
  $text = get_sub_field('text_block');
	$imageUrl = (isset($img['image']) && $img['image']) ? $img['image']['url'] : '';
	$imagePosition = (isset($img['image_position']) && $img['image_position']) ? $img['image_position'] : 'left';

	$textContent = (isset($text['content']) && $text['content']) ? $text['content'] : '';
	$buttons = (isset($text['buttons']) && $text['buttons']) ? $text['buttons'] : '';

  $spacingClass = '';
  if($sp_top) {
    $spacingClass .= ' nopaddingTop';
  }
  if($sp_bottom) {
    $spacingClass .= ' nopaddingBottom';
  }

  if($imageUrl || $textContent) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $spacingClass ?>">
		<div class="wrapper">
			<div class="flexwrap image-<?php echo $imagePosition?>">
				<?php if ($imageUrl) { ?>
					<figure class="imageBlock">
						<img src="<?php echo $imageUrl?>" alt="" role="decoration">
					</figure>
				<?php } ?>

				<?php if ($textContent) { ?>
					<div class="textBlock">
						<div class="inside">
							<div class="text">
								<?php echo anti_email_spam($textContent) ?>
							</div>
							<?php if ($buttons) { ?>
								<div class="buttons">
									<?php foreach($buttons as $b) {
										$btn = $b['button'];
										$btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
										$btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
										$btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
										if( $btnTitle && $btnLink ) { ?>
											<a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
										<?php } ?>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

  </div>
  <?php } ?>
<?php } ?>
