<?php

if (!defined('NOVATEC_ADMIN_LAYOUT')) {
  $queryString = $_SERVER['QUERY_STRING'] ?? '';
  $suffix = $queryString === '' ? '' : '&' . $queryString;
  header('Location: administrador/index.php?module=editProduct' . $suffix);
  exit;
}

require_once __DIR__ . "/administrador/conection.php";

if (!function_exists('productFormHtml')) {
  function productFormHtml($value)
  {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
  }
}

$id = isset($_REQUEST['id']) ? $conn->real_escape_string($_REQUEST['id']) : "";
$query = "SELECT * FROM productos WHERE id='{$id}'";
$result = $conn->query($query);
$row = $result ? $result->fetch_assoc() : null;

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="font-weight-bold">Productos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Inicio</a></li>
            <li class="breadcrumb-item"><a href="index.php?module=product">Productos</a></li>
            <li class="breadcrumb-item active">Editar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <?php if (!$row) { ?>
        <div class="alert alert-warning" role="alert">
          No se encontró el producto solicitado.
        </div>
        <a href="index.php?module=product" class="btn btn-primary">Volver a productos</a>
      <?php } else { ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="card card-warning">
                  <div class="card-header">
                    <h3 class="card-title font-weight-bold text-white">EDITAR PRODUCTO:</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <form action="createProductEvalua.php" method="post" enctype="multipart/form-data">
                      <input type="text" name="idEdit" value="<?php echo productFormHtml($row['id']) ?>" hidden>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Nombre del producto:</label>
                              <input type="text" class="form-control" name="name" value="<?php echo productFormHtml($row['nombre']) ?>" required>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div
                              data-product-taxonomy
                              data-category-input="productCategory"
                              data-subcategory-input="productSubcategory"
                              data-category-id="<?php echo productFormHtml($row['id_categoria']) ?>"
                              data-subcategory-id="<?php echo productFormHtml($row['id_subcategory']) ?>"
                            ></div>
                            <input type="hidden" name="category" id="productCategory" value="<?php echo productFormHtml($row['id_categoria']) ?>">
                            <input type="hidden" name="subcategory" id="productSubcategory" value="<?php echo productFormHtml($row['id_subcategory']) ?>">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Breve descripción del producto:</label>
                              <textarea class="form-control" name="breve" maxlength="400" rows="8" required><?php echo productFormHtml($row['breve_descripcion']) ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Descripción</label>
                            <textarea name="description" id="editor" rows="10" cols="80"><?php echo $row['descripcion'] ?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <?php
                        $hasCurrentImage = product_has_image($row);
                        $currentImageFile = $hasCurrentImage ? $row['id'] . '.' . image_extension((string) $row['imagen']) : '';
                        ?>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Precio del producto</label>
                            <input type="number" class="form-control" name="price" value="<?php echo productFormHtml($row['precio_normal']) ?>" step="0.01" placeholder="Ingrese un precio" required>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Imagen</label>
                            <input type="text" name="imageAux" value="<?php echo productFormHtml($row['imagen']) ?>" hidden>
                            <div
                              class="product-image-upload"
                              data-image-preview
                              <?php if ($hasCurrentImage) { ?>
                              data-current-src="../productsImg/<?php echo productFormHtml($currentImageFile) ?>"
                              data-current-name="<?php echo productFormHtml($row['imagen']) ?>"
                              data-current-label="Imagen actual"
                              <?php } ?>
                              data-selected-label="Nueva imagen"
                            >
                              <input type="file" class="form-control" name="image" accept="image/*" data-image-preview-input>
                              <small class="form-text text-muted" data-image-preview-empty>
                                Opcional. Puede agregarla despues.
                              </small>
                              <div class="product-image-preview" data-image-preview-container hidden>
                                <img src="" alt="Vista previa de la nueva imagen del producto" data-image-preview-img>
                                <div class="product-image-preview__meta">
                                  <span class="product-image-preview__label" data-image-preview-label>Imagen actual</span>
                                  <span class="product-image-preview__name" data-image-preview-name></span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      <?php } ?>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<script src="../ckeditor/ckeditor.js"></script>
<script>
  if (document.getElementById('editor') && window.CKEDITOR) {
    CKEDITOR.replace('editor', {
      filebrowserUploadUrl: '../ckeditor/ck_upload.php',
      filebrowserUploadMethod: 'form'
    });
  }
</script>
