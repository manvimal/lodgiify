
 @extends('layout.default')

 @section('content')
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        window.onload = function () {
          var $html="";
            var mapOptions = {
                center: new google.maps.LatLng(-20.2429415, 57.6425072),
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var infoWindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
            google.maps.event.addListener(map, 'click', function (e) {
           // alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
      
     // window.location='addBuilding?lat='+e.latLng.lat()+'&long='+e.latLng.lng();

  //Post Latitude and longitude to texboxes

            var lattitude = document.getElementById('lattitude');
            lattitude.value=e.latLng.lat();

            var longitude = document.getElementById('longitude');
            longitude.value=e.latLng.lng()

  
            });
        }
    </script>



    <script type="text/javascript">

        $(document).ready(function() {
                 $('#roomFacilityTableHide').hide();
                 $('#back').hide();
            

             
            $('#edit').click(function() {
                $('#formRoomFacilityHide').hide();
                $('#edit').hide();
                $('#back').show();
               $('#roomFacilityTableHide').show();

             
            });
        });
        
          $(document).ready(function() {
            $('#back').click(function() {
                 $('#back').hide();
                   $('#formRoomFacilityHide').show();
                  $('#edit').show();
                $('#roomFacilityTableHide').hide();
          
             
            });
        });

    </script>

   <div class="banner">
      	<div class="wrap">
      	     <h2>Register building</h2><div class="clear"></div>
      	</div>
    </div>
	<div class="main">	
        
	 <div class="project-wrapper">
	   <div class="project">
	    <div class="blog-left">
			<div class="blog-bg">
			   <h4>Register new building</h4><div class="clear"></div>
			</div>


			<div class="blog-img">

    <form method="post"  action="/building/register"  id="registerBuildingFrm" onsubmit="return validateAddBuilding(this)" enctype='multipart/form-data'>
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <table class="alignLeft container ">

      <tr>
        <td colspan="2"><p>Click on map to insert building location</P>
         <div id="dvMap" style="width: 500; height: 300px"></div>
   
        <td>
      </tr>

      <tr>
          <td><label>Latitude:</label></td>
            <td id="test"> <input type="text" class="required" id="lattitude" name = "lattitude" 
                  readonly/> <span class="errorMsg"></span></td>
        </tr>

      <tr>
          <td><label>Longitude:</label></td>
            <td> <input type="text" class="required" name = "longitude" id="longitude"  readonly/> <span class="errorMsg"></span></td>
        </tr>


        <tr>
            <td width="30%"><label>Building Name:</label></td>
            <td width="70%"> <input type="text" class="required onlyLetters" name = "buildingName" id = "buildingName"/><span class="errorMsg"></span> </td>
            <span class="errorMsg"></span>
        </tr>


         <tr>
            <td> <label>Facilities</label></td>

              <td>
                   <?php $i = 1;
                      foreach($facilities as $facility){   
                    ?>
                            
                      <?php echo " $facility->name:<input type=Checkbox name='facilityCheckboxes[]' value=$facility->id> &nbsp" ?>
                        
                    <?php 
                    $i ++;
                      }

                    ?>
             </td>

        </tr>
        

        <tr>
            <td><label>category: </label></td>
         <td>

               <select type="text" name = "category" id ="category" > 

                    <?php 
                        if (isset($categories)){

                            foreach($categories as $category){
                                ?>
                                    <option value="<?php echo $category->id ?>"> <?php echo  $category->buildingCatName  ?></option>
                                <?php 
                            }

                        }
                    ?>
                    
                </select> <span class="errorMsg"></span></td>
        </tr>

        <tr>
        	<td><label>Location:</label></td>
            <td> <input type="text" class="required onlyLetters" name = "location" id ="location"?> <span class="errorMsg"></span></td>
        </tr>

        <tr>
            <td><label>Image: </label></td>
            <td><input type = "file"  name="image" class="required" accept="image/*" id = "image" /> <span class="errorMsg"></span></td>
         </tr> 

     <tr>
            <td><label>Preview: </label></td>
            <td> <div id="list"></div> </td>
         </tr> 


        <tr>
        	<td><label>Description: </label></td>
            <td><textarea type = "textbox" class="required onlyLetters" name = "desc" id = "desc" ></textarea><span class="errorMsg"></span></td>
        </tr>



            <tr>
            <td colspan="3" align="center"><input type = "submit" id = "addBuildingSubmit" value = "Submit"  class="btnAll" ></td>
            </tr>

        </table>
          </form>
			</div>

		</div>
	   <div class="clear"></div>
	 
	 </div>
	 <div class="project-sidebar">
	
		<div class="project-list">
	     	<h4>Add Building Facilities</h4>
       
			<ul class="blog-list">


        <input id="back" type="button" class="btnLogin" value="Add"/>
        <input id="edit" type="button" class="btnLogin" value="View/Delete"/>

			
        <form method="post" id="formRoomFacilityHide" action="{{ URL::asset('/landlord/addBuildingFacility') }}">
          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
          <ul class="blog-list">

        <table class="ddlRoomFacilities">
           <tr>
            <td><label>Buildings: </label></td>
         <td>
      

            <select type="text" class="required onlyLetters" name = "ddlAddBuildingFacility" id ="building" > 

                    <?php 

                        if (isset($hasBuildings)){

                            foreach($hasBuildings as $hasBuilding){
                                ?>
                                    <option value="<?php echo $hasBuilding->id ?>" > <?php echo  $hasBuilding->buildingName  ?></option>
                                <?php 
                            }

                        }
                    ?>
                    
                </select> <span class="errorMsg"></span></td>
        </tr>  

 <tr>
            <td> <label>Facilities</label></td>

              <td>
                   <?php $i = 1;
                      foreach($facilities as $facility){ 
                       
                    ?>
                            
                      <?php echo " $facility->name:<input type=Checkbox name='addBuildingFacilityCheckboxes[]' value=$facility->id> &nbsp" ?>
                        
                    <?php 
                    $i ++;
                      }

                    ?>
             </td>

             <tr>
              <td></td>
              <td><input type="submit" name="addBuildingFacilities" class="btnLogin" id="addBuildingFacilities" /></td>
             </tr>

             <tr>
              <td><div id="Message1"></div></td>
             </tr>

</table>

      </ul>
    </form>


    <table id="roomFacilityTableHide" class="main-list2 content" border="1" align="center">
            <?php if (isset($buildingFacilities)){ ?>
                    <tr class="booking">             
                        <th class="package"> Number</th>
                        <th class="facilityName">Building Name </span></th>
                        <th class="facilityType">Facility </th>
                        <th class="action">Actions </th>
                                
                    </tr>
                                   
                   <?php $i = 1;


                      foreach($buildingFacilities as $facilityind){ 
                            foreach( $facilityind as $facility){ 
                                 
                            $deleteLink =  "/buildingFacility/delete?id=". $facility->id;
                           // $viewBookingLink =  "/facility/viewBooking?id=". $booking->id;
                             
                          ?>
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $facility->building->buildingName  ?></td>
                              <td><?php echo $facility->facility->name ?></td>
                              <td> <?php if (count($facility->id) > 0){  ?>  <?php } ?>  <a href="<?php echo $deleteLink; ?>"  class="btnLogin deleteBuildingFacility" >Delete</a></td>
                           
                            </tr> 
                           <?php 
                            $i ++;
                            }
                          }
                              

                          }
                      ?>
          </table>
      



			</ul>
			
			<div class="clear"></div>
		 </div>
		 
		 

  <div class="project-list">
     <div class="project-list">
        <h4>My Buildings</h4>
      <ul class="blog-list">
      <?php if (isset($buildings)){
                foreach($buildings as $building){
                                ?>
                                    <li><img src="images/arrow.png" alt=""><p><a href="#"> <?php echo $building->buildingName  ?></a></p><div class="clear"></div></li>
                                <?php 
                            }

                        }
                    ?>
      </ul>
      
      <div class="clear"></div>
     </div>
    </div>





		 
	 </div>


	 <div class="clear"></div>
  </div>
   		
   <script type="text/javascript">

     document.getElementById('image').addEventListener('change', handleFileSelect, false);
  </script>        	   		                                                                                            
@stop