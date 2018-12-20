<template>
    <div>
        <div v-if="postsExist">
            <ul class="list-group">
                <li class="list-group-item" v-for="post in allPosts.data">
                    <div v-if="post.user.image_path">
                        <a :href="`/profile/${post.author_id}`"><img style="width:40px;height:40px;" :src="`${post.user.image_path}`" class="rounded"></a>
                    </div>
                    <h2><a :href="`/post/${post.id}`">{{post.title}}</a></h2>
                    <small>Written by <a :href="`/profile/${post.author_id}`">{{post.author_name}}</a> at {{ post.created_at | moment("Do MMMM YYYY, h:mm a") }}</small>
                </li>
            </ul>
        </div>
        <div v-else>
            <h2>No posts :(</h2>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            allPosts: {
                type: Array
            },
            postsExist: {
                type: Boolean
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
