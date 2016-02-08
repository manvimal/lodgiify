<head>
	<!-- Favicon -->
	<link rel="icon" type="image/ico" href="images/FaviconLogiify.ico">
	<title>LOGIIFY | YOUR ROOM RENTAL MANAGEMENT SYSTEM</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href='http://fonts.googleapis.com/css?family=Karla' rel='stylesheet' type='text/css'>
	<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
	<!-- jQuery -->
	<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
	<!-- Add fancyBox main JS and CSS files -->
	<script src="{{ URL::asset('js/validation.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('js/jquery.magnific-popup.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('js/jPaginate/jquery.paginate.js') }}" type="text/javascript"></script>
 
  
	<link href="{{ URL::asset('css/magnific-popup.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('css/jpaginate.css') }}" rel="stylesheet" type="text/css">

	<link href="{{ URL::asset('css/perfect-scrollbar.min.css') }}" rel="stylesheet" type="text/css" media="all" />
	<script src="{{ URL::asset('js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>

	<script src="{{ URL::asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>
	

	<link href="{{ URL::asset('css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" media="all" />
	<link href="{{ URL::asset('css/jquery-ui.structure.min.css') }}" rel="stylesheet" type="text/css" media="all" />
	<link href="{{ URL::asset('css/jquery-ui.theme.min.css') }}" rel="stylesheet" type="text/css" media="all" />
	
		<script>
		//pop up list onclick on button
			$(document).ready(function() {
				$('.popup-with-zoom-anim').magnificPopup({
					type: 'inline',
					fixedContentPos: false,
					fixedBgPos: true,
					overflowY: 'auto',
					closeBtnInside: true,
					preloader: false,
					midClick: true,
					removalDelay: 300,
					mainClass: 'my-mfp-zoom-in'
			});


			/*$(".paginate").paginate({
			        count     : 50,
			        start     : 20,
			        display     : 12,
			        border          : false,
			        text_color        : '#79B5E3',
			        background_color      : 'none', 
			        text_hover_color      : '#2573AF',
			        background_hover_color  : 'none', 
			        images    : false,
			        mouse   : 'press',
			        onChange     			: function(page){
											$('._current','.project-list').removeClass('_current').hide();
											$('.buildings-list li:eq('+ page +')').addClass('_current').show();
										  }
			});*/
		});
		</script>
</head>