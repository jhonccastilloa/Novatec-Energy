<?php
require("./administrador/conection.php");
include_once("head.php");


?>



<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>Productos de Calidad</p>
          <h1>Productos</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- products -->
<div class="product-section mt-30 mb-150">
  <div class="container">

    <div class="row">

      <div class="col-md-12">

        <div class="product-category">
          <h3>Categoria:</h3>
          <ul>
            <li class="category_item" category="all">Todo</li>

            <?php
            $query = "SELECT * FROM category";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
            ?>

              <li class="category_item categoryProduct" id="<?php echo $row['id'] ?>" onclick="handleOnclick(event)"><?php echo $row['category'] ?></li>
            <?php
            }
            ?>


          </ul>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="product-filters products-list">
          <ul class="subcategoryData">

            <li class="active" data-filter="*">Todo</li>

          </ul>
        </div>
      </div>
    </div>



    <div class="productData row product-lists ">
    

    </div>
    <template id="template-card">
      <div class="col-lg-4 col-md-6 text-center ">
        <div class="single-product-item">
          <div class="product-image">
            <img >
          </div>
          <h3></h3>
          <p class="product-price"><span>S/.</span> </p>
          <a class="cart-btn"><i class="fas fa-shopping-cart"></i> Leer Mas</a>
        </div>
      </div>
    </template>
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="pagination-wrap">
          <ul>
            <li><a href="#">Prev</a></li>
            <li><a href="#">1</a></li>
            <li><a class="active" href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">Next</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end products -->



<?php

include_once("footer.php");



?>
<script>

</script>

<?php

?>