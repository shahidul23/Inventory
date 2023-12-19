<template>
    <div>
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Employee</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                    <li class="breadcrumb-item">All Employee</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-users me-1"></i>
                        All Employee List
                        <router-link class="btn btn-sm btn-info" style="float: right;" id="add_new" to="/add-employee">Add New</router-link>
                    </div>
                    <div class="card-body">
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
                 
              },
              errors:{}
          }
      },
     
  }
  </script>
  
  <style scoped>
  
  </style>