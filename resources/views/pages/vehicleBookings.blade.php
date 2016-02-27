
 @extends('layout.default')

 @section('content')




   <div class="banner">
        <div class="wrap">
             <h2>Vehicle bookings</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main tenantDealPackage">  
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
   <div class="project-wrapper vehicleBooking-wrapper">
   


      <?php if (isset($bookings)){    ?>
        
           <table border="1">
            <tr class="trheader" >
              <th>Client</th>
              <th>Contact client</th>
               <th>Vehicle</th>
                <th>Booking id</th>
                 <th>Pickup time</th>
                  <th>pickup Location</th>
                   <th>Pickup Destination</th>


               
              </tr>
              <?php
               foreach($bookings as $booking){
            
                    ?>
                         <tr>
                           
                             <th><?php echo $booking->booking->tenant->FirstName .' '.$booking->booking->tenant->LastName  ?></th>
                             <th><?php echo $booking->booking->tenant->Phone ?></th>
                          
                             <th><?php echo $booking->vehicle->vehicleName ?></th>
                            <th><?php echo $booking->booking->id ?></th>
                             <th><?php echo $booking->pickUpTime1 ?></th>
                            <th><?php echo $booking->pickUpLocation1 ?></th>
                             <th><?php echo $booking->pickUpDestination1 ?></th>


                          </tr>
                      <?php 
                }
                ?>
       </table>
       
    <?php   }   ?>

     
                  
    


     
     
   

   <div class="clear"></div>
  </div>
      </div>
                                                                                                          
@stop