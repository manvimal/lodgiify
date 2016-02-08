
 @extends('layout.default')

 @section('content')
  

   <div class="banner">
      	<div class="wrap">
      	     <h2>Administer package</h2><div class="clear"></div>
      	</div>
    </div>
	<div class="main">	
        
	 <div class="project-wrapper">
	   <div class="project">
	    <div class="blog-left">
			<div class="blog-bg">
			   <h4>Register new Package</h4><div class="clear"></div>
			</div>


			<div class="blog-img">

    <form method="post"  action="/package/register" id="addPackage" onsubmit="return ValidateRegisterPackages(this)" enctype='multipart/form-data'  >
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <table class="alignLeft container ">

        <tr>
            <td width="30%"><label>Package Name:</label></td>
            <td width="70%"> <input type="text" class="required onlyLetters" name = "packageName" id = "packageName"/><span class="errorMsg"></span> </td>
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
                    
                </select> <span class="errorMsg"></span>
            </td>
        </tr>

         <tr>
            <td><label>Capacity: </label></td>
            <td><input type="text" class="required onlyLetters" name = "capacity" id = "capacity"/></select> <span class="errorMsg"></span></td>
         </tr>

         <tr>
            <td width="30%"><label>New Price:</label></td>
            <td width="70%"> <input type="text" class="required" name = "newPrice" id = "newPrice"/><span class="errorMsg"></span> </td>
         </tr>

         <tr>
            <td><label>Room Category: </label></td>
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
           
			</ul>
			
			<div class="clear"></div>
		 </div>
		 
		
		 
	 </div>


	 <div class="clear"></div>
  </div>
  
      	   		                                                                                            
@stop
