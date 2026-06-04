<?php
if (!function_exists('renderAdminAlert')) {
  function renderAdminAlert($message, $type = 'success')
  {
    $allowedTypes = array('primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark');
    $alertType = is_string($type) && in_array($type, $allowedTypes, true) ? $type : 'success';
    $alertMessage = is_scalar($message) ? (string) $message : '';
    $safeMessage = htmlspecialchars($alertMessage, ENT_QUOTES, 'UTF-8');
?>
    <div class="alert alert-<?= $alertType ?> alert-dismissible fade show admin-floating-alert" role="alert">
      <strong><?= $safeMessage ?></strong>
      <button type="button" class="close text-white " style="opacity: 1;" data-dismiss="alert" aria-label="Close" >
        <span aria-hidden="true"  >&times;</span>
      </button>
    </div>
<?php
  }
}

if (!function_exists('renderAdminSessionAlert')) {
  function renderAdminSessionAlert()
  {
    if (isset($_SESSION["msg"]) && isset($_SESSION["estate"])) {
      renderAdminAlert($_SESSION["msg"], trim((string) $_SESSION["estate"]));
      unset($_SESSION["msg"]);
      unset($_SESSION["estate"]);
    }
  }
}
?>
