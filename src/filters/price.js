import { formatPrice, getElement } from '../utils.js';
import display from '../displayProducts.js';

const priceForm = getElement('.price-form');
const priceFilter = getElement('.price-filter');
const priceValue = getElement('.price-value');

const setupPrice = (store) => {
    // find max price product
    const prices = store.map(product => product.price);
    const max = Math.max(...prices)
    // set min & max value on filter
    priceFilter.max = max;
    priceFilter.min = 0;
    priceFilter.value = max;
    priceValue.textContent = `Max Value: ${formatPrice(max)}`
    priceForm.addEventListener('input',()=>{
        const value = priceFilter.value;
        // display max value
        priceValue.textContent = `Max Value: ${formatPrice(value)}`
        // filter product
        const newStore = store.filter(product => product.price <= value);
        // diplay filtered product
        const notEmpty = newStore[0];
        if (notEmpty){
            display(newStore, getElement('.products-container'), true);
        } else {
            const element = getElement('.products-container');
            element.innerHTML = `
                <h3 class="filter-error">sorry, no products of this value</h3>
            `
        }
    })
};

export default setupPrice;
