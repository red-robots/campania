<?php if( get_row_layout() == 'text_content' ) {
  $no_margin_top = get_sub_field('no_margin_top');
  $no_margin_bottom = get_sub_field('no_margin_bottom');
  $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $section_title = get_sub_field('section_title');
  $content_layout = get_sub_field('layout_style');
  $fullwidth_text = get_sub_field('fullwidth_text');
  $two_column = get_sub_field('two_column_content');
  $column1 = (isset($two_column['content_column_1']) && $two_column['content_column_1']) ? $two_column['content_column_1'] : '';
  $column2 = (isset($two_column['content_column_2']) && $two_column['content_column_2']) ? $two_column['content_column_2'] : '';
  $buttons = get_sub_field('buttons');
  $count_buttons = ($buttons) ? count($buttons) : 0;
  $column1_has_buttons = '';
  $column2_has_buttons = '';

  $buttons_html = '';
  ob_start();
  if($buttons) {
    echo '<div class="buttons">';
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

  $replacement = $buttons_html;

    
  if($content_layout == 'fullwidth') { 
    if ( strpos( strip_tags($fullwidth_text), '[display_buttons]' ) !== false ) {
      if($buttons_html) {
        $fullwidth_text = str_replace( '[display_buttons]', $replacement, $fullwidth_text );
      }
    } ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?> fullwidth-text-content">
      <div class="wrapper">
        <?php if ($section_title) { ?>
          <div class="titleDiv">
            <h2 class="section-title"><?php echo anti_email_spam($section_title) ?></h2>
          </div>
        <?php } ?>
        <?php if ($fullwidth_text) { ?>
          <div class="text"><?php echo anti_email_spam($fullwidth_text) ?></div>
        <?php } ?>
      </div>
    </div>
  <?php } else if($content_layout == 'two_column') { 

      if ( strpos( strip_tags($column1), '[display_buttons]' ) !== false ) {
        $column1_has_buttons = ' has-buttons';
        if($count_buttons==1) {
          $column1_has_buttons .= ' button-count-1';
        }
        if($buttons_html) {
          $column1 = str_replace( '[display_buttons]', $replacement, $column1 );
        }
      }
      if ( strpos( strip_tags($column2), '[display_buttons]' ) !== false ) {
        $column2_has_buttons = ' has-buttons';
        if($count_buttons==1) {
          $column2_has_buttons .= ' button-count-1';
        }
        if($buttons_html) {
          $column2 = str_replace( '[display_buttons]', $replacement, $column2 );
        }
      }

    ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?> two-column-text-content">
      <div class="wrapper">
        <?php if ($section_title) { ?>
          <div class="titleDiv">
            <h2 class="section-title"><?php echo anti_email_spam($section_title) ?></h2>
          </div>
        <?php } ?>
        <div class="flexwrap">
          <?php if ($column1) { ?>
            <div class="columnText columnText1<?php echo $column1_has_buttons ?>">
              <div class="text"><?php echo anti_email_spam($column1) ?></div>
            </div>
          <?php } ?>
          <?php if ($column2) { ?>
            <div class="columnText columnText2<?php echo $column2_has_buttons ?>">
              <div class="text"><?php echo anti_email_spam($column2) ?></div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>

  
<?php } ?>
