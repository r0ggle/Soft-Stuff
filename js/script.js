window.onload = function()
{
	"use strict";
	var title = (t.$('head-title').textContent) ?
	t.$('head-title').textContent :
	t.$('head-title').innerText;
	console.log('window loaded: ' + title);
};