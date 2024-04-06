<template>
    <div>
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Expenses</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                    <li class="breadcrumb-item">Create Expanse</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-industry"></i>
                        Expanses list
                        <router-link class="btn btn-sm btn-info" style="float: right;" id="add_new" :to="{name:'all-expense'}">All Expanse</router-link>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="expenseInsert"> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <textarea class="form-control" id="inputExpense" v-model="form.details" type="text">

                                        </textarea>
                                        <!-- <input class="form-control" id="inputExpense" v-model="form.details" type="text"/> -->
                                        <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
                                        <label for="inputExpense">Expense Details</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputamount" v-model="form.amount" type="number"/>
                                        <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                                        <label for="inputamount">Amount</label>
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
      if(!User.loggedIn()){
        this.$router.push({name: '/login'})
      }
    },
      data(){
          return{
              form:{
                details:'',
                amount:'',
              },
              errors:{}
          }
      },
      methods:{
        expenseInsert() {
            axios.post('/api/expense', this.form)
            .then(() => {
                Toast.fire({
                    icon: "success",
                    title: "Expense inserted successfully"
                });
                this.$router.push({ name: 'all-expense' });
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