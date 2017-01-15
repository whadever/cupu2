<div class="row">
	<div class="col-xs-12">
		<h1>Welcome,<?php if(isset($_SESSION['userid'])){ echo $_SESSION['first_name'].' '.$_SESSION['last_name'];}else{ echo 'please login to access this page';} ?></h1>
	</div>
</div>
<?php if(isset($_SESSION['userid'])): ?>
<?php if($_SESSION['role'] == 'admin'): ?>
<div class="row">

	<div class="col-xs-12">
		<h2>This page is only for administrators. The following operation can be performed</h2>
		<p class="no-margin">1.<a href="index.php?manageuser">Manage Users</a></p>
		<p>Assign Roles, Delete users, add users, edit user information</p>

		<p class="no-margin">2.<a href="index.php?managequestion">Manage Questions</a></p>
		<p>Create new questions online, upload question, set up question generator variables</p>

		<p class="no-margin">3.<a href="index.php?managetests">Manage Tests</a></p>
		<p>Create new tests, set up test variables</p>
	</div>
</div>
<?php else: ?>
<div class="row">

	<div class="col-xs-12">
		<h2></h2>
		<p class="no-margin">1.<a href="index.php?manageuser">Write A test</a></p>
		<p>Assign Roles, Delete users, add users, edit user information</p>

		<p class="no-margin">2.<a href="index.php?managequestion">Manage Questions</a></p>
		<p>Create new questions online, upload question, set up question generator variables</p>

		<p class="no-margin">3.<a href="">Manage Tests</a></p>
		<p>Create new tests, set up test variables</p>
	</div>
</div>
<?php endif; ?>
<?php endif; ?>