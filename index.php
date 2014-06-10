<?php
	session_start();
	if(isset($_SESSION['user-email']))
	{
		header('location:home.php');
	}
	
?>
<?php
include "header.php";
?>
	 
	<!-- *****************************************************************************************************************
	 CONTACT FORMS
	 ***************************************************************************************************************** -->

	 <div class="container mtb">
	 	<div class="row">
	 		<div class="col-lg-8 col-lg-offset-2" id="login-box">
	 			<h3>Login to Continue!</h3>
	 			<div class="hline"></div>
		 			<p>Mobizar is a mobile based reinforcement platform which helps in refreshing the key takeaways of the training. It delivers courselets(short duration courses) to your learners' mobile devices on a shedule.</p>
		 			<br>
		 			<div class="well">
			 			<form role="form" id="login-form">
						  <div class="form-group">
						    <label for="email">Your Email</label>
						    <input type="email" class="form-control"  name="email" required>
						  </div>
						  <div class="form-group">
						    <label for="password">Password</label>
						    <input type="password" class="form-control" name="password" required>
						  </div>
						  <label><a href="#" onclick="show('forget-box'); return false;">Forget Password</a></label><br>
						  <button type="submit" class="btn btn-theme">Login</button>
						  <button type="button" class="btn btn-theme" onclick="show('register-box')">Register</button>
						</form>
					</div>
			</div><!--/col-lg-8  LOGIN FORM-->

			<div class="col-lg-8 col-lg-offset-2" id="register-box" style="display:none">
	 			<h3>Register</h3>
	 			<div class="hline"></div>
		 			<p>Please fill in all details. All fields are compulsory unless mentioned </p>
		 			<br>
		 			<div class="well">
			 			<form role="form" id="register-form">
						  <div class="form-group row">
						    <label for="email" class="col-md-4">Your Email</label>
						    <div class="col-md-8"><input type="email" class="form-control"  name="email" required placeholder="Email"></div>
						  </div>
						  <div class="form-group row">
						    <label for="firstname" class="col-md-4">Your First Name</label>
						    <div class="col-md-8"><input type="text" class="form-control" name="firstname" required></div>
						  </div>
						  <div class="form-group row">
						    <label for="lastname" class="col-md-4">Your Last Name (Optional)</label>
						    <div class="col-md-8"><input type="text" class="form-control" name="lastname"></div>
						  </div>
						  <div class="form-group row">
						    <label for="password" class="col-md-4">Password</label>
						    <div class="col-md-8"><input type="password" class="form-control" id="pass" name="password" required></div>
						  </div>
						  <div class="form-group row">
						    <label for="lastname" class="col-md-4">Retype Password</label>
						    <div class="col-md-8"><input type="password" class="form-control" id="repass" name="repass" required></div>
						  </div>
						  <div class="form-group row">
						    <label for="organization" class="col-md-4">Organization</label>
						    <div class="col-md-8"><input type="text" class="form-control" id="organization" name="organization" required></div>
						  </div>
						  <div class="form-group row">
						    <label for="destination" class="col-md-4">Designation</label>
						    <div class="col-md-8"><input type="text" class="form-control" id="designation" name="designation" required></div>
						  </div>
						  <div class="form-group row">
						    <label for="phone" class="col-md-4">Phone</label>
						    <div class="col-md-8"><input type="number" class="form-control" id="phone" name="phone" required></div>
						  </div>
						  <button type="submit" class="btn btn-theme">Register</button>
						  <button type="button" class="btn btn-theme" onclick="show('login-box')">Login</button>
						</form>
											
					</div>
			</div><!--/col-lg-8 REGISTER -->

			<div class="col-lg-8 col-lg-offset-2" id="forget-box" style="display:none">
	 			<h3>Forget Password</h3>
	 			<div class="hline"></div>
		 			<p>Please type your email id</p>
		 			<br>
		 			<div class="well">
			 			<form role="form" id="forget-form">
						  <div class="form-group">
						    <label for="email">Your Email</label>
						    <input type="email" class="form-control" name="email" required>
						  </div>
						  <button type="submit" class="btn btn-theme">Send Password</button>
						  <button type="button" class="btn btn-theme" onclick="show('login-box')">Login</button>
						</form>
					</div>
			</div><!--/col-lg-8 FORGET-->

			<div class="col-lg-8 col-lg-offset-2" id="message">
			</div>
	 	</div><!--/row -->
	 </div><!--/container -->


<?php include "footer.php"; ?>

<script type="text/javascript">
	function show (id) {
		var all=['login-box','register-box','forget-box'];
		for (var i = all.length - 1; i >= 0; i--) {
			if(id==all[i])
			{
				$("#"+all[i]).css('display','block');
			}
			else
				$("#"+all[i]).css('display','none');
		};
	}

	$("#login-form").submit(function(e) {
		e.preventDefault();
		jQuery.ajax({
			url:"./php/login.php",
			type:"POST",
			data:$(this).serialize(),
			success:function(data){
				$("#login-form div:nth-child(1)").removeClass('has-error');
				$("#login-form div:nth-child(2)").removeClass('has-error');
		
				if(data=='emailerr'){
					$("#message").html("User Not found Please register");
						$("#login-form div:nth-child(1)").addClass('has-error');
				}
				else if(data=='passerr'){
					$("#message").html("Password didn't matched. ");
					$("#login-form div:nth-child(2)").addClass('has-error');
				}
				else if(data=='done'){
					$("#message").html("Logged in successfully");
					$("#login-form")[0].reset();
					location.reload();
				}

			},
			error:function(){
				alert("Network Error");
			}
		})
	});
	$("#register-form").submit(function(e) {
		e.preventDefault();
		jQuery.ajax({
			url:"./php/register.php",
			type:"POST",
			data:$(this).serialize(),
			success:function(data){
				$("#register-form div:nth-child(1)").removeClass('has-error');
				$("#register-form div:nth-child(2)").removeClass('has-error');
				$("#register-form div:nth-child(3)").removeClass('has-error');
				$("#register-form div:nth-child(4)").removeClass('has-error');
				if(data=='emailerr'){
					$("#message").html("User already present");
						$("#register-form div:nth-child(1)").addClass('has-error');
				}
				else if(data=='passnotmatch'){
					$("#message").html("Password didn't matched");
					$("#register-form div:nth-child(4)").addClass('has-error');
					$("#register-form div:nth-child(5)").addClass('has-error');
				}
				else if(data=='passworderr'){
					$("#message").html("Password should be of atleast 8 characters");
					$("#register-form div:nth-child(4)").addClass('has-error');
					$("#register-form div:nth-child(5)").addClass('has-error');
				}
				else if(data=='done'){
					$("#register-form")[0].reset();
					$("#message").html("You have been successfully registered.. Please login to continue");
					show('login-box');

				}
			},
			error:function(){
				alert("Network Error");
			}
		})
	});
	$("#forget-form").submit(function(e) {
		e.preventDefault();
		jQuery.ajax({
			url:"./php/forget.php",
			type:"POST",
			data:$(this).serialize(),
			success:function(data){
				if(data=='emailerr')
					$("#message").html("Email not found in database");
				else if(data=='done'){
					$("#forget-form")[0].reset();
					$("#message").html("Your password has been sent to your email id");
					show('login-box');
				}
				console.log(data);

			},
			error:function(){
				alert("Network Error");
			}
		})
	});

</script>
  </body>
</html>
