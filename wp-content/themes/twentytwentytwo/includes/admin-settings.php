<?php
function load_wp_media_files($hook) {
    if ($hook !== 'toplevel_page_site-settings') {
        return;
    }
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'load_wp_media_files');

if (!function_exists('add_site_settings_menu')) {
    function add_site_settings_menu() {
        add_menu_page(
            'Site Settings',        
            'Site Settings',        
            'manage_options',       
            'site-settings',        
            'site_settings_page',   
            'dashicons-admin-generic', 
            20                      
        );
    }
    add_action('admin_menu', 'add_site_settings_menu');
}

if (!function_exists('register_site_settings')) {
    function register_site_settings() {
        register_setting('common-settings-group', 'site_logo');
        register_setting('common-settings-group', 'fvicon');
        register_setting('common-settings-group', 'cmpny_name');
        register_setting('common-settings-group', 'location_address');
        register_setting('common-settings-group', 'help');
        register_setting('common-settings-group', 'phone');
        register_setting('common-settings-group', 'facebook_link');
        register_setting('common-settings-group', 'twitter_link');
        register_setting('common-settings-group', 'youtube_link');
        register_setting('common-settings-group', 'linkedin_link');
        register_setting('common-settings-group', 'google_map_link');

        add_settings_section(
            'common_settings_section',
            'Common Settings',
            function () {
                echo '<p>Configure your site settings below.</p>';
            },
            'site-settings'
        );

        // Company Name
        add_settings_field(
            'cmpny_name',
            'Company Name',
            function () {
                $value = get_option('cmpny_name', '');
                echo '<input type="text" name="cmpny_name" value="' . esc_attr($value) . '" />';
            },
            'site-settings',
            'common_settings_section'
        );

        add_settings_field(
            'site_logo',
            'Site Logo',
            'site_logo_callback',
            'site-settings',
            'common_settings_section'
        );

        add_settings_field(
            'fvicon',
            'Favicon',
            'favicon_callback',
            'site-settings',
            'common_settings_section'
        );

        // Location Address
        add_settings_field(
            'location_address',
            'Location Address',
            function () {
                $value = get_option('location_address', '');
                echo '<textarea name="location_address">' . esc_textarea($value) . '</textarea>';
            },
            'site-settings',
            'common_settings_section'
        );

        // Help Email
        add_settings_field(
            'help',
            'Help Email',
            function () {
                $value = get_option('help', '');
                echo '<input type="email" name="help" value="' . esc_attr($value) . '" />';
            },
            'site-settings',
            'common_settings_section'
        );

        // Phone Number
        add_settings_field(
            'phone',
            'Phone Number',
            function () {
                $value = get_option('phone', '');
                echo '<input type="text" name="phone" value="' . esc_attr($value) . '" />';
            },
            'site-settings',
            'common_settings_section'
        );

        // Facebook Link
        add_settings_field(
            'facebook_link',
            'Facebook Link',
            function () {
                $value = get_option('facebook_link', '');
                echo '<input type="text" name="facebook_link" value="' . esc_attr($value) . '" />';
            },
            'site-settings',
            'common_settings_section'
        );

        // Twitter Link
        add_settings_field(
            'twitter_link',
            'Twitter Link',
            function () {
                $value = get_option('twitter_link', '');
                echo '<input type="text" name="twitter_link" value="' . esc_attr($value) . '" />';
            },
            'site-settings',
            'common_settings_section'
        );

        // Youtube Link
        add_settings_field(
            'youtube_link',
            'Youtube Link',
            function () {
                $value = get_option('youtube_link', '');
                echo '<input type="text" name="youtube_link" value="' . esc_attr($value) . '" />';
            },
            'site-settings',
            'common_settings_section'
        );

        // LinkedIn Link
        add_settings_field(
            'linkedin_link',
            'LinkedIn Link',
            function () {
                $value = get_option('linkedin_link', '');
                echo '<input type="text" name="linkedin_link" value="' . esc_attr($value) . '" />';
            },
            'site-settings',
            'common_settings_section'
        );

        // Google Maps Link
        add_settings_field(
            'google_map_link',
            'Google Maps Link',
            function () {
                $value = get_option('google_map_link', '');
                echo '<input type="text" name="google_map_link" value="' . esc_attr($value) . '" />';
            },
            'site-settings',
            'common_settings_section'
        );
    }
    add_action('admin_init', 'register_site_settings');
}


if (!function_exists('site_settings_page')) {
    function site_settings_page() {
        ?>
        <div class="wrap">
            <h1>Site Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('common-settings-group'); // Security fields
                do_settings_sections('site-settings'); // Display settings sections
                submit_button(); // Save button
                ?>
            </form>
        </div>
        <?php
    }
}


function site_logo_callback() {
    $site_logo = get_option('site_logo', '');
    ?>
    <input type="text" id="site_logo" name="site_logo" value="<?php echo esc_attr($site_logo); ?>" />
    <button type="button" class="button" id="upload_site_logo">Upload Logo</button>
    <?php if ($site_logo): ?>
        <br><img src="<?php echo esc_url($site_logo); ?>" style="max-width: 150px; margin-top: 10px;">
    <?php endif; ?>
    <script>
        jQuery(document).ready(function($){
            $('#upload_site_logo').click(function(e) {
                e.preventDefault();
                var mediaUploader = wp.media({
                    title: 'Select Site Logo',
                    button: { text: 'Use this logo' },
                    multiple: false
                }).on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#site_logo').val(attachment.url);
                }).open();
            });
        });
    </script>
    <?php
}

function favicon_callback() {
    $fvicon = get_option('fvicon', '');
    ?>
    <input type="text" id="fvicon" name="fvicon" value="<?php echo esc_attr($fvicon); ?>" />
    <button type="button" class="button" id="upload_fvicon">Upload Favicon</button>
    <?php if ($fvicon): ?>
        <br><img src="<?php echo esc_url($fvicon); ?>" style="max-width: 32px; margin-top: 10px;">
    <?php endif; ?>
    <script>
        jQuery(document).ready(function($){
            $('#upload_fvicon').click(function(e) {
                e.preventDefault();
                var mediaUploader = wp.media({
                    title: 'Select Favicon',
                    button: { text: 'Use this favicon' },
                    multiple: false
                }).on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#fvicon').val(attachment.url);
                }).open();
            });
        });
    </script>
    <?php
}



?>
