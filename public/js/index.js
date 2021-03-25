/**
 * Б. Иванов
 *
 * AJAX функция, която да замества вече съществуващите и повтарящи се
 * функции за обръщение към сървъра
 *
 *
 *
 * example:
 * ajax({
 *  method: 'POST' || 'GET'
 *  url: 'phpFunctions.php',
 *  data: {
 *      key_1: value_1,
 *      key_2: value_2
 *  }
 * }, function(response){});
 *
 * @param {*} options object: key -> value
 * @param {*} func callback функция
 */
function ajax(options, func) {
    'use strict';

    var ajax = new XMLHttpRequest();
    var method = options.method.toLowerCase();
    var url = options.url;
    var serializeData = options.data;
    var data = '';

    for (var index in serializeData) {
        data += index + '=' + encodeURIComponent(serializeData[index]) + '&';
    }

    if (data.length > 0) {
        data = data.substring(0, data.length - 1);
    }

    if (method == 'get') {
        url = url + '?' + decodeURIComponent(data);
    }

    ajax.open(method, url, true);

    if (method == 'post') {
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    }

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            return func(ajax.responseText);
        }
    };

    if (method == 'post') {
        ajax.send(decodeURIComponent(data));
    }

    if (method == 'get') {
        ajax.send(null);
    }
}

document.getElementById('btn').onclick = function () {
    ajax({
        'method': 'POST',
        'url': '/home/ajax',
        data: {
            'name': document.getElementById('index').value
        }
    }, function(response){
        console.log(response);
    });
};
