
 @extends('layout.default')

 @section('content')


<script type="text/javascript">
function confirm_alert(node) {
    return confirm("Please click on OK to delete tenant.");

    onclick="return confirm_alert(this);"
}
</script>



   <div class="banner">
        <div class="wrap">
             <h2>View Tenant</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main">  
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
    <div class="main-wrapper">
      
      <section >
        <h4>View, Edit and Delete Tenant</h4>
        <div class="contentHolder"  id="contentHolder">


 <table class="main-list content" border="1" align="center">
            <?php if (isset($roomCategories)){ ?>
                    <tr class="booking"> 
                        <th class="catNumbr"> Category Number</th>        
                        <th class="catName"> Category Name</th>
                         <th class="catType"> Category Type</th>
                         <th class="catAction">Action</th>
                                        
                    </tr>
                                   
                   <?php $i = 1;
                      foreach($roomCategories as $roomCategory){ 
                       
                                 $deleteLink =  "/roomCategory/delete?id=". $roomCategory->id;
                                   $updateLink =  "/roomCategory/update?id=". $roomCategory->id;
                          ?>

                       
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $roomCategory->roomCatName;  ?></td>
                              <td><?php echo "Room Category";  ?></td>
                            
                              <td> <?php if (count($roomCategory->id) > 0){  ?> <a href="<?php echo $updateLink; ?>" class="btnLogin" >Update</a>  <?php } ?>  <a href="<?php echo $deleteLink; ?>" class="btnLogin" onclick="return confirm_alert(this);" >Delete</a></td>
                           
                            
                            </tr> 
                           <?php 
                            $i ++;
                              }

                              ?>


                              <?php
                      foreach($buildingCategories as $buildingCategory){ 
                       
                                 $deleteLink =  "/buildingCategory/delete?id=". $buildingCategory->id;
                                  $updateLink =  "/buildingCategory/update?id=". $buildingCategory->id;
                          ?>

                       
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $buildingCategory->buildingCatName;  ?></td>
                              <td><?php echo "Building Category";  ?></td>
                             
                              <td> <?php if (count($buildingCategory->id) > 0){  ?> <a href="<?php echo $updateLink; ?>" class="btnLogin" >Update</a>  <?php } ?>  <a href="<?php echo $deleteLink; ?>" class="btnLogin" onclick="return confirm_alert(this);" >Delete</a></td>
                           
                            
                            </tr> 
                           <?php 
                            $i ++;
                              }

                              ?>

                                      <?php 
                      foreach($vehicleCategories as $vehicleCategory){ 
                       
                                 $deleteLink =  "/vehicleCategory/delete?id=". $vehicleCategory->id;
                             $updateLink =  "/vehicleCategory/update?id=". $vehicleCategory->id;
                          ?>

                       
                           <tr class="booking">
                              <td><?php echo $i ;?> </td>
                              <td><?php echo $vehicleCategory->vehiclecatnameType;  ?></td>
                              <td><?php echo "Vehicle Category";  ?></td>
                              <td> <?php if (count($vehicleCategory->id) > 0){  ?> <a href="<?php echo $updateLink; ?>" class="btnLogin" >Update</a>  <?php } ?>  <a href="<?php echo $deleteLink; ?>" class="btnLogin" onclick="return confirm_alert(this);" >Delete</a></td>
                           
                            
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