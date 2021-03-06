
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
   


      <?php if (isset($bookingsDone))
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

               
              </tr>

              <?php

                if(!empty($bookingsDone))
                {

                    foreach($bookingsDone as $booking){
                // var_dump($booking);die;
                      $deleteLink =  "/bookingTenant/delete?id=". $booking->id;
                    ?>
                         <tr class="job">
                              <td> <img src="upload/<?php echo $booking->image  ?>" class="imageSize"/></td>
                             <th><?php echo $booking->FirstName .' '.$booking->LastName ?></th>
                             <th><?php echo $booking->Phone ?></th>
                             <th><?php echo $booking->Email ?></th>
                             <th><?php echo $booking->buildingName ?></th>
                             <th><?php echo $booking->buildingCatName ?></th>
                             <th><?php echo 'Rs ' .$booking->price ?></th>
                             <th><?php echo $booking->checkin ?></th>
                             <th><?php echo $booking->checkOut ?></th>


                            <?php 


                              if($booking->checkOut <= $timenow )
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