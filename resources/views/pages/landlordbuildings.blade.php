
 @extends('layout.default')

 @section('content')
 
 
    <script src="{{ URL::asset('js/googleMap.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6v5-2uaq_wusHDktM9ILcqIrlPtnZgEk&sensor=false">
    </script> 
   <div class="banner">
      	<div class="wrap">
      	     <h2>My buildings</h2><div class="clear"></div>
      	</div>
    </div>
	<div class="main">	
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
	 <div class="project-wrapper">
    <div class="project-sidebar">
    <div class="project-list">
        <h4>My Buildings</h4>
      <ul class="buildings-list">
      <?php if (isset($buildings)){
                foreach($buildings as $building){
                                $link = "search?action=buildings&id=".$building->id.'&landlord='.  $user[0]->ID."&limit=1";
                                ?>
                                    <li><img src="{{ URL::asset('images/arrow.png') }}" alt=""><p><a href="<?php echo $link; ?>"> <?php echo $building->buildingName  ?></a></p><div class="clear"></div></li>
                                <?php 
                            }

                        }
                    ?>
      </ul>
      <div class="paginate"></div>
      <div class="clear"></div>
     </div>
     
     
     
   </div>
	  <div class="building_wrapper"></div>
	 


	 <div class="clear"></div>
  </div>
   		
      	   		                                                                                            
@stop