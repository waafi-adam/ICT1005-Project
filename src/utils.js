//   ATTENTION!!!!!!!!!!!
//   I SWITCHED TO PERMANENT DOMAIN
//   DATA IS THE SAME JUST A DIFFERENT URL,
//   DOES NOT AFFECT PROJECT FUNCTIONALITY

const allProductsUrl = 'https://course-api.com/javascript-store-products'
// temporary single product
// 'https://course-api.com/javascript-store-single-product?id=rec43w3ipXvP28vog'
const singleProductUrl =
  'https://course-api.com/javascript-store-single-product'

const getElement = (selection) => {
  const element = document.querySelector(selection)
  if (element) return element
  throw new Error(`Please check "${selection}" selector, no such element exist`)
}

const formatPrice = (item) => {
  return new Intl.NumberFormat('en-IN',{style:'currency', currency:'USD'}).format((item / 100).toFixed());
}

const getStorageItem = (key) => {
  let value = localStorage.getItem(key);
  if(value){
    return JSON.parse(value);
  } else {
    value = [];
  }
  return value;
};
const setStorageItem = (key, value) => {localStorage.setItem(key, JSON.stringify(value))};

export {
  allProductsUrl,
  singleProductUrl,
  getElement,
  formatPrice,
  getStorageItem,
  setStorageItem,
}
