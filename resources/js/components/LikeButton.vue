<template>
        <div>
            <i v-if="this.status" class="fas fa-heart red" @click="likePost"></i>
            <i v-else class="far fa-heart red" @click="likePost"></i>
        </div>
</template>

<script>
    export default {
        props:['postId', 'liked'],
        mounted() {
           console.log('Component mounted.')
        },
        data: function() {
            return {
                status: this.liked,
            }
        },
        methods:{
            likePost(){
                axios.post(`/like/${this.postId}`)
                .then(response => {
                    this.status = !this.status;
                });
            }
        }
    }
</script>
<style>
.fa-heart{
    font-size: 50px;
}
 .red{
     color: red;
     fill: red;
 }
</style>
