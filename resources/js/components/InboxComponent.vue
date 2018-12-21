
<template>
    <div>
        <div v-if="conversationNotEmpty">
            <h3 style="text-align: center;" class="display-4">Inbox with {{userInfo.name}}</h3>
            <div v-for="convo in conversation">
                <div class="card" style="max-width: 35rem; margin: 0 auto">
                    <ul class="list-group">
                        <div v-if="convo.sender_id === userNow">
                            <li class="list-group-item" style="float:right; border:none;">
                                <h3 style="text-align: right;">You</h3>
                                <p style="text-align: right;">{{convo.message}}</p>
                                <small style="float: right;">Sent at {{convo.created_at | moment("Do MMMM YYYY, h:mm a")}} <a :href="`/delete-message/${convo.id}`">Unsend</a></small>
                            </li>
                        </div>
                        <div v-else>
                            <li class="list-group-item" style="float:left; border:none;">
                                <div v-if="imageExists">
                                <a href="`/profile/${userInfo.id}`"><img style="width:40px;height:40px;" :src="`${userInfo.image_path}`" class="rounded"></a>
                                </div>
                                <h3>{{userInfo.name}}</h3>{{convo.message}}<br>
                                <small style="float:left">Sent at {{convo.created_at | moment("Do MMMM YYYY, h:mm a")}}</small>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div v-else>
            <h3>You have no messages with this person, start a conversation below!</h3>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            conversation: {
                type: Array
            },
            conversationNotEmpty: {
                type: Boolean
            },
            userInfo: {
                type: Array
            },
            userNow: {
                type: Number
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
