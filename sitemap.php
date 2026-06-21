<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/xml; charset=UTF-8');

function xml_e(string $value): string
{
    return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
}

function sitemap_lastmod($value): ?string
{
    if (!is_string($value) || trim($value) === '') {
        return null;
    }

    $date = DateTimeImmutable::createFromFormat('!Y-m-d H:i:s', $value);
    $errors = DateTimeImmutable::getLastErrors();
    $hasErrors = is_array($errors) && ($errors['warning_count'] > 0 || $errors['error_count'] > 0);

    if (!$date || $hasErrors || $date->format('Y-m-d H:i:s') !== $value) {
        return null;
    }

    return $date->format('Y-m-d');
}

function sitemap_latest_updated_at(array $records): ?string
{
    $latest = null;

    foreach ($records as $record) {
        $date = sitemap_lastmod($record['updated_at'] ?? null);
        if ($date !== null && ($latest === null || $date > $latest)) {
            $latest = $date;
        }
    }

    return $latest;
}

$categories = get_categories();
$subcategories = get_subcategories();
$products = get_products();
$catalogLastmod = sitemap_latest_updated_at($categories);
$urls = [
    ['loc' => site_url(), 'changefreq' => 'weekly', 'priority' => '1.0', 'lastmod' => $catalogLastmod],
    ['loc' => site_url('productos'), 'changefreq' => 'weekly', 'priority' => '0.9', 'lastmod' => $catalogLastmod],
    ['loc' => site_url('nosotros'), 'changefreq' => 'monthly', 'priority' => '0.6'],
    ['loc' => site_url('contacto'), 'changefreq' => 'monthly', 'priority' => '0.7'],
];

foreach ($categories as $category) {
    $urls[] = [
        'loc' => site_url(category_path($category)),
        'changefreq' => 'weekly',
        'priority' => '0.7',
        'lastmod' => sitemap_lastmod($category['updated_at'] ?? null),
    ];
}

foreach ($subcategories as $subcategory) {
    $category = [
        'category' => $subcategory['category'],
        'slug' => $subcategory['category_slug'],
    ];
    $urls[] = [
        'loc' => site_url(subcategory_path($category, $subcategory)),
        'changefreq' => 'weekly',
        'priority' => '0.7',
        'lastmod' => sitemap_lastmod($subcategory['updated_at'] ?? null),
    ];
}

foreach ($products as $product) {
    $urls[] = [
        'loc' => site_url(product_path($product)),
        'changefreq' => 'weekly',
        'priority' => '0.7',
        'lastmod' => sitemap_lastmod($product['updated_at'] ?? null),
    ];
}

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $url) { ?>
    <url>
        <loc><?php echo xml_e($url['loc']); ?></loc>
        <?php if (!empty($url['lastmod'])) { ?>
        <lastmod><?php echo xml_e($url['lastmod']); ?></lastmod>
        <?php } ?>
        <changefreq><?php echo xml_e($url['changefreq']); ?></changefreq>
        <priority><?php echo xml_e($url['priority']); ?></priority>
    </url>
<?php } ?>
</urlset>
