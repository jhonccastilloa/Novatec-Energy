<?php
declare(strict_types=1);

return [
    'environment' => getenv('NOVATEC_ENV') ?: 'development',
    'database' => [
        'host' => getenv('NOVATEC_DB_HOST') ?: 'localhost',
        'user' => getenv('NOVATEC_DB_USER') ?: 'root',
        'password' => getenv('NOVATEC_DB_PASS') ?: '',
        'name' => getenv('NOVATEC_DB_NAME') ?: 'novatec',
        'charset' => 'utf8mb4',
    ],
    'site' => [
        'name' => 'Novatec Energy',
        'tagline' => 'Energia solar y renovable en Puno',
        'language' => 'es',
        'locale' => 'es_PE',
        'base_url' => getenv('NOVATEC_BASE_URL') ?: '',
        'fallback_base_url' => 'http://localhost/Novatec-Energy',
        'default_image' => 'assets/img/logo.png',
        'favicon' => 'assets/img/favicon.png',
    ],
    'business' => [
        'name' => 'Novatec Energy',
        'description' => 'Empresa de Puno especializada en energia solar, termas solares, iluminacion solar, bombeo solar y proyectos renovables para hogares, empresas e instituciones.',
        'phone_e164' => '+51951828275',
        'phone_display' => '951 828 275',
        'secondary_phone_display' => '51 603 939',
        'whatsapp_phone' => '51951828275',
        'email' => 'cefecu@outlook.com',
        'address' => [
            'street' => 'Av. El Sol 986',
            'locality' => 'Puno',
            'region' => 'Puno',
            'postal_code' => '',
            'country' => 'PE',
            'display' => 'Av. El Sol 986, Puno, Puno, Perú',
        ],
        'geo' => [
            'latitude' => -15.841545209320099,
            'longitude' => -70.02166422490467,
        ],
        'opening_hours' => [
            'Mo-Fr 08:00-21:00',
        ],
        'area_served' => ['Puno', 'Juliaca', 'Ilave', 'Juli', 'Azangaro'],
        'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d806.9002886355905!2d-70.02166422490467!3d-15.841545209320099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915d698d04094815%3A0xafae726baa423822!2sTermas%20Solares%20Novatec%20Energy!5e0!3m2!1ses-419!2spe!4v1666201668891!5m2!1ses-419!2spe',
        'same_as' => [],
    ],
    'mail' => [
        'recipient' => getenv('NOVATEC_CONTACT_TO') ?: 'gpro1pro@gmail.com',
    ],
];
