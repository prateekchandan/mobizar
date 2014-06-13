    // function to upload a course
	$("#courseupload-form").submit(function(e){
            e.preventDefault();
            var formData = new FormData($('#courseupload-form')[0]);
            var str= $('#courseupload-form').serialize();
            jQuery.ajax({
                url: 'php/course-upload.php?'+str,  //Server script to process data
                type: 'POST',
                success: function(data){
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
	// function to delete a course
	function deletecourse(id){
		var a=confirm("Are you sure want to delete this course?");
		if(!a)
			return;
		jQuery.ajax({
			url:'php/delete-course.php',
			type:'post',
			data:{id:id},
			success:function(data){
				console.log(data);
				if(data=="done"){
					location.reload();
				}
			},
			error:function(){
				alert('Network error');
			}
		})
	}
	// function to edit a course
	function editcourse(id){
		jQuery.ajax({
			url:'php/get-course-details.php',
			type:'post',
			data:{id:id},
			success:function(data){
				data=JSON.parse(data);
				$("#course-name").val(data['coursename']);
				$("#courseid").val(data['courseid']);
				$("#hour").val(Math.floor(parseInt(data['courseduration'])/60));
				$("#minute").val(Math.floor(parseInt(data['courseduration'])%60));
				$('#editcourse').modal('show');
			},
			error:function(){
				alert('Network error');
			}
		})
	}
	$("#courseedit-form").submit(function(e){
            e.preventDefault();
            var formData = new FormData($('#courseedit-form')[0]);
            var str= $('#courseedit-form').serialize();
            jQuery.ajax({
                url: 'php/course-edit.php?'+str,  //Server script to process data
                type: 'POST',
                success: function(data){
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
    // Function to check if a user is present
    $("#addusercheck-form").submit(function(e) {
        e.preventDefault();
        jQuery.ajax({
            url:'php/user/checkuser.php',
            type:'post',
            data:$(this).serialize(),
            success:function(data){
                if(data=="done"){
                    location.reload();
                }
                else if(data=="alreadypresent"){
                    $("#addusercheck-form")[0].reset();
                    $("#user-message").html("User already present");
                }
                else if(data=="notfound"){
                    $("#addusercheck-form").css("display","none");
                    $("#adduser-form").css("display","block");
                    $("#add-user-message").html("User not found , Please register");
                }
            },
            error:function(){
                alert("Network error");
            }
        })
    })
    // Function to add a user
    $("#adduser-form").submit(function(e){
        e.preventDefault();
        jQuery.ajax({
            url:'php/user/register.php',
            type:'post',
            data:$(this).serialize(),
            success:function(data){
                console.log(data);
                if(data=="done"){
                    location.reload();
                }
                else if(data=="alreadypresent"){
                    $("#addusercheck-form")[0].reset();
                    $("#add-user-message").html("This email already exists. Added this user to your account");
                }
            },
            error:function(){
                alert("Network error");
            }
        })
    })
    //function to remove a user
    function removeuser(id){
        jQuery.ajax({
            url:'php/user/remove-user.php',
            type:'post',
            data:{id:id},
            success:function(data){
                console.log(data);
                if(data=="done"){
                    location.reload();
                }
            },
            error:function(){
                alert("Network error");
            }
        })
    }
        // Function to add a new-group
        $("#add-new-group").submit(function(e) {
        e.preventDefault();
        jQuery.ajax({
            url:'php/group/add-group.php',
            type:'post',
            data:$(this).serialize(),
            success:function(data){
                if(data=="done"){
                    location.reload();
                }
                else{
                    alert('some problem occured');
                    console.log(data);
                }
            }
        })
    })
    
   
    // Sunction to add user to a group
    function addusergroup(user,group){
        $('.waiting').css('display','block');
        jQuery.ajax({
            url:'php/user/addusertogroup.php',
            data:{group:group,id:user},
            type:'post',
            success:function(data){
                $('.waiting').css('display','none');
                $('#popover'+user).attr('data-content',data);
            },
            error:function(){
                $('.waiting').css('display','none');
                alert('Network error');
            }
        })

    }

    // Function to show all students in group
    function show_users(id){
        jQuery.ajax({
            url:'php/group/getalluser.php',
            type:'post',
            data:{id:id},
            success:function(data){
                $("#showgroupuser").modal('show');
                $("#showgroupuser-body").html(data);
            },
            error:function(){
                alert("Network error. Failed to fetch data");
            }
        });
    }
    // Function to delete a group
    function deletegroup(id){
        jQuery.ajax({
            url:'php/group/deletegroup.php',
            type:'post',
            data:{id:id},
            success:function(data){
                if(data=="done")
                    location.reload();
                else
                    console.log(data);
            },
            error:function(){
                alert('Error in netowrk connection');
            }
        })
    }

    // Function to upload bulk user
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


// PAgination in tables
$(document).ready(function() {
        $('.dataTable').dataTable( {
                "bSort": true,       // Disable sorting
            "iDisplayLength": 20,   //records per page
            "sDom": "t<'row'<'col-md-6'i><'col-md-6'p>>",
            "sPaginationType": "bootstrap"
             } );
        } );
// Function to open modal of schedule
function schedule (id) {
        jQuery.ajax({
            url:'php/course/get-course-shedule.php',
            type:'post',
            data:{id:id},
            success:function(data){
                console.log(data);
                try{
                    data=JSON.parse(data);
                }
                catch(e){
                    alert("error loading schedule for this course");
                }
                $("#schedule-form")[0].reset();
                $("#schcousename").html(data['name']);
                $("#schedule-courseid").val(data['courseid']);
                if(data['error']==1){
                    var a=$('input.schgroup');
                    for (var i = 0; i < a.length; i++) {
                        a[i].removeAttribute('checked');
                    };
                    $('#schedulecourse').modal('show');
                }
                else{
                    $("#course-date").val(data['date']);
                    $("#course-time").val(data['time']);
                    var a=$('input.schgroup');
                    var groups=JSON.parse(data['groups']);
                    for (var i = 0; i < a.length; i++) {
                        if(groups.indexOf(a[i].name)==-1)
                            a[i].removeAttribute('checked');
                        else{
                            var att=document.createAttribute('checked');
                            att.value="'checked'";
                            a[i].setAttributeNode(att);
                        }
                    };
                
                    $('#schedulecourse').modal('show');
                }
            },
            error:function(){
                alert('Network error');
            }
        })
    }
// Function to schedule an event
    $("#schedule-form").submit(function(e){
        e.preventDefault();
        jQuery.ajax({
            url:'php/course/schedulecourse.php',
            type:'post',
            data:$(this).serialize(),
            success:function(data){
                if(data=="done"){
                    $('#schedulecourse').modal('hide');
                }
            },
            error:function(){
                alert("Error in Network connection");
            }
        })
    })

