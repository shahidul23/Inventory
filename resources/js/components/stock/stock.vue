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
                            <label class="col-sm-1 col-form-label"><b>Search:</b></label>
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
                                <tr v-for="(product,index) in filterSearch" :key="index">
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
                searchTerm:''
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
        }
    };
    </script>
    
    <style scoped>
    
    </style>