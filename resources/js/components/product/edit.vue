<template>
    <div>
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Products</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                    <li class="breadcrumb-item">Edit product</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-industry"></i>
                        Products list
                        <router-link class="btn btn-sm btn-info" style="float: right;" id="add_new" :to="{name:'all-product'}">All Products</router-link>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="productUpdate" enctype="multipart/form-data"> 
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputproductname" v-model="form.product_name" type="text" placeholder="Enter Peoduct Name" />
                                        <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                                        <label for="inputproductname">Product Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputProductCode" v-model="form.product_code" type="text" placeholder="Enter your first name" />
                                        <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                                        <label for="inputProductCode">Product Code</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control" v-model="form.category_id">
                                            <option disabled selected>Select Category</option>
                                            <option v-for="option in categories" :key="option.id" :value="option.id">
                                                {{ option.category_name }}
                                            </option>
                                        </select>
                                        <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                                        <label for="inputCategory">Category</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control" v-model="form.supplier_id">
                                            <option disabled selected>Select supplier</option>
                                            <option v-for="option in suppliers" :key="option.id" :value="option.id">
                                                {{ option.name }}
                                            </option>
                                        </select>
                                        <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
                                        <label for="inputSupplier">Supplier</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" id="inputroot" v-model="form.root" type="text" placeholder="root" />
                                        <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                                        <label for="inputroot">Root</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputbuying_price" v-model="form.buying_price" type="text" placeholder="Buying Price"/>
                                        <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                                        <label for="inputbuying_price">Buying Price</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputselling_price" v-model="form.selling_price" type="text" placeholder="Selling Price"/>
                                        <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                                        <label for="inputselling_price">Selling Price</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputproduct_quantity" v-model="form.product_quantity" type="number" placeholder="Quantity" />
                                        <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                                        <label for="inputproduct_quantity">Quantity</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputJoiningDate" v-model="form.buying_date" type="Date" placeholder="Buying Date" />
                                        <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
                                        <label for="inputbuying_date">Buying Date</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <input type="file" class="btn btn-info" @change="onFileSelected">
                                                <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <img :src="form.newphoto" style=" height: 50px; width: 50px;">
                                        </div>
                                        <div class="col-md-2">
                                            <img :src="form.image" style=" height: 50px; width: 50px;">
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
        axios.get('/api/category/')
        .then(({data})=>(this.categories = data))
        .catch(error=> {
            console.log(error)
        });
        axios.get('/api/supplier/')
        .then(({data}) => this.suppliers = data)
        .catch(error =>{
            console.log(error)
        })
      }
    },
    mounted(){
        let id = this.$route.params.id;
        axios.get('/api/product/'+id)
        .then(({data}) =>{(this.form = data)})
        .catch(error => console.log(error))
    },
      data(){
          return{
              form:{
                category_id:'',
                supplier_id:'',
                product_name:'',
                product_code:'',
                root:'',
                buying_price:'',
                selling_price:'',
                buying_date:'',
                image:'',
                product_quantity:'',
                newphoto:'',
              },
              errors:{},
              categories:{},
              suppliers:{}
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
        productUpdate() {
            let id = this.$route.params.id;
            axios.patch('/api/product/'+id, this.form)
            .then(() => {
                Toast.fire({
                    icon: "success",
                    title: "Product Edit successfully"
                });
                this.$router.push({ name: 'all-product' });
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