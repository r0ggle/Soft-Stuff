/*
	colorRandomly function randomly applies an rgba color
	to an HTMLCollection's color or backgroundColor properties.
	[0] elem = Object, HTMLCollection.
	[1] attr = String, "backgroundColor" or "color" by default.
	return = undefined.
*/
function colorRandomly(elem, attr)
{
	"use strict";
	var r, g, b, a;
	if (elem && typeof elem && 'object') {
		if (attr == "backgroundColor") {
			for(var i = 0, count = elem.length; i < count; i++) {
				r = Math.floor(Math.random() * Math.floor(255));
				g = Math.floor(Math.random() * Math.floor(255));
				b = Math.floor(Math.random() * Math.floor(255));
				a = Math.floor(Math.random() * Math.floor(99));
				elem[i].style.backgroundColor = "rgba("+r+","+g+","+b+",."+a+")";
			}
		} else {
			for(var i = 0, count = elem.length; i < count; i++) {
				r = Math.floor(Math.random() * Math.floor(255));
				g = Math.floor(Math.random() * Math.floor(255));
				b = Math.floor(Math.random() * Math.floor(255));
				a = Math.floor(Math.random() * Math.floor(99));
				elem[i].style.color = "rgba("+r+","+g+","+b+",."+a+")";
			}
		}
	}
} // end of colorRandomly function.