/**
	Services page scripts
*/

$('.popover-requirerootpermission-services').popover({
	html : true,
	placement : 'bottom',
	trigger : 'hover',
	title : function() {
		return $("#popover-requirerootpermission-services-head").html();
	},
	content : function() {
		return $("#popover-requirerootpermission-services-body").html();
	}
});