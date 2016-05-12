window.Pusher = require('pusher-js');

import Echo from "laravel-echo"

window.echo = new Echo('9bd46d06e1553cc746f0');

/**
 * Pass socket ID with every request.
 */
Vue.http.interceptors.push(function () {
    return {
        request(request) {
            request.headers['X-Socket-Id'] = echo.pusher.connection.socket_id;
            return request;
        }
    }
});
