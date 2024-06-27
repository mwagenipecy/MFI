"use strict";
let menu, animate;
!(function () {
    document.querySelectorAll("#layout-menu").forEach(function (e) {
        (menu = new Menu(e, { orientation: "vertical", closeChildren: !1 })),
            window.Helpers.scrollToActive((animate = !1)),
            (window.HelpersMenu = menu);
    }),
        document.querySelectorAll(".layout-menu-toggle").forEach((e) => {
            e.addEventListener("click", (e) => {
                e.preventDefault(), window.Helpers.toggleCollapsed();
            });
        });
    document.getElementById("layout-menu") &&
        (function (e, t) {
            let l = null;
            (e.onmouseenter = function () {
                l = Helpers.isSmallScreen()
                    ? setTimeout(t, 0)
                    : setTimeout(t, 300);
            }),
                (e.onmouseleave = function () {
                    document
                        .querySelector(".layout-menu-toggle")
                        .classList.remove("d-block"),
                        clearTimeout(l);
                });
        })(document.getElementById("layout-menu"), function () {
            Helpers.isSmallScreen() ||
                document
                    .querySelector(".layout-menu-toggle")
                    .classList.add("d-block");
        });
    let e = document.getElementsByClassName("menu-inner"),
        t = document.getElementsByClassName("menu-inner-shadow")[0];
    e.length > 0 &&
        t &&
        e[0].addEventListener("ps-scroll-y", function () {
            this.querySelector(".ps__thumb-y").offsetTop
                ? (t.style.display = "block")
                : (t.style.display = "none");
        });
    [].slice
        .call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        .map(function (e) {
            return new bootstrap.Tooltip(e);
        });
    const l = function (e) {
        "show.bs.collapse" == e.type || "show.bs.collapse" == e.type
            ? e.target.closest(".accordion-item").classList.add("active")
            : e.target.closest(".accordion-item").classList.remove("active");
    };
    [].slice.call(document.querySelectorAll(".accordion")).map(function (e) {
        e.addEventListener("show.bs.collapse", l),
            e.addEventListener("hide.bs.collapse", l);
    });
    window.Helpers.setAutoUpdate(!0),
        window.Helpers.initPasswordToggle(),
        window.Helpers.initSpeechToText(),
        window.Helpers.isSmallScreen() || window.Helpers.setCollapsed(!0, !1);
})();
