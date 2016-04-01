
 @extends('layout.default')

 @section('content')

<?php

$now = new \DateTime();

?>

 <script>
$(function() {
    var pageNum = 7;

    function pageselectCallback(page_index, jq){

        page_index = page_index*pageNum;
         $('#Searchresult').empty();

          var new_contentH = jQuery('.main-dummy tr:eq(0)').clone();
            $('#Searchresult').empty().append(new_contentH);

         for (i=0;i<pageNum;i++){
             str1 = '.main-dummy .booking:eq('+ (page_index+i)+')';
             
             new_content = $(str1 ).clone();
           
              $('#Searchresult').append(new_content);
         }

        
        
                return false;
     }
           
     /** 
       * Initialisation function for pagination
      */
    function initPagination() {
           // count entries inside the hidden content
          var num_entries = jQuery('.booking').length;
       
          // Create content inside pagination element
           $("#Pagination").pagination(num_entries, {
                    callback: pageselectCallback,
                    items_per_page:pageNum // Show only one item per page
          });
      }

    initPagination();
});



</script>
<style type="text/css">
      .hide{display:none}
    </style>
   <div class="banner">
        <div class="wrap">
             <h2>Vehicle</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main">  
    <input type="hidden" name="_token" id="token"  value="{{ csrf_token() }}" />    
    <div class="main-wrapper">
      
      <section >
        <h4>My Vehicle Bookings</h4>
        <div class="contentHolder main-list content"  id="contentHolder">
          <table border="1" align="center" id="Searchresult">
                                </table>
          <table class="main-dummy hide" border="1" align="center">
            <?php if (isset($vehicleBookings)){ ?>
                    <tr>             
                        <th class="number"> Number</th>
                        <th class="image"> Image</th>
                        <th class="buildingName">Vehicle Name </span></th>
                        <th class="vehicleMdel">Model </span></th>
                        <th class="type">Type </span></th>
                        <th class="From">From </span></th>
                        <th class="To">To </th>
                         <th class="price">Price </th>
                         <th class="price">Driver </th>
                        <th class="action">Action</th>   

                        <th ></th> 
                        <th></th>                 
                    </tr>
                                   
                   <?php $i = 1;
                      foreach($vehicleBookings as $booking){ 
                          
                            
                            $deleteLink =  "/vehicleBooking/delete?id=". $booking->id;
                            $viewBookingLink =  "/vehicleBooking/view?id=". $booking->id;
                         
                            $getDirection =  "/vehicleBooking/getDirections?lattitude=". $booking->pickuplat."&longitude=". $booking->pickuplong . "&vehiclebookingid" . $booking->id;;
                    
                              
                          ?>
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td> <img src="upload/<?php echo $booking->vehicle->image  ?>" class="imageSize"/></td>
                              <td><?php echo $booking->vehicle->vehicleName  ?></td>
                              <td><?php echo $booking->vehicle->models  ?></td>
                              <td><?php echo $booking->vehicle->category->vehicleCatName  ?></td>
                              <td><?php echo $booking->fromdate  ?></td>
                              <td><?php echo $booking->todate  ?></td>
                               <td><?php echo "Rs " .$booking->price  ?></td>
                              <td><?php if($booking->vehicle->driver==false){echo 'No';}else{ echo 'Yes';}   ?></td>
                             

                              

                              <td> <?php if (count($booking) > 0){  ?>  <a href="<?php echo $viewBookingLink; ?>" class="Order btnLogin" target="_blank">View booking</a>  <a href="<?php echo $deleteLink; ?>" class="deleteVehicleBooking btnLogin" >Delete</a></td>
                              <?php
                              if($booking->driver == true){ 
                                 ?>
                              <td><a href="<?php echo $getDirection; ?>" target="_blank" class="direction btnLogin">Pickup Location</a>  <?php } ?></td>
                           
                                 <?php


                              }
                              ?>
                            </tr> 
                           <?php 
                            $i ++;
                              }

                          }


                     
                      
                      else{
                         ?>

                      

                      <tr class="booking">
                              <td colspan="5" style="text-align: center;"><p>No Booking done yet</p> </td>
                              
                            </tr> 
                            <?php
                    }
                    ?>
          </table>

 


          <div id="Pagination"></div>
      </div>
    </section>

   
   <div class="clear"></div>
  </div>
      
                                                                                                          
@stop