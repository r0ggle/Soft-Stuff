var ftResults = JSON.parse('<?php echo json_encode($results) ?>');

function handleFretTrain(results, interval)
{
	"use strict";
	var list = [];
	var index = 0;
	interval = interval || 5000;

	// convert results into simple array
	for (var key in results) {
		results[key].forEach(function(fret) {
			list.push(key + ' fret ' + fret);
		});
	}

	var interval = setInterval(function() {
		T.setText(T.$('output'), list[index]);
		index++;
		if (index >= list.length) {
			T.setText(T.$('output'), '');
			clearInterval(interval);
		}
	}, interval);
} // end of handleFretTrain function

handleFretTrain(ftResults, 4000);