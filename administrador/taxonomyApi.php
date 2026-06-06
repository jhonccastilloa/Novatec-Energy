<?php
session_start();
require("conection.php");

header("Content-Type: application/json; charset=utf-8");

function respond($data, $status = 200) {
  http_response_code($status);
  echo json_encode($data);
  exit;
}

function fail($message, $status = 400) {
  respond(["error" => $message], $status);
}

function clean_name($value) {
  $value = trim(preg_replace('/\s+/', ' ', $value));
  if (function_exists('mb_substr')) {
    return mb_substr($value, 0, 50, 'UTF-8');
  }

  return substr($value, 0, 50);
}

function fetch_categories($conn) {
  $result = $conn->query("SELECT id, category AS label FROM category ORDER BY category ASC");
  $items = [];

  while ($row = $result->fetch_assoc()) {
    $items[] = [
      "id" => (int) $row["id"],
      "label" => $row["label"]
    ];
  }

  respond($items);
}

function fetch_subcategories($conn) {
  $categoryId = isset($_GET["category_id"]) ? (int) $_GET["category_id"] : 0;
  if ($categoryId <= 0) {
    fail("Categoria invalida.");
  }

  $stmt = $conn->prepare("SELECT id, subcategory AS label FROM subcategory WHERE id_category = ? ORDER BY subcategory ASC");
  $stmt->bind_param("i", $categoryId);
  $stmt->execute();
  $result = $stmt->get_result();
  $items = [];

  while ($row = $result->fetch_assoc()) {
    $items[] = [
      "id" => (int) $row["id"],
      "label" => $row["label"]
    ];
  }

  respond($items);
}

function require_admin_session() {
  if (!isset($_SESSION["id"])) {
    fail("Debe iniciar sesion para crear registros.", 401);
  }
}

function find_category_by_name($conn, $name) {
  $stmt = $conn->prepare("SELECT id, category AS label FROM category WHERE LOWER(category) = LOWER(?) LIMIT 1");
  $stmt->bind_param("s", $name);
  $stmt->execute();
  return $stmt->get_result()->fetch_assoc();
}

function find_category_by_name_except_id($conn, $name, $id) {
  $stmt = $conn->prepare("SELECT id FROM category WHERE LOWER(category) = LOWER(?) AND id <> ? LIMIT 1");
  $stmt->bind_param("si", $name, $id);
  $stmt->execute();
  return $stmt->get_result()->fetch_assoc();
}

function find_subcategory_by_name($conn, $categoryId, $name) {
  $stmt = $conn->prepare("SELECT id, subcategory AS label FROM subcategory WHERE id_category = ? AND LOWER(subcategory) = LOWER(?) LIMIT 1");
  $stmt->bind_param("is", $categoryId, $name);
  $stmt->execute();
  return $stmt->get_result()->fetch_assoc();
}

function find_subcategory_by_name_except_id($conn, $categoryId, $name, $id) {
  $stmt = $conn->prepare("SELECT id FROM subcategory WHERE id_category = ? AND LOWER(subcategory) = LOWER(?) AND id <> ? LIMIT 1");
  $stmt->bind_param("isi", $categoryId, $name, $id);
  $stmt->execute();
  return $stmt->get_result()->fetch_assoc();
}

function category_exists($conn, $categoryId) {
  $stmt = $conn->prepare("SELECT id FROM category WHERE id = ? LIMIT 1");
  $stmt->bind_param("i", $categoryId);
  $stmt->execute();
  return (bool) $stmt->get_result()->fetch_assoc();
}

function create_category($conn) {
  $name = clean_name($_POST["name"] ?? "");
  if ($name === "") {
    fail("Ingrese un nombre de categoria.");
  }

  $existing = find_category_by_name($conn, $name);
  if ($existing) {
    respond([
      "id" => (int) $existing["id"],
      "label" => $existing["label"]
    ]);
  }

  $slug = unique_category_slug($name);
  $stmt = $conn->prepare("INSERT INTO category(category, slug) VALUES(?, ?)");
  $stmt->bind_param("ss", $name, $slug);

  if (!$stmt->execute()) {
    fail("No se pudo crear la categoria.", 500);
  }

  respond([
    "id" => (int) $conn->insert_id,
    "label" => $name
  ], 201);
}

function update_category($conn) {
  $id = isset($_POST["id"]) ? (int) $_POST["id"] : 0;
  $name = clean_name($_POST["name"] ?? "");

  if ($id <= 0 || !category_exists($conn, $id)) {
    fail("Seleccione una categoria valida.");
  }

  if ($name === "") {
    fail("Ingrese un nombre de categoria.");
  }

  if (find_category_by_name_except_id($conn, $name, $id)) {
    fail("Ya existe una categoria con ese nombre.");
  }

  $slug = unique_category_slug($name, $id);
  $stmt = $conn->prepare("UPDATE category SET category = ?, slug = ? WHERE id = ?");
  $stmt->bind_param("ssi", $name, $slug, $id);

  if (!$stmt->execute()) {
    fail("No se pudo editar la categoria.", 500);
  }

  respond([
    "id" => $id,
    "label" => $name
  ]);
}

function delete_category($conn) {
  $id = isset($_POST["id"]) ? (int) $_POST["id"] : 0;

  if ($id <= 0 || !category_exists($conn, $id)) {
    fail("Seleccione una categoria valida.");
  }

  $stmt = $conn->prepare("DELETE FROM category WHERE id = ?");
  $stmt->bind_param("i", $id);

  try {
    if (!$stmt->execute()) {
      if ($conn->errno == 1451) {
        fail("No se puede eliminar porque tiene sub categorias o productos enlazados.", 409);
      }

      fail("No se pudo eliminar la categoria.", 500);
    }
  } catch (Throwable $error) {
    fail("No se puede eliminar porque tiene sub categorias o productos enlazados.", 409);
  }

  respond(["id" => $id]);
}

function create_subcategory($conn) {
  $categoryId = isset($_POST["category_id"]) ? (int) $_POST["category_id"] : 0;
  $name = clean_name($_POST["name"] ?? "");

  if ($categoryId <= 0 || !category_exists($conn, $categoryId)) {
    fail("Seleccione una categoria valida.");
  }

  if ($name === "") {
    fail("Ingrese un nombre de sub categoria.");
  }

  $existing = find_subcategory_by_name($conn, $categoryId, $name);
  if ($existing) {
    respond([
      "id" => (int) $existing["id"],
      "label" => $existing["label"]
    ]);
  }

  $slug = unique_subcategory_slug($name, $categoryId);
  $stmt = $conn->prepare("INSERT INTO subcategory(id_category, subcategory, slug) VALUES(?, ?, ?)");
  $stmt->bind_param("iss", $categoryId, $name, $slug);

  if (!$stmt->execute()) {
    fail("No se pudo crear la sub categoria.", 500);
  }

  respond([
    "id" => (int) $conn->insert_id,
    "label" => $name
  ], 201);
}

function subcategory_exists($conn, $subcategoryId) {
  $stmt = $conn->prepare("SELECT id FROM subcategory WHERE id = ? LIMIT 1");
  $stmt->bind_param("i", $subcategoryId);
  $stmt->execute();
  return (bool) $stmt->get_result()->fetch_assoc();
}

function update_subcategory($conn) {
  $id = isset($_POST["id"]) ? (int) $_POST["id"] : 0;
  $categoryId = isset($_POST["category_id"]) ? (int) $_POST["category_id"] : 0;
  $name = clean_name($_POST["name"] ?? "");

  if ($id <= 0 || !subcategory_exists($conn, $id)) {
    fail("Seleccione una sub categoria valida.");
  }

  if ($categoryId <= 0 || !category_exists($conn, $categoryId)) {
    fail("Seleccione una categoria valida.");
  }

  if ($name === "") {
    fail("Ingrese un nombre de sub categoria.");
  }

  if (find_subcategory_by_name_except_id($conn, $categoryId, $name, $id)) {
    fail("Ya existe una sub categoria con ese nombre.");
  }

  $slug = unique_subcategory_slug($name, $categoryId, $id);
  $stmt = $conn->prepare("UPDATE subcategory SET subcategory = ?, slug = ?, id_category = ? WHERE id = ?");
  $stmt->bind_param("ssii", $name, $slug, $categoryId, $id);

  if (!$stmt->execute()) {
    fail("No se pudo editar la sub categoria.", 500);
  }

  respond([
    "id" => $id,
    "label" => $name
  ]);
}

function delete_subcategory($conn) {
  $id = isset($_POST["id"]) ? (int) $_POST["id"] : 0;

  if ($id <= 0 || !subcategory_exists($conn, $id)) {
    fail("Seleccione una sub categoria valida.");
  }

  $stmt = $conn->prepare("DELETE FROM subcategory WHERE id = ?");
  $stmt->bind_param("i", $id);

  try {
    if (!$stmt->execute()) {
      if ($conn->errno == 1451) {
        fail("No se puede eliminar porque tiene productos enlazados.", 409);
      }

      fail("No se pudo eliminar la sub categoria.", 500);
    }
  } catch (Throwable $error) {
    fail("No se puede eliminar porque tiene productos enlazados.", 409);
  }

  respond(["id" => $id]);
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $resource = $_GET["resource"] ?? "";

  if ($resource === "categories") {
    fetch_categories($conn);
  }

  if ($resource === "subcategories") {
    fetch_subcategories($conn);
  }

  fail("Recurso invalido.", 404);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  require_admin_session();

  $action = $_POST["action"] ?? "";

  if ($action === "createCategory") {
    create_category($conn);
  }

  if ($action === "updateCategory") {
    update_category($conn);
  }

  if ($action === "deleteCategory") {
    delete_category($conn);
  }

  if ($action === "createSubcategory") {
    create_subcategory($conn);
  }

  if ($action === "updateSubcategory") {
    update_subcategory($conn);
  }

  if ($action === "deleteSubcategory") {
    delete_subcategory($conn);
  }

  fail("Accion invalida.", 404);
}

fail("Metodo no permitido.", 405);
