function displayForgotPassword() {
	// $('#error').hide();
	$(".login-box").find('.flip-container').toggleClass("flip");
	setTimeout(function(){$('.login-panel').hide()},180);
	setTimeout(function(){$('.forgot-panel').show()},200);
	$('#email_forgot').select();
}

function displayLogin() {
	// $('#error').hide();
	$(".login-box").find('.flip-container').toggleClass("flip");
	setTimeout(function(){$('.forgot-panel').hide()},200);
	setTimeout(function(){$('.login-panel').show()},200);
	$('#email').select();
	return false;
}