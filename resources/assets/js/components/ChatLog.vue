<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Global chat for all users:
                    <span class="badge pull-right">Users in chat: {{ getActiveUsersCount() }}</span>
                </div>
                <div class="chat-log">
                    <div class="chat-message" v-for="message in this.$store.getters.getMessages">
                        <p>{{message.message}}</p>
                        <small>{{message.user.name}}</small>
                    </div>
                    <div class="empty" v-show="getCurrentMessagesCount() === 0">
                        Nothing here yet!
                    </div>
                </div>
                <div class="chat-composer">
                    <input id='message' type="text" placeholder="Start typing your message..."
                           v-model="messageText" @keyup.enter="sendMessage">
                    <button class="btn btn-primary" @click="sendMessage">Send</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {GET_MESSAGES_LIST} from "../store/modules/chat/actions.type";

    export default {
        mounted () {
            this.$store.dispatch(GET_MESSAGES_LIST);
            this.showMessages();
        },
        data(){
          return {
              messageText: '',
              messages: []
          }
        },
        methods: {
            showMessages(){
                this.messages = this.$store.getters.getMessages;
                return this.messages;
            },
            getActiveUsersCount(){
                return this.$store.getters.getUsers.length;
            },
            getCurrentMessagesCount(){
              return this.$store.getters.getMessages.length;
            },
            sendMessage(){
                this.$emit('messagesent', {
                    message: this.messageText,
                    user: {
                        name: $('.navbar-right .dropdown-toggle').text()
                    }
                });
                this.messageText = '';
            }
        }
    }
</script>
<style lang="css">
    .chat-log .chat-message:nth-child(even){
        background-color: #ccc;
    }
    .empty {
        padding: 1rem;
        text-align: center;
    }
    .chat-message {
        padding: 1rem;
    }
    .chat-message > p {
        margin-bottom: .5rem;
    }
    .chat-composer {
        display: flex;
    }
    .chat-composer input{
        flex: 1 auto
    }
    .chat-composer button{
        border-radius: 0;
    }
</style>