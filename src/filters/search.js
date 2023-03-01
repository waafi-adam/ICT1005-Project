import { getElement } from '../utils.js';
import display from '../displayProducts.js';

const searchForm = getElement('.input-form');
const searchInput = getElement('.search-input');

const setupSearch = (store) => {
    searchForm.addEventListener('input', ()=>{
        const value = searchInput.value;
        const newStore = store.filter(product =>{
            const str = product.name.toLowerCase();
            return str.includes(value);
        });
        if(newStore[0]){
            display(newStore, getElement('.products-container'), true)
        }
        if (!newStore[0]){
            const element = getElement('.products-container');
            element.innerHTML = `
                <h3 class="filter-error">sorry, no products matched your search</h3>
            `
        }
        if (!value){
            display(store, getElement('.products-container'), true);
        }
    })
};

export default setupSearch;
