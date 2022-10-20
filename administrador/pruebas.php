<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    table,
    tr,
    th,
    td {
      border: 5px solid black;
      border-collapse: collapse;
    }
  </style>
</head>

<body>
  <h1>prueba</h1>
  <select name="category" id="category">

  </select>
  <select name="subcategory" id="subcategory">

  </select>

  <input type="text" id="id">
  <input type="text" id="categoryText">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Categoria</th>
        <th>Editar</th>

      </tr>
    </thead>
    <tbody class="data">

    </tbody>

  </table>
  <script>
    let tabledata = document.querySelector('.data')
    let idText = document.getElementById('id')
    let categoryText = document.getElementById('categoryText')

    console.log("hola");
    const getData = async () => {
      try {
        const res = await fetch('getData.php');
        const data = await res.json();
        console.log(data);

        data.map((el) => {
        tabledata.innerHTML += `
        <tr>
        <td>${el.id}</td>
        <td>${el.category}</td>
        <td><button onclick="edit(${el.id})">editar</button></td>

        </tr>
        `
      })
      } catch (error) {
        console.log(error);
      }
      

    }
    const editData = async (id) => {
      try {
        const res = await fetch(`getData?id=${id}`);
        const data = await res.json();

        idText.value = data.id
        categoryText.value = data.category
      } catch (error) {
        console.log(error);
      }
    }
    const edit = (id) => {
      editData(id)
    }
    getData()











    //-------------------------------------------------
    let selectSubCategory = document.getElementById('subcategory')
    let selectCategory = document.getElementById('category');
    selectCategory.innerHTML = `
    <option value="">Seleccion Una Categoria</option>

  <option value="1">Termas Solares</option>
  <option value="2">Paneles Solares</option>
  <option value="3">Bombas Solares</option>
  <option value="4">Inversores Solares</option>
  `

    selectCategory.oninput = () => {
      selectSubCategory.innerHTML = '';
      console.log(selectCategory.value);
      getDataSubcategory(selectCategory.value)

    }
    const getDataSubcategory = async (id) => {
      try {
        const res = await fetch('getSubcategory.php?idCategory=' + id);
        const data = await res.json();
        console.log(data);
        data.map((el) => {
          selectSubCategory.innerHTML += `
            <option value="${el.id}">${el.subcategory}</option>
          `
        })

      } catch (error) {
        console.log(error);
      }
    }
  </script>
</body>

</html>