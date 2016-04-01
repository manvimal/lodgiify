
 @extends('layout.default')

 @section('content')
  <script>

  $(document).ready(function()
  {


      $('#adultprice').hide();
      $('#childrenprice').hide();
      $('#oldprice').hide();
      $('#newPrice').hide();
/**

if(document.getElementById('promotionrdb').checked) {
      alert("You have selected Option 1");
} else {
      alert("You have selected Option 1");
}
**/

  $('#promotionrdb').change(function()
  {
        if($('#promotionrdb').prop('checked')) 
        {
            $('#newPrice').show();
            
        }
        else
        {
            $('#newPrice').hide();
        }

  });
 

       $('#getBuildingCatName').change(function()
        {

         var text = $(this).find('option:selected').attr("name");
       //  alert(text);
        
          if((text == 'House') || (text == 'Villa') || (text == 'Bungalow') || (text == 'Penthouse'))
          {
             $('#adultprice').hide();
             $('#childrenprice').hide();
             $('#oldprice').show();
     
          }


          else if((text == 'Hotel') || $(text == 'Appartment'))
          {
           

           // console.log($('#adultprice').val());
           // alert('asas');

             
             $('#oldprice').hide();
              $('#childrenprice').show();
              $('#adultprice').show();


            
          }


       });
      

    });

  </script>

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
            <td width="70%"> <input type="text" class="required" name = "packageName" id = "packageName"/>*<span class="errorMsg"></span> </td>
        </tr>

        <tr>
            <td><label>Building: </label></td>
            <td>
               <select type="text" class="required" name = "building" id ="getBuildingCatName" > 
                 <option value="-1">-- Select a building --</option>
                    <?php 
                        if (isset($buildings)){

                            foreach($buildings as $building){
                                ?>
                                    <option value="<?php echo $building->id ?>"  name = "<?php echo $building->category->buildingCatName ?>"> <?php echo  $building->buildingName  ?></option>
                                <?php 
                            }

                        }
                    ?>
                    
                </select> <span class="errorMsg"></span>
            </td>
        </tr>



 
             <tr id="oldprice">
                <td width="30%"><label>Price per Day:</label></td>
                <td width="70%"> <input type="text" class="required numeric"  name = "oldPrice" id = "oldPrice"/><span class="errorMsg"></span> </td>
             </tr>


              <tr id="promotion">
                  <td width="30%"><label>Promotion:</label></td>
                <td> <input type="checkbox" name="promotionrdb" id ='promotionrdb' value="promotionrdb"> <td>
             </tr>

              <tr id="newPrice">
                <td width="30%"><label>New Promo Price:</label></td>
                <td width="70%"> <input type="text" class="numeric"  name = "newPrice" id = "newprice"/><span class="errorMsg"></span> </td>
             </tr>

       


            <tr id = "adultprice">
                <td><label>Adults Price/day: </label></td>
                <td><input type="text" class="required numeric" name = "adultPrice" id = "adultPrice"/></select>* <span class="errorMsg"></span></td>
            </tr>

           <tr id="childrenprice">
              <td><label>Children Price/day: </label></td>
              <td><input type="text" class="required numeric" name = "childrenPrice"/></select>* <span class="errorMsg"></span></td>
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
            <td><textarea type = "textbox" class="" name = "desc" id = "desc" ></textarea><span class="errorMsg"></span></td>
        </tr>



            <tr>
              <td></td>
            <td><input type = "submit" id = "addPackage" value = "Submit"  class="btnLogin" ></td>
            </tr>


            <tr>
              <td></td>
            <td colspan="2" align="center" id="packageMessage"></td>
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
	     	<h4>My packages</h4>
			<ul class="blog-list">
           
			</ul>
			
			<div class="clear"></div>
		 </div>
		 
		
		 
	 </div>


	 <div class="clear"></div>
  </div>
  
      	   		                                                                                            
@stop
