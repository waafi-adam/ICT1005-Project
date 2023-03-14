const dashboard = document.querySelector('.dashboard');
const btns = document.querySelectorAll('.tab-btn');
const articles = document.querySelectorAll('.content');
dashboard.addEventListener('click', function (e) {
  const id = e.target.dataset.id;
  if (id) {
    // remove selected from other buttons
    btns.forEach(function (btn) {
      btn.classList.remove('active');
    });
    e.target.classList.add('active');
    // hide other articles
    articles.forEach(function (article) {
      article.classList.remove('active');
    });
    const element = document.getElementById(id);
    element.classList.add('active');
  }
});

// FORMS & MODALS
const rows = document.querySelectorAll('.table-row:not(:first-of-type)');
const modal = document.querySelector('.modal-overlay');
const modalCloseBtn = document.querySelector('.close-btn');

rows.forEach((row) => {
  const editOpenBtn = row.querySelector('.product_form-open-btn');
  let modalOpenBtn = null;
  if (row.classList.contains('item')) {
    modalOpenBtn = row.querySelector('.delete-btn');
  }

  // form toggle
  editOpenBtn.addEventListener('click', () => {
    renderForm(editOpenBtn.dataset.form_type, row);
    selectAndListenForm();
    row.classList.add('show-form');
  });
  const selectAndListenForm = () => {
    // select & listen close btns
    const editCloseBtns = row.querySelectorAll('.product_form-close-btn');
    editCloseBtns.forEach((btn) => {
      btn.addEventListener('click', function () {
        removeForm(row);
        row.classList.remove('show-form');
      });
    });
    
    // select & listen form
    const form = row.querySelector('.form');
    form.addEventListener('submit', handleSubmit);
    
    // select alert
    const alert = form.querySelector('.alert');
    
    // file input listener (updates img)
    const thumbnailInput = form.querySelector(`input[type="file"`);
    const thumbnailImg = form.querySelector('.thumbnail-img');
    thumbnailInput.addEventListener('change', () => {
        replaceImage(thumbnailImg, thumbnailInput);
    });
    
  };
    
  
  // modal toggle
  if (modalOpenBtn) {
    modalOpenBtn.addEventListener('click', () => {
      modal.classList.add('open-modal');
    });
  }
  modalCloseBtn.addEventListener('click', () =>
    modal.classList.remove('open-modal')
  );
  
});

const renderForm = (type, row) => {
  const formContainer = document.createElement('div');
  formContainer.setAttribute('class', `item-form ${type}`);
  const formTitle = (() => {
    if (type === 'edit') return 'Editting Product ID: 123';
    else return 'Adding Product:';
  })();
  formContainer.innerHTML = `
    <h3>${formTitle}</h3>
    <form class="form" data-form_type="${type}-product" action="process_addProduct.php">
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
            <input type="submit" class="btn " value="Submit Changes">
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
  `;
  row.appendChild(formContainer);
};

const removeForm = (row) => row.removeChild(row.querySelector('.item-form'));

const replaceImage = (img, fileInput) => {
  const file = fileInput.files[0];
  if (!file) return; // no file selected
  if (!/\.jpeg$|\.jpg$|\.png$/i.test(file.name)) {
    alert('Please select a JPEG, JPG, or PNG image file.');
    return;
  }
  const reader = new FileReader();
  reader.addEventListener('load', () => {
    img.setAttribute('src', reader.result);
  });
  reader.readAsDataURL(file);
}


// GALLERY
const imageItems = document.querySelectorAll('.image-item');

let draggedItem = null;

imageItems.forEach((item) => {
  item.addEventListener('dragstart', () => {
    draggedItem = item;
    setTimeout(() => {
      item.style.display = 'none';
    }, 0);
  });

  item.addEventListener('dragend', () => {
    setTimeout(() => {
      draggedItem.style.display = 'inline-block';
      draggedItem = null;
    }, 0);
  });

  item.addEventListener('dragover', (e) => {
    e.preventDefault();
    const afterElement = getDragAfterElement(item, e.clientY);
    const parent = item.parentNode;
    if (afterElement === null) {
      parent.appendChild(draggedItem);
    } else {
      parent.insertBefore(draggedItem, afterElement);
    }
  });
});

function getDragAfterElement(item, y) {
  const draggableElements = [
    ...document.querySelectorAll('.image-item:not(.dragging)')
  ];

  return draggableElements.reduce(
    (closest, child) => {
      const box = child.getBoundingClientRect();
      const offset = y - box.top - box.height / 2;
      if (offset < 0 && offset > closest.offset) {
        return { offset: offset, element: child };
      } else {
        return closest;
      }
    },
    { offset: Number.NEGATIVE_INFINITY }
  ).element;
}

// HANDLE FORMS

const handleSubmit = (e) => {
  e.preventDefault();
  const form = e.target;
  const formData = new FormData(form);
  if (validateForm(formData, form)) return;
  const formType = form.dataset.form_type;
  if (formType === 'add-product') addProduct(formData, form);
  clearInputs(form);
};

const validateForm = (formData, form) => {
  const name = formData.get('name');
  const brand = formData.get('brand');
  const price = formData.get('price');
  const description = formData.get('description');
  const thumbnail = formData.get('thumbnail');
  const imgs = formData.get('images');
  console.log(thumbnail, imgs);
  if (!name || !price) {
    displayAlert('danger', 'name and price is required', form);
    return true;
  } else displayAlert('load', 'loading', form);
};
const displayAlert = (type, msg, form) => {
  setAlert(type, msg, form);
  setTimeout(() => setAlert('', '', form), 4000);
};

const setAlert = (type, msg, form) => {
  const alert = form.querySelector('.alert');
  if(type) alert.classList = `alert alert-${type}`;
  else alert.classList = 'alert';
  alert.textContent = msg;
};

// POST DATA
const postData = async(url, data) =>{
    const resp = await fetch(url, {
        method: 'POST',
        body: data
    });
    return resp.json();
};

const addProduct = async(formData, form)=>{
    try {
        const fileInput = form.querySelector('input[type="file"]#thumbnail');
        const file = fileInput.files[0];
        formData.append('thumbnail', file);
        const resp = await postData('process_addProduct.php', formData);
        displayAlert('success', resp.msg, form );
        console.log(resp);
        console.log(JSON.stringify(resp));
    } catch(error) {
        displayAlert('danger', error.msg, form );
        console.log(error);
        console.log(JSON.stringify(error));
    }
};

const clearInputs = (form) => {
    const inputs = form.querySelectorAll('input[type="text"], input[type="number"], textarea');
    inputs.forEach(input => input.value = '');
    const fileInputs = form.querySelectorAll(`input[type="file"]`);
    fileInputs.forEach(input => input.parentNode.replaceChild(input.cloneNode(), input));
};