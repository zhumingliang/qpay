parcelRequire=function(e,r,n,t){var i="function"==typeof parcelRequire&&parcelRequire,o="function"==typeof require&&require;function u(n,t){if(!r[n]){if(!e[n]){var f="function"==typeof parcelRequire&&parcelRequire;if(!t&&f)return f(n,!0);if(i)return i(n,!0);if(o&&"string"==typeof n)return o(n);var c=new Error("Cannot find module '"+n+"'");throw c.code="MODULE_NOT_FOUND",c}p.resolve=function(r){return e[n][1][r]||r},p.cache={};var l=r[n]=new u.Module(n);e[n][0].call(l.exports,p,l,l.exports,this)}return r[n].exports;function p(e){return u(p.resolve(e))}}u.isParcelRequire=!0,u.Module=function(e){this.id=e,this.bundle=u,this.exports={}},u.modules=e,u.cache=r,u.parent=i,u.register=function(r,n){e[r]=[function(e,r){r.exports=n},{}]};for(var f=0;f<n.length;f++)u(n[f]);if(n.length){var c=u(n[n.length-1]);"object"==typeof exports&&"undefined"!=typeof module?module.exports=c:"function"==typeof define&&define.amd?define(function(){return c}):t&&(this[t]=c)}return u}({"X5V9":[function(require,module,exports) {

},{}],"DWv3":[function(require,module,exports) {
"use strict";require("./code.less");var e=document.getElementById("page"),t=document.getElementById("client"),n=e.className,a=document.getElementById("qr"),c=document.getElementById("load"),r=document.getElementById("detail"),o=document.getElementById("txcurrcd"),i=document.getElementById("txamt"),d=location.search.slice(1),l=d.split("&"),p={};l.forEach(function(e){var t=e.split("="),n=t[0],a=t[1];p[n]=a});var s="";if(p.p1&&p.p2){s=p.p1+p.p2;try{s=decodeURIComponent(s)}catch(h){s=""}}var m="800101";switch(s){case"支付宝支付":m="800101",t.innerHTML="支付宝";break;case"微信支付":m="800201",t.innerHTML="微信";break;default:m="800101",t.innerHTML="支付宝"}function u(e){var t=e.data;o.innerHTML=t.txcurrcd,i.innerHTML=t.txamt,r.style.display="block"}axios.get("/api/v1/order/info").then(u).catch(function(e){axios.get("http://qpay.mengant.cn/api/v1/order/info").then(u)});var y={params:{type:m}};function g(e){var t=e.data.qrcode.replace("/","/");c.style.display="none",qr.src=t}axios.get("/api/v1/pay/qcode",y).then(g).catch(function(e){axios.get("http://qpay.mengant.cn/api/v1/pay/qcode",y).then(g)});
},{"./code.less":"X5V9"}]},{},["DWv3"], null)
//# sourceMappingURL=code.e6d65d90.map