/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 248);
/******/ })
/************************************************************************/
/******/ ({

/***/ 1:
/***/ (function(module, exports) {

// this module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  scopeId,
  cssModules
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  // inject cssModules
  if (cssModules) {
    var computed = Object.create(options.computed || null)
    Object.keys(cssModules).forEach(function (key) {
      var module = cssModules[key]
      computed[key] = function () { return module }
    })
    options.computed = computed
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ 137:
/***/ (function(module, exports, __webpack_require__) {

//import router from './routes';
var VueTruncate = __webpack_require__(243);
Vue.use(VueTruncate);

var self = ''; //set self equal to empty string to be used in axios
var app1 = new Vue({
  el: '#loginn',
  data: {
    email: '',
    password: '',
    login: true, //normal login button
    loading: false, //loading login button
    disabled: false, //disable buttons
    request_status: '',
    message: '',
    type: 'Choose what you want to request for',
    styleObject: { //this is for styling the message in login view
      color: ''
    }
  },
  methods: {
    showloading: function showloading() {
      //function triggered on form submit
      this.login = false, this.loading = true, $('.dont-show').css("visibility", "visible");
      this.disabled = true, self = this; //set self equal to this(which is the vue data)
      axios({ //ajax request to login controller
        method: 'post',
        url: '/login',
        data: { //data to be sent along with ajax request
          email: self.email, //email from vue data
          password: self.password //password from vue data
        }
      }).then(function (response) {
        //response
        console.log(response);
        if (response.status == 200) {
          self.message = 'Logged in successful, redirecting to dashboard...'; //set message in vue data
          self.styleObject.color = '#52a6d5'; //set style color in vue data
          self.disabled = true; //set disabled in view data
          setTimeout(function () {
            //redirect to dashboard after certain seconds
            window.location.href = '/login';
          }, 2000);
        }
      }).catch(function (error) {
        //error
        console.log(error.response);
        if (error.response.status == 422) {
          self.message = error.response.data.email;
          self.login = true;
          self.loading = false;
          self.styleObject.color = 'red';
          self.disabled = false; //set disabled in view data
        }
      });
    }
  }
});

Vue.component('startup', __webpack_require__(195));
Vue.component('startup-auth', __webpack_require__(194));
Vue.component('idea', __webpack_require__(193));
Vue.component('idea-auth', __webpack_require__(192));

/***/ }),

/***/ 157:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

var csrf_token = $('meta[name="csrf-token"]').attr('content');
/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            one: '',
            two: '',
            three: '',
            four: '',
            csrf: ''
        };
    },

    methods: {
        addtwo: function addtwo() {
            this.two = true;
        },
        addthree: function addthree() {
            this.three = true;
        },
        addfour: function addfour() {
            this.four = true;
        },
        removetwo: function removetwo() {
            this.two = false, $("#two :input").val('');
        },
        removethree: function removethree() {
            this.three = false;
            $("#three :input").val('');
        },
        removefour: function removefour() {
            this.four = false;
            $("#four :input").val('');
        }
    },
    mounted: function mounted() {
        this.csrf = window.Laravel.csrfToken;
    }
});

/***/ }),

/***/ 158:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      one: '',
      two: '',
      three: '',
      four: '',
      csrf: ''
    };
  },

  methods: {
    addtwo: function addtwo() {
      this.two = true;
    },
    addthree: function addthree() {
      this.three = true;
    },
    addfour: function addfour() {
      this.four = true;
    },
    removetwo: function removetwo() {
      this.two = false, $("#two :input").val('');
    },
    removethree: function removethree() {
      this.three = false;
      $("#three :input").val('');
    },
    removefour: function removefour() {
      this.four = false;
      $("#four :input").val('');
    }
  },
  mounted: function mounted() {
    this.csrf = window.Laravel.csrfToken;
  }
});

/***/ }),

/***/ 159:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      one: '',
      two: '',
      three: '',
      four: '',
      csrf: ''
    };
  },

  methods: {
    addtwo: function addtwo() {
      this.two = true;
    },
    addthree: function addthree() {
      this.three = true;
    },
    addfour: function addfour() {
      this.four = true;
    },
    removetwo: function removetwo() {
      this.two = false, $("#two :input").val('');
    },
    removethree: function removethree() {
      this.three = false;
      $("#three :input").val('');
    },
    removefour: function removefour() {
      this.four = false;
      $("#four :input").val('');
    }
  },
  mounted: function mounted() {
    this.csrf = window.Laravel.csrfToken;
  }
});

/***/ }),

/***/ 160:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      one: '',
      two: '',
      three: '',
      four: '',
      csrf: ''
    };
  },

  methods: {
    addtwo: function addtwo() {
      this.two = true;
    },
    addthree: function addthree() {
      this.three = true;
    },
    addfour: function addfour() {
      this.four = true;
    },
    removetwo: function removetwo() {
      this.two = false, $("#two :input").val('');
    },
    removethree: function removethree() {
      this.three = false;
      $("#three :input").val('');
    },
    removefour: function removefour() {
      this.four = false;
      $("#four :input").val('');
    }
  },
  mounted: function mounted() {
    this.csrf = window.Laravel.csrfToken;
  }
});

/***/ }),

/***/ 183:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(3)();
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

/***/ }),

/***/ 184:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(3)();
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

/***/ }),

/***/ 185:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(3)();
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

/***/ }),

/***/ 186:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(3)();
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

/***/ }),

/***/ 192:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(239)

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(157),
  /* template */
  __webpack_require__(221),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/Users/runor/larasites/onlinetheinnovestors/resources/assets/js/components/Request-idea-auth.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Request-idea-auth.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3185b6c0", Component.options)
  } else {
    hotAPI.reload("data-v-3185b6c0", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 193:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(240)

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(158),
  /* template */
  __webpack_require__(222),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/Users/runor/larasites/onlinetheinnovestors/resources/assets/js/components/Request-idea.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Request-idea.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-337a4cf6", Component.options)
  } else {
    hotAPI.reload("data-v-337a4cf6", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 194:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(238)

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(159),
  /* template */
  __webpack_require__(219),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/Users/runor/larasites/onlinetheinnovestors/resources/assets/js/components/Request-startup-auth.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Request-startup-auth.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1dbcc1f4", Component.options)
  } else {
    hotAPI.reload("data-v-1dbcc1f4", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 195:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(241)

var Component = __webpack_require__(1)(
  /* script */
  __webpack_require__(160),
  /* template */
  __webpack_require__(223),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/Users/runor/larasites/onlinetheinnovestors/resources/assets/js/components/Request-startup.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Request-startup.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-46ae1142", Component.options)
  } else {
    hotAPI.reload("data-v-46ae1142", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 219:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', [_c('form', {
    staticClass: "form-horizontal",
    attrs: {
      "action": "/request_team",
      "method": "POST",
      "role": "form",
      "id": "startup",
      "files": "true",
      "enctype": "multipart/form-data"
    }
  }, [_c('input', {
    attrs: {
      "type": "hidden",
      "name": "_token"
    },
    domProps: {
      "value": _vm.csrf
    }
  }), _vm._v(" "), _c('h4', {
    staticClass: "text-center"
  }, [_vm._v("A Startup Member Requests")]), _vm._v(" "), _c('input', {
    attrs: {
      "type": "text",
      "name": "type",
      "value": "Startup",
      "hidden": ""
    }
  }), _vm._v(" "), _vm._m(0), _vm._v(" "), _vm._m(1), _vm._v(" "), _vm._m(2), _vm._v(" "), _c('section', {
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px"
    }
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    staticStyle: {
      "color": "#27ad60"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.addtwo()
      }
    }
  }, [_vm._v("Add Team Member "), _c('span', {
    staticClass: "glyphicon glyphicon-plus small",
    staticStyle: {
      "color": "#27ad60"
    }
  })])]), _vm._v(" "), _vm._m(3), _vm._v(" "), _vm._m(4)]), _vm._v(" "), _c('section', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.two),
      expression: "two"
    }],
    staticClass: "row two",
    staticStyle: {
      "margin-bottom": "10px",
      "display": "none"
    },
    attrs: {
      "id": "two"
    }
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    staticStyle: {
      "color": "#27ad60"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.addthree()
      }
    }
  }, [_vm._v("Add Team Member "), _c('span', {
    staticClass: "glyphicon glyphicon-plus small",
    staticStyle: {
      "color": "#27ad60"
    }
  })])]), _vm._v(" "), _vm._m(5), _vm._v(" "), _vm._m(6), _vm._v(" "), _c('a', {
    staticStyle: {
      "color": "red"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.removetwo()
      }
    }
  }, [_c('span', {
    staticClass: "glyphicon glyphicon-minus",
    staticStyle: {
      "color": "red"
    }
  }), _vm._v(" remove")])]), _vm._v(" "), _c('section', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.three),
      expression: "three"
    }],
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px",
      "display": "none"
    },
    attrs: {
      "id": "three"
    }
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    staticStyle: {
      "color": "#27ad60"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.addfour()
      }
    }
  }, [_vm._v("Add Team Member "), _c('span', {
    staticClass: "glyphicon glyphicon-plus small",
    staticStyle: {
      "color": "#27ad60"
    }
  })])]), _vm._v(" "), _vm._m(7), _vm._v(" "), _vm._m(8), _vm._v(" "), _c('a', {
    staticStyle: {
      "color": "red"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.removethree()
      }
    }
  }, [_c('span', {
    staticClass: "glyphicon glyphicon-minus",
    staticStyle: {
      "color": "red"
    }
  }), _vm._v(" remove")])]), _vm._v(" "), _c('section', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.four),
      expression: "four"
    }],
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px",
      "display": "none"
    },
    attrs: {
      "id": "four"
    }
  }, [_vm._m(9), _vm._v(" "), _vm._m(10), _vm._v(" "), _vm._m(11), _vm._v(" "), _c('a', {
    staticStyle: {
      "color": "red"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.removefour()
      }
    }
  }, [_c('span', {
    staticClass: "glyphicon glyphicon-minus",
    staticStyle: {
      "color": "red"
    }
  }), _vm._v(" remove")])]), _vm._v(" "), _vm._m(12), _vm._v(" "), _vm._m(13), _vm._v(" "), _vm._m(14), _vm._v(" "), _vm._m(15), _vm._v(" "), _vm._m(16), _vm._v(" "), _vm._m(17)])])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "title"
    }
  }, [_vm._v("Startup Name"), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "title",
      "id": "title",
      "placeholder": "Startup Name",
      "minlength": "4",
      "required": ""
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "description"
    }
  }, [_vm._v("Brief Description "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "description",
      "id": "description",
      "placeholder": "Brief Decription",
      "minlength": "4",
      "required": ""
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "company_name"
    }
  }, [_vm._v("Category "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('select', {
    staticClass: "form-control",
    attrs: {
      "name": "category"
    }
  }, [_c('option', {
    attrs: {
      "value": "Engineering",
      "selected": ""
    }
  }, [_vm._v("Engineering")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Agriculture"
    }
  }, [_vm._v("Agriculture")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Power and Energy"
    }
  }, [_vm._v("Power and Energy")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Healthcare"
    }
  }, [_vm._v("Healthcare")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Education"
    }
  }, [_vm._v("Education")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Design"
    }
  }, [_vm._v("Design")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Environment"
    }
  }, [_vm._v("Environment")])])])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role1",
      "id": "role1",
      "placeholder": "Member Role",
      "minlength": "4",
      "required": ""
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_1",
      "id": "function_1",
      "placeholder": "Member's role",
      "minlength": "4",
      "required": ""
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role2",
      "id": "role2",
      "placeholder": "Team member Position",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_2",
      "id": "function_2",
      "placeholder": "Member's role",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role3",
      "id": "role3",
      "placeholder": "Team member Position",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_3",
      "id": "function_3",
      "placeholder": "Member's role",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    attrs: {
      "href": "#"
    }
  }, [_vm._v(" ")])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role4",
      "id": "role4",
      "placeholder": "Team member Position",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_4",
      "id": "function_4",
      "placeholder": "Member's role",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "additional"
    }
  }, [_vm._v("Additional Info")]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('textarea', {
    staticClass: "form-control",
    attrs: {
      "placeholder": "Additional Information",
      "name": "additional",
      "id": "additional"
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "phone"
    }
  }, [_vm._v("Phone "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "phone",
      "id": "phone",
      "required": "",
      "placeholder": "We only use it, people don’t get to see it!",
      "required": ""
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "contactname"
    }
  }, [_vm._v("Name "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "name",
      "id": "name",
      "required": "",
      "placeholder": "Name",
      "required": "",
      "minlength": "4"
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "email"
    }
  }, [_vm._v("Email "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "email",
      "id": "email",
      "required": "",
      "placeholder": "Email Address",
      "required": "true"
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "password"
    }
  }, [_vm._v("Password "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "password",
      "name": "password",
      "id": "password",
      "required": "",
      "placeholder": "Type password (at least 6 letters)",
      "required": "true"
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-3"
  }, [_c('button', {
    staticClass: "btn btn-success btn-block btn-md",
    attrs: {
      "type": "submit"
    }
  }, [_vm._v("\n                        Request Now\n                    ")])])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-1dbcc1f4", module.exports)
  }
}

/***/ }),

/***/ 221:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', [_c('form', {
    staticClass: "form-horizontal",
    attrs: {
      "action": "/request_team",
      "method": "POST",
      "role": "form",
      "id": "idea",
      "files": "true",
      "enctype": "multipart/form-data"
    }
  }, [_c('input', {
    attrs: {
      "type": "hidden",
      "name": "_token"
    },
    domProps: {
      "value": _vm.csrf
    }
  }), _vm._v(" "), _c('h4', {
    staticClass: "text-center"
  }, [_vm._v("An Idea Team Member's Requests")]), _vm._v(" "), _c('input', {
    attrs: {
      "type": "text",
      "name": "type",
      "value": "Idea",
      "hidden": ""
    }
  }), _vm._v(" "), _vm._m(0), _vm._v(" "), _vm._m(1), _vm._v(" "), _vm._m(2), _vm._v(" "), _c('section', {
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px"
    }
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    staticStyle: {
      "color": "#27ad60"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.addtwo()
      }
    }
  }, [_vm._v("Add Team Member  "), _c('span', {
    staticClass: "glyphicon glyphicon-plus small",
    staticStyle: {
      "color": "#27ad60"
    }
  })])]), _vm._v(" "), _vm._m(3), _vm._v(" "), _vm._m(4)]), _vm._v(" "), _c('section', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.two),
      expression: "two"
    }],
    staticClass: "row two",
    staticStyle: {
      "margin-bottom": "10px",
      "display": "none"
    },
    attrs: {
      "id": "two"
    }
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    staticStyle: {
      "color": "#27ad60"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.addthree()
      }
    }
  }, [_vm._v("Add Team Member "), _c('span', {
    staticClass: "glyphicon glyphicon-plus small",
    staticStyle: {
      "color": "#27ad60"
    }
  })])]), _vm._v(" "), _vm._m(5), _vm._v(" "), _vm._m(6), _vm._v(" "), _c('a', {
    staticStyle: {
      "color": "red"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.removetwo()
      }
    }
  }, [_c('span', {
    staticClass: "glyphicon glyphicon-minus",
    staticStyle: {
      "color": "red"
    }
  }), _vm._v(" remove")])]), _vm._v(" "), _c('section', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.three),
      expression: "three"
    }],
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px",
      "display": "none"
    },
    attrs: {
      "id": "three"
    }
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    staticStyle: {
      "color": "#27ad60"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.addfour()
      }
    }
  }, [_vm._v("Add Team Member "), _c('span', {
    staticClass: "glyphicon glyphicon-plus small",
    staticStyle: {
      "color": "#27ad60"
    }
  })])]), _vm._v(" "), _vm._m(7), _vm._v(" "), _vm._m(8), _vm._v(" "), _c('a', {
    staticStyle: {
      "color": "red"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.removethree()
      }
    }
  }, [_c('span', {
    staticClass: "glyphicon glyphicon-minus",
    staticStyle: {
      "color": "red"
    }
  }), _vm._v(" remove")])]), _vm._v(" "), _c('section', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.four),
      expression: "four"
    }],
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px",
      "display": "none"
    },
    attrs: {
      "id": "four"
    }
  }, [_vm._m(9), _vm._v(" "), _vm._m(10), _vm._v(" "), _vm._m(11), _vm._v(" "), _c('a', {
    staticStyle: {
      "color": "red"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.removefour()
      }
    }
  }, [_c('span', {
    staticClass: "glyphicon glyphicon-minus",
    staticStyle: {
      "color": "red"
    }
  }), _vm._v(" remove")])]), _vm._v(" "), _vm._m(12), _vm._v(" "), _vm._m(13), _vm._v(" "), _vm._m(14), _vm._v(" "), _vm._m(15), _vm._v(" "), _vm._m(16), _vm._v(" "), _vm._m(17)])])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "title"
    }
  }, [_vm._v("I have a working idea on: "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "title",
      "id": "title",
      "placeholder": "Name of Idea",
      "minlength": "4",
      "required": ""
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "description"
    }
  }, [_vm._v("Brief Description: "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "description",
      "id": "description",
      "placeholder": "Idea Description",
      "minlength": "4",
      "required": ""
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "company_name"
    }
  }, [_vm._v("Category "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('select', {
    staticClass: "form-control",
    attrs: {
      "name": "category"
    }
  }, [_c('option', {
    attrs: {
      "value": "Engineering",
      "selected": ""
    }
  }, [_vm._v("Engineering")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Agriculture"
    }
  }, [_vm._v("Agriculture")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Power and Energy"
    }
  }, [_vm._v("Power and Energy")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Healthcare"
    }
  }, [_vm._v("Healthcare")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Education"
    }
  }, [_vm._v("Education")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Design"
    }
  }, [_vm._v("Design")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Environment"
    }
  }, [_vm._v("Environment")])])])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role1",
      "id": "role1",
      "placeholder": "Member Role",
      "minlength": "4",
      "required": ""
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_1",
      "id": "function_1",
      "placeholder": "Member's role",
      "minlength": "4",
      "required": ""
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role2",
      "id": "role2",
      "placeholder": "Team member Position",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_2",
      "id": "function_2",
      "placeholder": "Member's role",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role3",
      "id": "role3",
      "placeholder": "Team member Position",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_3",
      "id": "function_3",
      "placeholder": "Member's role",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    attrs: {
      "href": "#"
    }
  }, [_vm._v(" ")])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role4",
      "id": "role4",
      "placeholder": "Team member Position",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_4",
      "id": "function_4",
      "placeholder": "Member's role",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "additional"
    }
  }, [_vm._v("Additional Info")]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('textarea', {
    staticClass: "form-control",
    attrs: {
      "placeholder": "Additional Information",
      "name": "additional",
      "id": "additional",
      "minlength": "15"
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "phone"
    }
  }, [_vm._v("Phone "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "phone",
      "id": "phone",
      "required": "",
      "placeholder": "We only use it, people don’t get to see it!",
      "required": ""
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "contactname"
    }
  }, [_vm._v("Name "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "name",
      "id": "name",
      "required": "",
      "placeholder": "Name",
      "required": "",
      "minlength": "4"
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "email"
    }
  }, [_vm._v("Email "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "email",
      "id": "email",
      "required": "",
      "placeholder": "Email Address",
      "required": "true"
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "password"
    }
  }, [_vm._v("Password "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "password",
      "name": "password",
      "id": "password",
      "required": "",
      "placeholder": "Type password (at least 6 letters)",
      "required": "true"
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-3"
  }, [_c('button', {
    staticClass: "btn btn-primary btn-block btn-md",
    attrs: {
      "type": "submit"
    }
  }, [_vm._v("\n                        Request Now\n                    ")])])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-3185b6c0", module.exports)
  }
}

/***/ }),

/***/ 222:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', [_c('form', {
    staticClass: "form-horizontal",
    attrs: {
      "action": "/request_team",
      "method": "POST",
      "role": "form",
      "id": "idea",
      "files": "true",
      "enctype": "multipart/form-data"
    }
  }, [_c('input', {
    attrs: {
      "type": "hidden",
      "name": "_token"
    },
    domProps: {
      "value": _vm.csrf
    }
  }), _vm._v(" "), _c('h4', {
    staticClass: "text-center"
  }, [_vm._v("An Idea Team Member's Requests")]), _vm._v(" "), _c('input', {
    attrs: {
      "type": "text",
      "name": "type",
      "value": "Idea",
      "hidden": ""
    }
  }), _vm._v(" "), _vm._m(0), _vm._v(" "), _vm._m(1), _vm._v(" "), _vm._m(2), _vm._v(" "), _c('section', {
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px"
    }
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    staticStyle: {
      "color": "#27ad60"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.addtwo()
      }
    }
  }, [_vm._v("Add Team Member "), _c('span', {
    staticClass: "glyphicon glyphicon-plus small",
    staticStyle: {
      "color": "#27ad60"
    }
  })])]), _vm._v(" "), _vm._m(3), _vm._v(" "), _vm._m(4)]), _vm._v(" "), _c('section', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.two),
      expression: "two"
    }],
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px",
      "display": "none"
    },
    attrs: {
      "id": "two"
    }
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    staticStyle: {
      "color": "#27ad60"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.addthree()
      }
    }
  }, [_vm._v("Add Team Member "), _c('span', {
    staticClass: "glyphicon glyphicon-plus small",
    staticStyle: {
      "color": "#27ad60"
    }
  })])]), _vm._v(" "), _vm._m(5), _vm._v(" "), _vm._m(6), _vm._v(" "), _c('a', {
    staticStyle: {
      "color": "red"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.removetwo()
      }
    }
  }, [_c('span', {
    staticClass: "glyphicon glyphicon-minus",
    staticStyle: {
      "color": "red"
    }
  }), _vm._v(" remove")])]), _vm._v(" "), _c('section', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.three),
      expression: "three"
    }],
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px",
      "display": "none"
    },
    attrs: {
      "id": "three"
    }
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    staticStyle: {
      "color": "#27ad60"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.addfour()
      }
    }
  }, [_vm._v("Add Team Member "), _c('span', {
    staticClass: "glyphicon glyphicon-plus small",
    staticStyle: {
      "color": "#27ad60"
    }
  })])]), _vm._v(" "), _vm._m(7), _vm._v(" "), _vm._m(8), _vm._v(" "), _c('a', {
    staticStyle: {
      "color": "red"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.removethree()
      }
    }
  }, [_c('span', {
    staticClass: "glyphicon glyphicon-minus",
    staticStyle: {
      "color": "red"
    }
  }), _vm._v(" remove")])]), _vm._v(" "), _c('section', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.four),
      expression: "four"
    }],
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px",
      "display": "none"
    },
    attrs: {
      "id": "four"
    }
  }, [_vm._m(9), _vm._v(" "), _vm._m(10), _vm._v(" "), _vm._m(11), _vm._v(" "), _c('a', {
    staticStyle: {
      "color": "red"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.removefour()
      }
    }
  }, [_c('span', {
    staticClass: "glyphicon glyphicon-minus",
    staticStyle: {
      "color": "red"
    }
  }), _vm._v(" remove")])]), _vm._v(" "), _vm._m(12), _vm._v(" "), _vm._m(13)])])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "title"
    }
  }, [_vm._v("I have a working idea on: "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "title",
      "id": "title",
      "placeholder": "Idea Description",
      "minlength": "4",
      "required": ""
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "description"
    }
  }, [_vm._v("Brief Description: "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "description",
      "id": "description",
      "placeholder": "Idea Description",
      "minlength": "4",
      "required": ""
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "company_name"
    }
  }, [_vm._v("Category "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('select', {
    staticClass: "form-control",
    attrs: {
      "name": "category"
    }
  }, [_c('option', {
    attrs: {
      "value": "Engineering",
      "selected": ""
    }
  }, [_vm._v("Engineering")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Agriculture"
    }
  }, [_vm._v("Agriculture")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Power and Energy"
    }
  }, [_vm._v("Power and Energy")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Healthcare"
    }
  }, [_vm._v("Healthcare")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Education"
    }
  }, [_vm._v("Education")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Design"
    }
  }, [_vm._v("Design")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Environment"
    }
  }, [_vm._v("Environment")])])])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role1",
      "id": "role1",
      "placeholder": "Member Role",
      "minlength": "4",
      "required": ""
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_1",
      "id": "function_1",
      "placeholder": "Member's role",
      "minlength": "4",
      "required": ""
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role2",
      "id": "role2",
      "placeholder": "Team member Position",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_2",
      "id": "function_2",
      "placeholder": "Member's role",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role3",
      "id": "role3",
      "placeholder": "Team member Position",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_3",
      "id": "function_3",
      "placeholder": "Member's role",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    staticStyle: {
      "color": "#27ad60"
    },
    attrs: {
      "href": "#"
    }
  }, [_vm._v(" ")])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role4",
      "id": "role4",
      "placeholder": "Team member Position",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_4",
      "id": "function_4",
      "placeholder": "Member's role",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "additional"
    }
  }, [_vm._v("Additional Info")]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('textarea', {
    staticClass: "form-control",
    attrs: {
      "placeholder": "Additional Information",
      "name": "additional",
      "id": "additional"
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-3"
  }, [_c('button', {
    staticClass: "btn btn-primary btn-block btn-md",
    attrs: {
      "type": "submit"
    }
  }, [_vm._v("\n                        Request Now\n                    ")])])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-337a4cf6", module.exports)
  }
}

/***/ }),

/***/ 223:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', [_c('form', {
    staticClass: "form-horizontal",
    attrs: {
      "action": "/request_team",
      "method": "POST",
      "role": "form",
      "id": "startup",
      "files": "true",
      "enctype": "multipart/form-data"
    }
  }, [_c('input', {
    attrs: {
      "type": "hidden",
      "name": "_token"
    },
    domProps: {
      "value": _vm.csrf
    }
  }), _vm._v(" "), _c('h4', {
    staticClass: "text-center"
  }, [_vm._v("A Startup Member Requests")]), _vm._v(" "), _c('input', {
    attrs: {
      "type": "text",
      "name": "type",
      "value": "Startup",
      "hidden": ""
    }
  }), _vm._v(" "), _vm._m(0), _vm._v(" "), _vm._m(1), _vm._v(" "), _vm._m(2), _vm._v(" "), _c('section', {
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px"
    }
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    staticStyle: {
      "color": "#27ad60"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.addtwo()
      }
    }
  }, [_vm._v("Add Team Member "), _c('span', {
    staticClass: "glyphicon glyphicon-plus small",
    staticStyle: {
      "color": "#27ad60"
    }
  })])]), _vm._v(" "), _vm._m(3), _vm._v(" "), _vm._m(4)]), _vm._v(" "), _c('section', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.two),
      expression: "two"
    }],
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px",
      "display": "none"
    },
    attrs: {
      "id": "two"
    }
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    staticStyle: {
      "color": "#27ad60"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.addthree()
      }
    }
  }, [_vm._v("Add Team Member "), _c('span', {
    staticClass: "glyphicon glyphicon-plus small",
    staticStyle: {
      "color": "#27ad60"
    }
  })])]), _vm._v(" "), _vm._m(5), _vm._v(" "), _vm._m(6), _vm._v(" "), _c('a', {
    staticStyle: {
      "color": "red"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.removetwo()
      }
    }
  }, [_c('span', {
    staticClass: "glyphicon glyphicon-minus",
    staticStyle: {
      "color": "red"
    }
  }), _vm._v(" remove")])]), _vm._v(" "), _c('section', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.three),
      expression: "three"
    }],
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px",
      "display": "none"
    },
    attrs: {
      "id": "three"
    }
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    staticStyle: {
      "color": "#27ad60"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.addfour()
      }
    }
  }, [_vm._v("Add Team Member "), _c('span', {
    staticClass: "glyphicon glyphicon-plus small",
    staticStyle: {
      "color": "#27ad60"
    }
  })])]), _vm._v(" "), _vm._m(7), _vm._v(" "), _vm._m(8), _vm._v(" "), _c('a', {
    staticStyle: {
      "color": "red"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.removethree()
      }
    }
  }, [_c('span', {
    staticClass: "glyphicon glyphicon-minus",
    staticStyle: {
      "color": "red"
    }
  }), _vm._v(" remove")])]), _vm._v(" "), _c('section', {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: (_vm.four),
      expression: "four"
    }],
    staticClass: "row",
    staticStyle: {
      "margin-bottom": "10px",
      "display": "none"
    },
    attrs: {
      "id": "four"
    }
  }, [_vm._m(9), _vm._v(" "), _vm._m(10), _vm._v(" "), _vm._m(11), _vm._v(" "), _c('a', {
    staticStyle: {
      "color": "red"
    },
    attrs: {
      "href": "#"
    },
    on: {
      "click": function($event) {
        _vm.removefour()
      }
    }
  }, [_c('span', {
    staticClass: "glyphicon glyphicon-minus",
    staticStyle: {
      "color": "red"
    }
  }), _vm._v(" remove")])]), _vm._v(" "), _vm._m(12), _vm._v(" "), _vm._m(13)])])
},staticRenderFns: [function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "title"
    }
  }, [_vm._v("Startup Name"), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "title",
      "id": "title",
      "placeholder": "Startup Name",
      "minlength": "4",
      "required": ""
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "description"
    }
  }, [_vm._v("Brief Description "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "description",
      "id": "description",
      "placeholder": "Brief Description",
      "minlength": "4",
      "required": ""
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "company_name"
    }
  }, [_vm._v("Category "), _c('span', {
    staticClass: "asterisks"
  }, [_vm._v("*")])]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('select', {
    staticClass: "form-control",
    attrs: {
      "name": "category"
    }
  }, [_c('option', {
    attrs: {
      "value": "Engineering",
      "selected": ""
    }
  }, [_vm._v("Engineering")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Agriculture"
    }
  }, [_vm._v("Agriculture")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Power and Energy"
    }
  }, [_vm._v("Power and Energy")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Healthcare"
    }
  }, [_vm._v("Healthcare")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Education"
    }
  }, [_vm._v("Education")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Design"
    }
  }, [_vm._v("Design")]), _vm._v(" "), _c('option', {
    attrs: {
      "value": "Environment"
    }
  }, [_vm._v("Environment")])])])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role1",
      "id": "role1",
      "placeholder": "Member Role",
      "minlength": "4",
      "required": ""
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_1",
      "id": "function_1",
      "placeholder": "Member's role",
      "minlength": "4",
      "required": ""
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role2",
      "id": "role2",
      "placeholder": "Team member Position",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_2",
      "id": "function_2",
      "placeholder": "Member's role",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role3",
      "id": "role3",
      "placeholder": "Team member Position",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_3",
      "id": "function_3",
      "placeholder": "Member's role",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label"
  }, [_c('a', {
    staticClass: "btn",
    attrs: {
      "href": "#"
    }
  }, [_vm._v(" ")])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "role4",
      "id": "role4",
      "placeholder": "Team member Position",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('input', {
    staticClass: "form-control",
    attrs: {
      "type": "text",
      "name": "function_4",
      "id": "function_4",
      "placeholder": "Member's role",
      "minlength": "4"
    }
  })])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('label', {
    staticClass: "col-xs-12 col-sm-2 col-md-2 col-lg-3 control-label",
    attrs: {
      "for": "additional"
    }
  }, [_vm._v("Additional Info")]), _vm._v(" "), _c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5"
  }, [_c('textarea', {
    staticClass: "form-control",
    attrs: {
      "placeholder": "Additional Information",
      "name": "additional",
      "id": "additional"
    }
  })])])
},function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    staticClass: "form-group"
  }, [_c('div', {
    staticClass: "col-xs-12 col-sm-8 col-md-7 col-lg-5 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-3"
  }, [_c('button', {
    staticClass: "btn btn-success btn-block btn-md",
    attrs: {
      "type": "submit"
    }
  }, [_vm._v("\n                        Request Now\n                    ")])])])
}]}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-46ae1142", module.exports)
  }
}

/***/ }),

/***/ 238:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(183);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(6)("e090c398", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-1dbcc1f4\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Request-startup-auth.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-1dbcc1f4\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Request-startup-auth.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 239:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(184);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(6)("0f831894", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-3185b6c0\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Request-idea-auth.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-3185b6c0\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Request-idea-auth.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 240:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(185);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(6)("6358f0dc", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-337a4cf6\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Request-idea.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-337a4cf6\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Request-idea.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 241:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(186);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(6)("bc77ec02", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-46ae1142\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Request-startup.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-46ae1142\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Request-startup.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 242:
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


/***/ }),

/***/ 243:
/***/ (function(module, exports, __webpack_require__) {

;(function () {

  var vueTruncate = {};

  vueTruncate.install = function (Vue) {
    
    /**
     * 
     * @param {String} text
     * @param {Number} length
     * @param {String} clamp
     * 
     */

    Vue.filter('truncate', function (text, length, clamp) {
      clamp = clamp || '...';
      length = length || 30;
      
      if (text.length <= length) return text;

      var tcText = text.slice(0, length - clamp.length);
      var last = tcText.length - 1;
      

      while (last > 0 && tcText[last] !== ' ' && tcText[last] !== clamp[0]) last -= 1;

      // Fix for case when text dont have any `space`
      last = last || length - clamp.length;

      tcText =  tcText.slice(0, last);

      return tcText + clamp;
    });
  }

  if (true) {
    module.exports = vueTruncate;
  } else if (typeof define == "function" && define.amd) {
    define([], function(){ return vueTruncate });
  } else if (window.Vue) {
    window.VueTruncate = vueTruncate;
    Vue.use(VueTruncate);
  }

})()


/***/ }),

/***/ 248:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(137);


/***/ }),

/***/ 3:
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function() {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		var result = [];
		for(var i = 0; i < this.length; i++) {
			var item = this[i];
			if(item[2]) {
				result.push("@media " + item[2] + "{" + item[1] + "}");
			} else {
				result.push(item[1]);
			}
		}
		return result.join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};


/***/ }),

/***/ 6:
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__(242)

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction) {
  isProduction = _isProduction

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[data-vue-ssr-id~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ })

/******/ });