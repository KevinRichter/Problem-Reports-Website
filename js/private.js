// Dynamically add the CSS for flyout menus. If JS is not loaded, the superfish.css isn't loaded either. This allows the flyout menus to work without JS enabled.
(function () {
	var head = document.getElementsByTagName("head")[0];
	if (head) {
		var scriptStyles = document.createElement("link");
		scriptStyles.rel = "stylesheet";
		scriptStyles.type = "text/css";
		scriptStyles.href = "http://www.csus.edu/webpages/template_seafoam2/css/superfish.css";
		scriptStyles.charset = "utf-8";
		scriptStyles.media = "screen";
		head.appendChild(scriptStyles);
	}
}());


$(document).ready(function(){ 

  // Add classes to flyout menus that allow them to work. 
	//For more info, see http://users.tpg.com.au/j_birch/plugins/superfish/
	$("ul.sf-menu").superfish(	{ 
		delay:       100,  
		dropShadows: false
	}); 

  // Accessibility features. Optional, but recommended. They should have no impact on design.
	$('#search').attr('role', 'search');
	$('#main_content').attr('role', 'main');
	$('.navigation').attr('role', 'navigation');
	$('.banner').attr('role', 'banner');
	$('.footer').attr('role', 'contentinfo'); 
	
}); 