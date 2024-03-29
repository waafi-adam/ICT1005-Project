// global imports
import '../toggleSidebar.js';
import '../cart/toggleCart.js';
import '../cart/setupCart.js';


// specific
import { addToCart } from '../cart/setupCart.js';
import { singleProductUrl ,getElement } from '../utils.js';
import {displayReviews} from '../review/review.js';

// selections
const loading = getElement('.page-loading');
const centerDOM = getElement('.single-product-center');
const pageTitleDOM = getElement('.page-hero-title');
const imgDOM = getElement('.single-product-img');
const titleDOM = getElement('.single-product-title');
const companyDOM = getElement('.single-product-company');
const priceDOM = getElement('.single-product-price');
const descDOM = getElement('.single-product-desc');
const cartBtn = getElement('.addToCartBtn');




const init = async()=>{
    const data = await fetchProduct();
    await displayProduct(data);
    
    const review = await fetchReview();
    displayReviews(review);
    loading.style.display = 'none';
};

const postData = async(url, data) =>{
    const resp = await fetch(url, {
        method: 'POST',
        body: data
    });
    return resp.json();
};

//fetch product
const fetchProduct = async()=>{
    let id = window.location.search.split('id=')[1];
    
    let formData = new FormData();
    formData.set("productID", id);
    
    const data = await postData(singleProductUrl, formData);
    
    return data[0];
};

//fetch review
const fetchReview = async()=>{
    let id = window.location.search.split('id=')[1];
    let formData = new FormData();
    formData.set("productID", id);
    
    const resp = await postData('../../process_getReview.php', formData);
    console.log(resp);
    
    console.log("test: "+JSON.stringify(resp));
    return resp;
};

const displayProduct = (product)=>{
    console.log(product.productName);
    pageTitleDOM.textContent = `home / ${product.productName}`;
    imgDOM.src = product.productImagePath;
    titleDOM.textContent = product.productName;
    companyDOM.textContent = `by ${product.productCompany}`;    
    priceDOM.textContent = `$${product.productPrice}`;
    descDOM.textContent = product.productDescription;
    cartBtn.addEventListener('click', (e)=>{
        if(e.currentTarget.classList.contains('addToCartBtn')){
            addToCart(product.productID);
        }
    });
};

init();