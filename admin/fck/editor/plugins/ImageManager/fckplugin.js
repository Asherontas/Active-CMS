// ================================================
// Image Manager FCKeditor interface (IE & Gecko)
// ================================================
// Plugin Interface: Brent Kelly - Zeald.com
// (c)2005 All rights reserved.
// ================================================
// Integrates FCKeditor with:
// PHP image manager http://www.zhuo.org/htmlarea/
// ================================================
// Revision: 1.0                   Date: 06/03/2005
// $Id: fckplugin.js,v 1.4 2006/12/21 20:47:55 thierrybo Exp $
// ================================================
var _editor_lang="en";var IM_directEdit=false;var FCKImageManager=function(a){this.Name=a};FCKImageManager.prototype.GetState=function(){return FCK_TRISTATE_OFF};FCKCommands.RegisterCommand("ImageManager",new FCKImageManager("ImageManager"));var oImageManagerItem=new FCKToolbarButton("ImageManager","ImageManager",null,null,false,true);oImageManagerItem.IconPath=FCKConfig.PluginsPath+"ImageManager/icon.png";FCKToolbarItems.RegisterItem("ImageManager",oImageManagerItem);FCKImageManager.prototype.Execute=function(){ImageManager_click(FCK,null)};function ImageManager_doubleClick(a){if(a.tagName=="IMG"){FCKCommands.GetCommand("ImageManager").Execute()}}FCK.RegisterDoubleClickHandler(ImageManager_doubleClick,"IMG");function ImageManager_click(e,d){var f={};if(FCKSelection.GetType()=="Control"){var b=FCK.Selection.GetSelectedElement()}if(FCKSelection.GetType()=="Text"){var b=FCKSelection.GetParentElement()}if(b!=null&&b.nodeName.toLowerCase()=="img"){var a=b}if(a){f.f_url=a.src?a.src:"";f.f_alt=a.alt?a.alt:"";f.f_title=a.title?a.title:"";f.f_width=a.style.width?a.style.width:a.width;f.f_height=a.style.height?a.style.height:a.height;f.f_border=a.border?a.border:"";f.f_align=a.align?a.align:"";f.f_className=a.className?a.className:"";f.f_horiz=(a.hspace>=0)?a.attributes.hspace.nodeValue:"";f.f_vert=(a.vspace>=0)?f.f_vert=a.attributes.vspace.nodeValue:""}else{f=null}var c=new ImageManager();c.insert(f)}function setAttrib(c,b,e,a){if(!a&&e!=null){var d=new RegExp("[^0-9%]","g");e=e.replace(d,"")}if(e!=null&&e!=""){c.setAttribute(b,e)}else{c.removeAttribute(b)}}function ImageManager(){}ImageManager.prototype.insert=function(d){if(IM_directEdit){var a=FCK.Selection.GetSelectedElement();if(a!=null&&a.nodeName.toLowerCase()=="img"){lastSlashPosition=a.src.lastIndexOf("/")+1;imgFileName=a.src.substring(lastSlashPosition);var b=FCKConfig.PluginsPath+"ImageManager/editor.php?img=/"+imgFileName;Dialog(b,null,d)}else{alert("no image selected");return false}}else{var c=FCKConfig.PluginsPath+"ImageManager/manager.php";Dialog(c,function(g){if(!g){return false}var f=FCK.Selection.GetSelectedElement();if(f!=null&&f.nodeName.toLowerCase()=="img"){var e=f}if(!e){e=FCK.CreateElement("IMG")}setAttrib(e,"_fcksavedurl",g.f_url,true);setAttrib(e,"src",g.f_url,true);setAttrib(e,"alt",g.f_alt,true);setAttrib(e,"title",g.f_title,true);setAttrib(e,"align",g.f_align,true);setAttrib(e,"border",g.f_border);setAttrib(e,"hspace",g.f_horiz);setAttrib(e,"vspace",g.f_vert);setAttrib(e,"width",g.f_width);setAttrib(e,"height",g.f_height);setAttrib(e,"className",g.f_className,true);return},d)}};function Dialog(a,b,c){if(typeof c=="undefined"){c=window}Dialog._geckoOpenModal(a,b,c)}Dialog._parentEvent=function(a){setTimeout(function(){if(Dialog._modal&&!Dialog._modal.closed){Dialog._modal.focus()}},50);if(Dialog._modal&&!Dialog._modal.closed){Dialog._stopEvent(a)}};Dialog._return=null;Dialog._modal=null;Dialog._arguments=null;Dialog._geckoOpenModal=function(a,c,j){var f="hadialog"+a;var h=/\W/g;f=f.replace(h,"_");var g=window.open(a,f,"toolbar=no,menubar=no,personalbar=no,width=10,height=10,scrollbars=no,resizable=yes,modal=yes,dependable=yes");Dialog._modal=g;Dialog._arguments=j;function b(i){Dialog._addEvent(i,"click",Dialog._parentEvent);Dialog._addEvent(i,"mousedown",Dialog._parentEvent);Dialog._addEvent(i,"focus",Dialog._parentEvent)}function e(i){Dialog._removeEvent(i,"click",Dialog._parentEvent);Dialog._removeEvent(i,"mousedown",Dialog._parentEvent);Dialog._removeEvent(i,"focus",Dialog._parentEvent)}b(window.document);for(var d=0;d<window.frames.length;b(window.frames[d++].document)){}Dialog._return=function(l){if(l&&c){c(l)}e(window.document);for(var k=0;k<window.frames.length;e(window.frames[k++].document)){}Dialog._modal=null}};Dialog._addEvent=function(a,c,b){if(Dialog.is_ie){a.attachEvent("on"+c,b)}else{a.addEventListener(c,b,true)}};Dialog._removeEvent=function(a,c,b){if(Dialog.is_ie){a.detachEvent("on"+c,b)}else{a.removeEventListener(c,b,true)}};Dialog._stopEvent=function(a){if(Dialog.is_ie){a.cancelBubble=true;a.returnValue=false}else{a.preventDefault();a.stopPropagation()}};Dialog.agt=navigator.userAgent.toLowerCase();Dialog.is_ie=((Dialog.agt.indexOf("msie")!=-1)&&(Dialog.agt.indexOf("opera")==-1));