/*
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
 * This is the integration file for JavaScript.
 *
 * It defines the FCKeditor class that can be used to create editor
 * instances in a HTML page in the client side. For server side
 * operations, use the specific integration system.
 */

// FCKeditor Class
var FCKeditor=function(b,d,a,c,e){this.InstanceName=b;this.Width=d||"100%";this.Height=a||"200";this.ToolbarSet=c||"Default";this.Value=e||"";this.BasePath=FCKeditor.BasePath;this.CheckBrowser=true;this.DisplayErrors=true;this.Config=new Object();this.OnError=null};FCKeditor.BasePath="/fckeditor/";FCKeditor.MinHeight=200;FCKeditor.MinWidth=750;FCKeditor.prototype.Version="2.6.5";FCKeditor.prototype.VersionBuild="23959";FCKeditor.prototype.Create=function(){document.write(this.CreateHtml())};FCKeditor.prototype.CreateHtml=function(){if(!this.InstanceName||this.InstanceName.length==0){this._ThrowError(701,"You must specify an instance name.");return""}var c="";if(!this.CheckBrowser||this._IsCompatibleBrowser()){c+='<input type="hidden" id="'+this.InstanceName+'" name="'+this.InstanceName+'" value="'+this._HTMLEncode(this.Value)+'" style="display:none" />';c+=this._GetConfigHtml();c+=this._GetIFrameHtml()}else{var b=this.Width.toString().indexOf("%")>0?this.Width:this.Width+"px";var a=this.Height.toString().indexOf("%")>0?this.Height:this.Height+"px";c+='<textarea name="'+this.InstanceName+'" rows="4" cols="40" style="width:'+b+";height:"+a;if(this.TabIndex){c+='" tabindex="'+this.TabIndex}c+='">'+this._HTMLEncode(this.Value)+"</textarea>"}return c};FCKeditor.prototype.ReplaceTextarea=function(){if(document.getElementById(this.InstanceName+"___Frame")){return}if(!this.CheckBrowser||this._IsCompatibleBrowser()){var c=document.getElementById(this.InstanceName);var b=document.getElementsByName(this.InstanceName);var a=0;while(c||a==0){if(c&&c.tagName.toLowerCase()=="textarea"){break}c=b[a++]}if(!c){alert('Error: The TEXTAREA with id or name set to "'+this.InstanceName+'" was not found');return}c.style.display="none";if(c.tabIndex){this.TabIndex=c.tabIndex}this._InsertHtmlBefore(this._GetConfigHtml(),c);this._InsertHtmlBefore(this._GetIFrameHtml(),c)}};FCKeditor.prototype._InsertHtmlBefore=function(c,b){if(b.insertAdjacentHTML){b.insertAdjacentHTML("beforeBegin",c)}else{var d=document.createRange();d.setStartBefore(b);var a=d.createContextualFragment(c);b.parentNode.insertBefore(a,b)}};FCKeditor.prototype._GetConfigHtml=function(){var a="";for(var b in this.Config){if(a.length>0){a+="&amp;"}a+=encodeURIComponent(b)+"="+encodeURIComponent(this.Config[b])}return'<input type="hidden" id="'+this.InstanceName+'___Config" value="'+a+'" style="display:none" />'};FCKeditor.prototype._GetIFrameHtml=function(){var d="fckeditor.html";try{if((/fcksource=true/i).test(window.top.location.search)){d="fckeditor.original.html"}}catch(c){}var a=this.BasePath+"editor/"+d+"?InstanceName="+encodeURIComponent(this.InstanceName);if(this.ToolbarSet){a+="&amp;Toolbar="+this.ToolbarSet}var b='<iframe id="'+this.InstanceName+'___Frame" src="'+a+'" width="'+this.Width+'" height="'+this.Height;if(this.TabIndex){b+='" tabindex="'+this.TabIndex}b+='" frameborder="0" scrolling="no"></iframe>';return b};FCKeditor.prototype._IsCompatibleBrowser=function(){return FCKeditor_IsCompatibleBrowser()};FCKeditor.prototype._ThrowError=function(b,a){this.ErrorNumber=b;this.ErrorDescription=a;if(this.DisplayErrors){document.write('<div style="COLOR: #ff0000">');document.write("[ FCKeditor Error "+this.ErrorNumber+": "+this.ErrorDescription+" ]");document.write("</div>")}if(typeof(this.OnError)=="function"){this.OnError(this,b,a)}};FCKeditor.prototype._HTMLEncode=function(a){if(typeof(a)!="string"){a=a.toString()}a=a.replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/</g,"&lt;").replace(/>/g,"&gt;");return a};(function(){var a=function(b){var c=new FCKeditor(b.name);c.Width=Math.max(b.offsetWidth,FCKeditor.MinWidth);c.Height=Math.max(b.offsetHeight,FCKeditor.MinHeight);return c};FCKeditor.ReplaceAllTextareas=function(){var b=document.getElementsByTagName("textarea");for(var e=0;e<b.length;e++){var f=null;var c=b[e];var d=c.name;if(!d||d.length==0){continue}if(typeof arguments[0]=="string"){var g=new RegExp("(?:^| )"+arguments[0]+"(?:$| )");if(!g.test(c.className)){continue}}else{if(typeof arguments[0]=="function"){f=a(c);if(arguments[0](c,f)===false){continue}}}if(!f){f=a(c)}f.ReplaceTextarea()}}})();function FCKeditor_IsCompatibleBrowser(){var sAgent=navigator.userAgent.toLowerCase();if(
false&&sAgent.indexOf("mac")==-1){var sBrowserVersion=navigator.appVersion.match(/MSIE (.\..)/)[1];return(sBrowserVersion>=5.5)}if(navigator.product=="Gecko"&&navigator.productSub>=20030210&&!(typeof(opera)=="object"&&opera.postError)){return true}if(window.opera&&window.opera.version&&parseFloat(window.opera.version())>=9.5){return true}if(sAgent.indexOf(" adobeair/")!=-1){return(sAgent.match(/ adobeair\/(\d+)/)[1]>=1)}if(sAgent.indexOf(" applewebkit/")!=-1){return(sAgent.match(/ applewebkit\/(\d+)/)[1]>=522)}return false};