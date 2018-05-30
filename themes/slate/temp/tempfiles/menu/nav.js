$(document).ready(function(){
	$('a.has-children').on('click', function(e) {
		e.preventDefault();
		var $this	= $(this);
		if($this.hasClass('active')) {
			closeMenu($this);
		} else {
			openMenu($this);
		}
	});
	$('.products-slider').owlCarousel({
		items				: 7,
		itemsDesktop		: [1000, 7],
		itemsDesktopSmall	: [900, 5],
		itemsTablet			: [600, 4],
		itemsMobile			: false,
		navigation			: true,
		navigationText		: ['<span class="fa fa-chevron-left"></span>','<span class="fa fa-chevron-right"></span>']
	});
});

function closeMenu($this)
{
	var $submenu	= $this.parent().find('.sub-menu');
	$submenu.animate({
		'height'	: 0
	}, function() {
		$submenu.removeClass('active');
		$submenu.css('height', 'auto');
	});
	$this.removeClass('active');
}

function openMenu($this)
{
	var $submenu	= $this.parent().find('.sub-menu');
	timeout			= 0;
	if($('a.has-children.active').length > 0) {
		timeout		= 400;
	}
	$('a.has-children.active').trigger('click');
	setTimeout(function(){
		$submenu.addClass('active');
		var newHeight	= $submenu.outerHeight(true);
		$submenu.css('height', 0);
		$submenu.animate({
			'height'	: newHeight
		}, 500);
		$this.addClass('active');
	}, timeout);
}