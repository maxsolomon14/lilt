<template>
    <div>
        <div v-if="elf">
            {{ usersPost }}
        </div>
        <div v-else v-html="logic">
            {{ logic }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            usersPost: {
                type: String
            },
            logic: {
                type: String
            },
            elf: {
                type: Boolean
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
