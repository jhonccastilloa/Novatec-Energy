<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/xml; charset=UTF-8');

function xml_e(string $value): string
{
    return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
}

$today = date('Y-m-d');
$urls = [
    ['loc' => site_url(), 'changefreq' => 'weekly', 'priority' => '1.0'],
    ['loc' => site_url('productos'), 'changefreq' => 'weekly', 'priority' => '0.9'],
    ['loc' => site_url('nosotros'), 'changefreq' => 'monthly', 'priority' => '0.6'],
    ['loc' => site_url('contacto'), 'changefreq' => 'monthly', 'priority' => '0.7'],
];

foreach (get_categories() as $category) {
    $urls[] = [
        'loc' => site_url(category_path($category)),
        'changefreq' => 'weekly',
        'priority' => '0.7',
    ];
}

foreach (get_subcategories() as $subcategory) {
    $urls[] = [
        'loc' => site_url(subcategory_path($subcategory, $subcategory)),
        'changefreq' => 'weekly',
        'priority' => '0.7',
    ];
}

foreach (get_products() as $product) {
    $urls[] = [
        'loc' => site_url(product_path($product)),
        'changefreq' => 'weekly',
        'priority' => '0.7',
    ];
}

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $url) { ?>
    <url>
        <loc><?php echo xml_e($url['loc']); ?></loc>
        <lastmod><?php echo xml_e($today); ?></lastmod>
        <changefreq><?php echo xml_e($url['changefreq']); ?></changefreq>
        <priority><?php echo xml_e($url['priority']); ?></priority>
    </url>
<?php } ?>
</urlset>
