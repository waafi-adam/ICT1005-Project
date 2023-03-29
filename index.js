// global imports
import './js/cart/toggleCart.js';
import './js/toggleSidebar.js';

// specific imports
import fetchProducts from './js/Product/fetchProducts.js';
import { products } from './js/Product/store.js';
import display from './js/Product/displayProducts.js';
import { getElement, setStorageItem } from './js/utils.js';
const init = async()=>{
    //Get all products
    const productsData = await fetchProducts();
    setStorageItem(productsData);
    
    //Get featured Product
    const featuredProducts = products.filter(product => product.productCompany == "Nike");
    //Display Product
    display(featuredProducts, getElement('.featured-center'));
   
    
};

window.addEventListener('DOMContentLoaded', init);
