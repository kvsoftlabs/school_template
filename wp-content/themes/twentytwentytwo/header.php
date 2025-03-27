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
<html lang="en">
<head>
  <!-- START META, DESCRIPTION, KEYWORDS, AUTHOR -->
  <link rel="Shortcut Icon" href="<?php echo get_option('fvicon');?>" type="image/x-icon" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
  <meta name="description" content="">
  <meta name="author" content="">
  
  <!-- END  META, DESCRIPTION, KEYWORDS, AUTHOR --> <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
  
  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="<?php echo get_stylesheet_directory_uri('template_url'); ?>/lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?php echo get_stylesheet_directory_uri('template_url'); ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri('template_url'); ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri('template_url'); ?>/css/style.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- Page Loader
================================================== -->

<!-- Page Loader
================================================== -->
<!--header-->
<body>
  <div class="container-xxl bg-white p-0">  
    <header>
      <div class="header-logo">
        <a href="<?php echo get_option('home'); ?>">
              <img class="img-fluid" alt="" src="<?php echo get_option('site_logo'); ?>" title=""/> 
            </a>  
        </div>

        <div class="header-right-wrapper">
          <div class="menu-wrapper">
            <div class="menus-nav">

            <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
              <a href="<?php echo home_url(); ?>" class="navbar-brand">
                  <h1 class="m-0 text-primary"><i class="fa fa-book-reader me-3"></i>Kider</h1>
              </a>
              <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarCollapse">
                <?php wp_nav_menu([
                  'menu' => 'Header Menu', 
                  'menu_class' => 'navbar-nav mx-auto',
                  'container' => false,
                  'walker' => new navclass_walker_nav_menu()
                ]);
                ?>
              </div>
            </nav>


            </div>
          </div>

      </div>
    </header>

 <!--header end-->