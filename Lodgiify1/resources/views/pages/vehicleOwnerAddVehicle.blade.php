
 @extends('layout.default')

 @section('content') 

   <div class="banner">
      	<div class="wrap">
      	     <h2>Register Vehicle</h2><div class="clear"></div>
      	</div>
    </div>
	<div class="main">	
        
	 <div class="project-wrapper">
	   <div class="project">
	    <div class="blog-left">
			<div class="blog-bg">
			   <h4>Register new Vehicle</h4><div class="clear"></div>
			</div>

		<div class="blog-img">
    <form method="post"  action="/vehicle/register" onSubmit="ValidateAddVehicles(this)" enctype='multipart/form-data'  >
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <table class="alignLeft container ">
        <tr>
            <td width="30%"><label>Vehicle Name:</label></td>
            <td width="70%"> <input type="text" class="required onlyLetters" name = "name" id = "name"/><span class="errorMsg"></span> </td>
        </tr>

        <tr>
            <td><label>category: </label></td>
         <td>
               <select type="text" class="required onlyLetters" name="category" id ="category" > 
                    <?php 
                        if (isset($categories)){

                            foreach($categories as $category){
                    ?>
                                    <option value="<?php echo $category->id ?>"> <?php echo  $category->vehiclecatnameType  ?></option>
                                <?php 
                            }

                        }
                    ?>
                    
                </select> <span class="errorMsg"></span></td>
        </tr>

        <tr>
        	  <td><label>Location:</label></td>
            <td> <input type="text" class="required" name = "location" id ="location"?> <span class="errorMsg"></span></td>
        </tr>

        <tr>
            <td><label>Image: </label></td>
            <td><input type = "file" class="required" name="image"  accept="image/*" id = "image" /> <span class="errorMsg"></span></td>
         </tr> 

        <tr>
            <td><label>Preview: </label></td>
            <td> <div id="list"></div> </td>
         </tr> 

        <tr>
        	 <td><label>Description: </label></td>
            <td><textarea type = "textbox" class="required" name = "desc" id = "desc" ></textarea><span class="errorMsg"></span></td>
        </tr>

        <tr>
            <td><label>Model: </label></td>
            <td><input type = "text" class="required" name = "models" id = "models" ></textarea><span class="errorMsg"></span></td>
        </tr>

        <tr>
            <td><label>Color: </label></td>
            <td><input type = "text" class="required" name = "color" id = "color" ></textarea><span class="errorMsg"></span></td>
        </tr>

        <tr>
            <td><label>Number of seats: </label></td>
            <td><input type = "number" class="required" name = "numOfSeats" id = "numOfSeats" ></textarea><span class="errorMsg"></span></td>
        </tr>

        <tr>
            <td><label>Transmission: </label></td>
            <td><input type="radio" name="transmission" value="Automatic" checked>Automatic
                <input type="radio" name="transmission" value="Manual">Manual<span class="errorMsg"></span>
            </td>
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
			<form>
				<input type="text" value="Search...." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
				<input type="submit" value="">
			</form>
		 </div>
		</div>
		<div class="project-list">
	     	<h4>My Vehicles</h4>
			<ul class="blog-list">
			<?php if (isset($vehicles)){
                foreach($vehicles as $vehicle){
                                ?>
                                    <li><img src="images/arrow.png" alt=""><p><a href="#"> <?php echo $vehicle->vehicleName  ?></a></p><div class="clear"></div></li>
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