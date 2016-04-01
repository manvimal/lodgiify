
 @extends('layout.default')

 @section('content')



 <script type="text/javascript" src="{{ URL::asset('js/jquery.simple-dtpicker.js') }}"></script>
  <link type="text/css" href="{{ URL::asset('css/jquery.simple-dtpicker.css') }}" rel="stylesheet" />


  
  </script>


   <div class="banner">
        <div class="wrap">
             <h2>Deals</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main" id="bestDeals">  

   <div class="project-wrapper">
    <div class="project-sidebar">

    <div class="project-list">
       
      <h4>Recently Posted (Last 9)</h4>
       <div class="contentHolder"  id="contentHolder">
        <div class="deals-list">
         <?php if (isset($vehicles)){
                  foreach($vehicles as $vehicle){
                                  $link = "search?action=vehicle&id=".$vehicle->id ."&limit=1";
                                  ?>
                                      <div class="recently-posted-building">
                                        <?php if (!empty($vehicle->image)) {?>
                                          <img src="{{ URL::asset('/') }}upload/<?php echo $vehicle->image ;  ?> " alt="" width="50" height="50">
                                        <?php } ?>
                                        
                                        
                                         
                                         <p >
                                            <span class="name"><?php echo $vehicle->category->vehicleCatName  ?> - <?php echo $vehicle->vehicleName  ?></span>
                                            <span class="des">
                                              <?php echo $vehicle->transmission  ?>
                                            </span>
                                          </p>
                                        <a  href="{{ URL::asset('/') }}bookVehiclesProcess/<?php echo $vehicle->id?>" data-vehicleId="<?php echo $vehicle->id?>" data-vehicleName="<?php echo $vehicle->vehicleName?>">Book now</a>
                                        <div class="clear"></div></div>
                                  <?php 
                              }

                          }
                      ?>
        </div>
    </div>
     
     </div>
     
     
     
   </div>
    <h1>Advanced Search</h1>
    <div class="building_wrapper">



        <div class="contentHolder"  id="contentHolder">

<form method="post" action="{{ URL::asset('/getVehicleAdvancedSearch') }}"/>

    <input type="hidden" name="_token" id="token"  value="{{ csrf_token() }}" />    

<div class="bestdealsHeader">
      
 <input id="vehicleName" value="" placeholder="Vehicle Name" name="vehicleName"/>


      <input id="numberOfSeats" placeholder="Number Of Seats" name="numberOfSeats"/>

       <input id="price" placeholder="Price" name="price"/>


      <select type="text" class="required onlyLetters" name = "vehicleCategory" id ="vehicleCategory" > 

           <option value="-1">-- Vehicle Categories --</option>
                    <?php 
                        if (isset($vehicleCategories)){

                            foreach($vehicleCategories as $vehicleCategory){
                                ?>
                                    <option value="<?php echo $vehicleCategory->id ?>"> <?php echo  $vehicleCategory->vehiclecatnameType  ?></option>
                                <?php 
                            }
                        }
                    ?>
      </select>


      <select type="text" class="required onlyLetters" name = "driver" id ="driver" > 

               <option value="-1">-- Need a Driver --</option> 
                 <option value="0"> No</option>
                 <option value="1"> Yes</option>             
      </select>

      <select type="text" class="required onlyLetters" name = "transmission" id ="transmission" > 

               <option value="-1">-- Transmission --</option> 
                 <option value="0"> Automatic</option>
                 <option value="1"> Manual</option>             
      </select>


      <div>
          <div><label>From:</label>
              <input type="text" id="checkIn" name="checkIn" />
              <label>To:</label>
              <input type="text" id="checkOut" name="checkOut"/> 
          </div>

      </div>


   
    </div>

      
<div class="advheader2">


   <input type="submit" name="submit"class="btnLogin" id="advancedVehicleSearch" value="Search"/>
</div>


</form>

          <script type="text/javascript">
        $(function(){
          $('*[name=checkIn]').appendDtpicker({
            "closeOnSelected": true
          });
        });
        $(function(){
          $('*[name=checkOut]').appendDtpicker({
            "closeOnSelected": true
          });
        });
      </script>
   
   <div class="clear"></div>
  </div>

<div id="AdvVehicleSearchResult">

    <div class="clear"></div>
</div>
    </div>
   


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