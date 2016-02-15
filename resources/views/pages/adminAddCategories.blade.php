
 @extends('layout.default')

 @section('content')

 

<script type="text/javascript">

$(document).ready(function() {
    
    
    $('#secondR').hide();
            $('#firstR').hide();
            $('#thirdR').hide();
            $('#fourthR').hide();

    $('#types').change(function(){

    if($('#types').val() == 'room')
    {
  
            $('#secondR').hide();
            $('#firstR').show();
            $('#thirdR').hide();
            $('#fourthR').show();
             
      }
      
     else if($('#types').val() == 'building'){
          
            $('#secondR').show();
            $('#firstR').hide();
            $('#thirdR').hide();
            $('#fourthR').show();
          
      }
      
    else if($('#types').val() == 'vehicle'){
          
            $('#secondR').hide();
            $('#firstR').hide();
            $('#thirdR').show();
            $('#fourthR').show();
          
      }
          
    else{
            $('#secondR').hide();
            $('#firstR').hide();
            $('#thirdR').hide();
            $('#fourthR').hide();
       }
});
});

</script>


   <div class="banner">
      	<div class="wrap">
      	     <h2>Add Room/Building/Vehicle Categories</h2><div class="clear"></div>
      	</div>
    </div>
	<div class="main">	
        
	 <div class="project-wrapper">
	   <div class="project">
	    <div class="blog-left">
			<div class="blog-bg">
			   <h4>Add Categories</h4><span class="author">Room/Building/Vehicle Categories</span><div class="clear"></div>
			</div>


			<div class="blog-img">

        



    <select id="types" name="types" >
        <option value="Other">Please select a category to add</option>
        <option value="room">Room Category</option>
        <option value="building">Building Category</option>
        <option value="vehicle">Vehicle Category</option>
    </select>

<form method="post"  action="/addCategories" onSubmit="return validateAddCategories(this)">
    
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />  
    <table>
        <tr id="firstR">
            <td><label>Room Category Name:</label></td>
            <td> <input type="text" class="required onlyLetters" name = "roomCatName" id = "roomCatName"/><span class="errorMsg"></span> </td>
        </tr>
        <tr id="secondR">
            <td><label>building Category Name:</label></td>
            <td> <input type="text" class="required onlyLetters" name = "buildingcatName" id = "buildingcatName"/><span class="errorMsg"></span> </td>
        </tr>
        
         <tr id="thirdR">
            <td><label>Vehicle Category Name:</label></td>
            <td> <input type="text" class="required onlyLetters" name = "vehiclecatName" id = "vehiclecatName"/><span class="errorMsg"></span> </td>
        </tr>
    
     <tr id="fourthR">
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