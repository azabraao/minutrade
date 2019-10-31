const nav = {
  menu: null,
  hamburguer: null,
  init() {
    nav.hamburguer = document.querySelector('.jsToggleMenu');
    nav.hamburguer.addEventListener('click', nav.toggleMenu );
    nav.menu = document.querySelector('.jsMenu');
  },
  toggleMenu() {
    nav.menu.classList.toggle('active');
  }
}

const slide = {
  init() {
    // console.log('aaslkdj');
    $('.jsSlide').slick({
      prevArrow: $('.jsPrevArrow'),
      nextArrow: $('.jsNextArrow'),
      slidesToShow: 8,
      responsive: [
        {
          breakpoint: 1000,
          settings: {
            slidesToShow: 5
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });
    $('.jsSociosSlide').slick({
      prevArrow: $('.jsSociosSlideArrowLeft'),
      nextArrow: $('.jsSociosSlideArrowRight'),
      slidesToShow: 2,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });
  }
}

slide.init();
nav.init();