<template>
    <div>
        <h2 class="display-4">Create a Post</h2>
        <form class="form-group" method="post" @submit.prevent="createPost" enctype="multipart/form-data">
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
            </p>
            Title:<br>
            <input class="form-control" v-model="title" type="text" name="title"><br>
            Body:<br>
            <textarea class="form-control" v-model="body" name="body"></textarea><br>
            <br>
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" name="image" v-on:change="handleFileUpload" ref="image" class="custom-file-input" id="image">
                    <label class="custom-file-label" for="image">Add a Picture:</label>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Create Post</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                errors: [],
                title: '',
                body: '',
                image: ''
            }
        },
        methods: {
            handleFileUpload(){
                this.image = this.$refs.image.files[0];
            },
            createPost() {
                this.errors = [];
                if (!this.title || !this.body){
                    if(!this.title) {
                        this.errors.push('You must have a title!')
                    }
                    if (!this.body) {
                        this.errors.push('You cannot leave the body empty!')
                    }
                }else {
                    let formData = new FormData();

                    formData.append('title', this.title);
                    formData.append('body', this.body);
                    formData.append('image', this.image);


                    axios.post("/store", formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(
                        window.location = "/posts"
                    )



                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
