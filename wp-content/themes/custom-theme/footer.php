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
   
 <footer>



</footer>

<!--footer-->

 <!--footer-->


<div class="scroll-top-section">
   <a href="#" title="" class="ScrollTop"><i class="fas fa-chevron-up"></i></a>
   <?php wp_footer(); ?>

</div> 

<script src="<?php echo get_stylesheet_directory_uri('template_url'); ?>/js/all.min.js" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri('template_url'); ?>/js/wow.js" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri('template_url'); ?>/js/custom.js" type="text/javascript"></script> 

<script>
  //scroll top jquery
jQuery(document).ready(function(){

//Check to see if the window is top if not then display button
jQuery(window).scroll(function(){
  if (jQuery(this).scrollTop() > 900) {
    jQuery('.ScrollTop').css("display","block");
  } else {
    jQuery('.ScrollTop').css("display","none");
  }
});

jQuery('.ScrollTop').click(function() {

  jQuery('html, body').animate({scrollTop: 0}, 800);
      return false;
  });
});
</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_option('google_analytics'); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo get_option('google_analytics'); ?>');
</script>
<script>
//remove unwanted p tag in home
jQuery(document).ready(function($) {

$('.about-content h2.title-section p').each(function() {
    var $this = $(this);
    if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
        $this.remove();
});
});
</script>

</body>
</html>