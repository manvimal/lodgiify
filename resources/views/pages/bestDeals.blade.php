
 @extends('layout.default')

 @section('content')
<script>
$(document).ready(function () {
      $('#flexibleDate').change(function(){
        if ($('#flexibleDate').prop('checked')) {
            $('.HideIfChecked').hide();
            
        }
        else {
            $('.HideIfChecked').show();
        }
    });



});



</script>

 <script type="text/javascript" src="{{ URL::asset('js/jquery.simple-dtpicker.js') }}"></script>
  <link type="text/css" href="{{ URL::asset('css/jquery.simple-dtpicker.css') }}" rel="stylesheet" />

  <script>
  $(function() {
    $( "#buildingName" ).autocomplete({
      source: "{{ URL::asset('/buildingSuggestion') }}"
    });
  });

    
  
  </script>


   <div class="banner">
        <div class="wrap">
             <h2>Deals</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main" id="bestDeals">  
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
   <div class="project-wrapper">
    <div class="project-sidebar">

    <div class="project-list">
       
      <h4>Recently Posted</h4>
       <div class="contentHolder"  id="contentHolder">
        <div class="deals-list content">
          <?php if (isset($buildings)){
                  foreach($buildings as $building){
                                  $link = "search?action=buildings&id=".$building->id ."&limit=1";
                                  ?>
                                      <div class="recently-posted-building">
                                        <?php if (!empty($building->image)) {?>
                                          <img src="{{ URL::asset('/') }}upload/<?php echo $building->image ;  ?> " alt="" width="50" height="50">
                                        <?php } ?>
                                        
                                        
                                         
                                         <p >
                                            <span class="name"><?php echo $building->category->buildingCatName  ?> - <?php echo $building->buildingName  ?></span>
                                            <span class="des">
                                              <?php echo $building->desc  ?>
                                            </span>
                                          </p>
                                        <a  href="{{ URL::asset('/') }}package/<?php echo $building->id?>" data-buildingId="<?php echo $building->id?>" data-buildingName="<?php echo $building->buildingName?>">Book now</a>
                                        <div class="clear"></div></div>
                                  <?php 
                              }

                          }
                      ?>
        </div>
    </div>
     
     </div>
     
     
     
   </div>
    <h1>Advanced Search</h1>
    <div class="building_wrapper">



        <div class="contentHolder"  id="contentHolder">

<form method="post" action="{{ URL::asset('/getAdvancedSearch') }}"/>

<input type="hidden" name="_token" value="{{{ csrf_token() }}}" /> 
<div class="bestdealsHeader">
      <input id="buildingName" value="" placeholder="Building Name" name="buildingName"/>


      <input id="buildingLocation" placeholder="Building Location" name="buildingLocation"/>


      <select type="text" class="required onlyLetters" name = "buildingCat" id ="buildingCat" > 

           <option value="-1">-- Building Categories --</option>
                    <?php 
                        if (isset($buildingCategories)){

                            foreach($buildingCategories as $buildingCategory){
                                ?>
                                    <option value="<?php echo $buildingCategory->id ?>"> <?php echo  $buildingCategory->buildingCatName  ?></option>
                                <?php 
                            }
                        }
                    ?>
      </select>


      <select type="text"  name = "buildingFacility" id ="buildingFacility" > 
        <option value="">-- Building Facilities --</option>
                    <?php 
                        if (isset($Facilities)){
                            foreach($Facilities as $facilityind){

                       
                                ?>
                                    <option value="<?php echo $facilityind->id ?>"> <?php echo  $facilityind->name  ?></option>
                                <?php 
                            
                          }

                        }
                    ?>
      </select>


      <input type="text" name="numOfPeople" placeholder="Number of people" />
      <span class="flexibleDate"><input type="checkbox" name="flexibleDate" id="flexibleDate" value="flexibleDate"/>My dates are flexible</span>




      <div class="HideIfChecked">
          <div><label>Check In:</label>
              <input type="text" id="checkIn" name="checkIn" />
              <label>Check Out:</label>
              <input type="text" id="checkOut" name="checkOut"/> 
          </div>

      </div>


   
    </div>

      
<div class="advheader2">
  Rooms: 
  <input type="radio" name="numOfRooms" value="oneRoom" checked/>1
  <input type="radio" name="numOfRooms" value="twoRoom"/>2
  <input type="radio" name="numOfRooms" value="threeRoom"/>3
  <input type="radio" name="numOfRooms" value="fourRoom"/>4
  <input type="radio" name="numOfRooms" value="moreRooms"/>More

  <input type="submit" name="submit" id="advancedSearch" value="Search"/>
</div>


</form>

          <script type="text/javascript">
        $(function(){
          $('*[name=checkIn]').appendDtpicker({
            "closeOnSelected": true
          });
        });
        $(function(){
          $('*[name=checkOut]').appendDtpicker({
            "closeOnSelected": true
          });
        });
      </script>
   
   <div class="clear"></div>
  </div>

<div id="AdvSearchResult">

    <div class="clear"></div>
</div>
    </div>
   


 <!-- start magnific-->
   <div id="small-dialog" class="mfp-hide popup">
        <h1>title</h1>
        <form name="/booking/register" method="post" >
          <div id = "tabs">
           <ul>
              <li><a href = "#tabs-1">Basic info</a></li>
              <li><a href = "#tabs-2">Rooms</a></li>
              <li><a href = "#tabs-3">Vehicle</a></li>
           </ul> 
        
           <div id = "tabs-1">
                 <p><label>Number Of people: </label><input type = "text" id = "NumOfPeople" name = "NumOfPeople" /> </p>
                 <p><label>Min Price: </label><input type = "text" id = "minPrice" name = "minPrice" /> </p>
                 <p><label>Max Price: </label><input type = "text" id = "maxPrice" name = "maxPrice" /> </p>
                <p><label>Room type: </label> <select type="text" class="required onlyLetters" name="roomCategory" id ="ddlroomCategory" > </select> </p>

           </div>
        
           <div id = "tabs-2">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                 sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                 nisi ut aliquip ex ea commodo consequat. </p>
           </div>
        
           <div id = "tabs-3">
              <p>ed ut perspiciatis unde omnis iste natus error sit 
                 voluptatem accusantium doloremque laudantium, totam rem aperiam, 
                 eaque ipsa quae ab illo inventore veritatis et quasi architecto 
                 beatae vitae dicta sunt explicabo.  </p>
            
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                 sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                 nisi ut aliquip ex ea commodo consequat. </p>
           </div>
        
        </div>
      </form>
   </body>                                
   </div>
  <!-- end magnific-->

   <div class="clear"></div>
  </div>
      
                                                                                                          
@stop