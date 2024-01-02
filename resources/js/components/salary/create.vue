<template>
    <div>
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Salary</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                    <li class="breadcrumb-item">All Employee</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-user-friends me-1"></i>
                        Employees list
                        <router-link class="btn btn-sm btn-info" style="float: right;" id="add_new" :to="{name:'given-salary'}">All Employee</router-link>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="salarypaid" enctype="multipart/form-data"> 
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" readonly id="inputFirstName" v-model="form.name" type="text" placeholder="Enter your first name" />
                                        <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                        <label for="inputFirstName">Full name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" readonly id="inputEmail" v-model="form.email" type="email" placeholder="name@example.com" />
                                        <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                        <label for="inputEmail">Email address</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" readonly id="inputPhone" v-model="form.phone" type="text" placeholder="Phone" />
                                        <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                        <label for="inputPhone">Phone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control" v-model="form.month">
                                            <option disabled selected>Select Month</option>
                                            <option v-for="option in options" :key="option.value" :value="option.value">
                                                {{ option.label }}
                                            </option>
                                        </select>
                                        <small class="text-danger" v-if="errors.month">{{ errors.month[0] }}</small>
                                        <label for="inputMonth">Month</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" readonly id="inputSalary" v-model="form.salary" type="text" placeholder="Salary" />
                                        <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                                        <label for="inputSalary">Salary</label>
                                    </div>
                                </div>
                            </div>

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
      }else{
        let id = this.$route.params.id;
        axios.get('/api/employee/'+id)
        .then(({data}) =>{(this.form = data)})
        .catch(console.log('error'))
      }
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
                  name:'',
                  email:'',
                  month:'',
                  salary:'',
              },
              errors:{}
          }
      },
      methods:{
        salarypaid() {
            let id = this.$route.params.id;
            axios.post('/api/salary/'+id, this.form)
            .then(() => {
                Toast.fire({
                    icon: "success",
                    title: "Salary Paid successfully"
                });
                this.$router.push({ name: 'all-salary' });
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