<?php if( get_row_layout() == 'horizontal_line' ) {
  $no_margin_top = get_sub_field('no_margin_top');
  $no_margin_bottom = get_sub_field('no_margin_bottom');
  $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $has_divider = get_sub_field('add_horizontal_line');
  if($has_divider) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?>">
    <div class="wrapper">
      <div class="divider"></div>
    </div>  
  </div>
  <?php } ?>
<?php } ?>