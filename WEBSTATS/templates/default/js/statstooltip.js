/////////////////////////////////////////////
// TOOLTIP CONFIGURABLES

var ttname = "tooltip";
var ttborder = "2px solid #FFCC33";
var ttpadding = "5px";
var ttbgcolor = "black";
var ttzindex = "100";

/////////////////////////////////////////////

document.write("<div id=\"" + ttname + "\" style=\"position: absolute; border: " + ttborder + "; padding: " + ttpadding + "; background-color: " + ttbgcolor + "; layer-background-color: " + ttbgcolor + "; visibility: hidden; z-index: " + ttzindex + "; filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);\"></div>");

var tipobj = "";
var offsetxpoint = -60; //Customize x offset of tooltip
var offsetypoint = 20; //Customize y offset of tooltip
var ie = document.all;
var ns6 = document.getElementById && !document.all;
var enabletip = false;

if (ie || ns6)
{
	tipobj = document.all ? document.all[ttname] : document.getElementById ? document.getElementById(ttname) : "";
}

function ietruebody()
{
	return (document.compatMode && document.compatMode != "BackCompat") ? document.documentElement : document.body;
}

function showtip(tiptext)
{
	if (ns6 || ie)
	{
		tipobj.style.backgroundColor = ttbgcolor;
		tipobj.innerHTML = tiptext;
		enabletip = true;
		return false;
	}
}

function positiontip(e)
{
	if (enabletip)
	{
		var curX = (ns6) ? e.pageX : event.clientX + ietruebody().scrollLeft;
		var curY = (ns6) ? e.pageY : event.clientY + ietruebody().scrollTop;

		//Find out how close the mouse is to the corner of the window
		var rightedge = ie && !window.opera ? ietruebody().clientWidth - event.clientX - offsetxpoint : window.innerWidth - e.clientX - offsetxpoint - 20;
		var bottomedge = ie && !window.opera ? ietruebody().clientHeight - event.clientY - offsetypoint : window.innerHeight - e.clientY - offsetypoint - 20;
		
		var leftedge = (offsetxpoint < 0) ? offsetxpoint * (-1) : -1000;
		
		//if the horizontal distance isn't enough to accomodate the width of the context menu
		if (rightedge < tipobj.offsetWidth)
		{
			//move the horizontal position of the menu to the left by it's width
			tipobj.style.left = ie ? ietruebody().scrollLeft+event.clientX - tipobj.offsetWidth + "px" : window.pageXOffset + e.clientX - tipobj.offsetWidth + "px";
		}
		else if (curX < leftedge)
		{
			tipobj.style.left = "5px";
		}
		else
		{
			//position the horizontal position of the menu where the mouse is positioned
			tipobj.style.left = curX + offsetxpoint + "px";
		}
		
		//same concept with the vertical position
		if (bottomedge < tipobj.offsetHeight)
		{
			tipobj.style.top = ie ? ietruebody().scrollTop + event.clientY - tipobj.offsetHeight - offsetypoint + "px" : window.pageYOffset + e.clientY - tipobj.offsetHeight - offsetypoint + "px";
		}
		else
		{
			tipobj.style.top = curY + offsetypoint + "px";
		}
		
		tipobj.style.visibility = "visible";
	}
}

function hidetip()
{
	if (ns6 || ie)
	{
		enabletip = false;
		tipobj.style.visibility = "hidden";
		tipobj.style.left = "-1000px";
		tipobj.style.backgroundColor = '';
		tipobj.style.width = '';
	}
}

document.onmousemove = positiontip;
