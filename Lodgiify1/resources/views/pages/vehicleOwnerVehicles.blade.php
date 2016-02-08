 @extends('layout.default')

 @section('content')


   <div class="banner">
      	<div class="wrap">
      	     <h2>My Vehicles</h2><div class="clear"></div>
      	</div>
    </div>
	<div class="main">	
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
	 <div class="project-wrapper">
    <div class="project-sidebar">
    <div class="project-list">
        <h4>My Vehicles</h4>
      <ul class="inner-list">
      <?php if (isset($vehicles)){
                foreach($vehicles as $vehicle){
                                $link = "search?action=vehicles&id=".$vehicle->id.'&vehicleOwnerID='.  $user[0]->id."&limit=1";
                                ?>
                                    <li><img src="images/arrow.png" alt=""><p><a href="<?php echo $link; ?>"> <?php echo $vehicle->vehicleName  ?></a></p><div class="clear"></div></li>
                                <?php 
                            }
                        }
                    ?>
      </ul>
      <div class="paginate"></div>
      <div class="clear"></div>
     </div>
     
     
     
   </div>
	  <div class="inner_wrapper"></div>
	 


	 <div class="clear"></div>
  </div>
   		
      	   		                                                                                            
@stop