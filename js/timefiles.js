function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}

function colorCalendar(month)
{
	"use strict";
	var r;
	var g;
	var b;
	var a;
	var days = document.getElementsByClassName("tf-month-day");

	for(var i = 0, count = days.length; i < count; i++) {
		r = getRandomInt(255);
		g = getRandomInt(255);
		b = getRandomInt(255);
		a = getRandomInt(99);
		days[i].style.backgroundColor = "rgba("+r+","+g+","+b+",."+a+")";
	}

}

window.onload = colorCalendar;