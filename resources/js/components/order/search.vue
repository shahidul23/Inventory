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
                                            <input type="date" class="form-control" id="inputsearch" required v-model="date"/>
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
                                            <select class="form-control" v-model="month">
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
                <div class="row" id="tbday" style="display: none;">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                Order Search By Day
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered simpleDatatables" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
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
                                            <td>{{ detail.order_day }}</td>
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
                <div class="row" id="tbmonth" style="display: none;">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                Order Search By Months
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered simpleDatatables" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Month</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(detail,index) in months" :key="index">
                                            <td>{{ detail.order_day }}</td>
                                            <td>{{ detail.order_month }}</td>
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
            date:'',
            month:'',
            details:{},
            errors:{},
            months:{},
          }
      },
      methods:{
        SearchDate(){
            $("#tbday").css("display","");
            this.daysearchTable();
        },
        SearchMonth(){
            $("#tbmonth").css("display","");
            this.monthsearchTable();
        },
        daysearchTable(){
            axios.get('/api/search/date/'+this.date)
            .then(({data}) =>{
                this.details = data;
            })
            .catch(console.log('error'));
        },
        monthsearchTable(){
            axios.get('/api/search/month/'+this.month)
            .then(({data}) =>{
                this.months = data;
            })
            .catch(console.log('error'));
        }
      }
  }
  </script>
  
  <style scoped>

  </style>