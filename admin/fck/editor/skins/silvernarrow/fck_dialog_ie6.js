﻿/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2008 Frederico Caldeira Knabben
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
 */
(function(){var e=window.DoResizeFixes=function(){var f=window.document.body;for(var g=0;g<f.childNodes.length;g++){var h=f.childNodes[g];switch(h.className){case"contents":h.style.width=Math.max(0,f.offsetWidth-16-16);h.style.height=Math.max(0,f.clientHeight-20-2);break;case"blocker":case"cover":h.style.width=Math.max(0,f.offsetWidth-16-16+4);h.style.height=Math.max(0,f.clientHeight-20-2+4);break;case"tr":h.style.left=Math.max(0,f.clientWidth-16);break;case"tc":h.style.width=Math.max(0,f.clientWidth-16-16);break;case"ml":h.style.height=Math.max(0,f.clientHeight-16-51);break;case"mr":h.style.left=Math.max(0,f.clientWidth-16);h.style.height=Math.max(0,f.clientHeight-16-51);break;case"bl":h.style.top=Math.max(0,f.clientHeight-51);break;case"br":h.style.left=Math.max(0,f.clientWidth-30);h.style.top=Math.max(0,f.clientHeight-51);break;case"bc":h.style.width=Math.max(0,f.clientWidth-30-30);h.style.top=Math.max(0,f.clientHeight-51);break}}};var d=function(){this.style.backgroundPosition="-16px -687px"};var c=function(){this.style.backgroundPosition="-16px -651px"};var a=function(){var f=document.getElementById("closeButton");f.onmouseover=d;f.onmouseout=c};var b=function(){e();a();window.attachEvent("onresize",e);window.detachEvent("onload",b)};window.attachEvent("onload",b)})();