let subcategoryData = document.querySelector(".subcategoryData");
let productData = document.querySelector(".productData");
const fragmentProduct = document.createDocumentFragment();

const template = document.getElementById("template-card").content;

const handleOnclick = (event) => {
  productData.innerHTML='hola';

  subcategoryData.innerHTML = '<li class="active" data-filter="*">Todo</li>';

  getProducts(event.target.id);
  getSubcategory(event.target.id);


};

const getSubcategory = async (id) => {
  try {
    const res = await fetch("administrador/getSubcategory?idCategory=" + id);
    const data = await res.json();
    console.log(data);
    data.map((el) => {
      subcategoryData.innerHTML += `
      <li class="product-item"  data-filter=".${el.id}">${el.subcategory}</li>
      `;
    });
  } catch (error) {
    console.log(error);
  }
};

let tmplProduct = "";
const getProducts = async (id) => {
  try {
    const res = await fetch("administrador/getDataProducts?idProduct=" + id);
    const data = await res.json();
    console.log(data);
    productData.innerHTML="";

    data.map((el) => {
      productData.innerHTML += `
      <div class="col-lg-4 col-md-6 text-center ${el.subcategory}">
      <div class="single-product-item">
        <div class="product-image">
          <img src="/imgProducts/${el.id}/${el.image}">
        </div>
        <h3>${el.name}</h3>
        <p class="product-price"><span>S/.</span> ${el.price}</p>
        <a class="cart-btn"><i class="fas fa-shopping-cart"></i> Leer Mas</a>
      </div>
    </div>
      
      `;
      // template.querySelectorAll("div")[0].setAttribute("class",`col-lg-4 col-md-6 text-center ${el.subcategory}`)
      // template.querySelector("img").setAttribute("src",`./imgProducts/${el.id}/${el.image}`)
      // template.querySelector("h3").textContent=el.name
      // template.querySelector("p").textContent=el.price
      // const clone = template.cloneNode(true);

      // fragmentProduct.appendChild(clone)
    });
  } catch (error) {
    console.log(error);
  }
};
