(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[5],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/SignUpForm.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/SignUpForm.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
      weeklybudget: [{
        text: '$50    - Basic',
        value: 50
      }, {
        text: '$100   - Standard',
        value: 100
      }, {
        text: '$125   - Plus',
        value: 125
      }, {
        text: '$150   - Premium',
        value: 150
      }, {
        text: 'Custom - Ultimate',
        value: 500
      }],
      priceranges: [{
        text: 'Under $5k',
        value: 5
      }, {
        text: 'Under $10k',
        value: 10
      }, {
        text: 'Under $15k',
        value: 15
      }, {
        text: 'Under $20k',
        value: 20
      }, {
        text: 'Under $30k',
        value: 30
      }],
      colors: [{
        text: 'Green',
        value: "green"
      }, {
        text: 'Red',
        value: "red"
      }, {
        text: 'Yellow',
        value: "yellow"
      }, {
        text: 'Pink',
        value: "pink"
      }, {
        text: 'Orange',
        value: "orange"
      }, {
        text: 'Violet',
        value: "violet"
      }, {
        text: 'Blue',
        value: "blue"
      }, {
        text: 'Brown',
        value: "brown"
      }, {
        text: 'Gray',
        value: "gray"
      }, {
        text: 'Black',
        value: "black"
      }],
      ad_templates: [{
        text: 'AD 01',
        value: "ad01"
      }, {
        text: 'AD 02',
        value: "ad02"
      }, {
        text: 'AD 03',
        value: "ad03"
      }, {
        text: 'AD 04',
        value: "ad04"
      }, {
        text: 'AD 05',
        value: "ad05"
      }, {
        text: 'AD 06',
        value: "ad06"
      }, {
        text: 'AD 07',
        value: "ad07"
      }, {
        text: 'AD 08',
        value: "ad08"
      }, {
        text: 'AD 09',
        value: "ad09"
      }, {
        text: 'AD 10',
        value: "ad10"
      }, {
        text: 'AD 11',
        value: "ad11"
      }, {
        text: 'AD 12',
        value: "ad12"
      }, {
        text: 'AD 13',
        value: "ad13"
      }, {
        text: 'AD 14',
        value: "ad14"
      }, {
        text: 'AD 15',
        value: "ad15"
      }, {
        text: 'AD 16',
        value: "ad16"
      }, {
        text: 'AD 17',
        value: "ad17"
      }, {
        text: 'AD 18',
        value: "ad18"
      }, {
        text: 'AD 19',
        value: "ad19"
      }, {
        text: 'AD 20',
        value: "ad20"
      }, {
        text: 'AD 21',
        value: "ad21"
      }, {
        text: 'AD 22',
        value: "ad22"
      }, {
        text: 'AD 23',
        value: "ad23"
      }, {
        text: 'AD 24',
        value: "ad24"
      }, {
        text: 'AD 25',
        value: "ad25"
      }],
      logo: "https://cdn-w.v12soft.com/photos/LTX4ZDy/logo_lckWepiG.png",
      makes: {},
      bodies: {},
      dealer_id: "",
      valueSlider: 50,
      dealer_name: "",
      dealer_zipcode: "",
      logoupload: "",
      plateform_facebook: false,
      plateform_google: false,
      plateform: '',
      target_radius: "",
      radius_mile: false,
      radius_km: false,
      custom_weekly_budget: 150,
      trade_in: false,
      warranty: false,
      buy_here: false,
      weekly_budget: 50,
      fb_retargeting: false,
      fb_display: false,
      fb_dynamic_retargeting: false,
      g_display: false,
      g_retargeting: false,
      g_dynamic_retargeting: false,
      facebook_campaign: 'display',
      ad_facebook: false,
      ad_marketplace: false,
      ad_instagram: false,
      ad_messenger: false,
      ad_youtube: false,
      ad_gmail: false,
      short_tagline: "",
      long_tagline: "",
      description: "",
      headline: "",
      price_range: 5,
      color_sheme: "green",
      ad_template: "ad01",
      notes: "",
      landing_page: "",
      call_action: "",
      vehicle_ad: "",
      showfirststep: false,
      showsecondstep: false,
      showfinalstep: false
    };
  },
  methods: {
    onFileChange: function onFileChange(e) {
      var file = e.target.files[0];
      this.logoupload = e.target.files[0];
      this.logo = URL.createObjectURL(file);
    },
    seevalue: function seevalue() {
      if (this.plateform == 'facebook') {
        this.plateform_facebook = true;
        this.plateform_google = false;
      } else {
        this.plateform_facebook = false;
        this.plateform_google = true;
      }
    },
    searchDealer: function searchDealer() {
      var _this = this;

      var params = {
        id: this.dealer_id
      };
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.post('getDealerByID', {
        params: params
      }).then(function (response) {
        var result = response.data;
        var data = result['data'];
        _this.dealer_name = data["dealer_name"];
        _this.dealer_zipcode = data['zipcode'];
        _this.makes = data['makes'];
        _this.bodies = data['bodies'];
        _this.logo = data['logo'];
        _this.showfirststep = true;
      });
    },
    submitForm: function submitForm() {
      var financing_service = "";
      if (this.trade_in) financing_service += "tradein|";
      if (this.warranty) financing_service += "warranty|";
      if (this.buy_here) financing_service += "buy_here_pay_here";
      var plateform = "";
      var weekly_budget = this.weekly_budget == 500 ? this.custom_weekly_budget : this.weekly_budget;

      if (this.weekly_budget == '50') {
        plateform = this.plateform;
      } else {
        if (this.plateform_facebook && this.plateform_google) {
          plateform = "facebook|google";
        } else if (this.plateform_facebook && !this.plateform_google) {
          plateform = "facebook";
        } else if (this.plateform_google && !this.plateform_facebook) {
          plateform = "google";
        }
      }

      var budget_split_facebook = this.valueSlider;
      var budget_split_google = 100 - this.valueSlider;
      var budget_split = {
        facebook: budget_split_facebook,
        google: budget_split_google
      };
      var type_facebook = "";
      var type_google = "";

      if (plateform == 'facebook|google') {
        if (this.weekly_budget <= 125) {
          type_facebook = this.facebook_campaign;
        } else {
          if (this.fb_display) type_facebook += "display|";
          if (this.fb_retargeting) type_facebook += "retargeting|";
          if (this.fb_dynamic_retargeting) type_facebook += "dynamic_retargeting";
        }

        if (this.g_display) type_google += "display|";
        if (this.g_retargeting) type_google += "retargeting|";
        if (this.g_dynamic_retargeting) type_google += "dynamic_retargeting";
      } else if (plateform == 'google') {
        if (this.g_display) type_google += "display|";
        if (this.g_retargeting) type_google += "retargeting|";
        if (this.g_dynamic_retargeting) type_google += "dynamic_retargeting";
      } else {
        if (this.weekly_budget <= 125) {
          type_facebook = this.facebook_campaign;
        } else {
          if (this.fb_display) type_facebook += "display|";
          if (this.fb_retargeting) type_facebook += "retargeting|";
          if (this.fb_dynamic_retargeting) type_facebook += "dynamic_retargeting";
        }
      }

      var type_campaign = {
        facebook: type_facebook,
        google: type_google
      };
      var ad_placement_google = "";
      var ad_placement_facebook = "";
      if (this.ad_gmail) ad_placement_google += "gmail|";
      if (this.ad_youtube) ad_placement_google += "youtube";
      if (this.ad_messenger) ad_placement_facebook += "messenger|";
      if (this.ad_instagram) ad_placement_facebook += "Instagram|";
      if (this.ad_facebook) ad_placement_facebook += "facebook|";
      if (this.ad_marketplace) ad_placement_facebook += "marketplace|";
      var ad_placement = {
        facebook: ad_placement_facebook,
        google: ad_placement_google
      };
      var data = {
        dealer_id: this.dealer_id,
        dealer_name: this.dealer_name,
        makes: this.makes,
        bodies: this.bodies,
        price_range: this.price_range,
        financing_service: financing_service,
        weekly_budget: weekly_budget,
        ad_plateform: plateform,
        target_radius: this.target_radius,
        plateform: plateform,
        budget_split: budget_split,
        type_campaign: type_campaign,
        ad_placement: ad_placement,
        short_tagline: this.short_tagline,
        long_tagline: this.long_tagline,
        description: this.description,
        headline: this.headline,
        color_sheme: this.color_sheme,
        ad_template: this.ad_template,
        vehicle_ad: this.vehicle_ad,
        call_action: this.call_action,
        landing_page: this.landing_page,
        logoupload: document.getElementById('fileInput').files[0]
      };
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.post('saveForm', {
        data: data
      }).then(function (response) {
        var formData = new FormData();
        formData.append('image', document.getElementById('fileInput').files[0]);
        formData.append('id', response.data.id);
        axios__WEBPACK_IMPORTED_MODULE_0___default.a.post('uploadlogo', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(function (response) {
          flash(response.data.message, 'success');
        })["catch"](function (e) {
          console.log(e);
        });
      });
    },
    Isfinalstep: function Isfinalstep() {
      if (this.plateform_facebook || this.plateform && !this.plateform_google) {
        if (this.target_radius != "" && (this.ad_messenger || this.ad_instagram || this.ad_marketplace || this.ad_facebook) && this.short_tagline != "" && this.long_tagline != "" && this.description != "" && this.headline != "") {
          return true;
        } else {
          return false;
        }
      }

      if (this.plateform_google || this.plateform && !this.plateform_facebook) {
        if (this.target_radius != "" && (this.g_display || this.g_retargeting || this.g_dynamic_retargeting) && (this.ad_gmail || this.ad_youtube) && this.short_tagline != "" && this.long_tagline != "" && this.description != "" && this.headline != "") {
          return true;
        } else {
          return false;
        }
      }

      if (this.plateform_facebook || this.plateform && this.plateform_google) {
        if (this.target_radius != "" && (this.g_display || this.g_retargeting || this.g_dynamic_retargeting) && (this.ad_gmail || this.ad_youtube) && this.short_tagline != "" && this.long_tagline != "" && this.description != "" && this.headline != "" && (this.ad_messenger || this.ad_instagram || this.ad_marketplace || this.ad_facebook)) {
          return true;
        } else {
          return false;
        }
      }

      return false;
    }
  },
  computed: {},
  created: function created() {}
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/SignUpForm.vue?vue&type=style&index=0&lang=scss&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/SignUpForm.vue?vue&type=style&index=0&lang=scss& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".vs-slider {\n  background: #ea4335;\n}\n.content-md {\n  padding: 2em 5em;\n}\n.vs-con-input-label {\n  display: inline-block;\n}\n.cancel-btn {\n  color: #000;\n  font-weight: 500;\n}\n.inputx {\n  width: 100%;\n}\n\n/* .vs-checkbox {\n\twidth: 15px;\n\theight: 15px;\n}\n*/\n.con-slot-label {\n  font-size: 9px;\n}\nlabel {\n  font-size: 12px;\n  font-weight: 400;\n  color: #000;\n}\n.vx-card .vx-card__collapsible-content img {\n  display: inline-block;\n  width: 20px;\n}\n.vx-card .vx-card__collapsible-content h6 {\n  display: inline-block;\n  vertical-align: super;\n}\nhr {\n  display: block;\n  height: 1px;\n  border: 0;\n  border-top: 1px solid #ccc;\n  margin: 1em 0;\n  padding: 0;\n}\n.vs-textarea--count {\n  background: #74c166;\n}\n.border-bottom {\n  border-bottom: 1px solid #ccc;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/SignUpForm.vue?vue&type=style&index=0&lang=scss&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/SignUpForm.vue?vue&type=style&index=0&lang=scss& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--8-2!../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../node_modules/vue-loader/lib??vue-loader-options!./SignUpForm.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/SignUpForm.vue?vue&type=style&index=0&lang=scss&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/SignUpForm.vue?vue&type=template&id=54072ac6&":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/SignUpForm.vue?vue&type=template&id=54072ac6& ***!
  \************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("h5", { staticClass: "pb-4" }, [_vm._v("Sign up Form | ")]),
      _vm._v(" "),
      _c(
        "vx-card",
        { staticClass: "content-md" },
        [
          _c(
            "vs-row",
            [
              _c("vs-col", { attrs: { "vs-w": "4" } }, [
                _c("label", [_vm._v("Dealership ID:")])
              ]),
              _vm._v(" "),
              _c(
                "vs-col",
                { staticClass: "text-right", attrs: { "vs-w": "4" } },
                [
                  _c("vs-input", {
                    staticClass: "inputx",
                    attrs: { size: "small", color: "success" },
                    model: {
                      value: _vm.dealer_id,
                      callback: function($$v) {
                        _vm.dealer_id = $$v
                      },
                      expression: "dealer_id"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "vs-col",
                { staticClass: "text-right", attrs: { "vs-w": "4" } },
                [
                  _c(
                    "vs-button",
                    {
                      attrs: { color: "#74c166", size: "small" },
                      on: {
                        click: function($event) {
                          return _vm.searchDealer()
                        }
                      }
                    },
                    [_vm._v("Search")]
                  ),
                  _vm._v(" "),
                  _c(
                    "vs-button",
                    {
                      staticClass: "cancel-btn",
                      attrs: { color: "#ececec", size: "small" }
                    },
                    [_vm._v("Cancel")]
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "div",
            {
              directives: [
                {
                  name: "show",
                  rawName: "v-show",
                  value: _vm.showfirststep,
                  expression: "showfirststep"
                }
              ]
            },
            [
              _c(
                "vs-row",
                [
                  _c(
                    "vs-col",
                    {
                      staticClass: "text-center pt-4 pb-4",
                      attrs: { "vs-w": "12" }
                    },
                    [
                      _c("h2", [
                        _vm._v("Firstly, let’s get to know your dealership!")
                      ])
                    ]
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "vs-row",
                { staticClass: "pb-5" },
                [
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Dealership name:")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { attrs: { "vs-w": "8" } },
                    [
                      _c("vs-input", {
                        staticClass: "inputx",
                        staticStyle: { width: "100%" },
                        attrs: {
                          disabled: "",
                          size: "small",
                          placeholder: "RedOne Motors, LLC",
                          color: "success"
                        },
                        model: {
                          value: _vm.dealer_name,
                          callback: function($$v) {
                            _vm.dealer_name = $$v
                          },
                          expression: "dealer_name"
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "vs-row",
                { staticClass: "mb-2" },
                [
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Dealership zipcode:")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                    [
                      _c("vs-input", {
                        staticClass: "inputx",
                        staticStyle: { width: "100%" },
                        attrs: {
                          disabled: "",
                          size: "small",
                          placeholder: "98712",
                          color: "success"
                        },
                        model: {
                          value: _vm.dealer_zipcode,
                          callback: function($$v) {
                            _vm.dealer_zipcode = $$v
                          },
                          expression: "dealer_zipcode"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c("vs-col", { attrs: { "vs-w": "12" } }, [_c("hr")])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "vs-row",
                { staticClass: "mb-5" },
                [
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Bodies type:")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                    [
                      _c(
                        "vs-row",
                        _vm._l(_vm.bodies, function(option, index) {
                          return _c(
                            "vs-col",
                            {
                              key: index,
                              staticClass: "p-0",
                              attrs: { "vs-w": "2" }
                            },
                            [
                              _c(
                                "vs-checkbox",
                                {
                                  attrs: {
                                    size: "small",
                                    label: option.value,
                                    color: "success"
                                  },
                                  model: {
                                    value: option.checked,
                                    callback: function($$v) {
                                      _vm.$set(option, "checked", $$v)
                                    },
                                    expression: "option.checked"
                                  }
                                },
                                [_vm._v(_vm._s(option.value))]
                              )
                            ],
                            1
                          )
                        }),
                        1
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c("vs-col", { attrs: { "vs-w": "12" } }, [_c("hr")])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "vs-row",
                { staticClass: "mb-5" },
                [
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Makes:")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                    [
                      _c(
                        "vs-row",
                        { staticClass: "pb-3" },
                        _vm._l(_vm.makes, function(option, index) {
                          return _c(
                            "vs-col",
                            {
                              key: index,
                              staticClass: "p-0",
                              attrs: { "vs-w": "2" }
                            },
                            [
                              _c(
                                "vs-checkbox",
                                {
                                  attrs: {
                                    size: "small",
                                    label: option.value,
                                    color: "success"
                                  },
                                  model: {
                                    value: option.checked,
                                    callback: function($$v) {
                                      _vm.$set(option, "checked", $$v)
                                    },
                                    expression: "option.checked"
                                  }
                                },
                                [_vm._v(_vm._s(option.value))]
                              )
                            ],
                            1
                          )
                        }),
                        1
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c("vs-col", { attrs: { "vs-w": "12" } }, [_c("hr")])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "vs-row",
                { staticClass: "mb-5" },
                [
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Price Range:")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                    [
                      _c(
                        "vs-select",
                        {
                          staticStyle: { width: "100%" },
                          attrs: { size: "small", color: "success" },
                          model: {
                            value: _vm.price_range,
                            callback: function($$v) {
                              _vm.price_range = $$v
                            },
                            expression: "price_range"
                          }
                        },
                        _vm._l(_vm.priceranges, function(item, index) {
                          return _c("vs-select-item", {
                            key: index,
                            attrs: { value: item.value, text: item.text }
                          })
                        }),
                        1
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c("vs-col", { attrs: { "vs-w": "12" } }, [_c("hr")])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "vs-row",
                { staticClass: "mb-5" },
                [
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Financing Services:")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                    [
                      _c(
                        "vs-row",
                        [
                          _c(
                            "vs-col",
                            { staticClass: "p-0", attrs: { "vs-w": "3" } },
                            [
                              _c(
                                "vs-checkbox",
                                {
                                  attrs: { size: "small", color: "success" },
                                  model: {
                                    value: _vm.trade_in,
                                    callback: function($$v) {
                                      _vm.trade_in = $$v
                                    },
                                    expression: "trade_in"
                                  }
                                },
                                [_vm._v("Trade-in")]
                              )
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "vs-col",
                            { staticClass: "p-0", attrs: { "vs-w": "3" } },
                            [
                              _c(
                                "vs-checkbox",
                                {
                                  attrs: { size: "small", color: "success" },
                                  model: {
                                    value: _vm.warranty,
                                    callback: function($$v) {
                                      _vm.warranty = $$v
                                    },
                                    expression: "warranty"
                                  }
                                },
                                [_vm._v("Warranty")]
                              )
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "vs-col",
                            { staticClass: "p-0", attrs: { "vs-w": "6" } },
                            [
                              _c(
                                "vs-checkbox",
                                {
                                  attrs: { size: "small", color: "success" },
                                  model: {
                                    value: _vm.buy_here,
                                    callback: function($$v) {
                                      _vm.buy_here = $$v
                                    },
                                    expression: "buy_here"
                                  }
                                },
                                [_vm._v("Buy here pay here")]
                              )
                            ],
                            1
                          )
                        ],
                        1
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c("vs-col", { attrs: { "vs-w": "12" } }, [_c("hr")])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _vm.warranty || _vm.trade_in || _vm.buy_here
            ? _c(
                "vs-row",
                { staticClass: "mb-5" },
                [
                  _c(
                    "vs-col",
                    {
                      staticClass: "text-center pb-5",
                      attrs: { "vs-w": "12" }
                    },
                    [
                      _c("h2", [
                        _vm._v("Secondly, let’s configure your campaign!")
                      ])
                    ]
                  ),
                  _vm._v(" "),
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Your weekly budget (in USD):")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                    [
                      _c(
                        "vs-select",
                        {
                          staticStyle: { width: "100%" },
                          attrs: { size: "small", color: "success" },
                          model: {
                            value: _vm.weekly_budget,
                            callback: function($$v) {
                              _vm.weekly_budget = $$v
                            },
                            expression: "weekly_budget"
                          }
                        },
                        _vm._l(_vm.weeklybudget, function(item, index) {
                          return _c("vs-select-item", {
                            key: index,
                            attrs: { value: item.value, text: item.text }
                          })
                        }),
                        1
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _vm.weekly_budget == 500
                    ? _c("vs-col", { attrs: { "vs-w": "4" } }, [
                        _c("label", [
                          _vm._v(
                            "Specify Your weekly budget (in USD) must be more than 150$:"
                          )
                        ])
                      ])
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.weekly_budget == 500
                    ? _c(
                        "vs-col",
                        { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                        [
                          _c("vs-input", {
                            staticClass: "inputx",
                            staticStyle: { width: "100%" },
                            attrs: {
                              type: "number",
                              min: "150",
                              placeholder:
                                "weekly budget (in USD) must be more than 150$",
                              color: "success"
                            },
                            model: {
                              value: _vm.custom_weekly_budget,
                              callback: function($$v) {
                                _vm.custom_weekly_budget = $$v
                              },
                              expression: "custom_weekly_budget"
                            }
                          })
                        ],
                        1
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _c("vs-col", { attrs: { "vs-w": "12" } }, [_c("hr")])
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _vm.weekly_budget != "" &&
          (_vm.warranty || _vm.trade_in || _vm.buy_here)
            ? _c(
                "div",
                [
                  _vm.weekly_budget > 50
                    ? _c(
                        "vs-row",
                        { staticClass: "mb-5" },
                        [
                          _c("vs-col", { attrs: { "vs-w": "4" } }, [
                            _c("label", [_vm._v("Ad platforms:")])
                          ]),
                          _vm._v(" "),
                          _c(
                            "vs-col",
                            { staticClass: "pb-3", attrs: { "vs-w": "3" } },
                            [
                              _c(
                                "vs-checkbox",
                                {
                                  attrs: { size: "small", color: "success" },
                                  model: {
                                    value: _vm.plateform_facebook,
                                    callback: function($$v) {
                                      _vm.plateform_facebook = $$v
                                    },
                                    expression: "plateform_facebook"
                                  }
                                },
                                [
                                  _c("img", {
                                    attrs: { src: "/images/facebook.svg" }
                                  }),
                                  _vm._v(" "),
                                  _c("h6", [_vm._v("Facebook")])
                                ]
                              )
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "vs-col",
                            { staticClass: "pb-3", attrs: { "vs-w": "5" } },
                            [
                              _c(
                                "vs-checkbox",
                                {
                                  attrs: { size: "small", color: "success" },
                                  model: {
                                    value: _vm.plateform_google,
                                    callback: function($$v) {
                                      _vm.plateform_google = $$v
                                    },
                                    expression: "plateform_google"
                                  }
                                },
                                [
                                  _c("img", {
                                    attrs: { src: "/images/google.svg" }
                                  }),
                                  _vm._v(" "),
                                  _c("h6", [_vm._v("Gooogle")])
                                ]
                              )
                            ],
                            1
                          )
                        ],
                        1
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.weekly_budget == 50 || _vm.weekly_budget < 50
                    ? _c(
                        "vs-row",
                        { staticClass: "mb-5" },
                        [
                          _c("vs-col", { attrs: { "vs-w": "4" } }, [
                            _c("label", [_vm._v("Ad platforms:")])
                          ]),
                          _vm._v(" "),
                          _c(
                            "vs-col",
                            { staticClass: "pb-3", attrs: { "vs-w": "3" } },
                            [
                              _c(
                                "vs-radio",
                                {
                                  attrs: {
                                    "vs-value": "facebook",
                                    color: "success"
                                  },
                                  on: {
                                    change: function($event) {
                                      return _vm.seevalue()
                                    }
                                  },
                                  model: {
                                    value: _vm.plateform,
                                    callback: function($$v) {
                                      _vm.plateform = $$v
                                    },
                                    expression: "plateform"
                                  }
                                },
                                [_c("h6", [_vm._v("Facebook")])]
                              )
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "vs-col",
                            { staticClass: "pb-3", attrs: { "vs-w": "5" } },
                            [
                              _c(
                                "vs-radio",
                                {
                                  attrs: {
                                    "vs-value": "google",
                                    color: "success"
                                  },
                                  on: {
                                    change: function($event) {
                                      return _vm.seevalue()
                                    }
                                  },
                                  model: {
                                    value: _vm.plateform,
                                    callback: function($$v) {
                                      _vm.plateform = $$v
                                    },
                                    expression: "plateform"
                                  }
                                },
                                [_c("h6", [_vm._v("Gooogle")])]
                              )
                            ],
                            1
                          )
                        ],
                        1
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.plateform_facebook || _vm.plateform == "facebook"
                    ? _c(
                        "vs-row",
                        { staticClass: "mb-5" },
                        [
                          _c("vs-col", { attrs: { "vs-w": "4" } }, [
                            _c("label", [_vm._v("Editor Access:")])
                          ]),
                          _vm._v(" "),
                          _c(
                            "vs-col",
                            { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                            [
                              _c("img", {
                                attrs: { src: "/images/warning.svg" }
                              }),
                              _vm._v(" "),
                              _c(
                                "span",
                                {
                                  staticStyle: {
                                    color: "#c54242",
                                    "vertical-align": "super",
                                    "font-size": "10px"
                                  }
                                },
                                [
                                  _vm._v(
                                    " Looks like we don’t have access to your facebook page! "
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _c("img", {
                                staticStyle: {
                                  width: "10%",
                                  "vertical-align": "top"
                                },
                                attrs: { src: "/images/fb_login_js_sdk.jpg" }
                              })
                            ]
                          )
                        ],
                        1
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.plateform_facebook && _vm.plateform_google
                    ? _c(
                        "vs-row",
                        { staticClass: "mb-5 border-bottom" },
                        [
                          _c("vs-col", { attrs: { "vs-w": "4" } }, [
                            _c("label", [_vm._v("Budget Split:")])
                          ]),
                          _vm._v(" "),
                          _c(
                            "vs-col",
                            { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                            [
                              _c(
                                "vs-row",
                                [
                                  _c("vs-col", { attrs: { "vs-w": "1" } }, [
                                    _c("img", {
                                      staticStyle: {
                                        "vertical-align":
                                          "-webkit-baseline-middle"
                                      },
                                      attrs: { src: "/images/facebook.svg" }
                                    })
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "vs-col",
                                    { attrs: { "vs-w": "10" } },
                                    [
                                      _c(
                                        "vs-row",
                                        [
                                          _c(
                                            "vs-col",
                                            {
                                              staticStyle: {
                                                padding: "8px 0 0 0"
                                              },
                                              attrs: { "vs-w": "1" }
                                            },
                                            [
                                              _c(
                                                "span",
                                                {
                                                  staticStyle: {
                                                    "font-size": "12px"
                                                  }
                                                },
                                                [
                                                  _vm._v(
                                                    _vm._s(_vm.valueSlider) +
                                                      " %"
                                                  )
                                                ]
                                              )
                                            ]
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "vs-col",
                                            { attrs: { "vs-w": "10" } },
                                            [
                                              _c("vs-slider", {
                                                model: {
                                                  value: _vm.valueSlider,
                                                  callback: function($$v) {
                                                    _vm.valueSlider = $$v
                                                  },
                                                  expression: "valueSlider"
                                                }
                                              })
                                            ],
                                            1
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "vs-col",
                                            {
                                              staticStyle: {
                                                padding: "8px 0 0 0"
                                              },
                                              attrs: { "vs-w": "1" }
                                            },
                                            [
                                              _c(
                                                "span",
                                                {
                                                  staticStyle: {
                                                    "font-size": "12px"
                                                  }
                                                },
                                                [
                                                  _vm._v(
                                                    _vm._s(
                                                      100 - _vm.valueSlider
                                                    ) + " %"
                                                  )
                                                ]
                                              )
                                            ]
                                          )
                                        ],
                                        1
                                      )
                                    ],
                                    1
                                  ),
                                  _vm._v(" "),
                                  _c("vs-col", { attrs: { "vs-w": "1" } }, [
                                    _c("img", {
                                      staticStyle: {
                                        "vertical-align":
                                          "-webkit-baseline-middle"
                                      },
                                      attrs: { src: "/images/google.svg" }
                                    })
                                  ])
                                ],
                                1
                              )
                            ],
                            1
                          )
                        ],
                        1
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _c(
                    "vs-row",
                    { staticClass: "mb-5 border-bottom" },
                    [
                      _c("vs-col", { attrs: { "vs-w": "4" } }, [
                        _c("label", [_vm._v("Target Radius:")])
                      ]),
                      _vm._v(" "),
                      _c(
                        "vs-col",
                        { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                        [
                          _c(
                            "vs-row",
                            [
                              _c(
                                "vs-col",
                                { attrs: { "vs-w": "6" } },
                                [
                                  _c("vs-input", {
                                    attrs: { size: "small", color: "success" },
                                    model: {
                                      value: _vm.target_radius,
                                      callback: function($$v) {
                                        _vm.target_radius = $$v
                                      },
                                      expression: "target_radius"
                                    }
                                  })
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "vs-col",
                                { attrs: { "vs-w": "3" } },
                                [
                                  _c(
                                    "vs-radio",
                                    {
                                      attrs: {
                                        "vs-value": "primary",
                                        color: "success"
                                      },
                                      model: {
                                        value: _vm.radius_km,
                                        callback: function($$v) {
                                          _vm.radius_km = $$v
                                        },
                                        expression: "radius_km"
                                      }
                                    },
                                    [_vm._v("Kilometers")]
                                  )
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "vs-col",
                                {
                                  staticClass: "text-center",
                                  attrs: { "vs-w": "3" }
                                },
                                [
                                  _c(
                                    "vs-radio",
                                    {
                                      attrs: {
                                        "vs-value": "primary",
                                        color: "success"
                                      },
                                      model: {
                                        value: _vm.radius_mile,
                                        callback: function($$v) {
                                          _vm.radius_mile = $$v
                                        },
                                        expression: "radius_mile"
                                      }
                                    },
                                    [_vm._v("Miles")]
                                  )
                                ],
                                1
                              )
                            ],
                            1
                          )
                        ],
                        1
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _vm.plateform_facebook ||
                  _vm.plateform_google ||
                  _vm.plateform == "facebook" ||
                  _vm.plateform == "google"
                    ? _c(
                        "vs-row",
                        { staticClass: "mb-5 border-bottom" },
                        [
                          _c("vs-col", { attrs: { "vs-w": "4" } }, [
                            _c("label", [_vm._v("Type of campaigns:")])
                          ]),
                          _vm._v(" "),
                          _c(
                            "vs-col",
                            { staticClass: "pb-2", attrs: { "vs-w": "8" } },
                            [
                              _vm.plateform_facebook ||
                              _vm.plateform == "facebook"
                                ? _c(
                                    "vs-row",
                                    { staticClass: "pb-3" },
                                    [
                                      _c("vs-col", { attrs: { "vs-w": "1" } }, [
                                        _c("img", {
                                          attrs: { src: "/images/facebook.svg" }
                                        })
                                      ]),
                                      _vm._v(" "),
                                      _vm.weekly_budget > 125
                                        ? _c(
                                            "vs-col",
                                            { attrs: { "vs-w": "3" } },
                                            [
                                              _c(
                                                "vs-checkbox",
                                                {
                                                  attrs: {
                                                    size: "small",
                                                    color: "success"
                                                  },
                                                  model: {
                                                    value: _vm.fb_display,
                                                    callback: function($$v) {
                                                      _vm.fb_display = $$v
                                                    },
                                                    expression: "fb_display"
                                                  }
                                                },
                                                [_vm._v("Display")]
                                              )
                                            ],
                                            1
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      _vm.weekly_budget > 125
                                        ? _c(
                                            "vs-col",
                                            { attrs: { "vs-w": "4" } },
                                            [
                                              _c(
                                                "vs-checkbox",
                                                {
                                                  attrs: {
                                                    size: "small",
                                                    color: "success"
                                                  },
                                                  model: {
                                                    value: _vm.fb_retargeting,
                                                    callback: function($$v) {
                                                      _vm.fb_retargeting = $$v
                                                    },
                                                    expression: "fb_retargeting"
                                                  }
                                                },
                                                [_vm._v("Retargeting")]
                                              )
                                            ],
                                            1
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      _vm.weekly_budget <= 125
                                        ? _c(
                                            "vs-col",
                                            { attrs: { "vs-w": "3" } },
                                            [
                                              _c(
                                                "vs-radio",
                                                {
                                                  attrs: {
                                                    size: "small",
                                                    "vs-value": "display",
                                                    color: "success"
                                                  },
                                                  model: {
                                                    value:
                                                      _vm.facebook_campaign,
                                                    callback: function($$v) {
                                                      _vm.facebook_campaign = $$v
                                                    },
                                                    expression:
                                                      "facebook_campaign"
                                                  }
                                                },
                                                [_vm._v("Display")]
                                              )
                                            ],
                                            1
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      _vm.weekly_budget <= 125
                                        ? _c(
                                            "vs-col",
                                            { attrs: { "vs-w": "4" } },
                                            [
                                              _c(
                                                "vs-radio",
                                                {
                                                  attrs: {
                                                    size: "small",
                                                    "vs-value": "retargeting",
                                                    color: "success"
                                                  },
                                                  model: {
                                                    value:
                                                      _vm.facebook_campaign,
                                                    callback: function($$v) {
                                                      _vm.facebook_campaign = $$v
                                                    },
                                                    expression:
                                                      "facebook_campaign"
                                                  }
                                                },
                                                [_vm._v("Retargeting")]
                                              )
                                            ],
                                            1
                                          )
                                        : _vm._e(),
                                      _vm._v(" "),
                                      _vm.weekly_budget == 500
                                        ? _c(
                                            "vs-col",
                                            { attrs: { "vs-w": "4" } },
                                            [
                                              _c(
                                                "vs-checkbox",
                                                {
                                                  attrs: {
                                                    size: "small",
                                                    color: "success"
                                                  },
                                                  model: {
                                                    value:
                                                      _vm.fb_dynamic_retargeting,
                                                    callback: function($$v) {
                                                      _vm.fb_dynamic_retargeting = $$v
                                                    },
                                                    expression:
                                                      "fb_dynamic_retargeting"
                                                  }
                                                },
                                                [_vm._v("Dynamic Retargeting")]
                                              )
                                            ],
                                            1
                                          )
                                        : _vm._e()
                                    ],
                                    1
                                  )
                                : _vm._e(),
                              _vm._v(" "),
                              _vm.plateform_google || _vm.plateform == "google"
                                ? _c(
                                    "vs-row",
                                    [
                                      _c("vs-col", { attrs: { "vs-w": "1" } }, [
                                        _c("img", {
                                          attrs: { src: "/images/google.svg" }
                                        })
                                      ]),
                                      _vm._v(" "),
                                      _c(
                                        "vs-col",
                                        { attrs: { "vs-w": "3" } },
                                        [
                                          _c(
                                            "vs-checkbox",
                                            {
                                              attrs: {
                                                size: "small",
                                                color: "success"
                                              },
                                              model: {
                                                value: _vm.g_display,
                                                callback: function($$v) {
                                                  _vm.g_display = $$v
                                                },
                                                expression: "g_display"
                                              }
                                            },
                                            [_vm._v("Display")]
                                          )
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "vs-col",
                                        { attrs: { "vs-w": "4" } },
                                        [
                                          _c(
                                            "vs-checkbox",
                                            {
                                              attrs: {
                                                size: "small",
                                                color: "success"
                                              },
                                              model: {
                                                value: _vm.g_retargeting,
                                                callback: function($$v) {
                                                  _vm.g_retargeting = $$v
                                                },
                                                expression: "g_retargeting"
                                              }
                                            },
                                            [_vm._v("Retargeting")]
                                          )
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _vm.weekly_budget == 500
                                        ? _c(
                                            "vs-col",
                                            { attrs: { "vs-w": "4" } },
                                            [
                                              _c(
                                                "vs-checkbox",
                                                {
                                                  attrs: {
                                                    size: "small",
                                                    color: "success"
                                                  },
                                                  model: {
                                                    value:
                                                      _vm.g_dynamic_retargeting,
                                                    callback: function($$v) {
                                                      _vm.g_dynamic_retargeting = $$v
                                                    },
                                                    expression:
                                                      "g_dynamic_retargeting"
                                                  }
                                                },
                                                [_vm._v("Dynamic Retargeting")]
                                              )
                                            ],
                                            1
                                          )
                                        : _vm._e()
                                    ],
                                    1
                                  )
                                : _vm._e()
                            ],
                            1
                          )
                        ],
                        1
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.plateform_facebook || _vm.plateform_google
                    ? _c(
                        "vs-row",
                        { staticClass: "mb-5" },
                        [
                          _c("vs-col", { attrs: { "vs-w": "4" } }, [
                            _c("label", [_vm._v("Ad placements:")])
                          ]),
                          _vm._v(" "),
                          _c(
                            "vs-col",
                            { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                            [
                              _vm.plateform_google
                                ? _c(
                                    "vs-row",
                                    { staticClass: "pb-3" },
                                    [
                                      _c(
                                        "vs-col",
                                        { attrs: { "vs-w": "4" } },
                                        [
                                          _c(
                                            "vs-checkbox",
                                            {
                                              attrs: {
                                                size: "small",
                                                color: "success"
                                              },
                                              model: {
                                                value: _vm.ad_gmail,
                                                callback: function($$v) {
                                                  _vm.ad_gmail = $$v
                                                },
                                                expression: "ad_gmail"
                                              }
                                            },
                                            [_vm._v("Gmail")]
                                          )
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "vs-col",
                                        { attrs: { "vs-w": "4" } },
                                        [
                                          _c(
                                            "vs-checkbox",
                                            {
                                              attrs: {
                                                size: "small",
                                                color: "success"
                                              },
                                              model: {
                                                value: _vm.ad_youtube,
                                                callback: function($$v) {
                                                  _vm.ad_youtube = $$v
                                                },
                                                expression: "ad_youtube"
                                              }
                                            },
                                            [_vm._v("YouTube")]
                                          )
                                        ],
                                        1
                                      )
                                    ],
                                    1
                                  )
                                : _vm._e(),
                              _vm._v(" "),
                              _vm.plateform_facebook
                                ? _c(
                                    "vs-row",
                                    [
                                      _c(
                                        "vs-col",
                                        { attrs: { "vs-w": "4" } },
                                        [
                                          _c(
                                            "vs-checkbox",
                                            {
                                              attrs: {
                                                size: "small",
                                                color: "success"
                                              },
                                              model: {
                                                value: _vm.ad_messenger,
                                                callback: function($$v) {
                                                  _vm.ad_messenger = $$v
                                                },
                                                expression: "ad_messenger"
                                              }
                                            },
                                            [_vm._v("Messenger")]
                                          )
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "vs-col",
                                        { attrs: { "vs-w": "4" } },
                                        [
                                          _c(
                                            "vs-checkbox",
                                            {
                                              attrs: {
                                                size: "small",
                                                color: "success"
                                              },
                                              model: {
                                                value: _vm.ad_instagram,
                                                callback: function($$v) {
                                                  _vm.ad_instagram = $$v
                                                },
                                                expression: "ad_instagram"
                                              }
                                            },
                                            [_vm._v("Instagram")]
                                          )
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "vs-col",
                                        { attrs: { "vs-w": "4" } },
                                        [
                                          _c(
                                            "vs-checkbox",
                                            {
                                              attrs: {
                                                size: "small",
                                                color: "success"
                                              },
                                              model: {
                                                value: _vm.ad_marketplace,
                                                callback: function($$v) {
                                                  _vm.ad_marketplace = $$v
                                                },
                                                expression: "ad_marketplace"
                                              }
                                            },
                                            [_vm._v("Marketplace")]
                                          )
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "vs-col",
                                        { attrs: { "vs-w": "4" } },
                                        [
                                          _c(
                                            "vs-checkbox",
                                            {
                                              attrs: {
                                                size: "small",
                                                color: "success"
                                              },
                                              model: {
                                                value: _vm.ad_facebook,
                                                callback: function($$v) {
                                                  _vm.ad_facebook = $$v
                                                },
                                                expression: "ad_facebook"
                                              }
                                            },
                                            [_vm._v("Facebook")]
                                          )
                                        ],
                                        1
                                      )
                                    ],
                                    1
                                  )
                                : _vm._e()
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c("vs-col", { attrs: { "vs-w": "12" } }, [_c("hr")])
                        ],
                        1
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _c(
                    "vs-row",
                    { staticClass: "mb-5" },
                    [
                      _c("vs-col", { attrs: { "vs-w": "4" } }, [
                        _c("label", [_vm._v("Short Tagline:")])
                      ]),
                      _vm._v(" "),
                      _c(
                        "vs-col",
                        { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                        [
                          _c("vs-input", {
                            staticClass: "inputx",
                            attrs: {
                              size: "small",
                              placeholder:
                                "The best car dealership in The United States of America.",
                              color: "success"
                            },
                            model: {
                              value: _vm.short_tagline,
                              callback: function($$v) {
                                _vm.short_tagline = $$v
                              },
                              expression: "short_tagline"
                            }
                          })
                        ],
                        1
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "vs-row",
                    { staticClass: "mb-5" },
                    [
                      _c("vs-col", { attrs: { "vs-w": "4" } }, [
                        _c("label", [_vm._v("Long Tagline:")])
                      ]),
                      _vm._v(" "),
                      _c(
                        "vs-col",
                        { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                        [
                          _c("vs-textarea", {
                            staticClass: "inputx",
                            attrs: {
                              counter: "200",
                              color: "success",
                              label: "Describe your dealership in a few words."
                            },
                            model: {
                              value: _vm.long_tagline,
                              callback: function($$v) {
                                _vm.long_tagline = $$v
                              },
                              expression: "long_tagline"
                            }
                          })
                        ],
                        1
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "vs-row",
                    { staticClass: "mb-5" },
                    [
                      _c("vs-col", { attrs: { "vs-w": "4" } }, [
                        _c("label", [_vm._v("Description:")])
                      ]),
                      _vm._v(" "),
                      _c(
                        "vs-col",
                        { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                        [
                          _c("vs-textarea", {
                            staticClass: "inputx",
                            attrs: {
                              counter: "200",
                              color: "success",
                              label: "Describe your dealership in a few words."
                            },
                            model: {
                              value: _vm.description,
                              callback: function($$v) {
                                _vm.description = $$v
                              },
                              expression: "description"
                            }
                          })
                        ],
                        1
                      )
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "vs-row",
                    { staticClass: "mb-5" },
                    [
                      _c("vs-col", { attrs: { "vs-w": "4" } }, [
                        _c("label", [_vm._v("Headline:")])
                      ]),
                      _vm._v(" "),
                      _c(
                        "vs-col",
                        { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                        [
                          _c("vs-input", {
                            staticClass: "inputx",
                            attrs: {
                              size: "small",
                              placeholder:
                                "The best car dealership in The United States of America.",
                              color: "success"
                            },
                            model: {
                              value: _vm.headline,
                              callback: function($$v) {
                                _vm.headline = $$v
                              },
                              expression: "headline"
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c("vs-col", { attrs: { "vs-w": "12" } }, [_c("hr")])
                    ],
                    1
                  )
                ],
                1
              )
            : _vm._e(),
          _vm._v(" "),
          _c(
            "div",
            {
              directives: [
                {
                  name: "show",
                  rawName: "v-show",
                  value: _vm.Isfinalstep(),
                  expression: "Isfinalstep()"
                }
              ]
            },
            [
              _c(
                "vs-row",
                { staticClass: "mb-5" },
                [
                  _c(
                    "vs-col",
                    {
                      staticClass: "text-center pb-5",
                      attrs: { "vs-w": "12" }
                    },
                    [_c("h2", [_vm._v("Finally, let’s design your creative!")])]
                  ),
                  _vm._v(" "),
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Color Scheme:")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                    [
                      _c(
                        "vs-select",
                        {
                          staticStyle: { width: "100%" },
                          attrs: { size: "small", color: "success" },
                          model: {
                            value: _vm.color_sheme,
                            callback: function($$v) {
                              _vm.color_sheme = $$v
                            },
                            expression: "color_sheme"
                          }
                        },
                        _vm._l(_vm.colors, function(item, index) {
                          return _c("vs-select-item", {
                            key: index,
                            attrs: { value: item.value, text: item.text }
                          })
                        }),
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "vs-row",
                { staticClass: "mb-5" },
                [
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Ad Template:")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                    [
                      _c(
                        "vs-select",
                        {
                          staticStyle: { width: "100%" },
                          attrs: { size: "small", color: "success" },
                          model: {
                            value: _vm.ad_template,
                            callback: function($$v) {
                              _vm.ad_template = $$v
                            },
                            expression: "ad_template"
                          }
                        },
                        _vm._l(_vm.ad_templates, function(item, index) {
                          return _c("vs-select-item", {
                            key: index,
                            attrs: { value: item.value, text: item.text }
                          })
                        }),
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "vs-row",
                { staticClass: "mb-5" },
                [
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Vehicule in Ad:")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                    [
                      _c("vs-input", {
                        staticClass: "inputx",
                        attrs: {
                          size: "small",
                          placeholder: "Red Tesla Model 3",
                          color: "success"
                        },
                        model: {
                          value: _vm.vehicle_ad,
                          callback: function($$v) {
                            _vm.vehicle_ad = $$v
                          },
                          expression: "vehicle_ad"
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "vs-row",
                { staticClass: "mb-5" },
                [
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Your Logo:")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { attrs: { "vs-w": "8" } },
                    [
                      _c(
                        "vs-row",
                        { staticClass: "mb-5" },
                        [
                          _c("vs-col", { attrs: { "vs-w": "4" } }, [
                            _c("img", {
                              staticStyle: { width: "100%" },
                              attrs: { src: _vm.logo }
                            })
                          ]),
                          _vm._v(" "),
                          _c(
                            "vs-col",
                            { attrs: { "vs-w": "4" } },
                            [
                              _c("input", {
                                staticStyle: { display: "none" },
                                attrs: { type: "file", id: "fileInput" },
                                on: { change: _vm.onFileChange }
                              }),
                              _vm._v(" "),
                              _c(
                                "vs-button",
                                {
                                  attrs: {
                                    color: "#74c166",
                                    onclick:
                                      "document.getElementById('fileInput').click()",
                                    size: "small"
                                  }
                                },
                                [
                                  _c("vs-icon", [_vm._v("cloud")]),
                                  _vm._v(" "),
                                  _c("span", [_vm._v("Replace this logo ")])
                                ],
                                1
                              )
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c("vs-col", { attrs: { "vs-w": "4" } })
                        ],
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "vs-row",
                { staticClass: "mb-5" },
                [
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Call to Action:")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                    [
                      _c("vs-input", {
                        staticClass: "inputx",
                        attrs: {
                          size: "small",
                          placeholder: "When Others Say No, We Say YES!",
                          color: "success"
                        },
                        model: {
                          value: _vm.call_action,
                          callback: function($$v) {
                            _vm.call_action = $$v
                          },
                          expression: "call_action"
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "vs-row",
                { staticClass: "mb-5" },
                [
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Landing page:")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                    [
                      _c("vs-input", {
                        staticClass: "inputx",
                        attrs: {
                          size: "small",
                          placeholder: "https://www.redonemotors.com/",
                          color: "success"
                        },
                        model: {
                          value: _vm.landing_page,
                          callback: function($$v) {
                            _vm.landing_page = $$v
                          },
                          expression: "landing_page"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c("vs-col", { attrs: { "vs-w": "12" } }, [_c("hr")])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "vs-row",
                { staticClass: "mb-5" },
                [
                  _c("vs-col", { attrs: { "vs-w": "4" } }, [
                    _c("label", [_vm._v("Notes:")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "vs-col",
                    { staticClass: "pb-3", attrs: { "vs-w": "8" } },
                    [
                      _c("vs-textarea", {
                        staticClass: "inputx",
                        attrs: {
                          label:
                            "Enter any specifics you want us to pay attention to…",
                          color: "success"
                        },
                        model: {
                          value: _vm.notes,
                          callback: function($$v) {
                            _vm.notes = $$v
                          },
                          expression: "notes"
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _vm.landing_page != "" &&
              _vm.vehicle_ad != "" &&
              _vm.call_action != ""
                ? _c(
                    "vs-row",
                    { staticClass: "mb-5" },
                    [
                      _c(
                        "vs-col",
                        { attrs: { "vs-w": "12" } },
                        [
                          _c(
                            "vs-button",
                            {
                              staticClass: "inputx",
                              attrs: { color: "#74c166" },
                              on: { click: _vm.submitForm }
                            },
                            [_vm._v("Submit")]
                          )
                        ],
                        1
                      )
                    ],
                    1
                  )
                : _vm._e()
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/src/views/SignUpForm.vue":
/*!***********************************************!*\
  !*** ./resources/js/src/views/SignUpForm.vue ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SignUpForm_vue_vue_type_template_id_54072ac6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SignUpForm.vue?vue&type=template&id=54072ac6& */ "./resources/js/src/views/SignUpForm.vue?vue&type=template&id=54072ac6&");
/* harmony import */ var _SignUpForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SignUpForm.vue?vue&type=script&lang=js& */ "./resources/js/src/views/SignUpForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _SignUpForm_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./SignUpForm.vue?vue&type=style&index=0&lang=scss& */ "./resources/js/src/views/SignUpForm.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _SignUpForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SignUpForm_vue_vue_type_template_id_54072ac6___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SignUpForm_vue_vue_type_template_id_54072ac6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/SignUpForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/SignUpForm.vue?vue&type=script&lang=js&":
/*!************************************************************************!*\
  !*** ./resources/js/src/views/SignUpForm.vue?vue&type=script&lang=js& ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SignUpForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./SignUpForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/SignUpForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SignUpForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/SignUpForm.vue?vue&type=style&index=0&lang=scss&":
/*!*********************************************************************************!*\
  !*** ./resources/js/src/views/SignUpForm.vue?vue&type=style&index=0&lang=scss& ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_SignUpForm_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--8-2!../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../node_modules/vue-loader/lib??vue-loader-options!./SignUpForm.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/SignUpForm.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_SignUpForm_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_SignUpForm_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_SignUpForm_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_SignUpForm_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_SignUpForm_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/src/views/SignUpForm.vue?vue&type=template&id=54072ac6&":
/*!******************************************************************************!*\
  !*** ./resources/js/src/views/SignUpForm.vue?vue&type=template&id=54072ac6& ***!
  \******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SignUpForm_vue_vue_type_template_id_54072ac6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./SignUpForm.vue?vue&type=template&id=54072ac6& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/SignUpForm.vue?vue&type=template&id=54072ac6&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SignUpForm_vue_vue_type_template_id_54072ac6___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SignUpForm_vue_vue_type_template_id_54072ac6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);