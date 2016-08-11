$(document).ready(function () {

	//SCROLL DOWN TO NEXT PAGE
	function scrollDown() {
   		$('html,body').animate({ scrollTop:$(this).parent().next().offset().top}, 700);
	};
	
    $('.page-button').on('click', scrollDown);
	
	
	//SCROLL BACK TO TOP
	function scrollToTop() {
   		$('html,body').animate({ scrollTop:$('#landing').offset().top}, 700);
	};
	
    $('.scroll-top-button').on('click', scrollToTop);
	
	
	//NAVIGATION LINKS SCROLL TO PAGE
	function navScroll() {
		var page = $(this).data('target');
   		$('html,body').animate({ scrollTop:$('#' + page).offset().top}, 700);
	};
	
	$('nav a').on('click', navScroll);
	
});