
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

//LETS CREATE SMOOTH SCROLL DOWN
