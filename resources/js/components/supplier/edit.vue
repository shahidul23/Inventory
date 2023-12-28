<template>
    <div>
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Supplier</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                    <li class="breadcrumb-item">Edit Supplier</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-user-friends me-1"></i>
                        Supplier list
                        <router-link class="btn btn-sm btn-info" style="float: right;" id="add_new" :to="{name:'all-supplier'}">All Employee</router-link>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="supplierupdate" enctype="multipart/form-data"> 
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputFirstName" v-model="form.name" type="text" placeholder="Enter your first name" />
                                        <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                        <label for="inputFirstName">Full name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" id="inputEmail" v-model="form.email" type="email" placeholder="name@example.com" />
                                        <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                        <label for="inputEmail">Email address</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" id="inputPhone" v-model="form.phone" type="text" placeholder="Phone" />
                                        <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                        <label for="inputPhone">Phone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputAddress" v-model="form.address" type="text" placeholder="Create a address"/>
                                        <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                        <label for="inputAddress">Address</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control" v-model="form.gender">
                                            <option disabled selected>Select Gender</option>
                                            <option v-for="option in options" :key="option.value" :value="option.value">
                                                {{ option.label }}
                                            </option>
                                        </select>
                                        <small class="text-danger" v-if="errors.gender">{{ errors.gender[0] }}</small>
                                        <label for="inputGender">Gender</label>
                                    </div>
                                </div> 
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputShopname" v-model="form.shopname" type="text" placeholder="Create a address"/>
                                        <small class="text-danger" v-if="errors.shopname">{{ errors.shopname[0] }}</small>
                                        <label for="inputShopname">Shop Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="file" class="btn btn-info" @change="onFileSelected">
                                                <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <img :src="form.newphoto" style=" height: 50px; width: 50px;">
                                        </div>
                                        <div class="col-md-2">
                                            <img :src="form.photo" style=" height: 50px; width: 50px;">
                                        </div>
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
        axios.get('/api/supplier/'+id)
        .then(({data}) =>{(this.form = data)})
        .catch(console.log('error'))
      }
    },
      data(){
          return{
            options: [
                    { value: 'Male', label: 'Male' },
                    { value: 'Female', label: 'Female' },
                    { value: 'Other', label: 'Other' }
                ],
              form:{
                  name:'',
                  email:'',
                  address:'',
                  gender:'',
                  shopname:'',
                  photo:'',
                  newphoto:'',
                  phone:'',
              },
              errors:{}
          }
      },
      methods:{
        onFileSelected(event){
            let file = event.target.files[0];
            if(file.size > 1048770){
                Toast.fire({
                    icon: "error",
                    title: "Upload Image less then 1mb !"
                    })
            }else{
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.newphoto = event.target.result
                    //console.log(event.target.result)
                };
                reader.readAsDataURL(file);
            }
        },
        supplierupdate() {
            let id = this.$route.params.id;
            axios.patch('/api/supplier/'+id, this.form)
            .then(() => {
                Toast.fire({
                    icon: "success",
                    title: "Supplier Edit successfully"
                });
                this.$router.push({ name: 'all-supplier' });
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