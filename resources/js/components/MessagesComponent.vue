<template>
    <div>
        <div v-if="messagesNotEmpty">
            <h2 class="display-4">Messages</h2>
            <div v-for="inbox in messages">
                <div v-if="inbox.sender_id !== currentUserId">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h2><a :href="`/inbox/${inbox.recipient_id}/${inbox.sender_id}`">
                                <div v-if="inbox.sender_id !== currentUserId">
                                    {{inbox.sender.name}}
                                </div>
                                <div v-else>
                                    {{inbox.recipient.name}}
                                </div>
                            </a></h2>
                            <small>At {{inbox.updated_at | moment("Do MMMM YYYY, h:mm a")}}</small>
                        </li>
                    </ul>
                </div>
                <div v-else>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h2><a :href="`/inbox/${inbox.sender_id}/${inbox.recipient_id}`">
                                <div v-if="inbox.sender_id !== currentUserId">
                                        {{inbox.sender.name}}
                                </div>
                                <div v-else>
                                    {{inbox.recipient.name}}
                                </div>
                                </a></h2>
                            <small>At {{inbox.updated_at | moment("Do MMMM YYYY, h:mm a")}}</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div v-else>
            <h2 class="display-4">No messages yet</h2><br>
        </div>
        <h2 class="display-4">Create New Message</h2>
        <form class="form-group" @submit.prevent="messageSend">
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
            </p>
            To:<br>
            <select v-model="option" class="form-control" name="option">
                <option v-for="option in allUsers" v-if="option.id !== currentUserId" :value="option.id">
                    {{ option.name }}
                </option>
            </select><br>
            Message:<br>
            <textarea class="form-control" v-model="newMessage" name="message"></textarea><br>
            <br>
            <button class="btn btn-primary">Send Message</button>
        </form>
    </div>
</template>


<script>
    export default {
        data() {
           return {
               errors: [],
               newMessage: '',
               option: ''
           }
        },
        props: {
            messages: {
                type: Object
            },
            messagesNotEmpty: {
                type: Boolean
            },
            currentUserId: {
                type: Number
            },
            allUsers: {
                type: Array
            }
        },
        methods: {
          messageSend() {
              this.errors = [];
              if (!this.option || !this.newMessage){
                  if(!this.option) {
                      this.errors.push('You must specify who to send a message to!')
                  }
                  if (!this.newMessage) {
                      this.errors.push('You must supply a message to send!')
                  }
              }else {
                  axios.post("/create-message", {option: this.option, message: this.newMessage}).then(
                      window.location = "/inbox/" + this.currentUserId + "/" + this.option
                  )
              }
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
