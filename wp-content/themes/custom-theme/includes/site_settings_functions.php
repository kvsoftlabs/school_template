<?php
include_once('site_settings.php');

function register_my_menus() {
    register_nav_menus(
            array(
                'main-menu' => __('Main Menu'),
                'mobile-menu' => __('Mobile Menu'),
                'sitemap-menu' => __('Site Map'),
                'top-left' => __('Top Left Menu'),
                'top-right' => __('Top Right Menu'),
                'lang-menu' => __('Language Menu')
            )
    );
}

add_action('init', 'register_my_menus');
/* * ********* End Include Files ************* */
/* Start Map */

function googlemap_function($atts, $content = null) {
    extract(shortcode_atts(array(
        "width" => '',
        "height" => '',
        "zoom" => '',
        "address" => ''
                    ), $atts));
    $width = $width == '' ? 300 : $width;
    $zoom = $zoom == '' ? 14 : $zoom;
    $height = $height == '' ? 300 : $height;
    return '<iframe frameborder="0" scrolling="no" width="' . $width . '" height="' . $height . '" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . urlencode($address) . '&z=' . $zoom . '&output=embed" ></iframe>';
}

add_shortcode("googlemap", "googlemap_function");

function getgooglemap($address, $width = '', $height = '', $zoom = '') {
    $width = $width == '' ? 300 : $width;
    $zoom = $zoom == '' ? 14 : $zoom;
    $height = $height == '' ? 300 : $height;
    return '<iframe frameborder="0" scrolling="no" width="' . $width . '" height="' . $height . '" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . urlencode($address) . '&z=' . $zoom . '&output=embed" ></iframe>';
}

/* End Map */

function login_css() {
    wp_enqueue_style('login_css', get_template_directory_uri() . '/assets/css/login.css');
}

add_action('login_head', 'login_css');

//Menu slugBy Id
function get_menu_ID_by_Slug($menu_slug) {
    global $wpdb;
    $menu_id = $wpdb->get_row("SELECT term_id FROM " . $wpdb->prefix . "terms WHERE name = '" . $menu_slug . "' OR slug = '" . $menu_slug . "'");
    return $menu_id->term_id;
}

function wp_new_excerpt($text) {
    if ($text == '') {
        $text = get_the_content('');
        $text = strip_shortcodes($text);
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        $text = strip_tags($text);
        $text = nl2br($text);
        $excerpt_length = apply_filters('excerpt_length', 55);
        $words = explode(' ', $text, $excerpt_length + 1);
        if (count($words) > $excerpt_length) {
            array_pop($words);
            array_push($words, '...');
            $text = implode(' ', $words);
        }
    }
    return $text;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wp_new_excerpt');

function get_admin_input($type = 'text', $name = '', $label = 'Label', $value = '', $help_words = '', $other_values = '', $inp_id = '') {
    $help = ($help_words != '') ? '<br/><span class="description">(' . $help_words . ')</span>' : '';
    $ins = ($inp_id != '') ? 'id="' . $inp_id . '"' : '';
    $return = '';
    switch ($type) {
        case "text":
            $return .= '<tr valign="top"><th scope="row"><label>' . $label . '</label>' . $help . '</th><td><input class="regular-text" type="text" ' . $ins . ' name="' . $name . '"  value="' . $value . '"/></td></tr>';
            break;
        case "textarea":
            $return .= '<tr valign="top"><th scope="row"><label>' . $label . '</label>' . $help . '</th><td><textarea class="regular-text" ' . $ins . ' name="' . $name . '" rows="5" cols="70" >' . $value . '</textarea></td></tr>';
            break;
        case "editor":
            $settings = array('wpautop' => true, 'media_buttons' => true, 'textarea_name' => $name, 'textarea_rows' => 5, 'tinymce' => true, 'quicktags' => true, 'drag_drop_upload' => true);
            $return .= '<tr valign="top"><th scope="row"><label>' . $label . '</label>' . $help . '</th><td>' . wp_editor($value, $name, $settings) . '</td></tr>';
            break;
        case "up_image":
            $container = ($value != '') ? '<br/><img src="' . $value . '" style="max-width:300px;max-height: 150px;" alt="banner-image" />' : '';
            $return .= '<tr valign="top"><th scope="row"><label>' . $label . '</label>' . $help . '</th><td><div class="upload-image"><input class="regular-text up-image" readonly="readonly" ' . $ins . ' name="' . $name . '" type="text" value="' . $value . '" /><input class="upload-button" type="button" value="Upload" class="thickbox" /><input class="remove-button" type="button" value="Remove" /><div class="upload-image-container">' . $container . '</div><!-- upload-image-container --></div><!-- upload-image --></td></tr>';
            break;
        case "up_file":
            $container = ($value != '') ? '<br/><a href="' . $value . '" target="_blank" title="Download" >Download File</a>' : '';
            $return .= '<tr valign="top"><th scope="row"><label>' . $label . '</label>' . $help . '</th><td><div class="upload-file"><input class="regular-text up-file" readonly="readonly" ' . $ins . ' name="' . $name . '" type="text" value="' . $value . '"/><input class="file-upload-button" type="button" value="Upload" class="thickbox" /><input class="remove-file" type="button" value="Remove" /><div class="upload-file-container">' . $container . '</div></div>';
            break;
        case "color_picker":
            $return .= '<tr valign="top"><th scope="row"><label>' . $label . '</label>' . $help . '</th><td><input class="regular-text up-file" readonly="readonly" ' . $ins . ' name="' . $name . '" type="hidden" value="' . $value . '"/></td></tr>';
            $return .= '<script type="text/javascript">';
            $return .= ($inp_id != '') ? 'jQuery(document).ready(function() {jQuery("#' . $inp_id . '").wpColorPicker();});' : '';
            $return .= '</script></td></tr>';
            break;
        case "date_picker":
            $return .= '<tr valign="top"><th scope="row"><label>' . $label . '</label>' . $help . '</th><td><input class="regular-text up-file" readonly="readonly" ' . $ins . ' name="' . $name . '" type="text" value="' . $value . '"/>';
            $return .= '<script type="text/javascript">';
            $return .= ($inp_id != '') ? 'jQuery(document).ready(function() {jQuery("#' . $inp_id . '").datepicker({dateFormat : "yy-mm-dd"});});' : '';
            $return .= '</script></td></tr>';
            break;
        case "select":
            $return .= '<tr valign="top"><th scope="row"><label>' . $label . '</label>' . $help . '</th><td>';
            $return .= '<select ' . $ins . ' name="' . $name . '">';
            $return .= '<option value="">Select</option>';
            if (!empty($other_values)) {
                if (is_array($other_values)) {
                    foreach ($other_values as $select_lebel => $select_value) {
                        $return .= '<option value="' . $select_value . '" ' . (($select_value == $value) ? 'selected="selected"' : '') . '>' . $select_lebel . '</option>';
                    }
                } elseif ($other_values == 'cat_sliders') {
                    $cat_args = array('type' => 'sliders', 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => 1, 'hierarchical' => 1, 'exclude' => '', 'taxonomy' => 'slider-cat', 'pad_counts' => false);
                    $categories = get_categories($cat_args);
                    if (!empty($categories)) {
                        foreach ($categories as $cat) {
                            $return .= '<option value="' . $cat->slug . '" ' . (($cat->slug == $value) ? 'selected="selected"' : '') . '>' . $cat->name . '</option>';
                        }
                    }
                }
            } else {
                $page_args = array('post_type' => 'page', 'numberposts' => -1);
                $pages = get_posts($page_args);
                if (!empty($pages)) {
                    foreach ($pages as $pg) {
                        $return .= '<option value="' . $pg->ID . '" ' . (($pg->ID == $value) ? 'selected="selected"' : '') . '>' . $pg->post_title . '</option>';
                    }
                }
            }
            $return .= '</select></td></tr>';
            break;
        case "radio":
            $return .= '<tr valign="top"><th scope="row"><label>' . $label . '</label>' . $help . '</th><td>';
            if (!empty($other_values)) {
                if (is_array($other_values)) {
                    $i = 1;
                    foreach ($other_values as $select_lebel => $select_value) {
                        $checked = '';
                        if ($select_value == $value) {
                            $checked = 'checked="checked"';
                        } elseif ($i == 1) {
                            $checked = 'checked="checked"';
                        }
                        $return .= '<label for="rdo_' . $name . '_' . $i . '">' . $select_lebel . '</label>';
                        $return .= '<input id="rdo_' . $name . '_' . $i . '" type="radio" name="' . $name . '" ' . $checked . ' value="' . $select_value . '">';
                        $i++;
                    }
                }
            }
            $return .= '</td></tr>';
            break;
        case "checkbox":
            $return .= '<tr valign="top"><th scope="row"><label>' . $label . '</label>' . $help . '</th><td>';
            if (!empty($other_values)) {
                if (is_array($other_values)) {
                    $i = 1;
                    foreach ($other_values as $select_lebel => $select_value) {
                        $checked = '';
                        if (is_array($value)) {
                            if (in_array($select_value, $value)) {
                                $checked = 'checked="checked"';
                            }
                        }
                        $return .= '<input id="chk_' . $name . '_' . $i . '" type="checkbox" name="' . $name . '[]" ' . $checked . ' value="' . $select_value . '">';
                        $return .= '<label for="chk_' . $name . '_' . $i . '">' . $select_lebel . '</label>&nbsp;<br/>';
                        $i++;
                    }
                }
            } else {
                $checked = ($value == 1) ? 'checked="checked"' : '';
                $return .= '<input id="chk_' . $name . '" type="checkbox" name="' . $name . '" ' . $checked . ' value="1">';
            }
            $return .= '</td></tr>';
            break;
        default:
            $return .= '<tr valign="top"><th scope="row"><label>' . $label . '</label>' . $help . '</th><td><input class="regular-text" type="text" name="' . $name . '"  value="' . $value . '"/></td></tr>';
            break;
    }
    return $return;
}



function crop_image_size($url, $max_width = 950, $max_height = 322) {
    $return_url = '';
    if ($url != '') {
        $home_path = getcwd();
        $converted_img_path = ($_SERVER['HTTP_HOST'] != 'teamworks') ? str_replace(get_bloginfo('wpurl'), $home_path, $url) : $url;
        list($width, $height, $type, $attr) = getimagesize($converted_img_path);
        $w = ($width > $max_width) ? $max_width : $width;
        $h = ($height > $max_height) ? $max_height : $height;
        $return_url = get_bloginfo('template_directory') . '/timthumb.php?src=' . $url . '&w=' . $w . '&h=' . $h . '&q=100';
    }
    return $return_url;
}

function get_post_value_id($pid, $colName) {
    global $wpdb;
    $value = $wpdb->get_var("SELECT $colName FROM " . $wpdb->prefix . "posts WHERE ID = $pid");
    return $value;
}

function truncatebywords($phrase, $max_words) {
    $phrase_array = explode(' ', $phrase);
    if (count($phrase_array) > $max_words && $max_words > 0)
        $phrase = implode(' ', array_slice($phrase_array, 0, $max_words)) . ' ...';
    return $phrase;
}

function truncatebychars($chars, $limit) {
    if (strlen($chars) <= $limit)
        return $chars . ' ...';
    else
        return substr($chars, 0, $limit) . ' ...';
}

if (!function_exists('get_ID_by_slug')) {

    function get_ID_by_slug($page_slug) {
        $page = get_page_by_path($page_slug);
        if ($page) {
            return $page->ID;
        } else {
            return null;
        }
    }

}

//file upload
function file_upload($id = "", $name, $path, $types, $allowedExts = "") {
    $extension = end(explode(".", $_FILES[$name]["name"]));
    if (in_array($_FILES[$name]["type"], $types) && ($_FILES[$name]["size"] < 20000) && in_array($extension, $allowedExts)) {
        if ($_FILES[$name]["error"] > 0) {
            return 0;
            exit;
        } else {
            if (file_exists($path . $_FILES[$name]["name"])) {
                $updatedFileName = update_file_name($path . $_FILES[$name]["name"]);
                move_uploaded_file($_FILES[$name]['tmp_name'], $updatedFileName);
            } else {
                if (move_uploaded_file($_FILES[$name]["tmp_name"], $path . $_FILES[$name]["name"])) {
                    return 1;
                    exit;
                } else {
                    return 0;
                    exit;
                }
            }
        }
    } else {
        return 0;
        exit;
    }
}

function file_upload1($name, $path) {
    if (file_exists($path . $_FILES[$name]["name"])) {
        $updatedFileName = update_file_name($path . $_FILES[$name]["name"]);
        move_uploaded_file($_FILES[$name]['tmp_name'], $updatedFileName);
        return 1;
    } else {
        if (move_uploaded_file($_FILES[$name]["tmp_name"], $path . $_FILES[$name]["name"])) {
            return 1;
        }
    }
}

//update file name if exist
function update_file_name($file) {
    $pos = strrpos($file, '.');
    $ext = substr($file, $pos);
    $dir = strrpos($file, '/');
    $dr = substr($file, 0, ($dir + 1));
    $arr = explode('/', $file);
    $fName = trim($arr[(count($arr) - 1)], $ext);
    $exist = FALSE;
    $i = 2;
    while (!$exist) {
        $file = $dr . $fName . '_' . $i . $ext;
        if (!file_exists($file))
            $exist = TRUE;
        $i++;
    }
    return $file;
}

/* * ******* End Common Functions  *********** */
/* * ************************* Start Common Hooks ******************** */
add_filter('admin_footer_text', 'remove_footer_admin');

function remove_footer_admin() {
    $footer_copy = (get_option('footer-copy') != '') ? get_option('footer-copy') : "Copyright &copy; " . date('Y') . " " . get_bloginfo('name') . ". All Rights Reserved";
    echo $footer_copy;
}

add_filter('admin_footer', 'add_admin_css');

function add_admin_css() {
    echo '<link href="https://cnsfly.com/plhickey/wp-content/themes/plhickey/css/admin-style.css" rel="stylesheet" media="all"  />';
    echo '<script src="https://cnsfly.com/plhickey/wp-content/themes/plhickey/js/tab-function.js"></script>';
}

function validaton_login() {
    echo '<script src="' . get_bloginfo('template_directory') . '/assets/js/common/jquery-1.6.4.min.js"></script>';
    echo '<script src="' . get_bloginfo('template_directory') . '/assets/js/common/validate_wplogin.js"></script>';
}

add_action('login_footer', 'validaton_login');

function wp_login_logo_url() {
    return site_url();
}

function wp_login_logo_title() {
    return get_option('blogname');
}

add_filter('login_headerurl', 'wp_login_logo_url', 10, 4);
add_filter('login_headertitle', 'wp_login_logo_title');

function wp_css_login() {
    echo '<link href="' . get_bloginfo('template_directory') . '/assets/css/wp-login.css" rel="stylesheet" media="all"  />';
}

add_action('login_head', 'wp_css_login');

function set_fevicon() {
    $fav_icon = (get_option('fvicon') != '') ? get_option('fvicon') : get_bloginfo('stylesheet_directory') . '/assets/images/favicon.ico';
    echo '<link rel="shortcut icon" href="' . $fav_icon . '" type="image/x-icon"/>';
}

add_action('login_head', 'set_fevicon');
add_action('wp_head', 'set_fevicon');
add_action('admin_head', 'set_fevicon');
add_action('init', 'my_custom_init');

function my_custom_init() {
    add_post_type_support('page', 'excerpt');
}

function generate_random_string() {
    $string = '';
    for ($i = 0; $i < 5; $i++) {
        $string .= chr(rand(97, 122));
    }
    $_SESSION['random_number'] = $string;
}

function hide_update_notice() {
    remove_action('admin_notices', 'update_nag', 3);
}

add_action('admin_notices', 'hide_update_notice', 1);

function my_footer_version() {
    return get_bloginfo('name');
}

add_filter('update_footer', 'my_footer_version', 11);
/* * ************************* End Common Hooks ******************** */
/* * ************************ Start Image Sizes ****************** */
add_image_size('overview-thumb', 222, 131, true);
add_image_size('newshome-thumb', 155, 93, true);
/* * ************************ End Image Sizes ****************** */

function comments_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <div <?php comment_class('comments'); ?> id="li-comment-<?php comment_ID(); ?>">
        <h5><?php comment_date('M d, Y'); ?></h5>
        <?php if (get_comment_text() != 'Previous comment has been deleted as it has been found to be abusive.') { ?>
            <div class="comm_author"><span class="name_txt"><?php comment_author(); ?></span> says:</div>
        <?php } ?>   
        <?php comment_text(); ?>
        <?php if (get_comment_text() != 'Previous comment has been deleted as it has been found to be abusive.') { ?>
            <?php comment_reply_link(array_merge($args, array('reply_text' => __('REPLY', ''), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
        <?php } ?>
    </div>
    <?php
}

function get_sliders($args = array(''), $id = "", $class = "bx_slider") {
    if (!empty($args)) {
        $args['meta_key'] = '_thumbnail_id';
        $sliders = get_posts($args);
        $slider_active = (count($sliders) > 1) ? 'id=' . $id : '';
        $return = '<ul class="' . $class . '" ' . (($id != '') ? $slider_active : '') . '>';
        $image_exists = false;
        if (isset($sliders) && count($sliders) > 0) {
            foreach ($sliders as $sl) {
                $img_src = wp_get_attachment_url(get_post_thumbnail_id($sl->ID));
                if ($img_src != '') {
                    $image_exists = true;
                    $return .= '<li><img src="' . crop_image_size($img_src, 683, 227) . '" alt="' . $sl->post_title . '" /> </li>';
                }
            }
        }
        if ($image_exists == false) {
            $return .= '<li><img src="' . crop_image_size(get_bloginfo('template_directory') . '/images/yasisland_no_img_683X227.png', 683, 227) . '" alt="No Image" /> </li>';
        }
        $return .= '</ul>';
    }
    return $return;
}

/* * ************************* Start Registration Functions *************************** */
if (!function_exists('frn_register')) {

    function frn_register($first_name = '', $last_name = '', $user_name = '', $email = '', $password = '', $role, $metas = '') {
        require_once( ABSPATH . WPINC . '/registration.php' );
        $userdata = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'user_login' => esc_attr($user_name),
            'user_email' => esc_attr($email),
            'user_pass' => esc_attr($password),
            'role' => esc_attr($role)
        );
        if (!$userdata['user_login'])
            $result = __('A username is required for registration.', 'frontendprofile');
        elseif (username_exists($userdata['user_login']))
            $result = __('Sorry, that username already exists!', 'frontendprofile');
        elseif (!is_email($userdata['user_email'], true))
            $result = __('You must enter a valid email address.', 'frontendprofile');
        elseif (email_exists($userdata['user_email']))
            $result = __('Sorry, that email address is already used!', 'frontendprofile');
        else {
            $new_user = wp_insert_user($userdata);
            if (!empty($metas)) {
                foreach ($metas as $key => $val) {
                    if ($val != '') {
                        add_user_meta($new_user, $key, esc_attr($val));
                    }
                }
            }
            $result = 1;
        }
        return $result;
    }

}
if (!function_exists('frn_edit_profile')) {

    function frn_edit_profile($user_id = '', $first_name = '', $last_name = '', $email = '', $metas = '') {
        require_once( ABSPATH . WPINC . '/registration.php' );
        $userdata = array(
            'ID' => esc_attr($user_id),
            'first_name' => esc_attr($first_name),
            'last_name' => esc_attr($last_name),
            'user_email' => esc_attr($email)
        );
        wp_update_user($userdata);
        if (!empty($metas)) {
            foreach ($metas as $key => $val) {
                if ($val == '') {
                    delete_user_meta($user_id, $key);
                } else {
                    if (get_user_meta($user_id, $key, true) != '') {
                        update_usermeta($user_id, $key, $val);
                    } else {
                        add_user_meta($user_id, $key, $val);
                    }
                }
            }
        }
        return 1;
    }

}
if (!function_exists('generateRandomString')) {

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

}
if (!function_exists('chack_field')) {

    function chack_field($table_suff = '', $field = '', $value = '') {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $row = $wpdb->get_row("SELECT * FROM " . $prefix . $table_suff . " WHERE " . $field . " = '" . $value . "'");
        return count($row);
    }

}
if (!function_exists('chack_email_by_user_id')) {

    function chack_email_by_user_id($id = '', $email = '') {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $row = $wpdb->get_row("SELECT * FROM " . $prefix . "users WHERE ID = " . $id . " AND user_email = '" . $email . "'");
        return count($row);
    }

}
if (!function_exists('get_user_id_by_mail')) {

    function get_user_id_by_mail($mail = '') {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $row = $wpdb->get_row("SELECT ID FROM " . $prefix . "users WHERE user_email = '" . $mail . "'");
        return $row->ID;
    }

}
if (!function_exists('frn_login')) {

    function frn_login($username = '', $password = '', $deprecated = '') {
        if (wp_login($username, $password, $deprecated)) {
            $creds = array('user_login' => $username, 'user_password' => $password, 'remember' => true);
            wp_signon($creds, false);
            return 1;
        } else {
            return 0;
        }
    }

}
if (!function_exists('frontendn_login')) {

    function frontendn_login($username = '', $password = '', $deprecated = '') {
        $user = get_user_by('login', $username);
        $log_username = (!empty($user)) ? $user->user_login : $username;
        $role = $user->roles[0];
        $user_status = get_user_meta($user->ID, 'activate_status', true);
        $black_status = get_user_meta($user->ID, 'black_status', true);
        if (wp_login($log_username, $password, $deprecated)) {
            if (($role == 'user' && $user_status == 1) || $role == 'employee') {
                $creds = array('user_login' => $log_username, 'user_password' => $password, 'remember' => true);
                wp_signon($creds, false);
                return 1;
                exit;
            } elseif (($role == 'pending' && $user_status != 1) || $role == 'pending') {
                return 3;
                exit;
            } else {
                return 2;
                exit;
            }
        } else {
            return 0;
            exit;
        }
    }

}
if (!function_exists('get_user_role')) {

    function get_user_role() {
        global $current_user;
        $user_roles = $current_user->roles;
        $user_role = array_shift($user_roles);
        return $user_role;
    }

}
if (!function_exists('get_user_name')) {

    function get_user_name() {
        global $current_user;
        return $current_user->user_login;
    }

}
if (!function_exists('chaeck_user_password')) {

    function chaeck_user_password($password = '') {
        $user = get_user_by('id', get_current_user_id());
        if ($user && wp_check_password($password, $user->data->user_pass, $user->ID))
            return 1;
        else
            return 0;
    }

}
if (!function_exists('check_user_by_email')) {

    function check_user_by_email($email = '') {
        $user = get_user_by('email', $email);
        if (!empty($user))
            return 1;
        else
            return 0;
    }

}
if (!function_exists('check_user_by_username')) {

    function check_user_by_username($username = '') {
        $user = get_user_by('login', $username);
        if (!empty($user))
            return 1;
        else
            return 0;
    }

}
if (!function_exists('get_username_by_email')) {

    function get_username_by_email($email = '') {
        $user = get_user_by('email', $email);
        if (!empty($user))
            return $user->user_login;
        else
            return 0;
    }

}
if (!function_exists('check_current_comment_status')) {

    function check_current_comment_status($user_id = '', $comment_post_id = '') {
        global $current_user;
        global $wpdb;
        global $post;
        $post_id = ($post_id != '') ? $post_id : $post->ID;
        $user_id = ($user_id != '') ? $user_id : $current_user->ID;
        $query_string = "SELECT * FROM " . $wpdb->prefix . "comments WHERE user_id=" . $user_id . " AND comment_post_ID = '" . $comment_post_id . "'";
        $query = $wpdb->get_results($query_string);
        return $wpdb->num_rows;
    }

}
/* * ************************* End Registration Functions *************************** */
/* * ************************ Start Frontend Post  ************************************** */

function add_post($type = '', $texonomy = '', $title = '', $short_desc = '', $desc = '', $cats = '', $metas = '', $author = 1) {
    $id = get_current_user_id();
    $post_information = array(
        'post_title' => esc_attr(strip_tags($title)),
        'post_excerpt' => esc_attr($short_desc),
        'post_content' => esc_attr($desc),
        'post_type' => $type,
        'post_status' => 'publish',
        'post_author' => $author
    );
    $post_id = wp_insert_post($post_information);
    if ($texonomy != '' && !empty($cats)) {
        wp_set_post_terms($post_id, $cats, $texonomy, false);
    }
    if (!empty($metas)) {
        foreach ($metas as $key => $val) {
            if ($val != '') {
                add_post_meta($post_id, $key, esc_attr($val));
            }
        }
    }
    return $post_id;
}

function update_post($post_id = '', $texonomy = '', $title = '', $short_desc = '', $desc = '', $cats = '', $metas = '', $author = 1) {
    $update_values = array(
        'ID' => $post_id,
        'post_title' => $title,
        'post_excerpt' => $short_desc,
        'post_content' => $desc,
        'post_author' => $author
    );
    $postid = wp_update_post($update_values);
    wp_set_post_terms($post_id, $cats, $texonomy, false);
    if (!empty($metas)) {
        foreach ($metas as $key => $val) {
            if ($val == '') {
                delete_post_meta($post_id, $key);
            } else {
                if (get_post_meta($post_id, $key, true) != '') {
                    update_post_meta($post_id, $key, esc_attr($val));
                } else {
                    add_post_meta($post_id, $key, esc_attr($val));
                }
            }
        }
    }
    return $postid;
}

function addtach_feat_image($image_url = '', $post_id = '') {
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = basename($image_url);
    if (wp_mkdir_p($upload_dir['path']))
        $file = $upload_dir['path'] . '/' . $filename;
    else
        $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);
    $wp_filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment($attachment, $file, $post_id);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $file);
    wp_update_attachment_metadata($attach_id, $attach_data);
    set_post_thumbnail($post_id, $attach_id);
}

function insert_attachment($file_handler, $post_id, $setthumb = 'false') {
    if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK)
        __return_false();
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    $attach_id = media_handle_upload($file_handler, $post_id);
    if ($setthumb)
        update_post_meta($post_id, '_thumbnail_id', $attach_id);
    set_post_thumbnail($post_id, $attach_id);
    return $attach_id;
}

function uploadthisfile($uploadedfile = '') {
    if (!function_exists('wp_handle_upload'))
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    $upload_overrides = array('test_form' => false);
    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
    return $movefile;
}

/* * **************** End Frnotend Post  ***************************** */

function get_user_role_by_id($user_id = 0) {
    $user = get_user_by('id', $user_id);
    $role = $user->roles[0];
    return $role;
}

/* * ********************** Start Popular Posts *********************** */

function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//To keep the count accurate, lets get rid of prefetching
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_track_post_views($post_id) {
    if (!is_single())
        return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    wpb_set_post_views($post_id);
}

add_action('wp_head', 'wpb_track_post_views');

function wpb_get_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        $return = 0;
    } else {
        $return = $count;
    }
    return $return;
}

/* * ********************* End Popular Posts ************************ */
/* * ****************** Start Related Posts *********************** */
if (!function_exists('get_related_posts')) {

    function get_related_posts($post_id = '', $post_count = 10) {
        $return = '';
        $categories = get_the_category($post->ID);
        $tags = wp_get_post_tags($post_id);
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $individual_category)
                $category_ids[] = $individual_category->term_id;
            $return_args = array('category__in' => $category_ids, 'post__not_in' => array($post_id), 'numberposts' => $post_count, 'caller_get_posts' => 1, 'orderby' => 'rand');
            $return = get_posts($return_args);
        } elseif ($tags) {
            $tag_ids = array();
            foreach ($tags as $individual_tag)
                $tag_ids[] = $individual_tag->term_id;
            $return_args = array('tag__in' => $tag_ids, 'post__not_in' => array($post_id), 'numberposts' => $post_count, 'caller_get_posts' => 1, 'orderby' => 'rand');
            $return = get_posts($return_args);
        } else {
            add_filter('posts_search', '__search_by_title_only', 500, 2);
            $po = get_post($post_id);
            $return_args = array('s' => $po->post_title, 'orders' => 'rand', 'numberposts' => $post_count);
            remove_filter('posts_search', '__search_by_title_only', 500);
            $return = get_posts($return_args);
        }
        return $return;
    }

}
/* * ****************** End Related Posts *********************** */
/* * ********** Start Check Pagination *********** */
if (!function_exists('show_posts_nav')) {

    function show_posts_nav() {
        global $wp_query;
        return ($wp_query->max_num_pages > 1);
    }

}
/* * ********** End Check Pagination *********** */
if (!function_exists('the_content_by_id')) {

    function the_content_by_id($post_id = 0, $more_link_text = null, $stripteaser = false) {
        global $post;
        $post = &get_post($post_id);
        setup_postdata($post, $more_link_text, $stripteaser);
        the_content();
        wp_reset_postdata($post);
    }

}
if (!function_exists('get_the_content_by_id')) {

    function get_the_content_by_id($post_id = 0, $more_link_text = null, $stripteaser = false) {
        global $post;
        $post = &get_post($post_id);
        setup_postdata($post, $more_link_text, $stripteaser);
        $return = get_the_content();
        wp_reset_postdata($post);
        return $return;
    }

}
if (!function_exists('get_faqs_by_cat')) {

    function get_faqs_by_cat($atts, $cat_slug = '') {
        global $post;
        $atts = shortcode_atts(array('cat_slug' => $cat_slug), $atts);
        $return = '';
        if ($atts['cat_slug'] != '') {
            $args = array('post_type' => 'faqs', 'faqs-cat' => $atts['cat_slug'], 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC');
            query_posts($args);
            if (have_posts()) {
                $return .= '<div class="faqs_content">';
                while (have_posts()) {
                    the_post();
                    $return .= '<div class="faqs_container">';
                    $return .= '<h3 class="faq_head" id="' . the_slug(false) . '">' . get_the_title() . '</h3>';
                    $return .= '<div class="faqs_cont">';
                    $return .= wpautop(get_the_content());
                    $return .= '</div>';
                    $return .= '</div><!-- faqs_container -->';
                }
                $return .= '</div>';
            }
            wp_reset_query();
        }
        return $return;
    }

    add_shortcode('FAQS', 'get_faqs_by_cat');
}
if (!function_exists('get_faqs_by_cat')) {

    function get_embed_code($link = '') {
        $return = '';
        preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $link, $matches);
        if ($matches) {
            $return = $link;
        } else {
            $link_split = explode('/', $link);
            $youtube_code = explode('=', end($link_split));
            if (preg_match('/www.youtube.com/', $link)) {
                $return = '<iframe width="560" height="315" src="//www.youtube.com/embed/' . end($youtube_code) . '" frameborder="0" allowfullscreen></iframe>';
            } elseif (preg_match('/vimeo.com/', $link)) {
                $return = '<iframe src="//player.vimeo.com/video/' . end($link_split) . '" width="560" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
            }
        }
        return $return;
    }

}

function the_slug($echo = true) {
    $slug = basename(get_permalink());
    do_action('before_slug', $slug);
    $slug = apply_filters('slug_filter', $slug);
    if ($echo)
        echo $slug;
    do_action('after_slug', $slug);
    return $slug;
}

if (!function_exists('k2b_breadcrumbs')) {

    function k2b_breadcrumbs() {
        $text['home'] = 'Home'; // text for the 'Home' link
        $text['category'] = 'Archive by Category "%s"'; // text for a category page
        $text['search'] = 'Search Results for "%s" Query'; // text for a search results page
        $text['tag'] = 'Posts Tagged "%s"'; // text for a tag page
        $text['author'] = 'Articles Posted by %s'; // text for an author page
        $text['404'] = 'Error 404'; // text for the 404 page
        $show_current = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
        $show_on_home = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
        $show_title = 1; // 1 - show the title for the links, 0 - don't show
        $delimiter = ' &raquo; '; // delimiter between crumbs
        $before = '<span class="current">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb
        global $post;
        $home_link = home_url('/');
        $link_before = '<span typeof="v:Breadcrumb">';
        $link_after = '</span>';
        $link_attr = ' rel="v:url" property="v:title"';
        $link = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
        $parent_id = $parent_id_2 = $post->post_parent;
        $frontpage_id = get_option('page_on_front');
        if (is_home() || is_front_page()) {
            if ($show_on_home == 1)
                echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';
        } else {
            echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
            if ($show_home_link == 1) {
                echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
                if ($frontpage_id == 0 || $parent_id != $frontpage_id)
                    echo $delimiter;
            }
            if (is_category()) {
                $this_cat = get_category(get_query_var('cat'), false);
                if ($this_cat->parent != 0) {
                    $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                    if ($show_current == 0)
                        $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                    $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                    $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                    if ($show_title == 0)
                        $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                    echo $cats;
                }
                if ($show_current == 1)
                    echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
            } elseif (is_search()) {
                echo $before . sprintf($text['search'], get_search_query()) . $after;
            } elseif (is_day()) {
                echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
                echo $before . get_the_time('d') . $after;
            } elseif (is_month()) {
                echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
                echo $before . get_the_time('F') . $after;
            } elseif (is_year()) {
                echo $before . get_the_time('Y') . $after;
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() == 'cpt-services') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    printf($link, $home_link . 'services' . '/', 'Services');
                    if ($show_current == 1)
                        echo $delimiter . $before . get_the_title() . $after;
                }elseif (get_post_type() == 'cpt-clients') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    printf($link, $home_link . 'clients' . '/', 'Our Clients');
                    if ($show_current == 1)
                        echo $delimiter . $before . get_the_title() . $after;
                }elseif (get_post_type() == 'cpt-projects') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    printf($link, $home_link . 'our-projects' . '/', 'Our Projects');
                    if ($show_current == 1)
                        echo $delimiter . $before . get_the_title() . $after;
                }elseif (get_post_type() == 'cpt-casestudies') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    printf($link, $home_link . 'case-studies' . '/', 'Case Studies');
                    if ($show_current == 1)
                        echo $delimiter . $before . get_the_title() . $after;
                }elseif (get_post_type() == 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    printf($link, $home_link . 'blog' . '/', 'Blog');
                    if ($show_current == 1)
                        echo $delimiter . $before . get_the_title() . $after;
                }else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, $delimiter);
                    if ($show_current == 0)
                        $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                    $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                    $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                    if ($show_title == 0)
                        $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                    echo $cats;
                    if ($show_current == 1)
                        echo $before . get_the_title() . $after;
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;
            } elseif (is_attachment()) {
                $parent = get_post($parent_id);
                $cat = get_the_category($parent->ID);
                $cat = $cat[0];
                if ($cat) {
                    $cats = get_category_parents($cat, TRUE, $delimiter);
                    $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
                    $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                    if ($show_title == 0)
                        $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                    echo $cats;
                }
                printf($link, get_permalink($parent), $parent->post_title);
                if ($show_current == 1)
                    echo $delimiter . $before . get_the_title() . $after;
            } elseif (is_page() && !$parent_id) {
                if ($show_current == 1)
                    echo $before . get_the_title() . $after;
            } elseif (is_page() && $parent_id) {
                if ($parent_id != $frontpage_id) {
                    $breadcrumbs = array();
                    while ($parent_id) {
                        $page = get_page($parent_id);
                        if ($parent_id != $frontpage_id) {
                            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                        }
                        $parent_id = $page->post_parent;
                    }
                    $breadcrumbs = array_reverse($breadcrumbs);
                    for ($i = 0; $i < count($breadcrumbs); $i++) {
                        echo $breadcrumbs[$i];
                        if ($i != count($breadcrumbs) - 1)
                            echo $delimiter;
                    }
                }
                if ($show_current == 1) {
                    if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id))
                        echo $delimiter;
                    echo $before . get_the_title() . $after;
                }
            } elseif (is_tag()) {
                echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . sprintf($text['author'], $userdata->display_name) . $after;
            } elseif (is_404()) {
                echo $before . $text['404'] . $after;
            }
            if (get_query_var('paged')) {
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                    echo ' (';
                echo __('Page') . ' ' . get_query_var('paged');
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                    echo ')';
            }
            echo '</div><!-- .breadcrumbs -->';
        }
    }

}

function has_child_pages($page_id = '') {
    $page_args = array('post_type' => 'page', 'showposts' => -1, 'post_parent' => $page_id);
    $child_pages = get_posts($page_args);
    return (!empty($child_pages)) ? true : false;
}

/* * ************** Start 10-28-2014 ************** */

function pn_get_attachment_id_from_url($attachment_url = '') {
    global $wpdb;
    $attachment_id = false;
    if ('' == $attachment_url)
        return;
    $upload_dir_paths = wp_upload_dir();
    if (false !== strpos($attachment_url, $upload_dir_paths['baseurl'])) {
        $attachment_url = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url);
        $attachment_url = str_replace($upload_dir_paths['baseurl'] . '/', '', $attachment_url);
        $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url));
    }
    return $attachment_id;
}

function observePostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function fetchPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count . ' Views';
}

function filter_search($query) {
    if ($query->is_search) {
        $query->set('post_type', array('post', 'cpt-tutorials'));
    };
    return $query;
}

;
add_filter('pre_get_posts', 'filter_search');

function get_category_id($cat_name) {
    $term = get_term_by('name', $cat_name, 'testimonials-category');
    return $term->term_id;
}

function empty_filter($text) {
    return '';
}

# if any field is empty, forcibly empty the fields so that it will fail post publishing

function check_empty_title() {
    if (isset($_POST['publish']) && $_POST['publish'] == "Publish") {
        if (empty($_POST['post_title'])) {
            add_filter('title_save_pre', 'empty_filter');
        }
    }
}

add_action("load-post.php", 'check_empty_title', 1);

function check_empty_clientside() {
    ?>
    <script language="javascript" type="text/javascript">
        var wpJ = jQuery.noConflict();
        wpJ(document).ready(function () {
            wpJ("#post").submit(function () {
                if (wpJ("#title").val() == '') {
                    alert('You must enter the post title!');
                    return false;
                }
            });
        });
    </script>
    <?php
}

add_action('admin_head', 'check_empty_clientside', 1);
?>
