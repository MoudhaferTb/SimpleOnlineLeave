<?php 
	include('inc/head.php'); 
	session_start();
	if (!isset($_SESSION['email'])) {
		header('location:index.php');
		exit(); // Stop further execution
	}

	// Include the configuration file
	include('inc/config.php');

	// Check if the form is submitted
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Extract the form data
		$name = $_POST['name'];
		$department = $_POST['department'];
		$email = $_POST['email'];
		$salary = $_POST['salary'];

		// Insert the data into the database
		$sql = "INSERT INTO employees (name, department, email, salary) VALUES ('$name', '$department', '$email', '$salary')";
		if (mysqli_query($con, $sql)) {
			echo "<script>alert('Employee added successfully');</script>";
		} else {
			echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
		}
	}
?>

<body>
	<nav class="navbar navbar-toggleable-sm navbar-inverse bg-inverse p-0">
		<div class="container">
			<button class="navbar-toggler toggler-right" data-target="#mynavbar" data-toggle="collapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a href="#" class="navbar-brand mr-3">Leave Management</a>
			<div class="collapse navbar-collapse" id="mynavbar">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown mr-3">
						
						<li class="nav-item">
							<a href="logout.php" class="nav-link"><i class="fa fa-power-off"></i> Logout</a>
						</li>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!--This Is Header-->
	<header id="main-header" class="bg-danger py-2 text-white">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h1><i class="fa fa-user-secret"></i> Admin Panel</h1>
				</div>
			</div>
		</div>
	</header>
	<!--This is section-->
	<section id="sections" class="py-4 mb-4 bg-faded">
		<div class="container">
			<div class="row">
				<div class="col-md"></div>
				<div class="col-md-2">
					<div class="col-md-2">
					<a href="#" class="btn btn-danger btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addEmpModal"><i class="fa fa-users"></i> Add Employees</a>
				</div>
				</div>
				<div class="col-md-2">
					<a href="#" class="btn btn-info btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#viewEmpModal"><i class="fa fa-eye"></i> View Employees</a>
				</div>
				<div class="col-md"></div>
			</div>
		</div>
	</section>
	
	<!-- Section for Salary Management -->
	<section id="salary">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Employee Salary Management</h2>
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Email</th>
								<th>Salary</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								// Fetch employees data from the database
								$sql = "SELECT * FROM employees";
								$result = mysqli_query($con, $sql);

								if (mysqli_num_rows($result) > 0) {
									$counter = 1;
									while ($row = mysqli_fetch_assoc($result)) {
										echo "<tr>";
										echo "<td>" . $counter . "</td>";
										echo "<td>" . $row['name'] . "</td>";
										echo "<td>" . $row['department'] . "</td>";
										echo "<td>" . $row['email'] . "</td>";
										echo "<td>" . $row['salary'] . "</td>";
										echo "<td>
												<a href='edit_salary.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>
												<a href='delete_salary.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a>
											</td>";
										echo "</tr>";
										$counter++;
									}
								} else {
									echo "<tr><td colspan='6'>No records found.</td></tr>";
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>

	<!-- Add Employee Modal -->
	<div id="addEmpModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<div class="modal-header bg-danger text-white">
						<h5 class="modal-title">Add Employee</h5>
						<button type="button" class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Department</label>
							<input type="text" name="department" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Salary</label>
							<input type="text" name="salary" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php 

