
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
                         <th class="tenantType">User Type </th>
                        <th class="actions">Action </th>       
                                        
                    </tr>
                                   
                   <?php $i = 1;
                      foreach($tenants as $tenant){ 
                       
                                 $deleteLink =  "/tenant/delete?id=". $tenant->ID;
                                 $updateLink =  "/tenant/update?id=". $tenant->ID;
                           // $viewBookingLink =  "/booking/viewBooking?id=". $booking->id;
                          ?>

                       
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $tenant->UserName  ?></td>
                              <td><?php echo $tenant->LastName  ?></td>
                              <td><?php echo $tenant->FirstName  ?></td>
                              <td><?php echo $tenant->Email  ?></td>
                                <td><?php echo "Tenant";  ?></td>
                              <td> <?php if (count($tenant->ID) > 0){  ?> <a href="<?php echo $updateLink; ?>" class="btnLogin" >Update</a>  <?php } ?>  <a href="<?php echo $deleteLink; ?>" onclick="return confirm_alert(this);" class="btnLogin" >Delete</a></td>
                           
                            
                            </tr> 
                           <?php 
                            $i ++;
                              }
                              ?>

                     <?php 
                      foreach($landlords as $landlord){ 
                       
                                $deleteLink =  "/landlord/delete?id=". $landlord->ID;
                                $updateLink =  "/landlord/delete?id=". $landlord->ID;
                          ?>

                       
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $landlord->UserName;  ?></td>
                              <td><?php echo $landlord->LastName;  ?></td>
                              <td><?php echo $landlord->FirstName;  ?></td>
                              <td><?php echo $landlord->Email;  ?></td>
                              <td><?php echo "Landlord";  ?></td>
                              <td> <?php if (count($landlord->ID) > 0){  ?> <a href="<?php echo $updateLink; ?>" class="btnLogin" >Update</a>  <?php } ?>  <a href="<?php echo $deleteLink; ?>" onclick="return confirm_alert(this);" class="btnLogin" >Delete</a></td>
                           
                            
                            </tr> 
                           <?php 
                            $i ++;
                              }

                              ?>

                       <?php 
                      foreach($vehicleowners as $vehicleowner){ 
                       
                                $deleteLink =  "/vehicleowner/delete?id=". $vehicleowner->id;
                                $updateLink =  "/vehicleowner/delete?id=". $vehicleowner->id; 
                          ?>

                       
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $vehicleowner->UserName;  ?></td>
                              <td><?php echo $vehicleowner->LastName;  ?></td>
                              <td><?php echo $vehicleowner->FirstName;  ?></td>
                              <td><?php echo $vehicleowner->Email;  ?></td>
                              <td><?php echo "Vehicle Owner";  ?></td>
                              <td> <?php if (count($vehicleowner->id) > 0){  ?> <a href="<?php echo $updateLink; ?>" class="btnLogin" >Update</a>  <?php } ?>  <a href="<?php echo $deleteLink; ?>" onclick="return confirm_alert(this);" class="btnLogin" >Delete</a></td>
                           
                            
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