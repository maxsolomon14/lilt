<template>
    <div>
        <div v-if="commented">
            <h3>Comments:</h3><br>
            <ul class="list-group">
                <li class="list-group-item" v-for="comment in allComments">
                    <small>Written by <a href="/">{{ comment.user_name }}</a> on {{ comment.created_at }}</small><br>
                    {{ comment.comment }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            allComments: {
                type: Array
            },
            commented: {
                type: Boolean
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
