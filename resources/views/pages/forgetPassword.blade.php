
 @extends('layout.default')

 @section('content')

   <div class="banner">
      	<div class="wrap">
      	     <h2>Forget password</h2><div class="clear"></div>
      	</div>
    </div>
	<div class="main forgetPassword">	
        
	 <div class="project-wrapper">
	   <div class="project">
	    <div class="blog-left">
			<div class="blog-bg">
			   <h4>Forget password</h4><span class="author"><?php if (isset($msg) && $msg['statuspost']) {
			   		print "Enter new password";
			   } else{
			   		print "Enter your username";
			   }  ;?>

				</span><div class="clear"></div>
			</div>


			<div class="blog-img">

    <form method="post"  action="/user/forgetPasswordProcess" onSubmit="return validateforgetPassword(this, <?php print (isset($msg) && ($msg['statuspost'] == 1)) ? 1 : 0;?>)">
    
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />      
    <table class="alignLeft container ">
        
<?php if ( (!isset($msg) )  || ($msg['statuspost'] == -1)) {?>
			   		 <tr>
        	<td><label>User Name:</label></td>
            <td> <input type="text" class="required clearAll" name = "userName" value="<?php print isset($userforget) ? $userforget->UserName : '' ?>" id ="userName"?><span class="errorMsg"></span></td>
        </tr>
		<?php	   }   ;?>

       

        		<?php if  (isset($msg) && ($msg['statuspost'] == 1)) { ?>
			   		 <tr>
			            <td><label>Password: </label></td>
			            <td><input type="hidden" value="<?php print $hash; ?>" name = "hash" id ="hash" /> <input type="hidden" value="<?php print isset($userforget) ? $userforget->id : ''?>" name = "id" id ="id" /><input type = "Password" class="required clearAll" name="Password" id = "Password" /> <span class="errorMsg"></span></td>
			         </tr> 

			        <tr>  
			            <td><label>Confirm Password: </label></td>
			            <td><input type = "Password" class="required password clearAll" name="confirmPassword" id = "confirmPassword" /><span class="errorMsg"></span> </td>
			        </tr>
			    <?php }  ?>




            <tr>
                <td></td>
            <td align="center"><input type = "submit" id = "submit" value = "Submit"  class="btnLogin" ></td>
            <td></td>
            </tr>

             <tr>
                <td></td>
            <td align="center" id="regMessage"></td>
            <td></td>
            </tr>

            <tr >

            	<td colspan="3" ><span class="gblError"><?php print (isset($msg) && ($msg['statuspost'] == -1)) ? $msg['msgpost'] : "" ;?></span></td>
            </tr>

        </table>
          </form>
			</div>

		</div>
	   <div class="clear"></div>
	 
	 </div>
	 


	 <div class="clear"></div>
  </div>
   		
@stop