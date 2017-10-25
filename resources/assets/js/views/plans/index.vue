<template>
<div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-7 second-row" id="secondDiv" style="padding-top: 60px;">
      <!--search form-->
        <section class="middle-coumn background-primary" style="padding-bottom: 60px;">
          <h4>Choose a plan</h4>
        <div v-show="loading" style="height:100vh;"><img src="loading-circle.svg" style="position: fixed; top:35%; left:42%;"></div> 
             <div class="container-fluid row" v-show="loaded">
              
            </div>
        <div class="text-center"> 
             <!--paginate links-->
        </div>
        </section>
    </div> 
</div>
</template>


<script>
import moment from 'moment';
var csr;
    export default {
        data() {
            return {
                startups: [],
                loading: '',
                loaded: '',
                countstartups: '',
                auth: ''
            }
        },
        created() {  //fire off ajax request]
            this.loading = false,
            this.loaded = true,
            self = this 
            axios.post('/list-items')
            .then(function(response) { 
                self.auth = response.data,
                self.loading = false,
                self.loaded = true,
                csr = document.getElementById('csrf').innerHTML;
                document.getElementById('logout_csrf').innerHTML= csr;
                }); 
        },
        methods: {
            
        }
    }

</script>

