<?php if( get_row_layout() == 'section_bgcolor_border' ) {
  $no_margin_top = get_sub_field('no_margin_top');
  $no_margin_bottom = get_sub_field('no_margin_bottom');
  $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $anchor_link = get_sub_field('anchor_link');
  $containerId = ($anchor_link) ? ' id="'.$anchor_link.'"' : '';
  //$section_title = get_sub_field('section_title');
  $text_content = get_sub_field('text_content');
  if($text_content) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?>">
      <div class="wrapper">
        <div class="inside"<?php echo $containerId ?>>
          <div class="text"><?php echo anti_email_spam($text_content) ?></div>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>
