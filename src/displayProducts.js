import { singleProductUrl, formatPrice } from './utils.js';
import { addToCart } from './cart/setupCart.js';
const display = (products, element, isFilter) => {
    element.innerHTML = products.map(product =>{
        const {id, img, name, price} = product;
        return `
            <!-- single product -->
            <article class="product">
            <div class="product-container">
                <img src="${img}" alt="${name}-img" class="product-img img">
                <div class="product-icons">
                    <a href="product.html?id=${id}" class="product-icon">
                        <i class="fas fa-search"></i>
                    </a>
                    <button class="product-cart-btn product-icon ${id}" data-id="${id}">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>
            <footer>
                <h5 class="product-name">${name}</h5>
                <span class="product-price">${formatPrice(price)}</span>
            </footer>
            </article>
            <!-- end of single product -->
        `
    }).join('');

    if(isFilter)return;
    element.addEventListener('click', e=>{
        const parent = e.target.parentElement;
        if(parent.classList.contains('product-cart-btn')){
            addToCart(parent.dataset.id);
        }
    })
};



export default display;
