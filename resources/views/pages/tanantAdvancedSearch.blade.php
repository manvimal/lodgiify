
 @extends('layout.default')

 @section('content')



  <script>
  $(function() {
    $( "#buildingName" ).autocomplete({
      source: '/test'
    });
  });


   $(function() {
    $( "#buildingLocation" ).autocomplete({
      source: '/test2'
    });
  });
  </script>



   <div class="banner">
        <div class="wrap">
             <h2>Advanced Search</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main">  
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
    <div class="main-wrapper">
      
      <section >
        <h4>Advanced Search</h4>
        <div class="contentHolder"  id="contentHolder">


<div >
  <label>Building Name: </label>
  <input id="buildingName" name="buildingName">
</div>

<div >
  <label>Building Name: </label>
  <input id="buildingLocation" name="buildingLocation">
</div>



    
   
   <div class="clear"></div>
  </div>
    </div>
    </div>  
                                                                                                          
@stop