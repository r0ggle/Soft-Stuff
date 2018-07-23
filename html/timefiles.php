<?php
	require("../../inc/config.php");
	include(INC."/header.html");
?>
	<div id="wrapper">
		<header>
			<h1><a href="index.php">Time Files</a></h1>
		</header>
		<main>
			<div>
				<p>Because time flies...</p>
				<!-- start of time files area -->
				<form name="time-form" id="tf-form" action="#" method="post">
					<fieldset>
						<legend>Log Activity</legend>
						<label for="time-start">Start Time</label>
						<input type="time" name="time-start">
						<label for="time-end">End Time</label>
						<input type="time" name="time-end">
						<select name="time-activity">
							<option value="languages">Languages</option>
							<option value="software">Software</option>
							<option value="Music">Music</option>
							<option value="Exercise">Exercise</option>
						</select>
						<input type="submit" name="Submit" value="Submit">
					</fieldset>
				</form>
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