function _log(){console.log.apply(console,arguments)}function instr(e,t){for(var a=0;a<t.length;a++)if(-1!==e.toLowerCase().indexOf(t[a].toLowerCase()))return!0}function enqueue_assets(list,deps,dep0,tp,cb){function listpath(e){var n=[],o={};return function(e,t){if(t=t||"","object"!=typeof e)return;for(var a in e)o[a]?o[a]++:o[a]=1,arguments.callee(e[a],t+"*"+a)&&n.push(t.substring(1)+"*"+a)}(e),[n,o]}var sortDict=function(t,e){var a={};return e.forEach(function(e){t[e]&&(a[e]=t[e],delete t[e])}),t=_HWIO.assign(a,t)},i,load={},list,dep,stat={},path={};"js"!=tp||list[dep0]||(dep0="jquery");var path_dep=function(e,t){path[e]||(path[e]=""),-1===path[e].indexOf(t+",")&&(path[e]+=t+",")},rmArr=function(e,t){t=e.indexOf(t);-1!==t&&e.splice(t,1)},jsonP=function(ar,p,rm,set){try{if(set)eval('ar["'+p.join('"]["')+'"]=rm;');else{if(!rm)return eval('ar["'+p.join('"]["')+'"]');eval('delete ar["'+p.join('"]["')+'"];')}}catch(a){_log(a)}};for(i in list)list[i].t==tp&&(list[i].deps?(dep=list[i].deps.split(","),dep.forEach(function(e,t){list[e]||(e=dep0),null==load[e]&&(load[e]={},stat[e]=0),load[e][i]=1,stat[i]=0,path_dep(i,e)})):(null==load[dep0]&&(load[dep0]={},stat[dep0]=0),i!=dep0&&(load[dep0][i]=1,stat[i]=0,path_dep(i,dep0))));var rm=[],queue={},queue1={},inject=function(e,t){for(var a in e)if(1==e[a])t&&t[a]&&(e[a]=t[a],rm.push(a));else for(var n in e[a])e[n]&&(e[a][n]=e[n],rm.push(n),inject(e[a][n],e))};inject(load,null),rm.forEach(function(e){delete load[e]}),load=sortDict(load,[dep0]);var load1=JSON.parse(JSON.stringify(load)),r1={},t=listpath(load1),paths=t[0],i,k,a,r={},jp;for(i=0;i<paths.length;i++)k=paths[i].split("*").pop(),r[k]?("string"==typeof r[k]&&(r[k]=[r[k].split("*").length+"|"+r[k]]),r[k].push(paths[i].split("*").length+"|"+paths[i])):r[k]=paths[i];for(k in r)if("object"==typeof r[k])for(r[k].sort().reverse(),i=1;i<r[k].length;i++)for(a=r[k][i].split("|")[1].split("*"),3<=a.length&&(r1[a[a.length-1]]=1),jsonP(load1,a,1);a.pop(),(jp=jsonP(load1,a))&&0==Object.keys(jp).length;)1<t[1][a[a.length-1]]?(jsonP(load1,a,1),t[1][a[a.length-1]]--):(jsonP(load1,a,1,1),r1[a[a.length-1]]=1);load=load1;var load_assets=function(s,e){var t,a;for(t in s)s.hasOwnProperty(t)&&(!e&&deps[t]?queue[t]=s[t]:(a=function(r){return function(e){var t,a,n,o,i={};if(e||(stat[r]=1,"js"==tp&&"jquery"==r&&"undefined"!=typeof jQuery&&(o=jQuery.fn.ready,jQuery.fn.ready=function(e){var t=this;return t[0]==document?(_HWIO.docReady(function(){e.apply(t,[jQuery])}),t):o.apply(t,arguments)}),"js"==tp&&_HWIO._readyjs_[r]&&(_HWIO._readyjs_[r].forEach(_HWIO._readyjs_cb),delete _HWIO._readyjs_[r]),"css"==tp&&"hpp-s-0"==r&&_HWIO.do_event("loadjs")),function(){var t,e,a,n,o=1;for(t in queue1){for(a=[],o=1,e=0;e<queue1[t].kk.length;e++){if(!stat[queue1[t].kk[e]]){o=0;break}a.push(e)}o?(_log("*",t,path[t]),n=queue1[t].cb,delete queue1[t],_HWIO["_add"+tp](t,n)):(a.forEach(function(e){rmArr(queue1[t].kk,e)}),a.length&&(queue1[t].kk=queue1[t].kk.filter(function(e){return e})))}}(),!e){for(t in queue){for(a=0;a<deps[t].length&&(n=_HWIO.data["_"+tp+"_"][deps[t][a]]);a++);n&&(i[t]=queue[t],delete queue[t],load_assets(i,1))}load_assets(s[r])}}}(t),function(e){if(r1&&path[e]){if(r1[e])return 1;var t,a=path[e].split(",");for(a.pop(),t=0;t<a.length;t++)if(r1[a[t]])return r1[e]=1}}(t)?(queue1[t]={cb:a,kk:path[t].split(",")},queue1[t].kk.pop(),a(1)):_HWIO["_add"+tp](t,a)));-1===Object.values(stat).indexOf(0)&&(_HWIO.data["done_"+tp]||(_HWIO.data["done_"+tp]=1,delete _HWIO.data["_"+tp+"0_"],"function"==typeof cb&&cb()),_log("%c ..done","color:pink",tp))};return load_assets(load),load}function load_extra(e,t,a){var n=_HWIO.extra_assets;if("js"==e)return enqueue_assets(n,a||{},n["hpp-0"]?"hpp-0":"jquery","js",t);enqueue_assets(n,a||{},n["hpp-s-0"]?"hpp-s-0":"hpp-style","css",t)}function boot(){document.querySelectorAll("style[media]").forEach(function(e){"not all"==e.getAttribute("media")&&e.removeAttribute("media")})}function insertE(e,t,a){if(!e)return console.trace();a?e.parentNode.insertBefore(t,e.nextSibling):e.parentNode.insertBefore(t,e)}function addEvent(e,t,a){e.addEventListener?e.addEventListener(t,a,{passive:!1}):e.attachEvent&&e.attachEvent("on"+t,a)}function removeEvent(e,t,a){e.removeEventListener?e.removeEventListener(t,a):e.detachEvent&&e.detachEvent("on"+t,a)}function _fireOnce(a){"click"==(a=a||{}).type&&a.preventDefault();function e(){if(!_HWIO.__readyit){_HWIO.__readyit=1;for(var e=["click","mousemove","scroll","resize","touchmove","mousewheel"],t=0;t<e.length;t++)removeEvent(document,e[t],n),-1!==["scroll","resize"].indexOf(e[t])&&removeEvent(window,e[t],n);_log("%c remove init","color:orange",a.type),_HWIO._readyjs_._it.forEach(function(e){"function"==typeof e?_HWIO.readyjs(e):_HWIO.readyjs(e[0],e[1])}),_HWIO._readyjs_._it=[]}}var n=arguments.callee;n.fired||(n.fired=1,_HWIO._readyjs_cb=function(e){_HWIO.__readyit||_HWIO.do_event("run_script",1,("function"==typeof e?e:e[0]).toString())?("undefined"==typeof $&&"undefined"!=typeof jQuery&&($=jQuery),"function"==typeof e?e("undefined"!=typeof jQuery?jQuery:null):_HWIO.waitForExist(function(){e[0].apply(this,e.slice(1))},e[1])):(_HWIO._readyjs_._it.push(e),_log("%c push readyjs to _it","color:orange"))},_HWIO.docReady(function(){boot();function e(){_HWIO.load_content(function(e){load_extra("js",function(){for(var e in _HWIO.__readyjs=1,_HWIO._readyjs_)"_it"!=e&&(_HWIO._readyjs_[e].forEach(_HWIO._readyjs_cb),delete _HWIO._readyjs_[e])})})}_HWIO.extra_assets["hpp-0"]?(_HWIO.add_event("loadjs",e),load_extra("css")):load_extra("css",e)},50),_log("%c add assets","color:orange",a.type)),"click"==a.type&&(e(),_HWIO.__readyjs||_HWIO.readyjs(function(){_HWIO.data.clicked=a.target,setTimeout(function(){a.target.click()}),_log("%c click on","color:blue",a.target)})),a.type&&setTimeout(e,10)}!function(e){var t=function(n,f){"use strict";var p,_;if(function(){var e,t={lazyClass:"lazyload",loadedClass:"lazyloaded",loadingClass:"lazyloading",preloadClass:"lazypreload",errorClass:"lazyerror",autosizesClass:"lazyautosizes",srcAttr:"data-src",srcsetAttr:"data-srcset",sizesAttr:"data-sizes",minSize:40,customMedia:{},init:!0,expFactor:1.5,hFac:.8,loadMode:2,loadHidden:!0,ricTimeout:0,throttleDelay:125};for(e in _=n.lazySizesConfig||n.lazysizesConfig||{},t)e in _||(_[e]=t[e])}(),!f||!f.getElementsByClassName)return{init:function(){},cfg:_,noSupport:!0};function i(e,t){return de[t]||(de[t]=new RegExp("(\\s|^)"+t+"(\\s|$)")),de[t].test(e[ae]("class")||"")&&de[t]}function d(e,t){i(e,t)||e.setAttribute("class",(e[ae]("class")||"").trim()+" "+t)}function c(e,t){(t=i(e,t))&&e.setAttribute("class",(e[ae]("class")||"").replace(t," "))}function u(e,t,a,n,o){var i=f.createEvent("Event");return(a=a||{}).instance=p,i.initEvent(t,!n,!o),i.detail=a,e.dispatchEvent(i),i}function m(e,t){var a;!ee&&(a=n.picturefill||_.pf)?(t&&t.src&&!e[ae]("srcset")&&e.setAttribute("srcset",t.src),a({reevaluate:!0,elements:[e]})):t&&t.src&&(e.src=t.src)}function y(e,t){return(getComputedStyle(e,null)||{})[t]}function o(e,t,a){for(a=a||e.offsetWidth;a<_.minSize&&t&&!e._lazysizesWidth;)a=t.offsetWidth,t=t.parentNode;return a}function e(a,e){return e?function(){fe(a)}:function(){var e=this,t=arguments;fe(function(){a.apply(e,t)})}}function t(e){function t(){a=null,e()}var a,n,o=function(){var e=Z.now()-n;e<99?oe(o,99-e):(re||t)(t)};return function(){n=Z.now(),a=a||oe(o,99)}}var a,r,s,h,g,v,O,l,b,W,H,j,I,z,E,k,w,x,A,q,C,N,L,T,S,M,B,R,P,F,D,Q,$,J,X,U,G,K,V,Y=f.documentElement,Z=n.Date,ee=n.HTMLPictureElement,te="addEventListener",ae="getAttribute",ne=n[te],oe=n.setTimeout,ie=n.requestAnimationFrame||oe,re=n.requestIdleCallback,se=/^picture$/i,le=["load","error","lazyincluded","_lazyloaded"],de={},ce=Array.prototype.forEach,ue=function(t,a,e){var n=e?te:"removeEventListener";e&&ue(t,a),le.forEach(function(e){t[n](e,a)})},fe=(K=[],V=G=[],Ie._lsFlush=je,Ie),pe=(N=/^img$/i,L=/^iframe$/i,T="onscroll"in n&&!/(gle|ing)bot/.test(navigator.userAgent),B=-1,k=ve,x=M=S=0,A=_.throttleDelay,q=_.ricTimeout,C=re&&49<q?function(){re(He,{timeout:q}),q!==_.ricTimeout&&(q=_.ricTimeout)}:e(function(){oe(He)},!0),P=e(Oe),F=function(e){P({target:e.target})},D=e(function(t,e,a,n,o){var i,r,s,l;(s=u(t,"lazybeforeunveil",e)).defaultPrevented||(n&&(a?d(t,_.autosizesClass):t.setAttribute("sizes",n)),a=t[ae](_.srcsetAttr),n=t[ae](_.srcAttr),o&&(r=(i=t.parentNode)&&se.test(i.nodeName||"")),l=e.firesLoad||"src"in t&&(a||n||r),s={target:t},d(t,_.loadingClass),l&&(clearTimeout(v),v=oe(he,2500),ue(t,F,!0)),r&&ce.call(i.getElementsByTagName("source"),be),a?t.setAttribute("srcset",a):n&&!r&&(L.test(t.nodeName)?function(t,a){try{t.contentWindow.location.replace(a)}catch(e){t.src=a}}(t,n):t.src=n),o&&(a||r)&&m(t,{src:n})),t._lazyRace&&delete t._lazyRace,c(t,_.lazyClass),fe(function(){var e=t.complete&&1<t.naturalWidth;l&&!e||(e&&d(t,"ls-is-cached"),Oe(s),t._lazyCache=!0,oe(function(){"_lazyCache"in t&&delete t._lazyCache},9)),"lazy"==t.loading&&M--},!0)}),$=t(function(){_.loadMode=3,R()}),J=function(){g||(Z.now()-l<999?oe(J,999):(g=!0,_.loadMode=3,R(),ne("scroll",We,!0)))},{_:function(){l=Z.now(),p.elements=f.getElementsByClassName(_.lazyClass),h=f.getElementsByClassName(_.lazyClass+" "+_.preloadClass),ne("scroll",R,!0),ne("resize",R,!0),ne("pageshow",function(e){var t;!e.persisted||(t=f.querySelectorAll("."+_.loadingClass)).length&&t.forEach&&ie(function(){t.forEach(function(e){e.complete&&Q(e)})})}),n.MutationObserver?new MutationObserver(R).observe(Y,{childList:!0,subtree:!0,attributes:!0}):(Y[te]("DOMNodeInserted",R,!0),Y[te]("DOMAttrModified",R,!0),setInterval(R,999)),ne("hashchange",R,!0),["focus","mouseover","click","load","transitionend","animationend"].forEach(function(e){f[te](e,R,!0)}),/d$|^c/.test(f.readyState)?J():(ne("load",J),f[te]("DOMContentLoaded",R),oe(J,2e4)),p.elements.length?(ve(),fe._lsFlush()):R()},checkElems:R=function(e){var t;(e=!0===e)&&(q=33),w||(w=!0,(t=A-(Z.now()-x))<0&&(t=0),e||t<9?C():oe(C,t))},unveil:Q=function(e){var t,a,n,o;e._lazyRace||(!(o="auto"==(n=(a=N.test(e.nodeName))&&(e[ae](_.sizesAttr)||e[ae]("sizes"))))&&g||!a||!e[ae]("src")&&!e.srcset||e.complete||i(e,_.errorClass)||!i(e,_.lazyClass))&&(t=u(e,"lazyunveilread").detail,o&&_e.updateElem(e,!0,e.offsetWidth),e._lazyRace=!0,M++,D(e,t,o,n,a))},_aLSL:We}),_e=(r=e(function(e,t,a,n){var o,i,r;if(e._lazysizesWidth=n,n+="px",e.setAttribute("sizes",n),se.test(t.nodeName||""))for(i=0,r=(o=t.getElementsByTagName("source")).length;i<r;i++)o[i].setAttribute("sizes",n);a.detail.dataAttr||m(e,a.detail)}),{_:function(){a=f.getElementsByClassName(_.autosizesClass),ne("resize",s)},checkElems:s=t(function(){var e,t=a.length;if(t)for(e=0;e<t;e++)ye(a[e])}),updateElem:ye}),me=function(){!me.i&&f.getElementsByClassName&&(me.i=!0,_e._(),pe._())};function ye(e,t,a){var n=e.parentNode;n&&(a=o(e,n,a),(t=u(e,"lazybeforesizes",{width:a,dataAttr:!!t})).defaultPrevented||(a=t.detail.width)&&a!==e._lazysizesWidth&&r(e,n,t,a))}function he(e){M--,e&&!(M<0)&&e.target||(M=0)}function ge(e){return null==E&&(E="hidden"==y(f.body,"visibility")),E||!("hidden"==y(e.parentNode,"visibility")&&"hidden"==y(e,"visibility"))}function ve(){var e,t,a,n,o,i,r,s,l,d,c,u=p.elements;if((O=_.loadMode)&&M<8&&(e=u.length)){for(t=0,B++;t<e;t++)if(u[t]&&!u[t]._lazyRace)if(!T||p.prematureUnveil&&p.prematureUnveil(u[t]))Q(u[t]);else if((r=u[t][ae]("data-expand"))&&(o=+r)||(o=S),l||(l=!_.expand||_.expand<1?500<Y.clientHeight&&500<Y.clientWidth?500:370:_.expand,d=(p._defEx=l)*_.expFactor,c=_.hFac,E=null,S<d&&M<1&&2<B&&2<O&&!f.hidden?(S=d,B=0):S=1<O&&1<B&&M<6?l:0),s!==o&&(b=innerWidth+o*c,W=innerHeight+o,i=-1*o,s=o),d=u[t].getBoundingClientRect(),(z=d.bottom)>=i&&(H=d.top)<=W&&(I=d.right)>=i*c&&(j=d.left)<=b&&(z||I||j||H)&&(_.loadHidden||ge(u[t]))&&(g&&M<3&&!r&&(O<3||B<4)||function(e,t){var a,n=e,o=ge(e);for(H-=t,z+=t,j-=t,I+=t;o&&(n=n.offsetParent)&&n!=f.body&&n!=Y;)(o=0<(y(n,"opacity")||1))&&"visible"!=y(n,"overflow")&&(a=n.getBoundingClientRect(),o=I>a.left&&j<a.right&&z>a.top-1&&H<a.bottom+1);return o}(u[t],o))){if(Q(u[t]),n=!0,9<M)break}else!n&&g&&!a&&M<4&&B<4&&2<O&&(h[0]||_.preloadAfterLoad)&&(h[0]||!r&&(z||I||j||H||"auto"!=u[t][ae](_.sizesAttr)))&&(a=h[0]||u[t]);a&&!n&&Q(a)}}function Oe(e){var t=e.target;t._lazyCache?delete t._lazyCache:(he(e),d(t,_.loadedClass),c(t,_.loadingClass),ue(t,F),u(t,"lazyloaded"))}function be(e){var t,a=e[ae](_.srcsetAttr);(t=_.customMedia[e[ae]("data-media")||e[ae]("media")])&&e.setAttribute("media",t),a&&e.setAttribute("srcset",a)}function We(){3==_.loadMode&&(_.loadMode=2),$()}function He(){w=!1,x=Z.now(),k()}function je(){var e=V;for(V=G.length?K:G,U=!(X=!0);e.length;)e.shift()();X=!1}function Ie(e,t){X&&!t?e.apply(this,arguments):(V.push(e),U||(U=!0,(f.hidden?oe:ie)(je)))}return oe(function(){_.init&&me()}),p={cfg:_,autoSizer:_e,loader:pe,init:me,uP:m,aC:d,rC:c,hC:i,fire:u,gW:o,rAF:fe}}(e,e.document);e.lazySizes=t,"object"==typeof module&&module.exports&&(module.exports=t)}("undefined"!=typeof window?window:{}),function(e,t){var a=function(){t(e.lazySizes),e.removeEventListener("lazyunveilread",a,!0)};t=t.bind(null,e,e.document),"object"==typeof module&&module.exports?t(require("lazysizes")):"function"==typeof define&&define.amd?define(["lazysizes"],t):e.lazySizes?a():e.addEventListener("lazyunveilread",a,!0)}(window,function(e,o,i){"use strict";function r(e,t){var a,n;d[e]||(a=o.createElement(t?"link":"script"),n=o.getElementsByTagName("script")[0],t?(a.rel="stylesheet",a.href=e):a.src=e,d[e]=!0,d[a.src||a.href]=!0,n.parentNode.insertBefore(a,n))}var s,l,d={};o.addEventListener&&(s=function(e,t){var a=o.createElement("img");a.onload=function(){a.onload=null,a.onerror=null,a=null,t()},a.onerror=a.onload,a.src=e,a&&a.complete&&a.onload&&a.onload()},addEventListener("lazybeforeunveil",function(e){var t,a,n;if(e.detail.instance==i&&!e.defaultPrevented){var o=e.target;if("none"==o.preload&&(o.preload=o.getAttribute("data-preload")||"auto"),null!=o.getAttribute("data-autoplay"))if(o.getAttribute("data-expand")&&!o.autoplay)try{o.play()}catch(e){}else requestAnimationFrame(function(){o.setAttribute("data-expand","-10"),i.aC(o,i.cfg.lazyClass)});(t=o.getAttribute("data-link"))&&r(t,!0),(t=o.getAttribute("data-script"))&&r(t),(t=o.getAttribute("data-require"))&&(i.cfg.requireJs?i.cfg.requireJs([t]):r(t)),(a=o.getAttribute("data-bg"))&&(e.detail.firesLoad=!0,s(a,function(){o.style.backgroundImage="url("+(l.test(a)?JSON.stringify(a):a)+")",e.detail.firesLoad=!1,i.fire(o,"_lazyloaded",{},!0,!0)})),(n=o.getAttribute("data-poster"))&&(e.detail.firesLoad=!0,s(n,function(){o.poster=n,e.detail.firesLoad=!1,i.fire(o,"_lazyloaded",{},!0,!0)}))}},!(l=/\(|\)|\s|'/)))}),window.NodeList&&!NodeList.prototype.forEach&&(NodeList.prototype.forEach=Array.prototype.forEach),Object.values||(Object.values=function(t){return Object.keys(t).map(function(e){return t[e]})}),_HWIO.entity=function(e){var t,a={"&quot;":'"',"&amp;":"&","&lt;":"<","&gt;":">","&circ;":"ˆ","&tilde;":"˜","&lsquo;":"‘","&rsquo;":"’"};for(t in a)e=e.split(t).join(a[t]);return e},_HWIO.detectMob=function(){var e,t=!1;return e=navigator.userAgent||navigator.vendor||window.opera,(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(e)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(e.substr(0,4)))&&(t=!0),t},_HWIO.do_event=function(e,t,a){var n=[];return void 0!==this.filters[e]&&0<this.filters[e].length&&(this.filters[e].forEach(function(e){n[e.priority]=n[e.priority]||[],n[e.priority].push(e.callback)}),n.forEach(function(e){e.forEach(function(e){t=e(t,a)})})),t},_HWIO.load_content=function(n){function r(e,t,a){var n,o,i;a||(l[a=e]=0),_log("%c "+(-1!==d.indexOf(e)?"("+e+")":e)+" <- "+a,"color:gray"),l[a]&&l[a]--,n=document.querySelector('div[data-id="'+e+'"]'),o=s[e].text,i=e,n?n.parentNode&&(document.createRange().createContextualFragment(o).childNodes.forEach(function(e){insertE(n,e.cloneNode(!0),0)}),n.parentNode.removeChild(n)):d.push(i);e=document.createRange().createContextualFragment(s[e].text).querySelectorAll("div[data-id]:empty");l[a]+=e.length,e.forEach(function(e){r(e.getAttribute("data-id"),t,a)}),!l[a]&&t&&setTimeout(t,500)}var s,e,t,l={},o=1,d=[];_HWIO.ajax.info?(e=_HWIO.ajax.ajax_url+"?action=hpp_dyna_content&"+Object.keys(_HWIO.ajax.info).map(function(e){return e+"="+_HWIO.ajax.info[e]}).join("&"),(t=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject("Microsoft.XMLHTTP")).onreadystatechange=function(){4===t.readyState&&function(e){if(e.data&&!(e.data instanceof Array)){var t,a=Object.keys(e.data).length;for(t in s=e.data,e.data)r(t,function(){o++==a&&n(a)})}}(t.responseText?JSON.parse(t.responseText):{})},t.open("GET",e),t.setRequestHeader("Content-Type","application/json;charset=UTF-8"),t.send()):n(0)},_HWIO._addjs=function(r,s){return _HWIO.data._js0_||(_HWIO.data._js0_={}),_HWIO.data._js_||(_HWIO.data._js_={},document.querySelectorAll("script[src]").forEach(function(e){e=e.getAttribute("src");e&&(_HWIO.data._js_[e]=1)})),"string"==typeof r&&(r=_HWIO.extra_assets[r]?(_log("%c #"+r,"color:gray"),_HWIO.assign(_HWIO.extra_assets[r],{id:r})):_HWIO.assign({l:arguments[0]},s||{})),"object"==typeof s&&(r=_HWIO.assign(r,s)),r.l=_HWIO.entity(r.l),_HWIO.do_event("hpp_allow_js",1,r)?_HWIO.data._js_[r.l]?("function"==typeof s&&setTimeout(s),_log("%c exist js "+r.l,"color:red")):_HWIO.data._js0_[r.l]?void("function"==typeof s&&setTimeout(s)):(_HWIO.data._js0_[r.l]=1,void function(e,t){var a,n,o=_HWIO.data._lj_?null:e.querySelector('script[src*="seo.js"]'),i=e.createElement("script");for(a in r.defer&&(i.defer=1),i.async=1,i.src=r.l,t)-1===["l","t","deps","async","defer","extra"].indexOf(a)&&(n=t[a],"id"!=a||t.extra||n.endsWith("-js")||(n+="-js"),i.setAttribute(a,n));i.onload=function(){_HWIO.data._js_[r.l]=1,_log("%c "+t.id,"color:blue",r.l),"function"==typeof s&&s()},i.onerror=function(){_HWIO.data._js_[r.l]=1,"function"==typeof s&&s()},insertE(_HWIO.data._lj_||o,i,1),_HWIO.data._lj_=i}(document,r,window)):void("function"==typeof s&&setTimeout(s))},_HWIO._addcss=function(e,t){if(_HWIO.data._css0_||(_HWIO.data._css0_={}),_HWIO.data._css_||(_HWIO.data._css_={},document.querySelectorAll('link[href][rel*="stylesheet"]').forEach(function(e){e=e.getAttribute("href");e&&(_HWIO.data._css_[e]=1)})),"string"==typeof e&&(e=_HWIO.extra_assets[e]?(_log("%c ."+e,"color:gray"),_HWIO.assign(_HWIO.extra_assets[e],{id:e})):_HWIO.assign({l:arguments[0]},t||{})),e.l=_HWIO.entity(e.l),_HWIO.do_event("hpp_allow_css",1,e)){if(_HWIO.data._css_[e.l])return"function"==typeof t&&setTimeout(t),_log("%c exist css "+e.l,"color:red");if(_HWIO.data._css0_[e.l])"function"==typeof t&&setTimeout(t);else{_HWIO.data._css0_[e.l]=1;var a,n,o=document.createElement("link"),i=_HWIO.assign(e,{rel:"stylesheet",media:e.media||"all",href:e.l}),r=_HWIO.data._ls_?null:document.getElementById("critical-css");for(a in e._id&&(i.id=e._id,delete e._id),i)-1===["l","t","deps","extra"].indexOf(a)&&(n=i[a],"id"!=a||i.extra||n.endsWith("-css")||(n+="-css"),o.setAttribute(a,n));o.onload=function(){_HWIO.data._css_[e.l]=1,_log("%c "+i.id,"color:green",e.l),"function"==typeof t&&t()},o.onerror=function(){_HWIO.data._css_[e.l]=1,"function"==typeof t&&t()},_HWIO.data._ls_?insertE(_HWIO.data._ls_,o,1):insertE(r||document.getElementsByTagName("head")[0].childNodes[0],o,1),_HWIO.data._ls_=o}}else"function"==typeof t&&setTimeout(t)},addEvent(document,"click",_fireOnce),addEvent(document,"mousemove",_fireOnce),addEvent(document,"mousewheel",_fireOnce),addEvent(document,"scroll",_fireOnce),addEvent(document,"touchmove",_fireOnce),addEvent(window,"scroll",_fireOnce),!instr(location.href,["?cls=","&cls="])&&(instr(navigator.userAgent,["gtmetrix","lighthouse","pingdompagespeed","PTST","X11;"])||navigator.webdriver)||_fireOnce();