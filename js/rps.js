/*
	rps.js
	24.jun.2018
		Written by Ruairi Gann.
		This script handles a form submission,
		randomly chooses and compares options to user input,
		and displays the result to the user,
		thus creating a fun game of Rock, Paper, Scissors.
		Written to be used with rps.html on softstuff.uk,
		this script uses methods from toolBox.js.
*/

(function(){
	"use strict";
	
	var score = 0;
	var high = 0;
	var output = T.$("rps-result");

	/*
		playRPS function takes a choice, makes a choice and calculates a winner.
		[0] userChoice = String,
		expected to be either "rock", "paper" or "scissors".
		return = Number, 1 for user win, 2 for computer win, 0 for draw.
	*/
	function playRPS(userChoice)
	{
		var result;
		var rock = Math.random(), paper = Math.random(), scissors = Math.random();
		if (rock > paper) { // rock or scissors
			if (scissors > rock) { // scissors!
				if (userChoice == "rock") {
					result = 1;
				} else if (userChoice == "paper") {
					result = 2;
				} else {
					result = 0;
				}
			} else { // rock!
				if (userChoice == "rock") {
					result = 0;
				} else if (userChoice == "paper") {
					result = 1;
				} else {
					result = 2;
				}
			}
		} else if (paper > scissors) { // paper!
			if (userChoice == "rock") {
				result = 2;
			} else if (userChoice == "paper") {
				result = 0;
			} else {
				result = 1;
			}
		} else { // scissors!
			if (userChoice == "rock") {
				result = 1;
			} else if (userChoice == "paper") {
				result = 2;
			} else {
				result = 0;
			}
		}
		return result;
	} // end of playRPS function.

	/*
		handleClick function gets a result from playRPS,
		builds and displays a message to the user indicating the score.
		[0] input = String,
		expected to be either "rock", "paper" or "scissors".
	*/
	function handleClick(input)
	{
		var message;
		var result = playRPS(input);

		if (result !== 0) {
			if (result === 1) { // user win
				++score;
				message = "You win!";
				if (score > high) {
					++high;
				}
			} else { // computer win
				score = 0;
				message = "You lose.";
			}
		} else { // draw
			message = "It's a draw...";
		}

		message += "<ul><li>Score: " + score;
		message += "</li><li>High: " + high;
		message += "</li></ul>";
		output.innerHTML = message;
	} // end of handleForm function.

	window.onload = function()
	{
		T.addEvent(T.$("rps-rock"), "click", function() {
			handleClick("rock");
		});
		T.addEvent(T.$("rps-paper"), "click", function() {
			handleClick("paper");
		});
		T.addEvent(T.$("rps-scissors"), "click", function() {
			handleClick("scissors");
		});
	}
}());