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
import { store, setupStore } from '../Product/store.js';
import display from '../Product/displayProducts.js';
import fetchProducts from '../Product/fetchProducts.js';

const haveStore = getStorageItem('store')[0];

if(haveStore){
    const load = getElement('.page-loading');
    display(store, getElement('.products-container'));
    load.style.display = 'none';
} else {
    const init = async()=>{
        const load = getElement('.page-loading');
        const products = await fetchProducts();
        if (products){
            setupStore(products);
        }
        display(store, getElement('.products-container'));
        load.style.display = 'none';
        setupSearch(store);
        setupCompanies(store);
        setupPrice(store);
    };
    init();
}
setupSearch(store);
setupCompanies(store);
setupPrice(store);