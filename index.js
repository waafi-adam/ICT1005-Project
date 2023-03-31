// global imports
import './js/cart/toggleCart.js';
import './js/toggleSidebar.js';

// specific imports
import fetchProducts from './js/Product/fetchProducts.js';
import display from './js/Product/displayProducts.js';
import { getElement, setStorageItem } from './js/utils.js';
import {animateNumbersSection} from './js/numbers/numbers.js';

const init = async()=>{
    //Get all products
    const productsData = await fetchProducts();
    setStorageItem('products', productsData);
    // animate numbers section
    animateNumbersSection(productsData);
    //Get featured Product
    const featuredProducts = productsData.filter(product => product.productCompany === "Nike");
    //Display featured Product
    display(featuredProducts, getElement('.featured-center'));
};

window.addEventListener('DOMContentLoaded', init);
