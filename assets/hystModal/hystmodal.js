! function(e) {
    var t = {};

    function o(n) {
        if (t[n]) return t[n].exports;
        var i = t[n] = {
            i: n,
            l: !1,
            exports: {}
        };
        return e[n].call(i.exports, i, i.exports, o), i.l = !0, i.exports
    }
    o.m = e, o.c = t, o.d = function(e, t, n) {
        o.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: n
        })
    }, o.r = function(e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, o.t = function(e, t) {
        if (1 & t && (e = o(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var n = Object.create(null);
        if (o.r(n), Object.defineProperty(n, "default", {
                enumerable: !0,
                value: e
            }), 2 & t && "string" != typeof e)
            for (var i in e) o.d(n, i, function(t) {
                return e[t]
            }.bind(null, i));
        return n
    }, o.n = function(e) {
        var t = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return o.d(t, "a", t), t
    }, o.o = function(e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, o.p = "", o(o.s = 1)
}([function(e, t, o) {
    "use strict";

    function n() {
        return (n = Object.assign || function(e) {
            for (var t = 1; t < arguments.length; t++) {
                var o = arguments[t];
                for (var n in o) Object.prototype.hasOwnProperty.call(o, n) && (e[n] = o[n])
            }
            return e
        }).apply(this, arguments)
    }

    function i(e, t) {
        for (var o = 0; o < t.length; o++) {
            var n = t[o];
            n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(e, n.key, n)
        }
    }
    o.d(t, "a", (function() {
        return s
    }));
    var s = function() {
        function e(t) {
            ! function(e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            }(this, e);
            this.config = n({
                backscroll: !0,
                linkAttributeName: "data-hystmodal",
                closeOnOverlay: !0,
                closeOnEsc: !0,
                closeOnButton: !0,
                waitTransitions: !1,
                catchFocus: !0,
                fixedSelectors: "*[data-hystfixed]",
                smr: !0,
                beforeOpen: function() {},
                afterClose: function() {}
            }, t), this.config.linkAttributeName && this.init(), this._closeAfterTransition = this._closeAfterTransition.bind(this)
        }
        var t, o, s;
        return t = e, (o = [{
            key: "init",
            value: function() {
                this.isOpened = !1, this.openedWindow = !1, this.starter = !1, this._nextWindows = !1, this._scrollPosition = 0, this._reopenTrigger = !1, this._overlayChecker = !1, this._isMoved = !1, this._focusElements = ["a[href]", "area[href]", 'input:not([disabled]):not([type="hidden"]):not([aria-hidden])', "select:not([disabled]):not([aria-hidden])", "textarea:not([disabled]):not([aria-hidden])", "button:not([disabled]):not([aria-hidden])", "iframe", "object", "embed", "[contenteditable]", '[tabindex]:not([tabindex^="-"])'], this._modalBlock = !1;
                var e = document.querySelector(".hystmodal__shadow");
                e ? this.shadow = e : (this.shadow = document.createElement("div"), this.shadow.classList.add("hystmodal__shadow"), document.body.appendChild(this.shadow)), this.eventsFeeler()
            }
        }, {
            key: "eventsFeeler",
            value: function() {
                var e = this;
                document.addEventListener("click", (function(t) {
                    var o = t.target.closest("[".concat(e.config.linkAttributeName, "]"));
                    if (!e._isMoved && o) {
                        t.preventDefault(), e.starter = o;
                        var n = e.starter.getAttribute(e.config.linkAttributeName);
                        return e._nextWindows = document.querySelector(n), void e.open()
                    }
                    e.config.closeOnButton && t.target.closest("[data-hystclose]") && e.close()
                })), this.config.closeOnOverlay && (document.addEventListener("mousedown", (function(t) {
                    !e._isMoved && t.target instanceof Element && !t.target.classList.contains("hystmodal__wrap") || (e._overlayChecker = !0)
                })), document.addEventListener("mouseup", (function(t) {
                    if (!e._isMoved && t.target instanceof Element && e._overlayChecker && t.target.classList.contains("hystmodal__wrap")) return t.preventDefault(), e._overlayChecker = !e._overlayChecker, void e.close();
                    e._overlayChecker = !1
                }))), window.addEventListener("keydown", (function(t) {
                    if (!e._isMoved && e.config.closeOnEsc && 27 === t.which && e.isOpened) return t.preventDefault(), void e.close();
                    !e._isMoved && e.config.catchFocus && 9 === t.which && e.isOpened && e.focusCatcher(t)
                }))
            }
        }, {
            key: "open",
            value: function(e) {
                if (e && (this._nextWindows = "string" == typeof e ? document.querySelector(e) : e), this._nextWindows) {
                    if (this.isOpened) return this._reopenTrigger = !0, void this.close();
                    this.openedWindow = this._nextWindows, this._modalBlock = this.openedWindow.querySelector(".hystmodal__window"), this.config.beforeOpen(this), this._bodyScrollControl(), this.shadow.classList.add("hystmodal__shadow--show"), this.openedWindow.classList.add("hystmodal--active"), this.openedWindow.setAttribute("aria-hidden", "false"), this.config.catchFocus && this.focusControl(), this.isOpened = !0
                } else console.log("Warning: hystModal selector is not found")
            }
        }, {
            key: "close",
            value: function() {
                this.isOpened && (this.config.waitTransitions ? (this.openedWindow.classList.add("hystmodal--moved"), this._isMoved = !0, this.openedWindow.addEventListener("transitionend", this._closeAfterTransition), this.openedWindow.classList.remove("hystmodal--active")) : (this.openedWindow.classList.remove("hystmodal--active"), this._closeAfterTransition()))
            }
        }, {
            key: "_closeAfterTransition",
            value: function() {
                this.openedWindow.classList.remove("hystmodal--moved"), this.openedWindow.removeEventListener("transitionend", this._closeAfterTransition), this._isMoved = !1, this.shadow.classList.remove("hystmodal__shadow--show"), this.openedWindow.setAttribute("aria-hidden", "true"), this.config.catchFocus && this.focusControl(), this._bodyScrollControl(), this.isOpened = !1, this.openedWindow.scrollTop = 0, this.config.afterClose(this), this._reopenTrigger && (this._reopenTrigger = !1, this.open())
            }
        }, {
            key: "focusControl",
            value: function() {
                var e = this.openedWindow.querySelectorAll(this._focusElements);
                this.isOpened && this.starter ? this.starter.focus() : e.length && e[0].focus()
            }
        }, {
            key: "focusCatcher",
            value: function(e) {
                var t = this.openedWindow.querySelectorAll(this._focusElements),
                    o = Array.prototype.slice.call(t);
                if (this.openedWindow.contains(document.activeElement)) {
                    var n = o.indexOf(document.activeElement);
                    e.shiftKey && 0 === n && (o[o.length - 1].focus(), e.preventDefault()), e.shiftKey || n !== o.length - 1 || (o[0].focus(), e.preventDefault())
                } else o[0].focus(), e.preventDefault()
            }
        }, {
            key: "_bodyScrollControl",
            value: function() {
                if (this.config.backscroll) {
                    var e = document.querySelectorAll(this.config.fixedSelectors),
                        t = Array.prototype.slice.call(e),
                        o = document.documentElement;
                    if (!0 === this.isOpened) return o.classList.remove("hystmodal__opened"), o.style.marginRight = "", t.forEach((function(e) {
                        e.style.marginRight = ""
                    })), window.scrollTo(0, this._scrollPosition), void(o.style.top = "");
                    this._scrollPosition = window.pageYOffset;
                    var n = window.innerWidth - o.clientWidth;
                    // o.style.top = "".concat(-this._scrollPosition, "px"), n && (o.style.marginRight = "".concat(n, "px"), t.forEach((function(e) {
                    //     e.style.marginRight = "".concat(parseInt(getComputedStyle(e).marginRight, 10) + n, "px")
                    // }))), 
                    o.classList.add("hystmodal__opened")
                }
            }
        }]) && i(t.prototype, o), s && i(t, s), Object.defineProperty(t, "prototype", {
            writable: !1
        }), e
    }()
}, function(e, t, o) {
    "use strict";
    o.r(t),
        function(e) {
            var t = o(0);
            o(3), o(4);
            e.HystModal = t.a
        }.call(this, o(2))
}, function(e, t) {
    var o;
    o = function() {
        return this
    }();
    try {
        o = o || new Function("return this")()
    } catch (e) {
        "object" == typeof window && (o = window)
    }
    e.exports = o
}, function(e, t) {
    "undefined" != typeof Element && (Element.prototype.matches || (Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector), Element.prototype.closest || (Element.prototype.closest = function(e) {
        var t = this;
        do {
            if (t.matches(e)) return t;
            t = t.parentElement || t.parentNode
        } while (null !== t && 1 === t.nodeType);
        return null
    }))
}, function(e, t, o) {}]);
