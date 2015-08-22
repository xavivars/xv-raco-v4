jQuery(document).ready(function(){
	jQuery("#sidebar h3:empty").each(function(){
		h = jQuery(this);
		p = h.parent();
		h.remove();
		p.children(0).css('margin-top','0px');
	});
	jQuery('#myWritings').click(function(){location.href='/bloc/'})
});

