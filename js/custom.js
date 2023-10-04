jQuery(document).ready(function() {

	if ( top.location.pathname !== '/landing/' ) {
    	// Mobile menu
		// Grab HTML Elements
		const btnWrap = document.querySelector(".mobile-menu-wrapper");
		const btn = document.querySelector("button.mobile-menu-button");
		const menu = document.querySelector(".mobile-menu");
		const overlay = document.querySelector(".overlay");
		const close = document.querySelector(".mobile-menu .close");

		// Search box
		btn.addEventListener("click", () => {
			btnWrap.classList.toggle("menu-open");
			menu.classList.toggle("slide-close");
			overlay.classList.toggle("hidden");
		});
		overlay.addEventListener("click", () => {
			btnWrap.classList.toggle("menu-open");
			menu.classList.toggle("slide-close");
			overlay.classList.toggle("hidden");
		});
		close.addEventListener("click", () => {
			btnWrap.classList.toggle("menu-open");
			menu.classList.toggle("slide-close");
			overlay.classList.toggle("hidden");
		});
	}

	// Button append to mobile menu.
	jQuery('.header-buttons')
	.clone()
	.removeClass('hidden xl:flex')
	.addClass('flex mt-6')
	.appendTo('.clone');

    // redirect
    jQuery(".animate-redirect a[href^='#']").click(function(e) {
        e.preventDefault();

        var position = jQuery(jQuery(this).attr("href")).offset().top;

        jQuery("body, html").animate({
            scrollTop: position
        }, 1000);
    });

	jQuery('.profile-slider').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: true,
		dots: false,
		prevArrow: '<div class="w-16 h-10 grid place-content-center bg-blue-medium hover:bg-dark-color rounded-xl transition-all cursor-pointer"><svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.292894 8.70711C-0.0976315 8.31658 -0.0976315 7.68342 0.292894 7.29289L6.65685 0.928932C7.04738 0.538408 7.68054 0.538408 8.07107 0.928932C8.46159 1.31946 8.46159 1.95262 8.07107 2.34315L2.41421 8L8.07107 13.6569C8.46159 14.0474 8.46159 14.6805 8.07107 15.0711C7.68054 15.4616 7.04738 15.4616 6.65685 15.0711L0.292894 8.70711ZM22 9H1V7H22V9Z" fill="white"/></svg></div>',
		nextArrow: '<div class="w-16 h-10 grid place-content-center bg-blue-medium hover:bg-dark-color rounded-xl transition-all cursor-pointer"><svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.7071 8.70711C22.0976 8.31658 22.0976 7.68342 21.7071 7.29289L15.3431 0.928932C14.9526 0.538408 14.3195 0.538408 13.9289 0.928932C13.5384 1.31946 13.5384 1.95262 13.9289 2.34315L19.5858 8L13.9289 13.6569C13.5384 14.0474 13.5384 14.6805 13.9289 15.0711C14.3195 15.4616 14.9526 15.4616 15.3431 15.0711L21.7071 8.70711ZM0 9H21V7H0V9Z" fill="white"/></svg></div>',
		appendArrows: jQuery('.arrows'),
		responsive: [
			{
				breakpoint: 1280,
				settings: {
				  slidesToShow: 2,
				}
			},
			{
				breakpoint: 768,
				settings: {
				  slidesToShow: 1,
				}
			}
		]
	});

	jQuery('.testimonial-slider').slick({
		slidesToShow: 2,
		slidesToScroll: 2,
		arrows: true,
		dots: true,
		prevArrow: '<div class="w-16 h-10 grid place-content-center bg-blue-medium hover:bg-dark-color rounded-xl transition-all cursor-pointer"><svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.292894 8.70711C-0.0976315 8.31658 -0.0976315 7.68342 0.292894 7.29289L6.65685 0.928932C7.04738 0.538408 7.68054 0.538408 8.07107 0.928932C8.46159 1.31946 8.46159 1.95262 8.07107 2.34315L2.41421 8L8.07107 13.6569C8.46159 14.0474 8.46159 14.6805 8.07107 15.0711C7.68054 15.4616 7.04738 15.4616 6.65685 15.0711L0.292894 8.70711ZM22 9H1V7H22V9Z" fill="white"/></svg></div>',
		nextArrow: '<div class="w-16 h-10 grid place-content-center bg-blue-medium hover:bg-dark-color rounded-xl transition-all cursor-pointer"><svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.7071 8.70711C22.0976 8.31658 22.0976 7.68342 21.7071 7.29289L15.3431 0.928932C14.9526 0.538408 14.3195 0.538408 13.9289 0.928932C13.5384 1.31946 13.5384 1.95262 13.9289 2.34315L19.5858 8L13.9289 13.6569C13.5384 14.0474 13.5384 14.6805 13.9289 15.0711C14.3195 15.4616 14.9526 15.4616 15.3431 15.0711L21.7071 8.70711ZM0 9H21V7H0V9Z" fill="white"/></svg></div>',
		appendArrows: jQuery('.testimonial-arrows'),
		responsive: [
			{
				breakpoint: 1024,
				settings: {
				  	slidesToShow: 1,
					slidesToScroll: 1,
				}
			}
		]
	});
	
});

jQuery(document).ready(function() {
	
	const submitIcon = jQuery(".search-icon button");
	const closeIcon = jQuery(".search-box .close");
	const inputBox = jQuery(".search-form .search-input");
	const searchBox = jQuery(".search-box");
	const overlay = jQuery(".search-overlay");
	let isOpen = false;
	
	submitIcon.click(function(e) {
		if (!isOpen) {
			e.preventDefault();
			inputBox.focus();
			searchBox.addClass("search-box-open");
			overlay.removeClass("hidden");
			isOpen = true;
		} else {
			inputBox.focusout();
			searchBox.removeClass("search-box-open");
			overlay.addClass("hidden");
			isOpen = false;
		}
	});
	closeIcon.click(function(e) {
		searchBox.removeClass("search-box-open");
		overlay.addClass("hidden");
		isOpen = false;
	});

	submitIcon.mouseup(function() {
		return false;
	});
	searchBox.mouseup(function() {
		return false;
	});
	jQuery(document).mouseup(function() {
		if (isOpen) {
			inputBox.focusout();
			searchBox.removeClass("search-box-open");
			overlay.addClass("hidden");
			isOpen = false;
		}
	});
	
});

jQuery(document).ready(function() {
	// Get the button:
	let topButton = jQuery('.back-to-top');
	let downArrow = jQuery('.down-arrow');

	// When the user scrolls down 200px from the top of the document, show the button
	window.onscroll = function() {
		scrollFunction()
		scrollFunctionArrow()
	};

	function scrollFunction() {
		if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
			topButton.addClass('grid');
			topButton.removeClass('hidden');
		} else {
			topButton.addClass('hidden');
			topButton.removeClass('grid');
		}
	}
	function scrollFunctionArrow() {
		if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400) {
			downArrow.addClass('hidden');
		} else {
			downArrow.removeClass('hidden');
		}
	}

	// Contact form modal
	const btn = jQuery("a[href^='#modal']");
	const form = jQuery(".contact-form");
	const overlay = jQuery(".modal-overlay");
	const close = jQuery(".contact-form .close");

	// Search box
	btn.click(function(e) {
		e.preventDefault();
		e.stopPropagation();
		form.removeClass("-top-full");
		overlay.removeClass("hidden");
	});
	overlay.click(function() {
		form.addClass("-top-full");
		overlay.addClass("hidden");
	});
	close.click(function() {
		form.addClass("-top-full");
		overlay.addClass("hidden");
	});
});
