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
/******/ 	return __webpack_require__(__webpack_require__.s = 218);
/******/ })
/************************************************************************/
/******/ ({

/***/ 134:
/***/ (function(module, exports) {

$(document).ready(function () {

    $(document).scrollTop(1);
    $(window).on('hashchange', function (e) {
        //detect url change
        $(document).scrollTop(1); //move document to top
    });

    var lastScrollTop = 0; //fix for fixed header in mobile phones
    var scrollTop;
    $(window).scroll(function () {
        //    setInterval(function() {
        scrollTop = $(window).scrollTop();
        if (scrollTop > lastScrollTop && scrollTop > 1.8) {
            $('.new-head').css("margin-top", '1.8em'); //scrolling up
        } else if (scrollTop < lastScrollTop) {
            $('.new-head').css("margin-top", '0em'); //scrolling up
        } else {}
        lastScrollTop = scrollTop;
        //   }, 1000);
    });

    if ($(window).width() < 468) {
        $(".body-container").removeClass("container-fluid");
        $('#firstview .list-unstyled a').removeClass('btn-lg');
        $('#firstview .list-unstyled a').addClass('btn-md');
        $(".deskheader").hide();
    } else if ($(window).width() < 768) {
        $(".body-container").addClass("container-fluid");
        $(".new-head").show();
        $(".mobilehead").show();
        $(".deskheader").hide();
        $('#firstview .list-unstyled a').removeClass('btn-md');
        $('#firstview .list-unstyled a').addClass('btn-lg');
    } else if ($(window).width() < 992) {
        $(".body-container").addClass("container-fluid");
        $(".new-head").hide();
        $(".mobilehead").hide();
        $(".deskheader").show();
        $('#firstview .list-unstyled a').removeClass('btn-md');
        $('#firstview .list-unstyled a').addClass('btn-lg');
    } else {
        $(".body-container").addClass("container-fluid");
        $(".mobilehead").hide();
        $(".deskheader").show();
        $('#firstview .list-unstyled a').removeClass('btn-md');
        $('#firstview .list-unstyled a').addClass('btn-lg');
    }
    if ($(window).width() > 992) {
        $('#firstview .list-unstyled a').removeClass('btn-md');
        $('#firstview .list-unstyled a').addClass('btn-lg');
        $(".deskheader").show();
    }
    if ($(window).width() < 768) {
        $('#content-top').hide();
    } else if ($(window).width() > 902) {
        $('#content-top').hide();
    } else {
        $('#content-top').show();
    }
    //WINDOW RESIZE EVENTS BEGINS
    window.addEventListener("resize", myFunction);

    function myFunction() {
        var w = window.outerWidth;
        var h = window.outerHeight;
        var txt = "Window size: width=" + w + ", height=" + h;
        if (w < 468) {
            $(".body-container").removeClass("container-fluid");
            $('#firstview .list-unstyled a').removeClass('btn-lg');
            $('#firstview .list-unstyled a').addClass('btn-md');
            $(".deskheader").hide();
        } else if (w < 768) {
            $(".body-container").addClass("container-fluid");
            $(".new-head").show();
            $(".mobilehead").show();
            $(".deskheader").hide();
            $('#firstview .list-unstyled a').removeClass('btn-md');
            $('#firstview .list-unstyled a').addClass('btn-lg');
        } else if (w < 992) {
            $(".body-container").addClass("container-fluid");
            $(".new-head").hide();
            $(".mobilehead").hide();
            $(".deskheader").show();
            $('#firstview .list-unstyled a').removeClass('btn-md');
            $('#firstview .list-unstyled a').addClass('btn-lg');
        } else {
            $(".body-container").addClass("container-fluid");
            $(".mobilehead").hide();
            $(".deskheader").show();
            $('#firstview .list-unstyled a').removeClass('btn-md');
            $('#firstview .list-unstyled a').addClass('btn-lg');
        }
        if (w >= 992) {
            $('#firstview .list-unstyled a').removeClass('btn-md');
            $('#firstview .list-unstyled a').addClass('btn-lg');
            $(".deskheader").show();
        }
        if (w < 768) {
            $('#content-top').hide();
        } else if (w > 902) {
            $('#content-top').hide();
        } else {
            $('#content-top').show();
        }

        if (w >= 1199) {
            $(".first-row").show();
            $("#innovator_top_div").hide(); //innovator profile top div
            //    $('.first-row').css("position", "fixed");
            //   $('.first-row').css("width", "16.666667%");
            $('.first-row').css({ "position": "fixed", "width": "16.666667%" });
            $('.second-row').css("margin-left", "16.666667%");
            //  $("wrapper").hide();
            var offsetHeight = document.getElementById('secondDiv').offsetHeight;
            var firstHeight = document.getElementById('firstDiv').offsetHeight;
            diffHeight = offsetHeight - firstHeight;
            document.getElementById("k").innerHTML = offsetHeight;
            document.getElementById("kk").innerHTML = firstHeight;
            document.getElementById("kkk").innerHTML = diffHeight;
            $(window).scroll(function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > diffHeight) {
                    $('.first-row').css({ "position": "fixed", "top": "0px" });
                    //added to make it fixed
                } else {
                    $('.first-row').css({ "position": "fixed", "top": "0px" });
                }
            });
            $('first-row').scrollTop(diffHeight);
        } else {
            $(".first-row").hide();
            $("#innovator_top_div").show(); //innovator profile top div
            $('.second-row').css("margin-left", "0%");
        }
    }

    //REQUEST FADEOUT
    myFnction();
    function myFnction() {
        setTimeout(function () {
            $("#reques_modal").fadeOut(4000);
        }, 3000);
    }
    //connection requests
    setInterval(function () {
        $('#notify_update').fadeOut(1000);
        $('#notify_update').fadeIn(2000);
    }, 3000);
    /////////////////////////////////////////////////////////////
    $("#my_file").on("change", function () {
        $("#formId").submit();
    });
    $("#my_file_profilepage").on("change", function () {
        $("#formId_profilepage").submit();
    });
});

/***/ }),

/***/ 218:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(134);


/***/ })

/******/ });