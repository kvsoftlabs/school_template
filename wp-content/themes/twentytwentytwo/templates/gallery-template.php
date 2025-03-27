<?php
/*
Template Name: Gallery Template
*/
get_header();

?>


<?php
$gallery = get_field('gallery', 16);
?>

<!-- Page Header End -->
<div class="container-xxl py-5 page-header position-relative mb-5">
    <div class="container py-5">
        <h1 class="display-2 text-white animated slideInDown mb-4">Gallery</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Gallery</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Classes Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($gallery as $image): ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="classes-item">
                        <div class="bg-light rounded-circle w-75 mx-auto p-3">
                            <img class="img-fluid rounded-circle" src="<?= esc_url($image['url']); ?>" alt="">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Classes End -->

<?php get_footer(); ?>
