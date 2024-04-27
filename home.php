<?php
include("header.php");
session_start();
include "./db/db_conn.php";
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>HOME</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	</head>


	<body>
		<div class="container">
			<div class="accordion" id="accordionExample">
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingOne">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							Accordion Item #1
						</button>
					</h2>
					<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
						<div class="accordion-body">
							<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingTwo">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							Accordion Item #2
						</button>
					</h2>
					<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
						<div class="accordion-body">
							<strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header" id="headingThree">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							Accordion Item #3
						</button>
					</h2>
					<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
						<div class="accordion-body">
							<strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
			<?php if ($_SESSION['role'] == 'admin') { ?>
				<!-- For Admin -->
				<div class="card" style="width: 18rem;">
					<img src="img/admin-default.png" class="card-img-top" alt="admin image">
					<div class="card-body text-center">
						<h5 class="card-title">
							<?= $_SESSION['name'] ?>
						</h5>
						<a href="logout.php" class="btn btn-dark">Logout</a>
					</div>
				</div>
				<div class="p-3">
					<?php include 'php/members.php';
					if (mysqli_num_rows($res) > 0) { ?>

						<h1 class="display-4 fs-1">Members</h1>
						<table class="table" style="width: 32rem;">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Name</th>
									<th scope="col">User name</th>
									<th scope="col">Role</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								while ($rows = mysqli_fetch_assoc($res)) { ?>
									<tr>
										<th scope="row"><?= $i ?></th>
										<td><?= $rows['name'] ?></td>
										<td><?= $rows['username'] ?></td>
										<td><?= $rows['role'] ?></td>
									</tr>
								<?php $i++;
								} ?>
							</tbody>
						</table>
					<?php } ?>
				</div>

			<?php } else { ?>
				<!-- FORE USERS -->
				<div class="card" style="width: 18rem;">
					<img src="img/user-default.png" class="card-img-top" alt="admin image">
					<div class="card-body text-center">
						<h5 class="card-title">
							<?= $_SESSION['name'] ?>
						</h5>
						<a href="logout.php" class="btn btn-dark">Logout</a>
					</div>
				</div>
			<?php } ?>
		</div>

	</body>

	</html>
<?php include("footer.php");
} else {
	header("Location: index.php");
} ?>