import { getElement, getStorageItem, setStorageItem } from '../utils.js';
import { products } from '../Product/store.js';
import fetchProducts from '../Product/fetchProducts.js';

/*
================
ADMIN TAB SELECTION
================
*/
const dashboard = getElement('.dashboard');
const btns = document.querySelectorAll('.tab-btn');
const articles = document.querySelectorAll('.content');

dashboard.addEventListener('click', function (e) {
  const id = e.target.dataset.id
  if (id) {
    // remove selected from other buttons
    btns.forEach(function (btn) {
      btn.classList.remove('active')
    })
    e.target.classList.add('active')
    // hide other articles
    articles.forEach(function (article) {
      article.classList.remove('active')
    })
    const element = document.getElementById(id)
    element.classList.add('active')
  }
})

/*
================
PRODUCTS SECTION
================
*/
const selectAndListenRows = () => {
  console.log('selecting and listening rows')
  const rows = document.querySelectorAll('.table-row:not(:first-of-type)')
  const modal = document.querySelector('.modal-overlay')
  const modalCloseBtn = document.querySelector('.close-btn')

  rows.forEach((row) => {
    const editOpenBtn = row.querySelector('.product_form-open-btn')
    let modalOpenBtn = null
    if (row.classList.contains('item')) {
      modalOpenBtn = row.querySelector('.delete-btn')
    }

    // form toggle
    editOpenBtn.addEventListener('click', () => {
      renderForm(editOpenBtn.dataset.form_type, row)
      selectAndListenForm(row)
      row.classList.add('show-form')
    })

    // modal toggle
    if (modalOpenBtn) {
      modalOpenBtn.addEventListener('click', () => {
        modal.classList.add('open-modal')
      })
    }
    modalCloseBtn.addEventListener('click', () =>
      modal.classList.remove('open-modal')
    )
  })
}

const selectAndListenForm = (row) => {
  console.log('select listen Form')
  // select & listen close btns
  const editCloseBtns = row.querySelectorAll('.product_form-close-btn')
  editCloseBtns.forEach((btn) => {
    btn.addEventListener('click', function () {
      removeForm(row)
      row.classList.remove('show-form')
    })
  })

  // select & listen form
  const form = row.querySelector('.form')
  form.addEventListener('submit', (e) =>
    handleSubmit(e, row.dataset.product_id)
  )

  // select alert
  const alert = form.querySelector('.alert')

  // file input listener (updates img)
  const thumbnailInput = form.querySelector(`input[type="file"`)
  const thumbnailImg = form.querySelector('.thumbnail-img')
  thumbnailInput.addEventListener('change', () => {
    replaceImage(thumbnailImg, thumbnailInput)
  })
}

const renderForm = (type, row) => {
  const formContainer = document.createElement('div')
  const id = row.dataset.product_id ? `${row.dataset.product_id}` : ''
  formContainer.setAttribute('class', `item-form ${type}`)
  const formTitle = (() => {
    if (type === 'edit') return `Editting Product ID: ${id}`
    else return 'Adding Product:'
  })()
  const submitTxt = (() => {
    if (type === 'edit') return 'Update'
    else return 'Add'
  })()
  formContainer.innerHTML = `
    <h3>${formTitle}</h3>
    <form class="form" data-form_type="${type}-product" >
        <div class="form-inputs">
            <p class="alert "></p>
            <div class="form-row">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-input" required pattern="[A-Za-z ]+">
            </div>
            <div class="form-row">
                <label for="brand" class="form-label">Brand:</label>
                <input type="text" id="brand" name="brand" class="form-input"  pattern="[A-Za-z ]+">
            </div>

            <div class="form-row">
                <label for="price" class="form-label">Price:</label>
                <input type="number" id="price" name="price" class="form-input" required>
            </div>

            <div class="form-row">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-input"></textarea>
            </div>

            <div class="form-row">
                <label for="thumbnail" class="form-label">Add/Change Thumbnail:</label>
                <input type="file" id="thumbnail" name="thumbnail" class="form-input" accept="image/png, image/jpeg">
            </div>

            <div class="form-row">
                <label for="images" class="form-label">Add Images to Gallery:</label>
                <input type="file" id="images" name="images"
                    class="form-input" accept="image/png, image/jpeg" multiple>
            </div>
            <input type="submit" class="btn " value=${submitTxt}>
            <input type="button" class="btn product_form-close-btn" value="Cancel">
        </div>

        <div class="form-imgs">
            <div class="thumbnail-container">
                <img src="./images/sneaker.png" alt="Current Image" class="thumbnail-img">
            </div>
            <div class="image-gallery">
                <div class="image-item" draggable="true">
                    <img src="./images/sneaker.png" alt="Image 1">
                </div>
                <div class="image-item" draggable="true">
                    <img src="./images/sneaker.png" alt="Image 2">
                </div>
                <div class="image-item" draggable="true">
                    <img src="./images/sneaker.png" alt="Image 3">
                </div>
            </div>
        </div>
    </form>
  `
  row.appendChild(formContainer)
}

const removeForm = (row) => row.removeChild(row.querySelector('.item-form'))

const replaceImage = (img, fileInput) => {
  const file = fileInput.files[0]
  if (!file) return // no file selected
  if (!/\.jpeg$|\.jpg$|\.png$/i.test(file.name)) {
    alert('Please select a JPEG, JPG, or PNG image file.')
    return
  }
  const reader = new FileReader()
  reader.addEventListener('load', () => {
    img.setAttribute('src', reader.result)
  })
  reader.readAsDataURL(file)
}

// GALLERY
const imageItems = document.querySelectorAll('.image-item')

let draggedItem = null

imageItems.forEach((item) => {
  item.addEventListener('dragstart', () => {
    draggedItem = item
    setTimeout(() => {
      item.style.display = 'none'
    }, 0)
  })

  item.addEventListener('dragend', () => {
    setTimeout(() => {
      draggedItem.style.display = 'inline-block'
      draggedItem = null
    }, 0)
  })

  item.addEventListener('dragover', (e) => {
    e.preventDefault()
    const afterElement = getDragAfterElement(item, e.clientY)
    const parent = item.parentNode
    if (afterElement === null) {
      parent.appendChild(draggedItem)
    } else {
      parent.insertBefore(draggedItem, afterElement)
    }
  })
})

function getDragAfterElement(item, y) {
  const draggableElements = [
    ...document.querySelectorAll('.image-item:not(.dragging)'),
  ]

  return draggableElements.reduce(
    (closest, child) => {
      const box = child.getBoundingClientRect()
      const offset = y - box.top - box.height / 2
      if (offset < 0 && offset > closest.offset) {
        return { offset: offset, element: child }
      } else {
        return closest
      }
    },
    { offset: Number.NEGATIVE_INFINITY }
  ).element
}
// GALLERY END

// HANDLE FORMS
const handleSubmit = async (e, id) => {
  console.log('handling submit')
  e.preventDefault()
  const form = e.target
  const formData = new FormData(form)
  if (validateForm(formData, form)) return
  const formType = form.dataset.form_type
  if (formType === 'add-product') await addProduct(formData, form)
  if (formType === 'edit-product') await editProduct(formData, form, id)

  clearInputs(form)
  location.reload()
}

const validateForm = (formData, form) => {
  const name = formData.get('name')
  const price = formData.get('price')
  const thumbnail = formData.get('thumbnail')
  const imgs = formData.get('images')
  console.log(thumbnail, imgs)
  if (!name || !price) {
    displayAlert('danger', 'name and price is required', form)
    return true
  } else displayAlert('load', 'loading', form)
}
const displayAlert = (type, msg, form) => {
  setAlert(type, msg, form)
  setTimeout(() => setAlert('', '', form), 4000)
}

const setAlert = (type, msg, form) => {
  const alert = form.querySelector('.alert')
  if (type) alert.classList = `alert alert-${type}`
  else alert.classList = 'alert'
  alert.textContent = msg
}

const postData = async (url, data) => {
  const resp = await fetch(url, {
    method: 'POST',
    body: data,
  })
  return resp.json()
}

const displayProducts = (products) => {
  const table = document.querySelector('.table')
  table.innerHTML = `
        <div class="table-row" >
            <div class="item-display">
                <div class="item-btns"></div>
                <div class="item-info">
                    <div class="item-col">Product ID</div>
                    <div class="item-col">Name</div>
                    <div class="item-col">Brand</div>
                    <div class="item-col">Price</div>
                </div>
            </div>
        </div>
       <!--Items here-->
        <div class="table-row add">
            <!-- add product btn -->
            <button class="btn add_product-btn product_form-open-btn" data-form_type="add">Add Products</button>
            <!-- edit form -->
        </div>
    `
  const addRow = table.querySelector('.table-row.add')
  for (let product of products) {
    const {
      productID,
      productName,
      productPrice,
      productCompany,
      productDescription,
      productImagePath,
    } = product
    const row = document.createElement('div')
    row.setAttribute('class', `table-row item`)
    row.dataset.product_id = productID
    row.innerHTML = `
        <!-- item display -->
        <div class="item-display">
            <div class="item-info">
                <div class="item-col">${productID}</div>
                <div class="item-col">${productName}</div>
                <div class="item-col">${productCompany}</div>
                <div class="item-col">${productPrice}</div>
            </div>
            <div class="item-btns item">
                <button type="button" class="product_form-open-btn btn" data-form_type="edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="delete-btn btn">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <!-- edit form -->
        </div>
        <!-- item end -->
        `
    table.insertBefore(row, addRow)
  }
  selectAndListenRows()
}

// CRUD below
// CREATE DATA (ADD PRODUCT)
const addProduct = async (formData, form) => {
  try {
    const fileInput = form.querySelector('input[type="file"]#thumbnail')
    const file = fileInput.files[0]
    formData.append('thumbnail', file)
    const resp = await postData('process_addProduct.php', formData)
    if (resp.type === 'success') form.reset()
    displayAlert(resp.type, resp.msg, form)
    console.log(resp)
    console.log(JSON.stringify(resp))
  } catch (error) {
    displayAlert('danger', error.msg, form)
    console.log(error)
    console.log(JSON.stringify(error))
  }
}

// READ DATA (GET PRODUCTS)
const getProducts = async () => {
  try {
    const resp = await fetch('process_getProducts.php')
    const data = await resp.json()
    console.log(resp)
    console.log(data)
    return data
  } catch (err) {
    console.log('Error: ' + err)
  }
}

// UPDATE DATA (EDIT PRODUCTS)
const editProduct = async (formData, form, id) => {
  try {
    const fileInput = form.querySelector('input[type="file"]#thumbnail')
    const file = fileInput.files[0]
    formData.append('thumbnail', file)
    if (id) formData.append('id', id)
    console.log(id)
    const resp = await postData('process_editProduct.php', formData)
    if (resp.type === 'success') form.reset()
    displayAlert(resp.type, resp.msg, form)
    console.log(resp)
    console.log(JSON.stringify(resp))
  } catch (error) {
    displayAlert('danger', error.msg, form)
    console.log(error)
    console.log(JSON.stringify(error))
  }
}

/*
================
ORDERS SECTION
================
*/

const displayOrders = (orders) => {
  const table = document.querySelectorAll('.table')[1]
  table.innerHTML = `
        <div class="table-row">
            <div class="item-display">
                <div class="item-btns"></div>
                <div class="item-info">
                    <div class="item-col">ID</div>
                    <div class="item-col">Name</div>
                    <div class="item-col">Price</div>
                    <div class="item-col">Quantity</div>
                    <div class="item-col">UserID</div>
                </div>
            </div>
        </div>
       <!--Items here-->

    `

  const addRow = table.querySelector('.table-row')

  for (let order of orders) {
    const { orderID, orderQuantity, orderName, orderPrice, orderUserID } = order
    const row = document.createElement('div')
    row.setAttribute('class', `table-row item`)
    row.innerHTML = `
        <!-- item display -->
        <div class="item-display">
            <div class="item-info">
                <div class="item-col">${orderID}</div>
                <div class="item-col">${orderName}</div>
                <div class="item-col">${orderPrice}</div>
                <div class="item-col">${orderQuantity}</div>
                <div class="item-col">${orderUserID}</div>
            </div>
            <div class="item-btns item">
                <button type="button" class="product_form-open-btn btn" data-form_type="edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="delete-btn btn">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <!-- edit form -->
        </div>
        <!-- item end -->
        `
    addRow.parentNode.insertBefore(row, addRow.nextSibling)
    //table.insertBefore(row, addRow);
  }
}

//GET Order Data
const getOrderDetails = async () => {
  try {
    const resp = await fetch('process_getOrders.php')
    const data = await resp.json()
    console.log(resp)
    console.log(data)
    return data
  } catch (err) {
    console.log('Error: ' + err)
  }
}

/*
================
ADMIN SETUP
================
*/
const haveStore = getStorageItem('products')[0];
let productsData = products;

const setupTable = async () => {
    // set up products section
    
    if (!haveStore){
      productsData = await fetchProducts();
      console.log(productsData);
      setStorageItem("products", productsData);
    }
    displayProducts(productsData);
  
    // setup orders section
    const orderData = await getOrderDetails();
    displayOrders(orderData);
};
setupTable();
