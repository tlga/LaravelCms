function ajaxPost(url,mediaFn,inputs) {

	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: "post",
		data: inputs,
		cache: false,
		url: url,
		async: false,
		contentType: false,
		processData: false,
		success: function (data) {


			mediaFn(data);


		},
		error :function( jqXhr ) {
			if( jqXhr.status === 422 ) {
				//process validation errors here.
				var errors = jqXhr.responseJSON.errors; //this will get the errors response data.
				//show them somewhere in the markup
				//e.g
				var errorsHtml = '<ul>';

				$.each( errors, function( key, value ) {
					errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
				});
				errorsHtml += '</ul>';

				errorMsg(errorsHtml);
			} else {
				console.log('sıkıntı başka !')
			}
		}
	});
};

function formClear(that) {
	that.closest('form').find("input[type=text], textarea").val("");
}

function errorMsg(data) {
	$('.main-raised').css({'-webkit-filter':'blur(5px)','-moz-filter':'blur(5px)','-o-filter':'blur(5px)','-ms-filter':'blur(5px)','filter':'blur(5px)'});
	$('.blackBackMessage').css({'display':'flex','z-index':'99999999'});
	$('.errorMsg').html(data);
}

$(document).on('click','.errorClose', function() {
	$('.main-raised').css({'-webkit-filter':'blur(0px)','-moz-filter':'blur(0px)','-o-filter':'blur(0px)','-ms-filter':'blur(0px)','filter':'blur(0px)'});
	$('.blackBackMessage').css({'display':'none','z-index':'-1'});
});


