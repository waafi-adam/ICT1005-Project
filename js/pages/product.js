// global imports
//import '../toggleSidebar.js';
import '../cart/toggleCart.js';
import '../cart/setupCart.js';

// specific
import { addToCart } from '../cart/setupCart.js';
import { getElement } from '../utils.js';

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
<<<<<<< HEAD
    displayProduct(data);
    const review = await fetchReview();
    //displayReview(review);
=======
    console.log(data);
    await displayProduct(data);
>>>>>>> 85b98549021d1d7b356298d01275acd4c1cef615
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
    console.log("test: "+JSON.stringify(resp));
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