(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/SearchSellersComponent.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/SearchSellersComponent.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
      status: false,
      statusDisconnected: false,
      searchSeller: '',
      //Buscar vendedor
      surveys: [],
      //Encuesta
      filters: [],
      sellers: []
    };
  },
  watch: {
    filters: function filters() {
      var vm = this;
      vm.search();
    },
    status: function status() {
      var vm = this;
      vm.search();
    }
  },
  methods: {
    search: function search() {
      var vm = this;
      axios.post('/filtro', {
        status: vm.status,
        statusDisconnected: vm.statusDisconnected,
        filters: vm.filters,
        search: vm.searchSeller
      }).then(function (response) {
        vm.sellers = response.data;
      })["catch"](function (error) {
        console.error(error);
      });
    },
    getOptions: function getOptions(options) {
      return typeof options === 'string' ? JSON.parse(options) : options;
    },
    getStatus: function getStatus(status) {
      return status ? 'conectado' : 'desconectado';
    }
  },
  mounted: function mounted() {
    var vm = this;
    axios.get('/get-users').then(function (response) {
      vm.sellers = response.data;
    })["catch"](function (error) {
      console.error(error);
    });
    axios.get('/get-surveys').then(function (response) {
      vm.surveys = response.data;
    })["catch"](function (error) {
      console.error(error);
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/SearchSellersComponent.vue?vue&type=template&id=200a3bfc&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/SearchSellersComponent.vue?vue&type=template&id=200a3bfc& ***!
  \*************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "row justify-content-center" }, [
    _c("div", { staticClass: "col-md-4" }, [
      _c("div", { staticClass: "card" }, [
        _c("div", { staticClass: "card-header" }, [_vm._v("Filtros")]),
        _vm._v(" "),
        _c("div", { staticClass: "card-body" }, [
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-12 mb-4" }, [
              _c("b", [_vm._v("Estado de conexión")]),
              _vm._v(" "),
              _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-12" }, [
                  _c("div", { staticClass: "form-check" }, [
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.status,
                          expression: "status"
                        }
                      ],
                      staticClass: "form-check-input",
                      attrs: {
                        type: "checkbox",
                        disabled: _vm.statusDisconnected
                      },
                      domProps: {
                        value: true,
                        checked: Array.isArray(_vm.status)
                          ? _vm._i(_vm.status, true) > -1
                          : _vm.status
                      },
                      on: {
                        change: function($event) {
                          var $$a = _vm.status,
                            $$el = $event.target,
                            $$c = $$el.checked ? true : false
                          if (Array.isArray($$a)) {
                            var $$v = true,
                              $$i = _vm._i($$a, $$v)
                            if ($$el.checked) {
                              $$i < 0 && (_vm.status = $$a.concat([$$v]))
                            } else {
                              $$i > -1 &&
                                (_vm.status = $$a
                                  .slice(0, $$i)
                                  .concat($$a.slice($$i + 1)))
                            }
                          } else {
                            _vm.status = $$c
                          }
                        }
                      }
                    }),
                    _vm._v(" "),
                    _c("label", { staticClass: "form-check-label" }, [
                      _vm._v(
                        "\n                                        Conectado\n                                    "
                      )
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "form-check" }, [
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.statusDisconnected,
                          expression: "statusDisconnected"
                        }
                      ],
                      staticClass: "form-check-input",
                      attrs: { type: "checkbox", disabled: _vm.status },
                      domProps: {
                        value: true,
                        checked: Array.isArray(_vm.statusDisconnected)
                          ? _vm._i(_vm.statusDisconnected, true) > -1
                          : _vm.statusDisconnected
                      },
                      on: {
                        change: function($event) {
                          var $$a = _vm.statusDisconnected,
                            $$el = $event.target,
                            $$c = $$el.checked ? true : false
                          if (Array.isArray($$a)) {
                            var $$v = true,
                              $$i = _vm._i($$a, $$v)
                            if ($$el.checked) {
                              $$i < 0 &&
                                (_vm.statusDisconnected = $$a.concat([$$v]))
                            } else {
                              $$i > -1 &&
                                (_vm.statusDisconnected = $$a
                                  .slice(0, $$i)
                                  .concat($$a.slice($$i + 1)))
                            }
                          } else {
                            _vm.statusDisconnected = $$c
                          }
                        }
                      }
                    }),
                    _vm._v(" "),
                    _c("label", { staticClass: "form-check-label" }, [
                      _vm._v(
                        "\n                                        Desconectado\n                                    "
                      )
                    ])
                  ])
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "row" },
            _vm._l(_vm.surveys, function(survey) {
              return _c(
                "div",
                { staticClass: "col-12 mb-4" },
                [
                  _c("b", [_vm._v(_vm._s(survey.name))]),
                  _vm._v(" "),
                  _vm._l(_vm.getOptions(survey.options), function(
                    question,
                    index
                  ) {
                    return _c("div", { staticClass: "row" }, [
                      _c("div", { staticClass: "col-12" }, [
                        _c("div", { staticClass: "form-check" }, [
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.filters,
                                expression: "filters"
                              }
                            ],
                            staticClass: "form-check-input",
                            attrs: { type: "checkbox" },
                            domProps: {
                              value: {
                                question_id: survey.id,
                                option_index: index
                              },
                              checked: Array.isArray(_vm.filters)
                                ? _vm._i(_vm.filters, {
                                    question_id: survey.id,
                                    option_index: index
                                  }) > -1
                                : _vm.filters
                            },
                            on: {
                              change: function($event) {
                                var $$a = _vm.filters,
                                  $$el = $event.target,
                                  $$c = $$el.checked ? true : false
                                if (Array.isArray($$a)) {
                                  var $$v = {
                                      question_id: survey.id,
                                      option_index: index
                                    },
                                    $$i = _vm._i($$a, $$v)
                                  if ($$el.checked) {
                                    $$i < 0 && (_vm.filters = $$a.concat([$$v]))
                                  } else {
                                    $$i > -1 &&
                                      (_vm.filters = $$a
                                        .slice(0, $$i)
                                        .concat($$a.slice($$i + 1)))
                                  }
                                } else {
                                  _vm.filters = $$c
                                }
                              }
                            }
                          }),
                          _vm._v(" "),
                          _c("label", { staticClass: "form-check-label" }, [
                            _vm._v(
                              "\n                                        " +
                                _vm._s(question) +
                                "\n                                    "
                            )
                          ])
                        ])
                      ])
                    ])
                  })
                ],
                2
              )
            }),
            0
          )
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "col-md-8" }, [
      _c("div", { staticClass: "card" }, [
        _c("div", { staticClass: "card-header" }, [_vm._v("Vendedores")]),
        _vm._v(" "),
        _c("div", { staticClass: "card-body" }, [
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-12" }, [
              _c("div", { staticClass: "input-group" }, [
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.searchSeller,
                      expression: "searchSeller"
                    }
                  ],
                  staticClass: "form-control",
                  attrs: { type: "text", placeholder: "Buscar vendedor..." },
                  domProps: { value: _vm.searchSeller },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.searchSeller = $event.target.value
                    }
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "input-group-append" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-primary",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          return _vm.search()
                        }
                      }
                    },
                    [
                      _vm._v(
                        "\n                                    Buscar\n                                "
                      )
                    ]
                  )
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c(
            "table",
            {
              staticClass:
                "table table-hover table-striped dt-responsive nowrap display datatable"
            },
            [
              _vm._m(0),
              _vm._v(" "),
              _c(
                "tbody",
                _vm._l(_vm.sellers, function(seller) {
                  return _c("tr", [
                    _c("td", [_vm._v(_vm._s(seller.name))]),
                    _vm._v(" "),
                    _c("td", [_vm._v(_vm._s(seller.last_name))]),
                    _vm._v(" "),
                    _c("td", [_vm._v(_vm._s(seller.email))]),
                    _vm._v(" "),
                    _c("td", [_vm._v(_vm._s(seller.last_login))]),
                    _vm._v(" "),
                    _c("td", [
                      _vm.getStatus(seller.status) === "conectado"
                        ? _c("div", [_vm._m(1, true)])
                        : _c("div", [_vm._m(2, true)])
                    ])
                  ])
                }),
                0
              )
            ]
          )
        ])
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", [_vm._v("Nombre")]),
        _vm._v(" "),
        _c("th", [_vm._v("Apellido")]),
        _vm._v(" "),
        _c("th", [_vm._v("Correo")]),
        _vm._v(" "),
        _c("th", [_vm._v("Última Conexión")]),
        _vm._v(" "),
        _c("th", [_vm._v("Status")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("span", { staticClass: "feature-online" }, [
      _c("i", { staticClass: "flaticon-chat", attrs: { title: "Conectado" } })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("span", { staticClass: "feature-offline" }, [
      _c("i", {
        staticClass: "flaticon-envelope",
        attrs: { title: "Desconectado" }
      })
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functional component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/js/components/SearchSellersComponent.vue":
/*!************************************************************!*\
  !*** ./resources/js/components/SearchSellersComponent.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SearchSellersComponent_vue_vue_type_template_id_200a3bfc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SearchSellersComponent.vue?vue&type=template&id=200a3bfc& */ "./resources/js/components/SearchSellersComponent.vue?vue&type=template&id=200a3bfc&");
/* harmony import */ var _SearchSellersComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SearchSellersComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/SearchSellersComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SearchSellersComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SearchSellersComponent_vue_vue_type_template_id_200a3bfc___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SearchSellersComponent_vue_vue_type_template_id_200a3bfc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/SearchSellersComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/SearchSellersComponent.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/SearchSellersComponent.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SearchSellersComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./SearchSellersComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/SearchSellersComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SearchSellersComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/SearchSellersComponent.vue?vue&type=template&id=200a3bfc&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/SearchSellersComponent.vue?vue&type=template&id=200a3bfc& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SearchSellersComponent_vue_vue_type_template_id_200a3bfc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./SearchSellersComponent.vue?vue&type=template&id=200a3bfc& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/SearchSellersComponent.vue?vue&type=template&id=200a3bfc&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SearchSellersComponent_vue_vue_type_template_id_200a3bfc___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SearchSellersComponent_vue_vue_type_template_id_200a3bfc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);