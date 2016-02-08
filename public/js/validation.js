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

		/*if (!hasError) {
			url = "user/login";
			data =  $(form).serialize();
			$.ajax({
			  type: "GET",
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
		}*/
		return !hasError;
}



function validateContactForm(){

	$("#contact").submit(function(){ 

		var form = $(this).get(0);

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
			  method: "get",
			  url: "user/sendMsg",
			  data: $(form).serialize()
			})
			  .success(function( msg ) {
			  	 $(".msg").addClass("success");
			  	 $(contactEmail).val("");
			  	 $(contactMessage).val("");
			  	 $(contactName).val("");
			    $(".msg").text( "Your message has been sent "  );
			  })
			  .error(function( msg){
			  		$(".msg").addClass("error");
			  	 $(".msg").text( "Your message has not been sent"  );

			  })

		}

	});

	
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
			  type: "GET",
			  url: url,
			  data: data,
			  success: function(response){
			  	  var obj = $.parseJSON( response );
			  	  if (obj.status == -1){
			  	  	//user eists
			  	  	alert(obj.msg);
			  	  }
			  	  else if(obj.status == 1){
			  	  		window.location = "index";
			  	  		//location.reload();
			  	  		//redirect 
			  	  }
				
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
		var pattern = /\d{4}\-[0-3]\d\-\d{2} [0-1]\d:[0-5]\d/
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

	//set capcha
	$("#btnrefresh").click();

	validateContactForm();


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
		    $(".building_wrapper").html(updateRoomSkeleton(prevData, $(this)));
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


	function updateRoomSkeleton(data, $obj){
		prevData = data;
		var $index = $obj.index();
		var room = "";
		if ($index > 0){
			room = data.rooms[$index-1];

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
              $html += '<div class="roomdesc">  Description : <input  id="roomdesc" name="roomdesc" value="'+ data.desc + '" />  </div>';
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


	//Ajax delete and click on menu
	
	$(".buildings-list a").click(function(){
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
					$html += '<img alt="" href="'+ data.image + '" class="builindImg"/>';
				}
				
            
           
            
  			$html += '</div>';
        $html += '<div class="building-footer">';
           $html += '<div class="buildingDetails">';

              
              $html += '<div class="buildingCat">  Building type : <span> '+ data.category.buildingCatName +'</span></div>';
              $html += '<div class="buildingdesc">  Description : <span> '+ data.desc +'</span></div>';

              $html += '<div class="buildingLoc">  Address : <span> '+ data.buildingLocation +'</span></div>';
              $html += '<div class="buildingrooms">  No of rooms : <span> '+ data.rooms.length +'</span></div>';
              $html += '<div class="buildingrooms">  Image : <span> <img height="80" width="120" src  = "' + ' upload/' + data.image +' " </span></div>';
              //	alert('./upload/' + data.image);
          $html += '</div>';
           
          $html += '<div id="googleMap">';
            $html += '';
          $html += '</div>';
        $html += '<div class="clear"></div></div>';


        infowindow = new google.maps.InfoWindow({
				  content:data.buildingName + " - " + data.desc
		 });
        myCenter=new google.maps.LatLng( data.lattitude, data.longitude);


		$html += '</div>';
		$html += '<div class="rooms">';

			for (i=0 ; i< data.rooms.length ; i++){
				room =  data.rooms[i];
				$html += '<div class="room">';
					 $html += '<div class="roomDetails">';
					  $html += '<a class="RoomDelete"  title = "delete" href="room/delete?id='+ room.id +'"></a>';
			  $html += '<a class="RoomUpdate" title ="update" href="room/update?id='+ room.id +'"></a>';
              	   $html += '<div class="roomName"> Room name : <span> '+ room.roomName +'</span></div>';
	              $html += '<div class="roomCat"> Room type : <span> '+ room.roomCatID +'</span></div>';
	              $html += '<div class="roomdesc">  Description : <span> '+ room.desc +'</span></div>';
	              $html += '<div class="roomisOccupied">  Occupied : <span>'+ room.isOccupied +' </span></div>';
	               $html += '<div class="roomstart"> StartDate : <span> '+ room.startDate +'</span></div>';
	               $html += '<div class="roomend">  End date : <span> '+ room.endDate +'</span></div>';
	               $html += '<div class="roomPrice">  price : <span>Rs. '+ room.price +'</span></div>';
	              
          $html += '</div>';
				$html += '</div>';
			}
        $html += ' </div>';
       
	   $html += '<div class="clear"></div>';
	   return $html;
	}



//vehicles
	$(".inner-list a").click(function(){
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
	$(".inner-list a:eq(0)").click();

	//display scroll bar
	$('#contentHolder').perfectScrollbar();


	 //tabs for booking popup
	 $( "#tabs" ).tabs({
               heightStyle:"fill",
              // collapsible:true,
               //hide:"slideUp"









               
    });



	 //Get selected package while booking
	 $("#package").change(function(){

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
			  	 	console.log(data);
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




 	 


	
 	// Register booking
	$(".bookPckNow").click(function(){


	 	//validate booking
	 	var numChild = $(".deals-list #children").val();
 		var numAdult = $(".deals-list #adults").val();
 		var package = $(".deals-list #package").val();
 		var start = $(".deals-list input[name=date10]").val();
 		var end = $(".deals-list input[name=date11]").val();

 		var token = $("#token").val();
 		
 		var $data =  { 'numChild': numChild, 'numAdult': numAdult ,'package': package, 'start': start, 'end': end , "_token": token};

 		var baseform = document.forms['registerBooking'];
 		var packageObj = baseform['package'];
 		var adultsObj = baseform['adults'];
 		var childrenObj = baseform['children'];
 		var date10Obj = baseform['date10'];
 		var date11Obj = baseform['date11'];

 		removeAllErrors($(baseform));
 		
// alert(1)
 		var hasError = false;

 		if (!checkError(packageObj))  clearError(packageObj);
 		else hasError = true;
 			// alert(2)
 		
 		if (!checkError(adultsObj))  clearError(adultsObj);
 		else hasError = true;

// alert(3)
 		if (!checkError(childrenObj))  clearError(childrenObj);
 		else hasError = true;

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

			var latitude = form['latitude'];
			if (!checkError(latitude)) clearError(latitude);
			else hasError = true;

			var longitude = form['longitude'];
			if (!checkError(longitude)) clearError(longitude);
			else hasError = true;

		/*if (!hasError) {
			url = "user/login";
			data =  $(form).serialize();
			$.ajax({
			  type: "GET",
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
		}*/
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

		if (!checkError(numOfSeats)) clearError(numOfSeats);
		
		else hasError = true;

		return hasError;

	var name = form['name'];

		if (!checkError(name)) clearError(name);
		
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
	



	return !hasError;


}

function ValidateRegisterPackages(form){

	
removeAllErrors($(form));
		var hasError = false;

	var packageName = form['packageName'];
		if (!checkError(packageName)) clearError(packageName);

		else hasError = true;


	if (!hasError) {
			url = "insertPackage";
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



/**
	$("body").on('click','.deleteBooking', function(){
		var r = confirm("Are you sure you want to delete your booking!");
		if (r == true) {
		    $.getJSON( $(this).attr("href"), function( data ) {
    			$(".inner_wrapper").html("");
    			$(".inner-list li.active").remove();
    			$(".inner-list a:eq(0)").click();
    		
			});
		}
		return false;
	})
**/







//packages update delete view
	
$(document).ready(function(){

		$(".buildings-list1 a").click(function(){

		//alert("hello");

		$(this).parents("ul").find("li").removeClass("active");
		$(this).parents("li").addClass("active");
	
		$.getJSON( $(this).attr("href"), function( data ) {
    		
    		if (typeof data[0] !== "undefined") {
    			var str = packageSearchSkeleton(data[0]);
    			$(".building_wrapper1").html(str);

    			console.log(str);
    			var map=new google.maps.Map(document.getElementById("googleMap"), initMap());
    			var marker=new google.maps.Marker({
				  position:myCenter,
				  });
    			marker.setMap(map);

			
				infowindow.open(map,marker);

				//updateDeleteAction();
				//updateDeleteRoomAction();
    		}
    		else{
    			$(".building_wrapper1").html('No result found');
    		}
		});

		return false
	});



	$("body").on('click','.BuildingDelete1', function(){
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

	


	function packageSearchSkeleton(data){


		//alert("SearchSkeleton1");
		prevData = data;
			$html = '<div class="building-left">';
			$html += '<div class="building-header">';
			$html += '<div class="buildingname">  <span>'+ data.buildingName +' </span>';
			//  $html += '<a class="BuildingDelete1"  title = "delete" href="building/delete?id='+ data.id +'"></a>';
			//  $html += '<a class="BuildingUpdate1" title ="update" href="building/update?id='+ data.id +'"></a>';
              
            $html += '</div>';
				if (data.image != ''){
					$html += '<img alt="" href="" class="builindImg"/>';
				}
				else{
					$html += '<img alt="" href="'+ data.image + '" class="builindImg"/>';
				}
				
            
         //  alert(data.packages.length);
            
  			$html += '</div>';
        	$html += '<div class="building-footer">';
            $html += '<div class="buildingDetails">';

              
            $html += '<div class="buildingCat">  Building type : <span> '+ data.category.buildingCatName +'</span></div>';
            $html += '<div class="buildingdesc">  Description : <span> '+ data.desc +'</span></div>';

            $html += '<div class="buildingLoc">  Address : <span> '+ data.buildingLocation +'</span></div>';
            $html += '<div class="buildingpackages">  No of packages : <span> '+ data.packages.length +'</span></div>';
            $html += '<div class="buildingrooms">  Image : <span> <img height="80" width="120" src  = "' + ' upload/' + data.image +' " </span></div>';
         	$html += '</div>';
           
          	$html += '<div id="googleMap">';
            $html += '';
          	$html += '</div>';
        	$html += '<div class="clear"></div></div>';
       alert(data.longitude);

        		infowindow = new google.maps.InfoWindow({
				content:data.buildingName + " - " + data.desc
		 		});
        		myCenter=new google.maps.LatLng( data.lattitude, data.longitude);
        		

			$html += '</div>';
			$html += '<div class="rooms">';
	console.log(data.packages);
			for (i=0 ; i< data.packages.length ; i++){
				packages =  data.packages[i];
				$html += '<div class="room">';
				$html += '<div class="roomDetails">';
				$html += '<a class="RoomDelete"  title = "delete" href="package/delete?id='+ packages.id +'"></a>';
			 	$html += '<a class="RoomUpdate" title ="update" href="room/update?id='+ packages.id +'"></a>';
              	$html += '<div class="packageName"> Room name : <span> '+ packages.packageName +'</span></div>';
              	$html += '<div class="packageDesc"> Package Description : <span> '+ packages.packageDesc +'</span></div>';
              	$html += '<div class="oldPrice"> Old Price : <span> '+ packages.oldPrice +'</span></div>';
              	$html += '<div class="promotionExpiryDate"> Promotion Expiry Date : <span> '+ packages.promotionExpiryDate +'</span></div>';
              	$html += '<div class="capacityAdult"> Capacity Adult : <span> '+ packages.capacityAdult +'</span></div>';
	         
	              
          	$html += '</div>';
			$html += '</div>';
			}
        	$html += ' </div>';
       
	   		$html += '<div class="clear"></div>';
	   		return $html;
	}



		function initMap(){
		 var mapProp = {
		  center:myCenter,
		  zoom:12,
		  mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		return mapProp;
	}

});