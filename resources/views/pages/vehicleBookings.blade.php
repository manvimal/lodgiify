
 @extends('layout.default')

 @section('content')


  <!--Load Script and Stylesheet for datetimepicker-->
  <script type="text/javascript" src="{{ URL::asset('js/jquery.simple-dtpicker.js') }}"></script>
  <link type="text/css" href="{{ URL::asset('css/jquery.simple-dtpicker.css') }}" rel="stylesheet" />
  <script src="{{ URL::asset('js/googleMap.js') }}" type="text/javascript"></script>


   <div class="banner">
        <div class="wrap">
             <h2>Vehicle bookings</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main tenantDealPackage">  
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
   <div class="project-wrapper">
   


      <?php if (isset($bookings)){    ?>
        
           <table border="1">
            <tr>
             
               <th>Vehicle</th>
                <th>Booking id</th>
                 <th>Pickup time</th>
                  <th>pickup Location</th>
                   <th>Pickup Destination</th>


                <th>Return time</th>
                  <th>Return Location</th>
                   <th>Return Destination</th>
              </tr>
              <?php
               foreach($bookings as $booking){

               // var_dump($booking->booking);die;
                    ?>
                         <tr>
                           
                             <th><?php echo $booking->vehicle->vehicleName ?></th>
                            <th><?php echo $booking->booking->id ?></th>
                             <th><?php echo $booking->pickUpTime1 ?></th>
                            <th><?php echo $booking->pickUpLocation1 ?></th>
                             <th><?php echo $booking->pickUpDestination1 ?></th>


                            <th><?php echo $booking->pickUpTime2 ?></th>
                             <th><?php echo $booking->pickUpLocation2 ?></th>
                             <th><?php echo $booking->pickUpDestination2 ?></th>
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