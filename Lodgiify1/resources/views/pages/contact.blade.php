 @extends('layout.default')

 @section('content')

   <div class="banner">
      	<div class="wrap">
      	    <h2>Contact</h2><div class="clear"></div>
      	</div>
    </div>
  <div class="main">	
	 <div class="project-wrapper">
	 	<div class="map">

			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3744.967060383068!2d57.46513361533363!3d-20.177096951252086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x217c501f38f9c533%3A0xf5183b8cbf8f94a5!2sUniversity+Of+Technology%2C+Mauritius!5e0!3m2!1sen!2smu!4v1444576693768" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>	    </div> 
	    
	    <div class="wrap">
	 	  <div class="contact">
	 	  		<div class="cont span_2_of_contact">
	 	  		<h5 class="leave">Leave us your Queries</h5><div class="clear"></div>	


				  <form method="post"  id="contact" action="feedback">
				  	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<div class="contact-to">
                     	
					 	<input type="text" name="contactName" id="contactName" class="required" /><span class="errorMsg"></span><br/>
					 	<input type="text" name="contactemail" id="contactemail" class="text email" value="Email..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email...';}" style="margin-left: 10px"><span class="errorMsg"></span><br/>
					 	<input type="text" name="contactsubject"  id="contactsubject" class="text" value="Subject..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Subject...';}" style="margin-left: 10px">
					
					</div>
					<div class="text2">
	                   <textarea name="desc"  id="desc" value="Message:" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message..</textarea>
	                </div>

	                <div>
	               		<input type="submit" class="submit">
	                </div>

	             </form>



				</div>
				<div class="lsidebar span_1_of_about">
				   <h5 class="leave">Contact Info</h5><div class="clear"></div>
				   <div class="contact-list">
						<ul>
							<li><img src="{{ URL::asset('images/address.png') }}" alt=""><p>La tour Koeing, UTM</p><div class="clear"></div></li>
							<li><img src="{{ URL::asset('images/phone.png') }}" alt=""><p>Phone: 57139151<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2612205 </p><div class="clear"></div></li>
							<li><img src="{{ URL::asset('images/msg.png') }}" alt=""><p>Email: <span class="yellow1"><a href="#">lokeshpravin@gmail.com</a></span></p><div class="clear"></div></li>
					   </ul>
					</div>
			    </div>
				<div class="clear"></div>				
		    </div>
		</div>
     </div>
  </div>	
@stop

