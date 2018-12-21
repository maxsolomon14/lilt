<template>
    <div>
        <div class="jumbotron">
            <h2 class="display-4">Profiles</h2>
            <div v-for="profile in profiles">
                <div v-if="profile.id !== userNow">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <img style="width:40px;height:40px;" :src="`${image}`" class="rounded">
                            <p class="lead"><a :href="`/profile/${profile.id}`">{{profile.name}}</a> has been a member since {{profile.created_at | moment("MMMM YYYY")}}.
                            {{profile.name}}
                            <template v-if="profile.posts.length < 1">
                             hasn't made any posts.
                            </template>
                            <template v-else>
                             has made {{profile.posts.length}} posts.
                             </template>
                             </p>
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
            profiles: {
                type: Array
            },
            image: {
                type: String
            },
            userNow: {
                type: Number
            }
        },
        mounted() {
            console.log('Profiles Component mounted.')
        }
    }
</script>
