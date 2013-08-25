/**
	Home page scripts
*/

$('#popover-rootpermissioninfo').popover({
	html : true,
	placement : 'bottom',
	trigger : 'hover',
	title : function() {
		return $("#popover-rootpermissioninfo-head").html();
	},
	content : function() {
		return $("#popover-rootpermissioninfo-body").html();
	}
});