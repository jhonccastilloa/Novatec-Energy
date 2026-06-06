<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

function contact_redirect(array $params): void
{
    $query = http_build_query($params);
    header('Location: ' . url_path('contacto') . ($query ? '?' . $query : ''), true, 303);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    contact_redirect(['error' => 'Solicitud no permitida.']);
}

if (!verify_csrf($_POST['csrf_token'] ?? null)) {
    contact_redirect(['error' => 'No pudimos validar el formulario. Intente nuevamente.']);
}

if (!empty($_POST['website'] ?? '')) {
    contact_redirect(['enviado' => 1]);
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$phone = trim((string) ($_POST['phone'] ?? ''));
$subject = trim((string) ($_POST['subject'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

$name = excerpt($name, 80);
$phone = preg_replace('/[^0-9+\s()-]/', '', $phone) ?: '';
$subject = str_replace(["\r", "\n"], ' ', excerpt($subject, 120));
$message = excerpt($message, 1500);

if ($name === '' || $subject === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    contact_redirect(['error' => 'Complete nombre, correo valido, asunto y mensaje.']);
}

$mailConfig = novatec_config('mail');
$to = (string) $mailConfig['recipient'];
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$from = 'no-reply@' . preg_replace('/[^a-z0-9.-]/i', '', $host);

$headers = [
    'From: Novatec Energy <' . $from . '>',
    'Reply-To: ' . $email,
    'Content-Type: text/plain; charset=UTF-8',
    'X-Mailer: PHP/' . phpversion(),
];

$body = "Nuevo mensaje desde Novatec Energy\n\n";
$body .= "Nombre: {$name}\n";
$body .= "Correo: {$email}\n";
$body .= "Telefono: {$phone}\n";
$body .= "Asunto: {$subject}\n\n";
$body .= "Mensaje:\n{$message}\n";

$sent = mail($to, 'Novatec Energy: ' . $subject, $body, implode("\r\n", $headers));

if ($sent) {
    ensure_session();
    unset($_SESSION['csrf_token']);
    contact_redirect(['enviado' => 1]);
}

contact_redirect(['error' => 'No pudimos enviar el mensaje. Tambien puede escribirnos por WhatsApp.']);
