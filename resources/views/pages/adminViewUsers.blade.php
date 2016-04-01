
 @extends('layout.default')

 @section('content')


<script type="text/javascript">
function confirm_alert(node) {
    return confirm("Please click on OK to delete User.");
}

function confirm_alert1(node) {
    return confirm("Please click on OK to continue");
}
</script>

   <div class="banner">
        <div class="wrap">
             <h2>View All Users</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main">  
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
    <div class="main-wrapper">
      
      <section >
        <h4>View, Edit and Delete Users</h4>
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
                         <th class="tenantType">Status </th>
                        <th class="actions">Action </th>       
                                        
                    </tr>
                                   
                   <?php $i = 1;
                      foreach($tenants as $tenant){ 

                     
                       
                                 $deleteLink =  "/tenant/delete?id=". $tenant->id;
                                 $updateLink =  "/tenant/update?id=". $tenant->id;
                                 $blockLink = "/user/block?id=". $tenant->id . "&&" . "type=" . $tenant->type;
                           // $viewBookingLink =  "/booking/viewBooking?id=". $booking->id;
                                 
                          ?>

                       
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $tenant->UserName  ?></td>
                              <td><?php echo $tenant->LastName  ?></td>
                              <td><?php echo $tenant->FirstName  ?></td>
                              <td><?php echo $tenant->Email  ?></td>
                              <td><?php echo "Tenant";  ?></td>

                              <?php
                              if(($tenant->logoutdatetime  == '0000-00-00 00:00:00'))
                              {


                              ?>

                              <td><?php echo 'Online'  ?></td>

                              <?php
                              }

                              elseif(($tenant->logoutdatetime < $todaydatetime))
                              {
                                ?>
                                    <td><?php echo 'Offline'  ?></td>
                                <?php

                              }
                              ?>

                                
                              <td> <?php if (count($tenant->id) > 0){  ?> <?php } ?>  <a href="<?php echo $deleteLink; ?>" onclick="return confirm_alert(this);" class="btnLogin" >Delete</a> <a href="<?php echo $blockLink; ?>" onclick="return confirm_alert1(this);" class="btnLogin" > <?php if(($tenant->userStatus)==0) echo'Unblock'; else{ echo('block');} ?></a></td>
                           
                            
                            </tr> 
                           <?php 
                            $i ++;
                              }
                              ?>

                     <?php 
                      foreach($landlords as $landlord){ 
                       
                                $deleteLink =  "/landlord/delete?id=". $landlord->id;
                                //$updateLink =  "/landlord/update?id=". $landlord->id;
                                  $blockLink = "/user/block?id=". $landlord->id . "&&" ."type=" . $landlord->type;
                          ?>

                       
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $landlord->UserName;  ?></td>
                              <td><?php echo $landlord->LastName;  ?></td>
                              <td><?php echo $landlord->FirstName;  ?></td>
                              <td><?php echo $landlord->Email;  ?></td>
                              <td><?php echo "Landlord";  ?></td>

                               <?php
                              if(($landlord->logoutdatetime  == '0000-00-00 00:00:00'))
                              {


                              ?>

                              <td><?php echo 'Online'  ?></td>

                              <?php
                              }

                              elseif(($landlord->logoutdatetime < $todaydatetime))
                              {
                                ?>
                                    <td><?php echo 'Offline'  ?></td>
                                <?php

                              }
                              ?>


                              <td> <?php if (count($landlord->id) > 0){  ?>  <?php } ?>  <a href="<?php echo $deleteLink; ?>" onclick="return confirm_alert(this);" class="btnLogin" >Delete</a> <a href="<?php echo $blockLink; ?>" onclick="return confirm_alert1(this);" class="btnLogin" > <?php if(($landlord->userStatus)==0) echo'Unblock'; else{ echo('block');} ?></a></td>
                           
                            
                            </tr> 
                           <?php 
                            $i ++;
                              }

                              ?>

                       <?php 
                      foreach($vehicleowners as $vehicleowner){ 
                       
                                $deleteLink =  "/vehicleowner/delete?id=". $vehicleowner->id;
                               // $updateLink =  "/vehicleowner/update?id=". $vehicleowner->id; 
                                  $blockLink = "/user/block?id=". $vehicleowner->id . "&&" ."type=" . $vehicleowner->type;
                          ?>

                       
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $vehicleowner->UserName;  ?></td>
                              <td><?php echo $vehicleowner->LastName;  ?></td>
                              <td><?php echo $vehicleowner->FirstName;  ?></td>
                              <td><?php echo $vehicleowner->Email;  ?></td>
                              <td><?php echo "Vehicle Owner";  ?></td>

                               <?php
                              if(($vehicleowner->logoutdatetime  == '0000-00-00 00:00:00'))
                              {


                              ?>

                              <td><?php echo 'Online'  ?></td>

                              <?php
                              }

                              elseif(($vehicleowner->logoutdatetime < $todaydatetime))
                              {
                                ?>
                                    <td><?php echo 'Offline'  ?></td>
                                <?php

                              }
                              ?>
                              
                              <td> <?php if (count($vehicleowner->id) > 0){  ?>  <?php } ?>  <a href="<?php echo $deleteLink; ?>" onclick="return confirm_alert(this);" class="btnLogin" >Delete</a> <a href="<?php echo $blockLink; ?>" onclick="return confirm_alert1(this);" class="btnLogin" > <?php if(($vehicleowner->userStatus)==0) echo'Unblock'; else{ echo('block');} ?></a></td>
                           
                            
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