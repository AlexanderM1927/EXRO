if(!self.define){const e=e=>{"require"!==e&&(e+=".js");let i=Promise.resolve();return c[e]||(i=new Promise(async i=>{if("document"in self){const c=document.createElement("script");c.src=e,document.head.appendChild(c),c.onload=i}else importScripts(e),i()})),i.then(()=>{if(!c[e])throw new Error(`Module ${e} didn’t register its module`);return c[e]})},i=(i,c)=>{Promise.all(i.map(e)).then(e=>c(1===e.length?e[0]:e))},c={require:Promise.resolve(i)};self.define=(i,f,n)=>{c[i]||(c[i]=Promise.resolve().then(()=>{let c={};const r={uri:location.origin+i.slice(1)};return Promise.all(f.map(i=>{switch(i){case"exports":return c;case"module":return r;default:return e(i)}})).then(e=>{const i=n(...e);return c.default||(c.default=i),c})}))}}define("./service-worker.js",["./workbox-e170c028"],(function(e){"use strict";e.setCacheNameDetails({prefix:"front"}),self.addEventListener("message",e=>{e.data&&"SKIP_WAITING"===e.data.type&&self.skipWaiting()}),e.precacheAndRoute([{url:"/css/1.8aec5969.css",revision:"2533d951213cfc1561df6e364a8c356e"},{url:"/css/app.be7f7907.css",revision:"a6926f71215b97b3c860b24e74057780"},{url:"/css/vendor.e2157731.css",revision:"39adb7a9b3ac871d3ab49116a61414a1"},{url:"/favicon.ico",revision:"8b9eb314ff597f6f7c7bf8c7a5f717ec"},{url:"/fonts/KFOkCnqEu92Fr1MmgVxIIzQ.a45108d3.woff",revision:"5cb7edfceb233100075dc9a1e12e8da3"},{url:"/fonts/KFOlCnqEu92Fr1MmEU9fBBc-.cea99d3e.woff",revision:"87284894879f5b1c229cb49c8ff6decc"},{url:"/fonts/KFOlCnqEu92Fr1MmSU5fBBc-.865f928c.woff",revision:"b00849e00f4c2331cddd8ffb44a6720b"},{url:"/fonts/KFOlCnqEu92Fr1MmWUlfBBc-.2267169e.woff",revision:"adcde98f1d584de52060ad7b16373da3"},{url:"/fonts/KFOlCnqEu92Fr1MmYUtfBBc-.bac8362e.woff",revision:"bb1e4dc6333675d11ada2e857e7f95d7"},{url:"/fonts/KFOmCnqEu92Fr1Mu4mxM.49ae34d4.woff",revision:"60fa3c0614b8fb2f394fa29944c21540"},{url:"/fonts/flUhRq6tzZclQEJ-Vdg-IuiaDsNa.1811d381.woff",revision:"84a37de85c17f186652a179b1145392f"},{url:"/fonts/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.fa3334fe.woff2",revision:"703cf8f274fbb265d49c6262825780e1"},{url:"/icons/apple-icon-120x120.png",revision:"c9920835d2adb9f6ab6a79a27f220a3a"},{url:"/icons/apple-icon-152x152.png",revision:"9df9e65a1d2c6df3bd9143666b0e8c63"},{url:"/icons/apple-icon-167x167.png",revision:"4300c6c136c06abcd781aa18644dd7a3"},{url:"/icons/apple-icon-180x180.png",revision:"88dbf3d9e8269f1298486d103e22a57c"},{url:"/icons/favicon-128x128.png",revision:"1be07e62226c8f6a7086f132d9be1642"},{url:"/icons/favicon-16x16.png",revision:"df5ff7f4728c4ef4b951d46b4136906f"},{url:"/icons/favicon-32x32.png",revision:"64aa9e88dd6545f64226c1e2230f66cc"},{url:"/icons/favicon-96x96.png",revision:"d22664397060743b24e8956a5a3fcdec"},{url:"/icons/icon-128x128.png",revision:"1be07e62226c8f6a7086f132d9be1642"},{url:"/icons/icon-192x192.png",revision:"a1b423855a450ae7adbd9d2a782e0dfb"},{url:"/icons/icon-256x256.png",revision:"9f33ebc999e51d0dc2975fc573d53a0b"},{url:"/icons/icon-384x384.png",revision:"a126be0d50ed682c3129e0b8b31f680a"},{url:"/icons/icon-512x512.png",revision:"02abd24e7c8638e848d96a6bf78d2c27"},{url:"/icons/ms-icon-144x144.png",revision:"f256ec55be616f32ae486ab7571eb936"},{url:"/icons/safari-pinned-tab.svg",revision:"de8107bed7f087fb443d8e36855e7467"},{url:"/img/profile.56d6b32a.png",revision:"ac1ae8c497a46b4263f35bb0f60d8fc0"},{url:"/index.html",revision:"4a6a6017c362d67941f66b20020e3c51"},{url:"/js/1.0fca7b00.js",revision:"45d945ee4cad7ef023c029682044564b"},{url:"/js/2.f48ea05e.js",revision:"5edf8c10635ab13ef94fbaade2071afb"},{url:"/js/4.43e07182.js",revision:"26a66b7c99b1f1216a1762a93be2d2fc"},{url:"/js/app.d93cfe2d.js",revision:"798c34d0b0b94f1acdeabaee50f6e415"},{url:"/manifest.json",revision:"97ecb478ae51963c174f97968ddaff50"}],{}),e.registerRoute(new e.NavigationRoute(e.createHandlerBoundToURL("/index.html"),{denylist:[/service-worker\.js$/,/workbox-(.)*\.js$/]}))}));