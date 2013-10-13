/////////////////////////////////////////////
// COMBOBOX CONFIGURABLES

var cbname = "statscmb";
var cbborder = "2px solid #FFCC33";
var cbpadding = "5px";
var cbbgcolor = "black";
var cbzindex = "100";

/////////////////////////////////////////////

document.write("<div onmouseover=\"showcmbplain();\" onmouseout=\"hidecmb();\" id=\"" + cbname + "\" style=\"position: absolute; border: " + cbborder + "; padding: " + cbpadding + "; background-color: " + cbbgcolor + "; layer-background-color: " + cbbgcolor + "; visibility: hidden; z-index: " + cbzindex + "; filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);\"></div>");

var cmbobj = "";
var ie = document.all;
var ns6 = document.getElementById && !document.all;
var enablecmb = false;

if (ie || ns6)
{
	cmbobj = document.all ? document.all[cbname] : document.getElementById ? document.getElementById(cbname) : "";
}

function showcmbplain()
{
	if (ns6 || ie)
	{
		cmbobj.style.backgroundColor = cbbgcolor;
		enablecmb = true;
		cmbobj.style.visibility = "visible";

		return false;
	}
}

function showcmb(elem, cmbtext)
{
	if (ns6 || ie)
	{
		cmbobj.style.backgroundColor = cbbgcolor;
		if (cmbtext.length > 0) cmbobj.innerHTML = cmbtext;
		enablecmb = true;
		if (elem != null)
		{
			var pos = getPos(elem);
			cmbobj.style.left = pos.left + "px";
			cmbobj.style.top = (pos.top + elem.offsetHeight) + "px";
		}
		cmbobj.style.visibility = "visible";

		return false;
	}
}

function hidecmb()
{
	if (ns6 || ie)
	{
		enablecmb = false;
		cmbobj.style.visibility = "hidden";
		cmbobj.style.backgroundColor = '';
		cmbobj.style.width = '';
	}
}

function getPos(elem)
{
	var retval = new Object();
	retval.left = 0;
	retval.top = 0;

	while (elem != null)
	{
		retval.left += elem.offsetLeft;
		retval.top += elem.offsetTop;
		elem = elem.offsetParent;
	}

	return retval;
}
