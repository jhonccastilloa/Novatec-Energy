<?php
declare(strict_types=1);

function novatec_config(?string $section = null)
{
    static $config = null;

    if ($config === null) {
        $config = require __DIR__ . '/../config/config.php';
    }

    return $section === null ? $config : ($config[$section] ?? null);
}

function security_headers(): void
{
    if (headers_sent()) {
        return;
    }

    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: geolocation=(), camera=(), microphone=()');
    header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://www.google.com https://www.gstatic.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net; font-src 'self' https://fonts.gstatic.com data:; img-src 'self' data: https:; frame-src https://www.google.com; connect-src 'self'; base-uri 'self'; form-action 'self'");
}

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function slugify(string $value): string
{
    $value = trim($value);
    $converted = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
    if ($converted !== false) {
        $value = $converted;
    }

    $value = strtolower($value);
    $value = preg_replace('/[^a-z0-9]+/', '-', $value) ?: '';
    return trim($value, '-') ?: 'pagina';
}

function truncate_slug(string $slug, int $maxLength): string
{
    if (strlen($slug) <= $maxLength) {
        return $slug;
    }

    return trim(substr($slug, 0, $maxLength), '-') ?: 'pagina';
}

function slug_candidate(string $baseSlug, int $suffix, int $maxLength): string
{
    if ($suffix <= 1) {
        return truncate_slug($baseSlug, $maxLength);
    }

    $ending = '-' . $suffix;
    return truncate_slug($baseSlug, $maxLength - strlen($ending)) . $ending;
}

function unique_category_slug(string $name, ?int $excludeId = null): string
{
    $baseSlug = slugify($name);

    for ($suffix = 1; $suffix < 1000; $suffix++) {
        $candidate = slug_candidate($baseSlug, $suffix, 120);
        $sql = 'SELECT id FROM category WHERE slug = ?';
        $types = 's';
        $params = [$candidate];

        if ($excludeId !== null) {
            $sql .= ' AND id <> ?';
            $types .= 'i';
            $params[] = $excludeId;
        }

        if (!db_one($sql . ' LIMIT 1', $types, $params)) {
            return $candidate;
        }
    }

    return truncate_slug($baseSlug . '-' . time(), 120);
}

function unique_subcategory_slug(string $name, int $categoryId, ?int $excludeId = null): string
{
    $baseSlug = slugify($name);

    for ($suffix = 1; $suffix < 1000; $suffix++) {
        $candidate = slug_candidate($baseSlug, $suffix, 120);
        $sql = 'SELECT id FROM subcategory WHERE id_category = ? AND slug = ?';
        $types = 'is';
        $params = [$categoryId, $candidate];

        if ($excludeId !== null) {
            $sql .= ' AND id <> ?';
            $types .= 'i';
            $params[] = $excludeId;
        }

        if (!db_one($sql . ' LIMIT 1', $types, $params)) {
            return $candidate;
        }
    }

    return truncate_slug($baseSlug . '-' . time(), 120);
}

function unique_product_slug(string $name, ?int $excludeId = null): string
{
    $baseSlug = slugify($name);

    for ($suffix = 1; $suffix < 1000; $suffix++) {
        $candidate = slug_candidate($baseSlug, $suffix, 180);
        $sql = 'SELECT id FROM productos WHERE slug = ?';
        $types = 's';
        $params = [$candidate];

        if ($excludeId !== null) {
            $sql .= ' AND id <> ?';
            $types .= 'i';
            $params[] = $excludeId;
        }

        if (!db_one($sql . ' LIMIT 1', $types, $params)) {
            return $candidate;
        }
    }

    return truncate_slug($baseSlug . '-' . time(), 180);
}

function category_name_exists(string $name, ?int $excludeId = null): bool
{
    $sql = 'SELECT id FROM category WHERE LOWER(TRIM(category)) = LOWER(TRIM(?))';
    $types = 's';
    $params = [$name];

    if ($excludeId !== null) {
        $sql .= ' AND id <> ?';
        $types .= 'i';
        $params[] = $excludeId;
    }

    return (bool) db_one($sql . ' LIMIT 1', $types, $params);
}

function subcategory_name_exists(int $categoryId, string $name, ?int $excludeId = null): bool
{
    $sql = 'SELECT id FROM subcategory WHERE id_category = ? AND LOWER(TRIM(subcategory)) = LOWER(TRIM(?))';
    $types = 'is';
    $params = [$categoryId, $name];

    if ($excludeId !== null) {
        $sql .= ' AND id <> ?';
        $types .= 'i';
        $params[] = $excludeId;
    }

    return (bool) db_one($sql . ' LIMIT 1', $types, $params);
}

function product_name_exists(string $name, ?int $excludeId = null): bool
{
    $sql = 'SELECT id FROM productos WHERE LOWER(TRIM(nombre)) = LOWER(TRIM(?))';
    $types = 's';
    $params = [$name];

    if ($excludeId !== null) {
        $sql .= ' AND id <> ?';
        $types .= 'i';
        $params[] = $excludeId;
    }

    return (bool) db_one($sql . ' LIMIT 1', $types, $params);
}

function excerpt($value, int $length = 160): string
{
    $text = html_entity_decode(strip_tags((string) $value), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $text = trim(preg_replace('/\s+/', ' ', $text) ?: '');

    if (function_exists('mb_strlen') && function_exists('mb_substr')) {
        return mb_strlen($text, 'UTF-8') > $length ? rtrim(mb_substr($text, 0, $length - 3, 'UTF-8')) . '...' : $text;
    }

    return strlen($text) > $length ? rtrim(substr($text, 0, $length - 3)) . '...' : $text;
}

function sanitize_rich_html($html): string
{
    $html = (string) $html;
    if (trim($html) === '') {
        return '';
    }

    $allowedTags = [
        'a', 'b', 'blockquote', 'br', 'em', 'h2', 'h3', 'h4', 'i', 'img',
        'li', 'ol', 'p', 'span', 'strong', 'table', 'tbody', 'td', 'th',
        'thead', 'tr', 'ul',
    ];
    $allowedAttributes = [
        'a' => ['href', 'title', 'target', 'rel'],
        'img' => ['src', 'alt', 'width', 'height', 'loading'],
        'td' => ['colspan', 'rowspan'],
        'th' => ['colspan', 'rowspan'],
    ];

    if (!class_exists('DOMDocument')) {
        return strip_tags($html, '<' . implode('><', $allowedTags) . '>');
    }

    libxml_use_internal_errors(true);
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->loadHTML('<!DOCTYPE html><html><body><div id="content">' . $html . '</div></body></html>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_clear_errors();

    $nodes = [];
    foreach ($dom->getElementsByTagName('*') as $node) {
        $nodes[] = $node;
    }

    foreach (array_reverse($nodes) as $node) {
        $tag = strtolower($node->nodeName);
        if ($tag === 'html' || $tag === 'body' || ($tag === 'div' && $node->getAttribute('id') === 'content')) {
            continue;
        }

        if (in_array($tag, ['script', 'style', 'iframe', 'object', 'embed'], true)) {
            $node->parentNode->removeChild($node);
            continue;
        }

        if (!in_array($tag, $allowedTags, true)) {
            while ($node->firstChild) {
                $node->parentNode->insertBefore($node->firstChild, $node);
            }
            $node->parentNode->removeChild($node);
            continue;
        }

        $allowedForTag = $allowedAttributes[$tag] ?? [];
        foreach (iterator_to_array($node->attributes) as $attribute) {
            $name = strtolower($attribute->nodeName);
            $value = trim($attribute->nodeValue);
            $isUnsafeUrl = in_array($name, ['href', 'src'], true) && preg_match('/^\s*javascript:/i', $value);

            if (!in_array($name, $allowedForTag, true) || $isUnsafeUrl) {
                $node->removeAttribute($attribute->nodeName);
            }
        }

        if ($tag === 'a' && $node->hasAttribute('target')) {
            $node->setAttribute('rel', 'noopener');
        }

        if ($tag === 'img' && !$node->hasAttribute('loading')) {
            $node->setAttribute('loading', 'lazy');
        }
    }

    $content = $dom->getElementById('content');
    $safe = '';
    foreach ($content->childNodes as $child) {
        $safe .= $dom->saveHTML($child);
    }

    return $safe;
}

function base_path(): string
{
    $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    $dir = trim(str_replace('\\', '/', dirname($scriptName)), '/');

    if ($dir === '' || $dir === '.') {
        return '';
    }

    return '/' . $dir;
}

function url_path(string $path = ''): string
{
    $path = ltrim($path, '/');
    $base = base_path();

    if ($path === '' || $path === 'index' || $path === 'index.php') {
        return $base === '' ? '/' : $base . '/';
    }

    return ($base === '' ? '' : $base) . '/' . $path;
}

function asset_url(string $path): string
{
    return url_path($path);
}

function site_root_url(): string
{
    $site = novatec_config('site');
    $configured = trim((string) ($site['base_url'] ?? ''));
    if ($configured !== '') {
        return rtrim($configured, '/');
    }

    $host = $_SERVER['HTTP_HOST'] ?? '';
    if ($host === '') {
        return rtrim((string) ($site['fallback_base_url'] ?? 'http://localhost'), '/');
    }

    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (($_SERVER['SERVER_PORT'] ?? '') === '443');
    return ($https ? 'https://' : 'http://') . $host . base_path();
}

function site_url(string $path = ''): string
{
    $path = ltrim($path, '/');
    if ($path === 'index' || $path === 'index.php') {
        $path = '';
    }

    return rtrim(site_root_url(), '/') . ($path === '' ? '/' : '/' . $path);
}

function current_request_path(): string
{
    $requestUri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?') ?: '/';
    $base = base_path();

    if ($base !== '' && strpos($requestUri, $base) === 0) {
        $requestUri = substr($requestUri, strlen($base)) ?: '/';
    }

    return trim($requestUri, '/');
}

function is_active_path(string $needle): bool
{
    $current = current_request_path();
    $needle = trim($needle, '/');

    if ($needle === 'index') {
        return $current === '' || $current === 'index' || $current === 'index.php';
    }

    return strpos($current, $needle) === 0;
}

function whatsapp_url(string $message = ''): string
{
    $business = novatec_config('business');
    $phone = preg_replace('/\D+/', '', (string) ($business['whatsapp_phone'] ?? $business['phone_e164'] ?? ''));
    $query = ['phone' => $phone];

    if ($message !== '') {
        $query['text'] = $message;
    }

    return 'https://api.whatsapp.com/send?' . http_build_query($query);
}

function ensure_session(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function csrf_token(): string
{
    ensure_session();

    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return (string) $_SESSION['csrf_token'];
}

function verify_csrf(?string $token): bool
{
    ensure_session();
    return is_string($token) && isset($_SESSION['csrf_token']) && hash_equals((string) $_SESSION['csrf_token'], $token);
}

function db_connection(): mysqli
{
    static $conn = null;

    if ($conn instanceof mysqli) {
        return $conn;
    }

    $db = novatec_config('database');
    $conn = new mysqli(
        (string) $db['host'],
        (string) $db['user'],
        (string) $db['password'],
        (string) $db['name']
    );

    if ($conn->connect_error) {
        http_response_code(500);
        $environment = (string) (novatec_config('environment') ?? 'production');
        exit($environment === 'development' ? 'Error de conexion: ' . e($conn->connect_error) : 'Error interno del servidor.');
    }

    $conn->set_charset((string) ($db['charset'] ?? 'utf8mb4'));
    return $conn;
}

function db_all(string $sql, string $types = '', array $params = []): array
{
    $conn = db_connection();

    if ($types === '') {
        $result = $conn->query($sql);
        if (!$result) {
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return [];
    }

    $bindParams = $params;
    $stmt->bind_param($types, ...$bindParams);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function db_one(string $sql, string $types = '', array $params = []): ?array
{
    $rows = db_all($sql, $types, $params);
    return $rows[0] ?? null;
}

function db_execute(string $sql, string $types = '', array $params = []): bool
{
    $conn = db_connection();
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }

    if ($types !== '') {
        $bindParams = $params;
        $stmt->bind_param($types, ...$bindParams);
    }

    return $stmt->execute();
}

function get_categories(): array
{
    return db_all('SELECT id, category, slug FROM category ORDER BY id ASC');
}

function get_category(int $id): ?array
{
    return db_one('SELECT id, category, slug FROM category WHERE id = ? LIMIT 1', 'i', [$id]);
}

function get_category_by_slug(string $slug): ?array
{
    return db_one('SELECT id, category, slug FROM category WHERE slug = ? LIMIT 1', 's', [$slug]);
}

function get_subcategories_by_category(int $categoryId): array
{
    return db_all('SELECT id, id_category, subcategory, slug FROM subcategory WHERE id_category = ? ORDER BY id ASC', 'i', [$categoryId]);
}

function get_subcategory_by_slug(int $categoryId, string $slug): ?array
{
    return db_one('SELECT id, id_category, subcategory, slug FROM subcategory WHERE id_category = ? AND slug = ? LIMIT 1', 'is', [$categoryId, $slug]);
}

function get_subcategories(): array
{
    return db_all(
        'SELECT subcategory.id, subcategory.id_category, subcategory.subcategory, subcategory.slug, category.category, category.slug AS category_slug
         FROM subcategory
         INNER JOIN category ON subcategory.id_category = category.id
         ORDER BY category.id ASC, subcategory.id ASC'
    );
}

function get_products(?int $categoryId = null, ?string $search = null, ?int $subcategoryId = null): array
{
    $where = [];
    $types = '';
    $params = [];

    if ($categoryId !== null && $categoryId > 0) {
        $where[] = 'id_categoria = ?';
        $types .= 'i';
        $params[] = $categoryId;
    }

    if ($subcategoryId !== null && $subcategoryId > 0) {
        $where[] = 'id_subcategory = ?';
        $types .= 'i';
        $params[] = $subcategoryId;
    }

    if ($search !== null && trim($search) !== '') {
        $where[] = 'nombre LIKE ?';
        $types .= 's';
        $params[] = '%' . trim($search) . '%';
    }

    $sql = 'SELECT * FROM productos';
    if ($where !== []) {
        $sql .= ' WHERE ' . implode(' AND ', $where);
    }

    return db_all($sql, $types, $params);
}

function get_product(int $id): ?array
{
    return db_one(
        'SELECT productos.id, productos.nombre, productos.slug, productos.descripcion, productos.precio_normal, productos.precio_rebajado, productos.cantidad, productos.breve_descripcion, productos.imagen, productos.id_categoria, productos.id_subcategory, category.category, category.slug AS category_slug, subcategory.subcategory, subcategory.slug AS subcategory_slug
         FROM productos
         LEFT JOIN category ON productos.id_categoria = category.id
         LEFT JOIN subcategory ON productos.id_subcategory = subcategory.id
         WHERE productos.id = ?
         LIMIT 1',
        'i',
        [$id]
    );
}

function get_featured_categories(): array
{
    $rows = db_all(
        'SELECT category.id, category.category, category.slug, productos.id AS idProduct, productos.imagen
         FROM category
         INNER JOIN productos ON productos.id_categoria = category.id
         ORDER BY category.id ASC, productos.id ASC'
    );

    $categories = [];
    foreach ($rows as $row) {
        $categoryId = (int) $row['id'];
        if (!isset($categories[$categoryId])) {
            $categories[$categoryId] = $row;
        }

        $currentProduct = ['id' => $categories[$categoryId]['idProduct'] ?? 0, 'imagen' => $categories[$categoryId]['imagen'] ?? ''];
        $candidateProduct = ['id' => $row['idProduct'] ?? 0, 'imagen' => $row['imagen'] ?? ''];

        if (!product_has_image($currentProduct) && product_has_image($candidateProduct)) {
            $categories[$categoryId] = $row;
        }
    }

    return array_values(array_filter($categories, function (array $category): bool {
        return product_has_image(['id' => $category['idProduct'] ?? 0, 'imagen' => $category['imagen'] ?? '']);
    }));
}

function image_extension(string $filename): string
{
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true) ? $ext : 'jpg';
}

function product_has_image(array $product): bool
{
    $image = trim((string) ($product['imagen'] ?? ''));
    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

    if ($image === '' || !in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
        return false;
    }

    $id = (int) ($product['id'] ?? 0);
    if ($id <= 0) {
        return true;
    }

    return is_file(__DIR__ . '/../productsImg/' . $id . '.' . $ext);
}

function product_image_relative(array $product): string
{
    if (!product_has_image($product)) {
        return (string) novatec_config('site')['default_image'];
    }

    return 'productsImg/' . (int) $product['id'] . '.' . image_extension((string) ($product['imagen'] ?? 'jpg'));
}

function product_image_url(array $product): string
{
    return site_url(product_image_relative($product));
}

function category_url(array $category): string
{
    return url_path(category_path($category));
}

function category_path(array $category): string
{
    $slug = (string) ($category['category_slug'] ?? $category['slug'] ?? '');
    return 'productos/' . ($slug !== '' ? $slug : slugify((string) ($category['category'] ?? 'productos')));
}

function subcategory_url(array $category, array $subcategory): string
{
    return url_path(subcategory_path($category, $subcategory));
}

function subcategory_path(array $category, array $subcategory): string
{
    $slug = (string) ($subcategory['subcategory_slug'] ?? $subcategory['slug'] ?? '');
    return category_path($category) . '/' . ($slug !== '' ? $slug : slugify((string) ($subcategory['subcategory'] ?? 'subcategoria')));
}

function product_url(array $product): string
{
    return url_path(product_path($product));
}

function product_path(array $product): string
{
    $slug = (string) ($product['slug'] ?? '');
    if ($slug === '') {
        $slug = slugify((string) ($product['nombre'] ?? 'producto'));
    }

    return 'producto/' . $slug . '-' . (int) $product['id'];
}
