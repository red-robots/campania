<?php if( get_row_layout() == 'regular_text_content' ) {
  $no_margin_top = get_sub_field('no_margin_top');
  $no_margin_bottom = get_sub_field('no_margin_bottom');
  $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $section_title = get_sub_field('section_title');
  $content_layout = get_sub_field('content_layout');
  $fullwidth_text = get_sub_field('fullwidth_text');
  $two_column = get_sub_field('two_column_content');
  $column1 = (isset($two_column['column1']) && $two_column['column1']) ? $two_column['column1'] : '';
  $column2 = (isset($two_column['column2']) && $two_column['column2']) ? $two_column['column2'] : '';
  //$buttons = get_sub_field('buttons');
    
  if($content_layout == 'fullwidth') { ?>
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
  <?php } else if($content_layout == 'two_column') { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?> two-column-text-content">
      <div class="wrapper">
        <?php if ($section_title) { ?>
          <div class="titleDiv">
            <h2 class="section-title"><?php echo anti_email_spam($section_title) ?></h2>
          </div>
        <?php } ?>
        <div class="flexwrap">
          <?php if ($column1) { ?>
            <div class="fcol col1">
              <div class="text"><?php echo anti_email_spam($column1) ?></div>
            </div>
          <?php } ?>
          <?php if ($column2) { ?>
            <div class="fcol col2">
              <div class="text"><?php echo anti_email_spam($column2) ?></div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } else if($content_layout == 'two_column_box') { 
    $twocolumnwithbox = get_sub_field('twocolumnwithbox');
    $boxed = ( isset($twocolumnwithbox['boxed_content']) && $twocolumnwithbox['boxed_content'] ) ? $twocolumnwithbox['boxed_content'] : '';
    $details = ( isset($twocolumnwithbox['details']) && $twocolumnwithbox['details'] ) ? $twocolumnwithbox['details'] : '';
    $boxPosition = ( isset($twocolumnwithbox['boxed_content_position']) && $twocolumnwithbox['boxed_content_position'] ) ? $twocolumnwithbox['boxed_content_position'] : 'left';

    if($boxed || $details) { ?>
      <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?> twocolumnwithbox">
        <div class="wrapper">
          <div class="flexwrap box--<?php echo $boxPosition?>">
            <?php if($boxPosition=='left') { ?>
              
              <?php if ($boxed) { ?>
                <div class="fcol borderedBox p-left">
                  <div class="text"><?php echo anti_email_spam($boxed) ?></div>
                </div>
              <?php } ?>
              <?php if ($details) { ?>
                <div class="fcol detailsBlock">
                  <div class="text"><?php echo anti_email_spam($details) ?></div>
                </div>
              <?php } ?>

            <?php } else { ?>
              
              <?php if ($details) { ?>
                <div class="fcol detailsBlock">
                  <div class="text"><?php echo anti_email_spam($details) ?></div>
                </div>
              <?php } ?>
              
              <?php if ($boxed) { ?>
                <div class="fcol borderedBox p-right">
                  <div class="text"><?php echo anti_email_spam($boxed) ?></div>
                </div>
              <?php } ?>

            <?php } ?>

          </div>
        </div>
      </div>
    <?php } ?>
  <?php } ?>

  
<?php } ?>
