<?php if( get_row_layout() == 'text_content_3_columns' ) {
  $no_margin_top = get_sub_field('no_margin_top');
  $no_margin_bottom = get_sub_field('no_margin_bottom');
  $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $section_title = get_sub_field('section_title');
  $columns = get_sub_field('columns');
  $column_heading = ( isset($columns['column_heading']) && $columns['column_heading'] ) ? $columns['column_heading'] : '';
  $column1 = ( isset($columns['column1']) && $columns['column1'] ) ? $columns['column1'] : '';
  $column2 = ( isset($columns['column2']) && $columns['column2'] ) ? $columns['column2'] : '';
  $column3 = ( isset($columns['column3']) && $columns['column3'] ) ? $columns['column3'] : '';
  if($column1 || $column2 || $column3) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?>">
      <div class="wrapper">
        <div class="contentColumns">
          <?php if ($column_heading) { ?>
            <h3 class="colTitle"><?php echo anti_email_spam($column_heading) ?></h3>
          <?php } ?>
          <div class="flexwrap">
            <?php if ($column1) { ?>
              <div class="textCol textCol1"><?php echo anti_email_spam($column1) ?></div>
            <?php } ?>
            <?php if ($column2) { ?>
              <div class="textCol textCol2"><?php echo anti_email_spam($column2) ?></div>
            <?php } ?>
            <?php if ($column3) { ?>
              <div class="textCol textCol3"><?php echo anti_email_spam($column3) ?></div>
            <?php } ?>
          </div>  
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>
