const items = [...document.querySelectorAll('section.numbers .number')];

const updateCount = (el) => {
  const value = parseInt(el.dataset.value);
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
  }, 1);
  // console.log(increaseCount);
};

export const animateNumbersSection = () => {
    items.forEach((item) => updateCount(item));
}

