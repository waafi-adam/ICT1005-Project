const items = [...document.querySelectorAll('section.numbers .number')];

const updateCount = (el, num) => {
  const value = parseInt(num);
  const increment = Math.ceil(value / 1000);
  // const increment = 1;
  let initialValue = 0;

  const increaseCount = setInterval(() => {
    initialValue += increment;

    if (initialValue > value) {
      el.textContent = `${value}+`;
      clearInterval(increaseCount);
      return;
    }

    el.textContent = `${initialValue}+`;
  }, 100);
  // console.log(increaseCount);
};
export const animateNumbersSection = async(products) => {
    
    // Find the number of products sold
    const resp = await fetch('process_getOrders.php');
    const orders = await resp.json();
    const soldCount = orders.reduce((acc, order) => acc + order.orderQuantity, 0);
    // Find the number of product companies
    const companyCount = new Set(products.map(p => p.productCompany)).size;
    // Find the number of available products
    const productCount = products.length;
    
    const nums = [soldCount, companyCount, productCount];
    
    for (let i=0; i<3; i++)updateCount(items[i], nums[i]);
}
