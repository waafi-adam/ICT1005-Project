import { getStorageItem, setStorageItem } from '../utils.js';

let product = getStorageItem('product');

const findProduct = (id) => {
    const newCartItem = product.find(product => product.productID == id);
    return newCartItem;
};

export { store, product , setupStore, findProduct };
