<?php
	require("../../inc/config.php");
	include(INC."/header.html");
	require(INC."/mysqli.php");

	$user_id = "1";
	$mysql_time = date("Y-m-d H:i:s");

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		if (isset($_POST['la-submit'])) { // log new task

			if ($_POST['la-time-date'] == '') {
				$la_date = date("Y-m-d");
			} else {
				$la_date = date("Y-m-d", $_POST['la-time-date']);
			}

			$time_start = ($_POST["la-time-start"] == "" ?
			$mysql_time : ($la_date.' '.$_POST["la-time-start"].':00'));

			$time_end = ($_POST["la-time-end"] == "" ?
			"0000-00-00 00:00:00" : ($la_date.' '.$_POST["la-time-end"].':00'));
		
			if ($_POST['la-time-task'] == '') exit();
			$task_id = $_POST["la-time-task"];

			$q = "INSERT INTO times (task_id, time_start, time_end) VALUES ('$task_id', '$time_start', '$time_end')";
			if (!$mysqli->query($q)) {
				echo "Faild to insert row: " . $mysqli->errno;
				echo $q;
			}
		} else if (isset($_POST['ct-submit'])) { // complete task

			if (!$_POST['ct-id']) exit();
			$ct_id = $_POST['ct-id'];

			// complete the incomplete task:
			$r = $mysqli->query("UPDATE times SET time_end=UTC_TIMESTAMP() WHERE id=$ct_id");
		}
		
	}
?>
	<div id="wrapper">
		<header>
			<h1><a href="index.php">Time Files</a></h1>
		</header>
		<main>
			<div>
				<p>Because time flies...</p>
				<div class="show-button">
					<button>About</button>
					<p>When you are about to start doing something, select that task from your list and hit submit.<br>If you want to add an entry for something you have already done, simply enter the start and end times before submitting the form.</p>
				</div>
				<!-- start of time files area -->
<?php
	$r = $mysqli->query("SELECT ti.id, ti.time_start, ta.name FROM times AS ti LEFT JOIN tasks AS ta ON ti.task_id = ta.id WHERE ta.user_id='$user_id' AND ti.time_end = '0000-00-00 00:00:00';");

	if (mysqli_num_rows($r) != 0) {
?>
				<form name="complete-task" action="#" method="post">
					<fieldset>
						<legend>Complete Task</legend>
						<p>You have an ongoing task:
<?php
	$row = $r->fetch_assoc();
	//$time_id = $row['ti.id'];
	echo $row['name'].', started:<br>'.$row['time_start'].' UTC';
	echo '<input type="hidden" name="ct-id" value="'.$row['id'].'">';
?>
						</p>
						<input type="submit" name="ct-submit" value="Complete">
					</fieldset>
				</form>
<?php
} else {
?>
				<form name="log-task" action="#" method="post">
					<fieldset>
						<legend>Log task</legend>
						<label for="la-time-start">Start Time</label>
						<input type="time" name="la-time-start">
						<label for="la-time-end">End Time</label>
						<input type="time" name="la-time-end">
						<input type="date" name="la-time-date">
						<select name="la-time-task">
	<?php
		$r = $mysqli->query("SELECT id, name FROM tasks WHERE user_id=$user_id");
		while ($row = $r->fetch_assoc()) {
			echo '<option value="'
			. $row["id"] . '">' . $row["name"] .
			'</option>';
		}
	?>
						</select>
						<input type="submit" name="la-submit" value="Submit">
					</fieldset>
				</form> <!-- end of log-task form -->
<?php
	} // list last 20 time entries, latest first
	$r = $mysqli->query("SELECT ta.name, ta.color, DATE_FORMAT(ti.time_start, '%a, %b %d, %H:%i') AS time_start, DATE_FORMAT(ti.time_end, '%H:%i') AS time_end FROM tasks AS ta INNER JOIN times as ti ON ta.id=ti.task_id WHERE ta.user_id='$user_id' ORDER BY ti.time_start DESC LIMIT 16");
	while ($row = $r->fetch_assoc()) {
		echo '<span class="t" style="background-color:#'.$row['color'].'">'.$row['time_start'].' - '.$row['time_end'].': '.$row['name'].'</span>';
	}
?>
				<div id="tf-wrapper">
					<h3><?php echo date("F"); ?></h3>
					<div id="tf-month">
<?php
	// print month grid
	$r = $mysqli->query("SELECT DAY(LAST_DAY(CURRENT_TIMESTAMP()))");
		$row = $r->fetch_array(MYSQLI_NUM);
		$days_in_month = $row[0];
		for ($i=1; $i <= $days_in_month; $i++) {
			echo '<div class="tf-month-day">'.$i.'</div>';
		}
?>
					</div> <!-- end of tf-grid -->
					<div id="tf-month-nav"> &lt; &gt; </div>
					<div id="tf-day">
					</div> <!-- end of tf-day -->
				</div>
				<!-- end of time files area -->
			</div>
			<div id="sidebar">
			</div>
		</main>
		<footer>&copy; 2018 - <?php echo date('Y'); ?></footer>
	</div> <!-- end of #wrapper -->
	<script src="../js/toolBox.js"></script>
	<script src="../js/timefiles.js"></script>
	<script src="../js/script.js"></script>
</body>
</html>