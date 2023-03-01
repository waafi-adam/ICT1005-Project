import { getElement } from '../utils.js';
import display from '../displayProducts.js';

const companiesContainer = getElement('.companies');

const setupCompanies = (store) => {
    // find all unique companies in store
    let companies = new Set(store.map(product => product.company));
    companies = ['all', ...companies];
    // display unique companies
    companiesContainer.innerHTML = companies.map(company=>{
        return `
            <button class="company-btn">${company}</button>
        `
    }).join('');
    // companies click event
    companiesContainer.addEventListener('click',e=>{
        const btn = e.target
        const isBtn = btn.classList.contains('company-btn');
        // display filtered products
        if (isBtn){
            const company = btn.textContent;
            if(company == 'all'){
                display(store, getElement('.products-container'), true);
            } else {
                const newStore = store.filter(product => product.company == company);
                display(newStore, getElement('.products-container'), true);
            }
        }
    })
};

export default setupCompanies;
