
// LETS CREATE SWIPER
var swiper = new Swiper('.swiper', {
    slidesPerView: 3,
    spaceBetween: 15,
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });

//LETS CREATE BUTTON QUANTITY FOR CART
// const minusButton = document.querySelector('#btnminus');
// const plusButton = document.querySelector('#btnplus');
// const inputField = document.querySelector('#inputQty');

// minusButton.addEventListener('click', event => {
//   event.preventDefault();
//   const currentValue = Number(inputField.value) || 0;
//   inputField.value = currentValue - 1;
// });

// plusButton.addEventListener('click', event => {
//   event.preventDefault();
//   const currentValue = Number(inputField.value) || 0;
//   inputField.value = currentValue + 1;
// });
