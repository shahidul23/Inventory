<template>
    <div>
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <label> Today Sell</label>
                                    </div>
                                    <div class="col-lg-12 col-md-12" >
                                        <strong style="float: right;">{{ todaysell }} Tk</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link">Today Sell</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <label> Today Expance</label>
                                    </div>
                                    <div class="col-lg-12 col-md-12" >
                                        <strong style="float: right;">{{ expense }} Tk</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link">Today Expance</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <label> Today income</label>
                                    </div>
                                    <div class="col-lg-12 col-md-12" >
                                        <strong style="float: right;">{{ income }} Tk</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link">Today income</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <label> Today Due</label>
                                    </div>
                                    <div class="col-lg-12 col-md-12" >
                                        <strong style="float: right;">{{ due }} Tk</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link">Today Due</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Product Stock Out
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered simpleDatatables" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Sellig Price</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product,index) in products" :key="index">
                                    <td>{{ index+1 }}</td>
                                    <td><img :src="product.image" alt="Product Photo" id="em_photo" style="height: 40px; width: 40px;"></td>
                                    <td>{{ product.product_name }}</td>
                                    <td>{{ product.product_code }}</td>
                                    <td>{{ product.selling_price }}</td>
                                    <td v-if="product.product_quantity >=1"><span class="btn btn-sm btn-success">Availble</span></td>
                                    <td v-else><span class="btn btn-sm btn-danger">Stock Out</span> </td>
                                    <td>{{ product.product_quantity }}</td>
                                </tr>
                            </tbody>
                        </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
  </template>
  
<script>
import User from '../Helpers/User';

export default {
    created(){
        if(!User.loggedIn()){
            this.$router.push({name: 'login'})
        }else{
            this.todaySell();
            this.todayincome();
            this.todayDue();
            this.todayExpanse();
            this.productsStockOut();
        }
    },
    data(){
        return{
            todaysell:'',
            income:'',
            expense:'',
            due:'',
            products:''
        }
    },
    methods:{
        todaySell(){
            axios.get('/api/today/sell')
            .then(({data}) =>{
                this.todaysell = data;
            })
            .catch(console.log('error'))
        },
        todayincome(){
            axios.get('/api/today/income')
            .then(({data}) =>{
                this.income = data;
            })
            .catch(console.log('error'))
        },
        todayDue(){
            axios.get('/api/today/due')
            .then(({data}) =>{
                this.due = data;
            })
            .catch(console.log('error'))
        },
        todayExpanse(){
            axios.get('/api/today/expanse')
            .then(({data}) =>{
                this.expense = data;
            })
            .catch(console.log('error'))
        },
        productsStockOut(){
            axios.get('/api/stock-out')
            .then(({data}) =>{
                this.products = data;
            })
            .catch(console.log('error'))
        },
    },
    
}
</script>
  
  <style scoped>
  th{
        text-align: center;
        font-weight: bold;
    }
    td{
        text-align: center;
    }
  </style>