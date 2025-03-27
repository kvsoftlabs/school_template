<?php
/*
Template Name: Home Template
*/
get_header();

?>

<!-- Carousel Start -->
<?php
    $args = array(
        'post_type'      => 'slider',
        'posts_per_page' => -1, // Show all slides
        'orderby'        => 'date',
        'order'          => 'DESC'
    );
    $slider_query = new WP_Query( $args );
?>
<?php if ( $slider_query->have_posts() ) : ?>
<div class="container-fluid p-0 mb-5">
    <?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); ?>
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown mb-4"><?php the_title(); ?></h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2"><?php echo wp_strip_all_tags(get_the_content()); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<!-- Carousel End -->

<!-- Facilities Start -->
<div class="container-xxl py-5">
    <div class="container">
        <?php
            $facility_title = get_field('title') ?: 'School Facilities';
            $facility_content = get_field('content') ?: "Explore our school facilities designed for students' growth and well-being.";         
        ?>
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3"><?php echo esc_attr($facility_title); ?></h1>
            <p><?php echo esc_attr($facility_content); ?></p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php
            $args = array(
                'post_type'      => 'facility',
                'posts_per_page' => -1,
                'order'          => 'ASC',
            );
            $facilities = new WP_Query($args);
            $post_count = $facilities->post_count; // Count number of posts
            $allowed_bg_colors = ['primary', 'success', 'warning', 'info']; // Define allowed colors
            $icons = ['fa-bus-alt', 'fa-futbol', 'fa-home', 'fa-chalkboard-teacher'];
            $index = 0; // Initialize index
            $delay = 0.1;
            
            if ($facilities->have_posts()) :
                while ($facilities->have_posts()) : $facilities->the_post();
                    $icon = $icons[$index % count($icons)];
                    $bg_color = $allowed_bg_colors[$index % count($allowed_bg_colors)]; 
                    // Dynamically set column width
                    if ($post_count == 1) {
                        $col_class = "col-lg-6 mx-auto"; // 1 post centered
                    } elseif ($post_count == 2) {
                        $col_class = "col-lg-6"; // 2 posts centered
                    } else {
                        $col_class = "col-lg-3 col-sm-6"; // Default for 3+ posts
                    }
                    ?>
                    <div class="<?php echo esc_attr($col_class); ?> wow fadeInUp" data-wow-delay="<?php echo esc_attr($delay); ?>s">
                        <div class="facility-item">
                            <div class="facility-icon bg-<?php echo esc_attr($bg_color); ?>">
                                <span class="bg-<?php echo esc_attr($bg_color); ?>"></span>
                                <i class="fa <?php echo esc_attr($icon ? : 'fa-school'); ?> fa-3x text-<?php echo esc_attr($bg_color); ?>"></i>
                                <span class="bg-<?php echo esc_attr($bg_color); ?>"></span>
                            </div>
                            <div class="facility-text bg-<?php echo esc_attr($bg_color); ?>">
                                <h3 class="text-<?php echo esc_attr($bg_color); ?> mb-3"><?php the_title(); ?></h3>
                                <p class="mb-0"><?php echo wp_strip_all_tags(get_the_content()); ?></p>
                            </div>
                        </div>
                    </div>
                <?php 
                $index++;
                $delay += 0.2;
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</div>
<!-- Facilities End -->

<!-- About Start -->

<?php
$about_page = get_page_by_path('about-us');

if ($about_page) :
    $about_title = get_the_title($about_page->ID);
    $about_content = apply_filters('the_content', $about_page->post_content);
    $about_image = get_the_post_thumbnail_url($about_page->ID, 'full');
endif;

$gallery = get_field('gallery', 13);
?>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-4"><?php echo esc_html($about_title); ?></h1>
                <p><?php echo wp_kses_post(mb_substr($about_content, 0, 450) . '...'); ?></p>
                <div class="row g-4 align-items-center">
                    <div class="col-sm-6">
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="<?php echo get_permalink($about_page->ID); ?>">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                <div class="row">
                    <div class="col-12 text-center">
                        <img class="img-fluid w-75 rounded-circle bg-light p-3" src="<?= esc_url($gallery[0]['url']); ?>" alt="">
                    </div>
                    <div class="col-6 text-start" style="margin-top: -150px;">
                        <img class="img-fluid w-100 rounded-circle bg-light p-3" src="<?= esc_url($gallery[1]['url']); ?>" alt="">
                    </div>
                    <div class="col-6 text-end" style="margin-top: -150px;">
                        <img class="img-fluid w-100 rounded-circle bg-light p-3" src="<?= esc_url($gallery[2]['url']); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<?php get_footer(); ?>
