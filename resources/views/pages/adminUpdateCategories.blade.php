
 @extends('layout.default')

 @section('content')


 <?php 

if(isset($roomCat)){
?>
  <script type="text/javascript">

$(document).ready(function() {
             $('#h4Hide1').show();
            $('#h4Hide2').hide();
            $('#h4Hide3').hide();

  
            $('#secondR').hide();
            $('#firstR').show();
            $('#thirdR').hide();
            $('#fourthR').show();
             
});


</script>
<?php
}
?>



<?php

if(isset($buildingCat)){
?>

<script type="text/javascript">

$(document).ready(function() {
            $('#h4Hide1').hide();
            $('#h4Hide2').show();
            $('#h4Hide3').hide();

  
            $('#secondR').show();
            $('#firstR').hide();
            $('#thirdR').hide();
            $('#fourthR').show();
            

});

</script>

<?php
}
?>




<?php
if(isset($vehicleCat)){

?>

<script type="text/javascript">

$(document).ready(function() {
            $('#h4Hide1').hide();
            $('#h4Hide2').hide();
            $('#h4Hide3').show();

  
            $('#secondR').hide();
            $('#firstR').hide();
            $('#thirdR').show();
            $('#fourthR').show();
            

});

</script>

<?php
}
?>



   <div class="banner">
        <div class="wrap">
             <h2>Update Categories</h2><div class="clear"></div>
            
        </div>
    </div>
  <div class="main">  
        
   <div class="project-wrapper">
     <div class="project">
      <div class="blog-left">
      <div class="blog-bg">

         <h4 id="h4Hide1">Update Room Category</h4>
         <h4 id="h4Hide2">Update Building Category</h4>
         <h4 id="h4Hide3">Update Vehicle Category</h4>

         <span class="author">Update Categories</span><div class="clear"></div>
      </div>


      <div class="blog-img">


<form method="get"  action="/updateCategories" onSubmit="">
    
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />  
    <table>

        <tr id="firstR">
            <td><label>Room Category Name:</label></td>
            <td> <input type="text" class="required onlyLetters" name = "roomCatName" value="<?php if(isset($roomCat)) echo $roomCat[0]->roomCatName; ?>" id = "roomCatName"/><span class="errorMsg"></span> </td>
        </tr>

         <input type="hidden" name="roomCategoryID" value="<?php if(isset($roomCat)) echo $roomCat[0]->id; ?>" /> 
          
          
        <tr id="secondR">
            <td><label>building Category Name:</label></td>
            <td> <input type="text" class="required onlyLetters" value="<?php if(isset($buildingCat)) echo $buildingCat[0]->buildingCatName; ?>" name = "buildingcatName" id = "buildingcatName"/><span class="errorMsg"></span> </td>
        </tr>

         <input type="hidden" name="buildingCategoryID" value="<?php if(isset($buildingCat)) echo $buildingCat[0]->id; ?>" />
        
         <tr id="thirdR">
            <td><label>Vehicle Category Name:</label></td>
            <td> <input type="text" class="required onlyLetters" value="<?php if(isset($vehicleCat)) echo $vehicleCat[0]->vehiclecatname; ?>" name = "vehiclecatName" id = "vehiclecatName"/><span class="errorMsg"></span> </td>
        </tr>

          <input type="hidden" name="vehicleCategoryID" value="<?php if(isset($vehicleCat)) echo $vehicleCat[0]->id; ?>" />
    
     <tr id="fourthR">
            <td></td>
            <td> <input type="submit" class="btnLogin" name="submit"/> </td>
        </tr>
        </table>
          </form>


      </div>

    </div>
     <div class="clear"></div>
   
   </div>
   <div class="project-sidebar">
    <div class="project-list">
     <div class="search_box">
      <form>
        <input type="text" value="Search...." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
        <input type="submit" value="">
      </form>
     </div>
    </div>
    
     
    
     
   </div>


   <div class="clear"></div>
  </div>
      
@stop