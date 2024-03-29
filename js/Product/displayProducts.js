import { addToCart } from '../cart/setupCart.js';

console.log("hello");

const display = (products, element, isFilter) => {
    element.innerHTML = products.map(product =>{
        //const {id, img, name, price} = product;
        return `
            <!-- single product -->
            <article class="product">
            <div class="product-container">
                <img src="${product.productImagePath}" alt="${product.productName}-img" class="product-img img">
                <div class="product-icons">
                    <a href="product.php?id=${product.productID}" class="product-icon" aria-label="View Product Details">
                        <i class="fas fa-search"></i>
                    </a>
                    <button class="product-cart-btn product-icon ${product.productID}" data-id="${product.productID}" aria-label="Add to Cart">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>
            <footer>
                <h4 class="product-name">${product.productName}</h4>
                <span class="product-price">${product.productPrice}</span>
            </footer>
            </article>
            <!-- end of single product -->
        `
    }).join('');

    if(isFilter)return;
    element.addEventListener('click', e=>{
        const parent = e.target.parentElement;
        if(parent.classList.contains('product-cart-btn')){
            console.log(parent.dataset.id)
            addToCart(parent.dataset.id);
        }
    })
};



export default display;
