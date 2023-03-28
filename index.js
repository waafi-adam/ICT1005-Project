// global imports
import './js/cart/toggleCart.js';

// specific imports
import fetchProducts from './js/Product/fetchProducts.js';
import { setupStore, store, product } from './js/Product/store.js';
import display from './js/Product/displayProducts.js';
import { getElement } from './js/utils.js';

const init = async()=>{
    //Get featured Product
    const featuredProducts = product.filter(product => product.productCompany == "Nike");
    //Display Product
    display(featuredProducts, getElement('.featured-center'));
};

window.addEventListener('DOMContentLoaded', init);
