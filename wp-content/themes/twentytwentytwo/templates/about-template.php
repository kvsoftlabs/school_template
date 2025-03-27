<?php
/*
Template Name: About Template
*/
get_header();

?>

<!-- Carousel Start -->
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

<!-- Page Header End -->
<div class="container-xxl py-5 page-header position-relative mb-5">
    <div class="container py-5">
        <h1 class="display-2 text-white animated slideInDown mb-4">About Us</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">About Us</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-4"><?php echo esc_html($about_title); ?></h1>
                <p><?php echo wp_kses_post($about_content); ?></p>
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
