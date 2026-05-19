<?php if( get_row_layout() == 'text_content' ) {  
  $layout_style = get_sub_field('layout_style');
  $buttons = get_sub_field('buttons');
  $search = '[display_buttons]';
  if($layout_style=='two_column') { 
    $col = get_sub_field('two_column_content');
    $content1 = (isset($col['content_column_1']) && $col['content_column_1']) ? $col['content_column_1'] : '';
    $content2 = (isset($col['content_column_2']) && $col['content_column_2']) ? $col['content_column_2'] : '';
    if($content1 || $content2) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?> two_column_content">
      <div class="wrapper">
        <div class="flexwrap">
          <?php if($content1) { 
            $replace = '';
            if (strpos($content1, $search) !== false) {
              if($buttons) {
                $buttonsCount = count($buttons);
                $replace = '<div class="buttons buttons-'.$buttonsCount.'">';
                foreach($buttons as $b) {
                  $btn = $b['button'];
                  $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
                  $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
                  $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
                  if($btnTitle && $btnLink) {
                    $replace .= '<a href="'.$btnLink.'" class="button" target="'.$btnTarget.'">'.$btnTitle.'</a>';
                  }
                }
                $replace .= '</div>';
              }  
            }
            $has_buttons = ($replace) ? ' has-buttons has-buttons-'.$buttonsCount : '';  
            $updated_html1 = str_replace($search, $replace, $content1);
          ?>
          <div class="columnText columnText1<?php echo $has_buttons?>">
            <div class="inside"><?php echo anti_email_spam($updated_html1) ?></div>
          </div>
          <?php } ?>

          <?php if($content2) { 
            $replace = '';
            if (strpos($content2, $search) !== false) {
              if($buttons) {
                $buttonsCount = count($buttons);
                $replace = '<div class="buttons buttons-'.$buttonsCount.'">';
                foreach($buttons as $b) {
                  $btn = $b['button'];
                  $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
                  $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
                  $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
                  if($btnTitle && $btnLink) {
                    $replace .= '<a href="'.$btnLink.'" class="button" target="'.$btnTarget.'">'.$btnTitle.'</a>';
                  }
                }
                $replace .= '</div>';
              }  
            }
            $has_buttons = ($replace) ? ' has-buttons has-buttons-'.$buttonsCount : '';  
          ?>
          <div class="columnText columnText2<?php echo $has_buttons?>">
            <div class="inside">
              <?php 
                $updated_html2 = str_replace($search, $replace, $content2);
                echo anti_email_spam($updated_html2);
              ?>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>
  <?php } else { 
    $fullwidth_content = get_sub_field('fullwidth_content'); 
    $replace = '';
    if (strpos($fullwidth_content, $search) !== false) {
      if($buttons) {
        $buttonsCount = count($buttons);
        $replace = '<div class="buttons buttons-'.$buttonsCount.'">';
        foreach($buttons as $b) {
          $btn = $b['button'];
          $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
          $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
          $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
          if($btnTitle && $btnLink) {
            $replace .= '<a href="'.$btnLink.'" class="button" target="'.$btnTarget.'">'.$btnTitle.'</a>';
          }
        }
        $replace .= '</div>';
      }  
    }
    $has_buttons = ($replace) ? ' has-buttons has-buttons-'.$buttonsCount : '';  
    $updated_content = str_replace($search, $replace, $fullwidth_content);
    ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?> fullwidth">
      <div class="wrapper">
        <?php echo anti_email_spam($updated_content) ?>
      </div>
    </div>
  <?php } ?>
<?php } ?>