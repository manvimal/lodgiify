
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
             <h2>My Bookings</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main">  
    <input type="hidden" name="_token" id="token"  value="{{ csrf_token() }}" />    
    <div class="main-wrapper">
      
      <section >
        <h4>My Bookings</h4>
        <div class="contentHolder main-list content"  id="contentHolder">
          <table border="1" align="center" id="Searchresult">
                                </table>
          <table class="main-dummy hide" border="1" align="center">
            <?php if (isset($bookings)){ ?>
                    <tr>             
                        <th class="package"> Number</th>
                        <th class="buildingName">Building Name </span></th>
                        <th class="buildingCategory">Type </span></th>
                        <th class="buildingLoc">Location </span></th>
                        <th class="checkin">Check in date </span></th>
                        <th class="checkout">Check out date </th>
                        <th class="price">Price</th>
                        <th class="adults">No adults </th>      
                        <th class="children">No children </th> 
                        <th class="action">Action</th>   

                        <th ></th> 
                        <th></th>                 
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
                            $feedbackLink =  "/tenantfeedback?id=". $booking->id;
                              
                          ?>
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $booking->building->buildingName  ?></td>
                              <td><?php echo $booking->building->category->buildingCatName;  ?></td>
                              <td><?php echo $booking->building->buildingLocation  ?></td>
                              <td><?php echo $booking->checkin  ?></td>
                              <td><?php echo $booking->checkOut  ?></td>
                              <td><?php echo "Rs " .$booking->price  ?></td>
                              <td><?php echo $booking->packages[0]->capacityAdult ?></td>
                              <td><?php echo $booking->packages[0]->capacityChildren ?></td>
                              

                              <td> <?php if (count($booking->packages) > 0){  ?> <a href="<?php echo $getDirection; ?>" target="_blank" class="direction btnLogin">Get directions</a>  <?php } ?> <a href="<?php echo $viewBookingLink; ?>" class="Order btnLogin" target="_blank">View booking</a>  <a href="<?php echo $deleteLink; ?>" class="deleteBooking btnLogin" >Delete</a></td>
                              <?php
                              if($booking->checkOut < $now){ 
                                 ?>
                              <td> <a href="<?php echo $feedbackLink; ?>" target="_blank" class="direction btnLogin">Leave Feedback</a></td>
                           
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