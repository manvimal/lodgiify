
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
                        <th class="number"> Image</th>
                         <th class="Name"> Name</th>
                          <th class="Phone"> Phone</th>
                           <th class="email"> Email</th>
                        <th class="vehicleName">Vehicle Name </span></th>
                        <th class="vehicleModel">Model </span></th>
                        <th class="type">Type </span></th>
                        <th class="From">From </span></th>
                        <th class="To">To </th>
                         <th class="price">Price </th>
                         <th class="driver">Driver </th>
                        <th class="action">Action</th>   

                        <th ></th> 
                        <th></th>                 
                    </tr>
                                   
                   <?php $i = 1;
                      foreach($vehicleBookings as $booking){ 
                          
                            
                            $deleteLink =  "/adminVehicleBooking/delete?id=". $booking->id;
                                 
                          ?>
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td> <img src="upload/<?php echo $booking->vehicle->image  ?>" class="imageSize"/></td>
                              <td><?php echo $booking->tenant->FirstName . '-' . $booking->tenant->LastName  ?></td>
                              <td><?php echo $booking->tenant->Phone; ?></td>
                              <td><?php echo $booking->tenant->Email; ?></td>
                              <td><?php echo $booking->vehicle->vehicleName  ?></td>
                              <td><?php echo $booking->vehicle->models  ?></td>
                              <td><?php echo $booking->vehicle->category->vehicleCatName  ?></td>
                              <td><?php echo $booking->fromdate  ?></td>
                              <td><?php echo $booking->todate  ?></td>
                               <td><?php echo "Rs " .$booking->vehicle->price  ?></td>
                              <td><?php if($booking->driver==false){echo 'No';}else{ echo 'Yes';}   ?></td>
                             

                              

                            
                              <td> <?php if (count($booking) > 0){  ?>  <a href="<?php echo $deleteLink; ?>" class="adminDeleteVehicleBooking btnLogin" >Delete</a></td>
                          
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