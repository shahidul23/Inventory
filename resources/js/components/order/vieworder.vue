<template>
    <div>
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Orders</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                    <li class="breadcrumb-item">Orders Details</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-industry"></i>
                        Orders Details
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <ul class="list-group">
                                    <li class="list-group-item bg-info text-white text-center"><strong>Customer Details</strong></li>
                                </ul>    
                            </div>
                            <div class="col-lg-6 col-md-6 col-6">
                                <ul class="list-group">
                                    <li class="list-group-item">Name: {{ orders.name }}</li>
                                    <li class="list-group-item">Phone: {{ orders.phone }}</li>
                                    <li class="list-group-item">Email: {{ orders.email }}</li>
                                    <li class="list-group-item">Address: {{ orders.address }}</li>
                                    <li class="list-group-item">Date: {{ orders.order_day }}</li>
                                    <li class="list-group-item">Quentity: {{ orders.qty }}</li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6">
                                <ul class="list-group">
                                    <li class="list-group-item">Total: {{ orders.total }} Tk</li>
                                    <li class="list-group-item">Sub Total: {{ orders.subTotal }} Tk</li>
                                    <li class="list-group-item">Pay: {{ orders.pay }} Tk</li>
                                    <li class="list-group-item">Due: {{ orders.due }} Tk</li>
                                    <li class="list-group-item">Vats: {{ orders.vat }} %</li>
                                    <li class="list-group-item">PayBy: {{ orders.payby }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row container">
                    <div class="card col-lg-12">
                        <div class="card-header">
                            <i class="fas fa-industry"></i>
                                Orders Details
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Quantity</th>
                                                <th>Unit price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(detail,index) in details" :key="index">
                                                <td><img :src="detail.image" alt="Product Photo" id="em_photo" style="height: 40px; width: 40px;"></td>
                                                <td>{{ detail.product_name }}</td>
                                                <td>{{ detail.product_code }}</td>
                                                <td>{{ detail.pro_qty }}</td>
                                                <td>{{ detail.pro_price }}</td>
                                                <td>{{ detail.sub_total }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
      if(!User.loggedIn()){
        this.$router.push({name: '/login'})
      }else{
        let id = this.$route.params.id;
        axios.get('/api/order/details/'+id)
        .then(({data}) =>{
            this.orders = data;
        })
        .catch(console.log('error'));

        axios.get('/api/order/detailsall/'+id)
        .then(({data}) =>{
            this.details = data;
        })
        .catch(console.log('error'));
      }
    },
      data(){
          return{
            //   categories:{},
            //   suppliers:{},
            orders:{},
            details:{}  
          }
      },
      methods:{
        
      }
  }
  </script>
  
  <style scoped>
  
  </style>