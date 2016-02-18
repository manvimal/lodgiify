<div class="header">	
	<input type="hidden" id="token" name="_token" value="{{{ csrf_token() }}}" />
      <div class="wrap"> 
	         <div class="logo">
				<a href="index"><img src="{{ URL::asset('images/logo.png') }}" alt=""/></a>
			 </div>

			 <!-- login  -->
			 <?php

				if (empty($user)){
			 ?>
				<form name="login" action="{{ URL::asset('/user/login') }}" onsubmit="return validateLogin(this)">
					<table class="login">
							<tr>
							<td>User Name:</td> 
							<td><input type="text" name="LoginUserName" class="required" /><br /><span class="errorMsg"></span> </td>
						
							<td>Password:</td> 
							<td><input type="password" name="LoginPassword" class="required" /> <br /><span class="errorMsg"></span></td>
						
							<td></td>
							<td><input type="submit" value="Login" id = "btnLogin" class="btnLogin"/> </td> 
						</tr>
					</table>
				</form>
				<?php
					}
					else{
				?>
					<span class="userInfo">

						<?php if($user[0]->type == "admin"){
						?>
						<a href="#">

						<?php

						}

						else {
						?>


						<a href="{{ URL::asset('userAccount') }}">
						<?php
						}
						?>
							<?php

								echo ($user[0]->type .": ". $user[0]->LastName . " ". $user[0]->FirstName);
							?>

						 </a>

						 <a href="{{ URL::asset('/user/logoff') }}" class="btnLogin">Log out</a>

					</span>
				<?php
					}
				?>
			@include('layout.menu')
			
		    <div class="clear"></div>
	   </div>
   </div>