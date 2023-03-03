// global imports
import './js/cart/toggleCart.js';

// specific imports
import fetchProducts from '/js/Product/fetchProducts.js';
import { setupStore, store } from '/js/Product/store.js';
import display from '/js/Product/displayProducts.js';
import { getElement } from '/js/utils.js';

const init = async()=>{
    const products = await fetchProducts();
    if (products){
        setupStore(products);
    }
    const featuredProducts = store.filter(product=> product.featured == true);
    display(featuredProducts, getElement('.featured-center'));
};

window.addEventListener('DOMContentLoaded', init);
