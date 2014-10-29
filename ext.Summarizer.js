var i18n = new Array();
i18n["delSum"] = "";
i18n["printVers"] = "";
switch (wgUserLanguage)
{
case 'de':
  i18n["delSum"] = "Zusammenfassung löschen";
  i18n["printVers"] = "Druckversion";
  break;
default:
  i18n["delSum"] = "Delete summary";
  i18n["printVers"] = "Print version"
}

var marker ='WLmarker'+wgUserId;
var sstore=localStorage.getItem(marker);
if (!(!sstore || (sstore.length === 0))){
	var content;
	var buttons;
	var url;
	url=wgServer+wgScript+'/'+wgPageName+'?printable=yes';

	content ='<div id="summary" contenteditable="true" >';
	content +=sstore;
	content +='</div>';

	buttons   ='<div id="summarybuttons">';
	buttons +='<form><input type="button" name="delSummary" value="'+i18n["delSum"]+'" onclick="';
	buttons += 'localStorage.setItem(\''+marker+'\',\'\'); document.getElementById(\'summary\').innerHTML=\'\';';
	buttons +='">';
	buttons +='<input type="button" name="printSummary" value="'+i18n["printVers"]+'" onclick="window.location.href=\''+url+'\'">';
	buttons += '</form>';
	buttons += '</div>';

	document.getElementById("summarycontainer").innerHTML=content+buttons;

	document.getElementById("summary").addEventListener("input", function() {localStorage.setItem(marker,document.getElementById("summary").innerHTML);}, false);

}



