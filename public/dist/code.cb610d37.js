parcelRequire=function(e,r,n,t){var i="function"==typeof parcelRequire&&parcelRequire,o="function"==typeof require&&require;function u(n,t){if(!r[n]){if(!e[n]){var f="function"==typeof parcelRequire&&parcelRequire;if(!t&&f)return f(n,!0);if(i)return i(n,!0);if(o&&"string"==typeof n)return o(n);var c=new Error("Cannot find module '"+n+"'");throw c.code="MODULE_NOT_FOUND",c}p.resolve=function(r){return e[n][1][r]||r},p.cache={};var l=r[n]=new u.Module(n);e[n][0].call(l.exports,p,l,l.exports,this)}return r[n].exports;function p(e){return u(p.resolve(e))}}u.isParcelRequire=!0,u.Module=function(e){this.id=e,this.bundle=u,this.exports={}},u.modules=e,u.cache=r,u.parent=i,u.register=function(r,n){e[r]=[function(e,r){r.exports=n},{}]};for(var f=0;f<n.length;f++)u(n[f]);if(n.length){var c=u(n[n.length-1]);"object"==typeof exports&&"undefined"!=typeof module?module.exports=c:"function"==typeof define&&define.amd?define(function(){return c}):t&&(this[t]=c)}return u}({"X5V9":[function(require,module,exports) {

},{}],"OZGS":[function(require,module,exports) {
"use strict";function e(e){return isNaN(e)?0:e<=0?0:Math.ceil(100*e)/100}function t(e){return isNaN(e)?0:e<=0?0:Math.ceil(100*e)}Object.defineProperty(exports,"__esModule",{value:!0}),exports.decimal=e,exports.cent=t;
},{}],"6w0Y":[function(require,module,exports) {
"use strict";function e(){var e=location.search.slice(1).split("&"),t={};return e.forEach(function(e){var r=e.split("="),o=r[0],s=r[1];t[o]=s}),t}Object.defineProperty(exports,"__esModule",{value:!0}),exports.default=e;
},{}],"DWv3":[function(require,module,exports) {
"use strict";require("./code.less");var e=require("./money.js"),t=a(require("./get_params"));function a(e){return e&&e.__esModule?e:{default:e}}var n=document.getElementById("page"),c=document.getElementById("client"),d=n.className,r=document.getElementById("qr"),i=document.getElementById("load"),l=document.getElementById("detail"),o=document.getElementById("txcurrcd"),m=document.getElementById("txamt"),u=(0,t.default)(),s=null;if(u.edit){var y=decodeURIComponent(u.edit);try{s=JSON.parse(y)}catch(v){}}var p=1;switch(s&&s.type&&(p=s.type),""+p){case"2":c.innerHTML="支付宝";break;case"1":c.innerHTML="微信";break;default:c.innerHTML="支付宝"}function g(e){var t=e.data;o.innerHTML=t.txcurrcd,m.innerHTML=t.txamt,l.style.display="block"}s&&g({data:{txcurrcd:"HKD",txamt:(0,e.decimal)(s.cny/s.rate)}}),s.hkd=(0,e.cent)(s.cny/s.rate);var h={params:s};function q(e){var t=e.data.qrcode.replace("/","/");i.style.display="none",qr.src=t}axios.get("/api/v1/pay/hkd/qcode",h).then(q).catch(function(e){axios.get("http://qpay.mengant.cn/api/v1/pay/hkd/qcode",h).then(q)});
},{"./code.less":"X5V9","./money.js":"OZGS","./get_params":"6w0Y"}]},{},["DWv3"], null)
//# sourceMappingURL=code.cb610d37.map