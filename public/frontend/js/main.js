(function($) {
	"use strict";
	
	$(".remember-me").click(function() {
		if ($(".remember-me").hasClass("clicked")) {
			$('#remember-check').attr('checked', false);
			$(".remember-me").removeClass("clicked");
		}
		else {
			$('#remember-check').attr('checked', true);
			$(".remember-me").addClass("clicked");
		}
	});

	/*hover menu avec fleche*/
	$(".menu-femme").hover(function() {
		$(".arrow-bottom").trigger('hover');
	});

	/*datepicker*/
	$('.datepicker').datepicker({
		format: "dd-mm-yyyy",
		autoclose: true,
		todayHighlight: true,
		language: 'fr'
	});

	if (jQuery('.delete-btn').length > 0) {
        jQuery('.delete-btn').off('click');
        jQuery('.delete-btn').on('click', function (e) {
            var $form = jQuery(this).closest('form');
            e.preventDefault();
            $('#confirm').modal({backdrop: 'static', keyboard: false})
                .one('click', '#delete', function () {
                    $form.trigger('submit'); // submit the form
                });
        });
    }
	/*----------------------------
	 TOP Menu Stick
	------------------------------ */
	$(window).on('scroll', function() {
		if ($(this).scrollTop() > 240) {
			$('#sticky-header').addClass("sticky");
		}
		else {
			$('#sticky-header').removeClass("sticky");
		}

	});

	/*new menu clickee start*/
	$(".navbar .dropdown").hover(
		function() {
			$('.dropdown-menu', this).stop(true, true).delay(100).fadeIn(200);
		},
		function() {
			$('.dropdown-menu', this).stop(true, true).delay(100).fadeOut(200);
		});
	/*header menu start*/
	$('.header-account li.dropdown').hover(function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn("fast");
	}, function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut("fast");
	});
	/*header menu start*/
	$('.mean-menu li.dropdown').hover(function() {
		$(this).find('.dropdown-menu-menu').stop(true, true).delay(100).fadeIn(200);
	}, function() {
		$(this).find('.dropdown-menu-menu').stop(true, true).delay(100).fadeOut(200);
	});
	/*header menu end*/

	/*----------------------------
     tooltip
    ------------------------------ */
	$('[data-toggle="tooltip"]').tooltip({
		animated: 'fade',
		container: 'body'
	});

	/*----------------------------
	 jQuery MeanMenu
	------------------------------ */
	jQuery('#mobile-menu-active').meanmenu();

	/*----------------------------
	 nivoSlider
	------------------------------ */
	$("#slider").nivoSlider({
		effect: 'fold', // Specify sets like: 'fold,fade,sliceDown' 
		slices: 15, // For slice animations 
		boxCols: 8, // For box animations 
		boxRows: 4, // For box animations 
		animSpeed: 500, // Slide transition speed 
		pauseTime: 3000, // How long each slide will show 
		startSlide: 0, // Set starting Slide (0 index) 
		directionNav: false, // Next & Prev navigation 
		controlNav: true, // 1,2,3... navigation 
		controlNavThumbs: false, // Use thumbnails for Control Nav 
		pauseOnHover: true, // Stop animation while hovering 
		manualAdvance: true, // Force manual transitions 
		prevText: '<i class="fa fa-angle-left"></i>', // Prev directionNav text 
		nextText: '<i class="fa fa-angle-right"></i>', // Next directionNav text 
		randomStart: false, // Start on a random slide 
		beforeChange: function() {}, // Triggers before a slide transition 
		afterChange: function() {}, // Triggers after a slide transition 
		slideshowEnd: function() {}, // Triggers after all slides have been shown 
		lastSlide: function() {}, // Triggers when last slide is shown 
		afterLoad: function() {} // Triggers when slider has loaded 
	});

	/*----------------------------
	 wow js active
	------------------------------ */
	new WOW().init();

	/*----------------------------
	 tab-active
	------------------------------ */
	$(".tab-active").owlCarousel({
		autoPlay: false,
		slideSpeed: 2000,
		pagination: false,
		navigation: true,
		items: 5,
		/* transitionStyle : "fade", */
		/* [This code for animation ] */
		navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		itemsDesktop: [1199, 4],
		itemsDesktopSmall: [980, 3],
		itemsTablet: [768, 1],
		itemsMobile: [479, 1],
	});

	/*----------------------------
	 tab-active2
	------------------------------ */
	$(".tab-active2").owlCarousel({
		autoPlay: false,
		slideSpeed: 2000,
		pagination: false,
		navigation: true,
		items: 4,
		/* transitionStyle : "fade", */
		/* [This code for animation ] */
		navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		itemsDesktop: [1199, 3],
		itemsDesktopSmall: [980, 3],
		itemsTablet: [768, 2],
		itemsMobile: [479, 1],
	});

	/*----------------------------
	 protofolio-active
	------------------------------ */
	$(".protofolio-active").owlCarousel({
		autoPlay: false,
		slideSpeed: 2000,
		pagination: false,
		navigation: true,
		items: 3,
		/* transitionStyle : "fade", */
		/* [This code for animation ] */
		navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		itemsDesktop: [1199, 3],
		itemsDesktopSmall: [980, 3],
		itemsTablet: [768, 2],
		itemsMobile: [479, 1],
	});

	/*----------------------------
	related-products-active
	------------------------------ */
	$(".related-products-active").owlCarousel({
		autoPlay: false,
		slideSpeed: 2000,
		pagination: true,
		navigation: false,
		autoHeight: false,
		items: 5,
		/* transitionStyle : "fade", */
		/* [This code for animation ] */
		navigationText: ["<a class='prev' data-toggle='tooltip'>&nbsp;</a>", "<a class='next' data-toggle='tooltip'>&nbsp;</a>"],
		itemsDesktop: [1199, 4],
		itemsDesktopSmall: [980, 3],
		itemsTablet: [768, 2],
		itemsMobile: [479, 1],
	});

	/*----------------------------
	 brand-active
	------------------------------ */
	$(".brand-active").owlCarousel({
		autoPlay: false,
		slideSpeed: 2000,
		pagination: false,
		navigation: true,
		lazyLoad: true,
		items: 6,
		/* transitionStyle : "fade", */
		/* [This code for animation ] */
		navigationText: ["<a class='prev' data-toggle='tooltip'>&nbsp;</a>", "<a class='next' data-toggle='tooltip'>&nbsp;</a>"],
		itemsDesktop: [1199, 4],
		itemsDesktopSmall: [980, 4],
		itemsTablet: [768, 2],
		itemsMobile: [479, 1],
	});

	/*----------------------------
 brand-active
------------------------------ */
	$("#section-blog").owlCarousel({
		autoPlay: false,
		slideSpeed: 2000,
		pagination: false,
		navigation: true,
		lazyLoad: true,
		items: 8,
		/* transitionStyle : "fade", */
		/* [This code for animation ] */
		navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		itemsDesktop: [1199, 4],
		itemsDesktopSmall: [980, 4],
		itemsTablet: [768, 2],
		itemsMobile: [479, 1],
	});
	/*----------------------------
	 banner slider
	------------------------------ */
	var owl = $("#owl-slider-banner");
	owl.owlCarousel({
		autoPlay: 10000,
		items: 1,
		itemsDesktop: [992, 1],
		itemsDesktopSmall: [768, 1],
		itemsTablet: [480, 1],
		itemsMobile: [320, 1]
	});

	/*----------------------------
	 blog
	------------------------------ */
	var owl = $("#owl-blog");
	owl.owlCarousel({
		items: 4,
		itemsDesktop: [992, 3],
		itemsDesktopSmall: [768, 1],
		itemsTablet: [480, 1],
		itemsMobile: [320, 1]
	});
	$(".next").click(function() { owl.trigger('owl.next'); });
	$(".prev").click(function() { owl.trigger('owl.prev'); });

	/*----------------------------
	 enlever le hidden du texte dans le header
	------------------------------ */
	$(".slider-text").removeClass("hidden");


	/*----------------------------
	 product-active
	------------------------------ */
	$(".product-active").owlCarousel({
		autoPlay: false,
		slideSpeed: 2000,
		pagination: false,
		navigation: false,
		items: 1,
		/* transitionStyle : "fade", */
		/* [This code for animation ] */
		navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		itemsDesktop: [1199, 1],
		itemsDesktopSmall: [980, 1],
		itemsTablet: [768, 1],
		itemsMobile: [479, 1],
	});

	/*----------------------------
	 testmonial-active
	------------------------------ */
	$(".testmonial-active").owlCarousel({
		autoPlay: false,
		slideSpeed: 2000,
		pagination: true,
		navigation: false,
		items: 1,
		/* transitionStyle : "fade", */
		/* [This code for animation ] */
		navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		itemsDesktop: [1199, 1],
		itemsDesktopSmall: [980, 1],
		itemsTablet: [768, 1],
		itemsMobile: [479, 1],
	});

	/*--------------------------
	   chosen
	---------------------------- */
	var config = {
		'.chosen-select-deselect': { allow_single_deselect: true },
	}
	for (var selector in config) {
		$(selector).chosen(config[selector]);
	}
	/*---------------------
		Category menu
	--------------------- */
	$('#cate-toggle>ul>li.has-sub>a').append('<span class="holder"></span>');
	$('#cate-toggle li.has-sub').on('click', function() {
		var $that = $(this).find('a');
		var element = $that.parent('li');
		if (element.hasClass('open')) {
			element.removeClass('open');
			element.find('li').removeClass('open');
			element.find('ul').slideUp();
		}
		else if ($that.next().hasClass('category-sub')) {
			element.addClass('open');
			element.children('ul').slideDown();
		}
	})

	/*--------------------------
   Countdown
---------------------------- */
	$('[data-countdown]').each(function() {
		var $this = $(this),
			finalDate = $(this).data('countdown');
		$this.countdown(finalDate, function(event) {
			$this.html(event.strftime('<div class="cdown days"><span class="counting">%-D</span>days</div><div class="cdown hours"><span class="counting">%-H</span>hrs</div><div class="cdown minutes"><span class="counting">%M</span>mins</div><div class="cdown seconds"><span class="counting">%S</span>secs</div>'));
		});
	});

	/* --------------------------------------------------------
	   header-area
	* -------------------------------------------------------*/
	$('.btn_close').on('click', function() {
		$('.header_area').animate({ left: '-199px' }, 500);
		$(this).hide();
		$('.btn_open').css('display', 'block');
	});

	$('.btn_open').on('click', function() {
		$('.header_area').animate({ left: '0px' }, 500);
		$(this).hide();
		$('.btn_close').css('display', 'block');
	});


	/*----------------------------
	 price-slider active
	 ------------------------------ */
	var max_price = $("#max_price").data("max-price");
	var start_price = ($(".start-price").val() > 0) ? $(".start-price").val() : 1;
	var end_price = ($(".end-price").val() > 0) ? $(".end-price").val() : max_price;

	$("#slider-range").slider({
		range: true,
		min: 0,
		max: max_price,
		values: [start_price, end_price],
		slide: function(event, ui) {},
		change: function(e, ui) {
			price_filter(ui.values[0], ui.values[1]);
			$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
			$(".span-start-price").html(ui.values[0] + ' <i class="fa fa-eur" aria-hidden="true"></i>');
			$(".span-end-price").html(ui.values[1] + ' <i class="fa fa-eur" aria-hidden="true"></i>');
			$(".show-price").html(ui.values[0] + ' <i class="fa fa-eur" aria-hidden="true"></i> - ' + ui.values[1] + ' <i class="fa fa-eur" aria-hidden="true"></i>');
		}
	});
	$("#amount").val("$" + start_price +
		" - $" + end_price);
	$(".span-start-price").html(start_price + ' <i class="fa fa-eur" aria-hidden="true"></i>');
	$(".span-end-price").html(end_price + ' <i class="fa fa-eur" aria-hidden="true"></i>');
	$(".show-price").html(start_price + ' <i class="fa fa-eur" aria-hidden="true"></i> - ' + end_price + ' <i class="fa fa-eur" aria-hidden="true"></i>');

	$("#reset-price").on("click", function() {
		$("#slider-range").slider("values", 0, 0);
		$("#slider-range").slider("values", 1, max_price);
		var $icon = $("#dropdownPrice i");
	});

	$('#filter-by-price').on('click', function() {
		var max_price = $("#max_price").data("max-price");
		var start_price = ($(".start-price").val() > 0) ? $(".start-price").val() : 1;
		var end_price = ($(".end-price").val() > 0) ? $(".end-price").val() : max_price;
		if (start_price > end_price) {
			$('.facet-content.content-price-filter.show-filter .error').css('display', 'block');
		}
		else {
			price_filter(start_price, end_price);
		}
	});

	/*--------------------------
	 scrollUp
	---------------------------- */
	$.scrollUp({
		scrollText: '<i class="fa fa-angle-up"></i>',
		easingType: 'linear',
		scrollSpeed: 900,
		animation: 'fade'
	});

	/*--------------------------
	 Zoom
	---------------------------- */
	$("#zoompro").elevateZoom({
		gallery: "gallery",
		galleryActiveClass: "active",
		zoomType: "inner",
		cursor: "crosshair"
	});
	/*----------------------------
	 Instantiate MixItUp:
	------------------------------ */
	$('#Container').mixItUp();

	/*----------------------------
 magnificPopup:
------------------------------ */
	$('.magnify').magnificPopup({
		type: 'image'
	});

	/* --------------------------------------------------------
	   accordion
	* -------------------------------------------------------*/
	$('.panel-heading a').on('click', function() {
		$('.panel-default').removeClass('actives');
		$(this).parents('.panel-default').addClass('actives');
	});

	/* --------------------------------------------------------
	   cart-plus-minus-button
	* -------------------------------------------------------*/
	$(".cart-plus-minus").append('<div class="dec qtybutton">-</i></div><div class="inc qtybutton">+</div>');
	$(".qtybutton").on("click", function() {
		var $button = $(this);
		var oldValue = $button.parent().find("input").val();
		if ($button.text() == "+") {
			var newVal = parseFloat(oldValue) + 1;
		}
		else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
			}
			else {
				newVal = 0;
			}
		}
		$button.parent().find("input").val(newVal);
	});

	/* --------------------------------------------------------
	   header-search2
	* -------------------------------------------------------*/
	$('.open').on('click', function() {
		$('.test ').toggleClass("show");
	});
	/*------language changes--------*/
	/*	$('#language').change(function () {
			var language_code = $(this).val();
			var pathname = location.href;
			var url = pathname.split('/');
			url[3]=language_code;
			location.href = url.join('/');


			$.ajax({
				type: 'get',
				url: $('#language_form').attr('action'),
				data: "language="+$(this).val(),
				beforeSend: function () {
					$.LoadingOverlay("show",{'size': "10%",'zIndex': 9999});
				},
				success: function (response, status) {
					$.LoadingOverlay("hide");
					location.reload();
				}
			});

		});*/

	/*-----------language click----------------*/
	$('#language').click(function() {
		var language_code = $(this).val();
		var pathname = location.href;
		var url = pathname.split('/');
		url[3] = language_code;
		location.href = url.join('/');
	});

	$("#subscribe").on('click', function(e) {
		e.preventDefault();
		var form = $(this).parent('form');
		if ($(this).parent('form').valid()) {
			$.ajax({
				type: 'post',
				url: $(this).parent('form').attr('action'),
				data: $(this).parent('form').serialize(),
				beforeSend: function() {
					$.LoadingOverlay("show", { 'size': "10%", 'zIndex': 9999 });
				},
				success: function(response, status) {
					form.get(0).reset();
					$.LoadingOverlay("hide");
					if (response.success) {
						toastr.success(response.message);
					}
					else {
						toastr.error(response.message);
					}
				}
			});
		}
	})

	/*---------------------------------------------
	Image-animation-hover
	---------------------------------------------*/
	$(".product-container").find('.product-img a img').off('hover');
	$(".product-container").on('mouseenter', '.product-img a img', function() {
		$(this).parent().parent().next().find('a').css('color', '#65bb9f');
		/*$(this).parent().parent().next().find('span').first().css('color', '#f7850c');*/
	});
	$(".product-container").on('mouseleave', '.product-img a img', function() {
		$(this).parent().parent().next().find('a').css('color', "#044651");
		/*$(this).parent().parent().next().find('span').first().css('color', '#333333');*/
	});

	$("#show_popup_login_auth").trigger('click');

	$('.receive-notification').click(function(e) {
		e.preventDefault();
		if ($('.receive-notification i').hasClass('fa-circle-o')) {
			$('.receive-notification i').removeClass('fa-circle-o');
			$('.receive-notification i').addClass('fa-dot-circle-o');
		}
		else {
			$('.receive-notification i').removeClass('fa-dot-circle-o');
			$('.receive-notification i').addClass('fa-circle-o');
		}
	});
	$('.save-cart').click(function(e) {
		e.preventDefault();
		if ($('.save-cart i').hasClass('fa-circle-o')) {
			$('.save-cart i').removeClass('fa-circle-o');
			$('.save-cart i').addClass('fa-dot-circle-o');
		}
		else {
			$('.save-cart i').removeClass('fa-dot-circle-o');
			$('.save-cart i').addClass('fa-circle-o');
		}
	});
	$('.receive-email').click(function(e) {
		e.preventDefault();
		if ($('.receive-email i').hasClass('fa-circle-o')) {
			$('.receive-email i').removeClass('fa-circle-o');
			$('.receive-email i').addClass('fa-dot-circle-o');
		}
		else {
			$('.receive-email i').removeClass('fa-dot-circle-o');
			$('.receive-email i').addClass('fa-circle-o');
		}
	});
	$('#Femme').click(function(e) {
		e.preventDefault();
		if ($('#Femme i').hasClass('fa-circle-o')) {
			$('#Femme i').removeClass('fa-circle-o');
			$('#Femme i').addClass('fa-dot-circle-o');
			$('#Homme i').removeClass('fa-dot-circle-o');
			$('#Homme i').addClass('fa-circle-o');
			$('#gender').val('Femme');
		}
	});
	$('#Homme').click(function(e) {
		e.preventDefault();
		if ($('#Homme i').hasClass('fa-circle-o')) {
			$('#Homme i').removeClass('fa-circle-o');
			$('#Homme i').addClass('fa-dot-circle-o');
			$('#Femme i').removeClass('fa-dot-circle-o');
			$('#Femme i').addClass('fa-circle-o');
			$('#gender').val('Homme');
		}
	});
	$('.navbar').on('mouseover', 'dropdown-menu megamenu', function() {
		var $parent = $(this).parents('.menu-large');

		console.log($parent.css('background', 'red !important'));
		console.log('a element is enter ok');
		$parent.find('a#trigger').trigger('mouseover');
		$parent.css("background", 'red !important');

	});

	$('.menu-large').on('mouseleave', function() {
		var $a = $(this).find("a.arrow-bottom");
		$a.css('color', '#fff !important');
	});

	$('.flip').on('click', function() {
		console.log("We need to flip");
		var parent_nav = $(this).parents('.nav-tabs');
		if (!parent_nav.hasClass('inverse'))
			$(this).parents('.nav-tabs').addClass('inverse');
	});
	$('.notflip').on('click', function() {
		$(this).parents('.nav-tabs').removeClass('inverse');
	});


	//Show the modal if no info user location
	var current_url = 'https://' + window.location.hostname + window.location.pathname;
	setTimeout(function() {
		if ($('.user-zone-info').data('radius') == null && $('.user-zone-info').data('zip-code') == null && current_url == base_url) {
			$('#area-modal').modal('show');
		}	
	}, 3000);

	//Show the modal area information
	$('.change-your-area').on('click', function() {
		$('#area-modal').modal('show');
		//Change value of the select area in modal popup
		var $new_selected = $('.select-area').find('.selected');
		var new_val = $new_selected.find('span').html();
		$('.btn-select-area').find('span').html(new_val);
	});

	$('#btn-etape1').on('click', function() {

		var shop_name = $('#shop_name').val();
		var siret = $('#siret').val();
		var email = $('#email').val();
		var phone_number = $('#phone_number').val();
		var password = $('#password').val();
		var confirm_password = $('#confirm_password').val();

		if (shop_name == "") {
			$('#shop_name').css('border-color', 'red');
		}
		else {
			$('#shop_name').css('border-color', '#044651');
		}
		if (siret == "") {
			$('#siret').css('border-color', 'red');
		}
		else {
			$('#siret').css('border-color', '#044651');
		}
		var regexForEmailValidation = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
		var emailFormat = regexForEmailValidation.test(email);
		if (email == "" || emailFormat == false) {
			$('#email').css('border-color', 'red');
		}
		else {
			$('#email').css('border-color', '#044651');
		}
		if (phone_number == "") {
			$('#phone_number').css('border-color', 'red');
		}
		else {
			$('#phone_number').css('border-color', '#044651');
		}
		if (password == "") {
			$('#password').css('border-color', 'red');
		}
		else {
			$('#password').css('border-color', '#044651');
		}
		if (confirm_password == "") {
			$('#confirm_password').css('border-color', 'red');
		}
		else {
			$('#confirm_password').css('border-color', '#044651');
		}
		if (confirm_password != password || confirm_password == "" || password == "") {
			$('#password').css('border-color', 'red');
			$('#confirm_password').css('border-color', 'red');
		}
		else {
			$('#password').css('border-color', '#044651');
			$('#confirm_password').css('border-color', '#044651');
		}
		if (shop_name != "" && siret != "" && email != "" && emailFormat == true && phone_number != "" && password != "" && confirm_password != "" && password == confirm_password) {
			$('#2-tab').trigger('click');
		}
	});

	$('#btn-etape3').on('click', function() {
		$('#4-tab').trigger('click');
	});

	//gratuit
	$('.btn-pack-gratuit').on('click', function() {
		$('#4-tab').trigger('click');
	});

	/*$(".open-time").prop('disabled', true);*/
	$('.open-time').datetimepicker({
		format: 'HH:mm',
		icons: {
			time: 'fa fa-time',
			date: 'fa fa-calendar',
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down',
			previous: 'fa fa-backward',
			next: 'fa fa-chevron-right',
			today: 'fa fa-screenshot',
			clear: 'fa fa-trash',
			close: 'fa fa-remove'
		}
	});

	$('.bottle').on('click', '.open-day', function(event) {
		event.preventDefault();
		console.log("active value");
		var $inputs = $(this).parents('.info-one-day').find('.open-time');
		var $icon = $(this).find('i');
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			$icon.removeClass('fa-check-square');
			$icon.addClass('fa-square-o');
			$inputs.prop('disabled', true);
			$inputs.val(null);
		}
		else {
			$(this).addClass('active');
			$inputs.prop('disabled', false);
			$icon.removeClass('fa-square-o');
			$icon.addClass('fa-check-square');
		}
	});
	$('.btn-pack').on('click', function() {
		var price = $(this).closest('.header-engagement-height').find('.price-int').html();
		var name = $(this).closest('.header-engagement-height').find('.title span').html();
		var type = $(this).closest('.tab-pane').find('.type-engagement').html();
		$('.total_original_amount').html(price + "€/mois");
		$('.subscription-type').html(type);
		$('.pack-name').html(name);
		$('#3-tab').trigger('click');
	});

	$('.close-article').on('click', function() {
		$('#2-tab').trigger('click');
	});
	
	/*$('.share-to-google').on('click', function() {
	   
	});*/

	//Script of search product
	$('.search-product').on('click', function() {
		$('#search-product-modal').modal('show');
	});

	$('.icon-change-area, .area-information .area').popover({
		trigger: 'hover',
		delay: {
			show: 1000,
			hide: 100
		}
	});

	$.ajax({
			url: base_url + 'get-all-product-in-area',
			type: 'GET',
			dataType: 'json'
		})
		.done(function(data) {
			var all_products = data.products;
			var options = {
				data: all_products,
				getValue: function(product) {
					return product.product_name;
				},
				template: {
					type: "custom",
					method: function(value, item) {
						return "<div class='row content-result-autocompletion' style='padding: 0px 20px;'> " +
							"<div class='col-xs-2'><img src='" + base_url + 'upload/product/thumb/' + item.images[0].image_name + "' /></div> " +
							"<div class='col-xs-8'>" +
							"<span class='brand-name text-uppercase'>" + item.brand.brand_name + "</span><br>" +
							"<span>" + value + "</span>" +
							"</div>" +
							"</div>";
					}
				},
				list: {
					onClickEvent: function() {
						$('#form-search').submit();
					}	
				}
			};
			$('#search-product-input').easyAutocomplete(options);
		})
		.fail(function(xhr) {
			console.log(xhr.responseText);
		})
		.always(function() {});


	//Close the list area where it open
	$('body').on('click', function(e) {
		if (!$('.select-area.dropdown').is(e.target) &&
			$('.select-area.dropdown').has(e.target).length === 0 &&
			$('.select-area.dropdown').has(e.target).length === 0
		) {

			close_select_radius();
		}
	});

	//Carte récente
	footerCardFixed()
	
})(jQuery);

function stopEvent() {
	return false;
}

function removePaddingBody() {
	$('body').css('padding', '0px !important');
}

function searchRadio() {

	$zip = $('#zip-code').val();
	if ($zip == "") {
		$('#zip-code').css('border', '4px solid red');
	}
	else {
		$('#zip-code').css('border', '4px solid #044651');
		window.open(base_url + 'get-radio/' + $zip, "_blank");
	}
}

function change_area_information() {
	console.log("$('.option-area.selected').data('id')");
	console.log($('.option-area.selected').data('id'));
	if($('.option-area.selected').data('id') != null)
		$('#input-radius').val($('.option-area.selected').data('id'));
	var current_url = 'https://' + window.location.hostname + window.location.pathname;
	if (current_url == base_url + "search")
		$('#searc-store').submit();

	$.ajax({
			url: base_url + 'set-location',
			type: 'POST',
			dataType: 'json',
			data: $('#search-store').serialize(),
		})
		.done(function(data) {
			var zip_code = $('#zip-code').val();
			var radius = $('#input-radius').val();
			if (data.status == "ok") {
				$('.area-information').html('<p class="area">' +
					'Votre zone d\'achat est : ' + '<strong>' + radius + ' KM</strong> autour du <strong>' + zip_code + '</strong>' +
					'</p>');
				$('#area-modal').modal('hide')
			}
		})
		.fail(function(xhr) {
			console.log("Une erreur d'action après le popup");
			console.log(xhr.responseText);
		})
		.always(function() {
		});

}

function show_option_radius(element) {
	var $icon = $(element).find("i");
	var current_url = 'https://' + window.location.hostname + window.location.pathname;
	if(current_url == base_url){
		if ($icon.hasClass('fa-angle-down')) {
		//	$icon.removeClass('fa-angle-down').addClass('fa-angle-up');
			$(element).addClass('active');
		}
		else {
		//	$icon.removeClass('fa-angle-up').addClass('fa-angle-down');
			$(element).removeClass('active');
		}	
	}else{
			if ($icon.hasClass('fa-angle-down')) {
				$icon.removeClass('fa-angle-down').addClass('fa-angle-up');
				$(element).addClass('active');
			}
			else {
				$icon.removeClass('fa-angle-up').addClass('fa-angle-down');
				$(element).removeClass('active');
			}
		
			$(element).parent().toggleClass('open');
	}
	
	

	
}

function check_icon_round_if_select(element) {
	var $icon = $(element).find("i");
	//Remove old selected
	var $old_selected = $('.select-area').find('.selected');
	$old_selected.removeClass('selected');
	var $icon_old_selected = $old_selected.find('i');

	$icon_old_selected.removeClass('fa-dot-circle-o').addClass('fa-circle-o');
	if ($icon.hasClass('fa-circle-o')) {
		$icon.removeClass('fa-circle-o').addClass('fa-dot-circle-o');
		$(element).addClass('selected');
	}
	else {
		$icon.removeClass('fa-dot-circle-o').addClass('fa-circle-o');
		$(element).removeClass('selected');
	}

	//Change value of the button
	var $new_selected = $('.select-area').find('.selected');
	var new_val = $new_selected.find('span').html();
	$('.btn-select-area').find('span').html(new_val);
	close_select_radius();

}


function close_select_radius() {
	$('.select-area.dropdown').removeClass('open');
	$(".btn-select-area").removeClass('active');
	var $icon = $('.btn-select-area').find("i");
	if ($icon.hasClass('fa-angle-up'))
		$icon.removeClass('fa-angle-up').addClass('fa-angle-down');
}

function initMap() {}

function aside_fixed() {
	//console.log('log')
	var $aside = $("#aside"),
		$window = $(window),
		offset = $aside.offset(),
		content = $('.main')[0].clientHeight - 140,
		//content = $('.test')[0].clientHeight,
		topPadding = 15,
		left = $('.nav-menu.content').offset().left + parseInt($('.main').css('padding-left')),
		//left = '30px',
		css = {},
		animate = {};

	if (Modernizr.mq('(max-width: 767px)')) {	
		if (Modernizr.mq('(max-width: 480px)')) left = 0;
		$window.scroll(function() {
			content = $('.main')[0].clientHeight + offset.top 
			if ($window.scrollTop() > offset.top && $window.scrollTop() < content) {
				$aside.stop().css({ 'position': 'fixed', 'top': '0', 'z-index': '2000'});
				$('.nav-menu.content').css( 'margin-right', '0');
			}
			else {
				$aside.stop().animate({
					marginTop: 0
				}).css({'position': 'relative'});
				$('.nav-menu.content').css( 'margin-right', '0');
			}
		});
	}
	else {
		$window.scroll(function() {
			var window_last_scroll;
			if ($window.scrollTop() > offset.top && $window.scrollTop() < content) {
				$aside.stop().css('margin-top', $window.scrollTop() - offset.top + topPadding);
				$window_last_scroll = $window.scrollTop() - offset.top + topPadding;
			}
			else {
				$aside.stop().animate({
					marginTop: window_last_scroll 
				});
				console.log(window_last_scroll);
			}
		});

	}
}

function footerCardFixed(){
	var contentCart = document.getElementById('content-cart');

	var callback = function(mutationsList) {
	    for(var mutation of mutationsList) {
	        if (mutation.attributeName === 'style') {
	            var count = $('.cart-list').length
					childHeight = $('.cart-list')[0].clientHeight *2 + 17;

	        	if(count > 2){
					$(".content-cart").css({'height': childHeight, 'overflow-y': 'scroll'});
					$(".shopping-cart .cart-list").css('width', '99%');
					$(".content-cart").scrollTop(0);	
					$('.cart-list legend').last().hide();				
				} 
	        }
	    }
	}
	//Commenteko kely vetivety
	// var observer = new MutationObserver(callback);
	// observer.observe(contentCart, { attributes: true});

	$(".content-cart").scroll(function() {
		var y = $(".content-cart").scrollTop();
		var height = $(".content-cart")[0].scrollHeight - $(".content-cart")[0].clientHeight;
		
		if(y == 0){
			$('.cart-list legend').first().show();
			$('.cart-list legend').last().hide();
		} 
		else{
			$('.cart-list legend').first().hide();
			$('.cart-list legend').last().hide();
			if(y == height){
				$('.cart-list legend').first().hide();
				$('.cart-list legend').last().show();
			} 
		}
	})
}