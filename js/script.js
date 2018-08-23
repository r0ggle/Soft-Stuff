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
	var sb = T.$C("show-button");
	var sbb; // show-button button
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

	// hide expandable elements and show their buttons
	for (var i = 0, l = sb.length; i < l; i++) { // each div
		for (var n = 0, e = sb[i].children.length; n < e; n++) { // each child
			sb[i].children[n].style.display = "none";
		}
		sbb = sb[i].querySelector("button");
		sbb.style.display = "block";
		T.addEvent(sbb, "click", function() {
			for (var n = 0, e = sbb.parentNode.children.length; n < e; n++) { // each child
				if (sbb.parentNode.children[n].nodeName != "BUTTON") {
					sbb.parentNode.children[n].style.display =
					(sbb.parentNode.children[n].style.display == "none") ? "inline" : "none";
				}
			}
		});
	}
};