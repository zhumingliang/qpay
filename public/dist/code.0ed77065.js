parcelRequire=function(e,r,n,t){var i="function"==typeof parcelRequire&&parcelRequire,o="function"==typeof require&&require;function u(n,t){if(!r[n]){if(!e[n]){var f="function"==typeof parcelRequire&&parcelRequire;if(!t&&f)return f(n,!0);if(i)return i(n,!0);if(o&&"string"==typeof n)return o(n);var c=new Error("Cannot find module '"+n+"'");throw c.code="MODULE_NOT_FOUND",c}p.resolve=function(r){return e[n][1][r]||r},p.cache={};var l=r[n]=new u.Module(n);e[n][0].call(l.exports,p,l,l.exports,this)}return r[n].exports;function p(e){return u(p.resolve(e))}}u.isParcelRequire=!0,u.Module=function(e){this.id=e,this.bundle=u,this.exports={}},u.modules=e,u.cache=r,u.parent=i,u.register=function(r,n){e[r]=[function(e,r){r.exports=n},{}]};for(var f=0;f<n.length;f++)u(n[f]);if(n.length){var c=u(n[n.length-1]);"object"==typeof exports&&"undefined"!=typeof module?module.exports=c:"function"==typeof define&&define.amd?define(function(){return c}):t&&(this[t]=c)}return u}({"X5V9":[function(require,module,exports) {

},{}],"6w0Y":[function(require,module,exports) {
"use strict";function e(){var e=location.search.slice(1).split("&"),t={};return e.forEach(function(e){var r=e.split("="),o=r[0],s=r[1];t[o]=s}),t}Object.defineProperty(exports,"__esModule",{value:!0}),exports.default=e;
},{}],"DWv3":[function(require,module,exports) {
"use strict";require("./code.less");var e=t(require("./get_params"));function t(e){return e&&e.__esModule?e:{default:e}}var n=document.getElementById("page"),a=document.getElementById("client"),c=n.className,r=document.getElementById("qr"),d=document.getElementById("load"),i=document.getElementById("detail"),o=document.getElementById("txcurrcd"),p=document.getElementById("txamt"),m=(0,e.default)(),l="";if(m.p1&&m.p3){l=m.p1+m.p3;try{l=decodeURIComponent(l)}catch(v){l=""}}var s="800101";switch(l){case"支付宝支付":s="800101",a.innerHTML="支付宝";break;case"微信支付":s="800201",a.innerHTML="微信";break;default:s="800101",a.innerHTML="支付宝"}function u(e){var t=e.data;o.innerHTML=t.txcurrcd,p.innerHTML=t.txamt,i.style.display="block"}var y={params:{id:m.p2}};axios.get("/api/v1/order/info",y).then(u).catch(function(e){axios.get("http://qpay.mengant.cn/api/v1/order/info",y).then(u)});var g={params:{type:s,id:m.p2}};function f(e){var t=e.data.qrcode.replace("/","/");d.style.display="none",qr.src=t}axios.get("/api/v1/pay/qcode",g).then(f).catch(function(e){axios.get("http://qpay.mengant.cn/api/v1/pay/qcode",g).then(f)});
},{"./code.less":"X5V9","./get_params":"6w0Y"}]},{},["DWv3"], null)
//# sourceMappingURL=code.0ed77065.map