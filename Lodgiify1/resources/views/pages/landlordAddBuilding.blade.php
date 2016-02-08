
 @extends('layout.default')

 @section('content')
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        window.onload = function () {
            var mapOptions = {
                center: new google.maps.LatLng(-20.2429415, 57.6425072),
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var infoWindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
            google.maps.event.addListener(map, 'click', function (e) {
            alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
      
      window.location='addBuilding?lat='+e.latLng.lat()+'&long='+e.latLng.lng();
        
            });
        }
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
            <td> <input type="text" class="required" name = "lattitude" 
                  value="<?php if(isset($_GET['lat'])){ echo($_GET['lat']); }?>" readonly/> <span class="errorMsg"></span></td>
        </tr>

      <tr>
          <td><label>Longitude:</label></td>
            <td> <input type="text" class="required" name = "longitude" 
                  value="<?php if(isset($_GET['long'])){ echo($_GET['long']); }?>" readonly/> <span class="errorMsg"></span></td>
        </tr>


        <tr>
            <td width="30%"><label>Building Name:</label></td>
            <td width="70%"> <input type="text" class="required onlyLetters" name = "buildingName" id = "buildingName"/><span class="errorMsg"></span> </td>
            <span class="errorMsg"></span>
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
            <td><input type = "file"  name="image"  accept="image/*" id = "image" /> <span class="errorMsg"></span></td>
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
	 	 <div class="search_box">
			<form>
				<input type="text" value="Search...." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
				<input type="submit" value="">
			</form>
		 </div>
		</div>
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


	 <div class="clear"></div>
  </div>
   		
   <script type="text/javascript">

     document.getElementById('image').addEventListener('change', handleFileSelect, false);
  </script>        	   		                                                                                            
@stop