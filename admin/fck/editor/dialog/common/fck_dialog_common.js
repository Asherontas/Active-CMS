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
 * Useful functions used by almost all dialog window pages.
 * Dialogs should link to this file as the very first script on the page.
 */

// Automatically detect the correct document.domain (#123).
(function(){var b=document.domain;while(true){try{var c=window.parent.document.domain;break}catch(a){}b=b.replace(/.*?(?:\.|$)/,"");if(b.length==0){break}try{document.domain=b}catch(a){break}}})();function GetCommonDialogCss(a){return FCKConfig.BasePath+"dialog/common/|.ImagePreviewArea{border:#000 1px solid;overflow:auto;width:100%;height:170px;background-color:#fff}.FlashPreviewArea{border:#000 1px solid;padding:5px;overflow:auto;width:100%;height:170px;background-color:#fff}.BtnReset{float:left;background-position:center center;background-image:url(images/reset.gif);width:16px;height:16px;background-repeat:no-repeat;border:1px none;font-size:1px}.BtnLocked,.BtnUnlocked{float:left;background-position:center center;background-image:url(images/locked.gif);width:16px;height:16px;background-repeat:no-repeat;border:none 1px;font-size:1px}.BtnUnlocked{background-image:url(images/unlocked.gif)}.BtnOver{border:outset 1px;cursor:pointer;cursor:hand}"}function GetE(a){return document.getElementById(a)}function ShowE(b,a){if(typeof(b)=="string"){b=GetE(b)}b.style.display=a?"":"none"}function SetAttribute(b,c,a){if(a==null||a.length==0){b.removeAttribute(c,0)}else{b.setAttribute(c,a,0)}}function GetAttribute(c,e,a){var d=c.attributes[e];if(d==null||!d.specified){return a?a:""}var b=c.getAttribute(e,2);if(b==null){b=d.nodeValue}return(b==null?a:b)}function SelectField(a){var b=GetE(a);b.focus();if(b.select){b.select()}}var IsDigit=(function(){var a={End:35,Home:36,Left:37,Right:39,"U+00007F":46};return function(c){if(!c){c=event}var b=(c.keyCode||c.charCode);if(!b&&c.keyIdentifier&&(c.keyIdentifier in a)){b=a[c.keyIdentifier]}return((b>=48&&b<=57)||(b>=35&&b<=40)||b==8||b==46||b==9)}})();String.prototype.Trim=function(){return this.replace(/(^\s*)|(\s*$)/g,"")};String.prototype.StartsWith=function(a){return(this.substr(0,a.length)==a)};String.prototype.Remove=function(c,b){var a="";if(c>0){a=this.substring(0,c)}if(c+b<this.length){a+=this.substring(c+b,this.length)}return a};String.prototype.ReplaceAll=function(d,b){var c=this;for(var a=0;a<d.length;a++){c=c.replace(d[a],b[a])}return c};function OpenFileBrowser(c,d,a){var f=(oEditor.FCKConfig.ScreenWidth-d)/2;var e=(oEditor.FCKConfig.ScreenHeight-a)/2;var b="toolbar=no,status=no,resizable=yes,dependent=yes,scrollbars=yes";b+=",width="+d;b+=",height="+a;b+=",left="+f;b+=",top="+e;window.open(c,"FCKBrowseWindow",b)}function CreateNamedElement(l,b,k,d){var j;var f=null;if(b&&l.FCKBrowserInfo.IsIE){var g=false;for(var i in d){g|=(b.getAttribute(i,2)!=d[i])}if(g){f=b;b=null}}if(b){j=b}else{if(l.FCKBrowserInfo.IsIE){var c=[];c.push("<"+k);for(var a in d){c.push(" "+a+'="'+d[a]+'"')}c.push(">");if(!l.FCKListsLib.EmptyElements[k.toLowerCase()]){c.push("</"+k+">")}j=l.FCK.EditorDocument.createElement(c.join(""));if(f){CopyAttributes(f,j,d);l.FCKDomTools.MoveChildren(f,j);f.parentNode.removeChild(f);f=null;if(l.FCK.Selection.SelectionData){var e=l.FCK.EditorDocument.selection;l.FCK.Selection.SelectionData=e.createRange()}}j=l.FCK.InsertElement(j);if(l.FCK.Selection.SelectionData){var h=l.FCK.EditorDocument.body.createControlRange();h.add(j);l.FCK.Selection.SelectionData=h}}else{j=l.FCK.InsertElement(k)}}for(var i in d){j.setAttribute(i,d[i],0)}return j}function CopyAttributes(b,e,d){var a=b.attributes;for(var h=0;h<a.length;h++){var g=a[h];if(g.specified){var f=g.nodeName;if(f in d){continue}var c=b.getAttribute(f,2);if(c==null){c=g.nodeValue}e.setAttribute(f,c,0)}}if(b.style.cssText!==""){e.style.cssText=b.style.cssText}}function RenameNode(d,c){if(d.nodeType!=1){return null}if(d.nodeName==c){return d}var a=d.ownerDocument;var b=a.createElement(c);CopyAttributes(d,b,{});FCKDomTools.MoveChildren(d,b);d.parentNode.replaceChild(b,d);return b};