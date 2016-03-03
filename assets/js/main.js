$(function() {

	//$('body').css({background:'red'});

	$('.openNotebook').on('click', function(){ notebookOpen($(this)); return false; });

	// -------------------------

	function noteOpen(el) {
		var url = el.attr('href');

		$('#page').fadeOut(200, function(){
			$(this).html('');	

			$.ajax({url: url,
				success: function (data) {
					$('#page')
						.removeClass('loading')
						.addClass('view view--note')
						.html(data)
						.fadeIn(200);		

					$('.openNotebook').on('click', function(){ notebookOpen($(this)); return false; });
				},
				error: function (result) {
					console.log("Error!");
				}
			});

		}).addClass('loading');
	}

	function notebookOpen(el) {

		var url = el.attr('href');

		$('.openNotebook').removeClass('on');
		$('.notebooks').find('a[href="'+url+'"]').addClass('on');

		$('#page').fadeOut(200, function(){
			$(this).html('');	

			$.ajax({url: url,
				success: function (data) {
					$('#page')
						.removeClass('loading')
						.addClass('view view--notebook')
						.html(data)
						.fadeIn(200);		

					new Imager({lazyload: true});

					$('.notes').masonry({
						columnWidth: '.note',
						itemSelector: '.note',
						percentPosition: true
					});

					$('.openNote').on('click', function() { noteOpen($(this)); return false; });
				},
				error: function (result) {
					console.log("Error!");
				}
			});

		}).addClass('loading');
	}



});