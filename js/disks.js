/**
	Disks page scripts
*/

$('.popover-requirerootpermission-disks').popover({
	html : true,
	placement : 'bottom',
	trigger : 'hover',
	title : function() {
		return $("#popover-requirerootpermission-disks-head").html();
	},
	content : function() {
		return $("#popover-requirerootpermission-disks-body").html();
	}
});

function changepartitionstatus(partitionname, currmountpoint)
{
	if (currmountpoint != null && currmountpoint != "")
	{
		window.location = "?page=disks&changepartitionstatus=" + partitionname;
	}
	else
	{
		var mountpoint = prompt("Specify mount point", "");
		if (mountpoint != null && mountpoint != "")
		{
			window.location = "?page=disks&changepartitionstatus=" + partitionname + "&mountpoint=" + mountpoint;	
		}
		else
		{
			alert("You need to specify a mount point");
		}
	}
}