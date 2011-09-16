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
 * Contains the DTD mapping for XHTML 1.0 Strict.
 * This file was automatically generated from the file: xhtml10-strict.dtd
 */
FCK.DTD=(function(){var e=FCKTools.Merge;var l,k,j,i,b,h,g,d,c,a,o,m,f,n;d={ins:1,del:1,script:1};c={hr:1,ul:1,div:1,blockquote:1,noscript:1,table:1,address:1,pre:1,p:1,h5:1,dl:1,h4:1,ol:1,h6:1,h1:1,h3:1,h2:1};b=e({fieldset:1},c);a=e({sub:1,bdo:1,"var":1,sup:1,br:1,kbd:1,map:1,samp:1,b:1,acronym:1,"#":1,abbr:1,code:1,i:1,cite:1,tt:1,strong:1,q:1,em:1,big:1,small:1,span:1,dfn:1},d);o=e({img:1,object:1},a);n={input:1,button:1,textarea:1,select:1,label:1};m=e({a:1},n);l={img:1,noscript:1,br:1,kbd:1,button:1,h5:1,h4:1,samp:1,h6:1,ol:1,h1:1,h3:1,h2:1,form:1,select:1,"#":1,ins:1,abbr:1,label:1,code:1,table:1,script:1,cite:1,input:1,strong:1,textarea:1,big:1,small:1,span:1,hr:1,sub:1,bdo:1,"var":1,div:1,object:1,sup:1,map:1,dl:1,del:1,fieldset:1,ul:1,b:1,acronym:1,a:1,blockquote:1,i:1,address:1,tt:1,q:1,pre:1,p:1,em:1,dfn:1};k=e({form:1,fieldset:1},c,o,m);j={tr:1};i={"#":1};h=e(o,m);g={li:1};f=e({form:1},d,b);return{col:{},tr:{td:1,th:1},img:{},colgroup:{col:1},noscript:f,td:k,br:{},th:k,kbd:h,button:e(c,o),h5:h,h4:h,samp:h,h6:h,ol:g,h1:h,h3:h,option:i,h2:h,form:e(d,b),select:{optgroup:1,option:1},ins:k,abbr:h,label:h,code:h,table:{thead:1,col:1,tbody:1,tr:1,colgroup:1,caption:1,tfoot:1},script:i,tfoot:j,cite:h,li:k,input:{},strong:h,textarea:i,big:h,small:h,span:h,dt:h,hr:{},sub:h,optgroup:{option:1},bdo:h,param:{},"var":h,div:k,object:e({param:1},l),sup:h,dd:k,area:{},map:e({form:1,area:1},d,b),dl:{dt:1,dd:1},del:k,fieldset:e({legend:1},l),thead:j,ul:g,acronym:h,b:h,a:e({img:1,object:1},a,n),blockquote:f,caption:h,i:h,tbody:j,address:h,tt:h,legend:h,q:h,pre:e({a:1},a,n),p:h,em:h,dfn:h}})();