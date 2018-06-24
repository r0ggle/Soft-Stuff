window.onload = function()
{
	"use strict";
	var title = (T.$('head-title').textContent) ?
	T.$('head-title').textContent :
	T.$('head-title').innerText;
	console.log('window loaded: ' + title);
};