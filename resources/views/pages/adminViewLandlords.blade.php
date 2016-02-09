
 @extends('layout.default')

 @section('content')


<script type="text/javascript">
function confirm_alert(node) {
    return confirm("Please click on OK to delete tenant.");
}
</script>

   <div class="banner">
        <div class="wrap">
             <h2>View Tenant</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main">  
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
    <div class="main-wrapper">
      
      <section >
        <h4>View, Edit and Delete Tenant</h4>
        <div class="contentHolder"  id="contentHolder">


 <table class="main-list content" border="1" align="center">
            <?php if (isset($landlords)){ ?>
                    <tr class="booking"> 
                        <th class="numberTenant"> Number</th>        
                        <th class="TenantUsername"> User Name</th>
                        <th class="TenantLastname">Last Name </span></th>
                        <th class="TenantFirstName">First Name </th>
                        <th class="tenantEmail">Email </th>
                        <th class="actions">Action </th>       
                                        
                    </tr>
                                   
                   <?php $i = 1;
                      foreach($landlords as $landlord){ 
                       
                                 $deleteLink =  "/landlord/delete?id=". $landlord->ID;
                           // $viewBookingLink =  "/booking/viewBooking?id=". $booking->id;
                          ?>

                       
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $landlord->UserName  ?></td>
                              <td><?php echo $landlord->LastName  ?></td>
                              <td><?php echo $landlord->FirstName  ?></td>
                              <td><?php echo $landlord->Email  ?></td>
                              <td> <?php if (count($landlord->ID) > 0){  ?> <a href="" class="direction" >Update</a>  <?php } ?>  <a href="<?php echo $deleteLink; ?>" class="deleteBooking" onclick="return confirm_alert(this);" >Delete</a></td>
                           
                            
                            </tr> 
                           <?php 
                            $i ++;
                              }

                          }
                      ?>
          </table>


      </div>
    </section>
     
     
  
    
   
   <div class="clear"></div>
  </div>
      
                                                                                                          
@stop