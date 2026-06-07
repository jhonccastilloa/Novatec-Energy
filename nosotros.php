<?php
require_once __DIR__ . '/includes/components.php';

$pageTitle = 'Nosotros | Novatec Energy';
$pageDescription = 'Somos una empresa comprometida con la intención de ayudar a la población en general a tener una mejor calidad de vida a través del aprovechamiento de energía solar para las viviendas, brindando el mejor servicio de la mano de especialistas a un precio accesible.';
$pageSeo = [
    'title' => $pageTitle,
    'description' => $pageDescription,
    'canonical' => site_url('nosotros'),
    'path' => 'nosotros',
    'breadcrumbs' => [
        ['name' => 'Inicio', 'url' => 'index'],
        ['name' => 'Nosotros', 'url' => 'nosotros'],
    ],
];

render_public_head($pageSeo);
render_site_header();
render_breadcrumb('Sobre nosotros', 'Contamos con un equipo profesional');
?>

<div class="feature-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="featured-text">
                    <h2 class="pb-3">¿Por qué <span class="orange-text">Novatec?</span></h2>
                    <div class="row">
                        <?php foreach (public_content('why_novatec') as $item) { ?>
                            <div class="col-lg-6 col-md-6 mb-4 mb-md-5">
                                <div class="list-box d-flex">
                                    <div class="list-icon">
                                        <i class="<?php echo e($item['icon']); ?>"></i>
                                    </div>
                                    <div class="content">
                                        <h3><?php echo e($item['title']); ?></h3>
                                        <p><?php echo e($item['text']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-150">
    <div class="container">
        <?php render_section_title(
            'Nuestro <span class="orange-text">Equipo</span>',
            'Contamos con un equipo técnico especializado en diseño, instalación y mantenimiento de sistemas solares. Te acompañamos en cada etapa del proyecto para garantizar soluciones seguras, eficientes y adaptadas a tus necesidades.'
        ); ?>
        <div class="row">
            <?php render_team_cards(public_content('team')); ?>
        </div>
    </div>
</div>

<?php render_site_footer(); ?>
