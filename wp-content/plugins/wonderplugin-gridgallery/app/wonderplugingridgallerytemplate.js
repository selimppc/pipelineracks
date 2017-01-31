/**
 * WonderPlugin Grid Gallery Skin Options
 * Copyright 2014 Magic Hills Pty Ltd - http://www.wonderplugin.com
 */

var WONDERPLUGIN_GRIDGALLERY_STYLE_TEMPLATE = {
	classic: {
		width: 				200,
		height: 			150,
		random: 			false,
		circularimage:		false,
		firstimage:			false,
		showtitle: 			true,
		titlemode: 			"mouseover",
		titleeffect: 		"slide",
		titleeffectduration: 300,
		gap: 				4,
		margin: 			0,
		borderradius: 		0,
		hoverzoomin: 		true,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(http://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    background-color: rgba(51, 51, 51, 0.5);\n    color: #fff;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    padding: 8px 0px;\n    position: absolute;\n    left: 0px;\n    bottom: 0px;\n    width: 100%;\n}'
	},
	
	circular: {
		width: 				160,
		height: 			160,
		random: 			false,
		circularimage:		true,
		firstimage:			false,
		showtitle: 			false,
		titlemode: 			"always",
		titleeffect: 		"fade",
		titleeffectduration: 300,
		gap: 				24,
		margin: 			0,
		borderradius: 		0,
		hoverzoomin: 		true,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(http://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    color: #fff;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    padding: 8px 0px;\n    position: absolute;\n    left: 0px;\n    bottom: 0px;\n    width: 100%;\n}'
	},
	
	circularwithtext: {
		width: 				120,
		height: 			144,
		random: 			false,
		circularimage:		true,
		firstimage:			false,
		showtitle: 			true,
		titlemode: 			"always",
		titleeffect: 		"fade",
		titleeffectduration: 300,
		gap: 				24,
		margin: 			0,
		borderradius: 		0,
		hoverzoomin: 		false,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(http://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container {\n    text-align: center;\n    padding-bottom: 24px;\n    box-sizing: border-box;\n    -moz-box-sizing: border-box;\n    -webkit-box-sizing: border-box;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container img {\n    max-height: 100%;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container img:hover {\n    opacity: 0.7;\n    filter: alpha(opacity=70);\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    color: #333;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    margin: 0px auto;\n    position: absolute;\n    left: 0px;\n    bottom: 0px;\n    width: 100%;\n    height: 20px;\n}'		
	},
	
	bluetext: {
		width: 				200,
		height: 			150,
		random: 			false,
		circularimage:		false,
		firstimage:			false,
		showtitle: 			true,
		titlemode: 			"always",
		titleeffect: 		"fade",
		titleeffectduration: 300,
		gap: 				4,
		margin: 			0,
		borderradius: 		0,
		hoverzoomin: 		false,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(http://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    background-color: #00ccff;\n    color: #fff;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    padding: 8px;\n    position: absolute;\n    left: 8px;\n    bottom: 8px;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container img:hover {\n    opacity: 0.7;\n    filter: alpha(opacity=70);\n}'
	},

	roundcorner: {
		width: 				200,
		height: 			150,
		random: 			false,
		circularimage:		false,
		firstimage:			false,
		showtitle: 			true,
		titlemode: 			"mouseover",
		titleeffect: 		"slide",
		titleeffectduration: 300,
		gap: 				8,
		margin: 			0,
		borderradius: 		4,
		hoverzoomin: 		true,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(http://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    background-color: rgba(51, 51, 51, 0.5);\n    color: #fff;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    padding: 8px 0px;\n    position: absolute;\n    left: 0px;\n    bottom: 0px;\n    width: 100%;\n}'
	},

	border: {
		width: 				200,
		height: 			150,
		random: 			false,
		circularimage:		false,
		firstimage:			false,
		showtitle: 			false,
		titlemode: 			"mouseover",
		titleeffect: 		"slide",
		titleeffectduration: 300,
		gap: 				12,
		margin: 			10,
		borderradius: 		0,
		hoverzoomin: 		false,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(http://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    color: #fff;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    padding: 14px 0px;\n    position: absolute;\n    left: 0px;\n    bottom: 0px;\n    width: 100%;\n} \n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item {\n    border: 1px solid #aaa;\n}\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item:hover {\n    border: 1px solid #666;\n    opacity: 0.7;\n    filter: alpha(opacity=70);\n}'		
	},
	
	caption: {
		width: 				200,
		height: 			150,
		random: 			false,
		circularimage:		false,
		firstimage:			false,
		showtitle: 			true,
		titlemode: 			"always",
		titleeffect: 		"fade",
		titleeffectduration: 300,
		gap: 				8,
		margin: 			0,
		borderradius: 		0,
		hoverzoomin: 		false,
		hoverzoominvalue: 	24,
		hoverzoominduration: 180,
		videoplaybutton: 	'playvideo-64-64-0.png',
		skincss: 			'@import url(http://fonts.googleapis.com/css?family=Open+Sans);\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container {\n    text-align: center;\n    padding-bottom: 24px;\n    box-sizing: border-box;\n    -moz-box-sizing: border-box;\n    -webkit-box-sizing: border-box;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container img {\n    width: auto !important;\n    max-height: 100%;\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-container img:hover {\n    opacity: 0.7;\n    filter: alpha(opacity=70);\n}\n\n#wonderplugingridgallery-GRIDGALLERYID .wonderplugin-gridgallery-item-text {\n    color: #333;\n    text-align: center;\n    font: 14px "open sans", Arial, Helvetica, sans-serif;\n    margin: 0px auto;\n    position: absolute;\n    left: 0px;\n    bottom: 0px;\n    width: 100%;\n    height: 20px;\n}'		
	}
};

var WONDERPLUGIN_GRIDGALLERY_SKIN_TEMPLATE = {
	tiles : {
		responsive: 		true,
		column:				4,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		3,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		2,
		smallscreensize: 	600
	},
	
	focus : {
		responsive: 		true,
		column:				4,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		3,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		2,
		smallscreensize: 	600
	},
	
	feature : {
		responsive: 		true,
		column:				4,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		3,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		2,
		smallscreensize: 	600
	},
	
	collage : {
		responsive: 		true,
		column:				4,
		gridtemplate: 		'<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		3,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		2,
		smallscreensize: 	600
	},
	
	threecolumns: {
		responsive: 		true,
		column:				3,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		2,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		1,
		smallscreensize: 	600
	},
	
	showcase : {
		responsive: 		true,
		column:				3,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		2,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		1,
		smallscreensize: 	600
	},
	
	highlight: {
		responsive: 		true,
		column:				3,
		gridtemplate: 		'<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="2" data-col="2"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		2,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		1,
		smallscreensize: 	600
	},
	
	wall : {
		responsive: 		true,
		column:				3,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="2"></div>\n<div data-row="1" data-col="2"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		2,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		1,
		smallscreensize: 	600
	},
	
	header : {
		responsive: 		true,
		column:				3,
		gridtemplate: 		'<div data-row="1" data-col="3"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>\n<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		2,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		1,
		smallscreensize: 	600
	},
	
	fivecolumns : {
		responsive: 		true,
		column:				5,
		gridtemplate: 		'<div data-row="1" data-col="1"></div>',
		mediumscreen: 		true,
		mediumcolumn:		3,
		mediumscreensize: 	800,
		smallscreen: 		true,
		smallcolumn:		2,
		smallscreensize: 	600
	},
};