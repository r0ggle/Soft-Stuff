/*
	script.js
	09.jul.2018
		Written by Ruairi Gann
		This script, written for softstuff.uk,
		adds basic functionality that can be used most
		pages of the site.
*/

window.onload = function()
{
	"use strict";
	var wiresButton;

	console.log('window loaded: ' + document.title);

	document.body.innerHTML +=
	"<button id='wires-button'>Wires</button>";
	wiresButton = T.$("wires-button");

	// check for timefiles.js function
	if (typeof colorRandomly !== "undefined") {
		colorRandomly(T.$C("tf-month-day"), "backgroundColor");
	}

	// disable wires initially
	T.toggleProp(T.$("wires"), "disabled");
	T.addEvent(wiresButton, "click", function() {
		T.toggleProp(T.$("wires"), "disabled");
	});
};