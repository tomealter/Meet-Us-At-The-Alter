$(document).ready(function () {

	
	function nextPerson() {
		$oldPerson = $('.current-person');
		$newPerson = $('.current-person').next();
		
		$newPerson.css('opacity','1');
		$oldPerson.css('opacity','0');
		$newPerson.addClass('current-person');
		$oldPerson.removeClass('current-person');
		
		if($newPerson.hasClass('last-person')){
			$('.right-button').css('display', 'none');
		};
		$('.left-button').css('display', 'block');

	};
	
	function lastPerson() {
		$oldPerson = $('.current-person');
		$newPerson = $('.current-person').prev();
		
		$newPerson.css('opacity','1');
		$oldPerson.css('opacity','0');
		$newPerson.addClass('current-person');
		$oldPerson.removeClass('current-person');
		
		if($newPerson.hasClass('first-person')){
			$('.left-button').css('display', 'none');
		};
		$('.right-button').css('display', 'block');
	};
	
	$('.right-button').on('click', nextPerson);
	$('.left-button').on('click', lastPerson);
	
	
	function setCurrent(){
		$current = $(this).data("person");
		$('.person').removeClass('current-person');
		$('.person').css('opacity', '0');
		$('.'+ $current).addClass('current-person');
		$('.'+ $current).css('opacity', '1');
		$('.left-button, .right-button').css('display', 'block');
		
		if($('.'+ $current).hasClass('first-person')){
			$('.left-button').css('display', 'none');
		}
		else if($('.'+ $current).hasClass('last-person')){
			$('.right-button').css('display', 'none');
		};
	};
	
	$('.pic-thumb').on('click', setCurrent);
	
});