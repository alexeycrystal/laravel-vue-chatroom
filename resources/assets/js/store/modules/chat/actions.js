import {
    GET_MESSAGES_LIST,
    RECEIVE_MESSAGE,
    SEND_MESSAGE,
    JOIN_USER,
    DISMISS_USER,
    SET_PRESENTED_USERS
} from "./actions.type";

import ApiService from "../../../api/api.service";
import {
    ADD_NEW_MESSAGE, ADD_USER, REMOVE_USER,
    SET_ACTIVE_CHAT_USERS, SET_CHAT_MESSAGES,
    SET_ERROR
} from "./mutations.type";

export default {
    [GET_MESSAGES_LIST](context) {
        return new Promise((resolve, reject) => {
            ApiService.get('/messages')
                .then(({data}) => {
                    context.commit(SET_CHAT_MESSAGES, data);
                    resolve(data);
                })
                .catch(({response}) => {
                    context.commit(SET_ERROR, response.data.error);
                    reject(response);
                });
        });
    },
    [SEND_MESSAGE](context, message) {
        return new Promise((resolve, reject) => {
            ApiService.post('/messages', message)
                .then(({data}) => {
                    context.commit(ADD_NEW_MESSAGE, message);
                    resolve(data);
                })
                .catch(({response}) => {
                    context.commit(SET_ERROR, response.data.error);
                    reject(response);
                });
        });
    },
    [RECEIVE_MESSAGE](context, element) {
        return new Promise((resolve, reject) => {
            context.commit(ADD_NEW_MESSAGE, {
                message: element.message.message,
                user: element.user
            });
            resolve();
        });
    },

    [SET_PRESENTED_USERS](context, users) {
        return new Promise((resolve, reject) => {
            context.commit(SET_ACTIVE_CHAT_USERS, users);
            resolve();
        });
    },
    [JOIN_USER](context, user) {
        return new Promise((resolve, reject) => {
            context.commit(ADD_USER, user);
            resolve();
        });
    },
    [DISMISS_USER](context, user) {
        return new Promise((resolve, reject) => {
            context.commit(REMOVE_USER, user);
            resolve();
        });
    }
};