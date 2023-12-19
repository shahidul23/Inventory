<template>
  <div>
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-7">
                  <div class="card shadow-lg border-0 rounded-lg mt-5">
                      <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                      <div class="card-body">
                          <form @submit.prevent="register">
                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control" id="inputFirstName" v-model="form.f_name" type="text" placeholder="Enter your first name" />
                                          <small class="text-danger" v-if="errors.f_name">{{ errors.f_name[0] }}</small>
                                          <label for="inputFirstName">First name</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating">
                                          <input class="form-control" id="inputLastName" v-model="form.l_name" type="text" placeholder="Enter your last name" />
                                          <small class="text-danger" v-if="errors.l_name">{{ errors.l_name[0] }}</small>
                                          <label for="inputLastName">Last name</label>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-floating mb-3">
                                  <input class="form-control" id="inputEmail" v-model="form.email" type="email" placeholder="name@example.com" />
                                  <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                  <label for="inputEmail">Email address</label>
                              </div>
                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control" id="inputPassword" v-model="form.password" type="password" placeholder="Create a password" />
                                          <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                                          <label for="inputPassword">Password</label>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input class="form-control" id="inputPasswordConfirm" v-model="form.password_confirmation" type="password" placeholder="Confirm password" />
                                          <small class="text-danger" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</small>
                                          <label for="inputPasswordConfirm">Confirm Password</label>
                                      </div>
                                  </div>
                              </div>
                              <div class="mt-4 mb-0">
                                  
                                  <div class="d-grid">
                                    
                                    <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                      <div class="card-footer text-center py-3">
                          <router-link class="small" to="/login">Already Have an account? Go to login</router-link>
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
                f_name:null,
                l_name:null,
                email:null,
                password:null,
                password_confirmation:null
            },
            errors:{}
        }
    }, 
    methods:{
    register(){
      axios.post('/api/auth/register',this.form)
      .then(res => {
        User.responseAfterLogin(res)
        Toast.fire({
          icon: "success",
          title: "Signed in successfully"
        });
        this.$router.push({name: '/'})
      })
      .catch(error => this.errors = error.response.data.errors)
    }
  }
}
</script>

<style scoped>

</style>