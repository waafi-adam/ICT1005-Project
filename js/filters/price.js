import { getElement } from '../utils.js';
import display from '../Product/displayProducts.js';

const priceForm = getElement('.price-form');
const priceFilter = getElement('.price-filter');
const priceValue = getElement('.price-value');

const setupPrice = (product) => {
    // find max price product
    const prices = product.map(product => product.productPrice);
    const max = Math.max(...prices);
    // set min & max value on filter
    priceFilter.max = max;
    priceFilter.min = 0;
    priceFilter.value = max;
    priceValue.textContent = `Max Value: ${max}`;
    priceForm.addEventListener('input',()=>{
        const value = priceFilter.value;
        // display max value
        priceValue.textContent = `Max Value: ${value}`;
        // filter product
        const newStore = product.filter(product => product.productPrice <= value);
        // diplay filtered product
        const notEmpty = newStore[0];
        if (notEmpty){
            display(newStore, getElement('.products-container'), true);
        } else {
            const element = getElement('.products-container');
            element.innerHTML = `
                <h3 class="filter-error">sorry, no products of this value</h3>
            `;
        }
    });
};

export default setupPrice;
