<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */

?>
<!doctype html>
<head>
	 <!-- START META, DESCRIPTION, KEYWORDS, AUTHOR -->
    <link rel="Shortcut Icon" href="<?php echo get_option('fvicon');?>" type="image/x-icon" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
    <meta name="description" content="">
    <meta name="author" content="">
   
   <!-- END  META, DESCRIPTION, KEYWORDS, AUTHOR -->
   <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri('template_url'); ?>/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri('template_url'); ?>/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri('template_url'); ?>/css/all.min.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri('template_url'); ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri('template_url'); ?>/css/mobile.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri('template_url'); ?>/css/responsive.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri('template_url'); ?>/css/animate.css">
     
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- Page Loader
================================================== -->

<!-- Page Loader
================================================== -->
<!--header-->
<body class="home">
    
    <header>
    <div class="header-logo">
      <a href="<?php echo get_option('home'); ?>">
            <img class="img-fluid" alt="" src="<?php echo get_option('site_logo'); ?>" title=""/> 
          </a>  
      </div>

      <div class="header-right-wrapper">
  <div class="menu-wrapper">
    <div class="menus-nav">
 

    <nav class="nav nav-mob">
   <?php wp_nav_menu(array(
      'menu' => 'Header Menu', 
      'menu_class' => 'nav-list main-menu nav-menu-list',
      'walker' => new navclass_walker_nav_menu
      )); 
      ?>
</nav>

    </div>
  </div>

  </div>

    </header>

 <!--header end-->