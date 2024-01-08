<template>
    <div>
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Settings</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                    <li class="breadcrumb-item">Create Settings</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa-solid fa-gear"></i>
                        Settings
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="settingInsert" enctype="multipart/form-data"> 
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputFirstName" v-model="form.vat" type="number"/>
                                        <small class="text-danger" v-if="errors.vat">{{ errors.vat[0] }}</small>
                                        <label for="inputFirstName">Vat</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" id="inputEmail" v-model="form.email" type="email"/>
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
                                        <textarea class="form-control" id="inputAddress" v-model="form.address" type="text"></textarea>
                                        <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                        <label for="inputAddress">Address</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputNidNumber" v-model="form.favicon" type="text"/>
                                        <small class="text-danger" v-if="errors.favicon">{{ errors.favicon[0] }}</small>
                                        <label for="inputNidNumber">favicon</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="file" class="btn btn-info" @change="onFileSelected">
                                                <small class="text-danger" v-if="errors.logo">{{ errors.logo[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <img :src="form.logo" id="logo_em" style=" height: 150px; width: 150px;">
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
      if(!User.loggedIn())
      this.$router.push({name: '/login'})
  
    },
      data(){
          return{
              form:{
                vat:'',
                logo:'',
                favicon:'',
                phone:'',
                email:'',
                address:'',
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
                    this.form.logo = event.target.result
                    //console.log(event.target.result)
                };
                reader.readAsDataURL(file);
            }
        },
        settingInsert() {
            axios.post('/api/extra', this.form)
            .then(() => {
                Toast.fire({
                    icon: "success",
                    title: "Setting inserted successfully"
                });
                this.$router.push({ name: '/' });
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            });
        }
      }
  }
  </script>
  
  <style scoped>
  #logo_em{
    height: 150px;
    width: 150px;
    border-radius: 10%;
  }
  #logo_em:hover{
    transition: all 1s ease-in-out;
    border-radius: 30%;
  }

  </style>