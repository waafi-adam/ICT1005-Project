const getElement = (selection) => {
  const element = document.querySelector(selection);
  if (element) return element;
  throw new Error(`Please check "${selection}" selector, no such element exist`);
};

const getStorageItem = (key) => {
  let value = localStorage.getItem(key);
  if(value){
    return JSON.parse(value);
  } else {
    value = [];
  }
  return value;
};

const setStorageItem = (key, value) => {localStorage.setItem(key, JSON.stringify(value))};

export {
    getElement,
    getStorageItem,
    setStorageItem
}

