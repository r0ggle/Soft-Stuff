<?php

	$page = 'frettrain';

	require("../../inc/config.php");
	include(INC."/header.html");
	require(INC."/mysqli.php");

	if (isset($_GET['ft-form-input'])) { // form was submitted

		if (isset($_GET['speed'])) {
			$speed = $_GET['speed'];
			if (is_numeric($speed) && ($speed > 0 && $speed <= 30)) {
				$speed = floor($speed);
			} else {
				$speed = 5;
			}
		} else {
			$speed = 5;
		}
		$speed = ($speed * 1000);

		if (isset($_GET['shuffle']) && $_GET['shuffle'] === 'on') {
			$shuffle = true;
		} else {
			$shuffle = false;
		}

		$notes_array = [];
		$strings_array = [];
		$frets_array = [];

		// push form inputs into seperate arrays
		foreach ($_GET as $k => $v) {
			if (substr($k, 0, 3) == 'str') { // string
				$strings_array[] = $k;
			} else if (substr($k, 0, 1) == 'n') { // note
				$notes_array[] = $k;
			} else if (substr($k, 0, 2) == 'fr') { // fret
				$frets_array[] = $k;
			}
		} // end of foreach $_GET

		if (empty($notes_array)) { // add all natural notes
			array_push($notes_array, 'nC','nD','nE','nF','nG','nA','nB');
		}
		if (empty($strings_array)) { // add all strings
			array_push($strings_array, 'strE2','strB','strG','strD','strA','strE');
		}
		if (empty($frets_array)) { // add all frets up to 12
			array_push($frets_array, 'fr0','fr1','fr2','fr3','fr4','fr5','fr6','fr7','fr8','fr9','fr10','fr11','fr12');
		}


		$results = []; // array to hold results

		foreach ($notes_array as $k => $v) {
			$note = substr($v, 1);
			$note_data = [];
			$strings = '';
			$frets = '';

			// concat strings to make OR conditional
			foreach ($strings_array as $k1 => $v1) {
				$strings .= substr($v1, 3);
				$strings .= "='$note' OR ";
			}
			$strings = substr($strings, 0, -4);

			// concat frets to make second OR contitional
			foreach ($frets_array as $k1 => $v1) {
				$frets .= "no='";
				$frets .= substr($v1, 2);
				$frets .= "' OR ";
			}
			$frets = substr($frets, 0, -4);

			$q = "SELECT no FROM frets WHERE ($strings) AND ($frets)";
			$r = $mysqli->query($q);
			while ($row = $r->fetch_assoc()) {
				$note_data[] = $row['no'];
			}
			if ($shuffle) shuffle($note_data);
			$results[$note] = $note_data;
		} // end of main foreach loop
		//echo '<pre>' . var_export($results, true) . '</pre>';
	}
?>

<div id="wrapper">
		<header>
			<h1><a href="index.php">Fret Train</a></h1>
		</header>
		<main>
			<div>
				<p>Learn the notes on the guitar!</p>
				<div class="show-button">
					<button>About</button>
					<p>Use this program to practice finding notes on the guitar fretboard.<br><br><br>Leave the form unchecked for default settings: all strings, all natural notes (no sharps or flats) and all frets from 0 (open string) to 12. If shuffle is on, the frettings of each note will be random, however the note order will stay the same. This makes it easier to hear if you've hit the right note, because all of the same notes will still be grouped together.</p><br><br>
					<p>If you are not very confident in your ability to quickly find notes on the fretboard, I suggest starting by just checking one string (the low E), and memorizing the location of all the natural notes visually on your guitar. Then, once you've done the same for the A string, try checking both strings, keeping the speed slow (high?), and see how you do. Remember to be accurate, don't play a note if you don't know what it is!</p>

				</div>
				<form name="ft-form" action="" method="get">
					<input type="hidden" name="ft-form-input">
					<fieldset>
						<legend>configure</legend>
						<span>Strings<br>
							<label for="strE2">e</label>
							<input type="checkbox" name="strE2" 
<?php if (isset($_GET['strE2'])) echo 'checked'; ?>><br>
							<label for="strB">B</label>
							<input type="checkbox" name="strB" 
<?php if (isset($_GET['strB'])) echo 'checked'; ?>><br>
							<label for="strG">G</label>
							<input type="checkbox" name="strG" 
<?php if (isset($_GET['strG'])) echo 'checked'; ?>><br>
							<label for="strD">D</label>
							<input type="checkbox" name="strD" 
<?php if (isset($_GET['strD'])) echo 'checked'; ?>><br>
							<label for="strA">A</label>
							<input type="checkbox" name="strA" 
<?php if (isset($_GET['strA'])) echo 'checked'; ?>><br>
							<label for="strE">E</label>
							<input type="checkbox" name="strE" 
<?php if (isset($_GET['strE'])) echo 'checked'; ?>><br>
						</span>
						<span>Notes<br>
							<label for="nC">C</label>
							<input type="checkbox" name="nC" 
<?php if (isset($_GET['nC'])) echo 'checked'; ?>><br>
							<label for="nC#">C#</label>
							<input type="checkbox" name="nC#" 
<?php if (isset($_GET['nC#'])) echo 'checked'; ?>><br>
							<label for="nD">D</label>
							<input type="checkbox" name="nD" 
<?php if (isset($_GET['nD'])) echo 'checked'; ?>><br>
							<label for="nD#">D#</label>
							<input type="checkbox" name="nD#" 
<?php if (isset($_GET['nD#'])) echo 'checked'; ?>><br>
							<label for="nE">E</label>
							<input type="checkbox" name="nE" 
<?php if (isset($_GET['nE'])) echo 'checked'; ?>><br>
							<label for="nF">F</label>
							<input type="checkbox" name="nF" 
<?php if (isset($_GET['nF'])) echo 'checked'; ?>><br>
							<label for="nF#">F#</label>
							<input type="checkbox" name="nF#" 
<?php if (isset($_GET['dF#'])) echo 'checked'; ?>><br>
							<label for="nG">G</label>
							<input type="checkbox" name="nG" 
<?php if (isset($_GET['nG'])) echo 'checked'; ?>><br>
							<label for="nG#">G#</label>
							<input type="checkbox" name="nG#" 
<?php if (isset($_GET['nG#'])) echo 'checked'; ?>><br>
							<label for="nA">A</label>
							<input type="checkbox" name="nA" 
<?php if (isset($_GET['nA'])) echo 'checked'; ?>><br>
							<label for="nA#">A#</label>
							<input type="checkbox" name="nA#" 
<?php if (isset($_GET['nA#'])) echo 'checked'; ?>><br>
							<label for="nB">B</label>
							<input type="checkbox" name="nB" 
<?php if (isset($_GET['nB'])) echo 'checked'; ?>><br>
						</span>
						<span>Frets<br>
							<label for="fr0">0</label>
							<input type="checkbox" name="fr0" 
<?php if (isset($_GET['fr0'])) echo 'checked'; ?>><br>
							<label for="fr1">1</label>
							<input type="checkbox" name="fr1" 
<?php if (isset($_GET['fr1'])) echo 'checked'; ?>><br>
							<label for="fr2">2</label>
							<input type="checkbox" name="fr2" 
<?php if (isset($_GET['fr2'])) echo 'checked'; ?>><br>
							<label for="fr3">3</label>
							<input type="checkbox" name="fr3" 
<?php if (isset($_GET['fr3'])) echo 'checked'; ?>><br>
							<label for="fr4">4</label>
							<input type="checkbox" name="fr4" 
<?php if (isset($_GET['fr4'])) echo 'checked'; ?>><br>
							<label for="fr5">5</label>
							<input type="checkbox" name="fr5" 
<?php if (isset($_GET['fr5'])) echo 'checked'; ?>><br>
							<label for="fr6">6</label>
							<input type="checkbox" name="fr6" 
<?php if (isset($_GET['fr6'])) echo 'checked'; ?>><br>
							<label for="fr7">7</label>
							<input type="checkbox" name="fr7" 
<?php if (isset($_GET['fr7'])) echo 'checked'; ?>><br>
							<label for="fr8">8</label>
							<input type="checkbox" name="fr8" 
<?php if (isset($_GET['fr8'])) echo 'checked'; ?>><br>
							<label for="fr9">9</label>
							<input type="checkbox" name="fr9" 
<?php if (isset($_GET['fr9'])) echo 'checked'; ?>><br>
							<label for="fr10">10</label>
							<input type="checkbox" name="fr10" 
<?php if (isset($_GET['fr10'])) echo 'checked'; ?>><br>
							<label for="fr11">11</label>
							<input type="checkbox" name="fr11" 
<?php if (isset($_GET['fr11'])) echo 'checked'; ?>><br>
							<label for="fr12">12</label>
							<input type="checkbox" name="fr12" 
<?php if (isset($_GET['fr12'])) echo 'checked'; ?>><br>
							<label for="fr13">13</label>
							<input type="checkbox" name="fr13" 
<?php if (isset($_GET['fr13'])) echo 'checked'; ?>><br>
							<label for="fr14">14</label>
							<input type="checkbox" name="fr14" 
<?php if (isset($_GET['fr14'])) echo 'checked'; ?>><br>
							<label for="fr15">15</label>
							<input type="checkbox" name="fr15" 
<?php if (isset($_GET['fr15'])) echo 'checked'; ?>><br>
							<label for="fr16">16</label>
							<input type="checkbox" name="fr16" 
<?php if (isset($_GET['fr16'])) echo 'checked'; ?>><br>
							<label for="fr17">17</label>
							<input type="checkbox" name="fr17" 
<?php if (isset($_GET['fr17'])) echo 'checked'; ?>><br>
							<label for="fr18">18</label>
							<input type="checkbox" name="fr18" 
<?php if (isset($_GET['fr18'])) echo 'checked'; ?>><br>
							<label for="fr19">19</label>
							<input type="checkbox" name="fr19" 
<?php if (isset($_GET['fr19'])) echo 'checked'; ?>><br>
							<label for="fr20">20</label>
							<input type="checkbox" name="fr20" 
<?php if (isset($_GET['fr20'])) echo 'checked'; ?>><br>
							<label for="fr21">21</label>
							<input type="checkbox" name="fr21" 
<?php if (isset($_GET['fr21'])) echo 'checked'; ?>><br>
							<label for="fr22">22</label>
							<input type="checkbox" name="fr22" 
<?php if (isset($_GET['fr22'])) echo 'checked'; ?>><br>
							<label for="fr23">23</label>
							<input type="checkbox" name="fr23" 
<?php if (isset($_GET['fr23'])) echo 'checked'; ?>><br>
							<label for="fr24">24</label>
							<input type="checkbox" name="fr24" 
<?php if (isset($_GET['fr24'])) echo 'checked'; ?>><br>
						</span>
						<label for="speed">Speed (in seconds)</label>
						<input type="number" name="speed" value=
<?php echo '"'; if (isset($speed)) { echo ($speed / 1000) . '"'; } else { echo 4; } ?>"><br>
						<label for="shuffle">Shuffle</label>
						<input type="checkbox" name="shuffle" 
<?php if (!isset($shuffle) || $shuffle == true) echo "checked"; ?>><br>
						<input type="submit" name="submit" value="Start">
					</fieldset>
				</form>
				<div id="output">
				</div>
			</div>
			<div id="sidebar">
				<ul>
					<li><a href="databending.html">Databending</a></li>
					<li><a href="timefiles.php">Time Files</a></li>
					<li><a href="frettrain.php">Fret Train</a></li>
					<li><a href="rps.php">Rock, Paper, Scissors</a></li>
				</ul>
			</div>
		</main>
		<footer>Ruairi Gann &copy; 2018</footer>
	</div> <!-- end of #wrapper -->
	<script src="../js/toolBox.js"></script>
<?php if (isset($results)) { ?>
	<script type="text/javascript">
		var ftResults = JSON.parse('<?php echo json_encode($results) ?>');
		var speed = <?php echo $speed; ?>;
		var interval;

		function handleOutputClick()
		{
			"use strict";
			T.C('in handleOutputClick');
			T.$('output').style.display = 'none';
			T.removeEvent(this, 'click', handleOutputClick);
		}

		function handleFretTrain(results, interval)
		{
			"use strict";
			var list = [];
			var index = 0;
			interval = interval || 5000;
			T.$('output').style.display = 'inline';
			T.setText(T.$('output'), 'Ready?');
			// convert results into simple array
			for (var key in results) {
				results[key].forEach(function(fret) {
					list.push(key + ' fret ' + fret);
				});
			}
			interval = setInterval(function() {
				T.setText(T.$('output'), list[index]);
				index++;
				if (index > list.length) {
					T.$('output').style.display = 'none';
				clearInterval(interval);
				}
			}, interval);
			T.addEvent(document, 'click', handleOutputClick);
		} // end of handleFretTrain function

		handleFretTrain(ftResults, speed);
	</script>
<?php } ?>
	<script src="../js/script.js"></script>
</body>
</html>