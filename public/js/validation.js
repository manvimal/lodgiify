var hasError = false;
  function drawCaptcha()
    {
        var a = Math.ceil(Math.random() * 10)+ '';
        var b = Math.ceil(Math.random() * 10)+ '';       
        var c = Math.ceil(Math.random() * 10)+ '';  
        var d = Math.ceil(Math.random() * 10)+ '';  
        var e = Math.ceil(Math.random() * 10)+ '';  
        var f = Math.ceil(Math.random() * 10)+ '';  
        var g = Math.ceil(Math.random() * 10)+ '';  
        var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' '+ f + ' ' + g;
        $("#txtCaptcha").val(code);
    }

	  function validCaptcha(str2){
        var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
        if (str1 == str2) return true;        
        return false;
  }
 
  function removeSpaces(string)
    {
        return string.split(' ').join('');
    }

   
	//checks if element,ele does not has class, cls then add it 
	function addClass(ele,cls) {
	  if (!$(ele).hasClass(cls)){
	  		ele.addClass(cls);
	  }   
	}

	//removes class, cls from element,ele
	function removeClass(ele,cls) {
	 if ($(ele).hasClass(cls)){
	  		removeClass(ele, cls);
	  }   
	}

function validateLogin(form){

	var LoginUserName = form['LoginUserName'];

	removeAllErrors($(form));
		var hasError = false;

		if (!checkError(LoginUserName)) clearError(LoginUserName);

		else hasError = true;

		var LoginPassword = form['LoginPassword'];

		if (!checkError(LoginPassword)) clearError(LoginPassword);
		
		else hasError = true;

		if (!hasError) {

			  var $html='';
			url = "user/login";
			data =  $(form).serialize();
			$.ajax({
			  type: "POST",
			  url: url,
			  data: data,
			  success: function(response){
			  	  var obj = $.parseJSON( response );
			  	
			
			  	  if (obj.status == -1){
			  	  		$html += "<span class='errorMsg'>";
			  	 		$html += obj.msg ;
			  	 		$html += "</span>";

			  	  }
			  	  else if(obj.status == 1){
			  	  		$html += "<span class='successMsg'>";
			  	 		$html += obj.msg ;
			  	 		
			  	 		$html += "</span>";

			  	 		$html += '<img src = "./images/loadingLogin.gif" height="20px" width="30px" alt="" href="images/loadingLogin.png" />';

			  	 		window.setTimeout(function(){location.reload()},2000)


			  	  }
			  	  $('#logMsg').html($html);
				
			  }
			});
		}

		return false;
}




	

	







		//removes all previous errors
		
	
	function validate(form){
		//removes all previous errors
		removeAllErrors($(form));
		var hasError = false;
		//checks NIC for errors
		//var txtNIC = form['txtNic'];
		//pass input element txtnic as ref to checkerror for validation
		//if (!checkError(txtNIC)) clearError(txtNIC);
		
		//checks fname for errors
		var firstName = form['firstName'];
		if (!checkError(firstName)) clearError(firstName);
		else hasError = true;
		
		//checks Surname for errors
		var lastName = form['lastName'];
		if (!checkError(lastName)) clearError(lastName);
		else hasError = true;

		
/*
		//checks country for errors
		var country = form['country'];
		if (!checkError(country)) clearError(country);
		else hasError = true;
*/

		//checks country for errors
		var txtCaptchas = form['txtCaptchas'];
		if (!checkError(txtCaptchas)) clearError(txtCaptchas);
		else hasError = true;

		//checks userName for errors
		var userName = form['userName'];
		if (!checkError(userName)) clearError(userName);
		else hasError = true;

		//checks ge for errors
		var DOB = form['DOB'];
		if (!checkError(DOB)) clearError(DOB);
		else hasError = true;

		//checks phone for errors
		var Phone = form['phone'];
		if (!checkError(Phone)) clearError(Phone);
		else hasError = true;
		
		//checks email for errors
		var Email = form['Email'];
		if (!checkError(Email)) clearError(Email);
		else hasError = true;

		//checks postalCode for errors
		var postalCode = form['postalCode'];
		if (!checkError(postalCode)) clearError(postalCode);
		else hasError = true;

		
		//checks address for errors
		var address = form['address'];
		if (!checkError(address)) clearError(address);
		else hasError = true;

		

		//checks email for errors
		var txtPassword = form['Password'];
		if (!checkError(txtPassword)) clearError(txtPassword);
		else hasError = true;
		
		//checks email for errors
		var confirmPassword = form['confirmPassword'];
		if (!checkError(confirmPassword)) clearError(confirmPassword);
		else hasError = true;
		
		//checks txtCaptchas
		var txtCaptchas = form['txtCaptchas'];
		if (!checkError(txtCaptchas)) {
			clearError(txtCaptchas);


			//form.submit();
		}
		else hasError = true;

		if (!hasError) {
			url = "user/registration";
			data =  $(form).serialize();
			$.ajax({
			  type: "POST",
			  url: url,
			  data: data,
			  success: function(response){
			  		var $html='';
			  	  var obj = $.parseJSON( response );
			  	  if (obj.status == -1){
			  	  	//user eists
			  	  	$html += "<span class='errorMsg'>";
			  	 		$html += obj.msg ;
			  	 		$html += "</span><br />";

				
			  	 		$('#Password').val("");
			  	 		  $('#Email').val("");
			  	 		  $('#confirmPassword').val("");
			  	 		  $('#userName').val('');
			  	 		  $('#txtInput').val('');

			  	  }
			  	  else if(obj.status == 1){
			  	  		$html += "<span class='successMsg'>";
			  	 		$html += obj.msg ;
			  	 		$html += "</span><br />";
			  	 		  $('.clearAll').val('');
			  	 		   


			  	  }
			  	  $('#regMessage').html($html);
			  	  $('#btnrefresh').click();

			  }
			});
		}

		
		return false;
	}



//removes all previous errors
		
	
	function validateforgetPassword(form, status){
		//removes all previous errors
		removeAllErrors($(form));
		var hasError = false;


		//checks NIC for errors
		//var txtNIC = form['txtNic'];
		//pass input element txtnic as ref to checkerror for validation
		//if (!checkError(txtNIC)) clearError(txtNIC);
		
		

		
		//checks userName for errors
		

		if (status == 0){
			var userName = form['userName'];
			if (!checkError(userName)) clearError(userName);
			else hasError = true;
		}

		else if(status == 1){
			//checks email for errors
			var txtPassword = form['Password'];
			if (!checkError(txtPassword)) clearError(txtPassword);
			else hasError = true;
			
			//checks email for errors
			var confirmPassword = form['confirmPassword'];
			if (!checkError(confirmPassword)) clearError(confirmPassword);
			else hasError = true;
		
		}

		$url = $(form).attr("action");
		$(".gblError").removeClass("successMsg");
		$(".gblError").removeClass("errorMsg1");

		if (!hasError) {
			url = $url;
			data =  $(form).serialize();
			$.ajax({
			  type: "POST",
			  url: url,
			  data: data,
			  success: function(response){
			  		var $html='';
			  	  var obj = $.parseJSON( response );
			  	 
			  	  if (obj.status == -1){
			  	  	$(".gblError").addClass("errorMsg1")
			  	  }
			  	  else{
			  	  	$(".gblError").addClass("successMsg");
			  	  	if (typeof userName !== "undefined") {
						userName.value = "";
			  	  	}
			  	  	
			  	  }
			  	  $(".gblError").text(obj.msg)

			  }
			});
		}

		
		return false;
	}



	
	
	//Chceks error based on various classes
	function checkError(elem){
		var errror = false;
		//get value of input and removes space before and after
		var $value = (elem.value).trim();

		if ($(elem).hasClass("noValidate")){
			return false;
		}
		//validation for blank
		if ($(elem).hasClass("required")) {
			if (isBlank($value)){
				setError(  "This field cannot be blank", elem );
				return true;
			}
		}
		
		//validation for character limit
		if ($(elem).hasClass( "limit14")) {
			var maxlen = 14;
			if (exceedLength($value, maxlen)){
				setError( "This field must contain " + maxlen + " characters", elem );
				return true;
			}
		}
		
		//Validation for letters 
		if ($(elem).hasClass( "onlyLetters")) {
			if (!hasOnlyLetters($value)){
				setError( "This field must contain only characters", elem );
				return true;
			}
		}
		
		//Validation for mobile
		if ($(elem).hasClass("validmobile")) {
			if (!validPhone($value)){
				setError( "Invalid phone number", elem );
				return true;
			}
		}
		
		//Validation for email
		if ($(elem).hasClass( "email")) {
			if (!validEmail($value)){
				setError( "Invalid email address", elem );
				return true;
			}
		}
		
		
		//Validation for password
		if ($(elem).hasClass("password")) {
			if (!validPassword($value)){
				setError( "Passwords do not match", elem );
				return true;
			}
		}
		
		//Validation for password
		if ($(elem).hasClass("captcha")) {
			if (!validCaptcha($value)){
				setError( "Captcha is not valid", elem );
				return true;
			}
		}


		//Validation for numeric
		if ($(elem).hasClass("numeric")) {
			if (!isNumeric($value)){
				setError( "Value is not numeric", elem );
				return true;
			}
		}


		//Validation for datetime
		if ($(elem).hasClass("datetime")) {
			if (!isDateTime($value)){
				setError( "Value is not date time (YYYY-DD-MM H:M)", elem );
				return true;
			}
		}



		
		return false;
	}

	//Check is dateTime
	function isDateTime(value){
		var pattern = /\d{4}\-[0-3]\d\-\d{2} ([01]?[0-9]|2[0-3]):[0-5][0-9]/


		//alt:
		
		if (pattern.test(value)) {
			return true;
		    // invalid
		} 
		return false;
	}

	//Check is numeric
	function isNumeric(value){
		if(isNaN(value)){
			return false;
		}
		return true;
	}

	
	//Check is value is blank
	function isBlank(value){
		if (value.length == 0){
			return true;
		}
		return false;
	}
	
	//Chesk id length is lower
	function exceedLength(value, len){
		if (value.length < len){
			return true;
		}
		return false;
	}
	
	//Check letters are contained only
	function hasOnlyLetters(value){
		//regular expression to check value has only letters
		var letters = /^[A-Za-z]+$/;  
		if(value.match(letters))  
		{  
		  return true;  
		}  
		return false;
	}
	
	//Validates phone using regular expression
	//returns true if valid phone
	function validPhone(value){
		if (!((/^[0-9]{8}$/.test(value)))){
			return false;
		}
		return true;
	}
	
	//Email validation using regular expression
	function validEmail(email) { 
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	} 
	
	//Passwords validity
	function validPassword(value) { 
		//compare both passwords to see if they match
		var cnfPass = (document.getElementById("Password").value).trim();
		if (cnfPass != value){
			return false;
		}
		return true;
	} 
	
	//Set error
	function setError(message, elem){
		//gets span to display error message
		var errorElem = $(elem);
		//sets global variable to true
		hasError = true;
		//adds message to span
		errorElem.parent().find("span.errorMsg").text( message );
		//adds class error to elem
		addClass(errorElem, "error");
		//focus on elem
		//elem.focus();
	}
	
	//Removes all errors prior validation
	function removeAllErrors(form){
		//required onlyLetters  required email  input_img  password  required validmobile 
		var parent = null;
		$(".error").each(function(){
			$(this).removeClass("error");
			parent = $(this).parent();
			parent.find(".error").text("");
		});

	}
	
	//Clears errros
	function clearError(elem){
		$(elem).parent().find(".errorMsg").text("");
		removeClass(elem, "error");
	}
	
	//Displays message when radio is checked
	function displayMessage(message){
		alert(message);
	}
	

	//Hide state if Mauritius is selected
	function hidestate(country, stateElem){
		if (stateElem.value == country){
			document.getElementById('txtState').parentNode.style.display = 'none';
			document.getElementById('txtState').disabled="disabled"
		}
		else{
			document.getElementById('txtState').parentNode.style.display = 'block';
			document.getElementById('txtState').removeAttribute("disabled");
		}
	}
	

//preview upload files instantly
function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

     $('#list').html("");
    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          
         lst = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
         
          $('#list').append(lst);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }


$(document).ready(function(){
	var myCenter;
	var infowindow ;
	var prevData ;


$(".contact .submit").click(function(){ 


		var form = $(".contact form") .get(0);

		var contactName = form['contactName'];

		

		removeAllErrors($(this));
		var hasError = false;

		

		if (!checkError(contactName)) clearError(contactName);

		else hasError = true;

		

		var contactEmail = form['contactemail'];

		

		if (!checkError(contactEmail)) clearError(contactEmail);
		
		else hasError = true;

		

		var contactSubject = form['contactsubject'];

		if (!checkError(contactSubject)) clearError(contactSubject);
		
		else hasError = true;


		var contactMessage = form['desc'];

		if (!checkError(contactMessage)) clearError(contactMessage);
		
		else hasError = true;



		if( !hasError){

			$.ajax({
			  method: "post",
			  url: "feedback",
			  data: $(form).serialize()
			})
			  .success(function( msg ) {
			  	 $(".msg").addClass("success");
			  	 $(contactEmail).val("");
			  	 $(contactMessage).val("");
			  	 $(contactName).val("");
			  	 $(contactsubject).val("");

			    $(".msg").text( "Your message has been sent "  );
			    
			  })
			  .error(function( msg){
			  		$(".msg").addClass("error");
			  	 $(".msg").text( "Your message has not been sent"  );

			  })



		}

		return false;

	});
	//set capcha
	$("#btnrefresh").click();

	


	$("body").on('click','.BuildingUpdate', function(){
		$(".building_wrapper").html(updateBuildingSkeleton(prevData, $(this).attr("href")));
		return false;
	})


	//update room page
	$("body").on('click','.RoomUpdate', function(){
		$(".building_wrapper").html(updateRoomSkeleton(prevData, $(this)));
		return false;
	})

	


	$("body").on('click','.BuildingView', function(){
		$(".buildings-list .active a").click();
		return false;
	})





	$("body").on('click','.RoomUpdateAjax', function(){

		$data = $(this).parents("form").serialize();

		$.ajax({
		  method: "POST",
		  url:  "room/update",
		  data: $data
		})
		  .success(function( msg ) {
		    //$(".building_wrapper").html(updateRoomSkeleton(prevData, $(this)));
		    $(".buildings-list .active a").click();
		  });

		
		return false;
	})


	//Booking

/**
	$(".recently-posted-building a").click(function(){
		var buildingId = $(this).data("buildingid");
		var buildingName = $(this).data("buildingname");
		var $optionsCatRoom = "";
		$("#small-dialog h1").text(buildingName);
		//Get all room category by ajax
		$data = $(this).parents("form").serialize();
		$.ajax({
		  method: "get",
		  url:  "booking/roomCategory",
		  data: $data
		})
		  .success(function( data ) {
		  	console.log(data);
		  	var obj = $.parseJSON( data );
		  	console.log(obj);
		  	for (i = 0; i< obj.length; i++){
		  		$optionsCatRoom += "<option value='"+obj[i].id+"''>"+obj[i].roomCatName+"</option>";
		  	}
		    $("#ddlroomCategory").html($optionsCatRoom );
		    $(".buildings-list .active a").click();
		  });
		
		return false;
		
	})
 **/

	$("#tabs-2").click(function(){
		var buildingId = $(this).data("buildingid");
		var buildingName = $(this).data("buildingname");
		var $optionsCatRoom = "";

		$("#small-dialog h1").text(buildingName);

		//Get all room category by ajax
		$data = $(this).parents("form").serialize();

		$.ajax({
		  method: "get",
		  url:  "booking/roomCategory",
		  data: $data
		})
		  .success(function( data ) {
		  
		  	var obj = $.parseJSON( data );
		  	

		  	for (i = 0; i< obj.length; i++){
		  		$optionsCatRoom += "<option value='"+obj[i].id+"''>"+obj[i].roomCatName+"</option>";
		  	}

		    $("#ddlroomCategory").html($optionsCatRoom );


		    $(".buildings-list .active a").click();
		  });

		
		return false;
		
	})


	function updateRoomSkeleton(data, $obj){
		prevData = data;
		var $index = $obj.parents(".room").index();
		
		
		var room = "";
		if ($index >= 0){
			room = data.rooms[$index];
			$html = '<div class="room-left">';
			$html += '<div class="room-header">';
			 $html += '<div class="roomname">  <span>Update - '+ room.roomName +' </span>';
			  $html += '<a class="BuildingView"  title = "Back" href="room/back?id='+ room.id +'"></a>';
			 
              
              $html += '</div>';
				if (data.image != ''){
					$html += '<img alt="" href="" class="roomImg"/>';
				}
				else{
					$html += '<img alt="" href="'+ room.image + '" class="roomImg"/>';
				}
				
           
            
  			$html += '</div>';

  			$token = $("#token").val();
        $html += '<div class="room-footer">';
           $html += '<div class="roomDetails"><form name="updateRoom" action="'+ $obj.attr("href") +'"><input  id="roomid" name="roomid" type="hidden" value="'+ room.id + '" /><input  id="_token" name="_token" type="hidden" value="'+ $token + '" />';

              
              $html += '<div class="roomCat">  Building type : <span> '+ data.category.buildingCatName +'</span></div>';
              $html += '<div class="roomdesc">  Description : <input  id="roomdesc" name="roomdesc" value="'+ room.desc + '" />  </div>';
               $html += '<div class="roomprice">  Price : <input  id="roomprice" name="roomprice" value="'+ room.price + '" />  </div>';
               $html += '<div class="roomcapacity">  Capacity : <input  id="roomcapacity" name="roomcapacity" value="'+ room.capacity + '" />  </div>';
              $html += '<div class="roomLoc">  Address : <span> ' + data.buildingLocation + ' </span>  </div>';
              $html += '<div class="roomrooms">  No of rooms : <span> '+ data.rooms.length +'</span></div>';
               $html += '<div class="">  <input type="submit" class="RoomUpdateAjax" value="Update room" />  </div> </form>';

          $html += '</div>';
           
        
        $html += '<div class="clear"></div></div>';


       

		$html += '</div>';
		
			
		
        $html += ' </div>';
       
	   $html += '<div class="clear"></div>';

	   
	   return $html;
		}

		
	}


	//Ajax update 

	
	$("body").on('click','.buildingUpdate', function(){

		$data = $(this).parents("form").serialize();

		$.ajax({
		  method: "POST",
		  url:  "building/update",
		  data: $data
		})
		  .success(function( msg ) {
		    $(".buildings-list .active a").click();
		  });

		
		return false;
	})



	function updateBuildingSkeleton(data, $link){
		prevData = data;
		$html = '<div class="building-left">';
			$html += '<div class="building-header">';
			 $html += '<div class="buildingname">  <span>Update - '+ data.buildingName +' </span>';
			  $html += '<a class="BuildingView"  title = "Back" href="building/back?id='+ data.id +'"></a>';
			 
              
              $html += '</div>';
				if (data.image != ''){
					$html += '<img alt="" href="" class="builindImg"/>';
				}
				else{
					$html += '<img alt="" href="'+ data.image + '" class="builindImg"/>';
				}
				
            
           
            
  			$html += '</div>';

  			$token = $("#token").val();
        $html += '<div class="building-footer">';
           $html += '<div class="buildingDetails"><form name="updateBuilding" action="'+ $link +'"><input  id="buildingid" name="buildingid" type="hidden" value="'+ data.id + '" /><input  id="_token" name="_token" type="hidden" value="'+ $token + '" />';

              
              $html += '<div class="buildingCat">  Building type : <span> '+ data.category.buildingCatName +'</span></div>';
              $html += '<div class="buildingdesc">  Description : <input  id="buildingdesc" name="buildingdesc" value="'+ data.desc + '" />  </div>';

              $html += '<div class="buildingLoc">  Address : <input  id="buildingLocation" name="buildingLocation" value="'+ data.buildingLocation + '" />  </div>';
              $html += '<div class="buildingrooms">  No of rooms : <span> '+ data.rooms.length +'</span></div>';
               $html += '<div class="">  <input type="submit" class="buildingUpdate" value="Update building" />  </div> </form>';

          $html += '</div>';
           
        
        $html += '<div class="clear"></div></div>';


       

		$html += '</div>';
		
			
		
        $html += ' </div>';
       
	   $html += '<div class="clear"></div>';
	   return $html;
	}


	//Ajax update 

	
	$("body").on('click','.buildingUpdate', function(){

		$data = $(this).parents("form").serialize();

		$.ajax({
		  method: "POST",
		  url:  "building/update",
		  data: $data
		})
		  .success(function( msg ) {
		    $(".buildings-list .active a").click();
		  });

		
		return false;
	})




	$("body").on("click",".buildings-list a",function(){
		$(this).parents("ul").find("li").removeClass("active");
		$(this).parents("li").addClass("active");

		$.getJSON( $(this).attr("href"), function( data ) {
    		
    		if (typeof data[0] !== "undefined") {
    			$(".building_wrapper").html(searchSkeleton(data[0]));

    			
    			var map=new google.maps.Map(document.getElementById("googleMap"), initMap());
    			var marker=new google.maps.Marker({
				  position:myCenter,
				  });
    			marker.setMap(map);

			
				infowindow.open(map,marker);

				//updateDeleteAction();
				//updateDeleteRoomAction();
				initPaginationRoom();
    		}
    		else{
    			$(".building_wrapper").html('No result found');
    		}
		});

		return false
	});



	$("body").on('click','.BuildingDelete', function(){
		var r = confirm("Are you sure you want to delete the building!");
		if (r == true) {
		    $.getJSON( $(this).attr("href"), function( data ) {

    		
    			$(".building_wrapper").html("");
    			
    			$(".buildings-list li.active").remove();
    			$(".buildings-list a:eq(0)").click();
    		
			});
		}
		return false;
		})


	$("body").on('click','.RoomDelete', function(){
		var r = confirm("Are you sure you want to delete the room!");
		if (r == true) {
			var obj =  $(this);
		    $.getJSON( $(this).attr("href"), function( data ) {
		    	
    		$(obj).parents(".room").remove();
    		
		});
		}
		return false;
	})

	


	function searchSkeleton(data){
		var $buildingImage
		prevData = data;
		$html = '<div class="building-left">';
			$html += '<div class="building-header">';
			 $html += '<div class="buildingname">  <span>'+ data.buildingName +' </span>';
			  $html += '<a class="BuildingDelete"  title = "delete" href="building/delete?id='+ data.id +'"></a>';
			  $html += '<a class="BuildingUpdate" title ="update" href="building/update?id='+ data.id +'"></a>';
              
              $html += '</div>';
				if (data.image != ''){
					$html += '<img alt="" href="" class="builindImg"/>';
				}
				else{
					$html += '<img alt="" href="'+ data.image + '" class="builindImg "/>';
				}
				
            
           
            
  			$html += '</div>';
        $html += '<div class="building-footer">';
           $html += '<div class="buildingDetails">';

              
              $html += '<div class="buildingCat"><span class="buildFont">  Building type </span> : <span> '+  data.category.buildingCatName +'</span></div>';
              $html += '<div class="buildingdesc"><span class="buildFont">  Description </span>   : <span> '+ data.desc +'</span></div>';

              $html += '<div class="buildingLoc"> <span class="buildFont">  Address </span> : <span> '+ data.buildingLocation +'</span></div>';
              $html += '<div class="buildingrooms"> <span class="buildFont"> Num of rooms </span> : <span> '+ data.rooms.length +'</span></div>';
              if(data.image != '')
              {
              	$buildingImage = data.image;
              }
              else
              {
              	$buildingImage = nopreview.jpg;

              }
              $html += '<div class="buildingrooms">   <span> <img height="80" width="120" src  = "' + ' upload/' + $buildingImage +' " </span></div>';
            
              //	alert('./upload/' + data.image);
          
          $html += '</div>';
           
          $html += '<div id="googleMap">';
          $html += '';
          $html += '</div>';
          $html += '<div class="clear"></div></div>';


         //google map markers information
        infowindow = new google.maps.InfoWindow
        ({
			content:data.buildingName + " - " + data.desc
		});

        myCenter=new google.maps.LatLng( data.lattitude, data.longitude);


		$html += '</div>';
		$html += '<div class="rooms" id="SearchresultRoom"> </div>';
		$html += '<div class="dummyroomparent hide">';


			for (i=0 ; i< data.rooms.length ; i++)
			{
					room =  data.rooms[i];
					$html += '<div class="room">';
					$html += '<h1 class="roomheader">Rooms</h1>';
					$html += '<div class="roomDetails">';
					$html += '<a class="RoomDelete"  title = "delete" href="room/delete?id='+ room.id +'"></a>';
					$html += '<a class="RoomUpdate" title ="update" href="room/update?id='+ room.id +'"></a>';
	              	$html += '<div class="roomName"> Room name : <span> '+ room.roomName +'</span></div>';
		              $html += '<div class="roomdesc">  Description : <span> '+ room.desc +'</span></div>';
		              $html += '<div class="roomisOccupied">  Occupied : <span>'+ room.isOccupied +' </span></div>';
		              $html += '<div class="roomstart"> StartDate : <span> '+ room.startDate +'</span></div>';
		              $html += '<div class="roomend">  End date : <span> '+ room.endDate +'</span></div>';
		              $html += '<div class="roomPrice">  price : <span>Rs. '+ room.price +'</span></div>';
	              
          $html += '</div>';
				$html += '</div>';
			}
		
	
			
        $html += ' </div>';
        $html += '<div id="Paginationroom"></div>';
       
	   $html += '<div class="clear"></div>';
	   return $html;
	}

	var pageNum = 16;

	 function initPaginationRoom() {
           // count entries inside the hidden content
          var num_entries = jQuery('.dummyroomparent .room').length;

          // Create content inside pagination element
           $("#Paginationroom").pagination(num_entries, {
                    callback: pageselectCallbackRoom,
                    items_per_page:pageNum // Show only one item per page
          });
            
      }


      function pageselectCallbackRoom(page_index, jq){

        page_index = page_index*pageNum;
         $('#SearchresultRoom').empty();

          
            

         for (i=0;i<pageNum;i++){
             str1 = '.dummyroomparent .room:eq('+ (page_index+i)+')';
             
             new_content = $(str1 ).clone();
              $('#SearchresultRoom').append(new_content);
         }
                return false;
     }




//vehicles


	
	$("body").on('click',".inner-list a",function(){
		$(this).parents("ul").find("li").removeClass("active");
		$(this).parents("li").addClass("active");

		$.getJSON( $(this).attr("href"), function( data ) {
    		if (typeof data[0] !== "undefined") {
    			$(".inner_wrapper").html(searchVehicleSkeleton(data[0]));

    			
    			
				//updateDeleteRoomAction();
    		}
    		else{
    			$(".inner_wrapper").html('No result found');
    		}
		});

		return false
	});

	function searchVehicleSkeleton(data){
		prevData = data;
		var $category = "";
		var $owner = "";
		$html = '<div class="inner-left">';
			$html += '<div class="inner-header">';
			 $html += '<div class="innername">  <span>'+ data.vehicleName +' </span>';
			  $html += '<a class="innerDelete"  title = "delete" href="vehicle/delete?id='+ data.id +'"></a>';
			  $html += '<a class="innerUpdate" title ="update" href="vehicle/update?id='+ data.id +'"></a>';
              
              $html += '</div>';
				if (data.image != ''){
					$html += '<img alt="" href="" class="vehicleImg"/>';
				}
				else{
					$html += '<img alt="" href="'+ data.image + '" class="bvehicleImg"/>';
				}
				
            
           
            
  			$html += '</div>';
        $html += '<div class="inner-footer">';
           $html += '<div class="innerDetails">';

              
              //$html += '<div class="vehicleCat">  Building type : <span> '+ data.category.buildingCatName +'</span></div>';
              $html += '<div class="innerdesc">  Transmission : <span> '+ data.transmission +'</span></div>';
               $html += '<div class="innerdesc">  Color : <span> '+ data.color +'</span></div>';
                $html += '<div class="innerdesc">  Model : <span> '+ data.models +'</span></div>';
                 $html += '<div class="innerdesc">  Seats : <span> '+ data.numOfSeats +'</span></div>';

                 if (data.category){
                 	
                 	$category = data.category.vehiclecatnameType;

                 }

                 if (!data.category ){
                 	$owner = data.vehicle_owner.FirstName  + " " +data.vehicle_owner.LastName ;

                 }
                  $html += '<div class="innerdesc">  Category : <span> '+ $category+'</span></div>';
                   $html += '<div class="innerdesc">  Owner : <span> '+ $owner +'</span></div>';
            //  $html += '<div class="vehicleLoc">  Address : <span> '+ data.buildingLocation +'</span></div>';

          $html += '</div>';
           
         
        $html += '<div class="clear"></div></div>';


       
		$html += '</div>';
		
       
	   $html += '<div class="clear"></div>';
	   return $html;
	}


	//Delete vehcle
	$("body").on('click','.innerDelete', function(){
		var r = confirm("Are you sure you want to delete the vehicle!");
		if (r == true) {
		    $.getJSON( $(this).attr("href"), function( data ) {
    			$(".inner_wrapper").html("");
    			
    			$(".inner-list li.active").remove();
    			$(".inner-list a:eq(0)").click();
    		
			});
		}
		return false;
	})

	//Edit vehicle
	$("body").on('click','.innerUpdate', function(){
		$(".inner_wrapper").html(updateVehicleSkeleton(prevData, $(this).attr("href")));
		return false;
	})


	//skeleton for update
	function updateVehicleSkeleton(data, $link){
		prevData = data;
		var $category = "";
		var $owner = "";
		$html = '<div class="inner-left">';
			$html += '<div class="inner-header">';
			 $html += '<div class="innername">  <span>'+ data.vehicleName +' </span>';
			  $html += '<a class="innerDelete"  title = "delete" href="vehicle/delete?id='+ data.id +'"></a>';
			  $html += '<a class="innerUpdate" title ="update" href="vehicle/update?id='+ data.id +'"></a>';
              
              $html += '</div>';
				if (data.image != ''){
					$html += '<img alt="" href="" class="vehicleImg"/>';
				}
				else{
					$html += '<img alt="" href="'+ data.image + '" class="bvehicleImg"/>';
				}
				
				
              
  			$html += '</div>';
        	$html += '<div class="inner-footer">';
           $html += '<div class="innerDetails">';

           if (data.category){
                 	
                 	$category = data.category.vehiclecatnameType;

                 }

                 if (!data.category ){
                 	$owner = data.vehicle_owner.FirstName  + " " +data.vehicle_owner.LastName ;

                 }
            

  			$token = $("#token").val();
           $html += '<div class=""><form name="updatevehicle" action="'+ $link +'"><input  id="vehicleid" name="vehicleid" type="hidden" value="'+ data.id + '" /><input  id="_token" name="_token" type="hidden" value="'+ $token + '" />';

              
              $html += '<div class="innerdesc">  Transmission : : <span> '+ data.transmission +'</span>  </div>';

              $html += '<div class="innerdesc">  Color : <input  id="color" name="color" value="'+ data.color + '" />  </div>';
              $html += '<div class="innerdesc">  Model : <span> '+ data.models +'</span></div>';
              $html += '<div class="innerdesc">  NumOfSeats : <span> '+ data.numOfSeats +'</span></div>';
               $html += '<div class="innerdesc">  Category : <span> '+ $category +'</span></div>';
                $html += '<div class="innerdesc">  Owner : <span> '+ $owner +'</span></div>';
               $html += '<div class="">  <input type="submit" class="vehicleUpdate" value="Update vehicle" />  </div> </form>';

          $html += '</div>';
           
        
        $html += '<div class="clear"></div></div>';


       

		$html += '</div>';
		
			
		
        $html += ' </div>';
       
	   $html += '<div class="clear"></div>';
	   return $html;
	}



	//Ajax update 

	
	$("body").on('click','.vehicleUpdate', function(){

		$data = $(this).parents("form").serialize();

		$.ajax({
		  method: "POST",
		  url:  "vehicle/update",
		  data: $data
		})
		  .success(function( msg ) {
		    $(".inner-list .active a").click();
		  });

		
		return false;
	})



	//init googlemap
	function initMap(){
		 var mapProp = {
		  center:myCenter,
		  zoom:12,
		  mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		return mapProp;
	}

	//click on first building
	$(".buildings-list a:eq(0)").click();
	//click on first vehicle
	

	//display scroll bar
	$('#contentHolder').perfectScrollbar();


	 //tabs for booking popup
	 $( "#tabs" ).tabs({
               heightStyle:"fill",
              // collapsible:true,
               //hide:"slideUp"
               
    });



	 //Get selected package while booking
	 /*$("#package").change(function(){
	 	$("#adults").removeClass("noValidate");
	 	$("#children").removeClass("noValidate");
	 	$("#adults").parents("p").show();
	 	$("#children").parents("p").show();
	 	
	 	$packageId = $(this).val();
	 	if ($packageId.length != 0){
	 		$.ajax({
			  method: "GET",
			  url:  "/package/get/"+$packageId ,
			})
			  .success(function( data ) {
			  	 if (data){
			  	 	$(".no_package ").hide();
	 				$(".got_package ").show();
			   		//console.log(data)
			   		if (data.building){
			   			$(".package_wrapper figure img").attr("src", "/upload/" + data.building.image);
			   			$(".package_wrapper figure p").text(data.building.desc);
			   			$(".package_wrapper figure h2").text(data.building.buildingName);
			   			$(".package_wrapper figure h3").text(data.building.rooms.length);
			   		}
			   		
			   		$(".package_wrapper .capacityAdult").text(data.capacityAdult);
			   		$(".package_wrapper  .capacityChildren").text(data.capacityChildren);
			   		$(".package_wrapper .packageDesc").text(data.packageDesc);
					$(".package_wrapper .packageName").text(data.packageName);
					$(".package_wrapper .promotion .promotionDescription").text(data.promotionDescription);
					$(".package_wrapper .promotion .promotionExpiryDate").text(data.promotionExpiryDate);
					$(".package_wrapper .roomCatName").text(data.roomCatName);
					console.log(data.building);
					//Control building type
					if (typeof data.building !== "undefined" && typeof data.building.category !== "undefined" ) { 
						if ( data.building.category.buildingCatName == 'House' ||  data.building.category.buildingCatName == 'Bungalow' ){
							//hide numAdult and child
							$("#adults").addClass("noValidate");
							$("#adults").parents("p").hide();
							$("#children").addClass("noValidate");
							$("#children").parents("p").hide();
							
						}
					}
			   	 } 
			  });
	 	}
	 	else{
	 			$(".no_package ").show();
	 			$(".got_package ").hide();
	 	}
	 	
	 })
*/


$(".checkRoomAvailability").click(function(){

		$obj = $(this);


 		//var numChild = $(".deals-list #children").val();

 		var buildingid = $("#buildingid").val();

 		var packageid = $(this).parents('.pack_label').find('input[type="checkbox"]').val();	

 		var start = $(".deals-list input[name=date10]").val();

 		var end = $(".deals-list input[name=date11]").val();

 		var token = $("#token").val();

 		varCheckBox = $('.checkbox').val();
 		
 		//var $data =  { 'numChild': numChild, 'numAdult': numAdult ,'package': package, 'start': start, 'end': end , "_token": token};

 		//var $data =  $(this).parents("form").serialize();

 		var baseform = document.forms['registerBooking'];
 		
 		//var adultsObj = baseform['adults'];
 		//var childrenObj = baseform['children'];
 		var date10Obj = baseform['date10'];
 		var date11Obj = baseform['date11'];

 		var adults = $(this).parents('.pack_label').find('.adults').val();

 		var children = $(this).parents('.pack_label').find('.child').val();

 		var rooms = $(this).parents('.pack_label').find('.rooms').val();

 		removeAllErrors($(baseform));

 		

 		
// alert(1)
 		var hasError = false;

 		$url = $(this).attr("href");

 		var token = $("#token").val();

 		var $data =  {"checkin":start , "checkout":end, "buildingid":buildingid , "packageid":packageid, 'adults':adults , 'children': children, 'rooms':rooms,'_token': token};


 		if (!checkError(date10Obj))  clearError(date10Obj);
 		else hasError = true;



 		if (!checkError(date11Obj))  clearError(date11Obj);
 		else hasError = true;

 	
 		if (!hasError ){
 		

 			$.ajax({
			  method: "POST",
			  url:  $url  ,
			  data: $data,
			})
			  .success(function( data ) {
			  	data = $.parseJSON( data );
			  	 if (data.status == 1){
			  	 	//Successfully booked
			  	 	 $obj .parents('.pack_label').find('.errorMsgRoom').text('');
			  	 	 $obj .parents('.pack_label').find('.successMsgRoom').text(data.msg);
			  	 	 
			  	 	//$(".errorMsg1sgRoom").text("");
			   		//$(".successMsgRoom").text(data.msg);
			   	 } 
			   	 else{

			   	 	$obj .parents('.pack_label').find('.errorMsgRoom').text(data.msg);
			  	 	$obj .parents('.pack_label').find('.successMsgRoom').text('');
			   	 //	$(".successMsgRoom").text("");
			   	 	//$(".errorMsgRoom").text(data.msg);
			   	 }
			   	 
			  });
	 		}
 		
		  return false;

	 })



$("#checkVehicleAvail").click(function()
{

		$obj = $(this);

 		var vehicleid = $("#vehicleid").val();	

 		var start = $(".deals-list input[name=date10]").val();

 		var end = $(".deals-list input[name=date11]").val();

 		var token = $("#token").val();

 		var baseform = document.forms['registerVehicleBooking'];

 		var date10Obj = baseform['date10'];
 		var date11Obj = baseform['date11'];
 		


 		removeAllErrors($(baseform));


 		var hasError = false;

 		$url = $(this).attr("href");

 		var token = $("#token").val();

 		var $data =  {"checkin":start , "checkout":end, "vehicleid":vehicleid , '_token': token};

 
 		if (!checkError(date10Obj))  clearError(date10Obj);
 		else hasError = true;



 		if (!checkError(date11Obj))  clearError(date11Obj);
 		else hasError = true;

 	
 		if (!hasError ){
 		

 			$.ajax({
			  method: "POST",
			  url:  $url  ,
			  data: $data,
			})
			  .success(function( data ) {
			  	data = $.parseJSON( data );
			  	 if (data.status == 1){
			  	 	//Successfully booked
			  	 	 $obj .parents('.pack_label').find('.errorMsgRoom').text('');
			  	 	 $obj .parents('.pack_label').find('.successMsgRoom').text(data.msg);
			  	 	 
			  	 	//$(".errorMsg1sgRoom").text("");
			   		//$(".successMsgRoom").text(data.msg);
			   	 } 
			   	 else{

			   	 	$obj .parents('.pack_label').find('.errorMsgRoom').text(data.msg);
			  	 	$obj .parents('.pack_label').find('.successMsgRoom').text('');
			   	 //	$(".successMsgRoom").text("");
			   	 	//$(".errorMsgRoom").text(data.msg);
			   	 }
			   	 
			  });
	 		}
 		
		  return false;

	 })


/**
	$('.date10').click(function(){
		$(this).parents('.pack_label').find('#checkVehicleAvail').click();
	})
**/


$(".bookVehicles").click(function()
{


	 	//validate booking
	 	//var numChild = $(".deals-list #children").val();

 		var start = $(".deals-list input[name=date10]").val();
 		var end = $(".deals-list input[name=date11]").val();

 		var token = $("#token").val();
 		
 		var $data =  $(this).parents("form").serialize();

 		var baseform = document.forms['registerVehicleBooking'];

 		var date10Obj = baseform['date10'];
 		var date11Obj = baseform['date11'];


 		

 		removeAllErrors($(baseform));
 		

 		var hasError = false;


 		if (!checkError(date10Obj))  clearError(date10Obj);
 		else hasError = true;


 		if (!checkError(date11Obj))  clearError(date11Obj);
 		else hasError = true;


 	
 		if (!hasError ){
 		

 			$.ajax({
			  method: "post",
			  url:  "/vehiclebooking/register" ,
			  data: $data,
			})
			  .success(function( data ) {
			  	data = $.parseJSON( data );
			  	if (data.status == 1){
			  	 	
			  	 	//Successfully booked
			  	 	$(".errorMsg1").html("");
			   		$(".successMsg").html(data.msg);
			   	 } 
			   	 else{
			   	 	$(".successMsg").html("");
			   	 	$(".errorMsg1").html(data.msg);
			   	 	
			   	 }
			  });
	 		}
 		
		  return false;

	 })


 	 
	//on change room trigger check availability
	$('.rooms').change(function(){
		$this.parents('.pack_label').find('.checkRoomAvailability').click();

	})
	
 	// Register booking
	$(".bookPckNow").click(function(){


	 	//validate booking
	 	var numChild = $(".deals-list #children").val();



 		var numAdult = $(".deals-list #adults").val();
 		
 		var package = $(".deals-list #package").val();


 		var start = $(".deals-list input[name=date10]").val();
 		var end = $(".deals-list input[name=date11]").val();

 		var token = $("#token").val();
 		
 		//var $data =  { 'numChild': numChild, 'numAdult': numAdult ,'package': package, 'start': start, 'end': end , "_token": token};

 		var $data =  $(this).parents("form").serialize();

 		var baseform = document.forms['registerBooking'];

 		
 		//var adultsObj = baseform['adults'];
 		//var childrenObj = baseform['children'];
 		var date10Obj = baseform['date10'];
 		var date11Obj = baseform['date11'];

 		removeAllErrors($(baseform));
 		
// alert(1)
 		var hasError = false;

 		
 		
 		//if (!checkError(adultsObj))  clearError(adultsObj);
 		//else hasError = true;

// alert(3)
 		//if (!checkError(childrenObj))  clearError(childrenObj);
 		//else hasError = true;

 		// alert(4)

 		if (!checkError(date10Obj))  clearError(date10Obj);
 		else hasError = true;



 		if (!checkError(date11Obj))  clearError(date11Obj);
 		else hasError = true;

 	
 		if (!hasError ){
 		

 			$.ajax({
			  method: "post",
			  url:  "/booking/register" ,
			  data: $data,
			})
			  .success(function( data ) {

			  	 if (data.success){
			  	 	//Successfully booked
			  	 	$(".errorMsg1").text("");
			   		$(".successMsg").text(data.msg);
			   	 } 
			   	 else{
			   	 	$(".successMsg").text("");
			   	 	$(".errorMsg1").text(data.msg);
			   	 }
			  });
	 		}
 		
		  return false;

	 })

})



 function validateAddBuilding(form){

		removeAllErrors($(form));
		var hasError = false;

			var location = form['location'];
			if (!checkError(location)) clearError(location);
			else hasError = true;

			var buildingName = form['buildingName'];
			if (!checkError(buildingName)) clearError(buildingName);
			else hasError = true;

			var longitude = form['longitude'];
			if (!checkError(longitude)) clearError(longitude);
			else hasError = true;

			var lattitude = form['lattitude'];
			if (!checkError(lattitude)) clearError(lattitude);
			else hasError = true;

			var location = form['location'];
			if (!checkError(location)) clearError(location);
			else hasError = true;

			var image = form['image'];
			if (!checkError(image)) clearError(image);
			else hasError = true;


		return !hasError;
		}
		


 function validateAddRoom(form){
		removeAllErrors($(form));
		var hasError = false;

	var roomName = form['roomName'];
		if (!checkError(roomName)) clearError(roomName);

		else hasError = true;

	var capacity = form['capacity'];

		if (!checkError(capacity)) clearError(capacity);
		
		else hasError = true;

	var price = form['price'];

		if (!checkError(price)) clearError(price);
		
		else hasError = true;

		return !hasError;
}



function ValidateAddVehicles(form){

	
	removeAllErrors($(form));
		var hasError = false;

	var location = form['location'];
		if (!checkError(location)) clearError(location);

		else hasError = true;

	var models = form['models'];

		if (!checkError(models)) clearError(models);
		
		else hasError = true;

	var Password = form['color'];

		if (!checkError(color)) clearError(color);
		
		else hasError = true;

	var numOfSeats = form['numOfSeats'];

		if (!checkError(numOfSeats)){
			clearError(numOfSeats);
	
		} 
		
		else hasError = true;

		

	var name = form['name'];

		if (!checkError(name)) clearError(name);
		
		else hasError = true;



	var price = form['price'];

		if (!checkError(price)) clearError(price);
		
		else hasError = true;


	return !hasError;


}


function validateUpdateAccount(form){

	
removeAllErrors($(form));
		var hasError = false;

	var firstName = form['firstName'];
		if (!checkError(firstName)) clearError(firstName);

		else hasError = true;


	var lastName = form['lastName'];
		if (!checkError(lastName)) clearError(lastName);

		else hasError = true;


	var address = form['address'];
		if (!checkError(address)) clearError(address);

		else hasError = true;


	var phone = form['phone'];
		if (!checkError(phone)) clearError(phone);

		else hasError = true;
		


		if (!hasError) {
			
			url = "/user/update";
			data =  $(form).serialize();
			$.ajax({
			  type: "POST",
			  url: url,
			  data: data,
			  success: function(response){
			  	  var obj = $.parseJSON( response );
			  	  var $html="";

			  	  if (obj.status == 1){
			  	  		$html += "<span class='successMsg'>";
			  	 		$html += obj.msg ;
			  	 		$html += "</span><br />";


			  	  }
			  	  else if(obj.status == -1){
			  	  		$html += "<span class='errorMsg'>";
			  	 		$html += obj.msg ;
			  	 		$html += "</span><br />";
			  	  }

			  	  $("#message").html($html);

				
			  }
			});
		}


	return false;


}

function ValidateRegisterPackages(form){

	
removeAllErrors($(form));
		var hasError = false;

	var packageName = form['packageName'];
		if (!checkError(packageName)) clearError(packageName);
		else hasError = true;


	

		
	if (!hasError) {


			url = "/package/register";
			$data =  $(form).serialize();
			console.log($data );
			var $html='';
			$.ajax({
			  type: "POST",
			  url: url,
			  data: $data,
			  success: function(response){

			  	 	
			  	console.log(obj);
			  	  var obj = $.parseJSON( response );

			  	 	if (obj.status == 1 ){

			  	 		$("#packageName").val('');
			  	 		$("#adultPrice").val('');
			  	 		$("#childrenPrice").val('');
			  	 		$("#newPrice").val('');
			  	 		$("#desc").val('');
			  	 		
			  	 		$html += "<span class='successMsg'>";
			  	 		$html += obj.msg ;
			  	 		$html += "</span><br />";
			  	 	}
			  	 	else if (obj.status == -1 )	{
			  	 		$html += "<span class='errorMsg'>";
			  	 		$html += obj.msg ;
			  	 		$html += "</span><br />";
			  	 	}
			  	 
				$("#packageMessage").html($html);
				
			  }
			});
		}

	return false;



}



function validateAddCategories(form){

	
removeAllErrors($(form));
		var hasError = false;
		var hasError1 = false;
		var hasError2 = false;

	var roomCatName = form['roomCatName'];
		if (!checkError(roomCatName)) clearError(roomCatName);

		else hasError = true;


	var buildingcatName = form['buildingcatName'];
		if (!checkError(buildingcatName)) clearError(buildingcatName);

		else hasError1 = true;


	var vehiclecatName = form['vehiclecatName'];
		if (!checkError(vehiclecatName)) clearError(vehiclecatName);

		else hasError2 = true;



	if ((!hasError) || (!hasError1) || ( !hasError2)) {
			url = "/addCategories";
			data =  $(form).serialize();
			$.ajax({
			  type: "POST",
			  url: url,
			  data: data,
			  success: function(response){
			  	  var obj = $.parseJSON( response );
			  	  if (obj.status == -1){
			  	  	//user eists
			  	  	alert(obj.msg);
			  	  }
			  	  else if(obj.status == 1){
			  	  		alert(obj.msg);
			  	  		//location.reload();
			  	  		//redirect 
			  	  }
				
			  }
			});
		}

	return !hasError;



}



function validateAddFacilities(form){


removeAllErrors($(form));
		var hasError = false;
	

	var facilityName = form['facilityName'];
		if (!checkError(facilityName)) clearError(facilityName);

		else hasError = true;


	var facilityType = form['facilityType'];
		if (!checkError(facilityType)) clearError(facilityType);

		else hasError = true;


	

	if (!hasError) {
			url = "/addFacilities";
			data =  $(form).serialize();
			$.ajax({
			  type: "POST",
			  url: url,
			  data: data,
			  success: function(response){
			  	  var obj = $.parseJSON( response );
			  	  if (obj.status == -1){
			  	  	//user eists
			  	  	alert(obj.msg);
			  	  }
			  	  else if(obj.status == 1){
			  	  		alert(obj.msg);
			  	  		//location.reload();
			  	  		//redirect 
			  	  }
				
			  }
			});
		}

	return !hasError;


}





//packages update delete view
	
$(document).ready(function(){

/**
	setInterval(function(){
     $.get("/user/sessionTimeOutRedirect");
		}, 6000); // send request each 60 seconds
	
**/
	$("body").on('click','.BuildingUpdate1', function(){
		$(".building_wrapper1").html(updatePackageBuildingSkeleton(prevData, $(this).attr("href")));
		return false;
	})	




	$("body").on('click','.BuildingView1', function(){
		$(".buildings-list1 .active a").click();
		return false;
	})

	//update room page
	$("body").on('click','.packageUpdate', function(){
		$(".building_wrapper1").html(updatePackageSkeleton(prevData, $(this)));
		return false;
	})
	
	
		$("body").on("click",'.buildings-list1 a',function(){

		

		$(this).parents("ul").find("li").removeClass("active");
		$(this).parents("li").addClass("active");
	
		$.getJSON( $(this).attr("href"), function( data ) {
    		if (typeof data[0] !== "undefined") {
    			var str = packageSearchSkeleton(data[0]);

    			$(".building_wrapper1").html(str);

    			initPaginationPackage();
    		}
    		else{
    			$(".building_wrapper1").html('No result found');
    		}
		});

		return false
	});



		//Ajax delete building in package section
	$(".buildings-list1 .active a").click();


	$("body").on('click','.BuildingDelete1', function(){
		var r = confirm("Are you sure you want to delete the building!");
		if (r == true) {
		    $.getJSON( $(this).attr("href"), function( data ) {

    		
    			$(".building_wrapper1").html("");
    			
    			$(".buildings-list1 li.active").remove();
    			$(".buildings-list1 a:eq(0)").click();
    		
			});
		}
		return false;
	})


	//Package Delete
	$("body").on('click','.packageDelete', function(){
		var r = confirm("Are you sure you want to delete this package!");
		if (r == true) {
			var obj =  $(this);
		    $.getJSON( $(this).attr("href"), function( data ) {
		    	
    		$(obj).parents(".room").remove();
    		
		});
		}
		return false;
	})

	//Package Ajax update

	$("body").on('click','.packageUpdateAjax', function(){

		$data = $(this).parents("form").serialize();

		$.ajax({
		  method: "POST",
		  url:  "package/update",
		  data: $data
		})
		  .success(function( msg ) {
		    $(".building_wrapper1").html(updateRoomSkeleton(prevData, $(this)));
		    $(".buildings-list1 .active a").click();
		  });

		
		return false;
	})




	function updatePackageSkeleton(data, $obj){
		prevData = data;
		var $index = $obj.index();
		var room = "";
		if ($index > 0){
			packages = data.packages[$index-1];

			$html = '<div class="room-left">';
			$html += '<div class="room-header">';
			 $html += '<div class="roomname">  <span>Update - '+ packages.packageName +' </span>';
			  $html += '<a class="BuildingView1"  title = "Back" href="package/back?id='+ packages.id +'"></a>';
			 

  			$token = $("#token").val();
        $html += '<div class="room-footer">';
           $html += '<div class="roomDetails"><form name="updatepackage" action="'+ $obj.attr("href") +'"><input  id="packageid" name="packageid" type="hidden" value="'+ packages.id + '" /><input  id="_token" name="_token" type="hidden" value="'+ $token + '" />';

              
              $html += '<div class="roomCat">  Building type : <span> '+ data.category.buildingCatName +'</span></div>';
              $html += '<div class="roomdesc">  Description : <input  id="packagedesc" name="packagedesc" value="'+ data.packageName + '" />  </div>';
               $html += '<div class="roomprice">  Price : <input  id="capacityAdult" name="capacityAdult" value="'+ data.capacityAdult + '" />  </div>';
              $html += '<div class="roomLoc">  Address : <span> ' + data.buildingLocation + ' </span>  </div>';
              $html += '<div class="roomrooms">  No of Packages : <span> '+ data.packages.length +'</span></div>';
               $html += '<div class="">  <input type="submit" class="packageUpdateAjax" value="Update room" />  </div> </form>';

          $html += '</div>';
           
        
        $html += '<div class="clear"></div></div>';


       

		$html += '</div>';
		
			
		
        $html += ' </div>';
       
	   $html += '<div class="clear"></div>';
	   return $html;
		}

		
	}


	
//Query for packages and buildings ajax

	function packageSearchSkeleton(data){


		//alert("SearchSkeleton1");
		prevData = data;
			$html = '<div class="building-left">';
			$html += '<div class="building-header">';
			$html += '<div class="buildingname">  <span>'+ data.buildingName +' </span>';
			  $html += '<a class="BuildingDelete1"  title = "delete" href="building/delete?id='+ data.id +'"></a>';
			  $html += '<a class="BuildingUpdate1" title ="update" href="building/update?id='+ data.id +'"></a>';
              
            $html += '</div>';
				if (data.image != ''){
					$html += '<img alt="" href="" class="builindImg"/>';
				}
				else{
					$html += '<img alt="" href="'+ data.image + '" class="builindImg"/>';
				}
				
            
          console.log(data.facility);
            
  			$html += '</div>';
        	$html += '<div class="building-footer">';
            $html += '<div class="buildingDetails">';

              
            $html += '<div class="buildingCat">  Building type : <span> '+ data.category.buildingCatName +'</span></div>';
            $html += '<div class="buildingdesc">  Description : <span> '+ data.desc +'</span></div>';

            $html += '<div class="buildingLoc">  Address : <span> '+ data.buildingLocation +'</span></div>';
            
            if (typeof data.packages !== "undefined") {
            	$html += '<div class="buildingpackages">  No of packages : <span> '+ data.packages.length +'</span></div>';
            }

            
            $html += '<div class="buildingrooms">   <span> <img height="80" width="120" src  = "' + ' upload/' + data.image +' " </span></div>';
         	$html += '</div>';
           
          	$html += '<div id="googleMap">';
            $html += '';
          	$html += '</div>';
        	$html += '<div class="clear"></div></div>';
       
			$html += '</div>';
			$html += '<div class="rooms"  id="SearchresultPackage"></div>';

			$html += '<div class="dummyroomparent hide">';
 
			if (typeof data.packages !== "undefined") {
				for (i=0 ; i< data.packages.length ; i++){
							packages =  data.packages[i];
							$html += '<div class="room">';
						
							$html += '<div style="height:100px;width:200px;overflow:auto;"  class="roomDetails">';
							$html += '<a class="packageDelete"  title = "delete" href="deletePackage/delete?id='+ packages.id +'"></a>';
						 	$html += '<a class="packageUpdate" title ="update" href="/updatePackage/update?id='+ packages.id +'"></a>';
			              	$html += '<div class="packageName"> Package name : <span> '+ packages.packageName +'</span></div>';
			              	$html += '<div class="packageDesc"> Description : <span> '+ packages.packageDesc +'</span></div>';
			              	$html += '<div class="oldPrice"> Old Price : <span> '+ packages.oldPrice +'</span></div>';
			              	$html += '<div class="promotionExpiryDate"> Promotion Expiry Date : <span> '+ packages.promotionExpiryDate +'</span></div>';
			              	$html += '<div class="capacityAdult"> Capacity Adult : <span> '+ packages.capacityAdult +'</span></div>';
				         
				    
			          	$html += '</div>';
						$html += '</div>';
				}
			}
			$html += ' </div>';
        	$html += ' </div>';
       	 $html += '<div id="Paginationpackage"></div>';
	   		$html += '<div class="clear"></div>';
	   		return $html;
	}

	var pageNumPackage = 16;
	 function initPaginationPackage() {
           // count entries inside the hidden content
          var num_entries = jQuery('.dummyroomparent .room').length;

          // Create content inside pagination element
           $("#Paginationpackage").pagination(num_entries, {
                    callback: pageselectCallbackPackage,
                    items_per_page:pageNumPackage // Show only one item per page
          });
            
      }


        function pageselectCallbackPackage(page_index, jq){

        page_index = page_index*pageNumPackage;
         $('#SearchresultPackage').empty();

          
            

         for (i=0;i<pageNumPackage;i++){
             str1 = '.dummyroomparent .room:eq('+ (page_index+i)+')';
             
             new_content = $(str1 ).clone();
              $('#SearchresultPackage').append(new_content);
         }
                return false;
     }

//Ajax update building for package section

	function updatePackageBuildingSkeleton(data, $link){

	
		prevData = data;
		$html = '<div class="building-left">';
			$html += '<div class="building-header">';
			 $html += '<div class="buildingname">  <span>Update - '+ data.buildingName +' </span>';
			  $html += '<a class="BuildingView1"  title = "Back" href="building/back?id='+ data.id +'"></a>';
			 
              
              $html += '</div>';
				if (data.image != ''){
					$html += '<img alt="" href="" class="builindImg"/>';
				}
				else{
					$html += '<img alt="" href="'+ data.image + '" class="builindImg"/>';
				}
				
            
           
            
  			$html += '</div>';

  			$token = $("#token").val();
        $html += '<div class="building-footer">';
           $html += '<div class="buildingDetails"><form name="updateBuilding" action="'+ $link +'"><input  id="buildingid" name="buildingid" type="hidden" value="'+ data.id + '" /><input  id="_token" name="_token" type="hidden" value="'+ $token + '" />';

              
              $html += '<div class="buildingCat">  Building type : <span> '+ data.category.buildingCatName +'</span></div>';
              $html += '<div class="buildingdesc">  Description : <input  id="buildingdesc" name="buildingdesc" value="'+ data.desc + '" />  </div>';

              $html += '<div class="buildingLoc">  Address : <input  id="buildingLocation" name="buildingLocation" value="'+ data.buildingLocation + '" />  </div>';
              $html += '<div class="buildingrooms">  Nym of packages : <span> '+ data.packages.length +'</span></div>';
               $html += '<div class="">  <input type="submit" class="buildingUpdate1" value="Update building" />  </div> </form>';

          $html += '</div>';
           
        
        $html += '<div class="clear"></div></div>';


       

		$html += '</div>';
		
			
		
        $html += ' </div>';
       
	   $html += '<div class="clear"></div>';
	   return $html;
	}


	//Ajax update 

	
	$("body").on('click','.buildingUpdate1', function(){

		$data = $(this).parents("form").serialize();

		$.ajax({
		  method: "POST",
		  url:  "building/update",
		  data: $data
		})
		  .success(function( msg ) {
		    $(".buildings-list .active a").click();
		  });

		
		return false;
	})






		function initMap(){
		 var mapProp = {
		  center:myCenter,
		  zoom:12,
		  mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		return mapProp;
	}



	//Insert Room facility by ajax
	$("#addRoomFacilities").click(function(){

		$htmlFacility = "";
		$url = $(this).parents("form").attr("action");
			$data =  $(this).parents("form").serialize();
			var $html = "";
			$.ajax({
			  type: "POST",
			  url: $url,
			  data: $data,
			  success: function(response){
			  	  var obj = $.parseJSON( response );
			  	console.log(obj)
			  	  //  $("#Message").html(obj);
				 $index = $("#roomFacilityTableHide tr").size() - 1;
			  	 for (i =0; i< obj.length; i++){
			  	 	if (obj[i].status == 1 ){
			  	 		
			  	 		  $index  ++;
			  	 		$html += "<span class='successMsg'>";
			  	 		$html += obj[i].msg ;
			  	 		$html += "</span><br />";
			  	 		$htmlFacility += '<tr class="booking">';
			  	 		$htmlFacility += '<td>'+$index +'</td>';
			  	 		$htmlFacility += '<td>'+ 'dsaasd' +' </td>';
			  	 		$htmlFacility += '<td>meal</td>';
			  	 		$htmlFacility += '<td>     <a href="/RoomFacility/delete?id='+ obj[i].facility.id +'" class="btnLogin deleteRoomFacility">Delete</a></td>';
						$htmlFacility += '</tr>';
			  	 		
			  	 	}
			  	 	else if (obj[i].status == -1 )	{
			  	 		$html += "<span class='errorMsg'>";
			  	 		$html += obj[i].msg ;
			  	 		$html += "</span><br />";
			  	 	}
			  	 }
				$("#Message").html($html);
				$("#roomFacilityTableHide").append($htmlFacility);
			  }
			});
		return false;
	})



 //Insert building facility by ajax
 $("#addBuildingFacilities").click(function(){

		$url = $(this).parents("form").attr("action");
			$data =  $(this).parents("form").serialize();
			var $html = "";
			$.ajax({
			  type: "POST",
			  url: $url,
			  data: $data,
			  success: function(response){
			  	  var obj = $.parseJSON( response );
			  	  
			  	  //  $("#Message").html(obj);
				
			  	 for (i =0; i< obj.length; i++){
			  	 	if (obj[i].status == 1 ){
			  	 		$html += "<span class='successMsg'>";
			  	 		$html += obj[i].msg ;
			  	 		$html += "</span><br />";
			  	 	}
			  	 	else if (obj[i].status == -1 )	{
			  	 		$html += "<span class='errorMsg'>";
			  	 		$html += obj[i].msg ;
			  	 		$html += "</span><br />";
			  	 	}
			  	 }
				$("#Message1").html($html);
			  }
			});
		return false;
	})



 			
	
	$('a.deleteBuildingFacility').click(function(e) {

		var r = confirm("Are you sure you want to delete the building facility!");
		if (r == true) {

			var obj = $(this);
			$.ajax({
			  type: "GET",
			  url: $(this).attr("href"),
			  data: {"_token": $("#token").val()},
			  success: function(response){
			  	  //var obj = $.parseJSON( response );
			  	  $(obj).parents("tr.booking").remove();
	    			
    				
			  }
			});
		}
		return false;
		})


	$('a.deleteRoomFacility').click(function(e) {

		var r = confirm("Are you sure you want to delete the room facility!");
		if (r == true) {

			var obj = $(this);
			$.ajax({
			  type: "GET",
			  url: $(this).attr("href"),
			  data: {"_token": $("#token").val()},
			  success: function(response){
			  	  //var obj = $.parseJSON( response );
			  	  $(obj).parents("tr.booking").remove();
	    			
    				
			  }
			});
		}
		return false;
		})



 $("body").on("change",".selectAvailabilityVehicle",function(){
	 	$(this).parents(".block-vehicle-detail").find(".availabilityVehicle").click();
		return false;
 })
 

$("body").on('click', 'a.deleteBooking',function(e) {

		var r = confirm("Are you sure you want to delete the booking!");
		if (r == true) {

			var obj = $(this);
			$.ajax({
			  type: "GET",
			  url: $(this).attr("href"),
			  data: {"_token": $("#token").val()},
			  success: function(response){
			  	  //var obj = $.parseJSON( response );
			  	  $(obj).parents("tr.booking").remove();
	    			
    				
			  }
			});
		}
		return false;
		})



$("body").on('click', 'a.deleteVehicleBooking',function(e) 
{

		var r = confirm("Are you sure you want to delete the Booking!");
		if (r == true) {

			var obj = $(this);
			$.ajax({
			  type: "GET",
			  url: $(this).attr("href"),
			  data: {"_token": $("#token").val()},
			  success: function(response){
			  	  //var obj = $.parseJSON( response );
			  	  $(obj).parents("tr.booking").remove();
	    			
    				
			  }
			});
		}
		return false;
		})


$("body").on('click', 'a.adminDeleteVehicleBooking',function(e) 
{

		var r = confirm("Are you sure you want to delete the Booking!");
		if (r == true) {

			var obj = $(this);
			$.ajax({
			  type: "GET",
			  url: $(this).attr("href"),
			  data: {"_token": $("#token").val()},
			  success: function(response){
			  	  //var obj = $.parseJSON( response );
			  	  $(obj).parents("tr.booking").remove();
	    			
    				
			  }
			});
		}
		return false;
		})




$("body").on('click', 'a.LandlordDeleteBooking',function(e) {

		var r = confirm("Are you sure you want to delete the booking!");
		if (r == true) {

			var obj = $(this);
			$.ajax({
			  type: "GET",
			  url: $(this).attr("href"),
			  data: {"_token": $("#token").val()},
			  success: function(response){
			  	  //var obj = $.parseJSON( response );
			  	  $(obj).parents("tr.job").remove();
	    			
    				
			  }
			});
		}
		return false;
		})


$("body").on('click', 'a.adminDeleteRoomBooking',function(e) {

		var r = confirm("Are you sure you want to delete the booking!");
		if (r == true) {

			var obj = $(this);
			$.ajax({
			  type: "GET",
			  url: $(this).attr("href"),
			  data: {"_token": $("#token").val()},
			  success: function(response){
			  	  //var obj = $.parseJSON( response );
			  	  $(obj).parents("tr.job").remove();
	    			
    				
			  }
			});
		}
		return false;
		})




$("body").on('click', 'a.tenantDeleteBooking',function(e) {

		var r = confirm("Are you sure you want to delete the booking!");
		if (r == true) {

			var obj = $(this);
			$.ajax({
			  type: "GET",
			  url: $(this).attr("href"),
			  data: {"_token": $("#token").val()},
			  success: function(response){
			  	  //var obj = $.parseJSON( response );
			  	  $(obj).parents("tr.job").remove();
	    			
    				
			  }
			});
		}
		return false;
		})


});




$(document).ready(function(){



$('#advancedSearch').click(function(e) {


	advSearch($(this));
		return false;





})



$('#bestDeals #buildingName').keyup(function(e) {

advSearch($(this));
	


		return true;





})







$('#bestDeals #buildingCat').change(function(e) {

advSearch($(this));
	


		return true;





})


$('#bestDeals #buildingLocation').keyup(function(e) {

advSearch($(this));
	


		return true;


})


$('#bestDeals #buildingFacility').change(function(e) {

advSearch($(this));
	


		return true;


})

//vehicles advanced search events

$('#bestDeals #advancedVehicleSearch').click(function(e) 
{

	advancedVehicleSearch($(this));
	
	return false;


})

$('#bestDeals #vehicleName').keyup(function(e) 
{

	advancedVehicleSearch($(this));
	
	return true;


})
$('#bestDeals #numberOfSeats').keyup(function(e) 
{

	advancedVehicleSearch($(this));
	
	return true;


})

$('#bestDeals #price').keyup(function(e) 
{

	advancedVehicleSearch($(this));
	
	return true;


})

$('#bestDeals #vehicleCategory').change(function(e) 
{

	advancedVehicleSearch($(this));
	
	return true;


})

$('#bestDeals #driver').change(function(e) 
{

	advancedVehicleSearch($(this));
	
	return true;


})

$('#bestDeals #transmission').change(function(e) 
{

	advancedVehicleSearch($(this));
	
	return true;


})






//If user checks yes display vehicle block
 $('input[name=bookvehicle]').change(function() {
 	 	
        if (this.value == 'yes') {
        	 $(".tenantDealPackage .block-vehicle").removeClass("hide-block-vehicle");
            $(".tenantDealPackage .block-vehicle").show();
        }
        else{
        	 $(".tenantDealPackage .block-vehicle").addClass("hide-block-vehicle");
            $(".tenantDealPackage .block-vehicle").hide();
            $(".block-vehicle-detail").remove();
        }
       
    });


 //Creates vehicle selectboxes block based on numVehicle entered
 $('.block-vehicle select[name=numvehicles]').change(function() {
 	 	
       var numVehicles = this.value;
       $html ="";
       $obj = this;
       $($obj ).parent().find("span").text("");
       $options = "";

       $("block-vehicle-details").html("");


       $.getJSON( "/search?action=vehicles", function( data ) {
    		if (numVehicles > data.length){
    			$($obj ).parent().find("span").text("We do not have enough vehicles available at this moment.");
    			return;
    		}
    		for (j=0;j<data.length;j++){
    			$options += "<option value='"+data[j].id+"'>"+data[j].vehicleName+"</option>";
    		}

    	
    		for (i=0;i< numVehicles; i++){
	       		$html += "<div class='block-vehicle-detail'>";


	       		$html += "<p><label class='whiteText'>Return : </label>";
		         $html += '<input type="radio" name="block-vehicle['+i+'][dispatch]" value="true" > yes<input checked="checked" type="radio" name="block-vehicle['+i+'][dispatch]" value="false" >No  <span class="errorMsg"></span></p>';
					$html += "<br />"

					$html += "<p><label class='whiteText'>Choose vehicle : </label>";
		         $html += '<select  class="selectAvailabilityVehicle" name="block-vehicle['+i+'][vehicle]"  >'+$options+'</select> <span class="errorMsg"></span></p>';
					$html += "<br />"
					$html += "<p>";
		         $html += '<button class="availabilityVehicle"  value="Check availability" >Check availability</button><span class="errorMsg"></span></p>';
					$html += "<br />"
		       		$html += "</div>";
	       } 

	      
	       $(".block-vehicle-details").html($html);
    		
		});


	
       
    });


 


 $("body").on("change",".selectAvailabilityVehicle",function(){
	 	$(this).parents(".block-vehicle-detail").find(".availabilityVehicle").click();
		return false;
 })
 

 $("body").on("click",".availabilityVehicle",function(){
	 	$(".block-vehicle-detail").removeClass("block-vehicle-detail-error");
	 	$(obj).parents("p").find(".errorMsg").text("");
	 	var obj = $(this);
			$.ajax({
			  type: "GET",
			  url: "/search?action=availabilityVehicle",
			  data: {"_token": $("#token").val(),"vehicleid":$(obj).parents(".block-vehicle-detail").find("select").val(),"checkin": $("input[name=date10]").val(),"checkout": $("input[name=date11]").val(),"dispatch":$(obj).parents(".block-vehicle-detail").find("input[type=radio]:checked").val()},
			  success: function(response){
			  	  var objs = $.parseJSON( response );
			  	  
		    		if (objs.status){
		    			$(obj).parents("p").find(".errorMsg").text(objs.msg);
		    			$(obj).parents(".block-vehicle-detail").addClass("block-vehicle-detail-error");
		    		}
		    		else{
		    			$(obj).parents("p").find(".errorMsg").text("No conflict detected");
		    			$(obj).parents(".block-vehicle-detail").removeClass("block-vehicle-detail-error");
		    			$(obj).parents("p").find(".errorMsg").css("color","green");
		    		}
    				
			  }
			});
			return false;
	 })


 $("#advancedSearch").click();

 $("#advancedVehicleSearch").click();





});




var loadingAdv = false;

 function advSearch($curr){
 	
 	loadingAdv = true;
 	$url = $($curr).parents("form").attr("action");
	//alert($url);
			$data =  $($curr).parents("form").serialize();
			//alert($data);
			var $html = "";
			 $("#AdvSearchResult").html($html);
			$.ajax({
			  type: "POST",
			  url: $url,
			  data: $data,
			  success: function(response){
			  	//alert('dasasd');

			  	if (loadingAdv){
			  		 var obj = $.parseJSON( response );
			  	  $html = "";

			  	  if (obj.length == 0){
			  	  	$html  ="No result found";
			  	  }
			  	  for (i=0;i<obj.length;i++){

			  	  	$html += '<div class="recently-posted-building">';
			  	  	$html += '<img src="/upload/'+obj[i].image+'" alt="" width="50" height="50">';
			  	  	$html += '<div class="advRoomDivInfo">';
			  	  	$html += '<p>';
			  	  	$html += '<label class="advRoom">Name: </label>';
			  	  	$html += '<span class="buildingName">'+obj[i].buildingName+'</span><br/>';
			  	  	$html += '<label class="advRoom">Location: </label>';
			  	  	$html += '<span class="location"> '+obj[i].buildingLocation+'</span><br/>';
			  	  	$html += '<label class="advRoom">Type: </label>';
			  	  	$html += '<span class="location"> '+obj[i].category.buildingCatName+'</span><br/>';
			  	  	$html += '<label class="advRoom ">Description: </label>';
			  	  	$html += '<span class="description"> '+obj[i].desc+'</span>';
			  	  	
			  	  	$html += '</p>';
			  	  	$html += '</div>';

			  	  	$html += ' <a href="/package/'+obj[i].id+'" data-buildingid="'+obj[i].id+'" data-buildingname="'+obj[i].buildingName+'">Book now</a>';
			  	  	$html += '<div class="clear"></div></div>';
			  	  }


			  	  $("#AdvSearchResult").append($html+'<div class="clear"></div>');
			  	  loadingAdv = false;
			  	}
			  	 
				
			 
			  }
			});


 }



 function advancedVehicleSearch($curr){
 	
 	loadingAdv = true;
 			$url = $($curr).parents("form").attr("action");
	//alert($url);
			$data =  $($curr).parents("form").serialize();
			
			var $html = "";
			 $("#AdvVehicleSearchResult").html($html);
			$.ajax({
			  type: "POST",
			  url: $url,
			  data: $data,
			  success: function(responses){
			 

			  	if (loadingAdv){
			  		 
			  		 var obj = $.parseJSON( responses );
			  		  	
			  	  $html = "";
			  	 // console.log(obj);
			  	  if (obj.length == 0){
			  	  	$html  ="No result found";
			  	  }
			  	
			  	  for (i=0;i<obj.length;i++){

			  	  	$html += '<div class="recently-posted-building">';
			  	  	$html += '<img src="/upload/'+obj[i].image+'" alt="" width="200" height="200">';
			  	  	$html += '<p>';
			  	  	$html += '<div class="advRoomDivInfo">';
			  	  	$html += '<label class="fontVehicleAdv">Name: </label>';
			  	  	$html += '<span class="Name">'+obj[i].vehicleName+'</span><br/>';
			  	  	$html += '<label class="fontVehicleAdv">Seats: </label>';
			  	  	$html += '<span class="Seats"> '+obj[i].numOfSeats+'</span><br/>';
			  	  	$html += '<label class="fontVehicleAdv">Type: </label>';
			  	  	$html += '<span class="Type"> '+obj[i].category.vehiclecatname+'</span><br/>';
			  	  	$html += '<label class="fontVehicleAdv">Transmission: </label>';
			  	  	$html += '<span class="Transmission"> '+obj[i].transmission+'</span><br/>';
			  	  	$html += '<label class="fontVehicleAdv">Color: </label>';
			  	  	$html += '<span class="Color"> '+obj[i].color+'</span><br/>';
			  	  	$html += '<label class="fontVehicleAdv">Price per hour: </label>';
			  	  	$html += '<span class="Price"> ' + 'Rs'+ obj[i].price+'</span><br/>';
			  	  	$html += '<label class="fontVehicleAdv" >Description: </label>';
			  	  	$html += '<span class="Description "> ' +  obj[i].description+'</span><br/>';
			  	  	$html += '</div>';
			  	  	$html += '</p>';

			  	  	$html += ' <a href="/bookVehiclesProcess/'+obj[i].id+'" data-vehicleid="'+obj[i].id+'" data-vehiclename="'+obj[i].vehicleName+'">Book now</a>';
			  	  	$html += '<div class="clear"></div></div>';
			  	  }
			  	  //console.log(	$html )

			  	  $("#AdvVehicleSearchResult").append($html+'<div class="clear"></div>');
			  	  loadingAdv = false;
			  	}
			  	 
				
			 
			  }
			});


 	



 }