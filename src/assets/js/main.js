const nav = {
  menu: null,
  hamburguer: null,
  init() {
    nav.hamburguer = document.querySelector('.jsToggleMenu');
    nav.hamburguer.addEventListener('click', nav.toggleMenu);
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

const newsletter = {
  input: null,
  button: null,
  init() {
    newsletter.input = document.querySelector('.jsEmailNewsletter');
    newsletter.button = document.querySelector('.jsSendNewsletter');
    
    newsletter.input.addEventListener('keypress', newsletter.handleKeyPress );
    newsletter.button.addEventListener('click', newsletter.handleButtonClick )
  },
  handleKeyPress(e) {
    if(e.keyCode === 13) {
      newsletter.handleButtonClick();
    }
  },
  handleButtonClick() {
    $.ajax({
      method: "get",
      url: "mail/newsletter.php",
      data: { email: newsletter.input.value },
    });

    newsletter.setButtonAsLoading();
    
    setTimeout(() => {
      newsletter.setButtonAsSuccess();
      newsletter.clearInput();
    },2000);
    
    setTimeout(() => {
      newsletter.resetButton();
    },3000);
  },
  clearInput() {
    newsletter.input.value = "";
  },
  setButtonAsLoading() {
    newsletter.button.textContent = "";
    newsletter.button.innerHTML = "<img src='assets/img/loading.gif'/>"
  },
  setButtonAsSuccess() {
    // newsletter.button.style.transition = "all .5s";
    newsletter.button.style.background = "#599a4d";
    newsletter.button.textContent = "Inscrito!"
  },
  resetButton() {
    newsletter.button.textContent = "Enviar";
    newsletter.button.style.background = "#00407b";
  }
}


const contactForm = {
  button: null,
  init() {
    contactForm.button = document.querySelector('.jsButtonFormContact');
    contactForm.button.addEventListener('click', contactForm.handleButtonClick );
  },
  handleButtonClick(e) {
    e.preventDefault();
    $.ajax({
      method: "get",
      url: "mail/form-contato.php",
      data: $('.jsFormContact').serialize(),
    });

    contactForm.setButtonAsLoading();
    
    setTimeout(() => {
      contactForm.setButtonAsSuccess();
    },2000);
    
    setTimeout(() => {
      contactForm.resetButton();
    },3000);
  },
  setButtonAsLoading() {
    contactForm.button.textContent = "";
    contactForm.button.innerHTML = "<img src='assets/img/loading.gif'/>"
  },
  setButtonAsSuccess() {
    contactForm.button.textContent = "Inscrito!"
  },
  resetButton() {
    contactForm.button.textContent = "Enviar";
    contactForm.button.style.background = "#00407b";
  }
}

newsletter.init();
contactForm.init();
slide.init();
nav.init();