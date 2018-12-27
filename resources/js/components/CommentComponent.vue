<template>
    <div>
        <div v-if="hasCommented">
            <h3>Comments:</h3><br>
            <ul class="list-group">
                <li class="list-group-item" v-for="comment in comments">
                    <small>Written by <a :href="`../profile/${comment.user_id}`">{{ comment.user_name }}</a> on {{ comment.created_at | moment("Do MMMM YYYY") }}</small><br>
                    {{ comment.comment }}
                </li>
            </ul>
        </div>

        <div v-if="notUsersPost">
            <h3>Add a comment:</h3>
            <form class="form-group" @submit.prevent="addComment">

                <p v-if="errors.length">
                    <b style="color: red;">You cannot leave the comment box empty!</b>
                  </p>

                <textarea class="form-control" v-model="newComment" name="newComment"></textarea><br>
                <button class="btn btn-primary">Add Comment</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                errors: [],
                newComment: '',
                comments: '',
                hasCommented: null
            }
        },
        props: {
            allComments: {
                type: Array
            },
            commented: {
                type: Boolean
            },
            notUsersPost: {                                                                                                  
                type: Boolean
            },
            post: {
                type: Object
            },
            user: {
                type: Object
            }
        },
        methods: {
            addComment() {
                if (!this.newComment) {
                    this.errors.push('5');
                } else {
                    axios.post("/comment/" + this.post.id, {comment: this.newComment}).then(
                        this.comments.push({
                            comment: this.newComment,
                            created_at: new Date(),
                            user_name: this.user.name,
                            user_id: this.user.id})

                    )
                this.newComment = '';
                this.errors = [];
                this.hasCommented = true;
                }
            }
        },
        mounted() {
            this.hasCommented = this.commented
            this.comments = this.allComments
            console.log('Comment Component mounted.')
        }
    }
</script>
