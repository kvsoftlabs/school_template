<?php
// create custom plugin settings menu
add_action('admin_menu', 'site_create_content');

function site_create_content() {
    $themepage = add_theme_page('Site Settings', 'Site Settings', 'administrator', 'common-settings', 'site_settings_form');

    //call register settings function
    add_action('admin_init', 'register_site_settings');
    add_action('admin_print_styles-' . $themepage, 'site_settings_admin_styles');
}

function register_site_settings() {
    $settings_val = array('site_logo', 'fvicon', 'location_img', 'default_banner', 'location_address', 'phone_image', 'about', 'phone',  'copy_text', 'cmpny_name',
                          'office_hours','footer_logo','facebook_image','facebook_image_url','twitter_image','twitter_image_url',
                          'youtube_image','youtube_image_url','google_image','google_image_url','yelp_image','yelp_image_url',
                        'linkedin_image','linkedin_image_url','instagram_image','instagram_image_url','blog_image','blog_image_url',
                    'footer_website_logo','footer_waterdrop_logo','address_logo','phone_logo','operating_logo','help',
                'footer_logo_link','google_analytics','contact_form');
    foreach ($settings_val as $set)
        register_setting('common-settings-group', $set);
}

function site_settings_admin_styles() {
    wp_enqueue_style('farbtastic');
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('thickbox');

    wp_enqueue_script('jquery');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('farbtastic');
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('wp-color-picker');
}

function site_settings_form() {
    get_template_part('includes/upload-scripts');
    ?>
    <div class="wrap settings-wrapper">
        <div id="icon-options-general" class="icon32"><br /></div>
        <h2 style="text-transform:capitalize;"><?php bloginfo('name'); ?> Site Settings</h2>
        <form class="site-setting-form" method="post" id="point-settings" name="common-settings" action="options.php">
            <?php settings_fields('common-settings-group'); ?>
            <div class="settings-container">
                <ul class='k2b-tabs'>
                    <li><a href='#k2b-tab1'>Common</a></li>
                    <li><a href='#k2b-tab2'>Social Icons</a></li>
                   
                    <li><a href='#k2b-tab3'>Footer Settings</a></li>
                    <li><a href='#k2b-tab4'>Contact Us</a></li>
                </ul>
                <div id="k2b-tab1" class="tab-wrapper">
                    <h3> Common Settings </h3>
                    <table class="form-table">
                        <?php
                        echo get_admin_input('up_image', 'site_logo', 'Website Logo', get_option('site_logo'), '');
                        echo get_admin_input('up_image', 'fvicon', 'Website Favicon', get_option('fvicon'), '');
                        echo get_admin_input('text', 'cmpny_name', 'Company Name', get_option('cmpny_name'), '');
                        echo get_admin_input('textarea', 'location_address', 'Address', get_option('location_address'), '');
                        echo get_admin_input('text', 'help', 'Help Title', get_option('help'), '');
                        echo get_admin_input('text', 'phone', 'Phone Number', get_option('phone'), '');
                        echo get_admin_input('textarea', 'office_hours', 'Office Hours', get_option('office_hours'), '');
                        echo get_admin_input('up_image', 'address_logo', 'Address Logo', get_option('address_logo'), '');
                        echo get_admin_input('up_image', 'phone_logo', 'Phone Logo', get_option('phone_logo'), '');
                        echo get_admin_input('up_image', 'operating_logo', 'Operating Logo', get_option('operating_logo'), '');
                        
                    echo get_admin_input('text', 'google_analytics', 'Google Analytics', get_option('google_analytics'), '');
                    echo get_admin_input('up_image', 'default_banner', 'Default Banner', get_option('default_banner'), '');

                       ?>

                    </table>
                </div>
                <div id="k2b-tab2" class="tab-wrapper">
                    <h3> Social Icons </h3>
                    <table class="form-table">
                        <?php
                      //  echo get_admin_input('up_image', 'facebook_image', 'Facebook Image', get_option('facebook_image'), '');
                        echo get_admin_input('text', 'facebook_image_url', 'Facebook', get_option('facebook_image_url'), '');
                       // echo get_admin_input('up_image', 'twitter_image', 'Twitter Image', get_option('twitter_image'), '');
                        echo get_admin_input('text', 'twitter_image_url', 'Twitter', get_option('twitter_image_url'), '');
                        //echo get_admin_input('up_image', 'youtube_image', 'YouTube Image', get_option('youtube_image'), '');
                        echo get_admin_input('text', 'youtube_image_url', 'YouTube', get_option('youtube_image_url'), '');
                        //echo get_admin_input('up_image', 'google_image', 'Google My Business Image', get_option('google_image'), '');
                        echo get_admin_input('text', 'google_image_url', 'Google My Business', get_option('google_image_url'), '');
                        //echo get_admin_input('up_image', 'yelp_image', 'Yelp Image', get_option('yelp_image'), '');
                        echo get_admin_input('text', 'yelp_image_url', 'Yelp', get_option('yelp_image_url'), '');
//echo get_admin_input('up_image', 'linkedin_image', 'LinkedIn Image', get_option('linkedin_image'), '');
                        echo get_admin_input('text', 'linkedin_image_url', 'LinkedIn', get_option('linkedin_image_url'), '');
                     //   echo get_admin_input('up_image', 'instagram_image', 'Instagram Image', get_option('instagram_image'), '');
                        echo get_admin_input('text', 'instagram_image_url', 'Instagram', get_option('instagram_image_url'), '');
                     //   echo get_admin_input('up_image', 'blog_image', 'Blog Image', get_option('blog_image'), '');
                        echo get_admin_input('text', 'blog_image_url', 'Blog', get_option('blog_image_url'), '');

                        
                        // echo get_admin_input('text', 'dorothy_name', 'Name', get_option('dorothy_name'), '');
                        // echo get_admin_input('text', 'realtor_license', 'Realtor License', get_option('realtor_license'), '');
                        // echo get_admin_input('textarea', 'dorothy_desc', 'Description', get_option('dorothy_desc'), '');
                        // echo get_admin_input('textarea', 'dorothy_addr', 'Address', get_option('dorothy_addr'), '');
                        // echo get_admin_input('text', 'dorothy_phone', 'Phone Number', get_option('dorothy_phone'), '');
                        // echo get_admin_input('text', 'dorothy_cell', 'Cell Number', get_option('dorothy_cell'), '');
                        // echo get_admin_input('text', 'dorothy_email', 'Email Id', get_option('dorothy_email'), '');
                         ?>
                    </table>
                </div>
                
                <div id="k2b-tab3" class="tab-wrapper">
                    <h3>Footer Settings</h3>
                    <table class="form-table">
                        <?php
//                        echo get_admin_input('textarea', 'foot_location_address', 'Address', get_option('foot_location_address'), '');
                        //echo get_admin_input('textarea', 'disclaimer', 'Disclaimer', get_option('disclaimer'), '');
                        echo get_admin_input('up_image', 'footer_website_logo', 'Footer Website Logo', get_option('footer_website_logo'), '');
                        echo get_admin_input('textarea', 'copy_text', 'Copyright text', get_option('copy_text'), '');
                        echo get_admin_input('up_image', 'footer_logo', 'Footer Logo', get_option('footer_logo'), '');
                        echo get_admin_input('text', 'footer_logo_link', 'Footer Logo Link', get_option('footer_logo_link'), '');
                        echo get_admin_input('up_image', 'footer_waterdrop_logo', 'Footer waterdrop Logo', get_option('footer_waterdrop_logo'), '');
                        ?>
                    </table>
                </div>
                <div id="k2b-tab4" class="tab-wrapper">
                    <h3>Contact Us</h3>
                    <table class="form-table">
                        <?php
                        echo get_admin_input('textarea', 'contact_form', 'Map Address', get_option('contact_form'), '');
                        ?>
                    </table>
                </div>
                <p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" name="submit-settings" /></p>
            </div><!-- settings-container -->		
        </form>
    </div><!-- wrap -->
<?php } 
/* Admin Logo */
add_action("admin_head", "my_admin_head");
function my_admin_head() {
	$option_logo = get_option("site_logo");
	echo "<style>#adminmenu .wp-menu-image img{padding: 5px 0 0;}</style>";
}
add_action("login_head", "my_login_head");
function my_login_head() {
	$option_logo = get_option("site_logo");
	echo "<style>
			body.login{background: #fffff;}
			body.login #login h1 a {background: url('" . $option_logo . "') no-repeat scroll center center transparent;
				height:150px;
				width:100%;
                background-size:contain;
			}
			#login{min-width:360px;padding:2% 0 0 0;}
			body.login #nav a, body.login #backtoblog a{ color:#fff;}
			#loginform .input{ border: 1px solid #777; }
		</style>";
}?>
