// import
import {
  getStorageItem,
  setStorageItem,
  formatPrice,
  getElement,
} from '../utils.js';
import { openCart } from './toggleCart.js';
import { findProduct } from '../store.js';
import addToCartDOM from './addToCartDOM.js';
// set items
const cartItemsContainer = getElement('.cart-items');
let cart = getStorageItem('cart');
  
// ADD TO CART
export const addToCart = (id) => {
  // check if exist in cart
  const cartIds = cart.map(item => item.id);
  // if doesn't exist
  if(cartIds.includes(id) == false){
    // add to storage
    let newCartItem = findProduct(id);
    newCartItem = {...newCartItem, amount: 1};
    cart = [...cart, newCartItem];
    // add to DOM;
    addToCartDOM(newCartItem);
  }
  // if exist
  if(cartIds.includes(id) == true){
    // update existing storage
    const amount = increaseItemStorage(id);
    // update existing DOM
    const itemAmountDOM = getElement(`#${id}`);
    itemAmountDOM.textContent = amount;
  }
  updateItemCount();
  updateTotalPrice()
  setStorageItem('cart', cart);
  openCart();
};

// INIT
const init = ()=>{
  // display cart item from local storage
  for (const item of cart){
    addToCartDOM(item);
    const itemAmountDOM = getElement('.cart-item:last-child .cart-item-amount');
    itemAmountDOM.textContent = item.amount;
  }
  updateItemCount();
  updateTotalPrice()
  // add click events on cart items
  cartItemsContainer.addEventListener('click', (e)=>{
    const parent = e.target.parentElement;
    // increase btn
    if(parent.classList.contains('cart-item-increase-btn')){
      const amountDOM = parent.nextElementSibling;
      const id = amountDOM.getAttribute('id');
      // update storage
      increaseItemStorage(id);
      // update DOM
      const item = cart.find(item => item.id == id);
      amountDOM.textContent = item.amount
    }
    // decrease btn
    if(parent.classList.contains('cart-item-decrease-btn')){
      const amountDOM = parent.previousElementSibling;
      const id = amountDOM.getAttribute('id');
      // update storage
      const amount = decreaseItemStorage(id);
      if(amount == 0){
        removeItemStorage(id);
        amountDOM.parentElement.parentElement.remove();
      }
      // update DOM
      amountDOM.textContent = amount;
    }
    // remove btn
    if(e.target.classList.contains('cart-item-remove-btn')){
      const itemDOM = e.target.parentElement.parentElement;
      const id = itemDOM.dataset.id;
      // update storage
      removeItemStorage(id);
      // update DOM
      itemDOM.remove();
    }
    updateItemCount();
    updateTotalPrice()
    setStorageItem('cart', cart);
  })
}
init();

// REPEATED FUNCTIONS
function increaseItemStorage(id){
  let newAmount;
  cart = cart.map(item =>{
      if(item.id == id){
        newAmount = item.amount + 1;
        item = {...item, amount:newAmount};
        return item;
      }
      return item;
    });
  return newAmount;
}
function decreaseItemStorage(id){
  let newAmount;
  cart = cart.map(item =>{
      if(item.id == id){
        newAmount = item.amount - 1;
        item = {...item, amount:newAmount};
        return item
      }
      return item
    });
  return newAmount
}

function removeItemStorage(id){
  cart = cart.filter(item => item.id !== id);
}

function updateItemCount(){
  const itemCountDOM = getElement('.cart-item-count');
  const eachItemAmount = cart.map(item => item.amount);
  const totalCount = eachItemAmount.reduce((acc, curr) => acc + curr, 0);
  itemCountDOM.textContent = totalCount;
}

function updateTotalPrice(){
  const cartTotalDOM = getElement('.cart-total');
  const eachItemPrice = cart.map(item => item.amount * item.price);
  const totalCount = eachItemPrice.reduce((acc, curr) => acc + curr, 0);
  cartTotalDOM.textContent = formatPrice(totalCount);
}

// repeated functions
  // find total item
  // display total item
  // find total amount
  // tisplay total amount