
function performAjaxRequest(type, url, data, successCallback, errorCallback) {
    $.ajax({
        type: type,
        url: url,
        data: data,
        success: successCallback,
        error: errorCallback,
    });
}
