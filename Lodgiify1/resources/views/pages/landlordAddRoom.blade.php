
 @extends('layout.default')

 @section('content')
  

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
            <td width="70%"> <input type="text" class="required onlyLetters" name = "roomName" id = "roomName"/><span class="errorMsg"></span> </td>
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
            <td><label>Capacity: </label></td>
         <td>
                <input type="text" class="required onlyLetters" name = "capacity" id = "capacity"/>
                </select> <span class="errorMsg"></span></td>
        </tr>
         <tr>
            <td width="30%"><label>Price:</label></td>
            <td width="70%"> <input type="text" class="required" name = "price" id = "price"/><span class="errorMsg"></span> </td>
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
			<form>
				<input type="text" value="Search...." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
				<input type="submit" value="">
			</form>
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