/* Contact Form Dynamic */

$(function() {

	// Get the form.
	var form = $('#contact-form');

	// Get the messages div.
	var formMessages = $('.form-messege');

	// Set up an event listener for the contact form.
	$(form).submit(function(e) {
		// Stop the browser from submitting the form.
		e.preventDefault();

		// Serialize the form data.
		var formData = $(form).serialize();

		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData
		})
		.done(function(response) {
			// Make sure that the formMessages div has the 'success' class.
			$(formMessages).removeClass('error');
			$(formMessages).addClass('success');

			// Set the message text.
			$(formMessages).text(response);

			// Clear the form.
			$('#contact-form input,#contact-form textarea').val('');
		})
		.fail(function(data) {
			// Make sure that the formMessages div has the 'error' class.
			$(formMessages).removeClass('success');
			$(formMessages).addClass('error');

			// Set the message text.
			if (data.responseText !== '') {
				$(formMessages).text(data.responseText);
			} else {
				$(formMessages).text('Oops! An error occured and your message could not be sent.');
			}
		});
	});

});

    const container = document.querySelector('.slide-container');
const slides = document.querySelectorAll('.slide');
const btns = document.querySelectorAll('.btnt');
const btnPrev = document.querySelector('.btn-prev');
const btnNext = document.querySelector('.btn-next');

const n = slides.length;
const angle = 360 / n;

let setId = 0;
let deg = [];
let x = 0;
let y = 0;

const touchDevice = () => ('ontouchstart' in document.documentElement);
const setTransition = (time) => {
  let i = 0;
  for (; i < n; i++) slides[i].style.transition = `all ${0.4}s`;
}
const positionSlides = () => {
  const r = container.offsetWidth / 2;
  let i = 0;

  setTransition('0');

  for (; i < n; i++) {
    deg[i] = i * angle;
    x = Math.cos(deg[i] * (Math.PI / 180)) * r + r;
    y = Math.sin(deg[i] * (Math.PI / 180)) * r + r;

      // slides[i].style.top = `${~~y}px`;
      // slides[i].style.left = `${~~x}px`;
  }

  // setTimeout(() => {
  //   setTransition('.3');
  // }, 10);
}
const prevSlide = () => {
  let i = 0;
  for (; i < n; i++) deg[i] -= angle;
  animateSlide();
}
const nextSlide = () => {
  let i = 0;
  for (; i < n; i++) deg[i] += angle;
  animateSlide();
}
const animateSlide = () => {
  const r = container.offsetWidth / 2;
  let i = 0;

  for (; i < n; i++) {
    x = Math.cos(deg[i] * (Math.PI / 180)) * r + r;
    y = Math.sin(deg[i] * (Math.PI / 180)) * r + r;

    slides[i].style.top = `${~~y}px`;
    slides[i].style.left = `${~~x}px`;

    y === 0 ? slides[i].classList.add('active') : slides[i].classList.remove('active');
  }

  const activeSlide = document.querySelector('.slide.active');
  const slideBgImg = getComputedStyle(activeSlide).backgroundImage;

  // container.style.backgroundImage = slideBgImg;
}
// const autoPlay = () => setId = setInterval(nextSlide, 3000);
const changeSlideImg = (e) => {
  let i = 0;
  for (; i < n; i++) slides[i].classList.remove('active');
  e.currentTarget.classList.add('active');

  // const activeSlide = document.querySelector('.slide.active');
  // const slideBgImg = getComputedStyle(activeSlide).backgroundImage;

  // container.style.backgroundImage = slideBgImg;
}

positionSlides();
nextSlide();
// autoPlay();

btnPrev.addEventListener('click', prevSlide);
btnNext.addEventListener('click', nextSlide);
btns.forEach(btn => {
  btn.addEventListener('mouseenter', () => clearInterval(setId));
  btn.addEventListener('mouseleave', () => {
    clearInterval(setId);
    // autoPlay();
  });
})
slides.forEach(slide => {
  if (touchDevice()) {
    slide.addEventListener('click', (e) => {
      changeSlideImg(e);
      clearInterval(setId);
      // autoPlay();
    });
  }
  else {
    slide.addEventListener('mouseenter', (e) => {
      changeSlideImg(e);
      clearInterval(setId);
    });
    slide.addEventListener('mouseleave', () => {
      clearInterval(setId);
      // autoPlay();
    });
  }
})
window.addEventListener('resize', () => {
  clearInterval(setId);
  positionSlides();
  // autoPlay();
})


