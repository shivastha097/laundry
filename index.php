<?php require_once('admin/database-config.php') ?>

<?php include_once('header.php') ?>

<section id="banner">
	<div class="content text-center">
		<h1>NO TIME TO WASH CLOTHES?</h1>
		<h3 class="pt-0 pb-3">WE ARE HERE.</h3>
		<a href="#place_order"><button class="btn btn-primary btn-lg">Place Order</button></a>
	</div>
</section>

<section id="about_us">
	<div class="container">
		<div class="row">
			<div class="col-12 ">
				<h2 class="text-center">ABOUT US</h2>
				<p>MeroWash, the first of its kind in outside the Kathmandu valley, is an online laundry and dry cleaning service to provide you with the unmatched and unheard services.</p><br>
				<p>We are a team of young professionals dedicated to bring you about change in how laundry is carried out, helping you get more time with your loved ones while we take care of your dirty laundry.We offer free pick up and drop.We offer more than just laundry services - by making your clothes shine more than ever we help you feel more confident, dashing, graceful, and what not!</p>
			</div>
		</div>
	</div>
</section>

<section id="how_we_work">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h2>HOW WE WORK</h2>
			</div>
			<div class="col-md-4 col-sm-12 py-3">
				<div class="pickup">
					<div class="image ">
						<img src="img/001-pickup.png" alt="">
					</div>
					<div class="desc float-left">
						<h3>PICKUP</h3>
						<p>Once we get your order, we <span>PICKUP</span> your clothes from your doorsteps.</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-12 py-3">
				<div class="wash">
					<div class="image">
						<img src="img/002-wash.png" alt="">
					</div>
					<div class="desc">
						<h3>WASH</h3>
						<p>We wash your clothes using advanced washing technology.</p>
					</div>	
				</div>
			</div>
			<div class="col-md-4 col-sm-12 py-3">
				<div class="delivery">
					<div class="image">
						<img src="img/003-delivery.png" alt="">
					</div>
					<div class="desc">
						<h3>DELIVER</h3>
						<p>We pack and fold and deliver your clothes safely to your doorsteps.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="place_order">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h2>PLACE ORDER</h2>
			</div>
			<div class="col-12">
				<form class="mx-md-5" id="myform" action="messageValidation.php" method="post">
					<div class="form-row">
					  <div class="form-group col-md-6">
					    <label for="inputFirstName">First Name *</label>
					    <input type="text" class="form-control" id="inputFirstName" placeholder="First name" name="firstName">
					    <span class="error">
			            	<?php 
        		            	if (isset($_GET) && !empty($_GET)) {
        		            		echo $_GET['lname'];
        		            	}
        	             	?>	
        	            </span>
					  </div>
					  <div class="form-group col-md-6">
					    <label for="inputLastName">Last Name *</label>
					    <input type="text" class="form-control" id="inputLastName" placeholder="Last name" name="lastName">
			            <span class="error">
			            	<?php 
        		            	if (isset($_GET) && !empty($_GET)) {
        		            		echo $_GET['lname'];
        		            	}
        	             	?>	
        	            </span>
					  </div>
					</div>
					<div class="form-row">
					  <div class="form-group col-md-6">
					    <label for="inputEmail">Email *</label>
					    <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
			            <span class="error">
			            	<?php 
        		            	if (isset($_GET) && !empty($_GET)) {
        		            		echo $_GET['email'];
        		            	}
        	             	?>	
        	            </span>
					  </div>
					  <div class="form-group col-md-6">
					    <label for="inputPhone">Phone *</label>
					    <input type="text" class="form-control" id="inputPhone" placeholder="Phone number" name="phone">
			            <span class="error">
			            	<?php 
        		            	if (isset($_GET) && !empty($_GET)) {
        		            		echo $_GET['phone'];
        		            	}
        	             	?>	
        	            </span>
					  </div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-8">
							<label for="pickupDate">Pickup Date *</label>
							<input type="date" class="form-control" id="pickupDate" name="pickupDate">
				            <span class="error">
				            	<?php 
            		            	if (isset($_GET) && !empty($_GET)) {
            		            		echo $_GET['pickupDate'];
            		            	}
            	             	?>	
            	            </span>
						</div>
						<div class="form-group col-md-4">
							<label for="pickupTime">Pickup Time *</label>
							<input type="time" class="form-control" id="pickupTime" name="pickupTime">
				            <span class="error">
				            	<?php 
            		            	if (isset($_GET) && !empty($_GET)) {
            		            		echo $_GET['pickupTime'];
            		            	}
            	             	?>	
            	            </span>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-8">
							<label for="inputAddress">Address *</label>
							<input type="text" class="form-control" id="inputAddress" name="address" placeholder="Enter your full address">
				            <span class="error">
				            	<?php 
            		            	if (isset($_GET) && !empty($_GET)) {
            		            		echo $_GET['address'];
            		            	}
            	             	?>	
            	            </span>
						</div>
						<div class="form-group col-md-4">
							<label for="inputCity">City *</label>
							<input type="text" class="form-control" id="inputCity" name="city" readonly value="Biratnagar">
				            <span class="error">
				            	<?php 
            		            	if (isset($_GET) && !empty($_GET)) {
            		            		echo $_GET['city'];
            		            	}
            	             	?>	
            	            </span>
						</div>
					</div>
					<div class="form-group">
						<label for="">Types of Garment *</label>
						<div class="form-group">
							<div class="form-check-inline col-sm-3 col-4">
								<input type="checkbox" class="form-check-input" id="garmentCheck1" name="garmentType[]" value="Shirt">
							    <label class="form-check-label custom-check" for="garmentCheck1">
							    Shirt
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
								<input type="checkbox" class="form-check-input" id="garmentCheck2" name="garmentType[]" value="Pant">
							    <label class="form-check-label custom-check" for="garmentCheck2">
							    Pant
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
								<input type="checkbox" class="form-check-input" id="garmentCheck3" name="garmentType[]" value="Jeans pant">
							    <label class="form-check-label custom-check" for="garmentCheck3">
							    Jeans Pant
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
							    <input type="checkbox" class="form-check-input" id="garmentCheck4" name="garmentType[]" value="Kurti"> 
							    <label class="form-check-label custom-check" for="garmentCheck4"> Kurti
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
								<input type="checkbox" class="form-check-input" id="garmentCheck5" name="garmentType[]" value="Coat">
							    <label class="form-check-label custom-check" for="garmentCheck5"> Coat
							    
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
								<input type="checkbox" class="form-check-input" id="garmentCheck6" name="garmentType[]" value="Blouse">
							    <label class="form-check-label custom-check" for="garmentCheck6"> Blouse
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
							    <input type="checkbox" class="form-check-input" id="garmentCheck7" name="garmentType[]" value="Saree (Normal)">
							    <label class="form-check-label custom-check" for="garmentCheck7"> Saree (Normal)
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
								<input type="checkbox" class="form-check-input" id="garmentCheck8" name="garmentType[]" value="Saree (Heavy)">
							    <label class="form-check-label custom-check" for="garmentCheck8"> Saree (Heavy)
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
							    <input type="checkbox" class="form-check-input" id="garmentCheck9" name="garmentType[]" value="Parda (Normal)">
							    <label class="form-check-label custom-check" for="garmentCheck9"> Parda (Normal)
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
							    <input type="checkbox" class="form-check-input" id="garmentCheck10" name="garmentType[]" value="Parda (Heavy)">
							    <label class="form-check-label custom-check" for="garmentCheck10"> Parda (Heavy)
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
							    <input type="checkbox" class="form-check-input" id="garmentCheck11" name="garmentType[]" value="Sofaset Cover">
							    <label class="form-check-label custom-check" for="garmentCheck11"> Sofaset Cover
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
							    <input type="checkbox" class="form-check-input" id="garmentCheck12" name="garmentType[]" value="Bedsheet">
							    <label class="form-check-label custom-check" for="garmentCheck12"> Bed Sheet
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
							    <input type="checkbox" class="form-check-input" id="garmentCheck13" name="garmentType[]" value="Pillow Cover">
							    <label class="form-check-label custom-check" for="garmentCheck13"> Pillow Cover
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
							    <input type="checkbox" class="form-check-input" id="garmentCheck14" name="garmentType[]" value="Blanket (Small)">
							    <label class="form-check-label custom-check" for="garmentCheck14"> Blanket (Small)
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
							    <input type="checkbox" class="form-check-input" id="garmentCheck15" name="garmentType[]" value="Blanket (Medium)">
							    <label class="form-check-label custom-check" for="garmentCheck15"> Blanket (Medium)
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
							    <input type="checkbox" class="form-check-input" id="garmentCheck16" name="garmentType[]" value="Blanket (Heavy)">
							    <label class="form-check-label custom-check" for="garmentCheck16"> Blanket (Heavy)
							    </label>
							</div>
							<div class="form-check-inline col-sm-3 col-4">
							    <input type="checkbox" class="form-check-input" id="garmentCheck17" name="garmentType[]" value="Towel">
							    <label class="form-check-label custom-check" for="garmentCheck17"> Towel
							    </label>
							</div>
						</div>
			            <span class="error">
			            	<?php 
        		            	if (isset($_GET) && !empty($_GET)) {
        		            		echo $_GET['garmentType'];
        		            	}
        	             	?>	
        	            </span>
					</div>
					<div class="form-group">
				      	<label for="inputService">Choose Service *</label>
				      	<select class="form-control" id="inputService" name="serviceType">
				      		<option>Choose service</option>
				        	<option value="wash and fold">Wash and Fold</option>
				        	<option value="wash and iron">Wash and Iron</option>
				      </select>
			            <span class="error">
			            	<?php 
      		            	if (isset($_GET) && !empty($_GET)) {
      		            		echo $_GET['serviceType'];
      		            	}
      	             	?>	
      	           		</span>
					</div>
					<div class="form-group">
						<label for="inputDescription">Description</label>
						<textarea class="form-control" name="description" id="inputDescription" rows="5" placeholder="Please provide any other details (optional)."></textarea>
					</div>
					<button class="btn btn-primary mt-3 btn-place-order" type="submit">Place Order</button>
				</form>
			</div>
		</div>
	</div>
</section>

<section id="pricing">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h2>PRICE LIST</h2>
			</div>
			<div class="col-12">
				<div class="row">
					<?php
						require_once('admin/database-config.php');
						$sql = "SELECT * FROM price_list WHERE status='Active' ORDER BY item ";
						if($result = $mysqli->query($sql)){
							if($result -> num_rows > 0){
								while($row = $result-> fetch_array() ){
									echo "<div class='col-lg-3 col-md-4 col-6 pb-4'>
										<div class='card text-center'>
											<div class='card-header'>
												<p class='card-text'><strong>".$row['item']."</strong></p> 
											</div>
									    <div class='card-body'>";
									    	echo "<img src=". "admin/".$row['image']. " alt='Card image' style='width:80%; border-radius:50%; border: 1px solid black'>";
									    echo "</div>
									    <div class='card-footer'>
									      <p class='card-text'>".$row['price']."</p>
									    </div>
									</div>
								</div>";
								}
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
</section>


<section id="contact_us">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h2>CONTACT US</h2>
			</div>
			<div class="col-md-6 col-sm-12 pb-sm-5">
				<ul class="list-unstyled">
					<li>
						<p><i class="fa fa-phone "></i><span class=""> Phone: 9810402010</span></p>
					</li>
					<li>
						<p><i class="fa fa-envelope"></i><span class=""> Email: info@merowash.com.np</span></p>
					</li>
					<li>
						<p><i class="fa fa-map-marker"></i><span class=""> Address: Mainroad, Biratnagar</span></p>
					</li>
				</ul>
				<div class="social-link">
					<h3>Follow us on:</h3>
					<div class="link mt-2 mx-auto">
						<a href="#"><i class="fa fa-facebook-square"></i></a>
						<a href="#"><i class="fa fa-twitter-square"></i></a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1147.7860542642477!2d87.27936357323334!3d26.457833910032278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ef744704331cc5%3A0x6d9a85e45c54b3fc!2sBiratnagar+56613!5e0!3m2!1sen!2snp!4v1538037035648" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="up_arrow">
		<a href="#top_bar"><img src="img/up-arrow.png" alt=""></a>
</section>

<?php include_once('footer.php') ?>