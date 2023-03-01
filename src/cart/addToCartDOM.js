import { formatPrice, getElement } from '../utils.js';

const addToCartDOM = (item) => {
    const cartItemsContainer = getElement('.cart-items');
    const {id, name, img, price} = item;
    const newItem = document.createElement('article');
    newItem.classList.add('cart-item');
    newItem.dataset.id = id;
    newItem.innerHTML = `
        <img src="${img}" class="cart-item-img" alt="${name}-img">
        <!-- item info -->
        <div>
            <h4 class="cart-item-name">${name}</h4>
            <p class="cart-item-price">$${price / 100}</p>
            <button class="cart-item-remove-btn">remove</button>
        </div>
        <!-- amount toggle -->
        <div>
            <button class="cart-item-increase-btn">
                <i class="fas fa-chevron-up"></i>
            </button>
            <p class="cart-item-amount" id="${id}">1</p>
            <button class="cart-item-decrease-btn">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
    `
    cartItemsContainer.appendChild(newItem);
};

export default addToCartDOM;
