import { getStorageItem, setStorageItem } from '../utils.js';

let products = getStorageItem('products');

const findProduct = (id) => {
    const newCartItem = product.find(product => product.productID == id);
    return newCartItem;
};

export { products , findProduct };
