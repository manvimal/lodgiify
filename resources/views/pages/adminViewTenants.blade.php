
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
            <?php if (isset($tenants)){ ?>
                    <tr class="booking"> 
                        <th class="numberTenant"> Number</th>        
                        <th class="TenantUsername"> User Name</th>
                        <th class="TenantLastname">Last Name </span></th>
                        <th class="TenantFirstName">First Name </th>
                        <th class="tenantEmail">Email </th>
                        <th class="actions">Action </th>       
                                        
                    </tr>
                                   
                   <?php $i = 1;
                      foreach($tenants as $tenant){ 
                       
                                 $deleteLink =  "/tenant/delete?id=". $tenant->ID;
                           // $viewBookingLink =  "/booking/viewBooking?id=". $booking->id;
                          ?>

                       
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $tenant->UserName  ?></td>
                              <td><?php echo $tenant->LastName  ?></td>
                              <td><?php echo $tenant->FirstName  ?></td>
                              <td><?php echo $tenant->Email  ?></td>
                              <td> <?php if (count($tenant->ID) > 0){  ?> <a href="" class="direction" >Update</a>  <?php } ?>  <a href="<?php echo $deleteLink; ?>" onclick="return confirm_alert(this);" class="deleteBooking" >Delete</a></td>
                           
                            
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