<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Forget Password</h3></div>
                        <div class="card-body">
                            <form>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputEmail" v-model="form.email" type="email" placeholder="name@example.com" />
                                    <label for="inputEmail">Existing  Email address</label>
                                </div>
                                <div class="form-check mb-3">
                                    <!-- <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                    <label class="form-check-label" for="inputRememberPassword">Remember Password</label> -->
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <button type="submit" class="btn btn-primary btn-block">Forget Password</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <router-link class="small" to="/login">Back to Login</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </template>
  
<script>
export default {
    created(){
    if(User.loggedIn())
    this.$router.push({name: '/'})
  },
    data(){
        return{
            form:{
                email:null
            },
            errors:{}
        }
    }
}
</script>
  
  <style scoped>
  
  </style>