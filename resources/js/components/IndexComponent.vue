<template>
    
                
                    <button  class="btn btn-success" >
                        <i class="fa fa-thumbs-up"></i>：{{ count }}
                    </button>   
                    
                        
                    
             
</template>
<script>
    export default {
        props: ['post'],
        data() {
            return {
                count: "",
                result: "false" //追加
            }
        },
        mounted () {
            this.hasfavorites();
            this.countfavorites(); //追加
        },
        methods: {
            favorite() {
                axios.get('/posts/' + this.post.id +'/favorites')
                .then(res => {
                    this.result = res.data.result;
                    this.count = res.data.count;
                }).catch(function(error) {
                    console.log(error);
                });
            },
            unfavorite() {
                axios.get('/posts/' + this.post.id +'/unfavorites')
                .then(res => {
                    this.result = res.data.result;
                    this.count = res.data.count;
                }).catch(function(error){
                    console.log(error);
                });
            },
            countfavorites() {
                axios.get('/posts/' + this.post.id +'/countfavorites')
                .then(res => {
                    this.count = res.data;
                }).catch(function(error){
                    console.log(error);
                });
            },
            hasfavorites() { //追加
                axios.get('/posts/' + this.post.id +'/hasfavorites')
                .then(res => {
                    this.result = res.data;
                }).catch(function(error){
                    console.log(error);
                });
            }
        }
    }
</script>