/*	
	toolBox.js
	22.jun.2018
		Written by Ruairi Gann.
		If necessary arguments are not provided,
		these functions return undefined.
*/

var T = {

	/*
		$ function acts as a shortcut for document.getElementById().
		[0] id = String, id of HTML element.
		return = Object, reference to HTML element.
	*/
	$: function(id)
	{
		"use strict";
		if (id && typeof id != 'undefined') {
			return document.getElementById(id);
		}
	}, // end of $ function.


	/*
		setText function is used to update the text of an HTML element.
		[0] element = Object, reference to HTML element.
		[1] message = String/Number, to be set as element content.
		return = true/false, depending on success of text-setting.
	*/
	setText: function(element, message)
	{
		"use strict";
		if (element && message) {
			if (element.textContent) {
				element.textContent = message;
			} else if (element.innerText) {
				element.innerText = message;
			} else {
				return false;
			}
			return true;
		}
	}, // End of setText function.


	/*
		addEvent function is used to add event handlers.
		[0] obj = Object, reference to HTML element.
		[1] type = String, the type of event.
		[2] fn = Object, function to assign to the event.
	*/
	addEvent: function(obj, type, fn)
	{
		"use strict";
		if (obj && type && fn) {
			if (obj.addEventListener) { // W3C
				obj.addEventListener(type, fn, false);
			} else if (obj.attachEvent) { // Older IE
				obj.attachEvent('on' + type, fn);
			}
		}
	}, // End of addEvent function.

	/*
		removeEvent function is used to remove event handlers.
		[0] obj = Object, reference to HTML element.
		[1] type = String, the type of event.
		[2] fn = Object, function to remove from the event.
	*/
	removeEvent: function(obj, type, fn)
	{
		"use strict";
		if (obj && type && fn) {
			if (obj.removeEventListener) { // W3C
				obj.removeEventListener(type, fn, false);
			} else if (obj.detachEvent) { // Older IE
				obj.detachEvent('on' + type, fn);
			}
		}
	} // End of removeEvent function.

}; // End of T.