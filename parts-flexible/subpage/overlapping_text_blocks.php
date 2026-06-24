<?php if( get_row_layout() == 'overlapping_text_blocks' ) {  
  $no_margin_top = get_sub_field('no_margin_top');
  $no_margin_bottom = get_sub_field('no_margin_bottom');
  $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $section_title = get_sub_field('section_title');
  $details = get_sub_field('details');
  $content_layout = ( isset($details['content_layout']) && $details['content_layout'] ) ? $details['content_layout'] : 'fullwidth';
  $has_details = '';
  $fullwidth_content = ( isset($details['fullwidth_content']) && $details['fullwidth_content'] ) ? $details['fullwidth_content'] : '';
  $details_column1 = ( isset($details['column1']) && $details['column1'] ) ? $details['column1'] : '';
  $details_column2 = ( isset($details['column2']) && $details['column2'] ) ? $details['column2'] : '';
  $details_column_heading = ( isset($details['column_heading']) && $details['column_heading'] ) ? $details['column_heading'] : '';
  if($content_layout=='fullwidth') {
    if($fullwidth_content) {
      $has_details = true;
    }
  } else {
    if( $details_column1 || $details_column2 ) {
      $has_details = true;
    }
  }

  $blackBox = get_sub_field('black_box_content');
  $blackBox_title = (isset($blackBox['title']) && $blackBox['title']) ? $blackBox['title'] : '';
  $blackBox_text = (isset($blackBox['text']) && $blackBox['text']) ? $blackBox['text'] : '';
  $blackBox_position = (isset($blackBox['blackbox_position']) && $blackBox['blackbox_position']) ? $blackBox['blackbox_position'] : 'right';
  if(  $has_details || ($blackBox_title || $blackBox_text) ) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?>">
    <?php if ($section_title) { ?>
      <div class="titleDiv wrapper">
        <h2 class="section-title"><?php echo anti_email_spam($section_title) ?></h2>
      </div>
    <?php } ?>
      
    <div class="flexwrap text-position-<?php echo $blackBox_position ?>">

      <?php if ($blackBox_title || $blackBox_text) { ?>
        <div class="blackBox">
          <div class="wrap">
            <?php if ($blackBox_title) { ?>
              <h2 class="title"><?php echo anti_email_spam($blackBox_title) ?></h2>
            <?php } ?>
            <?php if ($blackBox_text) { ?>
              <div class="text"><?php echo anti_email_spam($blackBox_text) ?></div>
            <?php } ?>
          </div>
        </div>
      <?php } ?>

      <?php if ($has_details) { ?>
        <?php if($content_layout=='fullwidth') { ?>
          <?php if ($fullwidth_content) { ?>
          <div class="detailsBlock fullwidth">
            <div class="text"><?php echo anti_email_spam($blackBox_text) ?></div>
          </div>
          <?php } ?>
        <?php } else { ?>

          <?php if ($details_column1 || $details_column2) { ?>
          <div class="detailsBlock twoColumn">
            <?php if ($details_column_heading) { ?>
              <h3 class="colTitle"><?php echo anti_email_spam($details_column_heading) ?></h3>
            <?php } ?>
            <div class="flexCols">
              <?php if ($details_column1) { ?>
                <div class="textCol1"><?php echo anti_email_spam($details_column1) ?></div>
              <?php } ?>
              <?php if ($details_column2) { ?>
                <div class="textCol2"><?php echo anti_email_spam($details_column2) ?></div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>

        <?php } ?>
      <?php } ?>

    </div>
    
  </div>
  <?php } ?>
<?php } ?>