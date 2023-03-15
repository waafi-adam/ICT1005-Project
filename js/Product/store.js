import { getStorageItem, setStorageItem } from '../utils.js';

let store = getStorageItem('store');
let product = getStorageItem('product');

const setupStore = (products) => {
    store = products.map(product =>{
        const {id, fields:{colors, company, name, price, featured}} = product;
        const img = product.fields.image[0].thumbnails.full.url;
        return {id, colors, company, name, price, featured, img};
    });
    setStorageItem('store', store);
};
const findProduct = (id) => {
    const newCartItem = product.find(product => product.productID == id);
    return newCartItem;
};

export { store, product , setupStore, findProduct };
