<?php get_header(); ?>

<div class="common-outer blog blog-single-outer">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="blog-inner blog-single-inner">
                        <?php
                           if (have_posts()) : while (have_posts()) : the_post(); 
                        ?>
                            <div class="blog-card">
                                <div class="blog-img">
                                    <?php if( !empty(get_the_post_thumbnail()) ) {?>
                                        <img class="img-fluid" src="<?php the_post_thumbnail_url(); ?>" alt="" title=""> 
                                        <?php } else {
                                    ?>
                                       <img class="img-fluid" src="<?php echo get_option("default_banner"); ?>"  alt="" title="">
                                    <?php }?>                                                      
                                    <div class="blog-date">
                                       <h5><?php the_time('j') ; ?></h5>
                                       <p><?php the_time('M') ; ?></p>
                                    </div>
                                </div>
                                <div class="blog-content">
                                    <?php $title = get_the_title(); ?>
                                    <h4 class="blog-title"><?php echo $title; ?></h4>
                                        <?php echo the_content(); ?>

                                </div>
                                <div class="dotts"><span></span> <span></span> <span></span></div>

                            </div>
                        <?php endwhile; endif;?>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="sidebar-outer">
                    <div class="widget-content sidebar-outer">
                        <div class="sidebar">     
                        <div id="sidebar">
                        <?php include('sidebar.php');?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>