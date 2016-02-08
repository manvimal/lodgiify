
 @extends('layout.default')

 @section('content')


  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6v5-2uaq_wusHDktM9ILcqIrlPtnZgEk&sensor=false">
    </script>

   <div class="banner">
        <div class="wrap">
             <h2>Google Map Direction</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main">  
        
   <div class="project-wrapper">
     <div class="project">
      <div class="blog-left">
      <div class="blog-bg">
         <h4>Get direction</h4>
      </div>


      <div class="blog-img">

    
           <table >
        <tr>
            <td>
                <div id="MyMapLOC" style="width: 100%; height: 400px">
                </div>
                <div id="MapRoute" style="width: 500px; height: 500px">
                </div>
            </td>
        </tr>
      </table>
 

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
    <div class="project-list">
        <h4>My Buildings</h4>
      <ul class="blog-list">
     
      </ul>
      
      <div class="clear"></div>
     </div>
     
     
     
   </div>


   <div class="clear"></div>
  </div>
      
  
 <script src="{{ URL::asset('js/getDirections.js') }}" type="text/javascript"></script>
      <script type="text/javascript">
     //document.getElementById('image').addEventListener('change', handleFileSelect, false);
     var lattitide ="<?php echo $_GET['lattitude']; ?>";
     var longitude ="<?php echo $_GET['longitude']; ?>";
     var name ="<?php echo $_GET['building']; ?>";

     getDynamicLocation(lattitide, longitude, name);
  </script>     
                                                                                                   
@stop