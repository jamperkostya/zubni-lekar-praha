const langBtn = document.querySelector('.header__language-active');
const langParent = langBtn.parentElement;
const langMenu = langParent.querySelector('.header__language-switcher');

// Открытие/закрытие по кнопке
langBtn.addEventListener('click', () => {
	langParent.classList.toggle('open');
});

// Закрытие по клику на пустое место меню, но не по ссылке
langMenu.addEventListener('click', (e) => {
	if (e.target === langMenu) { // только если клик по самому UL
		langParent.classList.remove('open');
	}
});

// animation for faq block
document.querySelectorAll('.faq__item__question').forEach(button => {
	button.addEventListener('click', () => {
		const item = button.closest('.faq__item');
		item.classList.toggle('open');
	});
});
// animation for faq block

// glider js - carouse for testimonials
window.addEventListener('load', function(){
	const gliderTestimonals = document.querySelector('.glider-testimonals');
	if (gliderTestimonals) {
		new Glider(gliderTestimonals, {
			slidesToScroll: 1,
			slidesToShow: 1.3,
			draggable: true,
			dots: '.dots',
			responsive: [
				{
				  // screens greater than >= 775px
				  breakpoint: 992,
				  settings: {
					// Set to `auto` and provide item width to adjust to viewport
					slidesToShow: 2.8,
					slidesToScroll: 'auto',
				  }
				}
			  ]
		});
	}
	
	const gliderSingleDoctor = document.querySelector('.glider-single-doctor');
	if (gliderSingleDoctor) {
		new Glider(gliderSingleDoctor, {
			slidesToScroll: 1,
			slidesToShow: 1,
			draggable: true,
			dots: '.dots-signle',
		});
	}
})
// glider js - carouse for testimonials

jQuery(function($){
	// click for show-more for seo text block
	$('.show-more').on('click', function() {
		const $btn = $(this);
		const $block = $btn.prev('.seo-block');  // берём предыдущий .seo-block
		
		if ($block.hasClass('open')) {
			// сворачиваем
			$block.removeClass('open');
			$btn.removeClass('open').text($btn.data('close'));
		} else {
			// разворачиваем
			$block.addClass('open');
			$btn.addClass('open').text($btn.data('open'));
		}
	});
	// end click for show-more for seo text block
	
	$("select").tinyselect({ showSearch: false });
})

document.addEventListener('scroll', function() {
	const header = document.querySelector('.header');

	if (window.scrollY > 150) {  // можно менять порог
		header.classList.add('scrolled');
	} else {
		header.classList.remove('scrolled');
	}
});


// 1. JSON-стиль, который мы сгенерировали
const customMapStyle = [
  {
	"featureType": "all",
	"elementType": "labels",
	"stylers": [
	  { "visibility": "off" }
	]
  },
  {
	"featureType": "landscape",
	"elementType": "geometry",
	"stylers": [
	  { "color": "#ffffff" }
	]
  },
  {
	"featureType": "poi",
	"stylers": [
	  { "visibility": "off" }
	]
  },
  {
	"featureType": "road",
	"elementType": "geometry",
	"stylers": [
	  { "color": "#f5f5f5" }
	]
  },
  {
	"featureType": "road",
	"elementType": "labels.icon",
	"stylers": [
	  { "visibility": "off" }
	]
  },
  {
	"featureType": "transit",
	"stylers": [
	  { "visibility": "off" }
	]
  },
  {
	"featureType": "water",
	"elementType": "geometry",
	"stylers": [
	  { "color": "#ffffff" }
	]
  }
];

// 2. Функция инициализации карты
function initMap(mapId, lat, lng) {
	const mapContainer = document.getElementById(mapId);
	if (!mapContainer) return; // Если div нет — просто пропускаем

	const mapCenter = { lat: lat, lng: lng };

	const map = new google.maps.Map(mapContainer, {
		center: mapCenter,
		zoom: 18,
		styles: customMapStyle,
		zoomControl: true,
		fullscreenControl: true, 
		scaleControl: true, 
	});

	new google.maps.Marker({
		position: mapCenter,
		map: map,
		title: "Моя точка!",
		icon: "/wp-content/themes/promag-dental-3.0/assets/images/map-marker.png",
	});
}
// Инициализация только тех карт, чьи div реально существуют
function initMaps() {
	initMap("mapStodulky", 50.0456523, 14.3117769);
	initMap("mapHurky", 50.0493344, 14.3465086);
}

// add disabled attributes for inputs when form submitting
document.addEventListener('wpcf7beforesend', function(event) {
	const form = event.target;
	const elements = form.querySelectorAll('input, textarea, button, select');
	elements.forEach(el => el.setAttribute('disabled', 'disabled'));
	form.classList.add('is-loading'); // для визуального состояния
}, false);
// add disabled attributes for inputs when form submitting

// work when form submited and remove disabled attributes for inputs
document.addEventListener('wpcf7submit', function (event) {
	const form = event.target;
	const elements = form.querySelectorAll('input, textarea, button, select');
	elements.forEach(el => el.removeAttribute('disabled'));
	form.classList.remove('is-loading');
	
	const response = event.detail.apiResponse; // тут текст CF7 ответа
	showToast(response.message, event.detail.apiResponse.status);
}, false);
// end work when form submited and remove disabled attributes for inputs

// show toast
function showToast(message, type = 'info') {
	const toast = document.createElement('div');
	toast.className = 'custom-toast ' + type;
	toast.textContent = message;

	document.body.appendChild(toast);

	setTimeout(() => toast.classList.add('show'), 10);
	setTimeout(() => {
		toast.classList.remove('show');
		setTimeout(() => toast.remove(), 300);
	}, 3000);
}
// end show toast

// show modal form with appointment form
document.addEventListener('DOMContentLoaded', function() {
	const modalEl = document.getElementById('appointmentModal');

	const appointmentButtons = document.querySelectorAll('.appointment-button, .appointment-button-mobile');
	appointmentButtons.forEach(btn => {
		btn.addEventListener('click', () => {
			const modal = new bootstrap.Modal(modalEl);
			modal.show();
		});
	});
});
// end show modal form with appointment form

// mobile menu
document.addEventListener('DOMContentLoaded', function() {
	const menuButton = document.querySelector('.mobile-menu-icon');
	const menu = document.querySelector('.mobile-menu__container');
	const body = document.body;
	
	// Устанавливаем начальное состояние меню
	menu.style.display = 'none';
	menu.style.transform = 'translateY(-100%)';
	menu.style.transition = 'transform 0.3s ease-in-out';
	
	menuButton.addEventListener('click', function() {
		if (menu.style.display === 'none') {
			// Открываем меню
			menu.style.display = 'block';
			body.classList.add('menu-shown');	
			// Небольшая задержка для применения transition
			setTimeout(() => {
				menu.style.transform = 'translateY(0)';
			}, 10);
			menuButton.classList.add('active');
		} else {
			// Закрываем меню
			menu.style.transform = 'translateY(-100%)';
			menuButton.classList.remove('active');
			body.classList.remove('menu-shown');
			// Скрываем меню после завершения анимации
			setTimeout(() => {
				menu.style.display = 'none';
			}, 300);
		}
	});
});
// mobile menu
(function ($) {
  function initPhoneInput($input) {
	// Защита от повторной инициализации
	if ($input.data('phone-init')) return;
	$input.data('phone-init', true);

	$input.on('keypress', function (e) {
	  if (!/\d/.test(e.key)) {
		e.preventDefault();
	  }
	});

	$input.on('input paste', function () {
	  const pos = this.selectionStart;
	  this.value = this.value.replace(/\D/g, '').slice(0, 12);
	  this.setSelectionRange(pos, pos);
	});
  }

  function initAllPhoneInputs() {
	// Ищем все поля по классу — работает для любого количества форм
	$('.phone-input').each(function () {
	  initPhoneInput($(this));
	});
  }

  $(document).ready(initAllPhoneInputs);

  // CF7 перерендеривает форму после отправки — переинициализируем
  $(document).on('wpcf7:init', initAllPhoneInputs);

})(jQuery);