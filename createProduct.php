<?php

if (!defined('NOVATEC_ADMIN_LAYOUT')) {
  $queryString = $_SERVER['QUERY_STRING'] ?? '';
  $suffix = $queryString === '' ? '' : '&' . $queryString;
  header('Location: administrador/index.php?module=createProduct' . $suffix);
  exit;
}

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
            <li class="breadcrumb-item active">Agregar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title font-weight-bold">AGREGAR PRODUCTO:</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form action="createProductEvalua.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="module" value="createProduct" hidden>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Nombre del Producto:</label>
                            <input type="text" class="form-control" name="name" placeholder="Ingrese un nombre" required>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div
                            data-product-taxonomy
                            data-category-input="productCategory"
                            data-subcategory-input="productSubcategory"
                          ></div>
                          <input type="hidden" name="category" id="productCategory">
                          <input type="hidden" name="subcategory" id="productSubcategory">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Breve Descripcion del Producto:</label>
                            <textarea class="form-control" name="breve" rows="8" required></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Descripcion del Producto:</label>
                          <textarea name="description" id="editor"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Precio del Producto:</label>
                          <input type="number" class="form-control" name="price" step="0.01" placeholder="Ingrese un precio" required>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Imagen del Producto:</label>
                          <input type="file" class="form-control-file" name="image" accept="image/*" required>
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
      </div>
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
