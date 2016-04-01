
 @extends('layout.default')

 @section('content')

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <script type="text/javascript">

        window.onload = function () 
        {
          var $html="";
            var mapOptions = {
                center: new google.maps.LatLng(-20.2429415, 57.6425072),
                zoom: 9,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
                var infoWindow = new google.maps.InfoWindow();
                var latlngbounds = new google.maps.LatLngBounds();
                var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
                google.maps.event.addListener(map, 'click', function (e) {


                var lattitude = document.getElementById('lattitude');
                lattitude.value=e.latLng.lat();

                var longitude = document.getElementById('longitude');
                longitude.value=e.latLng.lng()

  
            });
        }

    </script>


  <!--Load Script and Stylesheet for datetimepicker-->
  <script type="text/javascript" src="{{ URL::asset('js/jquery.simple-dtpicker.js') }}"></script>
  <link type="text/css" href="{{ URL::asset('css/jquery.simple-dtpicker.css') }}" rel="stylesheet" />
 

   <div class="banner">
        <div class="wrap">
             <h2>Deals</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main tenantDealPackage">  
      <form method="" name="registerVehicleBooking">

    <input type="hidden" name="_token" id="token"  value="{{ csrf_token() }}" />    
    <input type="hidden" name="vehicleid" id="vehicleid" value="<?php echo (isset($vehicles[0]->id) ? $vehicles[0]->id : ''); ?>" /> 
   <div class="project-wrapper">
    <div class="project-sidebar">

    <div class="project-list">
        
      <h4>Book Now</h4>
       <div class="contentHolder"  id="contentHolder">
        <div class="deals-list content">

      
        
         
          <p><label class="whiteText">From: </label>
         <input type="text" name="date10" id='date10' value="" class="required datetime"> <span class="errorMsg"></span></p>
          <p><label class="whiteText">TO: </label>
         <input type="text" name="date11" id='date11' value="" class="required datetime"> <span class="errorMsg"></span></p>
  
          <p class="errorMsg1"></p>
           <p class="successMsg"></p>
         <p><input type = "submit" name = "submit" Value="Submit" class="btnAll bookVehicles"/></p>

          
      <!--DateTimePicker -->
      <script type="text/javascript">

        $(function(){
          $('*[name=date10]').appendDtpicker({
            "closeOnSelected": true
          });
        });
        $(function(){
          $('*[name=date11]').appendDtpicker({
            "closeOnSelected": true
          });
        });

      </script>
                                 
        </div>
    </div>
     
     </div>
     
     
    

   </div>
 
    <div class="package_wrapper ">
          <div class="got_package whiteText">Please select a package</div>
          <div class="no_package">
             <figure >


              <h2 class="whiteText"><?php echo (isset($vehicles[0]->vehicleName) ? $vehicles[0]->vehicleName : ''); ?></h2>

              <div style="height:200px;background-repeat: no-repeat;background-size:contain;background-position:50%;background-color:#4A4545; background-image:url({{ URL::asset('/') }}upload/<?php  echo isset($vehicles[0]->image)? $vehicles[0]->image : ''; ?>)" ></div>
             
              <p><?php echo isset($building->desc)?  $building->desc : ''; ?></p>
              <!-- <h3><?php echo isset($building->rooms)?  count($building->rooms) : 0; ?></h3> -->
             </figure> 



          <?php if (isset($vehicles)){
                   $index = "odd";
                   $i =0;
                  foreach($vehicles as $vehicle){

                     ?>
                         
                          <div class="pack_label <?php echo  $index ; ?>">
                            <div id="package_chk">
                                <h2 class="packageName "><?php echo $vehicle->vehicleName ; ?></h2>
                                <input type="checkbox" class="packageid" name="vehicles[<?php echo $i; ?>][vehicle]" value="<?php echo $vehicle->id ; ?>" />
                             </div>



                              <div id="package_number">

                                
                                  
                             </div>

                             <div id="package_desc">
                               

                                Model : <span class="model"><?php echo $vehicle->models ; ?></span><br />
                                Transmission : <span class="transmission"><?php echo $vehicle->transmission ; ?></span><br />
                                Seats: <span class="seats"><?php echo $vehicle->numOfSeats ; ?></span><br />
                               
                                 Color : <span class="color"><?php echo $vehicle->color ; ?></span><br />
                                With Driver : <span style="color:red;" class="driver"><?php if($vehicle->driver == False){echo "NO";}else{echo 'YES';} ?></span><br />
                                Color : <span class="color"><?php echo $vehicle->color ; ?></span><br />
                               Price per Hour : <span class="price"><?php echo $vehicle->price ; ?></span><br />
                               Location : <span class="location"><?php echo $vehicle->location ; ?></span><br />
                               Additional Info: <span class="description"><?php echo $vehicle->description ; ?></span><br />

                               <a href="{{ URL::asset('/checkVehicleAvail' )}}"  class="btnLogin" id="checkVehicleAvail">Check Availability</a>
                            
                           
                              <p class="successMsgRoom"></p>
                             <p class="errorMsgRoom"></p>

                             </div>

                              <div class="promotion">

                              <?php  
                              if($vehicle->driver == True)
                              {
                                
                                ?>

                              <label>Please insert you exact pickup location</label>
                               <div id="dvMap" style="width: 500; height: 180px"></div>

                               <p>latitude: <input type="text" class="required numeric" id="lattitude" name = "lattitude" /> <span class="errorMsg"></span> </p></td>
                          
                              <p> Longitude: <input type="text" class="required numeric" name = "longitude" id="longitude" /> <span class="errorMsg"></span></p></td>
                            

                           
                            <?php
                          }
                          ?>
                      
                           
                              
                            </div>




                         
                     </div>
                     <?php 
                      $i++;
                      if ( $index == 'odd'){
                         $index = "even";
                      }
                      else if( $index =="even") {
                         $index = "odd";
                      }
                    }
                  }
               ?>
            
         </div>
    </div>
   



   <div class="clear"></div>


         </form>
  </div>
      
                                                                                                          
@stop