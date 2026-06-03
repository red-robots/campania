<?php if( get_row_layout() == 'regular_text_content' ) {
  $no_margin_top = get_sub_field('no_margin_top');
  $no_margin_bottom = get_sub_field('no_margin_bottom');
  $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $content_layout = get_sub_field('content_layout');
  $fullwidth_text = get_sub_field('fullwidth_text');
  $two_column = get_sub_field('two_column_content');
  $column1 = (isset($two_column['column1']) && $two_column['column1']) ? $two_column['column1'] : '';
  $column2 = (isset($two_column['column2']) && $two_column['column2']) ? $two_column['column2'] : '';
  //$buttons = get_sub_field('buttons');
    
  if($content_layout == 'fullwidth') { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?> fullwidth-text-content">
      <div class="wrapper">
        <?php if ($fullwidth_text) { ?>
          <div class="text"><?php echo anti_email_spam($fullwidth_text) ?></div>
        <?php } ?>
      </div>
    </div>
  <?php } else if($content_layout == 'two_column') { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?> two-column-text-content">
      <div class="wrapper">
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
  <?php } ?>

  
<?php } ?>
