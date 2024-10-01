/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (() => {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: C:\\xampp\\htdocs\\resources\\js\\app.js: Support for the experimental syntax 'jsx' isn't currently enabled (7:21):\n\n\u001b[0m \u001b[90m 5 |\u001b[39m\n \u001b[90m 6 |\u001b[39m \u001b[36mif\u001b[39m (document\u001b[33m.\u001b[39mgetElementById(\u001b[32m'platform-items'\u001b[39m)) {\n\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 7 |\u001b[39m     \u001b[33mReactDOM\u001b[39m\u001b[33m.\u001b[39mrender(\u001b[33m<\u001b[39m\u001b[33mPlatformItems\u001b[39m \u001b[33m/\u001b[39m\u001b[33m>\u001b[39m\u001b[33m,\u001b[39m document\u001b[33m.\u001b[39mgetElementById(\u001b[32m'platform-items'\u001b[39m))\u001b[33m;\u001b[39m\n \u001b[90m   |\u001b[39m                     \u001b[31m\u001b[1m^\u001b[22m\u001b[39m\n \u001b[90m 8 |\u001b[39m }\n \u001b[90m 9 |\u001b[39m\u001b[0m\n\nAdd @babel/preset-react (https://github.com/babel/babel/tree/main/packages/babel-preset-react) to the 'presets' section of your Babel config to enable transformation.\nIf you want to leave it as-is, add @babel/plugin-syntax-jsx (https://github.com/babel/babel/tree/main/packages/babel-plugin-syntax-jsx) to the 'plugins' section to enable parsing.\n\nIf you already added the plugin for this syntax to your config, it's possible that your config isn't being loaded.\nYou can re-run Babel with the BABEL_SHOW_CONFIG_FOR environment variable to show the loaded configuration:\n\tnpx cross-env BABEL_SHOW_CONFIG_FOR=C:\\xampp\\htdocs\\resources\\js\\app.js <your build command>\nSee https://babeljs.io/docs/configuration#print-effective-configs for more info.\n\n    at constructor (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:362:19)\n    at Parser.raise (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:3260:19)\n    at Parser.expectOnePlugin (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:3294:18)\n    at Parser.parseExprAtom (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10929:18)\n    at Parser.parseExprSubscripts (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10584:23)\n    at Parser.parseUpdate (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10569:21)\n    at Parser.parseMaybeUnary (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10549:23)\n    at Parser.parseMaybeUnaryOrPrivate (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10403:61)\n    at Parser.parseExprOps (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10408:23)\n    at Parser.parseMaybeConditional (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10385:23)\n    at Parser.parseMaybeAssign (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10348:21)\n    at C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10318:39\n    at Parser.allowInAnd (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:11933:12)\n    at Parser.parseMaybeAssignAllowIn (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10318:17)\n    at Parser.parseExprListItem (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:11693:18)\n    at Parser.parseCallExpressionArguments (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10770:22)\n    at Parser.parseCoverCallAndAsyncArrowHead (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10687:29)\n    at Parser.parseSubscript (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10624:19)\n    at Parser.parseSubscripts (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10597:19)\n    at Parser.parseExprSubscripts (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10588:17)\n    at Parser.parseUpdate (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10569:21)\n    at Parser.parseMaybeUnary (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10549:23)\n    at Parser.parseMaybeUnaryOrPrivate (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10403:61)\n    at Parser.parseExprOps (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10408:23)\n    at Parser.parseMaybeConditional (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10385:23)\n    at Parser.parseMaybeAssign (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10348:21)\n    at Parser.parseExpressionBase (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10302:23)\n    at C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10298:39\n    at Parser.allowInAnd (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:11928:16)\n    at Parser.parseExpression (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:10298:17)\n    at Parser.parseStatementContent (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12372:23)\n    at Parser.parseStatementLike (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12239:17)\n    at Parser.parseStatementListItem (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12219:17)\n    at Parser.parseBlockOrModuleBlockBody (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12792:61)\n    at Parser.parseBlockBody (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12785:10)\n    at Parser.parseBlock (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12773:10)\n    at Parser.parseStatementContent (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12329:21)\n    at Parser.parseStatementLike (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12239:17)\n    at Parser.parseStatementOrSloppyAnnexBFunctionDeclaration (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12229:17)\n    at Parser.parseIfStatement (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12606:28)\n    at Parser.parseStatementContent (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12268:21)\n    at Parser.parseStatementLike (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12239:17)\n    at Parser.parseModuleItem (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12216:17)\n    at Parser.parseBlockOrModuleBlockBody (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12792:36)\n    at Parser.parseBlockBody (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12785:10)\n    at Parser.parseProgram (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12113:10)\n    at Parser.parseTopLevel (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:12103:25)\n    at Parser.parse (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:13915:10)\n    at parse (C:\\xampp\\htdocs\\node_modules\\@babel\\parser\\lib\\index.js:13949:38)\n    at parser (C:\\xampp\\htdocs\\node_modules\\@babel\\core\\lib\\parser\\index.js:41:34)");

/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/public/js/app": 0,
/******/ 			"public/css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["public/css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["public/css/app"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;