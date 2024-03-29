﻿/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2009 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * Scripts for the fck_select.html page.
 */
function Select(b){var a=b.selectedIndex;oListText.selectedIndex=a;oListValue.selectedIndex=a;var d=document.getElementById("txtText");var c=document.getElementById("txtValue");d.value=oListText.value;c.value=oListValue.value}function Add(){var b=document.getElementById("txtText");var a=document.getElementById("txtValue");AddComboOption(oListText,b.value,b.value);AddComboOption(oListValue,a.value,a.value);oListText.selectedIndex=oListText.options.length-1;oListValue.selectedIndex=oListValue.options.length-1;b.value="";a.value="";b.focus()}function Modify(){var a=oListText.selectedIndex;if(a<0){return}var c=document.getElementById("txtText");var b=document.getElementById("txtValue");oListText.options[a].innerHTML=HTMLEncode(c.value);oListText.options[a].value=c.value;oListValue.options[a].innerHTML=HTMLEncode(b.value);oListValue.options[a].value=b.value;c.value="";b.value="";c.focus()}function Move(a){ChangeOptionPosition(oListText,a);ChangeOptionPosition(oListValue,a)}function Delete(){RemoveSelectedOptions(oListText);RemoveSelectedOptions(oListValue)}function SetSelectedValue(){var a=oListValue.selectedIndex;if(a<0){return}var b=document.getElementById("txtSelValue");b.value=oListValue.options[a].value}function ChangeOptionPosition(e,b){var a=e.selectedIndex;if(a<0){return}var f=a+b;if(f<0){f=0}if(f>(e.options.length-1)){f=e.options.length-1}if(a==f){return}var d=e.options[a];var c=HTMLDecode(d.innerHTML);var g=d.value;e.remove(a);d=AddComboOption(e,c,g,null,f);d.selected=true}function RemoveSelectedOptions(d){var a=d.selectedIndex;var b=d.options;for(var c=b.length-1;c>=0;c--){if(b[c].selected){d.remove(c)}}if(d.options.length>0){if(a>=d.options.length){a=d.options.length-1}d.selectedIndex=a}}function AddComboOption(d,f,e,a,b){var c;if(a){c=a.createElement("OPTION")}else{c=document.createElement("OPTION")}if(b!=null){d.options.add(c,b)}else{d.options.add(c)}c.innerHTML=f.length>0?HTMLEncode(f):"&nbsp;";c.value=e;return c}function HTMLEncode(a){if(!a){return""}a=a.replace(/&/g,"&amp;");a=a.replace(/</g,"&lt;");a=a.replace(/>/g,"&gt;");return a}function HTMLDecode(a){if(!a){return""}a=a.replace(/&gt;/g,">");a=a.replace(/&lt;/g,"<");a=a.replace(/&amp;/g,"&");return a};
