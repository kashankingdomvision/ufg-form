/*!
 * jQuery formRender: https://formbuilder.online/
 * Version: 3.7.2
 * Author: Kevin Chappell <kevin.b.chappell@gmail.com>
 */
!(function (e) {
    "use strict";
    !(function (e) {
        var t = {};
        function n(r) {
            if (t[r]) return t[r].exports;
            var o = (t[r] = { i: r, l: !1, exports: {} });
            return e[r].call(o.exports, o, o.exports, n), (o.l = !0), o.exports;
        }
        (n.m = e),
            (n.c = t),
            (n.d = function (e, t, r) {
                n.o(e, t) || Object.defineProperty(e, t, { enumerable: !0, get: r });
            }),
            (n.r = function (e) {
                "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(e, "__esModule", { value: !0 });
            }),
            (n.t = function (e, t) {
                if ((1 & t && (e = n(e)), 8 & t)) return e;
                if (4 & t && "object" == typeof e && e && e.__esModule) return e;
                var r = Object.create(null);
                if ((n.r(r), Object.defineProperty(r, "default", { enumerable: !0, value: e }), 2 & t && "string" != typeof e))
                    for (var o in e)
                        n.d(
                            r,
                            o,
                            function (t) {
                                return e[t];
                            }.bind(null, o)
                        );
                return r;
            }),
            (n.n = function (e) {
                var t =
                    e && e.__esModule
                        ? function () {
                              return e.default;
                          }
                        : function () {
                              return e;
                          };
                return n.d(t, "a", t), t;
            }),
            (n.o = function (e, t) {
                return Object.prototype.hasOwnProperty.call(e, t);
            }),
            (n.p = ""),
            n((n.s = 30));
    })([
        function (t, n, r) {
            function o(e, t) {
                var n = Object.keys(e);
                if (Object.getOwnPropertySymbols) {
                    var r = Object.getOwnPropertySymbols(e);
                    t &&
                        (r = r.filter(function (t) {
                            return Object.getOwnPropertyDescriptor(e, t).enumerable;
                        })),
                        n.push.apply(n, r);
                }
                return n;
            }
            function i(e) {
                for (var t = 1; t < arguments.length; t++) {
                    var n = null != arguments[t] ? arguments[t] : {};
                    t % 2
                        ? o(Object(n), !0).forEach(function (t) {
                              s(e, t, n[t]);
                          })
                        : Object.getOwnPropertyDescriptors
                        ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n))
                        : o(Object(n)).forEach(function (t) {
                              Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(n, t));
                          });
                }
                return e;
            }
            function s(e, t, n) {
                return t in e ? Object.defineProperty(e, t, { value: n, enumerable: !0, configurable: !0, writable: !0 }) : (e[t] = n), e;
            }
            function a(e, t) {
                if (null == e) return {};
                var n,
                    r,
                    o = (function (e, t) {
                        if (null == e) return {};
                        var n,
                            r,
                            o = {},
                            i = Object.keys(e);
                        for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (o[n] = e[n]);
                        return o;
                    })(e, t);
                if (Object.getOwnPropertySymbols) {
                    var i = Object.getOwnPropertySymbols(e);
                    for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]));
                }
                return o;
            }
            r.d(n, "A", function () {
                return l;
            }),
                r.d(n, "C", function () {
                    return u;
                }),
                r.d(n, "b", function () {
                    return d;
                }),
                r.d(n, "h", function () {
                    return f;
                }),
                r.d(n, "n", function () {
                    return m;
                }),
                r.d(n, "c", function () {
                    return g;
                }),
                r.d(n, "s", function () {
                    return b;
                }),
                r.d(n, "k", function () {
                    return y;
                }),
                r.d(n, "q", function () {
                    return v;
                }),
                r.d(n, "t", function () {
                    return q;
                }),
                r.d(n, "u", function () {
                    return j;
                }),
                r.d(n, "g", function () {
                    return k;
                }),
                r.d(n, "i", function () {
                    return S;
                }),
                r.d(n, "B", function () {
                    return E;
                }),
                r.d(n, "v", function () {
                    return A;
                }),
                r.d(n, "l", function () {
                    return T;
                }),
                r.d(n, "p", function () {
                    return R;
                }),
                r.d(n, "m", function () {
                    return L;
                }),
                r.d(n, "d", function () {
                    return D;
                }),
                r.d(n, "a", function () {
                    return N;
                }),
                r.d(n, "e", function () {
                    return F;
                }),
                r.d(n, "r", function () {
                    return M;
                }),
                r.d(n, "x", function () {
                    return B;
                }),
                r.d(n, "j", function () {
                    return U;
                }),
                r.d(n, "y", function () {
                    return z;
                }),
                r.d(n, "o", function () {
                    return I;
                }),
                r.d(n, "w", function () {
                    return H;
                }),
                r.d(n, "z", function () {
                    return $;
                }),
                (window.fbLoaded = { js: [], css: [] }),
                (window.fbEditors = { quill: {}, tinymce: {} });
            const l = function (e, t = !1) {
                    const n = [null, void 0, ""];
                    t && n.push(!1);
                    for (const t in e) n.includes(e[t]) ? delete e[t] : Array.isArray(e[t]) && (e[t].length || delete e[t]);
                    return e;
                },
                c = function (e) {
                    return !["values", "enableOther", "other", "label", "subtype"].includes(e);
                },
                u = (e) =>
                    Object.entries(e)
                        .map(([e, t]) => `${m(e)}="${t}"`)
                        .join(" "),
                d = (e) =>
                    Object.entries(e)
                        .map(([e, t]) => c(e) && Object.values(p(e, t)).join(""))
                        .filter(Boolean)
                        .join(" "),
                p = (e, t) => {
                    let n;
                    return (e = h(e)), t && (Array.isArray(t) ? (n = C(t.join(" "))) : ("boolean" == typeof t && (t = t.toString()), (n = C(t.trim())))), { name: e, value: (t = t ? `="${n}"` : "") };
                },
                f = (e) => e.reduce((e, t) => e.concat(Array.isArray(t) ? f(t) : t), []),
                h = (e) => ({ className: "class" }[e] || m(e)),
                m = (e) =>
                    (e = (e = e.replace(/[^\w\s\-]/gi, "")).replace(/([A-Z])/g, function (e) {
                        return "-" + e.toLowerCase();
                    }))
                        .replace(/\s/g, "-")
                        .replace(/^-+/g, ""),
                g = (e) => e.replace(/-([a-z])/g, (e, t) => t.toUpperCase()),
                b = (function () {
                    let e,
                        t = 0;
                    return function (n) {
                        const r = new Date().getTime();
                        r === e ? ++t : ((t = 0), (e = r));
                        return (n.type || m(n.label)) + "-" + r + "-" + t;
                    };
                })(),
                y = (e) =>
                    void 0 === e
                        ? e
                        : [
                              ["array", (e) => Array.isArray(e)],
                              ["node", (e) => e instanceof window.Node || e instanceof window.HTMLElement],
                              ["component", () => e && e.dom],
                              [typeof e, () => !0],
                          ].find((t) => t[1](e))[0],
                v = function (e, t = "", n = {}) {
                    let r = y(t);
                    const { events: o } = n,
                        i = a(n, ["events"]),
                        s = document.createElement(e),
                        l = {
                            string: (e) => {
                                s.innerHTML += e;
                            },
                            object: (e) => {
                                const { tag: t, content: n } = e,
                                    r = a(e, ["tag", "content"]);
                                return s.appendChild(v(t, n, r));
                            },
                            node: (e) => s.appendChild(e),
                            array: (e) => {
                                for (let t = 0; t < e.length; t++) (r = y(e[t])), l[r](e[t]);
                            },
                            function: (e) => {
                                (e = e()), (r = y(e)), l[r](e);
                            },
                            undefined: () => {},
                        };
                    for (const e in i)
                        if (i.hasOwnProperty(e)) {
                            const t = h(e),
                                n = Array.isArray(i[e]) ? E(i[e].join(" ").split(" ")).join(" ") : i[e];
                            s.setAttribute(t, n);
                        }
                    return (
                        t && l[r](t),
                        ((e, t) => {
                            if (t) for (const n in t) t.hasOwnProperty(n) && e.addEventListener(n, (e) => t[n](e));
                        })(s, o),
                        s
                    );
                },
                x = (e) => {
                    const t = e.attributes,
                        n = {};
                    return (
                        S(t, (e) => {
                            let r = t[e].value || "";
                            r.match(/false|true/g) ? (r = "true" === r) : r.match(/undefined/g) && (r = void 0), r && (n[g(t[e].name)] = r);
                        }),
                        n
                    );
                },
                w = (e) => {
                    const t = [];
                    for (let n = 0; n < e.length; n++) {
                        const r = i(i({}, x(e[n])), {}, { label: e[n].textContent });
                        t.push(r);
                    }
                    return t;
                },
                O = (e) => {
                    const t = [];
                    if (e.length) {
                        const n = e[0].getElementsByTagName("value");
                        for (let e = 0; e < n.length; e++) t.push(n[e].textContent);
                    }
                    return t;
                },
                q = (e) => {
                    const t = new window.DOMParser().parseFromString(e, "text/xml"),
                        n = [];
                    if (t) {
                        const e = t.getElementsByTagName("field");
                        for (let t = 0; t < e.length; t++) {
                            const r = x(e[t]),
                                o = e[t].getElementsByTagName("option"),
                                i = e[t].getElementsByTagName("userData");
                            o && o.length && (r.values = w(o)), i && i.length && (r.userData = O(i)), n.push(r);
                        }
                    }
                    return n;
                },
                j = (e) => {
                    const t = document.createElement("textarea");
                    return (t.innerHTML = e), t.textContent;
                },
                k = (e) => {
                    const t = document.createElement("textarea");
                    return (t.textContent = e), t.innerHTML;
                },
                C = (e) => {
                    const t = { '"': "&quot;", "&": "&amp;", "<": "&lt;", ">": "&gt;" };
                    return "string" == typeof e ? e.replace(/["&<>]/g, (e) => t[e] || e) : e;
                },
                S = function (e, t, n) {
                    for (let r = 0; r < e.length; r++) t.call(n, r, e[r]);
                },
                E = (e) => e.filter((e, t, n) => n.indexOf(e) === t),
                A = (e, t) => {
                    const n = t.indexOf(e);
                    n > -1 && t.splice(n, 1);
                },
                T = (e, t) => {
                    const n = jQuery;
                    let r = [];
                    return (
                        Array.isArray(e) || (e = [e]),
                        R(e) ||
                            (r = jQuery.map(e, (e) => {
                                const n = { dataType: "script", cache: !0, url: (t || "") + e };
                                return jQuery.ajax(n).done(() => window.fbLoaded.js.push(e));
                            })),
                        r.push(jQuery.Deferred((e) => n(e.resolve))),
                        jQuery.when(...r)
                    );
                },
                R = (e, t = "js") => {
                    let n = !1;
                    const r = window.fbLoaded[t];
                    return (n = Array.isArray(e) ? e.every((e) => r.includes(e)) : r.includes(e)), n;
                },
                L = (t, n) => {
                    Array.isArray(t) || (t = [t]),
                        t.forEach((t) => {
                            let r = "href",
                                o = t,
                                i = "";
                            if (("object" == typeof t && ((r = t.type || (t.style ? "inline" : "href")), (i = t.id), (t = "inline" == r ? t.style : t.href), (o = i || t.href || t.style)), !R(o, "css"))) {
                                if ("href" == r) {
                                    const e = document.createElement("link");
                                    (e.type = "text/css"), (e.rel = "stylesheet"), (e.href = (n || "") + t), document.head.appendChild(e);
                                } else e(`<style type="text/css">${t}</style>`).attr("id", i).appendTo(e(document.head));
                                window.fbLoaded.css.push(o);
                            }
                        });
                },
                D = (e) =>
                    e.replace(/\b\w/g, function (e) {
                        return e.toUpperCase();
                    }),
                P = (e, t) => {
                    const n = Object.assign({}, e, t);
                    for (const r in t) n.hasOwnProperty(r) && (Array.isArray(t[r]) ? (n[r] = Array.isArray(e[r]) ? E(e[r].concat(t[r])) : t[r]) : "object" == typeof t[r] ? (n[r] = P(e[r], t[r])) : (n[r] = t[r]));
                    return n;
                },
                N = (e, t, n) => t.split(" ").forEach((t) => e.addEventListener(t, n, !1)),
                F = (e, t) => {
                    const n = t.replace(".", "");
                    for (; (e = e.parentElement) && !e.classList.contains(n); );
                    return e;
                },
                M = () => {
                    let e = "";
                    var t;
                    return (
                        (t = navigator.userAgent || navigator.vendor || window.opera),
                        /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(
                            t
                        ) && (e = "formbuilder-mobile"),
                        e
                    );
                },
                B = (e) => e.replace(/\s/g, "-").replace(/[^a-zA-Z0-9[\]_-]/g, ""),
                U = (e) => e.replace(/[^0-9]/g, ""),
                z = (e, t) =>
                    t.filter(function (e) {
                        return !~this.indexOf(e);
                    }, e),
                I = (e) => {
                    const t = (e = Array.isArray(e) ? e : [e]).map(
                        ({ src: e, id: t }) =>
                            new Promise((n) => {
                                if (window.fbLoaded.css.includes(e)) return n(e);
                                const r = v("link", null, { href: e, rel: "stylesheet", id: t });
                                document.head.insertBefore(r, document.head.firstChild);
                            })
                    );
                    return Promise.all(t);
                },
                H = (e) => {
                    const t = document.getElementById(e);
                    return t.parentElement.removeChild(t);
                };
            function $(e) {
                const t = ["a", "an", "and", "as", "at", "but", "by", "for", "for", "from", "in", "into", "near", "nor", "of", "on", "onto", "or", "the", "to", "with"].map((e) => `\\s${e}\\s`),
                    n = new RegExp(`(?!${t.join("|")})\\w\\S*`, "g");
                return ("" + e).replace(n, (e) => e.charAt(0).toUpperCase() + e.substr(1).replace(/[A-Z]/g, (e) => " " + e));
            }
            const _ = {
                addEventListeners: N,
                attrString: d,
                camelCase: g,
                capitalize: D,
                closest: F,
                getContentType: y,
                escapeAttr: C,
                escapeAttrs: (e) => {
                    for (const t in e) e.hasOwnProperty(t) && (e[t] = C(e[t]));
                    return e;
                },
                escapeHtml: k,
                forceNumber: U,
                forEach: S,
                getScripts: T,
                getStyles: L,
                hyphenCase: m,
                isCached: R,
                markup: v,
                merge: P,
                mobileClass: M,
                nameAttr: b,
                parseAttrs: x,
                parsedHtml: j,
                parseOptions: w,
                parseUserData: O,
                parseXML: q,
                removeFromArray: A,
                safeAttr: p,
                safeAttrName: h,
                safename: B,
                subtract: z,
                trimObj: l,
                unique: E,
                validAttr: c,
                titleCase: $,
                splitObject: (e, t) => {
                    const n = (e) => (t, n) => ((t[n] = e[n]), t);
                    return [
                        Object.keys(e)
                            .filter((e) => t.includes(e))
                            .reduce(n(e), {}),
                        Object.keys(e)
                            .filter((e) => !t.includes(e))
                            .reduce(n(e), {}),
                    ];
                },
            };
            n.f = _;
        },
        function (e, t, n) {
            n.d(t, "a", function () {
                return a;
            });
            var r = n(0),
                o = n(2),
                i = n.n(o);
            function s(e, t) {
                if (null == e) return {};
                var n,
                    r,
                    o = (function (e, t) {
                        if (null == e) return {};
                        var n,
                            r,
                            o = {},
                            i = Object.keys(e);
                        for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (o[n] = e[n]);
                        return o;
                    })(e, t);
                if (Object.getOwnPropertySymbols) {
                    var i = Object.getOwnPropertySymbols(e);
                    for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]));
                }
                return o;
            }
            class a {
                constructor(e, t) {
                    (this.rawConfig = jQuery.extend({}, e)), (e = jQuery.extend({}, e)), (this.preview = t), delete e.isPreview, this.preview && delete e.required;
                    const n = ["label", "description", "subtype", "required", "disabled"];
                    for (const t of n) (this[t] = e[t]), delete e[t];
                    e.id || (e.name ? (e.id = e.name) : (e.id = "control-" + Math.floor(1e7 * Math.random() + 1))),
                        (this.id = e.id),
                        (this.type = e.type),
                        this.description && (e.title = this.description),
                        a.controlConfig || (a.controlConfig = {});
                    const r = this.subtype ? this.type + "." + this.subtype : this.type;
                    (this.classConfig = jQuery.extend({}, a.controlConfig[r] || {})),
                        this.subtype && (e.type = this.subtype),
                        this.required && ((e.required = "required"), (e["aria-required"] = "true")),
                        this.disabled && (e.disabled = "disabled"),
                        (this.config = e),
                        this.configure();
                }
                static get definition() {
                    return {};
                }
                static register(e, t, n) {
                    const r = n ? n + "." : "";
                    a.classRegister || (a.classRegister = {}), Array.isArray(e) || (e = [e]);
                    for (const n of e) -1 === n.indexOf(".") ? (a.classRegister[r + n] = t) : a.error(`Ignoring type ${n}. Cannot use the character '.' in a type name.`);
                }
                static getRegistered(e = !1) {
                    const t = Object.keys(a.classRegister);
                    return t.length ? t.filter((t) => (e ? t.indexOf(e + ".") > -1 : -1 == t.indexOf("."))) : t;
                }
                static getRegisteredSubtypes() {
                    const e = {};
                    for (const t in a.classRegister)
                        if (a.classRegister.hasOwnProperty(t)) {
                            const [n, r] = t.split(".");
                            if (!r) continue;
                            e[n] || (e[n] = []), e[n].push(r);
                        }
                    return e;
                }
                static getClass(e, t) {
                    const n = t ? e + "." + t : e,
                        r = a.classRegister[n] || a.classRegister[e];
                    return r || a.error("Invalid control type. (Type: " + e + ", Subtype: " + t + "). Please ensure you have registered it, and imported it correctly.");
                }
                static loadCustom(e) {
                    let t = [];
                    if ((e && (t = t.concat(e)), window.fbControls && (t = t.concat(window.fbControls)), !this.fbControlsLoaded)) {
                        for (const e of t) e(a, a.classRegister);
                        this.fbControlsLoaded = !0;
                    }
                }
                static mi18n(e, t) {
                    const n = this.definition;
                    let r = n.i18n || {};
                    r = r[i.a.locale] || r.default || r;
                    const o = this.camelCase(e),
                        s = "object" == typeof r ? r[o] || r[e] : r;
                    if (s) return s;
                    let a = n.mi18n;
                    return "object" == typeof a && (a = a[o] || a[e]), a || (a = o), i.a.get(a, t);
                }
                static active(e) {
                    return !Array.isArray(this.definition.inactive) || -1 == this.definition.inactive.indexOf(e);
                }
                static label(e) {
                    return this.mi18n(e);
                }
                static icon(e) {
                    const t = this.definition;
                    return t && "object" == typeof t.icon ? t.icon[e] : t.icon;
                }
                configure() {}
                build() {
                    const e = this.config,
                        { label: t, type: n } = e,
                        o = s(e, ["label", "type"]);
                    return this.markup(n, Object(r.u)(t), o);
                }
                on(e) {
                    const t = {
                        prerender: (e) => e,
                        render: (e) => {
                            const t = () => {
                                this.onRender && this.onRender(e);
                            };
                            this.css && Object(r.m)(this.css), this.js && !Object(r.p)(this.js) ? Object(r.l)(this.js).done(t) : t();
                        },
                    };
                    return e ? t[e] : t;
                }
                static error(e) {
                    throw new Error(e);
                }
                markup(e, t = "", n = {}) {
                    return (this.element = Object(r.q)(e, t, n)), this.element;
                }
                parsedHtml(e) {
                    return Object(r.u)(e);
                }
                static camelCase(e) {
                    return Object(r.c)(e);
                }
            }
        },
        function (e, t) {
            /*!
             * mi18n - https://github.com/Draggable/mi18n
             * Version: 0.4.7
             * Author: Kevin Chappell <kevin.b.chappell@gmail.com> (http://kevin-chappell.com)
             */
            e.exports = (function (e) {
                var t = {};
                function n(r) {
                    if (t[r]) return t[r].exports;
                    var o = (t[r] = { i: r, l: !1, exports: {} });
                    return e[r].call(o.exports, o, o.exports, n), (o.l = !0), o.exports;
                }
                return (
                    (n.m = e),
                    (n.c = t),
                    (n.d = function (e, t, r) {
                        n.o(e, t) || Object.defineProperty(e, t, { enumerable: !0, get: r });
                    }),
                    (n.r = function (e) {
                        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(e, "__esModule", { value: !0 });
                    }),
                    (n.t = function (e, t) {
                        if ((1 & t && (e = n(e)), 8 & t)) return e;
                        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
                        var r = Object.create(null);
                        if ((n.r(r), Object.defineProperty(r, "default", { enumerable: !0, value: e }), 2 & t && "string" != typeof e))
                            for (var o in e)
                                n.d(
                                    r,
                                    o,
                                    function (t) {
                                        return e[t];
                                    }.bind(null, o)
                                );
                        return r;
                    }),
                    (n.n = function (e) {
                        var t =
                            e && e.__esModule
                                ? function () {
                                      return e.default;
                                  }
                                : function () {
                                      return e;
                                  };
                        return n.d(t, "a", t), t;
                    }),
                    (n.o = function (e, t) {
                        return Object.prototype.hasOwnProperty.call(e, t);
                    }),
                    (n.p = ""),
                    n((n.s = 7))
                );
            })([
                function (e, t, n) {
                    var r =
                            "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
                                ? function (e) {
                                      return typeof e;
                                  }
                                : function (e) {
                                      return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e;
                                  },
                        o = n(2),
                        i = n(10),
                        s = Object.prototype.toString;
                    function a(e) {
                        return "[object Array]" === s.call(e);
                    }
                    function l(e) {
                        return null !== e && "object" === (void 0 === e ? "undefined" : r(e));
                    }
                    function c(e) {
                        return "[object Function]" === s.call(e);
                    }
                    function u(e, t) {
                        if (null != e)
                            if (("object" !== (void 0 === e ? "undefined" : r(e)) && (e = [e]), a(e))) for (var n = 0, o = e.length; n < o; n++) t.call(null, e[n], n, e);
                            else for (var i in e) Object.prototype.hasOwnProperty.call(e, i) && t.call(null, e[i], i, e);
                    }
                    e.exports = {
                        isArray: a,
                        isArrayBuffer: function (e) {
                            return "[object ArrayBuffer]" === s.call(e);
                        },
                        isBuffer: i,
                        isFormData: function (e) {
                            return "undefined" != typeof FormData && e instanceof FormData;
                        },
                        isArrayBufferView: function (e) {
                            return "undefined" != typeof ArrayBuffer && ArrayBuffer.isView ? ArrayBuffer.isView(e) : e && e.buffer && e.buffer instanceof ArrayBuffer;
                        },
                        isString: function (e) {
                            return "string" == typeof e;
                        },
                        isNumber: function (e) {
                            return "number" == typeof e;
                        },
                        isObject: l,
                        isUndefined: function (e) {
                            return void 0 === e;
                        },
                        isDate: function (e) {
                            return "[object Date]" === s.call(e);
                        },
                        isFile: function (e) {
                            return "[object File]" === s.call(e);
                        },
                        isBlob: function (e) {
                            return "[object Blob]" === s.call(e);
                        },
                        isFunction: c,
                        isStream: function (e) {
                            return l(e) && c(e.pipe);
                        },
                        isURLSearchParams: function (e) {
                            return "undefined" != typeof URLSearchParams && e instanceof URLSearchParams;
                        },
                        isStandardBrowserEnv: function () {
                            return ("undefined" == typeof navigator || "ReactNative" !== navigator.product) && "undefined" != typeof window && "undefined" != typeof document;
                        },
                        forEach: u,
                        merge: function e() {
                            var t = {};
                            function n(n, o) {
                                "object" === r(t[o]) && "object" === (void 0 === n ? "undefined" : r(n)) ? (t[o] = e(t[o], n)) : (t[o] = n);
                            }
                            for (var o = 0, i = arguments.length; o < i; o++) u(arguments[o], n);
                            return t;
                        },
                        extend: function (e, t, n) {
                            return (
                                u(t, function (t, r) {
                                    e[r] = n && "function" == typeof t ? o(t, n) : t;
                                }),
                                e
                            );
                        },
                        trim: function (e) {
                            return e.replace(/^\s*/, "").replace(/\s*$/, "");
                        },
                    };
                },
                function (e, t, n) {
                    (function (t) {
                        var r = n(0),
                            o = n(13),
                            i = { "Content-Type": "application/x-www-form-urlencoded" };
                        function s(e, t) {
                            !r.isUndefined(e) && r.isUndefined(e["Content-Type"]) && (e["Content-Type"] = t);
                        }
                        var a = {
                            adapter: (function () {
                                var e;
                                return ("undefined" != typeof XMLHttpRequest || void 0 !== t) && (e = n(3)), e;
                            })(),
                            transformRequest: [
                                function (e, t) {
                                    return (
                                        o(t, "Content-Type"),
                                        r.isFormData(e) || r.isArrayBuffer(e) || r.isBuffer(e) || r.isStream(e) || r.isFile(e) || r.isBlob(e)
                                            ? e
                                            : r.isArrayBufferView(e)
                                            ? e.buffer
                                            : r.isURLSearchParams(e)
                                            ? (s(t, "application/x-www-form-urlencoded;charset=utf-8"), e.toString())
                                            : r.isObject(e)
                                            ? (s(t, "application/json;charset=utf-8"), JSON.stringify(e))
                                            : e
                                    );
                                },
                            ],
                            transformResponse: [
                                function (e) {
                                    if ("string" == typeof e)
                                        try {
                                            e = JSON.parse(e);
                                        } catch (e) {}
                                    return e;
                                },
                            ],
                            timeout: 0,
                            xsrfCookieName: "XSRF-TOKEN",
                            xsrfHeaderName: "X-XSRF-TOKEN",
                            maxContentLength: -1,
                            validateStatus: function (e) {
                                return e >= 200 && e < 300;
                            },
                            headers: { common: { Accept: "application/json, text/plain, */*" } },
                        };
                        r.forEach(["delete", "get", "head"], function (e) {
                            a.headers[e] = {};
                        }),
                            r.forEach(["post", "put", "patch"], function (e) {
                                a.headers[e] = r.merge(i);
                            }),
                            (e.exports = a);
                    }.call(this, n(12)));
                },
                function (e, t, n) {
                    e.exports = function (e, t) {
                        return function () {
                            for (var n = new Array(arguments.length), r = 0; r < n.length; r++) n[r] = arguments[r];
                            return e.apply(t, n);
                        };
                    };
                },
                function (e, t, n) {
                    var r = n(0),
                        o = n(14),
                        i = n(16),
                        s = n(17),
                        a = n(18),
                        l = n(4),
                        c = ("undefined" != typeof window && window.btoa && window.btoa.bind(window)) || n(19);
                    e.exports = function (e) {
                        return new Promise(function (t, u) {
                            var d = e.data,
                                p = e.headers;
                            r.isFormData(d) && delete p["Content-Type"];
                            var f = new XMLHttpRequest(),
                                h = "onreadystatechange",
                                m = !1;
                            if (
                                ("undefined" == typeof window ||
                                    !window.XDomainRequest ||
                                    "withCredentials" in f ||
                                    a(e.url) ||
                                    ((f = new window.XDomainRequest()), (h = "onload"), (m = !0), (f.onprogress = function () {}), (f.ontimeout = function () {})),
                                e.auth)
                            ) {
                                var g = e.auth.username || "",
                                    b = e.auth.password || "";
                                p.Authorization = "Basic " + c(g + ":" + b);
                            }
                            if (
                                (f.open(e.method.toUpperCase(), i(e.url, e.params, e.paramsSerializer), !0),
                                (f.timeout = e.timeout),
                                (f[h] = function () {
                                    if (f && (4 === f.readyState || m) && (0 !== f.status || (f.responseURL && 0 === f.responseURL.indexOf("file:")))) {
                                        var n = "getAllResponseHeaders" in f ? s(f.getAllResponseHeaders()) : null,
                                            r = {
                                                data: e.responseType && "text" !== e.responseType ? f.response : f.responseText,
                                                status: 1223 === f.status ? 204 : f.status,
                                                statusText: 1223 === f.status ? "No Content" : f.statusText,
                                                headers: n,
                                                config: e,
                                                request: f,
                                            };
                                        o(t, u, r), (f = null);
                                    }
                                }),
                                (f.onerror = function () {
                                    u(l("Network Error", e, null, f)), (f = null);
                                }),
                                (f.ontimeout = function () {
                                    u(l("timeout of " + e.timeout + "ms exceeded", e, "ECONNABORTED", f)), (f = null);
                                }),
                                r.isStandardBrowserEnv())
                            ) {
                                var y = n(20),
                                    v = (e.withCredentials || a(e.url)) && e.xsrfCookieName ? y.read(e.xsrfCookieName) : void 0;
                                v && (p[e.xsrfHeaderName] = v);
                            }
                            if (
                                ("setRequestHeader" in f &&
                                    r.forEach(p, function (e, t) {
                                        void 0 === d && "content-type" === t.toLowerCase() ? delete p[t] : f.setRequestHeader(t, e);
                                    }),
                                e.withCredentials && (f.withCredentials = !0),
                                e.responseType)
                            )
                                try {
                                    f.responseType = e.responseType;
                                } catch (t) {
                                    if ("json" !== e.responseType) throw t;
                                }
                            "function" == typeof e.onDownloadProgress && f.addEventListener("progress", e.onDownloadProgress),
                                "function" == typeof e.onUploadProgress && f.upload && f.upload.addEventListener("progress", e.onUploadProgress),
                                e.cancelToken &&
                                    e.cancelToken.promise.then(function (e) {
                                        f && (f.abort(), u(e), (f = null));
                                    }),
                                void 0 === d && (d = null),
                                f.send(d);
                        });
                    };
                },
                function (e, t, n) {
                    var r = n(15);
                    e.exports = function (e, t, n, o, i) {
                        var s = new Error(e);
                        return r(s, t, n, o, i);
                    };
                },
                function (e, t, n) {
                    e.exports = function (e) {
                        return !(!e || !e.__CANCEL__);
                    };
                },
                function (e, t, n) {
                    function r(e) {
                        this.message = e;
                    }
                    (r.prototype.toString = function () {
                        return "Cancel" + (this.message ? ": " + this.message : "");
                    }),
                        (r.prototype.__CANCEL__ = !0),
                        (e.exports = r);
                },
                function (e, t, n) {
                    (t.__esModule = !0), (t.I18N = void 0);
                    var r =
                            "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
                                ? function (e) {
                                      return typeof e;
                                  }
                                : function (e) {
                                      return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e;
                                  },
                        o = (function () {
                            function e(e, t) {
                                for (var n = 0; n < t.length; n++) {
                                    var r = t[n];
                                    (r.enumerable = r.enumerable || !1), (r.configurable = !0), "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r);
                                }
                            }
                            return function (t, n, r) {
                                return n && e(t.prototype, n), r && e(t, r), t;
                            };
                        })(),
                        i = n(8),
                        s = { extension: ".lang", location: "assets/lang/", langs: ["en-US"], locale: "en-US", override: {} },
                        a = (t.I18N = (function () {
                            function e() {
                                var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : s;
                                !(function (e, t) {
                                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function");
                                })(this, e),
                                    (this.langs = Object.create(null)),
                                    (this.loaded = []),
                                    this.processConfig(t);
                            }
                            return (
                                (e.prototype.processConfig = function (e) {
                                    var t = this,
                                        n = Object.assign({}, s, e),
                                        r = n.location,
                                        o = (function (e, t) {
                                            var n = {};
                                            for (var r in e) t.indexOf(r) >= 0 || (Object.prototype.hasOwnProperty.call(e, r) && (n[r] = e[r]));
                                            return n;
                                        })(n, ["location"]),
                                        i = r.replace(/\/?$/, "/");
                                    this.config = Object.assign({}, { location: i }, o);
                                    var a = this.config,
                                        l = a.override,
                                        c = a.preloaded,
                                        u = void 0 === c ? {} : c,
                                        d = Object.entries(this.langs).concat(Object.entries(l || u));
                                    (this.langs = d.reduce(function (e, n) {
                                        var r = n[0],
                                            o = n[1];
                                        return (e[r] = t.applyLanguage.call(t, r, o)), e;
                                    }, {})),
                                        (this.locale = this.config.locale || this.config.langs[0]);
                                }),
                                (e.prototype.init = function (e) {
                                    return this.processConfig.call(this, Object.assign({}, this.config, e)), this.setCurrent(this.locale);
                                }),
                                (e.prototype.addLanguage = function (e) {
                                    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
                                    (t = "string" == typeof t ? this.processFile.call(this, t) : t), this.applyLanguage.call(this, e, t), this.config.langs.push("locale");
                                }),
                                (e.prototype.getValue = function (e) {
                                    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : this.locale;
                                    return (this.langs[t] && this.langs[t][e]) || this.getFallbackValue(e);
                                }),
                                (e.prototype.getFallbackValue = function (e) {
                                    var t = Object.values(this.langs).find(function (t) {
                                        return t[e];
                                    });
                                    return t && t[e];
                                }),
                                (e.prototype.makeSafe = function (e) {
                                    var t = { "{": "\\{", "}": "\\}", "|": "\\|" };
                                    return (
                                        (e = e.replace(/\{|\}|\|/g, function (e) {
                                            return t[e];
                                        })),
                                        new RegExp(e, "g")
                                    );
                                }),
                                (e.prototype.put = function (e, t) {
                                    return (this.current[e] = t);
                                }),
                                (e.prototype.get = function (e, t) {
                                    var n = this.getValue(e);
                                    if (n) {
                                        var o = n.match(/\{[^}]+?\}/g),
                                            i = void 0;
                                        if (t && o)
                                            if ("object" === (void 0 === t ? "undefined" : r(t))) for (var s = 0; s < o.length; s++) (i = o[s].substring(1, o[s].length - 1)), (n = n.replace(this.makeSafe(o[s]), t[i] || ""));
                                            else n = n.replace(/\{[^}]+?\}/g, t);
                                        return n;
                                    }
                                }),
                                (e.prototype.fromFile = function (e) {
                                    for (var t, n = e.split("\n"), r = {}, o = 0; o < n.length; o++) (t = n[o].match(/^(.+?) *?= *?([^\n]+)/)) && (r[t[1]] = t[2].replace(/^\s+|\s+$/, ""));
                                    return r;
                                }),
                                (e.prototype.processFile = function (e) {
                                    return this.fromFile(e.replace(/\n\n/g, "\n"));
                                }),
                                (e.prototype.loadLang = function (e) {
                                    var t = !(arguments.length > 1 && void 0 !== arguments[1]) || arguments[1],
                                        n = this;
                                    return new Promise(function (r, o) {
                                        if (-1 !== n.loaded.indexOf(e) && t) return n.applyLanguage.call(n, n.langs[e]), r(n.langs[e]);
                                        var s = [n.config.location, e, n.config.extension].join("");
                                        return (0, i.get)(s)
                                            .then(function (t) {
                                                var o = t.data,
                                                    i = n.processFile(o);
                                                return n.applyLanguage.call(n, e, i), n.loaded.push(e), r(n.langs[e]);
                                            })
                                            .catch(function () {
                                                var t = n.applyLanguage.call(n, e);
                                                r(t);
                                            });
                                    });
                                }),
                                (e.prototype.applyLanguage = function (e) {
                                    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                                        n = this.config.override[e] || {},
                                        r = this.langs[e] || {};
                                    return (this.langs[e] = Object.assign({}, r, t, n)), this.langs[e];
                                }),
                                (e.prototype.setCurrent = function () {
                                    var e = this,
                                        t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "en-US";
                                    return this.loadLang(t).then(function () {
                                        return (e.locale = t), (e.current = e.langs[t]), e.current;
                                    });
                                }),
                                o(e, [
                                    {
                                        key: "getLangs",
                                        get: function () {
                                            return this.config.langs;
                                        },
                                    },
                                ]),
                                e
                            );
                        })());
                    t.default = new a();
                },
                function (e, t, n) {
                    e.exports = n(9);
                },
                function (e, t, n) {
                    var r = n(0),
                        o = n(2),
                        i = n(11),
                        s = n(1);
                    function a(e) {
                        var t = new i(e),
                            n = o(i.prototype.request, t);
                        return r.extend(n, i.prototype, t), r.extend(n, t), n;
                    }
                    var l = a(s);
                    (l.Axios = i),
                        (l.create = function (e) {
                            return a(r.merge(s, e));
                        }),
                        (l.Cancel = n(6)),
                        (l.CancelToken = n(26)),
                        (l.isCancel = n(5)),
                        (l.all = function (e) {
                            return Promise.all(e);
                        }),
                        (l.spread = n(27)),
                        (e.exports = l),
                        (e.exports.default = l);
                },
                function (e, t, n) {
                    /*!
                     * Determine if an object is a Buffer
                     *
                     * @author   Feross Aboukhadijeh <https://feross.org>
                     * @license  MIT
                     */
                    function r(e) {
                        return !!e.constructor && "function" == typeof e.constructor.isBuffer && e.constructor.isBuffer(e);
                    }
                    e.exports = function (e) {
                        return (
                            null != e &&
                            (r(e) ||
                                (function (e) {
                                    return "function" == typeof e.readFloatLE && "function" == typeof e.slice && r(e.slice(0, 0));
                                })(e) ||
                                !!e._isBuffer)
                        );
                    };
                },
                function (e, t, n) {
                    var r = n(1),
                        o = n(0),
                        i = n(21),
                        s = n(22);
                    function a(e) {
                        (this.defaults = e), (this.interceptors = { request: new i(), response: new i() });
                    }
                    (a.prototype.request = function (e) {
                        "string" == typeof e && (e = o.merge({ url: arguments[0] }, arguments[1])), ((e = o.merge(r, { method: "get" }, this.defaults, e)).method = e.method.toLowerCase());
                        var t = [s, void 0],
                            n = Promise.resolve(e);
                        for (
                            this.interceptors.request.forEach(function (e) {
                                t.unshift(e.fulfilled, e.rejected);
                            }),
                                this.interceptors.response.forEach(function (e) {
                                    t.push(e.fulfilled, e.rejected);
                                });
                            t.length;

                        )
                            n = n.then(t.shift(), t.shift());
                        return n;
                    }),
                        o.forEach(["delete", "get", "head", "options"], function (e) {
                            a.prototype[e] = function (t, n) {
                                return this.request(o.merge(n || {}, { method: e, url: t }));
                            };
                        }),
                        o.forEach(["post", "put", "patch"], function (e) {
                            a.prototype[e] = function (t, n, r) {
                                return this.request(o.merge(r || {}, { method: e, url: t, data: n }));
                            };
                        }),
                        (e.exports = a);
                },
                function (e, t, n) {
                    var r,
                        o,
                        i = (e.exports = {});
                    function s() {
                        throw new Error("setTimeout has not been defined");
                    }
                    function a() {
                        throw new Error("clearTimeout has not been defined");
                    }
                    function l(e) {
                        if (r === setTimeout) return setTimeout(e, 0);
                        if ((r === s || !r) && setTimeout) return (r = setTimeout), setTimeout(e, 0);
                        try {
                            return r(e, 0);
                        } catch (t) {
                            try {
                                return r.call(null, e, 0);
                            } catch (t) {
                                return r.call(this, e, 0);
                            }
                        }
                    }
                    !(function () {
                        try {
                            r = "function" == typeof setTimeout ? setTimeout : s;
                        } catch (e) {
                            r = s;
                        }
                        try {
                            o = "function" == typeof clearTimeout ? clearTimeout : a;
                        } catch (e) {
                            o = a;
                        }
                    })();
                    var c,
                        u = [],
                        d = !1,
                        p = -1;
                    function f() {
                        d && c && ((d = !1), c.length ? (u = c.concat(u)) : (p = -1), u.length && h());
                    }
                    function h() {
                        if (!d) {
                            var e = l(f);
                            d = !0;
                            for (var t = u.length; t; ) {
                                for (c = u, u = []; ++p < t; ) c && c[p].run();
                                (p = -1), (t = u.length);
                            }
                            (c = null),
                                (d = !1),
                                (function (e) {
                                    if (o === clearTimeout) return clearTimeout(e);
                                    if ((o === a || !o) && clearTimeout) return (o = clearTimeout), clearTimeout(e);
                                    try {
                                        o(e);
                                    } catch (t) {
                                        try {
                                            return o.call(null, e);
                                        } catch (t) {
                                            return o.call(this, e);
                                        }
                                    }
                                })(e);
                        }
                    }
                    function m(e, t) {
                        (this.fun = e), (this.array = t);
                    }
                    function g() {}
                    (i.nextTick = function (e) {
                        var t = new Array(arguments.length - 1);
                        if (arguments.length > 1) for (var n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
                        u.push(new m(e, t)), 1 !== u.length || d || l(h);
                    }),
                        (m.prototype.run = function () {
                            this.fun.apply(null, this.array);
                        }),
                        (i.title = "browser"),
                        (i.browser = !0),
                        (i.env = {}),
                        (i.argv = []),
                        (i.version = ""),
                        (i.versions = {}),
                        (i.on = g),
                        (i.addListener = g),
                        (i.once = g),
                        (i.off = g),
                        (i.removeListener = g),
                        (i.removeAllListeners = g),
                        (i.emit = g),
                        (i.prependListener = g),
                        (i.prependOnceListener = g),
                        (i.listeners = function (e) {
                            return [];
                        }),
                        (i.binding = function (e) {
                            throw new Error("process.binding is not supported");
                        }),
                        (i.cwd = function () {
                            return "/";
                        }),
                        (i.chdir = function (e) {
                            throw new Error("process.chdir is not supported");
                        }),
                        (i.umask = function () {
                            return 0;
                        });
                },
                function (e, t, n) {
                    var r = n(0);
                    e.exports = function (e, t) {
                        r.forEach(e, function (n, r) {
                            r !== t && r.toUpperCase() === t.toUpperCase() && ((e[t] = n), delete e[r]);
                        });
                    };
                },
                function (e, t, n) {
                    var r = n(4);
                    e.exports = function (e, t, n) {
                        var o = n.config.validateStatus;
                        n.status && o && !o(n.status) ? t(r("Request failed with status code " + n.status, n.config, null, n.request, n)) : e(n);
                    };
                },
                function (e, t, n) {
                    e.exports = function (e, t, n, r, o) {
                        return (e.config = t), n && (e.code = n), (e.request = r), (e.response = o), e;
                    };
                },
                function (e, t, n) {
                    var r = n(0);
                    function o(e) {
                        return encodeURIComponent(e).replace(/%40/gi, "@").replace(/%3A/gi, ":").replace(/%24/g, "$").replace(/%2C/gi, ",").replace(/%20/g, "+").replace(/%5B/gi, "[").replace(/%5D/gi, "]");
                    }
                    e.exports = function (e, t, n) {
                        if (!t) return e;
                        var i;
                        if (n) i = n(t);
                        else if (r.isURLSearchParams(t)) i = t.toString();
                        else {
                            var s = [];
                            r.forEach(t, function (e, t) {
                                null != e &&
                                    (r.isArray(e) ? (t += "[]") : (e = [e]),
                                    r.forEach(e, function (e) {
                                        r.isDate(e) ? (e = e.toISOString()) : r.isObject(e) && (e = JSON.stringify(e)), s.push(o(t) + "=" + o(e));
                                    }));
                            }),
                                (i = s.join("&"));
                        }
                        return i && (e += (-1 === e.indexOf("?") ? "?" : "&") + i), e;
                    };
                },
                function (e, t, n) {
                    var r = n(0),
                        o = [
                            "age",
                            "authorization",
                            "content-length",
                            "content-type",
                            "etag",
                            "expires",
                            "from",
                            "host",
                            "if-modified-since",
                            "if-unmodified-since",
                            "last-modified",
                            "location",
                            "max-forwards",
                            "proxy-authorization",
                            "referer",
                            "retry-after",
                            "user-agent",
                        ];
                    e.exports = function (e) {
                        var t,
                            n,
                            i,
                            s = {};
                        return e
                            ? (r.forEach(e.split("\n"), function (e) {
                                  if (((i = e.indexOf(":")), (t = r.trim(e.substr(0, i)).toLowerCase()), (n = r.trim(e.substr(i + 1))), t)) {
                                      if (s[t] && o.indexOf(t) >= 0) return;
                                      s[t] = "set-cookie" === t ? (s[t] ? s[t] : []).concat([n]) : s[t] ? s[t] + ", " + n : n;
                                  }
                              }),
                              s)
                            : s;
                    };
                },
                function (e, t, n) {
                    var r = n(0);
                    e.exports = r.isStandardBrowserEnv()
                        ? (function () {
                              var e,
                                  t = /(msie|trident)/i.test(navigator.userAgent),
                                  n = document.createElement("a");
                              function o(e) {
                                  var r = e;
                                  return (
                                      t && (n.setAttribute("href", r), (r = n.href)),
                                      n.setAttribute("href", r),
                                      {
                                          href: n.href,
                                          protocol: n.protocol ? n.protocol.replace(/:$/, "") : "",
                                          host: n.host,
                                          search: n.search ? n.search.replace(/^\?/, "") : "",
                                          hash: n.hash ? n.hash.replace(/^#/, "") : "",
                                          hostname: n.hostname,
                                          port: n.port,
                                          pathname: "/" === n.pathname.charAt(0) ? n.pathname : "/" + n.pathname,
                                      }
                                  );
                              }
                              return (
                                  (e = o(window.location.href)),
                                  function (t) {
                                      var n = r.isString(t) ? o(t) : t;
                                      return n.protocol === e.protocol && n.host === e.host;
                                  }
                              );
                          })()
                        : function () {
                              return !0;
                          };
                },
                function (e, t, n) {
                    function r() {
                        this.message = "String contains an invalid character";
                    }
                    (r.prototype = new Error()),
                        (r.prototype.code = 5),
                        (r.prototype.name = "InvalidCharacterError"),
                        (e.exports = function (e) {
                            for (var t, n, o = String(e), i = "", s = 0, a = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/="; o.charAt(0 | s) || ((a = "="), s % 1); i += a.charAt(63 & (t >> (8 - (s % 1) * 8)))) {
                                if ((n = o.charCodeAt((s += 0.75))) > 255) throw new r();
                                t = (t << 8) | n;
                            }
                            return i;
                        });
                },
                function (e, t, n) {
                    var r = n(0);
                    e.exports = r.isStandardBrowserEnv()
                        ? {
                              write: function (e, t, n, o, i, s) {
                                  var a = [];
                                  a.push(e + "=" + encodeURIComponent(t)),
                                      r.isNumber(n) && a.push("expires=" + new Date(n).toGMTString()),
                                      r.isString(o) && a.push("path=" + o),
                                      r.isString(i) && a.push("domain=" + i),
                                      !0 === s && a.push("secure"),
                                      (document.cookie = a.join("; "));
                              },
                              read: function (e) {
                                  var t = document.cookie.match(new RegExp("(^|;\\s*)(" + e + ")=([^;]*)"));
                                  return t ? decodeURIComponent(t[3]) : null;
                              },
                              remove: function (e) {
                                  this.write(e, "", Date.now() - 864e5);
                              },
                          }
                        : {
                              write: function () {},
                              read: function () {
                                  return null;
                              },
                              remove: function () {},
                          };
                },
                function (e, t, n) {
                    var r = n(0);
                    function o() {
                        this.handlers = [];
                    }
                    (o.prototype.use = function (e, t) {
                        return this.handlers.push({ fulfilled: e, rejected: t }), this.handlers.length - 1;
                    }),
                        (o.prototype.eject = function (e) {
                            this.handlers[e] && (this.handlers[e] = null);
                        }),
                        (o.prototype.forEach = function (e) {
                            r.forEach(this.handlers, function (t) {
                                null !== t && e(t);
                            });
                        }),
                        (e.exports = o);
                },
                function (e, t, n) {
                    var r = n(0),
                        o = n(23),
                        i = n(5),
                        s = n(1),
                        a = n(24),
                        l = n(25);
                    function c(e) {
                        e.cancelToken && e.cancelToken.throwIfRequested();
                    }
                    e.exports = function (e) {
                        return (
                            c(e),
                            e.baseURL && !a(e.url) && (e.url = l(e.baseURL, e.url)),
                            (e.headers = e.headers || {}),
                            (e.data = o(e.data, e.headers, e.transformRequest)),
                            (e.headers = r.merge(e.headers.common || {}, e.headers[e.method] || {}, e.headers || {})),
                            r.forEach(["delete", "get", "head", "post", "put", "patch", "common"], function (t) {
                                delete e.headers[t];
                            }),
                            (e.adapter || s.adapter)(e).then(
                                function (t) {
                                    return c(e), (t.data = o(t.data, t.headers, e.transformResponse)), t;
                                },
                                function (t) {
                                    return i(t) || (c(e), t && t.response && (t.response.data = o(t.response.data, t.response.headers, e.transformResponse))), Promise.reject(t);
                                }
                            )
                        );
                    };
                },
                function (e, t, n) {
                    var r = n(0);
                    e.exports = function (e, t, n) {
                        return (
                            r.forEach(n, function (n) {
                                e = n(e, t);
                            }),
                            e
                        );
                    };
                },
                function (e, t, n) {
                    e.exports = function (e) {
                        return /^([a-z][a-z\d\+\-\.]*:)?\/\//i.test(e);
                    };
                },
                function (e, t, n) {
                    e.exports = function (e, t) {
                        return t ? e.replace(/\/+$/, "") + "/" + t.replace(/^\/+/, "") : e;
                    };
                },
                function (e, t, n) {
                    var r = n(6);
                    function o(e) {
                        if ("function" != typeof e) throw new TypeError("executor must be a function.");
                        var t;
                        this.promise = new Promise(function (e) {
                            t = e;
                        });
                        var n = this;
                        e(function (e) {
                            n.reason || ((n.reason = new r(e)), t(n.reason));
                        });
                    }
                    (o.prototype.throwIfRequested = function () {
                        if (this.reason) throw this.reason;
                    }),
                        (o.source = function () {
                            var e;
                            return {
                                token: new o(function (t) {
                                    e = t;
                                }),
                                cancel: e,
                            };
                        }),
                        (e.exports = o);
                },
                function (e, t, n) {
                    e.exports = function (e) {
                        return function (t) {
                            return e.apply(null, t);
                        };
                    };
                },
            ]);
        },
        function (e, t, n) {
            n.d(t, "c", function () {
                return i;
            }),
                n.d(t, "d", function () {
                    return s;
                }),
                n.d(t, "b", function () {
                    return a;
                }),
                n.d(t, "a", function () {
                    return l;
                });
            var r = n(2);
            const o = () => null;
            n.n(r).a.addLanguage("en-US", {
                NATIVE_NAME: "English (US)",
                ENGLISH_NAME: "English",
                addOption: "Add Option +",
                allFieldsRemoved: "All fields were removed.",
                allowMultipleFiles: "Allow users to upload multiple files",
                autocomplete: "Autocomplete",
                button: "Button",
                cannotBeEmpty: "This field cannot be empty",
                checkboxGroup: "Checkbox Group",
                checkbox: "Checkbox",
                checkboxes: "Checkboxes",
                className: "Class",
                clearAllMessage: "Are you sure you want to clear all fields?",
                clear: "Clear",
                close: "Close",
                content: "Content",
                copy: "Copy To Clipboard",
                copyButton: "&#43;",
                copyButtonTooltip: "Copy",
                dateField: "Date Field",
                description: "Help Text",
                descriptionField: "Description",
                devMode: "Developer Mode",
                editNames: "Edit Names",
                editorTitle: "Form Elements",
                editXML: "Edit XML",
                enableOther: "Enable &quot;Other&quot;",
                enableOtherMsg: "Let users enter an unlisted option",
                fieldDeleteWarning: "false",
                fieldVars: "Field Variables",
                fieldNonEditable: "This field cannot be edited.",
                fieldRemoveWarning: "Are you sure you want to remove this field?",
                fileUpload: "File Upload",
                formUpdated: "Form Updated",
                getStarted: "Drag a field from the right to this area",
                header: "Header",
                hide: "Edit",
                hidden: "Hidden Input",
                inline: "Inline",
                inlineDesc: "Display {type} inline",
                label: "Label",
                labelEmpty: "Field Label cannot be empty",
                limitRole: "Limit access to one or more of the following roles:",
                mandatory: "Mandatory",
                maxlength: "Max Length",
                minOptionMessage: "This field requires a minimum of 2 options",
                minSelectionRequired: "Minimum {min} selections required",
                multipleFiles: "Multiple Files",
                name: "Name",
                no: "No",
                noFieldsToClear: "There are no fields to clear",
                number: "Number",
                off: "Off",
                on: "On",
                option: "Option",
                optionCount: "Option {count}",
                options: "Options",
                optional: "optional",
                optionLabelPlaceholder: "Label",
                optionValuePlaceholder: "Value",
                optionEmpty: "Option value required",
                other: "Other",
                paragraph: "Paragraph",
                placeholder: "Placeholder",
                "placeholders.value": "Value",
                "placeholders.label": "Label",
                "placeholders.email": "Enter your email",
                "placeholders.className": "space separated classes",
                "placeholders.password": "Enter your password",
                preview: "Preview",
                radioGroup: "Radio Group",
                radio: "Radio",
                removeMessage: "Remove Element",
                removeOption: "Remove Option",
                remove: "&#215;",
                required: "Required",
                requireValidOption: "Only accept a pre-defined Option",
                richText: "Rich Text Editor",
                roles: "Access",
                rows: "Rows",
                save: "Save",
                selectOptions: "Options",
                select: "Select",
                selectColor: "Select Color",
                selectionsMessage: "Allow Multiple Selections",
                size: "Size",
                "size.xs": "Extra Small",
                "size.sm": "Small",
                "size.m": "Default",
                "size.lg": "Large",
                style: "Style",
                "styles.btn.default": "Default",
                "styles.btn.danger": "Danger",
                "styles.btn.info": "Info",
                "styles.btn.primary": "Primary",
                "styles.btn.success": "Success",
                "styles.btn.warning": "Warning",
                subtype: "Type",
                text: "Text Field",
                textArea: "Text Area",
                toggle: "Toggle",
                warning: "Warning!",
                value: "Value",
                viewJSON: "[{&hellip;}]",
                viewXML: "&lt;/&gt;",
                yes: "Yes",
            });
            const i = {
                    actionButtons: [],
                    allowStageSort: !0,
                    append: !1,
                    controlOrder: ["autocomplete", "button", "checkbox-group", "checkbox", "date", "file", "header", "hidden", "number", "paragraph", "radio-group", "select", "text", "textarea"],
                    controlPosition: "right",
                    dataType: "json",
                    defaultFields: [],
                    disabledActionButtons: [],
                    disabledAttrs: [],
                    disabledFieldButtons: {},
                    disabledSubtypes: {},
                    disableFields: [],
                    disableHTMLLabels: !1,
                    disableInjectedStyle: !1,
                    editOnAdd: !1,
                    fields: [],
                    fieldRemoveWarn: !1,
                    fieldEditContainer: null,
                    inputSets: [],
                    notify: {
                        error: (e) => {
                            console.log(e);
                        },
                        success: (e) => {
                            console.log(e);
                        },
                        warning: (e) => {
                            console.warn(e);
                        },
                    },
                    onAddField: (e, t) => t,
                    onAddFieldAfter: (e, t) => t,
                    onAddOption: (e) => e,
                    onClearAll: o,
                    onCloseFieldEdit: o,
                    onOpenFieldEdit: o,
                    onSave: o,
                    persistDefaultFields: !1,
                    prepend: !1,
                    replaceFields: [],
                    roles: { 1: "Administrator" },
                    scrollToFieldOnAdd: !0,
                    showActionButtons: !0,
                    sortableControls: !1,
                    stickyControls: { enable: !0, offset: { top: 5, bottom: "auto", right: "auto" } },
                    subtypes: {},
                    templates: {},
                    typeUserAttrs: {},
                    typeUserDisabledAttrs: {},
                    typeUserEvents: {},
                },
                s = { btn: ["default", "danger", "info", "primary", "success", "warning"] },
                a = { location: "assets/lang/" },
                l = {};
        },
        function (e, t, n) {
            n.d(t, "d", function () {
                return r;
            }),
                n.d(t, "f", function () {
                    return i;
                }),
                n.d(t, "b", function () {
                    return s;
                }),
                n.d(t, "c", function () {
                    return a;
                }),
                n.d(t, "e", function () {
                    return l;
                }),
                n.d(t, "a", function () {
                    return u;
                });
            const r = {},
                o = { text: ["text", "password", "email", "color", "tel"], header: ["h1", "h2", "h3"], button: ["button", "submit", "reset"], paragraph: ["p", "address", "blockquote", "canvas", "output"], textarea: ["textarea", "quill"] },
                i = (e) => {
                    e.parentNode && e.parentNode.removeChild(e);
                },
                s = (e) => {
                    for (; e.firstChild; ) e.removeChild(e.firstChild);
                    return e;
                },
                a = (e, t, n = !0) => {
                    const r = [];
                    let o = ["none", "block"];
                    n && (o = o.reverse());
                    for (let n = e.length - 1; n >= 0; n--) {
                        -1 !== e[n].textContent.toLowerCase().indexOf(t.toLowerCase()) ? ((e[n].style.display = o[0]), r.push(e[n])) : (e[n].style.display = o[1]);
                    }
                    return r;
                },
                l = ["select", "checkbox-group", "checkbox", "radio-group", "autocomplete"],
                c = new RegExp(`(${l.join("|")})`);
            class u {
                constructor(e) {
                    return (this.optionFields = l), (this.optionFieldsRegEx = c), (this.subtypes = o), (this.empty = s), (this.filter = a), (r[e] = this), r[e];
                }
                onRender(e, t) {
                    e.parentElement ? t(e) : window.requestAnimationFrame(() => this.onRender(e, t));
                }
            }
        },
        function (e, t, n) {
            function r(e) {
                let t;
                return "function" == typeof Event ? (t = new Event(e)) : ((t = document.createEvent("Event")), t.initEvent(e, !0, !0)), t;
            }
            const o = {
                loaded: r("loaded"),
                viewData: r("viewData"),
                userDeclined: r("userDeclined"),
                modalClosed: r("modalClosed"),
                modalOpened: r("modalOpened"),
                formSaved: r("formSaved"),
                fieldAdded: r("fieldAdded"),
                fieldRemoved: r("fieldRemoved"),
                fieldRendered: r("fieldRendered"),
                fieldEditOpened: r("fieldEditOpened"),
                fieldEditClosed: r("fieldEditClosed"),
            };
            t.a = o;
        },
        function (e, t, n) {
            n.d(t, "a", function () {
                return s;
            });
            var r = n(1),
                o = n(2),
                i = n.n(o);
            class s extends r.a {
                static register(e = {}, t = []) {
                    (s.customRegister = {}), s.def || (s.def = { icon: {}, i18n: {} }), (s.templates = e);
                    const n = i.a.locale;
                    s.def.i18n[n] || (s.def.i18n[n] = {}), r.a.register(Object.keys(e), s);
                    for (const o of t) {
                        let t = o.type;
                        if (((o.attrs = o.attrs || {}), !t)) {
                            if (!o.attrs.type) {
                                this.error("Ignoring invalid custom field definition. Please specify a type property.");
                                continue;
                            }
                            t = o.attrs.type;
                        }
                        let i = o.subtype || t;
                        if (!e[t]) {
                            const e = r.a.getClass(t, o.subtype);
                            if (!e) {
                                this.error("Error while registering custom field: " + t + (o.subtype ? ":" + o.subtype : "") + ". Unable to find any existing defined control or template for rendering.");
                                continue;
                            }
                            (i = o.datatype ? o.datatype : `${t}-${Math.floor(9e3 * Math.random() + 1e3)}`), (s.customRegister[i] = jQuery.extend(o, { type: t, class: e }));
                        }
                        (s.def.i18n[n][i] = o.label), (s.def.icon[i] = o.icon);
                    }
                }
                static getRegistered(e = !1) {
                    return e ? r.a.getRegistered(e) : Object.keys(s.customRegister);
                }
                static lookup(e) {
                    return s.customRegister[e];
                }
                static get definition() {
                    return s.def;
                }
                build() {
                    let e = s.templates[this.type];
                    if (!e) return this.error("Invalid custom control type. Please ensure you have registered it correctly as a template option.");
                    const t = Object.assign(this.config),
                        n = ["label", "description", "subtype", "id", "isPreview", "required", "title", "aria-required", "type"];
                    for (const e of n) t[e] = this.config[e] || this[e];
                    return (e = e.bind(this)), (e = e(t)), e.js && (this.js = e.js), e.css && (this.css = e.css), (this.onRender = e.onRender), { field: e.field, layout: e.layout };
                }
            }
            s.customRegister = {};
        },
        function (e, t, n) {
            e.exports = function (e) {
                var t = [];
                return (
                    (t.toString = function () {
                        return this.map(function (t) {
                            var n = (function (e, t) {
                                var n = e[1] || "",
                                    r = e[3];
                                if (!r) return n;
                                if (t && "function" == typeof btoa) {
                                    var o = ((s = r), (a = btoa(unescape(encodeURIComponent(JSON.stringify(s))))), (l = "sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(a)), "/*# ".concat(l, " */")),
                                        i = r.sources.map(function (e) {
                                            return "/*# sourceURL=".concat(r.sourceRoot || "").concat(e, " */");
                                        });
                                    return [n].concat(i).concat([o]).join("\n");
                                }
                                var s, a, l;
                                return [n].join("\n");
                            })(t, e);
                            return t[2] ? "@media ".concat(t[2], " {").concat(n, "}") : n;
                        }).join("");
                    }),
                    (t.i = function (e, n, r) {
                        "string" == typeof e && (e = [[null, e, ""]]);
                        var o = {};
                        if (r)
                            for (var i = 0; i < this.length; i++) {
                                var s = this[i][0];
                                null != s && (o[s] = !0);
                            }
                        for (var a = 0; a < e.length; a++) {
                            var l = [].concat(e[a]);
                            (r && o[l[0]]) || (n && (l[2] ? (l[2] = "".concat(n, " and ").concat(l[2])) : (l[2] = n)), t.push(l));
                        }
                    }),
                    t
                );
            };
        },
        ,
        function (e, t, n) {
            var r,
                o = function () {
                    return void 0 === r && (r = Boolean(window && document && document.all && !window.atob)), r;
                },
                i = (function () {
                    var e = {};
                    return function (t) {
                        if (void 0 === e[t]) {
                            var n = document.querySelector(t);
                            if (window.HTMLIFrameElement && n instanceof window.HTMLIFrameElement)
                                try {
                                    n = n.contentDocument.head;
                                } catch (e) {
                                    n = null;
                                }
                            e[t] = n;
                        }
                        return e[t];
                    };
                })(),
                s = [];
            function a(e) {
                for (var t = -1, n = 0; n < s.length; n++)
                    if (s[n].identifier === e) {
                        t = n;
                        break;
                    }
                return t;
            }
            function l(e, t) {
                for (var n = {}, r = [], o = 0; o < e.length; o++) {
                    var i = e[o],
                        l = t.base ? i[0] + t.base : i[0],
                        c = n[l] || 0,
                        u = "".concat(l, " ").concat(c);
                    n[l] = c + 1;
                    var d = a(u),
                        p = { css: i[1], media: i[2], sourceMap: i[3] };
                    -1 !== d ? (s[d].references++, s[d].updater(p)) : s.push({ identifier: u, updater: g(p, t), references: 1 }), r.push(u);
                }
                return r;
            }
            function c(e) {
                var t = document.createElement("style"),
                    r = e.attributes || {};
                if (void 0 === r.nonce) {
                    var o = n.nc;
                    o && (r.nonce = o);
                }
                if (
                    (Object.keys(r).forEach(function (e) {
                        t.setAttribute(e, r[e]);
                    }),
                    "function" == typeof e.insert)
                )
                    e.insert(t);
                else {
                    var s = i(e.insert || "head");
                    if (!s) throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
                    s.appendChild(t);
                }
                return t;
            }
            var u,
                d =
                    ((u = []),
                    function (e, t) {
                        return (u[e] = t), u.filter(Boolean).join("\n");
                    });
            function p(e, t, n, r) {
                var o = n ? "" : r.media ? "@media ".concat(r.media, " {").concat(r.css, "}") : r.css;
                if (e.styleSheet) e.styleSheet.cssText = d(t, o);
                else {
                    var i = document.createTextNode(o),
                        s = e.childNodes;
                    s[t] && e.removeChild(s[t]), s.length ? e.insertBefore(i, s[t]) : e.appendChild(i);
                }
            }
            function f(e, t, n) {
                var r = n.css,
                    o = n.media,
                    i = n.sourceMap;
                if (
                    (o ? e.setAttribute("media", o) : e.removeAttribute("media"), i && btoa && (r += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(i)))), " */")), e.styleSheet)
                )
                    e.styleSheet.cssText = r;
                else {
                    for (; e.firstChild; ) e.removeChild(e.firstChild);
                    e.appendChild(document.createTextNode(r));
                }
            }
            var h = null,
                m = 0;
            function g(e, t) {
                var n, r, o;
                if (t.singleton) {
                    var i = m++;
                    (n = h || (h = c(t))), (r = p.bind(null, n, i, !1)), (o = p.bind(null, n, i, !0));
                } else
                    (n = c(t)),
                        (r = f.bind(null, n, t)),
                        (o = function () {
                            !(function (e) {
                                if (null === e.parentNode) return !1;
                                e.parentNode.removeChild(e);
                            })(n);
                        });
                return (
                    r(e),
                    function (t) {
                        if (t) {
                            if (t.css === e.css && t.media === e.media && t.sourceMap === e.sourceMap) return;
                            r((e = t));
                        } else o();
                    }
                );
            }
            e.exports = function (e, t) {
                (t = t || {}).singleton || "boolean" == typeof t.singleton || (t.singleton = o());
                var n = l((e = e || []), t);
                return function (e) {
                    if (((e = e || []), "[object Array]" === Object.prototype.toString.call(e))) {
                        for (var r = 0; r < n.length; r++) {
                            var o = a(n[r]);
                            s[o].references--;
                        }
                        for (var i = l(e, t), c = 0; c < n.length; c++) {
                            var u = a(n[c]);
                            0 === s[u].references && (s[u].updater(), s.splice(u, 1));
                        }
                        n = i;
                    }
                };
            };
        },
        function (e, t, n) {
            n.d(t, "a", function () {
                return i;
            });
            var r = n(0);
            const o = (e, t) => {
                let n = e.id ? `formbuilder-${e.type} form-group field-${e.id}` : "";
                if (e.className) {
                    let r = e.className.split(" ");
                    (r = r.filter((e) => /^col-(xs|sm|md|lg)-([^\s]+)/.test(e) || e.startsWith("row-"))), r && r.length > 0 && (n += " " + r.join(" "));
                    for (let e = 0; e < r.length; e++) {
                        const n = r[e];
                        t.classList.remove(n);
                    }
                }
                return n;
            };
            class i {
                constructor(e, t) {
                    (this.preview = t),
                        (this.templates = {
                            label: null,
                            help: null,
                            default: (e, t, n, r) => (n && t.appendChild(n), this.markup("div", [t, e], { className: o(r, e) })),
                            noLabel: (e, t, n, r) => this.markup("div", e, { className: o(r, e) }),
                            hidden: (e) => e,
                        }),
                        e && (this.templates = jQuery.extend(this.templates, e)),
                        this.configure();
                }
                configure() {}
                build(e, t, n) {
                    this.preview && (t.name ? (t.name = t.name + "-preview") : (t.name = r.f.nameAttr(t) + "-preview")), (t.id = t.name), (this.data = jQuery.extend({}, t));
                    const o = new e(t, this.preview);
                    let i = o.build();
                    ("object" == typeof i && i.field) || (i = { field: i });
                    const s = this.label(),
                        a = this.help();
                    let l;
                    l = n && this.isTemplate(n) ? n : this.isTemplate(i.layout) ? i.layout : "default";
                    const c = this.processTemplate(l, i.field, s, a);
                    return o.on("prerender")(c), c.addEventListener("fieldRendered", o.on("render")), c;
                }
                label() {
                    const e = this.data.label || "",
                        t = [r.f.parsedHtml(e)];
                    return (
                        this.data.required && t.push(this.markup("span", "*", { className: "formbuilder-required" })),
                        this.isTemplate("label") ? this.processTemplate("label", t) : this.markup("label", t, { for: this.data.id, className: `formbuilder-${this.data.type}-label` })
                    );
                }
                help() {
                    return this.data.description ? (this.isTemplate("help") ? this.processTemplate("help", this.data.description) : this.markup("span", "?", { className: "tooltip-element", tooltip: this.data.description })) : null;
                }
                isTemplate(e) {
                    return "function" == typeof this.templates[e];
                }
                processTemplate(e, ...t) {
                    let n = this.templates[e](...t, this.data);
                    return n.jquery && (n = n[0]), n;
                }
                markup(e, t = "", n = {}) {
                    return r.f.markup(e, t, n);
                }
            }
        },
        ,
        function (t, n, r) {
            var o = r(1),
                i = r(4);
            function s(e, t) {
                if (null == e) return {};
                var n,
                    r,
                    o = (function (e, t) {
                        if (null == e) return {};
                        var n,
                            r,
                            o = {},
                            i = Object.keys(e);
                        for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (o[n] = e[n]);
                        return o;
                    })(e, t);
                if (Object.getOwnPropertySymbols) {
                    var i = Object.getOwnPropertySymbols(e);
                    for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]));
                }
                return o;
            }
            class a extends o.a {
                static get definition() {
                    return { mi18n: { requireValidOption: "requireValidOption" } };
                }
                build() {
                    const e = this.config,
                        { values: t, type: n } = e,
                        r = s(e, ["values", "type"]),
                        o = (e) => {
                            const t = e.target.nextSibling.nextSibling,
                                n = e.target.nextSibling,
                                r = this.getActiveOption(t);
                            let o = new Map([
                                [
                                    38,
                                    () => {
                                        const e = this.getPreviousOption(r);
                                        e && this.selectOption(t, e);
                                    },
                                ],
                                [
                                    40,
                                    () => {
                                        const e = this.getNextOption(r);
                                        e && this.selectOption(t, e);
                                    },
                                ],
                                [
                                    13,
                                    () => {
                                        r
                                            ? ((e.target.value = r.innerHTML), (n.value = r.getAttribute("value")), "none" === t.style.display ? this.showList(t, r) : this.hideList(t))
                                            : this.config.requireValidOption && (this.isOptionValid(t, e.target.value) || ((e.target.value = ""), (e.target.nextSibling.value = ""))),
                                            e.preventDefault();
                                    },
                                ],
                                [
                                    27,
                                    () => {
                                        this.hideList(t);
                                    },
                                ],
                            ]).get(e.keyCode);
                            return o || (o = () => !1), o();
                        },
                        a = {
                            focus: (e) => {
                                const t = e.target.nextSibling.nextSibling,
                                    n = Object(i.c)(t.querySelectorAll("li"), e.target.value);
                                if ((e.target.addEventListener("keydown", o), e.target.value.length > 0)) {
                                    const e = n.length > 0 ? n[n.length - 1] : null;
                                    this.showList(t, e);
                                }
                            },
                            blur: (e) => {
                                e.target.removeEventListener("keydown", o);
                                const t = setTimeout(() => {
                                    (e.target.nextSibling.nextSibling.style.display = "none"), clearTimeout(t);
                                }, 200);
                                if (this.config.requireValidOption) {
                                    const t = e.target.nextSibling.nextSibling;
                                    this.isOptionValid(t, e.target.value) || ((e.target.value = ""), (e.target.nextSibling.value = ""));
                                }
                            },
                            input: (e) => {
                                const t = e.target.nextSibling.nextSibling;
                                e.target.nextSibling.value = e.target.value;
                                const n = Object(i.c)(t.querySelectorAll("li"), e.target.value);
                                if (0 == n.length) this.hideList(t);
                                else {
                                    let e = this.getActiveOption(t);
                                    e || (e = n[n.length - 1]), this.showList(t, e);
                                }
                            },
                        },
                        l = Object.assign({}, r, { id: r.id + "-input", autocomplete: "off", events: a }),
                        c = Object.assign({}, r, { type: "hidden" });
                    delete l.name;
                    const u = [this.markup("input", null, l), this.markup("input", null, c)],
                        d = t.map((e) => {
                            const t = e.label,
                                n = {
                                    events: {
                                        click: (t) => {
                                            const n = t.target.parentElement,
                                                r = n.previousSibling.previousSibling;
                                            (r.value = e.label), (r.nextSibling.value = e.value), this.hideList(n);
                                        },
                                    },
                                    value: e.value,
                                };
                            return this.markup("li", t, n);
                        });
                    return u.push(this.markup("ul", d, { id: r.id + "-list", className: `formbuilder-${n}-list` })), u;
                }
                hideList(e) {
                    this.selectOption(e, null), (e.style.display = "none");
                }
                showList(e, t) {
                    this.selectOption(e, t), (e.style.display = "block"), (e.style.width = e.parentElement.offsetWidth + "px");
                }
                getActiveOption(e) {
                    const t = e.getElementsByClassName("active-option")[0];
                    return t && "none" !== t.style.display ? t : null;
                }
                getPreviousOption(e) {
                    let t = e;
                    do {
                        t = t ? t.previousSibling : null;
                    } while (null != t && "none" === t.style.display);
                    return t;
                }
                getNextOption(e) {
                    let t = e;
                    do {
                        t = t ? t.nextSibling : null;
                    } while (null != t && "none" === t.style.display);
                    return t;
                }
                selectOption(e, t) {
                    const n = e.querySelectorAll("li");
                    for (let e = 0; e < n.length; e++) n[e].classList.remove("active-option");
                    t && t.classList.add("active-option");
                }
                isOptionValid(e, t) {
                    const n = e.querySelectorAll("li");
                    let r = !1;
                    for (let e = 0; e < n.length; e++)
                        if (n[e].innerHTML === t) {
                            r = !0;
                            break;
                        }
                    return r;
                }
                onRender(t) {
                    if (this.config.userData) {
                        const t = e("#" + this.config.name),
                            n = t.next(),
                            r = this.config.userData[0];
                        let o = null;
                        if (
                            (n.find("li").each(function () {
                                e(this).attr("value") !== r || (o = e(this).get(0));
                            }),
                            null === o)
                        )
                            return this.config.requireValidOption ? void 0 : void t.prev().val(this.config.userData[0]);
                        t.prev().val(o.innerHTML), t.val(o.getAttribute("value"));
                        const i = t.next().get(0);
                        "none" === i.style.display ? this.showList(i, o) : this.hideList(i);
                    }
                    return t;
                }
            }
            o.a.register("autocomplete", a);
            class l extends o.a {
                build() {
                    return { field: this.markup("button", this.label, this.config), layout: "noLabel" };
                }
            }
            o.a.register("button", l), o.a.register(["button", "submit", "reset"], l, "button");
            var c = r(6);
            class u extends o.a {
                build() {
                    return { field: this.markup("input", null, this.config), layout: "hidden" };
                }
                onRender() {
                    this.config.userData && e("#" + this.config.name).val(this.config.userData[0]);
                }
            }
            o.a.register("hidden", u);
            var d = r(0);
            function p(e, t) {
                if (null == e) return {};
                var n,
                    r,
                    o = (function (e, t) {
                        if (null == e) return {};
                        var n,
                            r,
                            o = {},
                            i = Object.keys(e);
                        for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (o[n] = e[n]);
                        return o;
                    })(e, t);
                if (Object.getOwnPropertySymbols) {
                    var i = Object.getOwnPropertySymbols(e);
                    for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]));
                }
                return o;
            }
            class f extends o.a {
                build() {
                    const e = this.config,
                        { type: t } = e,
                        n = p(e, ["type"]);
                    let r = t;
                    const o = { paragraph: "p", header: this.subtype };
                    return o[t] && (r = o[t]), { field: this.markup(r, d.f.parsedHtml(this.label), n), layout: "noLabel" };
                }
            }
            function h(e, t) {
                if (null == e) return {};
                var n,
                    r,
                    o = (function (e, t) {
                        if (null == e) return {};
                        var n,
                            r,
                            o = {},
                            i = Object.keys(e);
                        for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (o[n] = e[n]);
                        return o;
                    })(e, t);
                if (Object.getOwnPropertySymbols) {
                    var i = Object.getOwnPropertySymbols(e);
                    for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]));
                }
                return o;
            }
            o.a.register(["paragraph", "header"], f), o.a.register(["p", "address", "blockquote", "canvas", "output"], f, "paragraph"), o.a.register(["h1", "h2", "h3", "h4", "h5", "h6"], f, "header");
            class m extends o.a {
                static get definition() {
                    return { inactive: ["checkbox"], mi18n: { minSelectionRequired: "minSelectionRequired" } };
                }
                build() {
                    const e = [],
                        t = this.config,
                        { values: n, value: r, placeholder: o, type: i, inline: s, other: a, toggle: l } = t,
                        c = h(t, ["values", "value", "placeholder", "type", "inline", "other", "toggle"]),
                        u = i.replace("-group", ""),
                        p = "select" === i;
                    if (((c.multiple || "checkbox-group" === i) && (c.name = c.name + "[]"), "checkbox-group" === i && c.required && (this.onRender = this.groupRequired), delete c.title, n)) {
                        o && p && e.push(this.markup("option", o, { disabled: null, selected: null }));
                        for (let t = 0; t < n.length; t++) {
                            let i = n[t];
                            "string" == typeof i && (i = { label: i, value: i });
                            const { label: a = "" } = i,
                                d = h(i, ["label"]);
                            if (((d.id = `${c.id}-${t}`), (d.selected && !o) || delete d.selected, void 0 !== r && d.value === r && (d.selected = !0), p)) {
                                const t = this.markup("option", document.createTextNode(a), d);
                                e.push(t);
                            } else {
                                const t = [a];
                                let n = "formbuilder-" + u;
                                s && (n += "-inline"), (d.type = u), d.selected && ((d.checked = "checked"), delete d.selected);
                                const r = this.markup("input", null, Object.assign({}, c, d)),
                                    o = { for: d.id };
                                let i = [r, this.markup("label", t, o)];
                                l && ((o.className = "kc-toggle"), t.unshift(r, this.markup("span")), (i = this.markup("label", t, o)));
                                const p = this.markup("div", i, { className: n });
                                e.push(p);
                            }
                        }
                        if (!p && a) {
                            const t = { id: c.id + "-other", className: c.className + " other-option", value: "" };
                            let n = "formbuilder-" + u;
                            s && (n += "-inline");
                            const r = Object.assign({}, c, t);
                            r.type = u;
                            const o = {
                                    type: "text",
                                    events: {
                                        input: (e) => {
                                            const t = e.target,
                                                n = t.parentElement.previousElementSibling;
                                            (n.value = t.value), (n.name = c.id + "[]");
                                        },
                                    },
                                    id: t.id + "-value",
                                    className: "other-val",
                                },
                                i = this.markup("input", null, r),
                                a = [document.createTextNode("Other"), this.markup("input", null, o)],
                                l = this.markup("label", a, { for: r.id }),
                                d = this.markup("div", [i, l], { className: n });
                            e.push(d);
                        }
                    }
                    return (this.dom = "select" == i ? this.markup(u, e, Object(d.A)(c, !0)) : this.markup("div", e, { className: i })), this.dom;
                }
                groupRequired() {
                    const e = this.element.getElementsByTagName("input"),
                        t = (e, t) => {
                            [].forEach.call(e, (e) => {
                                t ? e.removeAttribute("required") : e.setAttribute("required", "required"),
                                    ((e, t) => {
                                        const n = o.a.mi18n("minSelectionRequired", 1);
                                        t ? e.setCustomValidity("") : e.setCustomValidity(n);
                                    })(e, t);
                            });
                        },
                        n = () => {
                            const n = [].some.call(e, (e) => e.checked);
                            t(e, n);
                        };
                    for (let t = e.length - 1; t >= 0; t--) e[t].addEventListener("change", n);
                    n();
                }
                onRender() {
                    if (this.config.userData) {
                        const t = this.config.userData.slice();
                        "select" === this.config.type
                            ? e(this.dom).val(t).prop("selected", !0)
                            : this.config.type.endsWith("-group") &&
                              this.dom.querySelectorAll("input").forEach((e) => {
                                  if (!e.classList.contains("other-val")) {
                                      for (let n = 0; n < t.length; n++)
                                          if (e.value === t[n]) {
                                              e.setAttribute("checked", !0), t.splice(n, 1);
                                              break;
                                          }
                                      if (e.id.endsWith("-other")) {
                                          const n = document.getElementById(e.id + "-value");
                                          if (0 === t.length) return;
                                          e.setAttribute("checked", !0), (n.value = e.value = t[0]), (n.style.display = "inline-block");
                                      }
                                  }
                              });
                    }
                }
            }
            o.a.register(["select", "checkbox-group", "radio-group", "checkbox"], m);
            class g extends o.a {
                static get definition() {
                    return { mi18n: { date: "dateField", file: "fileUpload" } };
                }
                build() {
                    let { name: e } = this.config;
                    e = this.config.multiple ? e + "[]" : e;
                    const t = Object.assign({}, this.config, { name: e });
                    return (this.dom = this.markup("input", null, t)), this.dom;
                }
                onRender() {
                    this.config.userData && e(this.dom).val(this.config.userData[0]);
                }
            }
            o.a.register(["text", "file", "date", "number"], g), o.a.register(["text", "password", "email", "color", "tel"], g, "text");
            class b extends g {
                static get definition() {
                    return { i18n: { default: "Fine Uploader" } };
                }
                configure() {
                    (this.js = this.classConfig.js || "//cdnjs.cloudflare.com/ajax/libs/file-uploader/5.14.2/jquery.fine-uploader/jquery.fine-uploader.min.js"),
                        (this.css = [
                            this.classConfig.css || "//cdnjs.cloudflare.com/ajax/libs/file-uploader/5.14.2/jquery.fine-uploader/fine-uploader-gallery.min.css",
                            {
                                type: "inline",
                                id: "fineuploader-inline",
                                style:
                                    "\n          .qq-uploader .qq-error-message {\n            position: absolute;\n            left: 20%;\n            top: 20px;\n            width: 60%;\n            color: #a94442;\n            background: #f2dede;\n            border: solid 1px #ebccd1;\n            padding: 15px;\n            line-height: 1.5em;\n            text-align: center;\n            z-index: 99999;\n          }\n          .qq-uploader .qq-error-message span {\n            display: inline-block;\n            text-align: left;\n          }",
                            },
                        ]),
                        (this.handler = this.classConfig.handler || "/upload");
                    ["js", "css", "handler"].forEach((e) => delete this.classConfig[e]);
                    const t =
                        this.classConfig.template ||
                        '\n      <div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Drop files here">\n        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">\n          <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>\n        </div>\n        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>\n          <span class="qq-upload-drop-area-text-selector"></span>\n        </div>\n        <div class="qq-upload-button-selector qq-upload-button">\n          <div>Upload a file</div>\n        </div>\n        <span class="qq-drop-processing-selector qq-drop-processing">\n          <span>Processing dropped files...</span>\n          <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>\n        </span>\n        <ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite" aria-relevant="additions removals">\n          <li>\n            <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>\n            <div class="qq-progress-bar-container-selector qq-progress-bar-container">\n              <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>\n            </div>\n            <span class="qq-upload-spinner-selector qq-upload-spinner"></span>\n            <div class="qq-thumbnail-wrapper">\n              <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>\n            </div>\n            <button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>\n            <button type="button" class="qq-upload-retry-selector qq-upload-retry">\n              <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>\n              Retry\n            </button>\n            <div class="qq-file-info">\n              <div class="qq-file-name">\n                <span class="qq-upload-file-selector qq-upload-file"></span>\n                <span class="qq-edit-filename-icon-selector qq-btn qq-edit-filename-icon" aria-label="Edit filename"></span>\n              </div>\n              <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">\n              <span class="qq-upload-size-selector qq-upload-size"></span>\n              <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">\n                <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>\n              </button>\n              <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">\n                <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>\n              </button>\n              <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">\n                <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>\n              </button>\n            </div>\n          </li>\n        </ul>\n        <dialog class="qq-alert-dialog-selector">\n          <div class="qq-dialog-message-selector"></div>\n          <div class="qq-dialog-buttons">\n            <button type="button" class="qq-cancel-button-selector">Close</button>\n          </div>\n        </dialog>\n        <dialog class="qq-confirm-dialog-selector">\n          <div class="qq-dialog-message-selector"></div>\n          <div class="qq-dialog-buttons">\n            <button type="button" class="qq-cancel-button-selector">No</button>\n            <button type="button" class="qq-ok-button-selector">Yes</button>\n          </div>\n        </dialog>\n        <dialog class="qq-prompt-dialog-selector">\n          <div class="qq-dialog-message-selector"></div>\n          <input type="text">\n          <div class="qq-dialog-buttons">\n            <button type="button" class="qq-cancel-button-selector">Cancel</button>\n            <button type="button" class="qq-ok-button-selector">Ok</button>\n          </div>\n        </dialog>\n      </div>';
                    this.fineTemplate = e("<div/>").attr("id", "qq-template").html(t);
                }
                build() {
                    return (
                        (this.input = this.markup("input", null, { type: "hidden", name: this.config.name, id: this.config.name })), (this.wrapper = this.markup("div", "", { id: this.config.name + "-wrapper" })), [this.input, this.wrapper]
                    );
                }
                onRender() {
                    const t = e(this.wrapper),
                        n = e(this.input),
                        r = jQuery.extend(
                            !0,
                            {
                                request: { endpoint: this.handler },
                                deleteFile: { enabled: !0, endpoint: this.handler },
                                chunking: { enabled: !0, concurrent: { enabled: !0 }, success: { endpoint: this.handler + (-1 == this.handler.indexOf("?") ? "?" : "&") + "done" } },
                                resume: { enabled: !0 },
                                retry: { enableAuto: !0, showButton: !0 },
                                callbacks: {
                                    onError: (n, r, o) => {
                                        "." != o.slice(-1) && (o += ".");
                                        const i = e("<div />").addClass("qq-error-message").html(`<span>Error processing upload: <b>${r}</b>.<br />Reason: ${o}</span>`).prependTo(t.find(".qq-uploader")),
                                            s = window.setTimeout(() => {
                                                i.fadeOut(() => {
                                                    i.remove(), window.clearTimeout(s);
                                                });
                                            }, 6e3);
                                        return n;
                                    },
                                    onStatusChange: (e, r, o) => {
                                        const i = t.fineUploader("getUploads"),
                                            s = [];
                                        for (const e of i) "upload successful" == e.status && s.push(e.name);
                                        return n.val(s.join(", ")), { id: e, oldStatus: r, newStatus: o };
                                    },
                                },
                                template: this.fineTemplate,
                            },
                            this.classConfig
                        );
                    t.fineUploader(r);
                }
            }
            function y(e, t) {
                if (null == e) return {};
                var n,
                    r,
                    o = (function (e, t) {
                        if (null == e) return {};
                        var n,
                            r,
                            o = {},
                            i = Object.keys(e);
                        for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (o[n] = e[n]);
                        return o;
                    })(e, t);
                if (Object.getOwnPropertySymbols) {
                    var i = Object.getOwnPropertySymbols(e);
                    for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]));
                }
                return o;
            }
            g.register("file", g, "file"), g.register("fineuploader", b, "file");
            class v extends o.a {
                static get definition() {
                    return { mi18n: { textarea: "textArea" } };
                }
                build() {
                    const e = this.config,
                        { value: t = "" } = e,
                        n = y(e, ["value"]);
                    return (this.field = this.markup("textarea", this.parsedHtml(t), n)), this.field;
                }
                onRender() {
                    this.config.userData && e("#" + this.config.name).val(this.config.userData[0]);
                }
                on(t) {
                    return "prerender" == t && this.preview
                        ? (t) => {
                              this.field && (t = this.field),
                                  e(t).on("mousedown", (e) => {
                                      e.stopPropagation();
                                  });
                          }
                        : super.on(t);
                }
            }
            function x(e, t) {
                if (null == e) return {};
                var n,
                    r,
                    o = (function (e, t) {
                        if (null == e) return {};
                        var n,
                            r,
                            o = {},
                            i = Object.keys(e);
                        for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (o[n] = e[n]);
                        return o;
                    })(e, t);
                if (Object.getOwnPropertySymbols) {
                    var i = Object.getOwnPropertySymbols(e);
                    for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]));
                }
                return o;
            }
            o.a.register("textarea", v), o.a.register("textarea", v, "textarea");
            class w extends v {
                configure() {
                    if (((this.js = ["https://cdn.tinymce.com/4/tinymce.min.js"]), this.classConfig.js)) {
                        let e = this.classConfig.js;
                        Array.isArray(e) || (e = new Array(e)), this.js.concat(e), delete this.classConfig.js;
                    }
                    this.classConfig.css && (this.css = this.classConfig.css),
                        (this.editorOptions = {
                            height: 250,
                            paste_data_images: !0,
                            plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste code"],
                            toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | table",
                        });
                }
                build() {
                    const e = this.config,
                        { value: t = "" } = e,
                        n = x(e, ["value"]);
                    return (this.field = this.markup("textarea", this.parsedHtml(t), n)), n.disabled && (this.editorOptions.readonly = !0), this.field;
                }
                onRender(e) {
                    window.tinymce.editors[this.id] && window.tinymce.editors[this.id].remove();
                    const t = jQuery.extend(this.editorOptions, this.classConfig);
                    return (t.target = this.field), window.tinymce.init(t), this.config.userData && window.tinymce.editors[this.id].setContent(this.parsedHtml(this.config.userData[0])), e;
                }
            }
            function O(e, t) {
                if (null == e) return {};
                var n,
                    r,
                    o = (function (e, t) {
                        if (null == e) return {};
                        var n,
                            r,
                            o = {},
                            i = Object.keys(e);
                        for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (o[n] = e[n]);
                        return o;
                    })(e, t);
                if (Object.getOwnPropertySymbols) {
                    var i = Object.getOwnPropertySymbols(e);
                    for (r = 0; r < i.length; r++) (n = i[r]), t.indexOf(n) >= 0 || (Object.prototype.propertyIsEnumerable.call(e, n) && (o[n] = e[n]));
                }
                return o;
            }
            function q(e, t) {
                var n = Object.keys(e);
                if (Object.getOwnPropertySymbols) {
                    var r = Object.getOwnPropertySymbols(e);
                    t &&
                        (r = r.filter(function (t) {
                            return Object.getOwnPropertyDescriptor(e, t).enumerable;
                        })),
                        n.push.apply(n, r);
                }
                return n;
            }
            function j(e) {
                for (var t = 1; t < arguments.length; t++) {
                    var n = null != arguments[t] ? arguments[t] : {};
                    t % 2
                        ? q(Object(n), !0).forEach(function (t) {
                              k(e, t, n[t]);
                          })
                        : Object.getOwnPropertyDescriptors
                        ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n))
                        : q(Object(n)).forEach(function (t) {
                              Object.defineProperty(e, t, Object.getOwnPropertyDescriptor(n, t));
                          });
                }
                return e;
            }
            function k(e, t, n) {
                return t in e ? Object.defineProperty(e, t, { value: n, enumerable: !0, configurable: !0, writable: !0 }) : (e[t] = n), e;
            }
            v.register("tinymce", w, "textarea");
            class C extends v {
                configure() {
                    const e = { modules: { toolbar: [[{ header: [1, 2, !1] }], ["bold", "italic", "underline"], ["code-block"]] }, placeholder: this.config.placeholder || "", theme: "snow" },
                        [t, n] = d.f.splitObject(this.classConfig, ["css", "js"]);
                    Object.assign(this, j(j({}, { js: "//cdn.quilljs.com/1.2.4/quill.js", css: "//cdn.quilljs.com/1.2.4/quill.snow.css" }), t)), (this.editorConfig = j(j({}, e), n));
                }
                build() {
                    const e = this.config,
                        { value: t = "" } = e,
                        n = O(e, ["value"]);
                    return (this.field = this.markup("div", null, n)), this.field;
                }
                onRender(e) {
                    const t = this.config.value || "",
                        n = window.Quill.import("delta");
                    window.fbEditors.quill[this.id] = {};
                    const r = window.fbEditors.quill[this.id];
                    return (
                        (r.instance = new window.Quill(this.field, this.editorConfig)),
                        (r.data = new n()),
                        t && r.instance.setContents(window.JSON.parse(this.parsedHtml(t))),
                        r.instance.on("text-change", function (e) {
                            r.data = r.data.compose(e);
                        }),
                        e
                    );
                }
            }
            v.register("quill", C, "textarea");
            c.a;
        },
        ,
        ,
        ,
        ,
        ,
        ,
        ,
        ,
        ,
        ,
        ,
        ,
        ,
        ,
        ,
        ,
        ,
        function (t, n, r) {
            r.r(n);
            var o = r(2),
                i = r.n(o),
                s = r(0),
                a = r(4),
                l = r(5),
                c = r(10),
                u = r(1),
                d = (r(12), r(6)),
                p = r(3);
            r(31);
            class f {
                constructor(e = {}) {
                    const t = {
                        layout: c.a,
                        layoutTemplates: {},
                        controls: {},
                        controlConfig: {},
                        container: !1,
                        dataType: "json",
                        formData: !1,
                        i18n: Object.assign({}, p.b),
                        messages: { formRendered: "Form Rendered", noFormData: "No form data.", other: "Other", selectColor: "Select Color", invalidControl: "Invalid control" },
                        onRender: () => {},
                        render: !0,
                        templates: {},
                        notify: {
                            error: (e) => {
                                console.log(e);
                            },
                            success: (e) => {
                                console.log(e);
                            },
                            warning: (e) => {
                                console.warn(e);
                            },
                        },
                    };
                    if (((this.options = jQuery.extend(!0, t, e)), (this.instanceContainers = []), i.a.current || i.a.init(this.options.i18n), !this.options.formData)) return !1;
                    (this.options.formData = this.parseFormData(this.options.formData)),
                        (u.a.controlConfig = e.controlConfig || {}),
                        u.a.loadCustom(e.controls),
                        Object.keys(this.options.templates).length && d.a.register(this.options.templates),
                        "function" != typeof Element.prototype.appendFormFields &&
                            (Element.prototype.appendFormFields = function (e) {
                                Array.isArray(e) || (e = [e]);
                                const t = s.f.markup("div", e, { className: "rendered-form rendered-form-parent" });
                                this.appendChild(t),
                                    e.forEach((e) => {
                                        const [n] = e.className.match(/row-([^\s]+)/) || [];
                                        if (n) {
                                            const r = this.id ? `${this.id}-row-${n}` : "row-" + n;
                                            let o = document.getElementById(r);
                                            o || ((o = s.f.markup("div", null, { id: r, className: "row form-inline" })), t.appendChild(o)), o.appendChild(e);
                                        } else t.appendChild(e);
                                        e.dispatchEvent(l.a.fieldRendered);
                                    });
                            }),
                        "function" != typeof Element.prototype.emptyContainer &&
                            (Element.prototype.emptyContainer = function () {
                                const e = this;
                                for (; e.lastChild; ) e.removeChild(e.lastChild);
                            });
                }
                santizeField(e, t) {
                    const n = Object.assign({}, e);
                    return (
                        t && ((n.id = e.id && `${e.id}-${t}`), (n.name = e.name && `${e.name}-${t}`)),
                        (n.className = Array.isArray(e.className) ? s.f.unique(e.className.join(" ").split(" ")).join(" ") : e.className || e.class || null),
                        delete n.class,
                        e.values && (e.values = e.values.map((e) => s.f.trimObj(e))),
                        s.f.trimObj(n)
                    );
                }
                getElement(e) {
                    return (e = this.options.container || e) instanceof jQuery ? (e = e[0]) : "string" == typeof e && (e = document.querySelector(e)), e;
                }
                render(e = null, t = 0) {
                    const n = this,
                        r = this.options;
                    e = this.getElement(e);
                    const o = [];
                    if (r.formData) {
                        const i = new r.layout(r.layoutTemplates);
                        for (let e = 0; e < r.formData.length; e++) {
                            const n = r.formData[e],
                                s = this.santizeField(n, t),
                                a = u.a.getClass(n.type, n.subtype),
                                l = i.build(a, s);
                            o.push(l);
                        }
                        if ((e && (this.instanceContainers[t] = e), r.render && e)) e.emptyContainer(), e.appendFormFields(o), r.onRender && r.onRender(), r.notify.success(r.messages.formRendered);
                        else {
                            const e = (e) => e.map((e) => e.innerHTML).join("");
                            n.markup = e(o);
                        }
                    } else {
                        const e = s.f.markup("div", r.messages.noFormData, { className: "no-form-data" });
                        o.push(e), r.notify.error(r.messages.noFormData);
                    }
                    if (r.disableInjectedStyle) {
                        const e = document.getElementsByClassName("formBuilder-injected-style");
                        Object(s.i)(e, (t) => Object(a.f)(e[t]));
                    }
                    return n;
                }
                renderControl(e = null) {
                    const t = this.options,
                        n = t.formData;
                    if (!n || Array.isArray(n)) throw new Error("To render a single element, please specify a single object of formData for the field in question");
                    const r = this.santizeField(n),
                        o = new t.layout(),
                        i = u.a.getClass(n.type, n.subtype),
                        s = t.forceTemplate || "hidden",
                        a = o.build(i, r, s);
                    return e.appendFormFields(a), t.notify.success(t.messages.formRendered), this;
                }
                get userData() {
                    const t = this.options.formData.slice();
                    return (
                        t.filter((e) => "tinymce" === e.subtype).forEach((e) => window.tinymce.get(e.name).save()),
                        this.instanceContainers.forEach((n) => {
                            const r = e("select, input, textarea", n)
                                    .serializeArray()
                                    .reduce((e, { name: t, value: n }) => (e[(t = t.replace("[]", ""))] ? e[t].push(n) : (e[t] = [n]), e), {}),
                                o = t.length;
                            for (let e = 0; e < o; e++) {
                                const n = t[e];
                                void 0 !== n.name && (n.disabled || (n.userData = r[n.name]));
                            }
                        }),
                        t
                    );
                }
                clear() {
                    this.instanceContainers.forEach((e) => {
                        this.options.formData
                            .slice()
                            .filter((e) => "tinymce" === e.subtype)
                            .forEach((e) => window.tinymce.get(e.name).setContent("")),
                            e.querySelectorAll("input, select, textarea").forEach((e) => {
                                ["checkbox", "radio"].includes(e.type) ? (e.checked = !1) : (e.value = "");
                            });
                    });
                }
                parseFormData(e) {
                    return "object" != typeof e && (e = { xml: (e) => Object(s.t)(e), json: (e) => window.JSON.parse(e) }[this.options.dataType](e) || !1), e;
                }
            }
            !(function () {
                let e;
                const t = {
                    init: (n, r = {}) => ((e = n), (t.instance = new f(r)), n.each((e) => t.instance.render(n[e], e)), t.instance),
                    userData: () => t.instance && t.instance.userData,
                    clear: () => t.instance && t.instance.clear(),
                    setData: (e) => {
                        if (t.instance) {
                            const n = t.instance;
                            n.options.formData = n.parseFormData(e);
                        }
                    },
                    render: (n, r = {}) => {
                        if (t.instance) {
                            const o = t.instance;
                            (o.options = Object.assign({}, o.options, r, { formData: o.parseFormData(n) })), e.each((n) => t.instance.render(e[n], n));
                        }
                    },
                    html: () => e.map((t) => e[t]).html(),
                };
                (jQuery.fn.formRender = function (e = {}, ...n) {
                    if (t[e]) return t[e].apply(this, n);
                    {
                        const n = t.init(this, e);
                        return Object.assign(t, n), n;
                    }
                }),
                    (jQuery.fn.controlRender = function (e, t = {}) {
                        (t.formData = e), (t.dataType = "string" == typeof e ? "json" : "xml");
                        const n = new f(t),
                            r = this;
                        return r.each((e) => n.renderControl(r[e])), r;
                    });
            })(jQuery);
        },
        function (e, t, n) {
            var r = n(9),
                o = n(32);
            "string" == typeof (o = o.__esModule ? o.default : o) && (o = [[e.i, o, ""]]);
            var i = { attributes: { class: "formBuilder-injected-style" }, insert: "head", singleton: !1 };
            r(o, i);
            e.exports = o.locals || {};
        },
        function (e, t, n) {
            n.r(t);
            var r = n(7),
                o = n.n(r)()(!1);
            o.push([
                e.i,
                ".rendered-form *{box-sizing:border-box}.rendered-form button,.rendered-form input,.rendered-form select,.rendered-form textarea{font-family:inherit;font-size:inherit;line-height:inherit}.rendered-form input{line-height:normal}.rendered-form textarea{overflow:auto}.rendered-form button,.rendered-form input,.rendered-form select,.rendered-form textarea{font-family:inherit;font-size:inherit;line-height:inherit}.rendered-form .btn-group{position:relative;display:inline-block;vertical-align:middle}.rendered-form .btn-group>.btn{position:relative;float:left}.rendered-form .btn-group>.btn:first-child:not(:last-child):not(.dropdown-toggle){border-top-right-radius:0;border-bottom-right-radius:0}.rendered-form .btn-group>.btn:not(:first-child):not(:last-child):not(.dropdown-toggle){border-radius:0}.rendered-form .btn-group .btn+.btn,.rendered-form .btn-group .btn+.btn-group,.rendered-form .btn-group .btn-group+.btn,.rendered-form .btn-group .btn-group+.btn-group{margin-left:-1px}.rendered-form .btn-group>.btn:last-child:not(:first-child),.rendered-form .btn-group>.dropdown-toggle:not(:first-child),.rendered-form .btn-group .input-group .form-control:last-child,.rendered-form .btn-group .input-group-addon:last-child,.rendered-form .btn-group .input-group-btn:first-child>.btn-group:not(:first-child)>.btn,.rendered-form .btn-group .input-group-btn:first-child>.btn:not(:first-child),.rendered-form .btn-group .input-group-btn:last-child>.btn,.rendered-form .btn-group .input-group-btn:last-child>.btn-group>.btn,.rendered-form .btn-group .input-group-btn:last-child>.dropdown-toggle{border-top-left-radius:0;border-bottom-left-radius:0}.rendered-form .btn-group>.btn.active,.rendered-form .btn-group>.btn:active,.rendered-form .btn-group>.btn:focus,.rendered-form .btn-group>.btn:hover{z-index:2}.rendered-form .btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;user-select:none;background-image:none;border-radius:4px}.rendered-form .btn.btn-lg{padding:10px 16px;font-size:18px;line-height:1.3333333;border-radius:6px}.rendered-form .btn.btn-sm{padding:5px 10px;font-size:12px;line-height:1.5;border-radius:3px}.rendered-form .btn.btn-xs{padding:1px 5px;font-size:12px;line-height:1.5;border-radius:3px}.rendered-form .btn.active,.rendered-form .btn.btn-active,.rendered-form .btn:active{background-image:none}.rendered-form .input-group .form-control:last-child,.rendered-form .input-group-addon:last-child,.rendered-form .input-group-btn:first-child>.btn-group:not(:first-child)>.btn,.rendered-form .input-group-btn:first-child>.btn:not(:first-child),.rendered-form .input-group-btn:last-child>.btn,.rendered-form .input-group-btn:last-child>.btn-group>.btn,.rendered-form .input-group-btn:last-child>.dropdown-toggle{border-top-left-radius:0;border-bottom-left-radius:0}.rendered-form .input-group .form-control,.rendered-form .input-group-addon,.rendered-form .input-group-btn{display:table-cell}.rendered-form .input-group-lg>.form-control,.rendered-form .input-group-lg>.input-group-addon,.rendered-form .input-group-lg>.input-group-btn>.btn{height:46px;padding:10px 16px;font-size:18px;line-height:1.3333333}.rendered-form .input-group{position:relative;display:table;border-collapse:separate}.rendered-form .input-group .form-control{position:relative;z-index:2;float:left;width:100%;margin-bottom:0}.rendered-form .form-control,.rendered-form output{font-size:14px;line-height:1.42857143;display:block}.rendered-form textarea.form-control{height:auto}.rendered-form .form-control{height:34px;display:block;width:100%;padding:6px 12px;font-size:14px;line-height:1.42857143;border-radius:4px}.rendered-form .form-control:focus{outline:0;box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(102,175,233,0.6)}.rendered-form .form-group{margin-left:0px;margin-bottom:15px}.rendered-form .btn,.rendered-form .form-control{background-image:none}.rendered-form .pull-right{float:right}.rendered-form .pull-left{float:left}.rendered-form .formbuilder-required,.rendered-form .required-asterisk{color:#c10000}.rendered-form .formbuilder-checkbox-group input[type='checkbox'],.rendered-form .formbuilder-checkbox-group input[type='radio'],.rendered-form .formbuilder-radio-group input[type='checkbox'],.rendered-form .formbuilder-radio-group input[type='radio']{margin:0 4px 0 0}.rendered-form .formbuilder-checkbox-inline,.rendered-form .formbuilder-radio-inline{margin-right:8px;display:inline-block;vertical-align:middle;padding-left:0}.rendered-form .formbuilder-checkbox-inline label input[type='text'],.rendered-form .formbuilder-radio-inline label input[type='text']{margin-top:0}.rendered-form .formbuilder-checkbox-inline:first-child,.rendered-form .formbuilder-radio-inline:first-child{padding-left:0}.rendered-form .formbuilder-autocomplete-list{background-color:#fff;display:none;list-style:none;padding:0;border:1px solid #ccc;border-width:0 1px 1px;position:absolute;z-index:20;max-height:200px;overflow-y:auto}.rendered-form .formbuilder-autocomplete-list li{display:none;cursor:default;padding:5px;margin:0;transition:background-color 200ms ease-in-out}.rendered-form .formbuilder-autocomplete-list li:hover,.rendered-form .formbuilder-autocomplete-list li.active-option{background-color:rgba(0,0,0,0.075)}.rendered-form .kc-toggle{padding-left:0 !important}.rendered-form .kc-toggle span{position:relative;width:48px;height:24px;background:#e6e6e6;display:inline-block;border-radius:4px;border:1px solid #ccc;padding:2px;overflow:hidden;float:left;margin-right:5px;will-change:transform}.rendered-form .kc-toggle span::after,.rendered-form .kc-toggle span::before{position:absolute;display:inline-block;top:0}.rendered-form .kc-toggle span::after{position:relative;content:'';width:50%;height:100%;left:0;border-radius:3px;background:linear-gradient(to bottom, #fff 0%, #ccc 100%);border:1px solid #999;transition:transform 100ms;transform:translateX(0)}.rendered-form .kc-toggle span::before{border-radius:4px;top:2px;left:2px;content:'';width:calc(100% - 4px);height:18px;box-shadow:0 0 1px 1px #b3b3b3 inset;background-color:transparent}.rendered-form .kc-toggle input{height:0;overflow:hidden;width:0;opacity:0;pointer-events:none;margin:0}.rendered-form .kc-toggle input:checked+span::after{transform:translateX(100%)}.rendered-form .kc-toggle input:checked+span::before{background-color:#6fc665}.rendered-form label{font-weight:normal}.form-group .formbuilder-required{color:#c10000}.other-option:checked+label input{display:inline-block}.other-val{margin-left:5px;display:none}*[tooltip]{position:relative}*[tooltip]:hover::after{background:rgba(0,0,0,0.9);border-radius:5px 5px 5px 0;bottom:23px;color:#fff;content:attr(tooltip);padding:10px 5px;position:absolute;z-index:98;left:2px;width:230px;text-shadow:none;font-size:12px;line-height:1.5em}*[tooltip]:hover::before{border:solid;border-color:#222 transparent;border-width:6px 6px 0;bottom:17px;content:'';left:2px;position:absolute;z-index:99}.tooltip-element{color:#fff;background:#000;width:16px;height:16px;border-radius:8px;display:inline-block;text-align:center;line-height:16px;margin:0 5px;font-size:12px}.form-control.number{width:auto}.form-control[type='color']{width:60px;padding:2px;display:inline-block}.form-control[multiple]{height:auto}\n",
                "",
            ]),
                (t.default = o);
        },
    ]);
})(jQuery);
