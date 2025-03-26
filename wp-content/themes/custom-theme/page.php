<?php

get_header(); ?>

  <!--Banner end-->
  <div class="common-outer about-section menu-inner">
    <div class="home-our-story-container">	
        <div class="container">
            <div class="row">
	           <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col-12 wow slideInLeft">
                  <div class="about-page">
                       <div class="our-story">
                            <?php if ( has_post_thumbnail() ){?>
                             <img class="alignleft feature-image" src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php echo the_title();?>">
                           <?php echo the_content();?>
                           <?php } else {?>
                           <?php echo the_content();?>
                           <?php } ?>
                       </div>      
                   </div>
               </div>
	        	 <?php endwhile; else: ?>          
               <?php endif; ?>
           </div>
        </div>
    </div>
</div>

    

<?php get_footer();
?>
