<?php
require_once __DIR__ . '/includes/components.php';

if (in_array(current_request_path(), ['index', 'index.php'], true)) {
    header('Location: ' . site_url(), true, 301);
    exit;
}

$pageTitle = 'Novatec Energy | Tienda especializada en energías renovables';
$pageDescription = 'Soluciones en energía solar, termas solares, iluminación y bombeo solar para hogares, empresas e instituciones en Puno.';
$pageSeo = [
    'title' => $pageTitle,
    'description' => $pageDescription,
    'canonical' => site_url(),
    'path' => '',
];

render_public_head($pageSeo);
render_site_header();
?>

<h1 class="sr-only">Novatec Energy | Tienda especializada en energías renovables</h1>
<div class="homepage-slider">
    <?php foreach (public_content('hero_slides') as $slide) { ?>
        <div class="single-homepage-slider <?php echo e($slide['class']); ?>">
            <div class="container">
                <div class="row">
                    <div class="<?php echo e(trim($slide['column'] . ' ' . $slide['align'])); ?>">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle"><?php echo e($slide['subtitle']); ?></p>
                                <h2><?php echo e($slide['title']); ?></h2>
                                <div class="hero-btns">
                                    <a href="<?php echo e(url_path('productos')); ?>" class="boxed-btn">Productos</a>
                                    <a href="<?php echo e(url_path('contacto')); ?>" class="bordered-btn">Contáctenos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="list-section pt-80 pb-80">
    <div class="container">
        <div class="row">
            <?php render_feature_boxes(public_content('home_features')); ?>
        </div>
    </div>
</div>

<div class="latest-news pt-150 pb-150">
    <div class="container">
        <?php render_section_title(
            '<span class="orange-text">Nuestros</span> Productos',
            'En <strong>Novatec Energy</strong> contamos con productos de alta calidad para proyectos de energía solar y renovable.'
        ); ?>
        <div class="row product-category-cards">
            <?php foreach (get_featured_categories() as $category) {
                render_category_card($category);
            } ?>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="<?php echo e(url_path('productos')); ?>" class="boxed-btn">Ver todos los productos</a>
            </div>
        </div>
    </div>
</div>

<?php $homeAbout = public_content('home_about'); ?>
<div class="abt-section mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="abt-bg">
                    <a href="<?php echo e($homeAbout['video_url']); ?>" class="video-play-btn popup-youtube"><i class="fas fa-play"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="abt-text">
                    <p class="top-sub"><?php echo e($homeAbout['eyebrow']); ?></p>
                    <h2><?php echo $homeAbout['title_html']; ?></h2>
                    <?php foreach ($homeAbout['paragraphs'] as $paragraph) { ?>
                        <p><?php echo e($paragraph); ?></p>
                    <?php } ?>
                    <a href="<?php echo e(url_path($homeAbout['button_url'])); ?>" class="boxed-btn mt-4"><?php echo e($homeAbout['button_label']); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php render_site_footer(); ?>
