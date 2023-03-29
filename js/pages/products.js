// global imports
import '../toggleSidebar.js';
import '../cart/toggleCart.js';
import '../cart/setupCart.js';


//  filter imports
import setupSearch from '../filters/search.js';
import setupCompanies from '../filters/companies.js';
import setupPrice from '../filters/price.js';

// specific imports
import { products } from '../Product/store.js';
import display from '../Product/displayProducts.js';
import fetchProducts from '../Product/fetchProducts.js';
import { getStorageItem, setStorageItem, getElement } from '../utils.js';

let productsData = products;
const load = getElement('.page-loading');
const haveStore = getStorageItem('products')[0];

if(!haveStore){
    const init = async()=>{
        productsData = await fetchProducts();
        console.log(productsData);
        setStorageItem("products", productsData);
        await display(products, getElement('.products-container'));
        load.style.display = 'none';
        setupSearch(productsData);
        setupCompanies(productsData);
        setupPrice(productsData);
    };
    init();
}else {
    display(products, getElement('.products-container'));
    load.style.display = 'none';
    setupSearch(productsData);
    setupCompanies(productsData);
    setupPrice(productsData);
}
