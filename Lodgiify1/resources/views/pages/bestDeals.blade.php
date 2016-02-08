
 @extends('layout.default')

 @section('content')
 
   <div class="banner">
        <div class="wrap">
             <h2>Deals</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main">  
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
   <div class="project-wrapper">
    <div class="project-sidebar">

    <div class="project-list">
       
      <h4>Recently Posted</h4>
       <div class="contentHolder"  id="contentHolder">
        <div class="deals-list content">
          <?php if (isset($buildings)){
                  foreach($buildings as $building){
                                  $link = "search?action=buildings&id=".$building->id ."&limit=1";
                                  ?>
                                      <div class="recently-posted-building">
                                        <?php if (!empty($building->image)) {?>
                                          <img src="{{ URL::asset('/') }}upload/<?php echo $building->image ;  ?> " alt="" width="50" height="50">
                                        <?php } ?>
                                        
                                        
                                         
                                         <p >
                                            <span class="name"><?php echo $building->category->buildingCatName  ?> - <?php echo $building->buildingName  ?></span>
                                            <span class="des">
                                              <?php echo $building->desc  ?>
                                            </span>
                                          </p>
                                        <a  href="{{ URL::asset('/') }}package/<?php echo $building->id?>" data-buildingId="<?php echo $building->id?>" data-buildingName="<?php echo $building->buildingName?>">Book now</a>
                                        <div class="clear"></div></div>
                                  <?php 
                              }

                          }
                      ?>
        </div>
    </div>
     
     </div>
     
     
     
   </div>
    <div class="building_wrapper"></div>
   


 <!-- start magnific-->
   <div id="small-dialog" class="mfp-hide popup">
        <h1>title</h1>
        <form name="/booking/register" method="post" >
          <div id = "tabs">
           <ul>
              <li><a href = "#tabs-1">Basic info</a></li>
              <li><a href = "#tabs-2">Rooms</a></li>
              <li><a href = "#tabs-3">Vehicle</a></li>
           </ul> 
        
           <div id = "tabs-1">
                 <p><label>Number Of people: </label><input type = "text" id = "NumOfPeople" name = "NumOfPeople" /> </p>
                 <p><label>Min Price: </label><input type = "text" id = "minPrice" name = "minPrice" /> </p>
                 <p><label>Max Price: </label><input type = "text" id = "maxPrice" name = "maxPrice" /> </p>
                <p><label>Room type: </label> <select type="text" class="required onlyLetters" name="roomCategory" id ="ddlroomCategory" > </select> </p>

           </div>
        
           <div id = "tabs-2">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                 sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                 nisi ut aliquip ex ea commodo consequat. </p>
           </div>
        
           <div id = "tabs-3">
              <p>ed ut perspiciatis unde omnis iste natus error sit 
                 voluptatem accusantium doloremque laudantium, totam rem aperiam, 
                 eaque ipsa quae ab illo inventore veritatis et quasi architecto 
                 beatae vitae dicta sunt explicabo.  </p>
            
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                 sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                 nisi ut aliquip ex ea commodo consequat. </p>
           </div>
        
        </div>
      </form>
   </body>                                
   </div>
  <!-- end magnific-->

   <div class="clear"></div>
  </div>
      
                                                                                                          
@stop