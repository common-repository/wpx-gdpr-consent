!(function (e) {
    var r = {};
    function t(n) {
        if (r[n]) return r[n].exports;
        var o = (r[n] = { i: n, l: !1, exports: {} });
        return e[n].call(o.exports, o, o.exports, t), (o.l = !0), o.exports;
    }
    (t.m = e),
        (t.c = r),
        (t.d = function (e, r, n) {
            t.o(e, r) || Object.defineProperty(e, r, { configurable: !1, enumerable: !0, get: n });
        }),
        (t.n = function (e) {
            var r =
                e && e.__esModule
                    ? function () {
                          return e.default;
                      }
                    : function () {
                          return e;
                      };
            return t.d(r, "a", r), r;
        }),
        (t.o = function (e, r) {
            return Object.prototype.hasOwnProperty.call(e, r);
        }),
        (t.p = "/"),
        t((t.s = 192));
})({
    192: function (e, r, t) {
        e.exports = t(193);
    },
    193: function (e, r) {
        jQuery(document).ready(function (e) {
            function r(e, r, t) {
                var n = new Date();
                n.setTime(n.getTime() + 24 * t * 60 * 60 * 1e3);
                var o = "expires=" + n.toGMTString();
                document.cookie = e + "=" + r + ";" + o + ";path=/";
            }
            var t = jQuery(".wgc_wrapper"),
                n = 1e3 * 100,
                o = 180,
                i = wgcData.template;
            jQuery(".gdpr-acpt-btn").on("click", function (e) {
                e.preventDefault(), r("wgc_gdpr_permission", "accepted", o), t.remove(), jQuery("body").trigger("wgc_gdpr_permission_accepted", e);
            }),
                n &&
                    n > 1e3 &&
                    setTimeout(function () {
                        t.remove();
                    }, n);
        });
    },
});
