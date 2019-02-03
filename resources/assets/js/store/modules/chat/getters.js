export default {
    getUsers(state){
        return state.usersInRoom;
    },
    getMessages(state){
        return state.messages;
    },
    getErrors(state){
        return state.errors;
    }
};