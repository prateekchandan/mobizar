<?php
	include "php/dbconnect.php";
	session_start();
	if(!isset($_SESSION['user-email']))
	{
		header('location:./');
	}
	$q=mysqli_query($con,"select * from users where email = '".$_SESSION['user-email']."'");
    $user=mysqli_fetch_assoc($q);
    if($user['usertype']!='Instructor'){
<<<<<<< HEAD
    	die("Only admin login allowed");
=======
    	die("error");
>>>>>>> 31dec0e9c894060abd04c67aae11a0579dfa82b9
    }

    $q=mysqli_query($con,'select * from `group` where createdby="'.$user['userid'].'"');
    $allgroup=array();
    while($row=mysqli_fetch_assoc($q)){
    	$allgroup[$row['groupid']]=$row;
    }
    
?>
<?php
include "header.php";
?>
<link rel="stylesheet" type="text/css" href="assets/css/calender.css">
<style type="text/css">
	html,body{

	}
	.tab-pane{
		padding-top: 5px;
	}
	.waiting{
		position: fixed;
		width: 100%;
		height: 100%;
		text-align: center;
		vertical-align: middle;
		z-index: 10;
<<<<<<< HEAD
		background:rgba(0,0,0,0.1);
	}
</style>
	<div class="waiting" style="display:none">
	
=======
		background: red;
	}
</style>
	<div class="waiting" style="display:none">
	ljkj
>>>>>>> 31dec0e9c894060abd04c67aae11a0579dfa82b9
	</div>
	<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>Home</h3>
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /blue -->

	<div class="container mtb">
	 	<div class="row">
		    <ul class="nav nav-tabs">
		      <li class="active"><a href="#courses" data-toggle="tab">Courses</a></li>
		      <li><a href="#users" data-toggle="tab">Users</a></li>
		      <li><a href="#group" data-toggle="tab">Group</a></li>
		      <li><a href="#schedule" data-toggle="tab">Schedule</a></li>
		      <li><a href="#status" data-toggle="tab">Status</a></li>
		    </ul>
		    <div id="myTabContent" class="tab-content">
		    	<div class="tab-pane fade in active" id="courses">
			        <?php
			        	$q=mysqli_query($con,'select * from courses where createdby="'.$user['userid'].'"');
			        	if(mysqli_num_rows($q)==0)
			        		echo'
			        	<blockquote>This place seems to be lonely. Start with adding new courses</blockquote>
			        		';
			        	else
			        		{
			        			echo '<table class="table table-striped"><thead>
			        				<th>
			        					Serial no
			        				</th>
			        				<th>
			        					Course Name
			        				</th>
			        				<th>
			        					Type of file
			        				</th>
			        				<th>
			        					Duration
			        				</th>
			        				<th>
			        					Action
			        				</th>
			        			</thead>';
			        			$i=0;
			        		
			        			while($row=mysqli_fetch_assoc($q))
			        			{
			        				$i++;
			        				echo '<tr>';
			        				echo '<td>'.$i.'</td>';
			        				echo '<td>'.$row['coursename'].'</td>';
			        				echo '<td>'.$row['filetype'].'</td>';
			        				echo '<td>'.(($row['courseduration']-$row['courseduration']%60)/60).' hours ,'.($row['courseduration']%60).' minutes'.'</td>';
			        				echo '<td><button class="btn btn-danger" title="Delete this course" onclick="deletecourse('.$row['courseid'].')"><span class="glyphicon glyphicon-trash"></span></button>
			        					<button class="btn btn-info" title="Edit this course" onclick="editcourse('.$row['courseid'].')"><i class="fa fa-edit fa-lg"></i>
			        					</button>
			        					<a class="btn btn-success" title="View / Download this file" target=_blank href="'.$row['filepath'].'"><i class="fa fa-folder-open fa-lg"></i></a>
			        					</td>';
			        				echo '</tr>';
			        			}
			        			echo '</table>';
			        		}
			        ?>
		       		<button class="btn btn-theme" data-toggle="modal" data-target="#addcourse"><i class="fa fa-plus"></i> Add new course</button>
		      	</div>

		      	<div class="tab-pane fade" id="users">
			        <?php
			        	$useradded=json_decode($user['studentlist'],true);
			        	if(sizeof($useradded)==0){
			        		echo '<blockquote>No user is added in your account. Start with adding users</blockquote>';
			        	}
			        	else{
			        		$q=mysqli_query($con,"select * from users");
			        		$i=0;
			        		echo '<table class="table table-striped"><thead>
			        				<th>
			        					Serial no
			        				</th>
			        				<th>
			        					Name
			        				</th>
			        				<th>
			        					Email
			        				</th>
			        				<th>
			        					Phone
			        				</th>
			        				<th>
			        					Action
			        				</th>
			        			</thead>';
			        		while($row=mysqli_fetch_assoc($q)){
			        			if(in_array($row['userid'], $useradded)){
			        				$i++;
			        				echo '<tr>';
			        				echo '<td>'.$i.'</td>';
			        				echo '<td>'.$row['firstname'].' '.$row['lastname'].'</td>';
			        				echo '<td>'.$row['email'].'</td>';
			        				echo '<td>'.$row['phone'].'</td>';
			        				echo '<td><button class="btn btn-danger"  title="Remove this user" onclick="removeuser('.$row['userid'].')"><span class="glyphicon glyphicon-trash"></span></button> ';
			        				echo '<button class="btn btn-info" data-toggle="popover" title="" data-content="<table id=\'pop-table'.$row['userid'].'\'>';
			        				$grouppresent=json_decode($row['grouplist'],true);
			        				foreach ($allgroup as $key => $value) {
			        					echo '<tr>';
			        					echo '<td>'.$value['groupname'].'</td>';
			        					echo ' <td><input id=\'groupcheck'.$row['userid'].$value['groupid'].'\'
			        					 type=checkbox onchange=\'addusergroup('.$row['userid'].','.$value['groupid'].')\' ';
			        					if(in_array($value['groupid'],$grouppresent))
			        						echo 'checked';
			        					echo '></td>';
			        				}
			        				echo '</table>" role="button" id="popover'.$row['userid'].'" onmouseover="$(this).popover({html:true,content : function() {
									        return $(\'#pop-content'.$row['userid'].'\').html();
									    }}); return false;">Add to group</button>';
			        				echo '</td>';
			        				echo '</tr>';
			        			}
			        		}
			        		echo '</table>';
			        	}

			        ?>
			        <button class="btn btn-theme" data-toggle="modal" data-target="#adduser"><i class="fa fa-plus"></i> Add new user</button>
			        <button class="btn btn-theme" data-toggle="modal" data-target="#bulkuser"><i class="fa fa-cloud-upload"></i> Upload user in bulk</button>
		      	</div>

		      	<div class="tab-pane fade" id="group">
		      		<?php
						$q=mysqli_query($con,"select * from `group` where `createdby`='".$user['userid']."'");
						$i=0;
						echo '<table class="table table-striped"><thead>
								<th>
									Serial no
								</th>
								<th>
									Group Name
								</th>
								<th>
									Action
								</th>
							</thead>';
						while($row=mysqli_fetch_assoc($q)){
								$i++;
								echo '<tr>';
								echo '<td>'.$i.'</td>';
								echo '<td>'.$row['groupname'].'</td>';
								echo '<td>
								 <button class="btn btn-danger" onclick="deletegroup('.$row['groupid'].')" title="Delete this group">
			                    <span class="glyphicon glyphicon-trash"></span>
			                    </button>
								<button class="btn btn-info" onclick="show_users(\''.$row['groupid'].'\')"><i class="fa fa-users fa-lg"></i> See All users</button></td>';
								echo '</tr>';
						}
						echo '<tr><td></td><form id="add-new-group"><td><input placeholder="Type the new group name" class="form-control" name="groupname" required></td><td><button class="btn btn-success">Add this group</button></td></form></tr>';
						echo '</table>';	
					?>	        
		      	</div>

		      	<div class="tab-pane fade" id="schedule">
			      	<div class="col-md-3">
			      		fef
			      	</div>
			      	<div class="col-md-9">
			      		<div class="page-header">

							<div class="pull-right form-inline">
								<div class="btn-group">
									<button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
									<button class="btn" data-calendar-nav="today">Today</button>
									<button class="btn btn-primary" data-calendar-nav="next">Next >></button>
								</div>
								<div class="btn-group">
									<button class="btn btn-warning" data-calendar-view="year">Year</button>
									<button class="btn btn-warning active" data-calendar-view="month">Month</button>
									<button class="btn btn-warning" data-calendar-view="week">Week</button>
									<button class="btn btn-warning" data-calendar-view="day">Day</button>
								</div>
							</div>

							<h3></h3>
							
						</div>

			        	<div id="calendar"></div>
			        </div>
		      	</div>

		      	<div class="tab-pane fade" id="status">
		        	
		      	</div>
		      
		    </div>	
	 	</div><! --/row -->
	 </div><! --/container -->


<?php include "footer.php"; ?>


<?php // MODALS  ?>
<!-- MODAL TO ADD NEW COURSE -->
<div class="modal fade" id="addcourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title ctitle" id="myModalLabel" style="margin-bottom:0px">Add new course</h3>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" id="courseupload-form">
        	<div class="form-group row">
        		<label for="" class="col-md-4">Enter course Name</label>
        		<div class="col-md-8">
        			<input class="form-control"  name="course-name" placeholder="course name" required>
        		</div>
        	</div>
        	<div class="form-group row">
        		<label for="" class="col-md-4">Course duration</label>
        		<div class="col-md-2">
        			<input type="number" min="0"  class="form-control"  name="hour" placeholder="0" value="0" required>
        		</div>
        		<label class="col-md-2">hours,</label>
        		<div class="col-md-2">
        			<input type="number" min="0"  class="form-control" name="minute" placeholder="0" value="0" required>
        		</div>
        		<label class="col-md-2">minutes</label>
        	</div>
        	<div class="form-group row">
        		<label for="" class="col-md-4">Upload file</label>
        		<div class="col-md-8">
        			<input class="form-control" name="file" placeholder="" type="file" required>
        		</div>
        	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Add the course</button>
	      </div>
	    </form>
    </div>
  </div>
</div>
<!-- MODAL TO EDIT COURSE -->
<div class="modal fade" id="editcourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title ctitle" id="myModalLabel" style="margin-bottom:0px">Edit the course</h3>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" id="courseedit-form">
        	<div class="form-group row">
        		<label for="" class="col-md-4">Course Name</label>
        		<div class="col-md-8">
        			<input class="form-control"  id="course-name" name="course-name" placeholder="course name" required>
        		</div>
        	</div>
        	<div class="form-group row">
        		<label for="" class="col-md-4">Course duration</label>
        		<div class="col-md-2">
        			<input type="number" min="0"  class="form-control" id="hour"  name="hour" placeholder="0" value="0" required>
        		</div>
        		<label class="col-md-2">hours,</label>
        		<div class="col-md-2">
        			<input type="number" min="0"  class="form-control" id="minute" name="minute" placeholder="0" value="0" required>
        		</div>
        		<label class="col-md-2">minutes</label>
        	</div>
        	<div class="form-group row">
        		<label for="" class="col-md-4">Change file</label>
        		<div class="col-md-8">
        			<input class="form-control" name="file" placeholder="" type="file">
        		</div>
        	</div>
        	<input type="hidden" name="courseid" id="courseid">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Edit this course</button>
	      </div>
	    </form>
    </div>
  </div>
</div>
<!-- MODAL TO ADD USER -->
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title ctitle" id="myModalLabel" style="margin-bottom:0px">Add new user</h3>
      </div>
      <div class="modal-body">
        <form id="addusercheck-form">
        	<div class="form-group">
        		<label for="">Enter email or phone no of user to add</label>
        		<div>
        			<input class="form-control" name="check" placeholder="Email/phone" required>
				</div>
        	</div>
	        <button type="submit" class="btn btn-primary">Add</button>
	        <div id="user-message"></div>
	    </form>
		<form role="form" id="adduser-form" style="display:none">
			<div class="well" id="add-user-message">
			</div>
			<div class="form-group row">
			  <label for="email" class="col-md-4">Email</label>
			  <div class="col-md-8"><input type="email" class="form-control"  name="email" required placeholder="Email"></div>
			</div>
			<div class="form-group row">
			  <label for="firstname" class="col-md-4">First Name</label>
			  <div class="col-md-8"><input type="text" class="form-control" name="firstname" required></div>
			</div>
			<div class="form-group row">
			  <label for="lastname" class="col-md-4">Last Name (Optional)</label>
			  <div class="col-md-8"><input type="text" class="form-control" name="lastname"></div>
			</div>
			<div class="form-group row">
			  <label for="organization" class="col-md-4">Organization</label>
			  <div class="col-md-8"><input value="<?php  echo $user['organization'];?>" type="text" class="form-control" id="organization" name="organization" required></div>
			</div>
			<div class="form-group row">
			  <label for="destination" class="col-md-4">Designation</label>
			  <div class="col-md-8"><input type="text" class="form-control" id="designation" name="designation" required></div>
			</div>
			<div class="form-group row">
			  <label for="phone" class="col-md-4">Phone</label>
			  <div class="col-md-8"><input type="number" class="form-control" id="phone" name="phone" required></div>
			</div>
			<button type="submit" class="btn btn-primary">Register this user</button>
		</form>	
	   </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div>
    </div>
  </div>
</div>
<!-- MOdal to add user -->
<div class="modal fade" id="showgroupuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title ctitle" id="myModalLabel" style="margin-bottom:0px">All users from group</h3>
      </div>
      <div class="modal-body" id="showgroupuser-body">

	   </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div>
    </div>
  </div>
</div>

<div class="modal fade" id="bulkuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title ctitle" id="myModalLabel" style="margin-bottom:0px">Upload user in bulk</h3>
      </div>
      <div class="modal-body" style="overflow:auto">
	      <form enctype="multipart/form-data" id="bulkuserupload-form">
	      	<div class="form-group row">
        		<label for="" class="col-md-4">Upload excel file</label>
        		<div class="col-md-8">
        			<input class="form-control" name="file" placeholder="" type="file" accept=".xls"  required>
        		</div>
        		 <div><p>Note : Please upload only microsoft excel file which is .xls. You can download the <a href="./assets/sample.xls" target=_blank> sample excel file</a> to edit </p></div>
        	</div>
        	<button class="btn btn-theme">Upload</button>
	      </form>
	      <div class="" id="bulk-add-message">
	      </div>
	  </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="assets/js/mobizar.js"></script>
 <script type="text/javascript" src="assets/js/underscore-min.js"></script>
 <script type="text/javascript" src="assets/js/calender.js"></script>
<script type="text/javascript">
$('#bulkuserupload-form').submit(function(e){
	e.preventDefault();
	var formData = new FormData($('#bulkuserupload-form')[0]);
    jQuery.ajax({
	    url: 'php/user/bulk_user_upload.php?',  //Server script to process data
	    type: 'POST',
	    success: function(data){
	    	$("#bulk-add-message").html(data);
	        if(data=="done"){
	           location.reload();
	        }
	        else{
	           	console.log(data);
	        }
	    },
	    error: function(data){
	        alert("Network error");
	    },
	    data: formData,
	    cache: false,
	    contentType: false,
	    processData: false
	});

})


	var options = {
		events_source: 'php/getevents.php',
		view: 'month',
		tmpl_path: 'tmpls/',
		tmpl_cache: false,
		onAfterEventsLoad: function(events) {
			if(!events) {
				return;
			}
			var list = $('#eventlist');
			list.html('');

			$.each(events, function(key, val) {
				$(document.createElement('li'))
					.html('<a href="' + val.url + '">' + val.title + '</a>')
					.appendTo(list);
			});
		},
		onAfterViewLoad: function(view) {
			$('.page-header h3').text(this.getTitle());
			$('.btn-group button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};

	var calendar = $('#calendar').calendar(options);

	$('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});

	$('.btn-group button[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
		});
	});

	$('#first_day').change(function(){
		var value = $(this).val();
		value = value.length ? parseInt(value) : null;
		calendar.setOptions({first_day: value});
		calendar.view();
	});

 
</script>
  </body>
</html>
