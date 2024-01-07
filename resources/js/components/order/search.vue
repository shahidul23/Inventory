<template>
    <div>
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Search</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                    <li class="breadcrumb-item">Search Orders</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-industry"></i>
                        Search Orders
                        <router-link class="btn btn-sm btn-info" style="float: right;" id="add_new" :to="{name:'orser'}">Today Order</router-link>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <form @submit.prevent="SearchDate"> 
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input type="date" class="form-control" id="inputsearch" required v-model="form.date"/>
                                            <label for="inputsearch">Search By Date</label>
                                        </div>
                                    </div><br>
                                    <button type="submit" class="btn btn-success">Search</button>
                                </div> 
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <form @submit.prevent="SearchMonth"> 
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <select class="form-control" v-model="form.month">
                                                <option disabled selected>Select Month</option>
                                                <option v-for="option in options" :key="option.value" :value="option.value">
                                                    {{ option.label }}
                                                </option>
                                            </select>
                                            <label for="inputMonth">Month</label>
                                        </div>
                                    </div><br>
                                    <button type="submit" class="btn btn-success">Search</button>
                                </div>
                            </form>
                        </div>
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
            options: [
                    { value: 'January', label: 'January' },
                    { value: 'February', label: 'February' },
                    { value: 'March', label: 'March' },
                    { value: 'April', label: 'April' },
                    { value: 'May', label: 'May' },
                    { value: 'June', label: 'June' },
                    { value: 'July', label: 'July' },
                    { value: 'August', label: 'August' },
                    { value: 'September', label: 'September' },
                    { value: 'October', label: 'October' },
                    { value: 'November ', label: 'November' },
                    { value: 'December', label: 'December' }
                ],
            form:{
                date:'',
                month:''
            } , 
            errors:{}
          }
      },
      methods:{
        SearchDate(){
            axios.post('/api/search/date', this.form)
            .then(() =>{

            })
            .catch(console.log('error'));
        },
        SearchMonth(){
            axios.post('/api/search/month', this.form)
            .then(() =>{

            })
            .catch(console.log('error'));
        }
      }
  }
  </script>
  
  <style scoped>
  
  </style>