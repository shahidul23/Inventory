<template>
    <div>
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Categories</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                    <li class="breadcrumb-item">Create Category</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-industry"></i>
                        Category list
                        <router-link class="btn btn-sm btn-info" style="float: right;" id="add_new" to="/all-categoty">All Categories</router-link>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="CategoryInsert"> 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputcategory_name" v-model="form.category_name" type="text" placeholder="Enter your first name" />
                                        <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
                                        <label for="inputcategory_name">Category Name</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </main>
    </div>
  </template>
  
  <script>
  export default {
      created(){
      if(!User.loggedIn())
      this.$router.push({name: '/login'})
  
    },
      data(){
          return{
              form:{
                category_name:'',
              },
              errors:{}
          }
      },
      methods:{
        CategoryInsert() {
            axios.post('/api/category', this.form)
            .then(() => {
                Toast.fire({
                    icon: "success",
                    title: "Category inserted successfully"
                });
                this.$router.push({ name: 'all-categoty' });
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            });
        }
      }
  }
  </script>
  
  <style scoped>
  
  </style>