<?php
	include "php/dbconnect.php";
	session_start();
	if(!isset($_SESSION['user-email']))
	{
		header('location:./');
	}
	$q=mysqli_query($con,"select * from users where email = '".$_SESSION['user-email']."'");
	if(mysqli_num_rows($q)==0){
		header("location:./");
	}
    $user=mysqli_fetch_assoc($q);
    if($user['usertype']=='Instructor'){
    	header('location:./home.php');
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
		background:rgba(0,0,0,0.1);
	}
</style>
	<div class="waiting" style="display:none">
	
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
	 	<?php  
	 		print_r($user);
	 	?>
	 	</div><! --/row -->
	 </div><! --/container -->


<?php include "footer.php"; ?>


<?php // MODALS  ?>
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

 <script type="text/javascript" src="assets/js/underscore-min.js"></script>
 <script type="text/javascript" src="assets/js/calender.js"></script>
 <script type="text/javascript" language="javascript" src="assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="assets/js/jquery-DT-pagination.js"></script>
<script type="text/javascript">


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
