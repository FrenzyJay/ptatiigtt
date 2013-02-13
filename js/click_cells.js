$(window).load(function() {
	$('th').on('click', function(){
		if($('span').length){
			var val = $(this).text();
			if(val==''){
				val = '';
			}
			$(this).empty();
			$(this).append('<input type="text" value="'+val+'"/>');
			$(this).children('input').focus();
		}
		
		$('input').live('focusout',function(){
			val = $(this).attr('value');
			$(this).parent().append('<span>'+val+'</span>');
			$(this).remove();
		});
	});
});