jQuery(document).ready(function($){
    "use strict";
    /** Header Search Toggl **/
    $('.search-icon').click(function(){
        $('.tb-search').slideToggle();
    });

    /** Menu Toggle **/
    $('div#top-toggle').click(function(){
       $('div#top-toggle').toggleClass('on');
       $('#top-site-navigation .menu-main-wrap').slideToggle('slow');
   });

    $('#toggle').click(function(){
       $('#toggle').toggleClass('on');
       $('#primary-menu').slideToggle('slow');
    });

    //Sickey Sidebar
    $('#secondary, #primary').theiaStickySidebar();

    /** Gallery Icon **/
    $('.widget .gallery-icon').each(function(){
        var imglink  = $('.widget .gallery-icon a img').attr('src');
        var result = imglink.split('-');
        var count = result.length-1;
        var exclude = result[count].split('.');
        var result_1 = imglink.split('-'+result[count]);
        result_1 = result_1[0]+'.'+exclude[1];
        $(".widget .gallery-icon a").attr("href", result_1);
    });
    $(".widget .gallery-icon a").fancybox();

    // About Toggle

    $('.loop-about-nav-content').click(function(){
        var id = $(this).attr('id');
        $('.loop-about-nav-content').removeClass('active');
        $(this).addClass('active');
        $('.about-content-bottom .loop-about-content ').removeClass('active');
        $('.about-content-bottom #'+id+'-content').addClass('active');

    });

    /** Our Course **/
    $('.course-content').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        autoplay:true,
        items:2,
    });

    /** Post Slide **/
    $('.secondary-slider-1').owlCarousel({
        loop:true,
        margin:0,
        nav:false,
        autoplay:true,
        items:1,
    });

    /** Testimonial Script **/
    $('.secondary-testimonial-wrap').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        autoplay:true,
        items:1,
        nav:true,
		navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>']
    });

    /** Bact To Top **/
    $(window).scroll(function(){
      if($(window).scrollTop() > 300){
          $('#tb-go-top').removeClass('tb-on');
      }else{
          $('#tb-go-top').addClass('tb-on');
      }
    });

    $('#tb-go-top').click(function(){
      $('html,body').animate({scrollTop:0},800);
    });

    var $grid = $('.secondary-portfolio-wrap').imagesLoaded( function() {
      // init Isotope after all images have loaded
      $grid.isotope({
        itemSelector: '.loop-portfolio-logo',
        layoutMode: 'packery',
      });
    });

    $('.portfolio-post-filter').on( 'click', '.filter', function() {
        $('.portfolio-post-filter .filter').removeClass('active');
        $(this).addClass('active');
        var filterValue = $(this).attr('data-filter');
        $('.secondary-portfolio-wrap').isotope({ filter: filterValue });
    });

    /** Progress bar shorcode Horizontal**/
    $('.progress-bar-horizontal').each(function() {
		var bar = $(this);
        var label = $(this).attr('data-width');
        //alert(label);
        bar.waypoint({
            handler: function(){
                var progressBarWidth = label * bar.width() / 100;
                bar.find('div').animate({ width: progressBarWidth }, 1000).html();
            },
            offset: '95%'
        });
	});

});
