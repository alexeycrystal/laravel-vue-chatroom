import {
    ADD_NEW_MESSAGE,
    ADD_USER,
    REMOVE_USER,
    SET_ACTIVE_CHAT_USERS,
    SET_ERROR,
    SET_CHAT_MESSAGES} from "./mutations.type";

export default {
    [SET_ACTIVE_CHAT_USERS](state, users) {
        state.usersInRoom = users;
    },
    [ADD_USER](state, user){
        state.usersInRoom[user.id] = user;
    },
    [REMOVE_USER](state, user){
        state.usersInRoom.splice(user.id, 1);
    },

    [SET_CHAT_MESSAGES](state, messages){
        state.messages = messages;
    },
    [ADD_NEW_MESSAGE](state,message){
        state.messages.push(message);
    },

    [SET_ERROR](state, error) {
        state.errors.push(error);
    },
};