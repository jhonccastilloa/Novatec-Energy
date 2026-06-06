<?php
declare(strict_types=1);

return [
    'nav' => [
        ['label' => 'Inicio', 'url' => 'index', 'path' => 'index'],
        ['label' => 'Productos', 'url' => 'productos', 'path' => 'productos'],
        ['label' => 'Nosotros', 'url' => 'nosotros', 'path' => 'nosotros'],
        ['label' => 'Contactenos', 'url' => 'contacto', 'path' => 'contacto'],
    ],
    'hero_slides' => [
        [
            'class' => 'homepage-bg-1',
            'column' => 'col-md-12 col-lg-7 offset-lg-1 offset-xl-0',
            'align' => '',
            'subtitle' => 'Empresa Líder en Energía Renovable',
            'title' => 'Novatec Energy',
        ],
        [
            'class' => 'homepage-bg-2',
            'column' => 'col-lg-10 offset-lg-1',
            'align' => 'text-center',
            'subtitle' => 'Cuidando y Construyendo un mundo mejor con energías renovables',
            'title' => 'Novatec Energy',
        ],
        [
            'class' => 'homepage-bg-3',
            'column' => 'col-lg-10 offset-lg-1',
            'align' => 'text-right',
            'subtitle' => 'Contamos con los mejores productos y equipo especializado!',
            'title' => 'Tienda Especializada en Energias Renovables',
        ],
    ],
    'home_features' => [
        [
            'icon' => 'fas fa-solar-panel',
            'title' => 'Energía Limpia',
            'text' => 'Soluciones renovables para un futuro sostenible.',
            'content_class' => 'text-center pt-3',
        ],
        [
            'icon' => 'fas fa-piggy-bank',
            'title' => 'Ahorro Garantizado',
            'text' => 'Reduce tu factura energética desde el primer mes.',
        ],
        [
            'icon' => 'fas fa-tools',
            'title' => 'Instalación Profesional',
            'text' => 'Proyectos solares ejecutados por técnicos certificados.',
            'box_class' => 'justify-content-start',
        ],
    ],
    'home_about' => [
        'eyebrow' => 'Desde el año del 2018',
        'title_html' => 'Somos <span class="orange-text">Novatec Energy</span>',
        'paragraphs' => [
            'Una empresa comprometida con la intencion de ayudar a la poblacion en general a tener una mejor calidad de vida a través del aprovechamiento de energía solar para las viviendas, brindando el mejor servicio de la mano de especialistas a un precio accesible.',
            'Nos guiamos por la confianza y el compromiso. Apostamos por la confianza mutua como principio esencial de las relaciones con nuestros colaboradores, con los socios estratégicos y con nuestro clientes.',
        ],
        'button_label' => 'Saber mas',
        'button_url' => 'nosotros',
        'video_url' => 'https://scontent.faqp2-3.fna.fbcdn.net/v/t39.25447-2/309642288_409532974687357_4021677118693873468_n.mp4?_nc_cat=105&vs=7c5edd7adfc02abe&_nc_vs=HBksFQAYJEdEREVkQko5NUhyVGQzUUJBRHlYRUIwSTNzODNibWRqQUFBRhUAAsgBABUAGCRHS1N2c1JCeTJSekp3aWdCQUFLak5IeXE5d0pMYnY0R0FBQUYVAgLIAQBLB4gScHJvZ3Jlc3NpdmVfcmVjaXBlATENc3Vic2FtcGxlX2ZwcwAQdm1hZl9lbmFibGVfbnN1YgAgbWVhc3VyZV9vcmlnaW5hbF9yZXNvbHV0aW9uX3NzaW0AKGNvbXB1dGVfc3NpbV9vbmx5X2F0X29yaWdpbmFsX3Jlc29sdXRpb24AHXVzZV9sYW5jem9zX2Zvcl92cW1fdXBzY2FsaW5nABFkaXNhYmxlX3Bvc3RfcHZxcwAVACUAHAAAJq61jqqf8WwVAigCQzMYC3Z0c19wcmV2aWV3HBdATa7ZFocrAhg5ZGFzaF9pNGxpdGViYXNpY181c2VjZ29wXzQ4MF9jcmZfMjhfbWFpbl8zLjBfZnJhZ18yX3ZpZGVvEgAYGHZpZGVvcy52dHMuY2FsbGJhY2sucHJvZDgSVklERU9fVklFV19SRVFVRVNUGwqIFW9lbV90YXJnZXRfZW5jb2RlX3RhZwZvZXBfc2QTb2VtX3JlcXVlc3RfdGltZV9tcwEwDG9lbV9jZmdfcnVsZQpzZF91bm11dGVkE29lbV9yb2lfcmVhY2hfY291bnQCMjIRb2VtX2lzX2V4cGVyaW1lbnQADG9lbV92aWRlb19pZBAxMDY1NTQzMjA3MzYzNjQ3Em9lbV92aWRlb19hc3NldF9pZA8zMjAwOTUwNjM0MjY4OTMVb2VtX3ZpZGVvX3Jlc291cmNlX2lkDzIzOTQ0MDA0MTcyNTI3MRxvZW1fc291cmNlX3ZpZGVvX2VuY29kaW5nX2lkDzYxNjgxMzQwNjgxNTQ1Mg52dHNfcmVxdWVzdF9pZAAlAhwAJcQBGweIAXMENTk4MQJjZAoyMDIyLTA1LTA3A3JjYgEwA2FwcA9WaWRlb3MgZW4gV2F0Y2gCY3QZQ09OVEFJTkVEX1BPU1RfQVRUQUNITUVOVBNvcmlnaW5hbF9kdXJhdGlvbl9zCTU5LjM5NjMzMwJ0cxRwcm9ncmVzc2l2ZV9vcmRlcmluZwA%3D&ccb=1-7&_nc_sid=2001ee&efg=eyJ2ZW5jb2RlX3RhZyI6Im9lcF9zZCJ9&_nc_eui2=AeEgW8vdUBRkNw_y70-bcDHVK_HVvsK9LsQr8dW-wr0uxOi-qkrZCRhCqtT6ki4O4aCVqzTrNGOTVwOyMBtdEBiS&_nc_ohc=cII2oTW5f3IAX9IGVII&_nc_rml=0&_nc_ht=scontent.faqp2-3.fna&oh=00_AT8T-pzWKxVSdpLwcVZ32u3iftIaKvg0RmLT1v22hyk_uw&oe=635751E4&_nc_rid=587485373475917',
    ],
    'why_novatec' => [
        [
            'icon' => 'fas fa-drafting-compass',
            'title' => 'Soluciones a medida',
            'text' => 'Diseñamos proyectos energéticos adaptados a tu hogar o empresa.',
        ],
        [
            'icon' => 'fas fa-piggy-bank',
            'title' => 'Ahorro energético',
            'text' => 'Reduce tu consumo y optimiza tu factura con energía renovable.',
        ],
        [
            'icon' => 'fas fa-tools',
            'title' => 'Instalación profesional',
            'text' => 'Nuestro equipo técnico garantiza una instalación segura y eficiente.',
        ],
        [
            'icon' => 'fas fa-seedling',
            'title' => 'Compromiso sostenible',
            'text' => 'Impulsamos un futuro más limpio con tecnología renovable',
        ],
    ],
    'team' => [
        ['name' => 'Robert Franclinbert', 'role' => 'Tecnico', 'class' => 'team-bg-1'],
        ['name' => 'Jose Mario', 'role' => 'Tecnico', 'class' => 'team-bg-2'],
        ['name' => 'Gerson Enoc', 'role' => 'Tecnico', 'class' => 'team-bg-3'],
    ],
    'footer_pages' => [
        ['label' => 'Inicio', 'url' => 'index'],
        ['label' => 'Productos', 'url' => 'productos'],
        ['label' => 'Nosotros', 'url' => 'nosotros'],
        ['label' => 'Contacto', 'url' => 'contacto'],
    ],
    'contact_boxes' => [
        [
            'icon' => 'fas fa-map',
            'title' => 'Dirección de la tienda',
            'html' => 'Av. El Sol <br> N° 986. <br> Puno-Perú',
        ],
        [
            'icon' => 'far fa-clock',
            'title' => 'Hora de Atención',
            'html' => 'Lunes - viernes: 8 AM hasta las 9 PM',
        ],
        [
            'icon' => 'fas fa-address-book',
            'title' => 'Contacto',
            'html' => 'Cel: 951 828 275 <br>tel : 51 603 939 <br> Email: cefecu@outlook.com',
        ],
    ],
];
