window.onload = function()
{
	'use strict';

	var title = (document.getElementById('head-title').textContent) ?
	document.getElementById('head-title').textContent :
	document.getElementById('head-title').innerText;
	
	console.log('window loaded: ' + title);
};