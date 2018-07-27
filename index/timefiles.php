<?php
	require("../../inc/config.php");
	include(INC."/header.html");
	require(INC."/mysqli.php");

	$user_id = "1";
	$mysql_time = date("Y-m-d H:i:s");

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		if ($_POST['la-submit']) { // log new task

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

			/*$q = "INSERT INTO times (task_id, time_start, time_end) VALUES ('$task_id', '$time_start', '$time_end')";
			if (!$mysqli->query($q)) {
				echo "Faild to insert row: " . $mysqli->errno;
				echo $q;
			}*/
		} else if ($_POST['ct-submit']) { // complete task

			if (!$_POST['ct-id']) exit();
			$ct_id = $_POST['ct-id'];

			// complete the incomplete task:
			$r = $mysqli->query("UPDATE times SET time_end=CURRENT_TIMESTAMP() WHERE id=$ct_id");
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
				<!-- start of time files area -->
<?php
	$r = $mysqli->query("SELECT ti.id, ti.time_start, ta.name FROM times as ti LEFT JOIN tasks as ta ON ti.task_id = ta.id WHERE ta.user_id='$user_id' AND ti.time_end = '0000-00-00 00:00:00';");

	if (mysqli_num_rows($r) != 0) {
?>
				<form name="complete-task" action="#" method="post">
					<fieldset>
						<legend>Complete Task</legend>
						<p>You have an ongoing task:
<?php
	$row = $r->fetch_assoc();
	//$time_id = $row['ti.id'];
	echo $row['name'].', started:<br>'.$row['time_start'];
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
	}
?>
				<div id="tf-wrapper">
					<h3>August</h3>
					<div id="tf-month">
						<div class="tf-month-day">1</div>
						<div class="tf-month-day">2</div>
						<div class="tf-month-day">3</div>
						<div class="tf-month-day">4</div>
						<div class="tf-month-day">5</div>
						<div class="tf-month-day">6</div>
						<div class="tf-month-day">7</div>
						<div class="tf-month-day">8</div>
						<div class="tf-month-day">9</div>
						<div class="tf-month-day">10</div>
						<div class="tf-month-day">11</div>
						<div class="tf-month-day">12</div>
						<div class="tf-month-day">13</div>
						<div class="tf-month-day">14</div>
						<div class="tf-month-day">15</div>
						<div class="tf-month-day">16</div>
						<div class="tf-month-day">17</div>
						<div class="tf-month-day">18</div>
						<div class="tf-month-day">19</div>
						<div class="tf-month-day">20</div>
						<div class="tf-month-day">21</div>
						<div class="tf-month-day">22</div>
						<div class="tf-month-day">23</div>
						<div class="tf-month-day">24</div>
						<div class="tf-month-day">25</div>
						<div class="tf-month-day">26</div>
						<div class="tf-month-day">27</div>
						<div class="tf-month-day">28</div>
						<div class="tf-month-day">29</div>
						<div class="tf-month-day">30</div>
						<div class="tf-month-day">31</div>
						<div class="tf-month-day">32</div>
					</div> <!-- end of tf-grid -->
					<div id="tf-month-nav"> &lt; July September &gt; </div>
					<div id="tf-day">
					</div> <!-- end of tf-day -->
				</div>
				<!-- end of time files area -->
			</div>
			<div id="sidebar">
			</div>
		</main>
		<footer>Ruairi Gann &copy; 2018</footer>
	</div> <!-- end of #wrapper -->
	<script src="../js/toolBox.js"></script>
	<script src="../js/timefiles.js"></script>
	<script src="../js/script.js"></script>
</body>
</html>