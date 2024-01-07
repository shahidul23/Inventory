<template>
    <div>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Orders</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                <li class="breadcrumb-item active">Today Order</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Orders Table
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-group row">
                            <div class="col-sm-1">
                                <select class="form-control" v-model="itemPerpage"  @click="changeCurrentPage">
                                    <option selected id="show" value="5">show</option>
                                    <option id="show" value="10">10</option>
                                    <option id="show" value="20">20</option>
                                    <option id="show" value="50">50</option>
                                    <option id="show" value="100">100</option>
                                </select>

                            </div>
                            <div class="col-sm-8">
                                
                            </div>
                            <div class="col-sm-3">
                                <input type="text" v-model="searchTerm" class="form-control">
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Total Amount</th>
                                    <th>Pay</th>
                                    <th>Due</th>
                                    <th>PayBy</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(order,index) in VisiblePost" :key="index">
                                    <td>{{ order.name }}</td>
                                    <td>{{ order.total }}</td>
                                    <td>{{ order.pay }}</td>
                                    <td>{{ order.due }}</td>
                                    <td>{{ order.payby }}</td>
                                    <td>
                                        <router-link :to="{ name: 'view-order', params:{id: order.id} }" class="btn btn-sm btn-info"><i class="fa-solid fa-eye"></i></router-link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <nav aria-label="Page navigation" style="float: left;">
                                    <ul class="pagination justify-center-center mt-4">
                                        <li class="page-item">
                                            <p class="fw-normal">Total Data : {{ this.Orders.length }} entries </p>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-md-10">
                                <nav aria-label="Page navigation" style="float: right;">
                                    <ul class="pagination justify-center-center mt-4">
                                        <li class="page-item">
                                            <a class="page-link"
                                            @click="changePage(currentPage - 1)"
                                            :disabled="currentPage === 1"
                                            >
                                            Previous
                                        </a>
                                        </li>
                                        <li class="page-item"
                                        v-for="pageNumber in VisiblePageNumber"
                                        :key="pageNumber"
                                        :class="{ active:currentPage == pageNumber || 
                                        pageNumber === '....'}">
                                        <a class="page-link"
                                            @click="changePage(pageNumber)">
                                            {{pageNumber}}
                                        </a>

                                        </li>
                                        <li class="page-item">
                                            <a class="page-link"
                                            @click="changePage(currentPage + 1)"
                                            :disabled="currentPage === 1"
                                            >
                                            Previous
                                        </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </template>
    <script>
        export default {
        mounted() {
            if (!User.loggedIn()) {
                this.$router.push('/login');
            } else {
                this.allOrder();
            }
        },
        data() {
            return {
                Orders: [],
                searchTerm:'',
                //pagination
                itemPerpage:5,
                currentPage:1,
            };
        },
        computed:{
            filterSearch(){
                const searchTermLowerCase = this.searchTerm.toLowerCase();
                return this.Orders.filter(Order =>{
                    const nameMatch = Order.name.toLowerCase().includes(searchTermLowerCase);
                    const dueMatch = Order.due.toString().includes(searchTermLowerCase);
                    const payMatch = Order.pay.toString().includes(searchTermLowerCase);
                    const paybyMatch = Order.payby.toLowerCase().includes(searchTermLowerCase);
                    const amountMatch = Order.total.toString().includes(searchTermLowerCase);

                    return nameMatch || amountMatch || dueMatch || payMatch || paybyMatch;
                });
            },
             //pagination
             VisiblePost(){
                const startPage = (this.currentPage - 1) * this.itemPerpage;
                const endpage = startPage + this.itemPerpage;
                return this.filterSearch.slice(startPage,endpage)
            },
            totalPages(){
                return Math.ceil(this.filterSearch.length / this.itemPerpage)
            },
            VisiblePageNumber(){
                let pageNumbers = []
                if(this.totalPages <= 7){
                    for(let i = 1; i<=this.totalPages; i++){
                        pageNumbers.push(i)
                    }
                }else{
                    if(this.currentPage <= 4){
                        pageNumbers = [1,2,3,4,5,"......",this.totalPages];
                    }else if(this.currentPage >= this.totalPages - 3){
                        pageNumbers = [1,"......",this.totalPages - 4,this.totalPages - 3,
                        this.totalPages - 2,this.totalPages - 1,this.totalPages]
                    }else{
                        pageNumbers = [1,"......",this.currentPage - 1, this.currentPage,
                        this.currentPage + 1,"......",this.totalPages]
                    }
                }
                return pageNumbers;
            }
        },
        methods: {
            allOrder() {
                axios.get('/api/orders/')
                .then(response => {
                this.Orders = response.data;
                })
                .catch(error => console.error(error));
            },
            //pagination
            changePage(page){
                if(page >= 1 && page <= this.totalPages){
                    this.currentPage = page
                }
            },
            changeCurrentPage(){
                this. currentPage = 1 
            }
        }
    };
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