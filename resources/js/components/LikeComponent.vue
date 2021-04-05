<template>
    <div class="container">
        <div class="row justify-content-center mt-1">
            <div class="col-md-12">
                <div>
                    
                    <button @click="unfavorite()" class="btn btn-danger" v-if="result">
                        <i class="fa fa-thumbs-up"></i>：{{ count }}
                    </button>
                        
                    <button @click="favorite()" class="btn btn-success" v-else>
                        <i class="fa fa-thumbs-up"></i>：{{ count }}
                    </button>
                   
                </div>
            </div>
        </div>
    </div>
</template>
<script>
Vue.config.devtools = true;
    export default {
        props: ['post'],
        data() {
            return {
                count: "",
                result: "false" //追加
            }
        },
        mounted () {
            console.log(this.post);
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