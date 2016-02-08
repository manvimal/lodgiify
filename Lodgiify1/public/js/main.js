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
		
		return false;
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
	//set capcha
	$("#btnrefresh").click();

	validateContactForm();

	$(".buildings-list a").click(function(){

		$.getJSON( $(this).attr("href"), function( data ) {
	
    		alert(1212);
		});

		return false
	})


	

})