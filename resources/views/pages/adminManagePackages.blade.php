
 @extends('layout.default')

 @section('content')
 
 <style type="text/css">
      .hide{display:none}
    </style>
<script type="text/javascript">

  $(function() {
    
    var pageNum = 7;

    function pageselectCallback(page_index, jq){

        
        
         page_index = page_index*pageNum;
         $('#Searchresult').empty();
        
         for (i=0;i<pageNum;i++){
             str1 = '.dummy li:eq('+ (page_index + i)+')';
             console.log( str1);
             new_content = $(str1 ).clone();
             console.log(  new_content );
              $('#Searchresult').append(new_content);
         }

                return false;
     }
           
     /** 
       * Initialisation function for pagination
      */
    function initPagination() {
           // count entries inside the hidden content
          var num_entries = jQuery('.dummy li').length;

          // Create content inside pagination element
           $("#Pagination").pagination(num_entries, {
                    callback: pageselectCallback,
                    items_per_page:pageNum // Show only one item per page
          });

           $(".buildings-list1 .active a").click();
          
      }

    initPagination();
});
</script>
   
    </script> 
   <div class="banner">
        <div class="wrap">
             <h2>Manage All packages</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main">  
    <input type="hidden" id="token" value="{{ csrf_token() }}" />    
   <div class="project-wrapper">
    <div class="project-sidebar">
    <div class="project-list">
        <h4>All Buildings</h4>

        <ul class="buildings-list1"  id="Searchresult"></ul>
      <ul class="dummy hide">
      <?php $active=0;
          if (isset($buildings)){
                foreach($buildings as $building){
                                $link = "search?action=buildings&id=".$building->id."&limit=1";
                                ?>
                                    <li class="<?php echo ($active == 0) ? 'active' : '' ;?>"><img src="{{ URL::asset('images/arrow.png') }}" alt=""><p><a href="<?php echo $link; ?>"> <?php echo $building->buildingName  ?></a></p><div class="clear"></div></li>
                                <?php 
                                 $active++;
                            }

                        }
                    ?>
      </ul>
      <div id="Pagination"></div>
      <div class="clear"></div>
     </div>
     
     
     
   </div>


    <div class="building_wrapper1"></div>
   


   <div class="clear"></div>
  </div>
      
                                                                                                          
@stop