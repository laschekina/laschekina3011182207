'use strict';

// Font Loader
WebFont.load({
     google: { families: [ 'Droid+Sans:400,700:latin', 'Lato:300,400,700,300italic,400italic,700italic:latin', 'Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic:latin' ] }
  });

function pageScroll(offset, showElm) {
  var headerHeight = $(offset).height();
  var currentScroll = $(window).scrollTop();

  if (headerHeight<currentScroll) {
    jQuery(showElm).addClass('active');
  }else {
      jQuery(showElm).removeClass('active');
  }

}
function pageScroll2(offset, showElm) {
  var headerHeight = $(offset).height();
  var currentScroll = $(window).scrollTop();

  if (headerHeight<currentScroll&&jQuery('.sidebar-full-height').hasClass('open')) {
    jQuery(showElm).addClass('active');
  }else {
      jQuery(showElm).removeClass('active');
  }
}
function navbarIconTop() {
  var top = $(window).scrollTop();
  $('.sidebar-full-height2 .iconic').css('top',top);
  $('.sidebar-close-bar2').css('top',top);

}

// slider price bar
function sliderPrice(id) {
$(id).noUiSlider({
    start: [ 5000, 15000 ],
    connect: true,
    range: {
        'min': 5000,
        'max': 25000
    }
},true);
$(id).Link('lower').to('-inline-<div class="tooltip-1"></div>', function ( value ) {
    $(this).html('<span>' + value + '</span>');
});
 $(id).Link('upper').to('-inline-<div class="tooltip-1"></div>', function ( value ) {
    $(this).html('<span>' + value + '</span>');
});
}

function tplInfoWindow (data) {
  console.log(data.src);
  var tpl = '<div class="map_info_window"><div class="image"><img src="'+data.src+'" alt=""></div><div class="description"><h3>'+data.title+'</h3><a class="link-arrow iconic iconic-arrow-forward" href="'+data.href+'"></a></div></div>';
  return tpl;
}

function getmapdata(url, elm) {
  $.getJSON(url, function(data){
    initialize(data, elm);
  });

}

// Google Map And info Window
function initialize(mapdata, elementid) {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };

    // Display a map on the page 1 bedroom
    map = new google.maps.Map(document.getElementById(elementid), mapOptions);
    map.setTilt(45);

    var mapdata = mapdata;

       // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    var image = 'images/icons/map-marker.png';
      var markers = [];
      for (var maploop = 0; maploop<mapdata.length; maploop++) {
        var position = new google.maps.LatLng(mapdata[maploop].lat, mapdata[maploop].lng);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            icon: image,
            title: mapdata[maploop].label
        });
        markers.push(marker);

        // Allow each marker to have an info window
        google.maps.event.addListener(marker, 'click', (function(marker, maploop) {
            return function() {
                infoWindow.setContent(tplInfoWindow(mapdata[maploop]));
                infoWindow.open(map, marker);

            };
        })(marker, maploop));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
        google.maps.event.addListener(infoWindow, 'domready', function() {
            // Reference to the DIV that wraps the bottom of infowindow
            var iwOuter = $('.gm-style-iw');
            if ($('.gm-style-iw .map_info_window').length){
                iwOuter.parent().addClass('gm-style-iw2');
                $('.gm-style-iw').prev().hide();
            }else {
                iwOuter.parent().removeClass('gm-style-iw2');
                $('.gm-style-iw').prev().hide();
            }

        });
      }


    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
    var markerCluster = new MarkerClusterer(map, markers);
}
//Add Color Changer
function addColorChanger() {
  var colorchangerTemplate = 'color-changer.html';
  $.ajax({
    url:colorchangerTemplate,
  }).done(function(data){
    $('body').append(data);
    colorChange();
  });
   $('head').append('<style type="text/css" id="tempColor"></style>');
  if(localStorage.getItem('skinStyle')!='') {
    $('#tempColor').html(localStorage.getItem('skinStyle'));
    $('#tempColor').html(localStorage.getItem('skinStyle'));
  }
}
// Color Changer
function colorChange() {
  /* ------------------ change styleshett value in Hidden field ---------*/
  $('.stBgs a').on('click',function(){
    var currentSkin = jQuery(this).attr('data-stylesheet');
    jQuery('#themeColor').val(currentSkin);
    currentSkin = 'skins/'+currentSkin;
    jQuery.ajax({
      url:currentSkin
    }).done(function(data){
      jQuery('#css_content textarea').val(data);
      if ($('#tempColor').length)
      $('#tempColor').html(data);
      localStorage.setItem('skinStyle',data);
    });
    return false;
  });
  /* ------------------- modal color show ---------------------*/
  $('.get-css').on('click' , function(){
    if (jQuery('#themeColor').val()){
      $('.ovrlay-getcss').addClass('ovrlay-open-getcss');
      $('.ovrlay-getcss').find('.modal').addClass('show-modal');
    }
    else{
      alert(' It is basecolor ! please choose the color');
    }
    return false;
  });
  $('.close').on('click' , function(){
    $('.ovrlay-getcss').removeClass('ovrlay-open-getcss');
    $('.ovrlay-getcss').find('.modal').removeClass('show-modal');
    return false;
  });


  /*--------------------- select all btn ----------------*/
  $('.sel-btn').on('click' , function(){
    $( '#css_content textarea' ).select();
    return false;
  });
  /* ---------Style Changer Autohide ---------------- */

  $('.chBut').parent().parent().delay(1000).animate({right:'-250px'}, 500, function(){
    $(this).find('.chBut').next('.chBody').css({display:'none'});
    $(this).find('.chBut').addClass('closed');
    return false;
  });


  /*----------  Style Changer Toggle ----------------- */
  $('.chBut').on('click' , function(){
    if ($(this).hasClass('closed')){
      $(this).next('.chBody').css({display:'block'}).parent().parent().animate({right:0}, 500, function(){
        $(this).find('.chBut').removeClass('closed');
      });
    } else {
      $(this).parent().parent().animate({right:'-250px'}, 500, function(){
        $(this).find('.chBut').next('.chBody').css({display:'none'});
        $(this).find('.chBut').addClass('closed');
      });
    }

    return false;
  });

  // reset color
  $('#resetColor').on('click',function(){
    localStorage.removeItem('skinStyle');
    $('#tempColor').html('');
    return false;
  });

  //
  }

jQuery(document).ready(function(){
  // Navigation toggle
  $( '.navigation-button, #mobileNav, #mobileNav2' ).on('click',function(event) {
    event.preventDefault();
   $('.wrap, .navigation-mobile').toggleClass('active');
  });

  // Navigation Submenu
  $('.navigation-mobile .menu-item-has-children >a').on('click',function(event){
  event.preventDefault();
  jQuery(this).next().slideToggle();
  });

  $('.articles-masonory').isotope({
      items:'article'
  });

  // Properties Slider
  $('.properties-slider').owlCarousel({
    singleItem : true,
    navigation:true,
    pagination:false,
      navigationText:['',''],
      rewindNav:false
  });
  // Header Slider v1
  $('#slider-v1').owlCarousel({
      singleItem : true,
      navigation:true,
      pagination:false,
      navigationText:['','']
  });
  // Slider Price Range
  sliderPrice('.slider-tooltip');

  // search form tab
  $('.form-tab a').on('click',function (e) {
    e.preventDefault();
    $('.form-tab a').removeClass('active');
    jQuery(this).addClass('active');
    jQuery('.form-cotent-map .form-1').addClass('hidden');
    var _currentTarget = jQuery(this).attr('href');
    jQuery(_currentTarget).removeClass('hidden');
    sliderPrice('.slider-tooltip');
  });

  // toggle map show
  jQuery('.toggle-map').on('click',function(){
      jQuery('.map-search-form').slideToggle();
      jQuery(this).toggleClass('active');
  });
  jQuery('.search-interaction').collapse('toggle');
  // sidebar full heiight
  jQuery('.sidebar-close-bar a, .sidebar-full-height2 a, .sidebar-close-bar2').on('click',function(event){
  event.preventDefault();
  jQuery('.sidebar-full-height').toggleClass('open');
    setTimeout(function(){
      pageScroll2('.main-header','.sidebar-close-bar2');
    },1000);
  });

  pageScroll('.main-header','.PagescrollToTop');
  pageScroll2('.navigation-bar','.sidebar-close-bar2');

  jQuery('.sidebar-close-bar2').on('click',function(){
  jQuery(this).toggleClass('active');
  });

  $(window).scroll(function(){
      pageScroll('.navigation-bar','.PagescrollToTop');
      pageScroll2('.navigation-bar','.sidebar-close-bar2');
      window.requestAnimationFrame(navbarIconTop);
  });

  //


  // Page Scroll To Top
  jQuery('body').append('<a href="#" class="PagescrollToTop"><i class="iconic iconic-keyboard-arrow-up"></i></a>');
  jQuery('.PagescrollToTop').on('click',function(event){
    event.preventDefault();
    jQuery('html, body').animate({scrollTop: 0}, 1500);
  });

 $('[data-toggle="tooltip"]').tooltip();
 $('[data-toggle="popover"]').popover();
 // Fitvids
 $('.video-embed').fitVids();

 //Properties Filter
 $('.filter_menu2 li').on('click',function () {
        var pick, value, parent;
        pick = $(this).text();
        value = $(this).attr('data-value');
        parent = $(this).parent().parent();
        parent.find('.toggle-prop-menu').text(pick)
        .append('<span class="caret caret_filter"></span>')
        .attr('data-value', value);
  });

  // Header Menu Active class
  var url = window.location.pathname;
  var activePage = url.substring(url.lastIndexOf('/') + 1);
  $('.navigation li a').each(function () {
    var linkPage = this.href.substring(this.href.lastIndexOf('/') + 1);

    if (activePage === linkPage) {
        $(this).addClass('active');
    }
  });

  // Show Map On click
  // jQuery('.showMap').on('click',function(){
  //   setTimeout(function(){
  //       initialize();
  //   },1500);
  // });



  $('.agents-contact form').submit(function(event){
    event.preventDefault();
    var formdata = jQuery('.agents-contact form').serializeArray();
    jQuery.ajax({
      url: 'php/contact.php',
      type: 'POST',
      async: true,
      data: formdata,
    }).done(function() {
          jQuery('.agents-contact .form-messges').removeClass('hidden');
          jQuery('.agents-contact .btn').attr('disabled', 'disabled');
      });
  });
  $('.get-estimation form').submit(function(event){
    event.preventDefault();
    var formdata = jQuery('.get-estimation form').serializeArray();
    jQuery.ajax({
      url: 'php/get-request.php',
      type: 'POST',
      async: true,
      data: formdata,
    }).done(function() {
          jQuery('.get-estimation .form-messges').removeClass('hidden');
          jQuery('.get-estimation .btn').attr('disabled', 'disabled');
      });
  });



  // footer contact form
   $('.footer-contact').submit(function(event){
    event.preventDefault();
    var formdata = jQuery('.footer-contact').serializeArray();
    jQuery.ajax({
      url: 'php/contact-footer.php',
      type: 'POST',
      async: true,
      data: formdata,
    }).done(function(messges) {
          jQuery('.footer-contact .form-messges').removeClass('hidden');
          jQuery('.footer-contact .form-messges').html(messges);
          jQuery('.footer-contact .btn').attr('disabled', 'disabled');
      });
    });
   // subscribe
   $('.newsletter-form form').submit(function(event){
    event.preventDefault();
    var formdata = jQuery('.newsletter-form form').serializeArray();
    jQuery.ajax({
      url: 'php/subscribe.php',
      type: 'POST',
      async: true,
      data: formdata,
    }).done(function(messges) {
          jQuery('.newsletter-form .form-messges').removeClass('hidden');
          jQuery('.newsletter-form .form-messges').html(messges);
      });
    });
    $('.newsletter-sidebar form').submit(function(event){
    event.preventDefault();
    var formdata = jQuery('.newsletter-sidebar form').serializeArray();
    jQuery.ajax({
      url: 'php/subscribe.php',
      type: 'POST',
      async: true,
      data: formdata,
    }).done(function(messges) {
          jQuery('.newsletter-sidebar .form-messges').removeClass('hidden');
          jQuery('.newsletter-sidebar .form-messges').html(messges);
      });
    });
  addColorChanger();
});
// Wow Animation
new WOW().init();
// Masonory Bug
$(window).on('load',function(){
  $('.articles-masonory').isotope({
      items:'article'
  });
  // Google map load
  if (jQuery('.map-section').length){
    google.maps.event.addDomListener(window, 'load', initialize);
  }
});
