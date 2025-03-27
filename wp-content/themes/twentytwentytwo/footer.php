 <?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */

?>

<!--footer-->
 <!--footer-->
   
 <?php
  $address = get_option('location_address') ?? '123 Street, New York, USA';
  $number = get_option('phone') ?? '+012 345 67890';
  $mail = get_option('help') ?? 'info@example.com';
  $facebook = get_option('facebook_link') ?? '#';
  $twitter_link = get_option('twitter_link') ?? '#';
  $youtube_link = get_option('youtube_link') ?? '#';
  $linkedin_link = get_option('linkedin_link') ?? '#';
  $google_map_link = get_option('google_map_link') ?? '#';
  $cmpny_name = get_option('cmpny_name') ?? 'Your Site Name';
?>

  <!-- Footer Start -->
  <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
      <div class="container py-5">
          <div class="row g-5">
              <div class="col-lg-3 col-md-6">
                  <h3 class="text-white mb-4">Get In Touch</h3>
                  <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><?= esc_html($address); ?></p>
                  <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><?= esc_html($number); ?></p>
                  <p class="mb-2"><i class="fa fa-envelope me-3"></i><?= esc_html($mail); ?></p>
                  <div class="d-flex pt-2">
                      <a class="btn btn-outline-light btn-social" href="<?= esc_url($twitter_link); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                      <a class="btn btn-outline-light btn-social" href="<?= esc_url($facebook); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                      <a class="btn btn-outline-light btn-social" href="<?= esc_url($youtube_link); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                      <a class="btn btn-outline-light btn-social" href="<?= esc_url($linkedin_link); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6">
                  <h3 class="text-white mb-4">Quick Links</h3>
                  <?php wp_nav_menu([
                    'menu' => 'Header Menu', 
                    'menu_class' => 'navbar-nav mx-auto',
                    'container' => false,
                    'walker' => new navclass_walker_nav_menu()
                  ]);
                  ?>
              </div>
              <div class="col-lg-3 col-md-6">
                  <h3 class="text-white mb-4">Map</h3>
                  <div class="position-relative mx-auto" style="max-width: 400px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31162.049877383895!2d78.56471545000001!3d12.499168000000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bac540dd5ac6613%3A0x6f3185b3090fa58!2sTirupathur%2C%20Tamil%20Nadu!5e0!3m2!1sen!2sin!4v1743090667383!5m2!1sen!2sin" width="550" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
              </div>
          </div>
      </div>
      <div class="container">
          <div class="copyright">
              <div class="row">
                  <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                      &copy; <a class="border-bottom" href="#"><?= esc_html($cmpny_name); ?></a>, All Right Reserved. 
        
        Designed By <a class="border-bottom" href="">UTree Technologies</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Footer End -->


<!--footer-->

 <!--footer-->
 <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

</div>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri('template_url'); ?>/lib/wow/wow.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri('template_url'); ?>/lib/easing/easing.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri('template_url'); ?>/lib/waypoints/waypoints.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri('template_url'); ?>/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri('template_url'); ?>/js/main.js" type="text/javascript"></script> 
</body>
</html>