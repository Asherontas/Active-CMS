// Dialog v3.0 - Copyright (c) 2003-2004 interactivetools.com, inc.
// This copyright notice MUST stay intact for use (see license.txt).
//
// Portions (c) dynarch.com, 2003-2004
//
// A free WYSIWYG editor replacement for <textarea> fields.
// For full source code and docs, visit http://www.interactivetools.com/
//
// Version 3.0 developed by Mihai Bazon.
//   http://dynarch.com/mishoo
function Dialog(a,b,c){if(typeof c=="undefined"){c=window}Dialog._geckoOpenModal(a,b,c)}Dialog._parentEvent=function(a){setTimeout(function(){if(Dialog._modal&&!Dialog._modal.closed){Dialog._modal.focus()}},50);if(Dialog._modal&&!Dialog._modal.closed){Dialog._stopEvent(a)}};Dialog._return=null;Dialog._modal=null;Dialog._arguments=null;Dialog._geckoOpenModal=function(a,c,j){var f="hadialog"+a;var h=/\W/g;f=f.replace(h,"_");var g=window.open(a,f,"toolbar=no,menubar=no,personalbar=no,width=10,height=10,scrollbars=no,resizable=yes,modal=yes,dependable=yes");Dialog._modal=g;Dialog._arguments=j;function b(i){Dialog._addEvent(i,"click",Dialog._parentEvent);Dialog._addEvent(i,"mousedown",Dialog._parentEvent);Dialog._addEvent(i,"focus",Dialog._parentEvent)}function e(i){Dialog._removeEvent(i,"click",Dialog._parentEvent);Dialog._removeEvent(i,"mousedown",Dialog._parentEvent);Dialog._removeEvent(i,"focus",Dialog._parentEvent)}b(window.document);for(var d=0;d<window.frames.length;b(window.frames[d++].document)){}Dialog._return=function(l){if(l&&c){c(l)}e(window.document);for(var k=0;k<window.frames.length;e(window.frames[k++].document)){}Dialog._modal=null}};Dialog._addEvent=function(a,c,b){if(Dialog.is_ie){a.attachEvent("on"+c,b)}else{a.addEventListener(c,b,true)}};Dialog._removeEvent=function(a,c,b){if(Dialog.is_ie){a.detachEvent("on"+c,b)}else{a.removeEventListener(c,b,true)}};Dialog._stopEvent=function(a){if(Dialog.is_ie){a.cancelBubble=true;a.returnValue=false}else{a.preventDefault();a.stopPropagation()}};Dialog.agt=navigator.userAgent.toLowerCase();Dialog.is_ie=((Dialog.agt.indexOf("msie")!=-1)&&(Dialog.agt.indexOf("opera")==-1));