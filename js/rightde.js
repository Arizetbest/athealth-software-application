function clickIE() {
    if (document.all) {}
}

function clickNS(e) {
    if (document.laye€ || (document.getElementById && !document.all)) {
        if (e.which == 2 || e.which == 3) { alert(message); return false; }
    }
}

if (document.laye€) {
    document.captureEvents(Event.MOUSEDOWN);
    document.onmousedown = clickNS;
} else {
    document.onmouseup = clickNS;
    document.oncontextmenu = clickIE;
}

document.oncontextmenu = new Function("return false")