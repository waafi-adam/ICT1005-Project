import { getElement } from '../utils.js';
import display from '../Product/displayProducts.js';

const searchForm = getElement('.input-form');
const searchInput = getElement('.search-input');

const setupSearch = (product) => {
    searchForm.addEventListener('input', ()=>{
        const value = searchInput.value;
        const newStore = product.filter(product =>{
            const str = product.productName.toLowerCase();
            return str.includes(value);
        });
        //display matching item
        if(newStore[0]){
            display(newStore, getElement('.products-container'), true);
        }
        //No matching item
        if (!newStore[0]){
            const element = getElement('.products-container');
            element.innerHTML = `
                <h3 class="filter-error">sorry, no products matched your search</h3>
            `;
        }
        //No value
        if (!value){
            display(product, getElement('.products-container'), true);
        }
    });
};

export default setupSearch;