/* This notice must be untouched at all times.

wz_dragdrop.js	v. 4.85
The latest version is available at
http://www.walterzorn.com
or http://www.devira.com
or http://www.walterzorn.de

Copyright (c) 2002-2003 Walter Zorn. All rights reserved.
Created 26. 8. 2002 by Walter Zorn (Web: http://www.walterzorn.com )
Last modified: 10. 2. 2006

For more details on the GNU Lesser General Public License,
see http://www.gnu.org/copyleft/lesser.html
*/
var spacer="img/transparentpixel.gif";var CLONE="C10nE";var COPY="C0pY";var DETACH_CHILDREN="d37aCH";var HORIZONTAL="H0r1Z";var MAXHEIGHT="m7x8I";var MAXOFFBOTTOM="m7xd0wN";var MAXOFFLEFT="m7x23Ft";var MAXOFFRIGHT="m7x0Ff8";var MAXOFFTOP="m7xu9";var MAXWIDTH="m7xW1";var MINWIDTH="m1nw1";var MINHEIGHT="m1n8I";var NO_ALT="no81T";var NO_DRAG="N0d4Ag";var RESET_Z="r35E7z";var RESIZABLE="r5IZbl";var SCALABLE="SCLbl";var SCROLL="sC8lL";var TRANSPARENT="dIApHAn";var VERTICAL="V3Rt1C";var dd_cursors=new Array("c:default","c:crosshair","c:e-resize","c:hand","c:help","c:move","c:n-resize","c:ne-resize","c:nw-resize","c:s-resize","c:se-resize","c:sw-resize","c:text","c:w-resize","c:wait");var dd_i=dd_cursors.length;while(dd_i--){eval("var CURSOR_"+(dd_cursors[dd_i].substring(2).toUpperCase().replace("-","_"))+' = "'+dd_cursors[dd_i]+'";')}var dd_u="undefined";function WZDD(){this.elements=new Array(0);this.obj=null;this.n=navigator.userAgent.toLowerCase();this.db=(document.compatMode&&document.compatMode.toLowerCase()!="backcompat")?document.documentElement:(document.body||null);this.op=!!(window.opera&&document.getElementById);if(this.op){document.onmousedown=new Function("e",'if(((e = e || window.event).target || e.srcElement).tagName == "IMAGE") return false;')}this.ie=!!(this.n.indexOf("msie")>=0&&document.all&&this.db&&!this.op);this.iemac=!!(this.ie&&this.n.indexOf("mac")>=0);this.ie4=!!(this.ie&&!document.getElementById);this.n4=!!(document.layers&&typeof document.classes!=dd_u);this.n6=!!(typeof window.getComputedStyle!=dd_u&&typeof document.createRange!=dd_u);this.w3c=!!(!this.op&&!this.ie&&!this.n6&&document.getElementById);this.ce=!!(document.captureEvents&&document.releaseEvents);this.px=this.n4?"":"px";this.tiv=this.w3c?40:10}var dd=new WZDD();dd.Int=function(b,a){return isNaN(a=parseInt(b))?0:a};dd.getWndW=function(){return dd.Int((dd.db&&!dd.op&&!dd.w3c&&dd.db.clientWidth)?dd.db.clientWidth:(window.innerWidth||0))};dd.getWndH=function(){return dd.Int((dd.db&&!dd.op&&!dd.w3c&&dd.db.clientHeight)?dd.db.clientHeight:(window.innerHeight||0))};dd.getScrollX=function(){return dd.Int(window.pageXOffset||(dd.db?dd.db.scrollLeft:0))};dd.getScrollY=function(){return dd.Int(window.pageYOffset||(dd.db?dd.db.scrollTop:0))};dd.getPageXY=function(a){if(dd.n4&&a){dd.x=a.pageX||0;dd.y=a.pageY||0}else{dd.x=dd.y=0;while(a){dd.x+=dd.Int(a.offsetLeft);dd.y+=dd.Int(a.offsetTop);a=a.offsetParent||null}}};dd.getCssXY=function(a){if(a.div){if(dd.n4){a.cssx=a.div.x;a.cssy=a.div.y}else{if(dd.ie4){a.cssx=a.css.pixelLeft;a.cssy=a.css.pixelTop}else{a.css.left=a.css.top=0+dd.px;dd.getPageXY(a.div);a.cssx=a.x-dd.x;a.cssy=a.y-dd.y;a.css.left=a.cssx+dd.px;a.css.top=a.cssy+dd.px}}}else{a.cssx=0;a.cssy=0}};dd.getImgW=function(a){return a?dd.Int(a.width):0};dd.getImgH=function(a){return a?dd.Int(a.height):0};dd.getDivW=function(a){return dd.Int(dd.n4?(a.div?a.div.clip.width:0):a.div?(a.div.offsetWidth||a.css.pixelWidth||a.css.width||0):0)};dd.getDivH=function(a){return dd.Int(dd.n4?(a.div?a.div.clip.height:0):a.div?(a.div.offsetHeight||a.css.pixelHeight||a.css.height||0):0)};dd.getWH=function(a){a.w=dd.getDivW(a);a.h=dd.getDivH(a);if(a.css){a.css.width=a.w+dd.px;a.css.height=a.h+dd.px;a.dw=dd.getDivW(a)-a.w;a.dh=dd.getDivH(a)-a.h;a.css.width=(a.w-a.dw)+dd.px;a.css.height=(a.h-a.dh)+dd.px}else{a.dw=a.dh=0}};dd.getCssProp=function(d_o,d_pn6,d_pstyle,d_pn4){if(d_o&&dd.n6){return""+window.getComputedStyle(d_o,null).getPropertyValue(d_pn6)}if(d_o&&d_o.currentStyle){return""+eval("d_o.currentStyle."+d_pstyle)}if(d_o&&d_o.style){return""+eval("d_o.style."+d_pstyle)}if(d_o&&dd.n4){return""+eval("d_o."+d_pn4)}return""};dd.getDiv=function(d,b){b=b||document;if(dd.n4){if(b.layers[d]){return b.layers[d]}for(var a=b.layers.length;a--;){var c=dd.getDiv(d,b.layers[a].document);if(c){return c}}}if(dd.ie){return b.all[d]||null}if(b.getElementById){return b.getElementById(d)||null}return null};dd.getImg=function(d,b,g,a){a=a||window;var f;if(document.images&&(f=a.document.images[b])){if(g){if(dd.n4){dd.getPageXY(a);d.defx=f.x+dd.x;d.defy=f.y+dd.y}else{dd.getPageXY(f);d.defx=dd.x;d.defy=dd.y}}return f}if(dd.n4){for(var c=a.document.layers.length;c--;){var e=dd.getImg(d,b,g,a.document.layers[c]);if(e){return e}}}return null};dd.getParent=function(b,a){if(dd.n4){for(a,d_i=dd.elements.length;d_i--;){if(!((a=dd.elements[d_i]).is_image)&&a.div&&(a.div.document.layers[b.name]||b.oimg&&a.div.document.images[b.oimg.name])){a.addChild(b,a.detach,1)}}}else{a=b.is_image?dd.getImg(b,b.oimg.name):(b.div||null);while(a&&!!(a=a.offsetParent||a.parentNode||null)){if(a.ddObj){a.ddObj.addChild(b,a.ddObj.detach,1);break}}}};dd.getCmd=function(e,c,d){var b=e.id.indexOf(c),a,f=(b>=0)*1;if(f){a=b+c.length;if(d){e.cmd+=e.id.substring(b,a)}e.id=e.id.substring(0,b)+e.id.substring(a)}return f};dd.getCmdVal=function(f,d,e,a){var c=f.id.indexOf(d),b,g=(f.id.indexOf(d)>=0)?dd.Int(f.id.substring(f.id.indexOf(d)+d.length)):a?-1:0;if(!a&&g||a&&g>=0){b=c+d.length+(""+g).length;if(e){f.cmd+=f.id.substring(c,b)}f.id=f.id.substring(0,c)+f.id.substring(b)}return g};dd.addElt=function(b,a){dd.elements[b.name]=dd.elements[b.index=dd.elements.length]=b;if(a){a.copies[b.name]=a.copies[a.copies.length]=b}};dd.mkWzDom=function(){var c,b=dd.elements.length;while(b--){dd.getParent(dd.elements[b])}b=dd.elements.length;while(b--){c=dd.elements[b];if(c.children&&!c.parent){var a=c.children.length;while(a--){c.children[a].setZ(c.z+c.children[a].z,1)}}}};dd.addProps=function(b){var a,c;if(b.is_image){b.div=dd.getDiv(b.id);b.css=(b.div&&typeof b.div.style!=dd_u)?b.div.style:null;b.nimg=(dd.n4&&b.div)?b.div.document.images[0]:(document.images[b.id+"NI1m6G"]||null);if(!b.noalt&&!dd.noalt&&b.nimg&&b.oimg){b.nimg.alt=b.oimg.alt||"";if(b.oimg.title){b.nimg.title=b.oimg.title}}b.bgColor=""}else{b.bgColor=dd.getCssProp(b.div,"background-color","backgroundColor","bgColor").toLowerCase();if(dd.n6&&b.div){if((c=b.bgColor).indexOf("rgb")>=0){c=c.substring(4,c.length-1).split(",");b.bgColor="#";for(a=0;a<c.length;a++){b.bgColor+=parseInt(c[a]).toString(16)}}else{b.bgColor=c}}}if(dd.scalable){b.scalable=b.resizable^1}else{if(dd.resizable){b.resizable=b.scalable^1}}b.setZ(b.defz);b.cursor=b.cursor||dd.cursor||"auto";b._setCrs(b.nodrag?"auto":b.cursor);b.diaphan=b.diaphan||dd.diaphan||0;b.opacity=1;b.visible=true};dd.initz=function(){if(!(dd&&(dd.n4||dd.n6||dd.ie||dd.op||dd.w3c))){return}else{if(dd.n6||dd.ie||dd.op||dd.w3c){dd.recalc(1)}}var b=(document.onmousemove==DRAG),a=(document.onmousemove==RESIZE);if(dd.loadFunc){dd.loadFunc()}if(b){dd.setMovHdl(DRAG)}else{if(a){dd.setMovHdl(RESIZE)}}if(b||a){dd.setUpHdl(DROP)}dd.setDwnHdl(PICK)};dd.finlz=function(){if(dd.ie&&dd.elements){var a=dd.elements.length;while(a--){dd.elements[a].del()}}if(dd.uloadFunc){dd.uloadFunc()}};dd.setCe=function(b,a){a?document.captureEvents(b):document.releaseEvents(b)};dd.setDwnHdl=function(a){if(document.onmousedown!=a){dd.downFunc=document.onmousedown;document.onmousedown=a;if(dd.ce){dd.setCe(Event.MOUSEDOWN,a)}}};dd.setMovHdl=function(a){if(document.onmousemove!=a){dd.moveFunc=document.onmousemove;document.onmousemove=a;if(dd.ce){dd.setCe(Event.MOUSEMOVE,a)}}};dd.setUpHdl=function(a){if(document.onmouseup!=a){dd.upFunc=document.onmouseup;document.onmouseup=a;if(dd.ce){dd.setCe(Event.MOUSEUP,a)}}};dd.evt=function(a){this.but=(this.e=a||window.event).which||this.e.button||0;this.button=(this.e.type=="mousedown")?this.but:(dd.e&&dd.e.button)?dd.e.button:0;this.src=this.e.target||this.e.srcElement||null;this.src.tag=(""+(this.src.tagName||this.src)).toLowerCase();this.x=dd.Int(this.e.pageX||this.e.clientX||0);this.y=dd.Int(this.e.pageY||this.e.clientY||0);if(dd.ie){this.x+=dd.getScrollX()-(dd.ie&&!dd.iemac)*1;this.y+=dd.getScrollY()-(dd.ie&&!dd.iemac)*1}this.modifKey=this.e.modifiers?this.e.modifiers&Event.SHIFT_MASK:(this.e.shiftKey||false)};dd.getEventTarget=function(b,a,c){b=b||window.event;if(b&&(a=b.target||b.srcElement||null)!=null){if(null!=(c=a.id||a.name||null)){if(c.indexOf("dIi15vNI1m6G")==c.length-12){return dd.elements[c.substring(0,c.length-12)]||null}if(c.indexOf("dIi15v")==c.length-6){return dd.elements[c.substring(0,c.length-6)]||null}return dd.elements[c]||null}}return null};dd.recalc=function(c){var i,b=dd.elements.length;while(b--){if(!(i=dd.elements[b]).is_image&&i.div){dd.getWH(i);if(i.div.pos_rel){dd.getPageXY(i.div);var f=dd.x-i.x,d=dd.y-i.y;i.defx+=f;i.x+=f;i.defy+=d;i.y+=d;var h,a=i.children.length;while(a--){if(!(h=i.children[a]).detached&&(i!=h.defparent||!(h.is_image&&dd.getImg(h,h.oimg.name,1)))){h.defx+=f;h.defy+=d;h.moveBy(f,d)}}}}else{if(i.is_image&&!dd.n4){if(dd.n6&&c&&!i.defw){i.resizeTo(i.defw=dd.getImgW(i.oimg),i.defh=dd.getImgH(i.oimg))}var g=i.defx,e=i.defy;if(!(i.parent&&i.parent!=i.defparent)&&(c||!i.detached||i.horizontal||i.vertical)&&dd.getImg(i,i.oimg.name,1)){i.moveBy(i.defx-g,i.defy-e)}}}}};function WINSZ(a){if(a){if(dd.n4){dd.iW=innerWidth;dd.iH=innerHeight}window.onresize=new Function("WINSZ();")}else{if(dd.n4&&(innerWidth!=dd.iW||innerHeight!=dd.iH)){location.reload()}else{if(!dd.n4){setTimeout("dd.recalc()",10)}}}}WINSZ(1);function DDObj(c,b){this.id=c;this.cmd="";this.cpy_n=dd.getCmdVal(this,COPY);this.maxoffb=dd.getCmdVal(this,MAXOFFBOTTOM,0,1);this.maxoffl=dd.getCmdVal(this,MAXOFFLEFT,0,1);this.maxoffr=dd.getCmdVal(this,MAXOFFRIGHT,0,1);this.maxofft=dd.getCmdVal(this,MAXOFFTOP,0,1);var a=dd_cursors.length;while(a--){if(dd.getCmd(this,dd_cursors[a],1)){this.cursor=dd_cursors[a].substring(2)}}this.clone=dd.getCmd(this,CLONE,1);this.detach=dd.getCmd(this,DETACH_CHILDREN);this.scalable=dd.getCmd(this,SCALABLE,1);this.horizontal=dd.getCmd(this,HORIZONTAL);this.noalt=dd.getCmd(this,NO_ALT,1);this.nodrag=dd.getCmd(this,NO_DRAG);this.scroll=dd.getCmd(this,SCROLL,1);this.resizable=dd.getCmd(this,RESIZABLE,1);this.re_z=dd.getCmd(this,RESET_Z,1);this.diaphan=dd.getCmd(this,TRANSPARENT,1);this.vertical=dd.getCmd(this,VERTICAL);this.maxw=dd.getCmdVal(this,MAXWIDTH,1,1);this.minw=Math.abs(dd.getCmdVal(this,MINWIDTH,1,1));this.maxh=dd.getCmdVal(this,MAXHEIGHT,1,1);this.minh=Math.abs(dd.getCmdVal(this,MINHEIGHT,1,1));this.pickFunc=this.dragFunc=this.resizeFunc=this.dropFunc=null;this.name=this.id+(b||"");this.oimg=dd.getImg(this,this.id,1);this.is_image=!!this.oimg;this.copies=new Array();this.children=new Array();this.parent=this.original=null;if(this.oimg){this.id=this.name+"dIi15v";this.w=dd.getImgW(this.oimg);this.h=dd.getImgH(this.oimg);this.dw=this.dh=0;this.defz=dd.Int(dd.getCssProp(this.oimg,"z-index","zIndex","zIndex"))||1;this.defsrc=this.src=this.oimg.src;this.htm='<img name="'+this.id+'NI1m6G" src="'+this.oimg.src+'" width="'+this.w+'" height="'+this.h+'">';this.t_htm='<div id="'+this.id+'" style="position:absolute;left:'+(this.cssx=this.x=this.defx)+"px;top:"+(this.cssy=this.y=this.defy)+"px;width:"+this.w+"px;height:"+this.h+'px;">'+this.htm+"</div>"}else{if(!!(this.div=dd.getDiv(this.id))&&typeof this.div.style!=dd_u){this.css=this.div.style}dd.getWH(this);if(this.div){this.div.ddObj=this;this.div.pos_rel=(""+(this.div.parentNode?this.div.parentNode.tagName:this.div.parentElement?this.div.parentElement.tagName:"").toLowerCase().indexOf("body")<0)}dd.getPageXY(this.div);this.defx=this.x=dd.x;this.defy=this.y=dd.y;dd.getCssXY(this);this.defz=dd.Int(dd.getCssProp(this.div,"z-index","zIndex","zIndex"))}this.defw=this.w||0;this.defh=this.h||0}DDObj.prototype.setPickFunc=function(a){this.pickFunc=a};DDObj.prototype.setDragFunc=function(a){this.dragFunc=a};DDObj.prototype.setResizeFunc=function(a){this.resizeFunc=a};DDObj.prototype.setDropFunc=function(a){this.dropFunc=a};DDObj.prototype.moveBy=function(e,d,b,c){if(!this.div){return}this.x+=(e=dd.Int(e));this.y+=(d=dd.Int(d));if(!b||this.is_image||this.parent!=this.defparent){(c=this.css||this.div).left=(this.cssx+=e)+dd.px;c.top=(this.cssy+=d)+dd.px}var a=this.children.length;while(a--){if(!(c=this.children[a]).detached){c.moveBy(e,d,1)}c.defx+=e;c.defy+=d}};DDObj.prototype.moveTo=function(b,a){this.moveBy(dd.Int(b)-this.x,dd.Int(a)-this.y)};DDObj.prototype.hide=function(d,c,b){if(this.div&&this.visible){b=this.css||this.div;if(d&&!dd.n4){this.display=dd.getCssProp(this.div,"display","display","display");if(this.oimg){this.oimg.display=dd.getCssProp(this.oimg,"display","display","display");this.oimg.style.display="none"}b.display="none";dd.recalc()}else{b.visibility="hidden"}}this.visible=false;var a=this.children.length;while(a--){if(!(c=this.children[a]).detached){c.hide(d)}}};DDObj.prototype.show=function(c,b){if(this.div){b=this.css||this.div;if(b.display&&b.display=="none"){b.display=this.display||"block";if(this.oimg){this.oimg.style.display=this.oimg.display||"inline"}dd.recalc()}else{b.visibility="visible"}}this.visible=true;var a=this.children.length;while(a--){if(!(c=this.children[a]).detached){c.show()}}};DDObj.prototype.resizeTo=function(a,b,c){if(!this.div){return}a=(this.w=dd.Int(a))-this.dw;b=(this.h=dd.Int(b))-this.dh;if(dd.n4){this.div.resizeTo(a,b);if(this.is_image){this.write('<img src="'+this.src+'" width="'+a+'" height="'+b+'">');(this.nimg=this.div.document.images[0]).src=this.src}}else{if(typeof this.css.pixelWidth!=dd_u){this.css.pixelWidth=a;this.css.pixelHeight=b;if(this.is_image){(c=this.nimg.style).pixelWidth=a;c.pixelHeight=b}}else{this.css.width=a+dd.px;this.css.height=b+dd.px;if(this.is_image){(c=this.nimg).width=a;c.height=b;if(!c.complete){c.src=this.src}}}}};DDObj.prototype.resizeBy=function(a,b){this.resizeTo(this.w+dd.Int(a),this.h+dd.Int(b))};DDObj.prototype.swapImage=function(c,b){if(!this.nimg){return}this.nimg.src=c;this.src=this.nimg.src;if(b){var a=this.copies.length;while(a--){this.copies[a].src=this.copies[a].nimg.src=this.nimg.src}}};DDObj.prototype.setBgColor=function(a){if(dd.n4&&this.div){this.div.bgColor=a}else{if(this.css){this.css.background=a}}this.bgColor=a};DDObj.prototype.write=function(b,a){this.text=b;if(!this.div){return}if(dd.n4){(a=this.div.document).open();a.write(b);a.close();dd.getWH(this)}else{this.css.height="auto";this.div.innerHTML=b;if(!dd.ie4){dd.recalc()}if(dd.ie4||dd.n6){setTimeout("dd.recalc();",0)}}};DDObj.prototype.copy=function(d,b,e){if(!this.oimg){return}e=(dd.ie&&document.all.tags("body"))?document.all.tags("body")[0]:document.getElementsByTagName?(document.getElementsByTagName("body")[0]||dd.db):dd.db;d=d||1;while(d--){var a=this.copies.length,c=new DDObj(this.name+this.cmd,a+1);if(dd.n4){c.id=(b=new Layer(c.w)).name;b.clip.height=c.h;b.visibility="show";(b=b.document).open();b.write(c.htm);b.close()}else{if(e&&e.insertAdjacentHTML){e.insertAdjacentHTML("AfterBegin",c.t_htm)}else{if(document.createElement&&e&&e.appendChild){e.appendChild(b=document.createElement("dIi15v"));b.innerHTML=c.htm;b.id=c.id;b.style.position="absolute";b.style.width=c.w+"px";b.style.height=c.h+"px"}else{if(e&&e.innerHTML){e.innerHTML+=c.t_htm}}}}c.defz=this.defz+1+a;dd.addProps(c);c.original=this;dd.addElt(c,this);if(this.parent){this.parent.addChild(c,this.detached);c.defparent=this.defparent}c.moveTo(c.defx=this.defx,c.defy=this.defy);if(dd.n4){c.defsrc=c.src=this.defsrc}c.swapImage(this.src)}};DDObj.prototype.addChild=function(b,c,a){if(typeof b!="object"){b=dd.elements[b]}if(b.parent&&b.parent==this||b==this||!b.is_image&&b.defparent&&!a){return}this.children[this.children.length]=this.children[b.name]=b;b.detached=c||0;if(a){b.defparent=this}else{if(this==b.defparent&&b.is_image){dd.getImg(this,b.oimg.name,1)}}if(!b.defparent||this!=b.defparent){b.defx=b.x;b.defy=b.y}if(!c){b.defz=b.defz+this.defz-(b.parent?b.parent.defz:0)+(!b.is_image*1);b.setZ(b.z+this.z-(b.parent?b.parent.z:0)+(!b.is_image*1),1)}if(b.parent){b.parent._removeChild(b,1)}b.parent=this};DDObj.prototype._removeChild=function(d,e){if(typeof d!="object"){d=this.children[d]}var c=this.children,a=new Array();for(var b=0;b<c.length;b++){if(c[b]!=d){a[a.length]=c[b]}}this.children=a;d.parent=null;if(!e){d.detached=d.defp=0;if(d.is_image){dd.getImg(d,d.oimg.name,1)}}};DDObj.prototype.attachChild=function(a){(a=(typeof a!="object")?this.children[a]:a).detached=0;a.setZ(a.defz+this.z-this.defz,1)};DDObj.prototype.detachChild=function(a){(a=(typeof a!="object")?this.children[a]:a).detached=1};DDObj.prototype.setZ=function(e,c,d){if(c){var a=e-this.z,b=this.children.length;while(b--){if(!(d=this.children[b]).detached){d.setZ(d.z+a,1)}}}dd.z=Math.max(dd.z,this.z=this.div?((this.css||this.div).zIndex=e):0)};DDObj.prototype.maximizeZ=function(){this.setZ(dd.z+1,1)};DDObj.prototype._resetZ=function(b){if(this.re_z||dd.re_z){this.setZ(this.defz);var a=this.children.length;while(a--){if(!(b=this.children[a]).detached){b.setZ(b.defz)}}}};DDObj.prototype.setOpacity=function(a){this.opacity=a;this._setOpaRel(1,1)};DDObj.prototype._setOpaRel=function(e,b,d,c){if(this.css&&(this.diaphan||b)){d=this.opacity*e;if(typeof this.css.MozOpacity!=dd_u){this.css.MozOpacity=d}else{if(typeof this.css.filter!=dd_u){this.css.filter="Alpha(opacity="+parseInt(100*d)+")"}else{this.css.opacity=d}}var a=this.children.length;while(a--){if(!(c=this.children[a]).detached){c._setOpaRel(e,1)}}}};DDObj.prototype.setCursor=function(a){this._setCrs(this.cursor=(a.indexOf("c:")+1)?a.substring(2):a)};DDObj.prototype._setCrs=function(a){if(this.css){this.css.cursor=((!dd.ie||dd.iemac)&&a=="hand")?"pointer":a}};DDObj.prototype.setDraggable=function(a){this.nodrag=!a*1;this._setCrs(a?this.cursor:"auto")};DDObj.prototype.setResizable=function(a){this.resizable=a*1;if(a){this.scalable=0}};DDObj.prototype.setScalable=function(a){this.scalable=a*1;if(a){this.resizable=0}};DDObj.prototype.getEltBelow=function(f,e,d){var c,a=-1,b=dd.elements.length;while(b--){c=dd.elements[b];e=c.x-this.w/2;d=c.y-this.h/2;if(c.visible&&c.z<this.z&&this.x>=e&&this.x<=e+c.w&&this.y>=d&&this.y<=d+c.h){if(c.z>a){a=c.z;f=c}}}return f};DDObj.prototype.del=function(c,b){var a;if(this.parent&&this.parent._removeChild){this.parent._removeChild(this)}if(this.original){this.hide();if(this.original.copies){c=new Array();for(a=0;a<this.original.copies.length;a++){if((b=this.original.copies[a])!=this){c[b.name]=c[c.length]=b}}this.original.copies=c}}else{if(this.is_image){this.hide();if(this.oimg){if(dd.n4){this.oimg.src=this.defsrc}else{this.oimg.style.visibility="visible"}}}else{if(this.moveTo){if(this.css){this.css.cursor="default"}this.moveTo(this.defx,this.defy);this.resizeTo(this.defw,this.defh)}}}c=new Array();for(a=0;a<dd.elements.length;a++){if((b=dd.elements[a])!=this){c[b.name]=c[b.index=c.length]=b}else{b._free()}}dd.elements=c;if(!dd.n4){dd.recalc()}};DDObj.prototype._free=function(){for(var a in this){this[a]=null}dd.elements[this.name]=null};dd.n4RectVis=function(b){for(var a=4;a--;){dd.rectI[a].visibility=dd.rectA[a].visibility=b?"show":"hide";if(b){dd.rectI[a].zIndex=dd.rectA[a].zIndex=dd.z+2}}};dd.n4RectPos=function(c,e,d,a,b){c.x=e;c.y=d;c.clip.width=a;c.clip.height=b};dd.n4Rect=function(a,c){var b;if(!dd.rectI){dd.rectI=new Array();dd.rectA=new Array()}if(!dd.rectI[0]){for(b=4;b--;){(dd.rectI[b]=new Layer(1)).bgColor="#000000";(dd.rectA[b]=new Layer(1)).bgColor="#ffffff"}}if(!dd.rectI[0].visibility||dd.rectI[0].visibility=="hide"){dd.n4RectVis(1)}dd.obj.w=a;dd.obj.h=c;for(b=4;b--;){dd.n4RectPos(dd.rectI[b],dd.obj.x+(!(b-1)?(dd.obj.w-1):0),dd.obj.y+(!(b-2)?(dd.obj.h-1):0),b&1||dd.obj.w,!(b&1)||dd.obj.h);dd.n4RectPos(dd.rectA[b],!(b-1)?dd.rectI[1].x+1:(dd.obj.x-1),!(b-2)?dd.rectI[2].y+1:(dd.obj.y-1),b&1||dd.obj.w+2,!(b&1)||dd.obj.h+2)}};dd.reszTo=function(a,b){if(dd.n4&&dd.obj.is_image){dd.n4Rect(a,b)}else{dd.obj.resizeTo(a,b)}};dd.embedVis=function(c){var f=new Array("iframe","applet","embed","object");var b=f.length;while(b--){var e=dd.ie?document.all.tags(f[b]):document.getElementsByTagName?document.getElementsByTagName(f[b]):null;if(e){var a=e.length;while(a--){var d=e[a];while(d.offsetParent||d.parentNode){if((d=d.parentNode||d.offsetParent||null)==dd.obj.div){e[a].style.visibility=c;break}}}}}};dd.maxOffX=function(b,a){return((dd.obj.maxoffl+1&&(a=dd.obj.defx-dd.obj.maxoffl)-b>0||dd.obj.maxoffr+1&&(a=dd.obj.defx+dd.obj.maxoffr)-b<0)?a:b)};dd.maxOffY=function(b,a){return((dd.obj.maxofft+1&&(a=dd.obj.defy-dd.obj.maxofft)-b>0||dd.obj.maxoffb+1&&(a=dd.obj.defy+dd.obj.maxoffb)-b<0)?a:b)};dd.inWndW=function(d,b){var a=dd.getScrollX(),c=dd.getWndW();return(((b=a+2)-d>0)||((b=a+c+dd.obj.w-2)-d<0)?b:d)};dd.inWndH=function(d,c){var b=dd.getScrollY(),a=dd.getWndH();return(((c=b+2)-d>0)||((c=b+a+dd.obj.h-2)-d<0)?c:d)};dd.limW=function(a){return((dd.obj.minw-a>0)?dd.obj.minw:(dd.obj.maxw>0&&dd.obj.maxw-a<0)?dd.obj.maxw:a)};dd.limH=function(a){return((dd.obj.minh-a>0)?dd.obj.minh:(dd.obj.maxh>0&&dd.obj.maxh-a<0)?dd.obj.maxh:a)};function DDScroll(){if(!dd.obj||!dd.obj.scroll&&!dd.scroll||dd.ie4||dd.whratio){dd.scrx=dd.scry=0;return}var e=28,d=dd.getScrollX(),b=dd.getScrollY();if(dd.msmoved){var f=dd.getWndW(),a=dd.getWndH(),c;dd.scrx=((c=dd.e.x-f-d+e)>0)?(c>>=2)*c:((c=d+e-dd.e.x)>0)?-(c>>=2)*c:0;dd.scry=((c=dd.e.y-a-b+e)>0)?(c>>=2)*c:((c=b+e-dd.e.y)>0)?-(c>>=2)*c:0}if(dd.scrx||dd.scry){window.scrollTo(d+(dd.scrx=dd.obj.is_resized?dd.limW(dd.obj.w+dd.scrx)-dd.obj.w:dd.obj.vertical?0:(dd.maxOffX(dd.obj.x+dd.scrx)-dd.obj.x)),b+(dd.scry=dd.obj.is_resized?dd.limH(dd.obj.h+dd.scry)-dd.obj.h:dd.obj.horizontal?0:(dd.maxOffY(dd.obj.y+dd.scry)-dd.obj.y)));dd.obj.is_dragged?dd.obj.moveTo(dd.obj.x+dd.getScrollX()-d,dd.obj.y+dd.getScrollY()-b):dd.reszTo(dd.obj.w+dd.getScrollX()-d,dd.obj.h+dd.getScrollY()-b)}dd.msmoved=0;window.setTimeout("DDScroll()",51)}function PICK(e){dd.e=new dd.evt(e);if(dd.e.x>=dd.getWndW()+dd.getScrollX()||dd.e.y>=dd.getWndH()+dd.getScrollY()){return true}var d,c,a=-1,b=dd.elements.length;while(b--){d=dd.elements[b];if(dd.n4&&dd.e.but>1&&dd.e.src==d.oimg&&!d.clone){return false}if(d.visible&&dd.e.but<=1&&dd.e.x>=d.x&&dd.e.x<=d.x+d.w&&dd.e.y>=d.y&&dd.e.y<=d.y+d.h){if(d.z>a&&(c=dd.e.src.tag).indexOf("inpu")<0&&c.indexOf("texta")<0&&c.indexOf("sele")<0&&c.indexOf("opti")<0&&c.indexOf("scrol")<0){a=d.z;dd.obj=d}}}if(dd.obj){if(dd.obj.nodrag){dd.obj=null}else{dd.e.e.cancelBubble=true;var f=dd.e.modifKey&&(dd.obj.resizable||dd.obj.scalable);if(dd.op){(d=document.getElementById("OpBlUr")).style.pixelLeft=dd.e.x;d.style.pixelTop=dd.e.y;(d=d.children[0].children[0]).focus();d.blur()}else{if(dd.ie&&!dd.ie4){if(document.selection&&document.selection.empty){document.selection.empty()}dd.db.onselectstart=function(){event.returnValue=false}}}if(f){dd.obj._setCrs("se-resize");dd.obj.is_resized=1;dd.whratio=dd.obj.scalable?dd.obj.defw/dd.obj.defh:0;if(dd.ie){if(dd.ie4){window.dd_x=dd.getScrollX();window.dd_y=dd.getScrollY()}setTimeout("if(dd.obj && document.selection && document.selection.empty){document.selection.empty();if(dd.ie4) window.scrollTo(window.dd_x, window.dd_y);}",0)}dd.setMovHdl(RESIZE);dd.reszTo(dd.obj.w,dd.obj.h)}else{dd.obj.is_dragged=1;dd.setMovHdl(DRAG)}dd.setUpHdl(DROP);dd.embedVis("hidden");dd.obj._setOpaRel(0.7);dd.obj.maximizeZ();dd.ofx=dd.obj.x+dd.obj.w-dd.e.x;dd.ofy=dd.obj.y+dd.obj.h-dd.e.y;if(window.my_PickFunc){my_PickFunc()}if(dd.obj.pickFunc){dd.obj.pickFunc()}DDScroll();return !(dd.obj.is_resized||dd.n4&&dd.obj.is_image||dd.n6||dd.w3c)}}if(dd.downFunc){return dd.downFunc(e)}return true}function DRAG(a){if(!dd.obj||!dd.obj.visible){return true}if(dd.ie4||dd.w3c||dd.n6||dd.obj.children.length>15){if(dd.wait){return false}dd.wait=1;setTimeout("dd.wait = 0;",dd.tiv)}dd.e=new dd.evt(a);if(dd.ie&&!dd.e.but){DROP(a);return true}dd.msmoved=1;dd.obj.moveTo(dd.obj.vertical?dd.obj.x:dd.maxOffX(dd.inWndW(dd.ofx+dd.e.x)-dd.obj.w),dd.obj.horizontal?dd.obj.y:dd.maxOffY(dd.inWndH(dd.ofy+dd.e.y)-dd.obj.h));if(window.my_DragFunc){my_DragFunc()}if(dd.obj.dragFunc){dd.obj.dragFunc()}if(dd.moveFunc){return dd.moveFunc(a)}return false}function RESIZE(c){if(!dd.obj||!dd.obj.visible){return true}if(dd.wait){return false}dd.wait=1;setTimeout("dd.wait = 0;",dd.tiv);dd.e=new dd.evt(c);if(dd.ie&&!dd.e.but){DROP(c);return true}dd.msmoved=1;var a=dd.limW(dd.inWndW(dd.ofx+dd.e.x)-dd.obj.x),b;if(!dd.whratio){b=dd.limH(dd.inWndH(dd.ofy+dd.e.y)-dd.obj.y)}else{b=dd.limH(dd.inWndH(Math.round(a/dd.whratio)+dd.obj.y)-dd.obj.y);a=Math.round(b*dd.whratio)}dd.reszTo(a,b);if(window.my_ResizeFunc){my_ResizeFunc()}if(dd.obj.resizeFunc){dd.obj.resizeFunc()}if(dd.moveFunc){return dd.moveFunc(c)}return false}function DROP(a){if(dd.obj){if(dd.obj.is_dragged){if(!dd.obj.is_image){dd.getWH(dd.obj)}}else{if(dd.n4){if(dd.obj.is_image){dd.n4RectVis(0);dd.obj.resizeTo(dd.obj.w,dd.obj.h)}}}if(!dd.n4||!dd.obj.is_image){dd.recalc()}dd.setMovHdl(dd.moveFunc);dd.setUpHdl(dd.upFunc);if(dd.db){dd.db.onselectstart=null}dd.obj._setOpaRel(1);dd.obj._setCrs(dd.obj.cursor);dd.embedVis("visible");dd.obj._resetZ();dd.e=new dd.evt(a);if(window.my_DropFunc){my_DropFunc()}if(dd.obj.dropFunc){dd.obj.dropFunc()}dd.msmoved=dd.obj.is_dragged=dd.obj.is_resized=dd.whratio=0;dd.obj=null}dd.setDwnHdl(PICK)}function SET_DHTML(){var a=arguments,c,g="",f,d=a.length;while(d--){if(!(c=a[d]).indexOf("c:")){dd.cursor=c.substring(2)}else{if(c==NO_ALT){dd.noalt=1}else{if(c==SCROLL){dd.scroll=1}else{if(c==RESET_Z){dd.re_z=1}else{if(c==RESIZABLE){dd.resizable=1}else{if(c==SCALABLE){dd.scalable=1}else{if(c==TRANSPARENT){dd.diaphan=1}else{f=new DDObj(c);dd.addElt(f);g+=f.t_htm||"";if(f.oimg&&f.cpy_n){var b=0;while(b<f.cpy_n){var e=new DDObj(f.name+f.cmd,++b);dd.addElt(e,f);e.defz=f.defz+b;e.original=f;g+=e.t_htm}}}}}}}}}}if(dd.n4||dd.n6||dd.ie||dd.op||dd.w3c){document.write((dd.n4?'<div style="position:absolute;"></div>\n':(dd.op&&!dd.op6)?'<div id="OpBlUr" style="position:absolute;visibility:hidden;width:0px;height:0px;"><form><input type="text" style="width:0px;height:0px;"></form></div>':"")+g)}dd.z=51;d=dd.elements.length;while(d--){dd.addProps(f=dd.elements[d]);if(f.is_image&&!f.original&&!f.clone){dd.n4?f.oimg.src=spacer:f.oimg.style.visibility="hidden"}}dd.mkWzDom();if(window.onload){dd.loadFunc=window.onload}if(window.onunload){dd.uloadFunc=window.onunload}window.onload=dd.initz;window.onunload=dd.finlz;dd.setDwnHdl(PICK)}function ADD_DHTML(a){a=new DDObj(a);dd.addElt(a);dd.addProps(a);dd.mkWzDom()};