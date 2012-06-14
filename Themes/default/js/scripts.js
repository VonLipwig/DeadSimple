$(document).ready(function() {
	// CKEditor
	$('.wysiwyg').ckeditor();

	// Create Model
	$('.admin .create, a.edit, a.delete, a.login').click(function(e) {
		e.preventDefault();

		var fastClosing = $(this).data('prevent-close') !== undefined ? false : true;
		var addClass = $(this).hasClass('login') ? ' overlay-small' : '';

		$.ajax({
			url		: $(this).attr('href'),
			success : function(msg) {
				$('body').append('<div class="overlay-bg"></div>');
				$('body').append('<div class="overlay'+addClass+'" data-fast-close="'+fastClosing+'"><div class="container"><div class="close">X</div></div></div>');
				$('.overlay .container').append(msg);
				$('.wysiwyg').ckeditor();

				bindCloseModel(fastClosing);
			}
		});
	});

	$('.close').live('click', function() {
		if ($(this).parents('.overlay').data('fast-close') === true || confirm('Are you sure you wish to close this window?')) {

			// Remove CKEditor to remove instance errors.
			$('.overlay .wysiwyg').ckeditor(function() {
				this.destroy();
			});

			// Remove overlay
			$('.overlay-bg, .overlay .container').remove();
		}
	});

	// Close Notifications
	window.setTimeout(function() {
		$('.notify').fadeOut();
	}, 3000);

});

// Close Model
function bindCloseModel(fastClose) {
	$('body').keyup(function(event) {
		if ( event.which == 27 ) {
			event.preventDefault();
			if (fastClose || confirm('Are you sure you wish to close this window?')) {

				// Remove CKEditor to remove instance errors.
				$('.overlay .wysiwyg').ckeditor(function() {
					this.destroy();
				});

				// Remove overlay
				$('.overlay-bg, .overlay .container').remove();
				$('body').unbind('keyup');
			}
		}
	});
}