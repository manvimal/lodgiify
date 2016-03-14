
 @extends('layout.default')

 @section('content')

<?php

$now = new \DateTime();

?>

<link href="{{ URL::asset('css/rating.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ URL::asset('js/rating.js') }}"></script>
<script language="javascript" type="text/javascript"> </script>



 <script>
$(function() {
    $(".rating_star").codexworld_rating_widget({
        starLength: '5',
        initialValue: '',
        callbackFunctionName: 'processRating',
        imageDirectory: 'images/',
        inputAttr: 'postid'
    });
});

function processRating(val1, val2){
 
      $token = $("#token").val();
      $data =  {'bookingid': val2 ,'rating':val1,'_token':$token};
      
    $.ajax({
       
        type: 'post',
        url: '/insertRating',
        data: $data,
        dataType: 'json',
        success : function(data) {
            if (data.status == 'ok') {
                alert('You have rated '+val+' to CodexWorld');
              
            }else{
                alert('Some problem occured, please try again.');
            }
        }
    });
}

</script>
   <div class="banner">
        <div class="wrap">
             <h2>My Bookings</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main">  
   >    
    <div class="main-wrapper">
      
      <section >
        <h4>My Bookings</h4>
        <div class="contentHolder"  id="contentHolder">
             <form method="get" method="" >
             <input type="hidden" name="_token" id="token"  value="{{ csrf_token() }}" />
          <table align="center">
           
            <tr>
                <td><label>How would you rate our service</label></td>
                              <td><input name="rating" value="0" class="rating_star" type="hidden" postID="<?php echo $bookingid; ?>" /></td>
                             
    </tr>

    <tr>
            <td><label>Additional feedback</label></td>
            <td><input type="textarea" name="additionalFeedback" id="additionalFeedback"/></td>
            
    </tr>

    <tr>    
            <td></td>
            <td><input type="submit" name="submit" /></td>
    </tr>
          </table>
      </form>
      </div>
    </section>
     
     
  
    
   
   <div class="clear"></div>
  </div>
      
                                                                                                          
@stop