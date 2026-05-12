<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bellaworks
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

// $date = new DateTime();
// $date->setTimezone(new DateTimeZone('America/Detroit'));
// $fdate = $date->format('Y-m-d H:i:s');
// define('WP_CURRENT_TIME', $fdate);
// define('THEMEURI',get_template_directory_uri() . '/');

function bellaworks_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
   global $post;
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if ( is_front_page() || is_home() ) {
        $classes[] = 'homepage';
    } else {
        $classes[] = 'subpage';
    }
    if(is_page() && $post) {
      $classes[] = $post->post_name;
    }

    $browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));

    return $classes;
}
add_filter( 'body_class', 'bellaworks_body_classes' );


function add_query_vars_filter( $vars ) {
  $vars[] = "pg";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


function shortenText($string, $limit, $break=".", $pad="...") {
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  // is $break present between $limit and the end of the string?
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }

  return $string;
}


add_action('admin_enqueue_scripts', 'bellaworks_admin_style');
function bellaworks_admin_style() {
  wp_enqueue_style('admin-dashicons', get_template_directory_uri().'/css/dashicons.min.css');
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css');
}

function get_page_id_by_template($fileName) {
    $page_id = 0;
    if($fileName) {
        $pages = get_pages(array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => $fileName.'.php'
        ));

        if($pages) {
            $row = $pages[0];
            $page_id = $row->ID;
        }
    }
    return $page_id;
}

function string_cleaner($str) {
    if($str) {
        $str = str_replace(' ', '', $str);
        $str = preg_replace('/\s+/', '', $str);
        $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
        $str = strtolower($str);
        $str = trim($str);
        return $str;
    }
}

function format_phone_number($string) {
    if(empty($string)) return '';
    $append = '';
    if (strpos($string, '+') !== false) {
        $append = '+';
    }
    $string = preg_replace("/[^0-9]/", "", $string );
    $string = preg_replace('/\s+/', '', $string);
    return $append.$string;
}

function get_social_media() {
    $options = get_field("social_media","option");
    $icons = social_icons();
    $list = array();
    if($options) {
        foreach($options as $i=>$opt) {
            if( isset($opt['url']) && $opt['url'] ) {
                $url = $opt['url'];
                $parts = parse_url($url);
                $host = ( isset($parts['host']) && $parts['host'] ) ? $parts['host'] : '';
                if($host) {
                    foreach($icons as $type=>$icon) {
                        if (strpos($host, $type) !== false) {
                            $list[$i] = array('url'=>$url,'icon'=>$icon,'type'=>$type);
                        }
                    }
                }
            }
        }
    }

    return ($list) ? $list : '';
}

function social_icons() {
    $social_types = array(
        'facebook'  => 'fab fa-facebook-square',
        'twitter'   => 'fab fa-twitter',
        'linkedin'  => 'fab fa-linkedin',
        'instagram' => 'fab fa-instagram',
        'youtube'   => 'fab fa-youtube',
        'vimeo'  => 'fab fa-vimeo',
    );
    return $social_types;
}

function parse_external_url( $url = '', $internal_class = 'internal-link', $external_class = 'external-link') {

    $url = trim($url);

    // Abort if parameter URL is empty
    if( empty($url) ) {
        return false;
    }

    //$home_url = parse_url( $_SERVER['HTTP_HOST'] );
    $home_url = parse_url( home_url() );  // Works for WordPress

    $target = '_self';
    $class = $internal_class;

    if( $url!='#' ) {
        if (filter_var($url, FILTER_VALIDATE_URL)) {

            $link_url = parse_url( $url );

            // Decide on target
            if( empty($link_url['host']) ) {
                // Is an internal link
                $target = '_self';
                $class = $internal_class;

            } elseif( $link_url['host'] == $home_url['host'] ) {
                // Is an internal link
                $target = '_self';
                $class = $internal_class;

            } else {
                // Is an external link
                $target = '_blank';
                $class = $external_class;
            }
        }
    }

    // Return array
    $output = array(
        'class'     => $class,
        'target'    => $target,
        'url'       => $url
    );

    return $output;
}


/* Remove richtext editor on specific page */
add_action('init', 'hide_editor_by_page_id');
function hide_editor_by_page_id() {
  // Check if we are in the admin area
  if (!is_admin()) return;

  // Get the post ID from the URL
  $post_id = (isset($_GET['post']) && $_GET['post']) ? $_GET['post'] : '';
  if(empty($post_id)) {
    $post_id = (isset($_POST['post']) && $_POST['post']) ? $_POST['post'] : '';
  }
  if (!isset($post_id)) return;

  $homepage_id = get_option('page_on_front');
  // Hide the editor on homepage
  if ( (int) $post_id === (int) $homepage_id ) {
    remove_post_type_support('page', 'editor');
  }
}

// add_action( 'save_post', 'save_post_with_acf');
// function save_post_with_acf( $post_id) {
// 	global $wpdb;
// 	$posttype = get_post_type($post_id);
// 	if ( $posttype=='post' ) {
// 		$val = get_field('featured_story', $post_id);
// 		if($val) {
// 			$query = "SELECT meta.meta_id, meta.post_id FROM ".$wpdb->prefix."postmeta meta WHERE meta.meta_key LIKE '%featured_story%' AND meta.post_id!=" . $post_id;
// 			$result = $wpdb->get_results($query);
// 			if($result) {
// 				foreach($result as $row) {
// 					if($post_id!=$row->post_id) {
// 						delete_post_meta($row->post_id, 'featured_story');
// 						delete_post_meta($row->post_id, '_featured_story');
// 					}
// 				}
// 			}
// 		}
// 	}
// }




// add new buttons
add_filter( 'mce_buttons', 'myplugin_register_buttons' );

function myplugin_register_buttons( $buttons ) {
	array_push( $buttons, 'edbutton1', 'custom_class' );

	return $buttons;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
add_filter( 'mce_external_plugins', 'myplugin_register_tinymce_javascript' );

function myplugin_register_tinymce_javascript( $plugin_array ) {
  $plugin_array['checklistbutton'] = get_stylesheet_directory_uri() . '/assets/js/custom/custom-tinymce.js';
  $plugin_array['ctabutton'] = get_stylesheet_directory_uri() . '/assets/js/custom/custom-tinymce.js';
  return $plugin_array;
}

// add_action('rest_api_init', function () {
//     register_rest_route( 'myquery/v1', 'latest-posts',array(
//         'methods'  => 'GET',
//         'callback' => 'get_latest_posts'
//     ));
// });
// function get_latest_posts($request) {
//     $postType = $request['ptype'];
//     $posts_per_page = -1;
//     $args = array(
//         'posts_per_page'  => $posts_per_page,
//         'post_type'       => $postType,
//         'orderby'         => 'date',
//         'order'           => 'desc',
//         'post_status'     => 'publish'
//     );

//     if (empty($postType)) {
//     return new WP_Error( 'post_type', 'No post type indicated', array('status' => 404) );
//     }

//     $posts = get_posts($args);
//     $extractedImages = array();
//     if($posts) {
//         foreach($posts as $row) {
//             $id = $row->ID;
//             $imageUrl = get_the_post_thumbnail_url($id);
//             $row->featured_image = $imageUrl;
//             $content = $row->post_content;
//             // $htmlDom = new DOMDocument;
//             // $htmlDom->loadHTML($content);
//             // $imageTags = $htmlDom->getElementsByTagName('img');
//             // $extractedImages = array();
//             // foreach($imageTags as $imageTag){
//             //     $extractedImages[] = $imageTag->getAttribute('src');
//             // }
//             preg_match_all('~<img.*?src=["\']+(.*?)["\']+~', $content, $urls);
//             $extractedImages = $urls[1];
//             //$extractedImages[] = $urls;

//         }
//     }

//     $res['count'] = ($posts) ? count($posts) : 0;
//     $res['posts'] = $posts;

//     $response = new WP_REST_Response($extractedImages);
//     $response->set_status(200);

//     return $response;
// }


function bella_acf_input_admin_footer() { ?>
<script type="text/javascript">
(function($) {
  acf.add_filter('color_picker_args', function( args, $field ){
    // do something to args
    args.palettes = ['#3D5588','#F26522','#81C674','#FEBC11','#FAF1DB','#32845C','#00B2CD']
    return args;
  });
})(jQuery);
</script>
<?php
}
add_action('acf/input/admin_footer', 'bella_acf_input_admin_footer');


add_filter( 'gform_display_add_form_button', 'display_form_button_on_specific_page' );
function display_form_button_on_specific_page( $display_add_form_button ) {
  if ( isset( $_GET['post'] ) && get_field('repeatable_blocks', $_GET['post']) ) {
    return true;
  }
  return $display_add_form_button;
}

function get_flexible_parts() {
	$dir = get_stylesheet_directory() . '/parts-flexible/';
	$partsFiles = [];
	if (is_dir($dir)) {
		$files = scandir($dir);
		foreach ($files as $file) {
			$pathinfo = pathinfo($file);
			if( isset($pathinfo['extension']) && strtolower($pathinfo['extension']) =='php' ) {
				if (!preg_match('/-copy| copy|-bak|-backup/i', strtolower($file))) {
					$partsFiles[] = $file;
				}
			}
		}
	}
	return $partsFiles;
}



