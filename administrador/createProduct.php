<?php
include("conection.php");
include("createProductEvalua.php");

$queryCategory = "SELECT * FROM category";
$resultCategory = $conn->query($queryCategory)

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Agregar un Nuevo Producto</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Inicio</a></li>
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
                  <h3 class="card-title">Añadir</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">


                  <form action="index.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="module" value="createProduct" hidden>
                    <div class="row">
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Nombre del Producto:</label>
                          <input type="text" class="form-control" name="name" placeholder="Ingerse un nombre">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Categoria:</label>
                          <select name="category" id="productCategory" class="form-control">
                            <option value="">Seleccione Una Categoria</option>
                            <?php
                            while ($row = $resultCategory->fetch_assoc()) {

                            ?>
                              <option value="<?php echo $row['id'] ?>"><?php echo $row['category'] ?></option>
                            <?php
                            }
                            ?>

                          </select>
                          <!-- <input type="text" class="form-control" name="category" placeholder="Ingrese una Categoria"> -->
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Sub Categoria:</label>
                          <select name="subcategory" id="productSubcategory" class="form-control">
                            
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Descripcción del Producto:</label>
                          <textarea name="description" id="editor"> </textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Precio del Producto:</label>
                          <input type="number" class="form-control" name="price" placeholder="Ingrese un precio">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Stock del Producto:</label>
                          <input type="number" class="form-control" name="stock" placeholder="Ingrese el Stock">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Imagen del Producto</label>
                          <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Añadir Producto</button>
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
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

</div>
<!-- ./wrapper -->
<script src="ckeditor/ckeditor.js"></script>
<!-- <script src="https://cdn.tiny.cloud/1/cue8afk8hy33lyzt05x749xqsu2qq3b4hdsy937zulzlsmlm/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->

<script>
  // ClassicEditor
  //     .create(document.querySelector('#editor'))
  //     .catch(error => {
  //       console.error(error);
  //     });
  CKEDITOR.replace( 'editor' );
    //   tinymce.init({
    //   selector: 'textarea',
    //   plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
    //   toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    //   tinycomments_mode: 'embedded',
    //   tinycomments_author: 'Author name',
    //   mergetags_list: [
    //     { value: 'First.Name', title: 'First Name' },
    //     { value: 'Email', title: 'Email' },
    //   ],
    // });
</script>