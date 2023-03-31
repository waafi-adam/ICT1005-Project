import { getElement } from '../utils.js';

const addToCartDOM = (item) => {
    const cartItemsContainer = getElement('.cart-items');
    //const {id, productName, img, price} = item;
    const newItem = document.createElement('article');
    newItem.classList.add('cart-item');
    newItem.dataset.id = item.productID;
    newItem.innerHTML = `
        <img src="${item.productImagePath}" class="cart-item-img" alt="${item.productName}-img">
        <!-- item info -->
        <div>
            <h4 class="cart-item-name">${item.productName}</h4>
            <p class="cart-item-price">$${item.productPrice}</p>
            <button class="cart-item-remove-btn" aria-label="Remove Items from Cart">remove</button>
        </div>
        <!-- amount toggle -->
        <div>
            <button class="cart-item-increase-btn" aria-label="Increase quantity">
                <i class="fas fa-chevron-up"></i>
            </button>
            <p class="cart-item-amount" id="${item.productID}">1</p>
            <button class="cart-item-decrease-btn" aria-label="Decrease quantity>
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
    `
    cartItemsContainer.appendChild(newItem);
};

export default addToCartDOM;
