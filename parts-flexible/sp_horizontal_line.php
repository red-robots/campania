<?php if( get_row_layout() == 'horizontal_line' ) {
  $has_divider = get_sub_field('add_horizontal_line');
  if($has_divider) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?>">
    <div class="wrapper">
      <div class="divider"></div>
    </div>  
  </div>
  <?php } ?>
<?php } ?>