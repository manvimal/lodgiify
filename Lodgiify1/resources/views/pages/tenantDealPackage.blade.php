
 @extends('layout.default')

 @section('content')


  <!--Load Script and Stylesheet for datetimepicker-->
  <script type="text/javascript" src="{{ URL::asset('js/jquery.simple-dtpicker.js') }}"></script>
  <link type="text/css" href="{{ URL::asset('css/jquery.simple-dtpicker.css') }}" rel="stylesheet" />
  <script src="{{ URL::asset('js/googleMap.js') }}" type="text/javascript"></script>


   <div class="banner">
        <div class="wrap">
             <h2>Deals</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main tenantDealPackage">  
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
   <div class="project-wrapper">
    <div class="project-sidebar">

    <div class="project-list">
        
      <h4>Book Now</h4>
       <div class="contentHolder"  id="contentHolder">
        <div class="deals-list content">

        <form method="" name="registerBooking">
          <p><label class="whiteText">Package: </label>
          <select name = "package" id = "package" class="required"/>
             <option value="">--- PACKAGE ---</option>
             <?php if (isset($packages)){
                  foreach($packages as $package){
                     ?>
                          <option value="<?php echo $package->id ; ?>"> <?php echo $package->packageName ; ?></option>
                     <?php 
                    }
                  }
               ?>
          </select> <span class="errorMsg"></span>

         </P>
         <p><label class="whiteText">Number Of adults: </label>
         <input type = "text" name = "adults" id = "adults"   class="required numeric"/> <span class="errorMsg"></span></P>
         <p> <label class="whiteText">Number Of children: </label>
         <input type = "text" name = "children" id = "children" class="numeric" /> <span class="errorMsg"></span></P>
          <p><label class="whiteText">Check In: </label>
         <input type="text" name="date10" value="" class="required datetime"> <span class="errorMsg"></span></p>
          <p><label class="whiteText">Check Out: </label>
         <input type="text" name="date11" value="" class="required datetime"> <span class="errorMsg"></span></p>
          <p class="errorMsg1"></p>
           <p class="successMsg"></p>
         <p><input type = "submit" name = "submit" Value="Submit" class="btnAll bookPckNow"/></p>

         <form>
          
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
          <div class="no_package whiteText">Please select a package</div>
          <div class="got_package">
             <figure >
              <h2 class="whiteText"></h2>
             <img src="" width="100%" height="200" alt="package" /> 
              <p></p>
              <h3></h3>
             </figure> 

            <div class="pack_label">
               <div id="package_desc">
                  <h2 class="packageName "></h2>
                  Description: <span class="packageDesc"></span><br />
                  Children : <span class="capacityChildren"></span><br />
                  Adults : <span class="capacityAdult"></span><br />
                  category : <span class="roomCatName"></span><br />
               </div>

                <div class="promotion">
                  Promotion Description: <span class="promotionDescription"></span><br />
                  promotionExpiryDate : <span class="promotionExpiryDate"></span><br />
                  
               </div>
           </div>
         </div>
    </div>
   


 

   <div class="clear"></div>
  </div>
      
                                                                                                          
@stop