let categoryName = document.getElementById("category");
let descriptionName = document.getElementById("description");
let idName = document.getElementById("idCat");
const dataEdit = (event) => {
  let category = event.target.getAttribute("category");
  let description = event.target.getAttribute("description");
  let id = event.target.getAttribute("id");

  categoryName.value = category;
  descriptionName.value = description;
  idName.value = id;
};

let subCategoryName = document.getElementById("subCategory");
let categorySubName = document.getElementById("selectCategory");
let idCatName = document.getElementById("idCat");
const dataEditSub = (event) => {
  let category = event.target.getAttribute("category");
  let subcategory = event.target.getAttribute("subcategory");
  let id = event.target.getAttribute("id");

  subCategoryName.value = subcategory;
  categorySubName.value = category;
  idCatName.value = id;
};

//Select funcion
let productCategory = document.getElementById("productCategory");
let productSubcategory=document.getElementById('productSubcategory')
if (productSubcategory) {
  productCategory.oninput = () => {
    productSubcategory.innerHTML=''
    getSubcategory(productCategory.value)
  };
}


const getSubcategory = async (id) => {
  try {
    const res = await fetch("getSubcategory?idCategory="+id);
    const data = await res.json();
    data.map(el => {
      productSubcategory.innerHTML+=`
      <option value='${el.id}'>${el.subcategory}</option>
      `
    });
  } catch (error) {
    console.log(error);
  }
};
