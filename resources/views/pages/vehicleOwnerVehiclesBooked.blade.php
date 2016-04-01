
 @extends('layout.default')

 @section('content')




   <div class="banner">
        <div class="wrap">
             <h2>All Bookings</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main tenantDealPackage">  
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
   <div class="project-wrapper vehicleBooking-wrapper">

      <?php if (isset($VehiclebookingsDone))
      {    
      ?>
        
           <table border="1">
            <tr class="trheader" >
              <th>Image</th>
              <th>Client</th>
              <th>Contact client</th>
              <th>Email</th>
               <th>Building</th>
               <th>Building Type</th>
                <th>Price</th>
                 <th>Check In: </th>
                  <th>Check out: </th>
                    <th>Status: </th>
                     <th>Action: </th>
                     <th>Pickup: </th>

               
              </tr>

              <?php

                if(!empty($VehiclebookingsDone))
                {

                    foreach($VehiclebookingsDone as $booking){
                // var_dump($booking);die;
                      $deleteLink =  "/deleteVehicleBooking?id=". $booking->id;
                      $viewPickupLocation = "/viewPickup?id=" . $booking->id . '&' . $booking->pickuplat . '&' . $booking->pickuplong;
                    ?>
                         <tr class="job">

                             <td> <img src="upload/<?php echo $booking->image  ?>" class="imageSize"/></td>
                             <th><?php echo $booking->FirstName .' '.$booking->LastName ?></th>
                             <th><?php echo $booking->Phone ?></th>
                             <th><?php echo $booking->Email ?></th>
                             <th><?php echo $booking->vehicleName ?></th>
                             <th><?php echo $booking->vehicleCatName ?></th>
                             <th><?php echo 'Rs ' .$booking->price ?></th>
                             <th><?php echo $booking->fromdate ?></th>
                             <th><?php echo $booking->todate ?></th>


                            <?php 


                              if($booking->todate <= $timenow )
                              {
                            ?>

                                 <th style="color:green;font-weight:bold;"><?php echo "Booking Completed"; ?></th>
                                 <?php
                          }
                          else
                          {
                            ?>
                            <th style="color:red;font-weight:bold;"><?php echo "Booking Ongoing"; ?></th>
                            <?php


                          }



                                ?>


                             <th ><a href="<?php echo $deleteLink; ?>" target="_blank" class="btnLogin LandlordDeleteBooking">Delete Booking</a></td></th>
                          
                          <?php
                          if($booking->driver == true)
                          {
                            ?>
                             <th ><a href="<?php echo $viewPickupLocation; ?>" target="_blank" class="btnLogin tenantDeleteBooking">view Pickup Location</a></td></th>
                            <?php
                          }
                          else
                          {
                            ?>
                            <th ><?php echo 'No Driver'; ?></th>
                            <?php
                          }
                          ?>

                          </tr>
                      <?php 
                  }

                }

                else{ ?>

                  <th colspan="7">No booking has been done yet</th>
                <?php
                }
               
                ?>
       </table>
       
    <?php   }   ?>

     
                  
    


     
     
   

   <div class="clear"></div>
  </div>
      </div>
                                                                                                          
@stop