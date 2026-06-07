<?php
require_once __DIR__ . '/includes/components.php';

$pageTitle = 'Contacto | Novatec Energy';
$pageDescription = 'Puede contactarnos llamando al número 951 828 275 si tiene alguna duda sobre nuestros productos.';
$pageSeo = [
    'title' => $pageTitle,
    'description' => $pageDescription,
    'canonical' => site_url('contacto'),
    'path' => 'contacto',
    'breadcrumbs' => [
        ['name' => 'Inicio', 'url' => ''],
        ['name' => 'Contacto', 'url' => 'contacto'],
    ],
];
$csrfToken = csrf_token();
$business = novatec_config('business');

render_public_head($pageSeo);
render_site_header();
render_breadcrumb('Contáctenos', 'Atención 24/7');
?>

<br>
<div class="contact-from-section mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="form-title">
                    <h2>¿Tiene alguna duda?</h2>
                    <p>No dude en contactarnos, le responderemos lo más rápido posible.</p>
                </div>
                <div id="form_status"></div>
                <div class="contact-form">
                    <form id="fruitkha-contact" action="<?php echo e(url_path('sendEmail.php')); ?>" method="POST">
                        <input type="hidden" name="csrf_token" value="<?php echo e($csrfToken); ?>">
                        <input type="text" name="website" value="" tabindex="-1" autocomplete="off" style="display:none" aria-hidden="true">
                        <p>
                            <input type="text" placeholder="Nombre" name="name" id="Nombre" required>
                            <input type="email" placeholder="Correo Electrónico" name="email" id="Correo Electrónico" required>
                        </p>
                        <p>
                            <input type="tel" placeholder="Celular" name="phone" id="Celular">
                            <input type="text" placeholder="Asunto" name="subject" id="Asunto" required>
                        </p>
                        <p><textarea name="message" id="message" cols="30" rows="10" placeholder="Mensaje" required></textarea></p>
                        <p><input type="submit" class="text-white" value="Enviar"></p>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-form-wrap">
                    <?php render_contact_boxes(public_content('contact_boxes')); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="find-location blue-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p> <i class="fas fa-map-marker-alt"></i> Nuestro local</p>
            </div>
        </div>
    </div>
</div>

<div class="embed-responsive embed-responsive-21by9">
    <iframe src="<?php echo e($business['map_embed_url']); ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<?php render_site_footer(); ?>
