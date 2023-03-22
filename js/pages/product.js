// global imports
//import '../toggleSidebar.js';
import '../cart/toggleCart.js';
import '../cart/setupCart.js';

// specific
import { addToCart } from '../cart/setupCart.js';
import { singleProductUrl, getElement } from '../utils.js';

// selections
const loading = getElement('.page-loading');
const centerDOM = getElement('.single-product-center');
const pageTitleDOM = getElement('.page-hero-title');
const imgDOM = getElement('.single-product-img');
const titleDOM = getElement('.single-product-title');
const companyDOM = getElement('.single-product-company');
const priceDOM = getElement('.single-product-price');
//const colorsDOM = getElement('.single-product-colors');
const descDOM = getElement('.single-product-desc');
const cartBtn = getElement('.addToCartBtn');




const init = async()=>{
    const data = await fetchProduct();
    //console.log(data);
    displayProduct(data);
    loading.style.display = 'none';
};

const postData = async(url, data) =>{
    const resp = await fetch(url, {
        method: 'POST',
        body: data
    });
    return resp.json();
};

const fetchProduct = async()=>{
    let id = window.location.search.split('id=')[1];
    
    let formData = new FormData();
    formData.set("productID", id);
    
    const resp = await postData('includes/fetchProduct.php', formData);
    console.log(JSON.stringify(resp));
    
    return resp[0];
};

const displayProduct = (product)=>{
    console.log(product.productName);
    pageTitleDOM.textContent = `home / ${product.productName}`;
    imgDOM.src = product.productImagePath;
    titleDOM.textContent = product.productName;
    companyDOM.textContent = `by ${product.productCompany}`;
    
    priceDOM.textContent = `$${product.productPrice}`;
    //colorsDOM.innerHTML = colors.map(color =>{
    //    return `
    //        <span class="single-product-color" style="background-color:red;"></span>
    //    `;
    //}).join('');
    descDOM.textContent = product.productName;
    cartBtn.addEventListener('click', (e)=>{
        if(e.currentTarget.classList.contains('addToCartBtn')){
            addToCart(product.productID);
        }
    });
};

init();