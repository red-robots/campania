<?php if( get_row_layout() == 'fullwidth_text_content' ) {
  $text = get_sub_field('text_content');
  $buttons = get_sub_field('buttons');
	$buttons_alignment = get_sub_field('buttons_alignment');
	$buttons_alignment = ($buttons_alignment) ? $buttons_alignment : 'left';
  if($text || $buttons) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?>">
    <div class="wrapper">
      <?php if ($text) { ?>
        <div class="text"><?php echo anti_email_spam($text) ?></div>
      <?php } ?>
      <?php if ($buttons) { ?>
      <div class="buttons align-<?php echo $buttons_alignment ?>">
        <?php foreach($buttons as $b) {
          $btn = $b['button'];
          $btnStyle = (isset($b['button_style']) && $b['button_style']) ? $b['button_style'] : 'default';
          $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
          $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
          $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
          if( $btnTitle && $btnLink ) { ?>
            <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button btn-<?php echo $btnStyle ?>"><?php echo $btnTitle ?></a>
          <?php } ?>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
<?php } ?>
