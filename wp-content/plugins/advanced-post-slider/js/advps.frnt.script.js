jQuery(document).ready(function($) {
	$(".advps-flip").click(function(){
		var $selector = $(this).attr('sel');
		var $status = $(this).attr('sts');
		var $pl_uri = $(this).attr('iuri');
		var $template = $(this).attr('temp');
		//alert($selector)
		
		if($status == 'played'){
			$('#'+$selector).cycle('pause');
			if($template == 'two'){
				$(this).find('img').attr('src',$pl_uri+'images/play-two.png');
			}
			else{
				$(this).find('img').attr('src',$pl_uri+'images/play.png');
			}
			$(this).attr('sts','stop');
			$(this).find('img').attr('alt','play');
		}
		else
		{
			$('#'+$selector).cycle('resume');
			if($template == 'two'){
				$(this).find('img').attr('src',$pl_uri+'images/pause-two.png');
			}
			else
			{
				$(this).find('img').attr('src',$pl_uri+'images/pause.png');
			}
			$(this).attr('sts','played');
			$(this).find('img').attr('alt','pause');
		}
	});
});