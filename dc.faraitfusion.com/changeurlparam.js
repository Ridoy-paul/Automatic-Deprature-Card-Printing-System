var url = location.href.split('#')[0];
var pair = url.split('?');
var file = pair[0];
var qs = (pair[1] || "").split('&');

function geturlparam(name) {
    var ne = name + "=";
    for (var i = 0; i < qs.length; i++) {
        if (qs[i].substring(0, ne.length) == ne) {
            return qs[i].substring(ne.length);
        }
    }
}
function changeurlparam(name, value) {
    if (!pair[1]) {
        location.href = file + "?" + name + "=" + value;
        return;
    }
    var ne = name + "=";
    for (var i = 0; i < qs.length; i++) {
        if (qs[i].substring(0, ne.length) == ne) {
            qs[i] = name + "=" + value
            location.href = file + "?" + qs.join('&');
            return;
        }
    }
    qs.push(name + "=" + value);
    location.href = file + "?" + qs.join('&');
}