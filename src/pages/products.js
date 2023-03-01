// global imports
import '../toggleSidebar.js';
import '../cart/toggleCart.js';
import '../cart/setupCart.js';

//  filter imports
import setupSearch from '../filters/search.js';
import setupCompanies from '../filters/companies.js';
import setupPrice from '../filters/price.js';

// specific imports
import { store } from '../store.js';
import display from '../displayProducts.js';
import { getElement } from '../utils.js';
import fetchProducts from '../fetchProducts.js';
import { setupStore } from '../store.js';
import { getStorageItem } from '../utils.js';

const haveStore = getStorageItem('store')[0];

if(haveStore){
    const load = getElement('.page-loading')
    display(store, getElement('.products-container'));
    load.style.display = 'none';
} else {
    const init = async()=>{
        const load = getElement('.page-loading')
        const products = await fetchProducts();
        if (products){
            setupStore(products);
        }
        display(store, getElement('.products-container'));
        load.style.display = 'none';
        setupSearch(store);
        setupCompanies(store);
        setupPrice(store);
    }
    init();
}
setupSearch(store);
setupCompanies(store);
setupPrice(store);