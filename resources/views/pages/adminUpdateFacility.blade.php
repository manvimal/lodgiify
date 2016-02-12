
 @extends('layout.default')

 @section('content')

   <div class="banner">
      	<div class="wrap">
      	     <h2>Update Facilities</h2><div class="clear"></div>

      	</div>
    </div>
	<div class="main">	
        
	 <div class="project-wrapper">
	   <div class="project">
	    <div class="blog-left">
			<div class="blog-bg">
			   <h4>Update Facilities</h4><span class="author">
                </span><div class="clear"></div>
			</div>


			<div class="blog-img">

        


<form method="get"  action="/updateFacilities" onSubmit="">
    
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />  .

    <table>
        <tr >
            <td><label>Facility Name:</label></td>
            <td> <input type="text" class="required onlyLetters updateTextBoxes" readonly value="<?php echo $facility[0]->name; ?>" name = "facilityName" id = "facilityName"/><span class="errorMsg"></span> </td>
        </tr>
            <input type="hidden" name="idText" value="<?php echo $facility[0]->id; ?>" /> 
        <tr>
            <td><label>Facility Type:</label></td>
            <td> <input type="text" class="required onlyLetters" value="<?php echo $facility[0]->type; ?>" name = "facilityType" id = "facilityType"/><span class="errorMsg"></span> </td>
        </tr>
        
         
    
     <tr>
            <td></td>
            <td> <input type="submit" class="btnLogin" name="submit"/> </td>
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
		
		 
		
		 
	 </div>


	 <div class="clear"></div>
  </div>
   		
@stop