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
/******/ 	return __webpack_require__(__webpack_require__.s = 219);
/******/ })
/************************************************************************/
/******/ ({

/***/ 135:
/***/ (function(module, exports, __webpack_require__) {

//import router from './routes';
var VueTruncate = __webpack_require__(214);
Vue.use(VueTruncate);

var self = ''; //set self equal to empty string to be used in axios
var app1 = new Vue({
  el: '#login',
  data: {
    email: '',
    password: '',
    login: true, //normal login button
    loading: false, //loading login button
    disabled: false, //disable buttons
    request_status: '',
    message: '',
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
          self.styleObject.color = 'blue'; //set style color in vue data
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

/***/ }),

/***/ 214:
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

/***/ 219:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(135);


/***/ })

/******/ });