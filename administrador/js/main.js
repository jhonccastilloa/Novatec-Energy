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
console.log((categorySubName.innerHTML));
const dataEditSub = (event) => {
  let category = event.target.getAttribute("category");
  let subcategory = event.target.getAttribute("subcategory");
  let id = event.target.getAttribute("id");

  subCategoryName.value = subcategory;
  categorySubName.value = category;
  idCatName.value = id;
};
