<template>
    <div>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tables</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><router-link :to="{name:'/'}">Dashboard</router-link></li>
                <li class="breadcrumb-item active">Products list</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Add Products
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
                        <table class="table table-bordered simpleDatatables" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Category</th>
                                    <th>Sellig Price</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product,index) in VisiblePost" :key="index">
                                    <td>{{ index+1 }}</td>
                                    <td><img :src="product.image" alt="Product Photo" id="em_photo" style="height: 40px; width: 40px;"></td>
                                    <td>{{ product.product_name }}</td>
                                    <td>{{ product.product_code }}</td>
                                    <td>{{ product.category_name }}</td>
                                    <td>{{ product.selling_price }}</td>
                                    <td v-if="product.product_quantity >=1"><span class="btn btn-sm btn-success">Availble</span></td>
                                    <td v-else><span class="btn btn-sm btn-danger">Stock Out</span> </td>
                                    <td>{{ product.product_quantity }}</td>
                                    <td>
                                        <router-link :to="{ name: 'edit-stock', params:{id: product.id} }" class="btn btn-sm btn-info"><i class="fa-solid fa-pen-to-square"></i></router-link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <nav aria-label="Page navigation" style="float: left;">
                                    <ul class="pagination justify-center-center mt-4">
                                        <li class="page-item">
                                            <p class="fw-normal">Total Data : {{ this.products.length }} entries </p>
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
                this.allProduct();
            }
        },
        data() {
            return {
                products: [],
                searchTerm:'',
                //pagination
                itemPerpage:5,
                currentPage:1,
            };
        },
        computed:{
            filterSearch(){
                const searchTermLowerCase = this.searchTerm.toLowerCase();
                return this.products.filter(product =>{
                    const nameMatch = product.product_name.toLowerCase().includes(searchTermLowerCase);
                    const codeMatch = product.product_code.toLowerCase().includes(searchTermLowerCase);
                    const priceMatch = product.selling_price.toLowerCase().includes(searchTermLowerCase);
                    const CategoryMatch = product.category_name.toLowerCase().includes(searchTermLowerCase);
    
                    return nameMatch || codeMatch || priceMatch || CategoryMatch;
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
            allProduct() {
                axios.get('/api/product/')
                .then(response => {
                this.products = response.data;
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
        },
    };
    </script>
    
    <style scoped>
    #show{
        text-align: center;
    }
    
    </style>