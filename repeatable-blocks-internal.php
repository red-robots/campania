<?php
$partsFiles = get_flexible_parts();
if( have_rows('subpage_flexible_content') ) {
$i=1; while( have_rows('subpage_flexible_content') ): the_row();
  if($partsFiles) {
    foreach($partsFiles as $file) {
      include( locate_template('parts-flexible/'.$file) );
    }
  }
$i++; endwhile;
} ?>
<script>
jQuery(document).ready(function($){
  
});
</script>
