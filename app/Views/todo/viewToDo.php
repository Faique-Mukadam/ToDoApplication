<!DOCTYPE html>
<html>
<head>
	<title>TO-Do Application!</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
	<script src="<?php echo base_url('assets/js/jquery-2.2.3.min.js'); ?>"></script>

	

	<div class="container-fluid bg-purple">
		<div class="container pb-2 pt-2">
			<div class="text-white h4">To-Do Application! 
				<!-- <h4 class="text-white float-right">Welcome UserName</h3> -->
			</div>		
		</div>

		<div class="bg-white shadow-sm">
			<div class="container">
				<div class="row">
					<nav class="nav nav-underline">
						<div class="nav-link">To-Do / View</div>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<div class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				<div class="row">	
					<div class="col-md-8">
						<input type="text" name="task" id="id_task" placeholder="Enter a task" class="form-control">
					</div>
					<div class="col-md-4">
						<button type="button" id="id_toDo_btn" class="btn btn-primary">ADD TASK</button>
					</div>				
				</div>
			</div>
		</div>
	</div>

	<div class="container mt-4">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-purple text-white">
						<div class="card-header-title">View List</div>					
					</div>
						<div class="card-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<!-- <td>ID</td> -->
										<td>Sr.No</td>
										<td>Task</td>
										<td>Action</td>
									</tr>									
								</thead>
								<tbody id="id_userData">
									
								</tbody>
							</table>
						</div>
				</div>				
			</div>
		</div>
	</div>
	
</body>
</html>

<script>

	$(document).ready(function(){

		function add_toDo(){

			$("#id_toDo_btn").on('click',function(){

				var taskName;
				taskName = $("#id_task").val();
				if ($.trim(taskName).length == 0) {
					alert("Task should not be empty..!");
					$("#id_task").focus();
					return false;
				}
				else{
					$.ajax({
						method: "POST",
						url: "/ToDoController/addTask",
						data: {taskName : taskName},
						success: function (response){
							$("#id_task").val('');
							var response = JSON.parse(response);
							$("#id_userData").html('');
							view_toDo();
							// alert(response.message); 
						}
					});
				}
			});

		}

		function view_toDo(){
			$.ajax({
				method: "GET",
				url: "/ToDoController/getToDo",
				success: function (response){

					
					var i = 1;
					if (response.toDoData.length !=0) {	
						$.each(response.toDoData, function(key, value){
							// console.log(value['user_name']);
							$("#id_userData").append('<tr>\
								<td class="toDo_id" style="display:none;">'+value['id']+'</td>\
								<td>'+i+'</td>\
								<td>'+value['task']+'</td>\
								\
								<td><a href="#" class="btn btn-danger btn-sm delete_btn">Delete</a></td>\
								</tr>');
							i++;
						});					
					}
					else{				
						$("#id_userData").append('<tr>\
						<td colspan="3" class="text-center"><b>No task found</b></td>\
						</tr>');
					}
				}
			});
		}

		$(document).on('click','.delete_btn',function(){
			
			var toDoId = $(this).closest('tr').find('.toDo_id').text();
			// alert(toDoId);
			if(confirm("Are you sure you want to delete the task?")){

				$.ajax({
					method: "POST",
					url: "/ToDoController/deleteTask",
					data: {toDoId : toDoId},
					success: function (response){
						var response = JSON.parse(response);
						// alert(response.message);
						$("#id_userData").html('');
						view_toDo();
					}
				});
				// window.location.href = '<?php echo base_url('books/delete')?>'+"/"+id;
			}

		});
		add_toDo();
		view_toDo();
	});




	/*function deleteConfirm(id){
		// alert(id);
		if(confirm("Are you sure you want to delete?")){
			window.location.href = '<?php echo base_url('books/delete')?>'+"/"+id;
		}
	}*/
	
</script>