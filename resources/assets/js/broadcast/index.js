import store from '../store'
import Echo from 'laravel-echo';
import config from "../config/pusher";
import {
    GET_PRESENTED_USERS,
    JOIN_USER,
    DISMISS_USER,
    RECEIVE_MESSAGE, SET_PRESENTED_USERS
} from "../store/modules/chat/actions.type";

window.Pusher = require('pusher-js');

window.Echo = new Echo(config);

export default {
    initEcho(){
        window.Echo.join('chatroom')
            .here((users) => {
                store.dispatch(SET_PRESENTED_USERS, users);
            })
            .joining((user) => {
                store.dispatch(JOIN_USER, user);
            })
            .leaving((user) => {
                store.dispatch(DISMISS_USER, user);
            })
            .listen('MessagePosted', (e) => {
                store.dispatch(RECEIVE_MESSAGE, e);
            });
    }
};

