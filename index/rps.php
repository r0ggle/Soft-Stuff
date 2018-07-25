<?php
	require("../../inc/config.php");
	include(INC."/header.html");
?>
	<div id="wrapper">
		<header>
			<h1><a href="index.php">Soft Stuff</a></h1>
			<!--<nav>
				<ul>
					<li>projects</li>
					<li>posts</li>
					<li>contact</li>
				</ul>
			</nav>-->
		</header>
		<main>
			<div>
				<p id="js-notice">This game requires Javascript.</p>
				<div id="rps-container">
					<span id="rps-result">
						Make your choice...
						<ul>
							<li>Score:</li>
							<li>High:</li>
						</ul>
					</span>
					<form id="rps-form" method="post" action="">
						<button id="rps-rock" type="button" name="rock">Rock</button>
						<button id="rps-paper" type="button" name="paper">Paper</button>
						<button id="rps-scissors" type="button" name="scissors">Scissors</button>
					</form>
				</div>
			</div>
			<div id="sidebar">
				<ul>
					<li><a href="databending.html">Databending</a></li>
					<li><a href="timefiles.php">Time Files</a></li>
					<li><a href="rps.php">Rock, Paper, Scissors</a></li>
				</ul>
			</div>
		</main>
		<footer>Ruairi Gann &copy; 2018</footer>
	</div> <!-- end of #wrapper -->
	<script src="../js/toolBox.js"></script>
	<script src="../js/rps.js"></script>
</body>
</html>