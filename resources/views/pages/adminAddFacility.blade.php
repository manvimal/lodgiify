
 @extends('layout.default')

 @section('content')


<script type="text/javascript">
function confirm_alert(node) {
    return confirm("Please click on OK to delete tenant.");

    
}
</script>




    <script type="text/javascript">

        $(document).ready(function() {
                 $('#facilityTableHide').hide();
                 $('#back').hide();
                  $('#h22').hide();


             
            $('#edit').click(function() {
                $('#formAddFacility').hide();
                $('#edit').hide();
                $('#back').show();
                 $('#h21').hide();
                  $('#h22').show();
               $('#facilityTableHide').show();

             
            });
        });
        
          $(document).ready(function() {
            $('#back').click(function() {
                 $('#formAddFacility').show();
                 $('#back').hide();
                   $('#facilityTableHide').hide();
                  $('#edit').show();
                    $('#h22').hide();
                  $('#h21').show();
          
             
            });
        });

    </script>



   <div class="banner">
      	<div class="wrap">
      	     <h2 id="h21">Add Facilities</h2><div class="clear"></div>
             <h2 id="h22">View/Edit/Delete Facilities</h2><div class="clear"></div>
      	</div>
    </div>
	<div class="main">	
        
	 <div class="project-wrapper">
	   <div class="project">
	    <div class="blog-left">
			<div class="blog-bg">
			   <h4>Add/View/Update/Delete Facilities</h4><span class="author"> <input id="back" type="button" class="btnAll" value="Add"/>
                <input id="edit" type="button" class="btnAll" value="View/Edit/Delete"/>Facilities</span><div class="clear"></div>
			</div>


			<div class="blog-img">

        


<form method="post"  id="formAddFacility" action="/addFacilities" onSubmit="return validateAddFacilities(this)">
    
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />  
    <table>
        <tr >
            <td><label>Facility Name:</label></td>
            <td> <input type="text" class="required onlyLetters" name = "facilityName" id = "facilityName"/><span class="errorMsg"></span> </td>
        </tr>
        <tr>
            <td><label>Facility Type:</label></td>
            <td> <input type="text" class="required onlyLetters" name = "facilityType" id = "facilityType"/><span class="errorMsg"></span> </td>
        </tr>
        
         
    
     <tr>
            <td></td>
            <td> <input type="submit" class="btnLogin" name="submit"/> </td>
        </tr>
        </table>
          </form>



      <!--View Update delete Facilities -->


     <table id="facilityTableHide" class="main-list content" border="1" align="center">
            <?php if (isset($facilities)){ ?>
                    <tr class="booking">             
                        <th class="package"> Number</th>
                        <th class="facilityName">Name of facility </span></th>
                        <th class="facilityType">Type of facility </th>
                        <th class="action">Actions </th>
                                
                    </tr>
                                   
                   <?php $i = 1;
                      foreach($facilities as $facility){ 
                               
                            $deleteLink =  "/facility/delete?id=". $facility->id;
                            $updateLink =  "/facility/updatePage?id=". $facility->id;
                           // $viewBookingLink =  "/facility/viewBooking?id=". $booking->id;
                              
                          ?>
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $facility->name  ?></td>
                              <td><?php echo $facility->type  ?></td>
                              <td> <?php if (count($facility->id) > 0){  ?> <a href="<?php echo $updateLink; ?>" class="btnLogin" >update</a>  <?php } ?>  <a href="<?php echo $deleteLink; ?>" onclick="return confirm_alert(this);" class="btnLogin" >Delete</a></td>
                           
                            </tr> 
                           <?php 
                            $i ++;
                              }

                          }
                      ?>
          </table>
      


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