<?php if( get_row_layout() == 'text_content_and_buttons' ) {
  $no_margin_top = get_sub_field('no_margin_top');
  $no_margin_bottom = get_sub_field('no_margin_bottom');
  $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  //$section_title = get_sub_field('section_title');
  $buttons = get_sub_field('buttons');
  $count_buttons = ($buttons) ? count($buttons) : 0;
  $buttonClass = ($buttons) ? ' button-count-' . $count_buttons : '';
  $textContent = get_sub_field('text_content');

  $buttons_html = '';
  ob_start();
  if($buttons) {
    echo '<div class="buttons'.$buttonClass.'">';
    foreach($buttons as $b) {
      $btn = $b['button'];
      $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
      $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
      $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
      if( $btnTitle && $btnLink ) { ?>
        <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
      <?php } 
    }
    echo '</div>';
    $buttons_html = ob_get_contents();
  }
  ob_end_clean();
  ob_flush();

  if($textContent || $buttons_html) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?>">
      <div class="wrapper">
        <div class="flexwrap">
          <?php if ($textContent) { ?>
            <div class="columnText columnText1">
              <div class="text"><?php echo anti_email_spam($textContent) ?></div>
            </div>
          <?php } ?>

          <?php if ($buttons_html) { ?>
            <div class="columnText columnText2 has-buttons<?php echo $buttonClass ?>">
              <div class="text"><?php echo $buttons_html ?></div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
    
<?php } ?>
