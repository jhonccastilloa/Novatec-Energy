<?php
declare(strict_types=1);

require_once __DIR__ . '/functions.php';

function seo_absolute_url(string $path = ''): string
{
    return site_url($path);
}

function seo_image_url(string $path = ''): string
{
    $path = $path !== '' ? $path : (string) novatec_config('site')['default_image'];
    if (preg_match('/^https?:\/\//i', $path)) {
        return $path;
    }

    return site_url(ltrim($path, '/'));
}

function seo_page_defaults(array $page): array
{
    $site = novatec_config('site');
    $business = novatec_config('business');
    $path = (string) ($page['path'] ?? current_request_path());

    return array_merge([
        'title' => $site['name'] . ' | ' . $site['tagline'],
        'description' => $business['description'],
        'robots' => 'index,follow',
        'canonical' => site_url($path),
        'image' => $site['default_image'],
        'type' => 'website',
        'breadcrumbs' => [],
        'schema' => [],
    ], $page);
}

function seo_local_market_label(): string
{
    $business = novatec_config('business');
    $locality = trim((string) ($business['address']['locality'] ?? 'Puno'));
    $region = trim((string) ($business['address']['region'] ?? 'Puno'));

    return $locality !== '' ? $locality : ($region !== '' ? $region : 'Puno');
}

function seo_catalog_title(string $title): string
{
    return $title . ' en ' . seo_local_market_label() . ' | Novatec Energy';
}

function seo_catalog_description(string $title, ?array $category = null, ?array $subcategory = null): string
{
    $localMarket = seo_local_market_label();
    $serviceArea = implode(', ', array_slice((array) novatec_config('business')['area_served'], 0, 4));
    $categoryName = $category ? (string) $category['category'] : 'energía solar y renovable';
    $targetName = $subcategory ? (string) $subcategory['subcategory'] : $title;

    return excerpt(
        'Encuentra ' . $targetName . ' en ' . $localMarket . ' con Novatec Energy. Venta, asesoría e instalación para proyectos de ' . $categoryName . ' en ' . $serviceArea . '.',
        155
    );
}

function seo_product_description(array $product): string
{
    $localMarket = seo_local_market_label();
    $source = trim((string) ($product['breve_descripcion'] ?: $product['descripcion']));
    if ($source === '') {
        $source = (string) $product['nombre'];
    }

    return excerpt($source . ' Disponible en ' . $localMarket . ' con asesoría técnica de Novatec Energy.', 155);
}

function render_seo_tags(array $page): void
{
    security_headers();

    $site = novatec_config('site');
    $page = seo_page_defaults($page);
    $canonical = (string) $page['canonical'];
    $imagePath = (string) $page['image'];
    $image = seo_image_url($imagePath);
    $isDefaultImage = $imagePath === (string) $site['default_image'];
    $imageWidth = $page['image_width'] ?? ($isDefaultImage ? ($site['default_image_width'] ?? null) : null);
    $imageHeight = $page['image_height'] ?? ($isDefaultImage ? ($site['default_image_height'] ?? null) : null);
    ?>
	<meta name="robots" content="<?php echo e($page['robots']); ?>">
	<link rel="canonical" href="<?php echo e($canonical); ?>">
	<meta property="og:locale" content="<?php echo e($site['locale']); ?>">
	<meta property="og:type" content="<?php echo e($page['type']); ?>">
	<meta property="og:site_name" content="<?php echo e($site['name']); ?>">
	<meta property="og:url" content="<?php echo e($canonical); ?>">
	<meta property="og:title" content="<?php echo e($page['title']); ?>">
	<meta property="og:description" content="<?php echo e($page['description']); ?>">
	<meta property="og:image" content="<?php echo e($image); ?>">
	<?php if ($imageWidth && $imageHeight) { ?>
	<meta property="og:image:width" content="<?php echo e($imageWidth); ?>">
	<meta property="og:image:height" content="<?php echo e($imageHeight); ?>">
	<?php } ?>
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo e($page['title']); ?>">
	<meta name="twitter:description" content="<?php echo e($page['description']); ?>">
	<meta name="twitter:image" content="<?php echo e($image); ?>">
	<?php render_schema_graph($page); ?>
<?php
}

function local_business_schema(): array
{
    $business = novatec_config('business');
    $site = novatec_config('site');

    return [
        '@type' => 'LocalBusiness',
        '@id' => site_url('#localbusiness'),
        'name' => $business['name'],
        'url' => site_url(),
        'description' => $business['description'],
        'telephone' => $business['phone_e164'],
        'email' => $business['email'],
        'image' => seo_image_url((string) $site['default_image']),
        'logo' => seo_image_url((string) $site['default_image']),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $business['address']['street'],
            'addressLocality' => $business['address']['locality'],
            'addressRegion' => $business['address']['region'],
            'postalCode' => $business['address']['postal_code'],
            'addressCountry' => $business['address']['country'],
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => $business['geo']['latitude'],
            'longitude' => $business['geo']['longitude'],
        ],
        'openingHours' => $business['opening_hours'],
        'areaServed' => array_map(static function ($city): array {
            return ['@type' => 'City', 'name' => $city];
        }, $business['area_served']),
        'sameAs' => $business['same_as'],
    ];
}

function website_schema(): array
{
    $site = novatec_config('site');

    return [
        '@type' => 'WebSite',
        '@id' => site_url('#website'),
        'url' => site_url(),
        'name' => $site['name'],
        'inLanguage' => $site['language'],
        'publisher' => ['@id' => site_url('#localbusiness')],
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => site_url('buscar?producto={search_term_string}'),
            ],
            'query-input' => 'required name=search_term_string',
        ],
    ];
}

function breadcrumb_schema(array $breadcrumbs): array
{
    $items = [];

    foreach ($breadcrumbs as $index => $breadcrumb) {
        $url = (string) ($breadcrumb['url'] ?? '');
        $items[] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => (string) $breadcrumb['name'],
            'item' => preg_match('/^https?:\/\//i', $url) ? $url : site_url(ltrim($url, '/')),
        ];
    }

    return [
        '@type' => 'BreadcrumbList',
        'itemListElement' => $items,
    ];
}

function product_schema(array $product): array
{
    $productPath = product_path($product);
    $name = (string) ($product['nombre'] ?? '');
    $brand = null;

    if (stripos($name, 'MUST') !== false) {
        $brand = 'MUST';
    } elseif (stripos($name, 'Leoch') !== false) {
        $brand = 'Leoch';
    }

    $schema = [
        '@type' => 'Product',
        '@id' => site_url($productPath . '#product'),
        'name' => $product['nombre'],
        'description' => excerpt($product['breve_descripcion'] ?: $product['descripcion'], 250),
        'category' => trim(($product['category'] ?? '') . ' / ' . ($product['subcategory'] ?? ''), ' /'),
    ];

    if ($brand !== null) {
        $schema['brand'] = [
            '@type' => 'Brand',
            'name' => $brand,
        ];
    }

    if (product_has_price($product)) {
        $schema['offers'] = [
            '@type' => 'Offer',
            'url' => site_url($productPath),
            'priceCurrency' => 'PEN',
            'price' => number_format(product_effective_price($product), 2, '.', ''),
            'seller' => ['@id' => site_url('#localbusiness')],
            'areaServed' => array_map(static function ($city): array {
                return ['@type' => 'City', 'name' => $city];
            }, (array) novatec_config('business')['area_served']),
            'availableAtOrFrom' => ['@id' => site_url('#localbusiness')],
        ];
    }

    if (product_has_image($product)) {
        $schema['image'] = product_image_url($product);
    }

    return $schema;
}

function product_item_list_schema(array $products, string $name): array
{
    $items = [];

    foreach (array_values($products) as $index => $product) {
        $item = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'url' => site_url(product_path($product)),
            'name' => (string) ($product['nombre'] ?? ''),
        ];

        if (product_has_image($product)) {
            $item['image'] = product_image_url($product);
        }

        $items[] = $item;
    }

    return [
        '@type' => 'ItemList',
        '@id' => site_url(current_request_path() . '#productos'),
        'name' => $name,
        'itemListElement' => $items,
    ];
}

function render_schema_graph(array $page): void
{
    $graph = [local_business_schema(), website_schema()];

    if (!empty($page['breadcrumbs'])) {
        $graph[] = breadcrumb_schema((array) $page['breadcrumbs']);
    }

    foreach ((array) ($page['schema'] ?? []) as $schema) {
        if (is_array($schema) && $schema !== []) {
            $graph[] = $schema;
        }
    }

    echo '<script type="application/ld+json">';
    echo json_encode([
        '@context' => 'https://schema.org',
        '@graph' => $graph,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    echo '</script>';
}
