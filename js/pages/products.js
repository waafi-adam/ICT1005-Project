// global imports
//import '../toggleSidebar.js';
import '../cart/toggleCart.js';
import '../cart/setupCart.js';

//  filter imports
import setupSearch from '../filters/search.js';
import setupCompanies from '../filters/companies.js';
import setupPrice from '../filters/price.js';

// specific imports
import { getElement, getStorageItem } from '../utils.js';
import { product, store, setupStore } from '../Product/store.js';
import display from '../Product/displayProducts.js';
import fetchProducts from '../Product/fetchProducts.js';

const haveStore = getStorageItem('product')[0];

if(haveStore){
    const load = getElement('.page-loading');
    console.log("test");
    display(product, getElement('.products-container'));
    load.style.display = 'none';
} else {
    const init = async()=>{
        const load = getElement('.page-loading');
        fetch("http://35.212.148.163/index.php");
        
        display(product, getElement('.products-container'));
        load.style.display = 'none';
        setupSearch(product);
        setupCompanies(product);
        setupPrice(product);
    };
    init();
}

setupSearch(product);
setupCompanies(product);
setupPrice(product);