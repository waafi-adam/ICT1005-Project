// global imports
import '../toggleSidebar.js';
import '../cart/toggleCart.js';
import '../cart/setupCart.js';
// specific
import { addToCart } from '../cart/setupCart.js';
import { singleProductUrl, getElement, formatPrice } from '../utils.js';

// selections
const loading = getElement('.page-loading');
const centerDOM = getElement('.single-product-center');
const pageTitleDOM = getElement('.page-hero-title');
const imgDOM = getElement('.single-product-img');
const titleDOM = getElement('.single-product-title');
const companyDOM = getElement('.single-product-company');
const priceDOM = getElement('.single-product-price');
const colorsDOM = getElement('.single-product-colors');
const descDOM = getElement('.single-product-desc');
const cartBtn = getElement('.addToCartBtn');


const init = async()=>{
    const data = await fetchProduct();
    displayProduct(data);
    loading.style.display = 'none';
}

const fetchProduct = async()=>{
    let id = window.location.search;
    const reponse = await fetch(singleProductUrl + id);
    const data = await reponse.json();
    return data;
}

const displayProduct = (product)=>{
    console.log(product);
    const {colors, company, description:desc, name, price} = product.fields;
    const img = product.fields.image[0].thumbnails.full.url;
    pageTitleDOM.textContent = `home / ${name}`;
    imgDOM.src = img;
    titleDOM.textContent = name;
    companyDOM.textContent = `by ${company}`;
    priceDOM.textContent = formatPrice(price)
    colorsDOM.innerHTML = colors.map(color =>{
        return `
            <span class="single-product-color" style="background-color:${color};"></span>
        `
    }).join('');
    descDOM.textContent = desc;
    cartBtn.addEventListener('click', (e)=>{
        if(e.currentTarget.classList.contains('addToCartBtn')){
            addToCart(product.id);
        }
    })
}

init();