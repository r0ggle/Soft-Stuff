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

	console.log('window loaded: ' + document.title);

	var wiresButton;

	document.body.innerHTML +=
	"<button id='wires-button'>Wires</button>";
	wiresButton = T.$("wires-button");

	// check for timefiles.js function
	if (typeof colorRandomly !== "undefined") {
		colorRandomly(T.$C("tf-month-day"), "backgroundColor");
		colorRandomly(T.$C("tf-day-i"), "backgroundColor");
		//colorRandomly(T.$("wrapper"), "backgroundColor");
	}

	T.toggleProp(T.$("wires"), "disabled");
	wiresButton.onclick = function() {
		T.toggleProp(T.$("wires"), "disabled");
	};
};