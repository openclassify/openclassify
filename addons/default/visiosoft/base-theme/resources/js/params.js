function getQueryParams(qs) {
    qs = qs.split("+").join(" ");

    var params = [], tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        params.push({k: decodeURIComponent(tokens[1]), v: decodeURIComponent(tokens[2])});
    }

    return params;
}

function findParam(fp) {
    var request = getQueryParams(document.location.search);
    request = request.filter(function (item) {
        return item.k === fp;
    });
    var res = [];
    $.each(request, function (index, value) {
        res[index] = value.v;
    });
    return res;
}