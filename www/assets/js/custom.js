$(document).ready(function() {

	// #################################
	// LOGIN SLIDE
	// #################################
	$("#login-slider").hide();

	$("a.login").toggle(function(){
		$(this).addClass("active");
		}, function () {
		$(this).removeClass("active");
	});

	$("a.login, #login-slider a.close").click(function(){
		$("#login-slider").slideToggle();
	});
	// #################################
	// CONVERSIAN SLIDE
	// #################################
	$("#con-slider").hide();

	$("a.con").toggle(function(){
		$(this).addClass("active");
		}, function () {
		$(this).removeClass("active");
	});

	$("a.con, #con-slider a.close").click(function(){
		$("#con-slider").slideToggle();
	});

	$('#con-slider #cphone').mask("+7 (999)999-99-99", {placeholder: "."});

	// #################################
	// Клиенты
	// #################################
	$(".faceblock").hover(function () {
		$(this).find('div.faceinfo').fadeIn("fast");
		},
		function() {
			$(this).find('div.faceinfo').fadeOut("fast");
		})

	// #################################
	// TOOLTIP
	// #################################
	$('.ttip').tipsy({delayIn: 0, delayOut: 0});
	// #################################
	// Категории
	// #################################
	$('.latest.news ul li').hover(function() {
			$(this).stop().animate({ paddingLeft: '10px' }, 300);
		}, function() {
			$(this).stop().animate({ paddingLeft: 0 }, 300);
	});

	// #################################
	// Deus
	// #################################
	$('.clubinfo').hover(function() {
				$(this).stop().animate({ marginLeft: '10px' }, 300);
		}, function() {
			$(this).stop().animate({ marginLeft: 0 }, 300);
	});
	$('.cateinfo').hover(function() {
				$(this).stop().animate({ paddingRight: '65px' }, 300);
		}, function() {
			$(this).stop().animate({ paddingRight: 0 }, 300);
	});
	$('.veryluckycon2').hover(function() {
				$(this).stop().animate({ paddingRight: '65px' }, 300);
		}, function() {
			$(this).stop().animate({ paddingRight: 0 }, 300);
	});

		// #################################
		// Консультант
		// #################################
		$('.veryluckycon1').hover(function() {
					$(this).stop().animate({ paddingTop: '55px' }, 300);
			}, function() {
				$(this).stop().animate({ paddingTop: 0 }, 300);
		});
		$('.veryluckycon2').hover(function() {
					$(this).stop().animate({ paddingRight: '65px' }, 300);
			}, function() {
				$(this).stop().animate({ paddingRight: 0 }, 300);
		});
		$('.getetweb-index-speed').hover(function() {
					$(this).stop().animate({ paddingTop: '157px' }, 300);
			}, function() {
				$(this).stop().animate({ paddingTop: 0 }, 300);
		});
	// #################################
	// Вакансии
	// #################################
	$(".toggle_div").hide();

	$("h6.toggle").toggle(function(){
		$(this).addClass("active");
		}, function () {
		$(this).removeClass("active");
	});

	$("h6.toggle").click(function(){
		$(this).next(".toggle_div").slideToggle();
	});

	// #################################
	// Туглы
	// #################################
	$(".toggle2_div").hide();

	$("h6.toggle2").toggle(function(){
		$(this).addClass("active");
		}, function () {
		$(this).removeClass("active");
	});

	$("h6.toggle2").click(function(){
		$(this).next(".toggle2_div").slideToggle();
	});
	// #################################
	// Табы
	// #################################
	$("#tabs").tabs();
	$("#tabs2").tabs();
	$("#tabs3").tabs();
	$("#tabs4").tabs();
	$("#tabs13").tabs();



	// #################################
	// PAGENAV CLICK
	// #################################
	$(".submenu li").click(function () {
		$(".submenu li").removeClass("current", 1000);
		$(this).addClass("current", 1000);
     });



  // #################################
  // Fancybox
  // #################################

  $("a#screenshot").fancybox({

				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'titlePosition'		: 'outside',
				'overlayColor'		: '#333',
				'overlayOpacity'	: 0.9,

  });
  $("a[rel=screenshot_group]").fancybox({
  				'transitionIn'	: 'elastic',
  				'transitionOut'	: 'elastic',
				'titlePosition'		: 'outside',
				'overlayColor'		: '#333',
				'overlayOpacity'	: 0.9,
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

					return '<span id="fancybox-title-outside">Изображение ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

				}

			});
	$("a[rel=screenshot_group2]").fancybox({
  				'transitionIn'	: 'elastic',
  				'transitionOut'	: 'elastic',
				'titlePosition'		: 'outside',
				'overlayColor'		: '#333',
				'overlayOpacity'	: 0.9,
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

					return '<span id="fancybox-title-outside">Изображение ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

				}

			});
	$("a[rel=screenshot_group3]").fancybox({
  				'transitionIn'	: 'elastic',
  				'transitionOut'	: 'elastic',
				'titlePosition'		: 'outside',
				'overlayColor'		: '#333',
				'overlayOpacity'	: 0.9,
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

					return '<span id="fancybox-title-outside">Изображение ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

				}

			});
	$("a[rel=screenshot_group4]").fancybox({
  				'transitionIn'	: 'elastic',
  				'transitionOut'	: 'elastic',
				'titlePosition'		: 'outside',
				'overlayColor'		: '#333',
				'overlayOpacity'	: 0.9,
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

					return '<span id="fancybox-title-outside">Изображение ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

				}

			});
	$("a[rel=screenshot_group5]").fancybox({
  				'transitionIn'	: 'elastic',
  				'transitionOut'	: 'elastic',
				'titlePosition'		: 'outside',
				'overlayColor'		: '#333',
				'overlayOpacity'	: 0.9,
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

					return '<span id="fancybox-title-outside">Изображение ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

				}

			});
	$("a[rel=screenshot_group6]").fancybox({
  				'transitionIn'	: 'elastic',
  				'transitionOut'	: 'elastic',
				'titlePosition'		: 'outside',
				'overlayColor'		: '#333',
				'overlayOpacity'	: 0.9,
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

					return '<span id="fancybox-title-outside">Изображение ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

				}

			});
	$("a[rel=screenshot_group7]").fancybox({
  				'transitionIn'	: 'elastic',
  				'transitionOut'	: 'elastic',
				'titlePosition'		: 'outside',
				'overlayColor'		: '#333',
				'overlayOpacity'	: 0.9,
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

					return '<span id="fancybox-title-outside">Изображение ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

				}

			});
	$("a[rel=screenshot_group8]").fancybox({
  				'transitionIn'	: 'elastic',
  				'transitionOut'	: 'elastic',
				'titlePosition'		: 'outside',
				'overlayColor'		: '#333',
				'overlayOpacity'	: 0.9,
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

					return '<span id="fancybox-title-outside">Изображение ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

				}

			});
	$("a[rel=screenshot_group9]").fancybox({
  				'transitionIn'	: 'elastic',
  				'transitionOut'	: 'elastic',
				'titlePosition'		: 'outside',
				'overlayColor'		: '#333',
				'overlayOpacity'	: 0.9,
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

					return '<span id="fancybox-title-outside">Изображение ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

				}

			});
	$("a[rel=screenshot_group10]").fancybox({
  				'transitionIn'	: 'elastic',
  				'transitionOut'	: 'elastic',
				'titlePosition'		: 'outside',
				'overlayColor'		: '#333',
				'overlayOpacity'	: 0.9,
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

					return '<span id="fancybox-title-outside">Изображение ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

				}

			});
	// #################################
	// Кнопка вверх и прыжки по якорям
	// #################################
	jQuery('.backtotop').click(function(){
		jQuery('html, body').animate({scrollTop:0}, 'slow');
	});
	jQuery('.eff').click(function(){
		jQuery('html, body').animate({scrollTop:1150}, 'slow');
	});
$(document).ready(function(){
  $(".scroll").click(function(event){
    event.preventDefault();
    var offset = $($(this).attr('href')).offset().top;
    $('html, body').animate({scrollTop:offset}, 500);
  });
});


	// #################################
	// ROYAL SLIDER
	// #################################
	jQuery(document).ready(function($) {
	$('#banner-rotator').royalSlider({
   		imageAlignCenter:true,
   		hideArrowOnLastSlide:false,
   		controlNavEnabled: true,
   		slideshowEnabled: true,
   		slideshowDelay: 6000,
   		slideSpacing:20
    });
var clientsbanner1 = $('#clientsbanner1').royalSlider({
			slideTransitionType: "fade",
   			slideTransitionSpeed: 1200,
  			slideTransitionEasing: "easeInOutSine",
			captionShowEffects: ["moveleft", "fade"],
			captionShowDelay: 150,
			captionShowSpeed: 400,
 			captionShowEasing: "easeOutBack",
			directionNavEnabled: false,
			slideshowEnabled: true,
			slideshowDelay: 2000
	    }).data("royalSlider");
 });
	var clientsbanner2 = $('#clientsbanner2').royalSlider({
				slideTransitionType: "fade",
	   			slideTransitionSpeed: 600,
	  			slideTransitionEasing: "easeInOutSine",
				captionShowEffects: ["moveleft", "fade"],
				captionShowDelay: 150,
				captionShowSpeed: 400,
	 			captionShowEasing: "easeOutBack",
				directionNavEnabled: false,
				slideshowEnabled: true,
				slideshowDelay: 2000
		    }).data("royalSlider");

});

// C Вами был Рубен Акопян. Смотрите нашу передачу как обычно по вторника в 15:00.

$(window).load(function() {
	var $deusex = $('.deusexmachina');

	if ($deusex.size() > 0) {
// 		var $lastNews = $('.lastNews');

// 		if ($lastNews.size() > 0) {
// 			$lastNews.prependTo($deusex);
// 		} else {

// 			$.post('ajax/getlastnews', {}, function(json) {
// 				console.log(json);
// 				$("<div class=\"sempermachina purple\">\
// 		              <h5>Последняя новость</h5>\
// 					  <h4><a href=\"" + json.url + "\">" + json.title + "</a></h4>\
// 								  <em>" + json.annotation + "</em>\
// 					</div>"
// 				).prependTo($deusex);
// 			}, 'json');
// 		}
		var $banners = $('.bannersrotatoritem');
		$banners.each(function() {
			$(this).appendTo($deusex);
		})
	}



})