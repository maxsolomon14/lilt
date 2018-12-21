<template>
    <div>
        <div v-if="elf">
            {{ usersPost }}
        </div>
        <div v-else>
            <div v-if="likedValue">
                <p>{{this.likeMessage}}</p> <a @click="unlike" class="btn btn-secondary" role="button">Unlike</a>
            </div>
            <div v-else>
                <p>{{this.likeMessage}}</p> <a @click="like" class="btn btn-primary" role="button">Like</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                likedValue: null
            }
        },
        props: {
            usersPost: {
                type: String
            },
            elf: {
                type: Boolean
            },
            hasLiked: {
                type: Boolean
            },
            likesAmount: {
                type: Number
            },
            postUser: {
                type: String
            },
            postId: {
                type: Number
            },
            userId: {
                type: Number
            }
        },
        methods: {
            like() {
                axios.get("/like/" + this.postId + "/" + this.userId).then (
                        this.likedValue = true,
                        this.likes = (this.likes + 1)
                )
            },
            unlike(){
                axios.get("/unlike/" + this.userId + "/" + this.postId).then (
                    this.likedValue = false,
                    this.likes = (this.likes - 1)
                )
            }
        },
        computed: {
            likeMessage: function () {
                if (this.likedValue === false) {
                    if (this.likes < 1) {
                        return "Be the first to like " + this.postUser + "'s post!`"
                    }
                    if (this.likes === 1) {
                        return this.postUser + "'s post has 1 like!"
                    }
                    if (this.likes > 1) {
                        return this.postUser + "'s post has " + this.likes + " likes!"
                    }
                }
                if (this.likes < 1) {
                    return "Be the first to like " + this.postUser + "'s post!"
                }
                if (this.likes === 1) {
                    return "You are the only person to like" + this.postUser + "'s post!"
                }
                if (this.likes === 2) {
                    return "You and 1 other person have liked " + this.postUser + "'s post!"
                }
                if (this.likes > 2) {
                    return "You and " + (this.likes - 1) + " other people have liked " + this.postUser + "'s post!"
                }
            },
        },
        mounted() {
            this.likedValue = this.hasLiked
            this.likes = this.likesAmount
            console.log('Like Component mounted.')
        }
    }
</script>

