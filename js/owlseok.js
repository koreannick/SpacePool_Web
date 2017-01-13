
$(document).ready(function() {
	var owl = $('.owl-carousel');
	owl.owlCarousel({
		items: 1,
		loop: true,
		margin: 0,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: false,
		animateOut: 'fadeOutLeft',
		animateIn: 'fadeInRight',
		slideSpeed : 2000,
		paginationSpeed : 2000,
		rewindSpeed : 2000,
		lazyEffect : "fade"

	});
	$('.play').on('click', function() {
		owl.trigger('play.owl.autoplay', [1000])
	})
	$('.stop').on('click', function() {
		owl.trigger('stop.owl.autoplay')
	})

})

$(document).ready(function() {
	var owl2 = $('.owl-carousel2');
	owl2.owlCarousel({
		items: 1,
		loop: true,
		margin: 0,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: false,
		animateOut: 'flipOutY',
		animateIn: 'flipInY',
		lazyEffect : "fade"
	});
	$('.play').on('click', function() {
		owl2.trigger('play.owl.autoplay', [1000])
	})
	$('.stop').on('click', function() {
		owl2.trigger('stop.owl.autoplay')
	})

})
