const dashboard = document.querySelector('.dashboard')
const btns = document.querySelectorAll('.tab-btn')
const articles = document.querySelectorAll('.content')
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

// EDIT SECTION
const items = document.querySelectorAll('.table-row.item')
const modal = document.querySelector('.modal-overlay')
const modalCloseBtn = document.querySelector('.close-btn')

items.forEach(function (item) {
  const currItem = item
  const editOpenBtn = item.querySelector('.edit-open-btn')
  const editCloseBtns = item.querySelectorAll('.edit-close-btn')
  const modalOpenBtn = item.querySelector('.delete-btn')

  // edit toggle
  editOpenBtn.addEventListener('click', function () {
    currItem.classList.add('show-edit')
  })
  editCloseBtns.forEach((btn) => {
    btn.addEventListener('click', function () {
      console.log('closing')
      items.forEach(function (item) {
        currItem.classList.remove('show-edit')
      })
    })
  })

  // delete toggle
  modalOpenBtn.addEventListener('click', function () {
    modal.classList.add('open-modal')
  })
  modalCloseBtn.addEventListener('click', function () {
    modal.classList.remove('open-modal')
  })
})

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
    if (afterElement == null) {
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
