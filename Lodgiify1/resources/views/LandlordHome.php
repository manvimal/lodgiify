
<html>
<head>
<link rel="icon" type="image/ico" href="images/FaviconLogiify.ico">
<title>LOGIIFY | YOUR ROOM RENTAL MANAGEMENT SYSTEM</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Karla' rel='stylesheet' type='text/css'>
<link href="css/elastislide.css" rel="stylesheet" type="text/css" media="all" />
<!-- Add fancyBox main JS and CSS files -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
<script src="js/validation.js" type="text/javascript"></script>

<link href="css/magnific-popup.css" rel="stylesheet" type="text/css">
		<script>
			$(document).ready(function() {
				$('.popup-with-zoom-anim').magnificPopup({
					type: 'inline',
					fixedContentPos: false,
					fixedBgPos: true,
					overflowY: 'auto',
					closeBtnInside: true,
					preloader: false,
					midClick: true,
					removalDelay: 300,
					mainClass: 'my-mfp-zoom-in'
			});
		});
		</script>
</head>



<body>
  <div class="header">	
       <div class="wrap"> 
	         <div class="logo">
				<a href="index"><img src="images/logo.png" alt=""/></a>
			 </div>
             <?php

                if (empty($user)){
             ?>
                <form name="login" action="/user/login" onsubmit="return validateLogin(this)">
                    <table class="login">
                            <tr>
                            <td>User Name:</td> 
                            <td><input type="text" name="LoginUserName" class="required" /><br /><span class="errorMsg"></span> </td>
                        
                            <td>Password:</td> 
                            <td><input type="password" name="LoginPassword" class="required"/> <br /><span class="errorMsg"></span></td>
                        
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
                        <a href="#">
                            <?php
                                echo  $user[0]->tenantLastName;
                            ?>

                         </a>

                         <a href="/user/logoff">
                            Sign off
                         </a>

                    </span>
                <?php
                    }
                ?>




			 <div class="cssmenu">
				<ul>
					<li><a href="index">Home</a></li>
					<li><a href="portfolio.html">Portfolio</a></li> 
					<li><a href="blog.html">Blog</a></li> 
                    <li class="active"><a href="#">Registration</a></li> 
					<li><a href="aboutus">About Us</a></li> 
					<li><a href="contactus">Contact</a></li>
				</ul>
		     </div>
		    <div class="clear"></div>
	   </div>
   </div>

   <div class="banner">
      	<div class="wrap">
      	     <h2>Registration</h2><div class="clear"></div>
      	</div>
    </div>
	<div class="main">	
	 <div class="project-wrapper">
	   <div class="project">
	    <div class="blog-left">
			<div class="blog-bg">
			   <h4>Register Now</h4><span class="author">Sign up for free</span><div class="clear"></div>
			</div>


			<div class="blog-img">

    <form method="post"  action="/user/registration" onSubmit="return validate(this)">
    
             </form>
 
			</div>
	
     





		
		</div>
	   <div class="clear"></div>
	 
	 </div>
	 <div class="project-sidebar">
	 	<div class="project-list">
	 	 <div class="search_box">
			<form>
				<input type="text" value="Search...." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
				<input type="submit" value="">
			</form>
		 </div>
		</div>
		<div class="project-list">
	     	<h4>Categories</h4>
			<ul class="blog-list">
				<li><img src="images/arrow.png" alt=""><p><a href="#">Honeymoon</a></p><div class="clear"></div></li>
			
			</ul>
			
			<div class="clear"></div>
		 </div>
		 
		 <div class="project-list1">
	     	<h4>Trending</h4>
			<ul>
				<li><img src="images/list-img.jpg" alt=""><p><a href="#">Top Spots to visit</a></p>
					<span class="likes"><span class="link"><a href="#">^_^</a></span><a href="#"><img src="images/heart.png" title="likes" alt=""/></a>16</span><div class="clear"></div>
				</li>
			
			</ul>
		 </div>
		 
	 </div>


	 <div class="clear"></div>
  </div>
   		
      	   		                                                                                            
<div class="footer">
    <div class="footer-top">
       <div class="wrap">
           <div class="section group">
                <div class="col_1_of_3 span_1_of_3">
                    <h3>About Us</h3>
                    <p>Lorem ipsum dolor.</p>
                    <button class="btn1 btn-8 btn-8b">Learn more</button>
                    <h4>Photo Stream</h4>
                    <div class="gallery">
                        <ul>
                            <li><a class="popup-with-zoom-anim" href="#small-dialog1"><img src="images/g1.jpg" alt=""/></a></li>
                            <li><a class="popup-with-zoom-anim" href="#small-dialog1"><img src="images/g2.jpg" alt=""/></a></li>
                            <li><a class="popup-with-zoom-anim" href="#small-dialog1"><img src="images/g3.jpg" alt=""/></a></li>
                            <li><a class="popup-with-zoom-anim" href="#small-dialog1"><img src="images/g4.jpg" alt=""/></a></li>
                             <div id="small-dialog1" class="mfp-hide">
                                <div class="pop_up">
                                    <h2>A Sample Photo Stream</h2>
                                    <img src="images/g_zoom.jpg" alt=""/>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col_1_of_3 span_1_of_3">
                    <h3>Latest tweets</h3>
                    <div class="footer-list">
                        <ul>
                            <li><img src="images/tw.png" alt=""/><p>Lorem ipsum <span class="yellow"><a href="#">consectetuer</a></span> adipiscing elit, seddia<br><span class="small">&nbsp;web design</span></p><div class="clear"></div></li>
                            <li><img src="images/tw.png" alt=""/><p>Lorem ipsum <span class="yellow"><a href="#">consectetuer</a></span> adipiscing elit, seddia<br><span class="small">&nbsp;web design</span></p><div class="clear"></div></li>
                            </ul>
                    </div>
                     <div class="social-icons"> 
                        <h4>Social Connecting</h4>
                            <ul>    
                              <li class="facebook"><a href="#"><span> </span></a></li>
                              <li class="google"><a href="#"><span> </span></a></li>
                              <li class="twitter"><a href="#"><span> </span></a></li>
                              <li class="linkedin"><a href="#"><span> </span></a></li>   
                              <li class="youtube"><a href="#"><span> </span></a></li>   
                              <li class="bloger"><a href="#"><span> </span></a></li>
                              <li class="rss"><a href="#"><span> </span></a></li>   
                              <li class="dribble"><a href="#"><span> </span></a></li>                   
                            </ul>
                     </div>
                </div>
                <div class="col_1_of_3 span_1_of_3">
                    <h3>Contact info</h3>
                    <div class="footer-list">
                        <ul>
                            <li><img src="images/address.png" alt=""><p>La tour Koeing, UTM</p><div class="clear"></div></li>
                            <li><img src="images/phone.png" alt=""><p>Phone: 57139151<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2612205 </p><div class="clear"></div></li>
                            <li><img src="images/msg.png" alt=""><p>Email: <span class="yellow1"><a href="#">lokeshpravin@gmail.com</a></span></p><div class="clear"></div></li>
                    </ul>
                    </div>
                    <div class="follow">
                       <h4>Follow Us</h4>
                       <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod</p>
                       <div class="search">
                          <form>
                               <input type="text" value="">
                               <input type="submit" value="">
                          </form>
                       </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
      </div>
     </div>
     <div class="footer-bottom">
        <div class="wrap">
            <div class="copy">
                <p class="copy">© 2015 by <a href="" target="_blank">Basdeo Lokesh</a></p>
            </div>
            <div class="footer-nav">
                <ul>
                    <li><a href="index">Home</a></li>
                    <li><a href="portfolio.html">Portfolio</a></li> 
                    <li><a href="blog.html">Blog</a></li> 
                    <li><a href="#">Registration</a></li> 
                    <li><a href="about">About Us</a></li> 
                    <li><a href="contactus">Contact</a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
</body>
</html>