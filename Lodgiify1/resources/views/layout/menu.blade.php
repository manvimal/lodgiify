
			 <div class="cssmenu">
				<ul>
					<li class=""><a href="{{ URL::asset('/index') }}">Home</a></li>
					<!-- <li><a href="portfolio.html">Portfolio</a></li> 
					<li><a href="blog.html">Blog</a></li>  -->
					

					<?php
						if (empty($user)){
			 		?>
			 			<li><a href="{{ URL::asset('/aboutus') }}">About Us</a></li>
						<li><a href="{{ URL::asset('/registration') }}">Sign Up</a></li> 
						<li><a href="{{ URL::asset('/contactus') }}">Contact</a></li>
					<?php
						}
			 		?>
			 		

					<?php
						if($user['type'] == 'tenant'){
					?>
						<li><a href="{{ URL::asset('/booking') }}">Bookings</a></li>
						<li><a href="{{ URL::asset('/mybooking') }}">My Bookings</a></li>
						<li><a href="{{ URL::asset('/aboutus') }}">About Us</a></li> 
						<li><a href="{{ URL::asset('/contactus') }}">Contact Us</a></li>
					<?php
						}
					?>

					

					<?php 
						if ($user['type']==  'landlord'){
					?>
						<li><a href="{{ URL::asset('/addBuilding') }}">Add Building</a></li>
						<li><a href="{{ URL::asset('/addRoom') }}">Add Room</a></li>
						<li><a href="{{ URL::asset('/viewBuildings') }}">Building</a></li>
						<li><a href="{{ URL::asset('/insertPackage') }}">Administer package</a></li>
						<li><a href="{{ URL::asset('/viewPackage') }}">Package</a></li>
						<li><a href="{{ URL::asset('/contactus') }}">Contact Us</a></li>
					<?php

						}
					?>

					<?php 
						if ($user['type']==  'vehicleowner'){
					?>
						<li><a href="{{ URL::asset('/addVehicle') }}">Add vehicle</a></li>
						<li><a href="{{ URL::asset('/viewVehicles') }}">Vehicles</a></li>
						<li><a href="{{ URL::asset('/aboutus') }}">About Us</a></li>
						<li><a href="{{ URL::asset('/contactus') }}">Contact Us</a></li> 
					<?php

						}
					?>
				
					
				</ul>
		     </div>
		    