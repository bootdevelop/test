var highlight = ace.require("ace/ext/static_highlight");
var dom = ace.require("ace/lib/dom");
console.log(highlight);

function qsa(sel) {
    return Array.apply(null, document.querySelectorAll(sel));
}
qsa("[ace-mode]").forEach(function (codeEl) {

    var mode = codeEl.getAttribute("ace-mode");

    if (mode == "json") {
        $(codeEl).html(JSON.stringify(JSON.parse($(codeEl).html()), null, '\t'));
    }

    if (mode == "php")
        mode = "php";
    highlight(codeEl, {
        mode: "ace/mode/" + mode,
        showGutter: true,
        trim: true,
        showFoldWidgets: true
    }, function (highlighted) { });
});