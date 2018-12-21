<template>
    <div>
        <div v-if="singlePost">
            <h2 class="display-4">{{post.title}}</h2>
            <div v-if="imageExist">
            <img class="img-fluid" :src="`/${post.image_path}`">
            </div>
            <p class="lead">{{post.body}}</p>
            <small>Written by <a :href="`/profile/${post.author_id}`">{{post.author_name}}</a> on {{ post.created_at | moment("Do MMMM YYYY") }}</small>
        </div>
        <div v-else>
        <div v-if="posted">
            <h3>Here are {{ userName }}'s posts:</h3><br>
            <ul class="list-group">
                <li class="list-group-item" v-for="post in allPosts">
                    <small>Written at {{ post.created_at | moment("Do MMMM YYYY, h:mm a") }}</small><br>
                    <h2><a :href="`../post/${post.id}`">{{post.title}}</a></h2>
                </li>
            </ul>
        </div>
        <div v-else>
            <br><h2 class="lead">{{userName}} doesn't have any posts yet!</h2>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            allPosts: {
                type: Array
            },
            posted: {
                type: Boolean
            },
            userName: {
                type: String
            },
            post: {
                type: Object
            },
            imageExist: {
                type: Boolean
            },
            singlePost: {
                type: Boolean
            }
        },
        mounted() {
            console.log('Post Component mounted.')
        }
    }
</script>
