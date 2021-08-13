<?php

	ob_start(); // Output Buffering Start

	session_start();

	if (isset($_SESSION['name'])) {

		$pageTitle = 'Dashboard';

		include 'init.php';

		/* Start Dashboard Page */

		$family=1; // Number Of Latest Users

		$المخدومين = getList("*", "المخدومين", "id", $family); // Latest Users Array

		$الخدام = getlist("*", 'الخدام', 'id', $family); // Latest Items Array



		?>

		<div class="home-stats">
			<div class="container text-center">
				<h1>Dashboard</h1>
				<div class="row">
					<div class="col-md-4">
						<div class="stat st-members">
							<i class="fa fa-users"></i>
							<div class="info">
								المخدومين
								<span>
									<a href="members.php"><?php echo countItems('id', 'المخدومين') ?></a>
								</span>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="stat st-pending">
							<i class="fa fa-user-plus"></i>
							<div class="info">
								المخدومين غير المفعلين
								<span>
									<a href="members.php?do=Manage&page=Pending">
										<?php echo checkItem("approve","المخدومين",0) ?>
									</a>
								</span>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="stat st-items">
							<i class="fa fa-user"></i>
							<div class="info">
								الخدام
								<span>
									<a href="items.php"><?php echo countItems('id', 'الخدام') ?></a>
								</span>
							</div>
						</div>
					<!-- </div>
					<div class="col-md-3">
						<div class="stat st-comments">
							<i class="fa fa-comments"></i>
							<div class="info">
								Total Comments
								<span>
									<a href="comments.php"><?php echo countItems('id', 'الخدام') ?></a>
								</span>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>

		<div class="latest">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-users"></i> 
								 المخدومين 
								<span class="toggle-info pull-right">
									<i class="fa fa-plus fa-lg"></i>
								</span>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled latest-users">
								<?php
									if (! empty($المخدومين)) {
										foreach ($المخدومين as $user) {
											if($user['approve']==1){
											echo '<li>';
												echo $user['name'];
												echo '<a href="members.php?do=Edit&userid=' . $user['name'] . '">';
													echo '<span class="btn btn-success pull-right">';
														echo '<i class="fa fa-edit"></i> Edit';
														
													echo '</span>';
												echo '</a>';
											echo '</li>';
										}
									}
									} else {
										echo 'There\'s No Members To Show';
									}
								?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-tag"></i> المخدومين غير مفعلين 
								<span class="toggle-info pull-right">
									<i class="fa fa-plus fa-lg"></i>
								</span>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled latest-users">
									<?php
										if (! empty($المخدومين)) {
											foreach ($المخدومين as $item) {
												if($item['approve']==0){
												echo '<li>';
													echo $item['name'];
													echo '<a href="items.php?do=Edit&itemid=' . $item['id'] . '">';
														echo '<span class="btn btn-success pull-right">';
															echo '<i class="fa fa-edit"></i> Edit';
															if ($item['approve'] == 0) {
																echo "<a 
																		href='items.php?do=Approve&itemid=" . $item['id'] . "' 
																		class='btn btn-info pull-right activate'>
																		<i class='fa fa-check'></i> Approve</a>";
															}
														echo '</span>';
													echo '</a>';
												echo '</li>';
												}
											}
										} else {
											echo 'There\'s No Items To Show';
										}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- Start Latest Comments -->
				<div class="row">
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-comments-o"></i> 
								الخدام 
								<span class="toggle-info pull-right">
									<i class="fa fa-plus fa-lg"></i>
								</span>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled latest-users">
									<?php
										if (! empty($الخدام)) {
											foreach ($الخدام as $item) {
												echo '<li>';
													echo $item['name'];
													echo '<a href="items.php?do=Edit&itemid=' . $item['id'] . '">';
													echo '</a>';
												echo '</li>';
											}
										} else {
											echo 'There\'s No Items To Show';
										}
									?>
								</ul>
							</div>
							<!-- <div class="panel-body">
								<?php
									// $stmt = $con->prepare("SELECT 
									// 							comments.*, users.Username AS Member  
									// 						FROM 
									// 							comments
									// 						INNER JOIN 
									// 							users 
									// 						ON 
									// 							users.UserID = comments.user_id
									// 						ORDER BY 
									// 							c_id DESC
									// 						LIMIT $numComments");

									// $stmt->execute();
									// $comments = $stmt->fetchAll();

									// if (! empty($comments)) {
									// 	foreach ($comments as $comment) {
									// 		echo '<div class="comment-box">';
									// 			echo '<span class="member-n">
									// 				<a href="members.php?do=Edit&userid=' . $comment['user_id'] . '">
									// 					' . $comment['Member'] . '</a></span>';
									// 			echo '<p class="member-c">' . $comment['comment'] . '</p>';
									// 		echo '</div>';
									// 	}
									// } else {
									// 	echo 'There\'s No Comments To Show';
									// }
								?>
							</div> -->
						</div>
					</div>
				</div>
				<!-- End Latest Comments -->
			</div>
		</div>

		<?php

		/* End Dashboard Page */

		include $tpl . 'footer.php';

	} else {

		header('Location: index.php');

		exit();
	}

	ob_end_flush(); // Release The Output

?>