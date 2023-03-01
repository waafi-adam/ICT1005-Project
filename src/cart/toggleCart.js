import { getElement } from '../utils.js';
const cartOverlay = getElement('.cart-overlay');
const toggleCart = getElement('.toggle-cart');
const cartClose = getElement('.cart-close');

export const openCart = () => {
    cartOverlay.classList.add('show');
};

toggleCart.addEventListener('click', ()=>{
    openCart();
})
cartClose.addEventListener('click', ()=>{
    cartOverlay.classList.remove('show');
})
