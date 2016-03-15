
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
      var $html='';
    $.ajax({
       
        type: 'post',
        url: '/insertRating',
        data: $data,
        dataType: 'json',
        success : function(data) {
            if (data.status == -1){
                $html += "<span class='errorMsg'>";
                $html += data.msg ;
                $html += "</span>";

            }
            else if(data.status == 1){
                $html += "<span class='successMsg'>";
                $html += data.msg ;
                $html += "</span>";
                 window.setTimeout(function(){location.reload()},2000)

            }
            $('#logMsg').html($html);
        
        }
    });
}

</script>
   <div class="banner">
        <div class="wrap">
             <h2>FeedBack</h2><div class="clear"></div>
        </div>
    </div>
  <div class="main">  
   >    
    <div class="main-wrapper">
      
      <section >
        <h4>My feedback</h4>
        <div class="contentHolder"  id="contentHolder">
             <form method="get"  >
             <input type="hidden" name="_token" id="token"  value="{{ csrf_token() }}" />
          <table align="center">
      <?php
        if(empty($checkExists))
          {
        ?>
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

            <tr>
              <td></td>
               <td> <p id="logMsg"> </p></td>
             
            </tr>
    <?php
  }
 
  else{

    ?>
<p>You have already voted. Thank you for your feedback</p>

    <?php

    if($checkExists[0]->numofstar == 1){
      ?>

      <ul class="codexworld_rating_widget"><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>1</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px 0px;"><span>2</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px 0px;"><span>3</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px 0px;"><span>4</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px 0px;"><span>5</span></li></ul> 
      <?php
    }
    if($checkExists[0]->numofstar == 2){
      ?>
      <ul class="codexworld_rating_widget"><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>1</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>2</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px 0px;"><span>3</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px 0px;"><span>4</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px 0px;"><span>5</span></li></ul>
      <?php
    }
    if($checkExists[0]->numofstar == 3){
      ?>
    
      <ul class="codexworld_rating_widget"><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>1</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>2</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>3</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px 0px;"><span>4</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px 0px;"><span>5</span></li></ul>
      <?php
    }
    if($checkExists[0]->numofstar == 4){
      ?>
    <ul class="codexworld_rating_widget"><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>1</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>2</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>3</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>4</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px 0px;"><span>5</span></li></ul>
      <?php
    }
    if($checkExists[0]->numofstar == 5){
      ?>
      <ul class="codexworld_rating_widget"><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>1</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>2</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>3</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>4</span></li><li style="background-image: url(&quot;images//widget_star.gif&quot;); background-position: 0px -28px;"><span>5</span></li></ul>
      <?php
  
    }
  }
  ?>

  </table>

</form>

      </div>
   
    </section>
     
     
  
    
   
   <div class="clear"></div>
  </div>
      
                                                                                                          
@stop