
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
   


      <?php if (isset($bookingsDone)){    ?>
        
           <table border="1">
            <tr class="trheader" >
              <th>Client</th>
              <th>Contact client</th>
              <th>Email</th>
               <th>Building</th>
               <th>Building Type</th>
                <th>Package</th>
                 <th>Check In: </th>
                  <th>Check out: </th>
                    <th>Status: </th>
                     <th>Action: </th>


               
              </tr>
              <?php
                if(!empty($bookingsDone)){
                    foreach($bookingsDone as $booking){
                      $deleteLink =  "/booking/delete?id=". $booking->id;
                    ?>
                         <tr class="job">

                           
                             <th><?php echo $booking->tenant->FirstName .' '.$booking->tenant->LastName ?></th>
                             <th><?php echo $booking->tenant->Phone ?></th>
                              <th><?php echo $booking->tenant->Email ?></th>
                              <th><?php echo $booking->building->buildingName ?></th>
                               <th><?php echo $booking->building->category->buildingCatName ?></th>
                            <th><?php echo $booking->packageName ?></th>
                             <th><?php echo $booking->checkin ?></th>
                            <th><?php echo $booking->checkOut ?></th>


                            <?php 


                              if($booking->checkOut <= $timenow )
                              {




                                ?>





                                <th><?php echo "Booking Completed"; ?></th>
                            
                            <?php
                          }
                          else{
                            ?>
                            <th><?php echo "Booking Ongoing"; ?></th>
                            <?php


                          }
                            ?>
                             <th><a href="<?php echo $deleteLink; ?>" target="_blank" class="btnLogin">Delete Booking</a></td></th>
                            

                            

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