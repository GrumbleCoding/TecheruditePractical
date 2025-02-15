function readFileInput(input, functions) {
    var content = false;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            if (window[functions]) {
                window[functions](e.target.result);
            } else {
                toastr.error("Invalid function Provided", 'error');
            }
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        toastr.error("Sorry - you're browser doesn't support the FileReader API", 'error');
    }
    return content;
}

function addOverlay() {
    $(`<div id="overlayDocument"><img src="${loader_img}" /></div>`).appendTo(document.body);
}

function removeOverlay() {
    $('#overlayDocument').remove();
}

function Get_Unique_String(length) {
    length = (length === undefined) ? 10 : length;
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

function object_key_exits(obj, key = "") {
    return Object.keys(obj).indexOf(key) > -1;
}

function show_toastr_notification(msg = "", status = "200") {
    if (status == "200") {
        toastr.success(msg);
    } else if (status == "412") {
        toastr.error(msg);
    }
}

function ajax_maker(data) {
    // let ajax_demo = {
    //     url: "",
    //     type: "",
    //     data: "",
    //     success: "",
    //     error: "",
    // };
    let ajax_data = {
        url: (object_key_exits(data, 'url')) ? data.url : "",
        method: (object_key_exits(data, 'type')) ? data.type : "get",
        beforeSend: (object_key_exits(data, 'beforeSend')) ? data.beforeSend : addOverlay,
        complete: (object_key_exits(data, 'complete')) ? data.complete : removeOverlay,
        dataType: (object_key_exits(data, 'dataType')) ? data.dataType : 'JSON',
        success: (object_key_exits(data, 'success')) ? data.success : function () {
            alert('pass success');
        },
        error: function (err) {
            let json = err.responseJSON;
            if (json.status === 401) {
                window.location.assign("{{route('front.get_login')}}");
            } else if (json.status === 412) {
                show_toastr_notification(json.message, json.status);
            }

        }
    };
    if (object_key_exits(data, 'data')) {
        ajax_data.data = data.data;
    }
    if (object_key_exits(data, 'cache')) {
        ajax_data.cache = false;
    }
    if (object_key_exits(data, 'contentType')) {
        ajax_data.contentType = false;
    }
    if (object_key_exits(data, 'processData')) {
        ajax_data.processData = false;
    }


    if (object_key_exits(data, 'token')) {
        ajax_data.headers = {
            _token: "{{ csrf_token() }}"
        };
    }
    $.ajax(ajax_data);
}
