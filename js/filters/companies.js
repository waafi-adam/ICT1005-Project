import { getElement } from '../utils.js';
import display from '../Product/displayProducts.js';

const companiesContainer = getElement('.companies');

const setupCompanies = (product) => {
    // find all unique companies in store
    let companies = new Set(product.map(product => product.productCompany));
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
                display(product, getElement('.products-container'), true);
            } else {
                const newStore = product.filter(product => product.productCompany == company);
                display(newStore, getElement('.products-container'), true);
            }
        }
    })
};

export default setupCompanies;
