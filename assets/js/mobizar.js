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