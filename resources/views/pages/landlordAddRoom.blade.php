
 @extends('layout.default')

 @section('content')
  

    <script type="text/javascript">

        $(document).ready(function() {
                 $('#roomFacilityTableHide').hide();
                 $('#back').hide();
            

             
            $('#edit').click(function() {
                $('#hideAddFacilityForm').hide();
                $('#edit').hide();
                $('#back').show();
               $('#roomFacilityTableHide').show();

             
            });
        });
        
          $(document).ready(function() {
            $('#back').click(function() {
                 $('#back').hide();
                   $('#hideAddFacilityForm').show();
                  $('#edit').show();
                $('#roomFacilityTableHide').hide();
          
             
            });
        });

    </script>

   <div class="banner">
      	<div class="wrap">
      	     <h2>Register Room</h2><div class="clear"></div>
      	</div>
    </div>
	<div class="main">	
        
	 <div class="project-wrapper">
	   <div class="project">
	    <div class="blog-left">
			<div class="blog-bg">
			   <h4>Register new room</h4><div class="clear"></div>
			</div>


			<div class="blog-img">

    <form method="post"  action="/room/register" id="registerRoom" onsubmit="return validateAddRoom(this)" enctype='multipart/form-data'  >
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <table class="alignLeft container ">
        <tr>
            <td width="30%"><label>Room Name:</label></td>
            <td width="70%"> <input type="text" class="required" name = "roomName" id = "roomName"/><span class="errorMsg"></span> </td>
        </tr>
        <tr>
            <td><label>Building: </label></td>
         <td>
               <select type="text" class="required onlyLetters" name = "building" id ="building" > 
                    <?php 
                        if (isset($buildings)){

                            foreach($buildings as $building){
                                ?>
                                    <option value="<?php echo $building->id ?>"> <?php echo  $building->buildingName  ?></option>
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
                            
                      <?php echo " $facility->name:<input type=Checkbox name='facilityCheckboxes[]' value=$facility->id> &nbsp" ?>
                        
                    <?php 
                    $i ++;
                      }

                    ?>
             </td>



        </tr>

         <tr>
            <td><label>Capacity: </label></td>
         <td>
                <input type="text" class="required numeric" name = "capacity" id = "capacity"/>
                </select> <span class="errorMsg"></span></td>
        </tr>
         <tr>
            <td width="30%"><label>Price:</label></td>
            <td width="70%"> <input type="text" class="required numeric" name = "price" id = "price"/><span class="errorMsg"></span> </td>
        </tr>


        <tr>
            <td><label>Category: </label></td>
         <td>
               <select type="text" class="required onlyLetters" name = "category" id ="category" > 
                    <?php 
                        if (isset($categories)){

                            foreach($categories as $category){
                                ?>
                                    <option value="<?php echo $category->id ?>"> <?php echo  $category->roomCatName  ?></option>
                                <?php 
                            }

                        }
                    ?>
                    
                </select> <span class="errorMsg"></span></td>
        </tr>

        <tr>
            <td><label>Image: </label></td>
            <td><input type = "file" class="required" name="image"  accept="image/*" id = "image" multiple /><span class="errorMsg"></span></td>
         </tr> 

      <tr>
          <td >
                
             <label>Preview: </label>
            </td>
            <td >

              <div id="list"></div>
            </td>
         </tr> 

        <tr>
        	<td><label>Description: </label></td>
            <td><textarea type = "textbox" class="required" name = "desc" id = "desc" ></textarea><span class="errorMsg"></span></td>
        </tr>



            <tr>
            <td colspan="3" align="center"><input type = "submit" id = "submit" value = "Submit"  class="btnAll" ></td>
            </tr>

        </table>
          </form>
			</div>

		</div>
	   <div class="clear"></div>
	 
	 </div>
	 <div class="project-sidebar">
	 	<div class="project-list">
	 	 <div class="search_box">
			 <div class="project-list">
        <h4>Add Room Facility</h4>


        <input id="back" type="button" class="btnLogin" value="Add"/>
        <input id="edit" type="button" class="btnLogin" value="View/Delete"/>

        <form method="post" action="{{ URL::asset('/landlord/addRoomFacility') }}" id="hideAddFacilityForm">
             <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      <ul class="blog-list">
        <table class="ddlRoomFacilities">
           <tr>
            <td><label>Rooms: </label></td>
         <td>
      

     <select type="text" class="required onlyLetters" name = "ddlAddRoomFacility" id ="room" > 
                    <?php 

                        if (isset($AddRoomFacilities)){

                            foreach($AddRoomFacilities as $AddRoomFacility){
                                ?>
                                    <option value="<?php echo $AddRoomFacility->id ?>" > <?php echo  $AddRoomFacility->roomName  ?></option>
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
                            
                      <?php echo " $facility->name:<input type=Checkbox name='AddfacilityCheckboxes[]' value=$facility->id> &nbsp" ?>
                        
                    <?php 
                    $i ++;
                      }

                    ?>
             </td>

             <tr>
              <td></td>
              <td><input type="submit" name="addRoomFacilities" class="btnLogin" id="addRoomFacilities" /></td>
             </tr>

             <tr>
              <td><div id="Message"></div></td>
             </tr>

</table>

      </ul>
    </form>



 <table id="roomFacilityTableHide" class="main-list2 content" border="1" align="center">
            <?php if (isset($roomFacilities)){ ?>
                    <tr class="booking">             
                        <th class="package"> Number</th>
                        <th class="facilityName">Building Name </span></th>
                        <th class="facilityType">Facility </th>
                        <th class="action">Actions </th>
                                
                    </tr>
                                   
                   <?php $i = 1;


                      foreach($roomFacilities as $facilityind){ 
                            foreach( $facilityind as $facility){ 
                                 
                            $deleteLink =  "/RoomFacility/delete?id=". $facility->id;
                           // $viewBookingLink =  "/facility/viewBooking?id=". $booking->id;
                             
                          ?>
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $facility->room->roomName  ?></td>
                              <td><?php echo $facility->facility->name ?></td>
                              <td> <?php if (count($facility->id) > 0){  ?>  <?php } ?>  <a href="<?php echo $deleteLink; ?>"  class="btnLogin deleteRoomFacility" >Delete</a></td>
                           
                            </tr> 
                           <?php 
                            $i ++;
                            }
                          }
                              

                          }
                      ?>
          </table>
      




      
      <div class="clear"></div>
     </div>
		 </div>
		</div>
		<div class="project-list">
	     	<h4>My Rooms</h4>
			<ul class="blog-list">
            <?php if (isset($rooms)){
                foreach($rooms as $room){
                                ?>
                                    <li><img src="images/arrow.png" alt=""><p><a href="#"> <?php echo $room->roomName  ?></a></p><div class="clear"></div></li>
                                <?php 
                            }

                        }
                    ?>
			</ul>
			
			<div class="clear"></div>
		 </div>
		 
		
		 
	 </div>


	 <div class="clear"></div>
  </div>
  <script type="text/javascript">

   document.getElementById('image').addEventListener('change', handleFileSelect, false);
  </script> 		
      	   		                                                                                            
@stop