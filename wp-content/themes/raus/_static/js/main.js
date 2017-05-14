var lr = {};

lr.init = function(){
	lr.router();
}

lr.router = function(){
	if( $('body').hasClass('home') )
	{
		lr.home();
	}

	if( $('body').hasClass('page-id-9') )
	{
		lr.contact();
	}	

	if( $('body').hasClass('page-id-34') )
	{
		lr.media();
	}

	if( $('body').hasClass('page-id-17') )
	{
		lr.gallery();
	}

	if( $('body').hasClass('page-id-2') )
	{
		lr.bio();
	}
	if( $('body').hasClass('page-id-81') )
	{
		soundManager.setup({
		  //useFlashBlock: true, // optional - if used, required flashblock.css
		  url: 'wp-content/themes/raus/_static/js/swf/' // required: path to directory containing SM2 SWF files
		});
	}	

	if( $('body').hasClass('page-id-9') )
	{
		$('label').inFieldLabels({ fadeOpacity:0.3 });
		$('body #wrapper').anystretch(contact_bg, {
			speed: 50,
			positionX: "left",
			positionY: "top",
			elPosition: "relative"
		});
		// $('body').height( $(window).height() );

		// $(window).resize(function(){
		// 	$('body').height( $(window).height() );
		// });
	}
}

lr.bio = function(){
	var longest = 0;
	$('body #wrapper').anystretch(bio_bg, {
		speed: 50,
		positionX: "left",
		positionY: "top",
		elPosition: "relative"
	});
	$('.lang_wrapper > div.active').css({'position':'relative'});
	$('.lang_wrapper > div.active').readmore({
	maxHeight: 200,
	afterToggle: function(trigger, element, more) {if(! more) {  $('html, body').animate( { scrollTop: element.offset().top }, {duration: 100 } );}}
	});
	$.each( $('.lang_wrapper > div'), function(){
		if( $(this).outerHeight() > longest )
		{
			longest = $(this).outerHeight();
		}
	});

	$('.lang_wrapper').height( longest+'px' );

	$('.lang_chooser a').click(function(e){
		e.preventDefault();

		$('.lang_chooser .active').removeClass('active');
		$(this).addClass('active');
		
		$('.lang_wrapper .active').removeClass('active').fadeOut(500);
		$('.morelink').hide();
		$('.lang_wrapper > div').css({'position':'absolute'});
		$('.lang_wrapper .'+$(this).data('lang')).addClass('active').fadeIn(500).delay(500).readmore({maxHeight: 200}).css({'position':'relative'});
		$('.lang_wrapper .'+$(this).data('lang')).next('.morelink').show();
	})
}

lr.home = function(){ 

	$(window).resize(function(){
		$('.home #wrapper').height( $(window).height() );
	});

	$('.home #wrapper').height( $(window).height() );

	$('.home #wrapper').anystretch(home_bg, {
		speed: 50,
		positionX: "right",
		positionY: "top",
		elPosition: "absolute"
	});
}
lr.contact = function(){ 

	$(window).resize(function(){
		$('.home #wrapper').height( $(window).height() );
	});

	$('.page-id-9 #wrapper').height( $(window).height() );

	$('.page-id-9 #wrapper').anystretch(contact_bg, {
		speed: 50,
		positionX: "right",
		positionY: "top",
		elPosition: "absolute"
	});
}

lr.media = function(){
	soundManager.setup({
	  //useFlashBlock: true, // optional - if used, required flashblock.css
	  url: 'wp-content/themes/raus/_static/js/swf/' // required: path to directory containing SM2 SWF files
	});

	$(".video ul li a").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
	
}

lr.gallery = function(){
	imagesLoaded( $('.gallery')[0], function(){
		glry.init();

		function position_glry(){
			var h = $(window).height() - $('#header').outerHeight() - 480; //480 = height gallery

			$('article').css('margin-top', h/2+'px');
		}

		//Position gallery
		$(window).resize(position_glry);
		position_glry();

		$(".gallery li a").fancybox({
			openEffect	: 'none',
			closeEffect	: 'none'
		});
	});
}

var glry = {}

glry.init = function(){
	
	//Get some elements
	glry.$con = $('.gallery_container')
	glry.$obj = $('.gallery', glry.$con);
	glry.$ctrls = $('.gallery_controls');

	glry.$imgs = $('li', glry.$obj);

	glry.step = $(window).width()/2;
	glry.min = 0;
	glry.max = 0;

	//Calculate width for obj
	var w = 0;

	$.each( glry.$imgs, function(){
		//Increment
		w += $(this).outerWidth();
	});

	glry.$obj.width( w );

	glry.max = w;
	$('body').height( $(window).height() );

	//Bind events
	$(window).resize(function(){
		glry.step = $(window).width()/2;

		$('body').height( $(window).height() );
	});

	$('.next', glry.$ctrls).click(function(e){
		e.preventDefault();

		glry.move(1);
	})

	$('.prev', glry.$ctrls).click(function(e){
		e.preventDefault();

		glry.move(-1);
	})
}

glry.move = function(dir){
	//Will move the gallery with half of screen lengths!
	var offset = glry.$obj.offset().left * -1;
	var final_pos = offset;

	offset += dir*glry.step;

	if( offset >= glry.min && offset <= (glry.max-$(window).width()) ) {
		final_pos = offset;

		glry.$obj.animate({
			marginLeft: offset*-1+'px'
		}, 500);
	} else if( offset > (glry.max-$(window).width()) ) {
		final_pos = (glry.max-$(window).width());

		glry.$obj.animate({
			marginLeft: (glry.max-$(window).width())*-1+'px'
		}, 500);
	} else if( offset < glry.min ) {
		final_pos = glry.min;

		glry.$obj.animate({
			marginLeft: glry.min+'px'
		}, 500);
	}

	if( final_pos == glry.min ){
		//disable previous
		$('.prev', glry.$ctrls).addClass('disable');
	} else {
		//enable previous
		$('.prev', glry.$ctrls).removeClass('disable');
	}

	if( final_pos == (glry.max-$(window).width()) ){
		//disable previous
		$('.next', glry.$ctrls).addClass('disable');
	} else {
		//enable previous
		$('.next', glry.$ctrls).removeClass('disable');
	}
}


$(document).ready(function(){
	lr.init();
});
