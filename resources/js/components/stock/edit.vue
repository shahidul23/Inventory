<template>
    <div>
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">STOCK</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                    <li class="breadcrumb-item">Edit stock</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <form @submit.prevent="stockUpdate"> 
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputproduct_quantity" v-model="form.product_quantity" type="number" placeholder="Quantity" />
                                        <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                                        <label for="inputproduct_quantity">Quantity</label>
                                    </div>
                                </div>
                            </div><br>
                            <button type="submit" class="btn btn-success">Update</button>
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
        axios.get('/api/product/'+id)
        .then(({data}) =>{(this.form = data)})
        .catch(error => console.log(error))
      }
    },
      data(){
          return{
              form:{
                product_quantity:'',
              },
              errors:{},
          }
      },
      methods:{
        stockUpdate() {
            let id = this.$route.params.id;
            axios.post('/api/stock/edit/'+id, this.form)
            .then(() => {
                Toast.fire({
                    icon: "success",
                    title: "Stock Edit successfully"
                });
                this.$router.push({ name: 'stock' });
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