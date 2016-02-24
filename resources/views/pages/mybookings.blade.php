
 @extends('layout.default')

 @section('content')


   <div class="banner">
        <div class="wrap">
             <h2>My Bookings</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main">  
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
    <div class="main-wrapper">
      
      <section >
        <h4>My Bookings</h4>
        <div class="contentHolder"  id="contentHolder">
          <table class="main-list content" border="1" align="center">
            <?php if (isset($bookings)){ ?>
                    <tr class="booking">             
                        <th class="package"> Number</th>
                        <th class="checkin">Check in date </span></th>
                        <th class="checkout">Check out date </th>
                        <th class="adults">No adults </th>      
                        <th class="children">No children </th>    
                        <th class="Action">Action </th>                 
                    </tr>
                                   
                   <?php $i = 1;
                      foreach($bookings as $booking){ 
                            if (count($booking->packages) > 0){
                                 $lattitude = $booking->packages[0]-> building->lattitude ;
                                 $longitude = $booking->packages[0]-> building->longitude ;
                                 $building = $booking->packages[0]-> building->buildingName . " : ".  $booking->packages[0]-> building->buildingLocation;
                                 $getDirection =  "/booking/getDirections?lattitude=". $lattitude."&longitude=".$longitude."&building=" .$building;
                            } 
                            
                            $deleteLink =  "/booking/delete?id=". $booking->id;
                            $viewBookingLink =  "/booking/viewBooking?id=". $booking->id;
                              
                          ?>
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $booking->checkin  ?></td>
                              <td><?php echo $booking->checkOut  ?></td>
                              <td></td>
                              <td></td>
                              <td> <?php if (count($booking->packages) > 0){  ?> <a href="<?php echo $getDirection; ?>" target="_blank" class="direction btnLogin">Get directions</a>  <?php } ?> <a href="<?php echo $viewBookingLink; ?>" class="Order btnLogin" target="_blank">View booking</a>  <a href="<?php echo $deleteLink; ?>" class="deleteBooking btnLogin" >Delete</a></td>
                           
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