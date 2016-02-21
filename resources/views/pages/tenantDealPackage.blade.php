
 @extends('layout.default')

 @section('content')


  <!--Load Script and Stylesheet for datetimepicker-->
  <script type="text/javascript" src="{{ URL::asset('js/jquery.simple-dtpicker.js') }}"></script>
  <link type="text/css" href="{{ URL::asset('css/jquery.simple-dtpicker.css') }}" rel="stylesheet" />
 

   <div class="banner">
        <div class="wrap">
             <h2>Deals</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main tenantDealPackage">  
      <form method="" name="registerBooking">

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />    
   <div class="project-wrapper">
    <div class="project-sidebar">

    <div class="project-list">
        
      <h4>Book Now</h4>
       <div class="contentHolder"  id="contentHolder">
        <div class="deals-list content">

      
        
         
          <p><label class="whiteText">Check In: </label>
         <input type="text" name="date10" value="" class="required datetime"> <span class="errorMsg"></span></p>
          <p><label class="whiteText">Check Out: </label>
         <input type="text" name="date11" value="" class="required datetime"> <span class="errorMsg"></span></p>
          <p class="errorMsg1"></p>
           <p class="successMsg"></p>
         <p><input type = "submit" name = "submit" Value="Submit" class="btnAll bookPckNow"/></p>

          
      <!--DateTimePicker -->
      <script type="text/javascript">
        $(function(){
          $('*[name=date10]').appendDtpicker({
            "closeOnSelected": true
          });
        });
        $(function(){
          $('*[name=date11]').appendDtpicker({
            "closeOnSelected": true
          });
        });
      </script>
                                 
        </div>
    </div>
     
     </div>
     
     
     
   </div>
    <div class="package_wrapper ">
          <div class="got_package whiteText">Please select a package</div>
          <div class="no_package">
             <figure >


              <h2 class="whiteText"><?php echo (isset($building->buildingName) ? $building->buildingName : ''); ?></h2>

              <div style="height:200px;background-repeat: no-repeat;background-size:contain;background-position:50%;background-color:#DAD6E2; background-image:url({{ URL::asset('/') }}upload/<?php  echo isset($building->image)? $building->image : ''; ?>)" ></div>
             
              <p><?php echo isset($building->desc)?  $building->desc : ''; ?></p>
              <!-- <h3><?php echo isset($building->rooms)?  count($building->rooms) : 0; ?></h3> -->
             </figure> 



          <?php if (isset($packages)){
                   $index = "odd";
                   $i =0;
                  foreach($packages as $package){

                     ?>
                         
                          <div class="pack_label <?php echo  $index ; ?>">
                            <div id="package_chk">
                                <h2 class="packageName "><?php echo $package->packageName ; ?></h2>
                                <input type="checkbox" name="packages[<?php echo $i; ?>][package]" value="<?php echo $package->id ; ?>" />
                             </div>

                              <div id="package_number">
                               
                                
                                 <p> Adults: <select name="packages[<?php echo $i; ?>][adult]" class="required numeric">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                 </select> <span class="errorMsg"></span></P> 
                               <p>Children: <select name="packages[<?php echo $i; ?>][child]" class="numeric" ><option value="0">0</option>
                                   <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option></select>  <span class="errorMsg"></span></P> 
                             </div>

                             <div id="package_desc">
                               
                                Description: <span class="packageDesc"><?php echo $package->packageDesc ; ?></span><br />
                                Children : <span class="capacityChildren"><?php echo $package->capacityChildren ; ?></span><br />
                                Adults : <span class="capacityAdult"><?php echo $package->capacityAdult ; ?></span><br />
                                category : <span class="roomCatName"><?php echo $package->roomCatName ; ?></span><br />
                             </div>

                              <div class="promotion">
                                Promotion Description: <span class="promotionDescription"><?php echo $package->promotionDescription ; ?></span><br />
                                promotionExpiryDate : <span class="promotionExpiryDate"><?php echo $package->promotionExpiryDate ; ?></span><br />
                                
                             </div>
                     </div>
                     <?php 
                      $i++;
                      if ( $index == 'odd'){
                         $index = "even";
                      }
                      else if( $index =="even") {
                         $index = "odd";
                      }
                    }
                  }
               ?>
            
         </div>
    </div>
   



   <div class="clear"></div>


         </form>
  </div>
      
                                                                                                          
@stop