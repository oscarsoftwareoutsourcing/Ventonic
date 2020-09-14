(function (global, factory) {
    typeof exports === "object" && typeof module !== "undefined" ?
        (module.exports = factory()) :
        typeof define === "function" && define.amd ?
        define(factory) :
        ((global = global || self),
            ((global.FullCalendarLocales = global.FullCalendarLocales || {}),
                (global.FullCalendarLocales.es = factory())));
})(this, function () {
    "use strict";

    var es = {
        code: "es",
        week: {
            dow: 1,
            doy: 4 // The week that contains Jan 4th is the first week of the year.
        },
        buttonText: {
            prev: "Ant",
            next: "Sig",
            today: "Hoy",
            month: "Mes",
            week: "Semana",
            day: "Día",
            list: "Agenda"
        },
        weekLabel: "Sm",
        allDayHtml: "Todo<br/>el día",
        eventLimitText: "más",
        noEventsMessage: "No hay eventos para mostrar"
    };

    return es;
});

let usLink = document.getElementById("usermenu-link");
let navUser = document.getElementById("usermenu-nav");
/* Se agrega el evento al elemento */
usLink.addEventListener("click", viewMenu);

function viewMenu(e) {
    //console.log(e);
    navUser.classList.add("show");
}

$(document).on('click', function () {
    let isShow = navUser.classList.contains('show');
    (isShow) ? navUser.classList.remove('show'): null;
});
