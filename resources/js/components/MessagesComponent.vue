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
    </div>
</template>

<script>
    export default {
        props: {
            messages: {
                type: Array
            },
            messagesNotEmpty: {
                type: Boolean
            },
            currentUserId: {
                type: Number
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
