<template>
    <div>
        <div class="container-fluid px-4">
            <h1 class="mt-4">POS</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><router-link :to="{name:'/'}">Dashboard</router-link></li>
                <li class="breadcrumb-item active">Point of Sale</li>
            </ol>
            <div class="row mb-2">
                <div class="col-lg-5 col-md-5">
                    <div class="row card container">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Customer Insert
                            <a  class="btn btn-sm btn-info" style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal" id="add_new">Add New</a>
                        </div>
                        
                        <div class="card-body">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="cart in carts" :key="cart.id">
                                        <td>{{cart.pro_name}}</td>
                                        <td><input type="text" readonly style="width: 20px;" :value="cart.pro_qty">
                                            <button @click.prevent="Increment(cart.id)" class="btn btn-sm btn-success">+</button>

                                            <button @click.prevent="Decrement(cart.id)" class="btn btn-sm btn-danger" v-if="cart.pro_qty >=2">-</button>
                                            <button @click.prevent="Decrement(cart.id)" class="btn btn-sm btn-danger" v-else disabled>-</button>
                                        </td>    
                                        <td>{{ cart.pro_price }}</td>
                                        <td>{{ cart.sub_total }}</td>
                                        <td><a @click="removeItem(cart.id)" class="btn btn-sm btn-danger">X</a></td>
                                    </tr>
                                </tbody>
                            </table><hr>
                        </div>
                        <div class="card-footer">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between aline-item-center">
                                    Total Quantity:
                                    <strong>{{ qty() }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between aline-item-center">
                                    Sub Total:
                                    <strong>{{ subTotal() }} TK</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between aline-item-center">
                                    Vat:
                                    <strong>{{ vats.vat }}%</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between aline-item-center">
                                    Total:
                                    <strong>{{ this.total() }} TK</strong>
                                </li>
                            </ul><br>
                            <form @submit.prevent="orderDone">
                                <label>Customer Name</label>
                                <select class="form-control" v-model="customer_id">
                                    <option disabled selected>Select Customer</option>
                                    <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                                        {{ customer.name }}
                                    </option>
                                </select>
                                <label>Pay</label>
                                <input type="text" required class="form-control" v-model="pay">
                                <label>Due</label>
                                <label class="form-control" style="height: 40px;">{{ this.dues() }}</label>
                                <!-- <input type="text" readonly class="form-control" v-model="due"> -->
                                <label>Pay By</label>
                                <select class="form-control" v-model="payby">
                                    <option value="Hand Cash">Hand Cash</option>
                                    <option value="Cheaque">Cheaque</option>
                                    <option value="Gift Card">Gift Card</option>
                                </select><br>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                                <button type="button" id="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="customerInsert"> 
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="inputFirstName" v-model="form.name" type="text" placeholder="Enter your first name" />
                                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                                <label for="inputFirstName">Full name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" id="inputEmail" v-model="form.email" type="email" placeholder="name@example.com" />
                                                <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" id="inputPhone" v-model="form.phone" type="text" placeholder="Phone" />
                                                <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                                <label for="inputPhone">Phone</label>
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
                                                <label for="inputAddress">Gender</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <textarea rows="3" class="form-control" id="inputAddress" v-model="form.address" type="text" placeholder="Create a address"/>
                                                <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                                <label for="inputAddress">Address</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" style="float: right;" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-7">
                    <div class="row card container">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Products
                        </div><br>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="" class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All Products</a>
                        </li>
                        <li class="nav-item" role="presentation" v-for="(category,index) in categories" :key="index">
                            <a class="nav-link" @click="subproduct(category.id)" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{category.category_name}}</a>
                        </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <input type="text" v-model="searchTerm" class="form-control" placeholder="product search...">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="(product,index) in VisiblePost" :key="index">
                                            <button class="btn btn-sm" @click.prevent="AddToCart(product.id)">
                                                <div class="row">
                                                    <div class="card" style="width: 10rem;">
                                                        <img :src="product.image" class="card-img-top">
                                                        <div class="card-body">
                                                            <small class="card-title">{{ product.product_name }}</small>
                                                            <br>
                                                            <span v-if="product.product_quantity >=1" class="btn btn-sm btn-success">Availble({{ product.product_quantity }})</span>
                                                            <span v-else class="btn btn-sm btn-danger">Stock Out</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
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
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <input type="text" v-model="GetsearchTerm" class="form-control" placeholder="product search...">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="(product,index) in filerGetitem" :key="index">
                                            <button class="btn btn-sm" @click.prevent="AddToCart(product.id)">
                                                <div class="row">
                                                    <div class="card" style="width: 10rem;">
                                                        <img :src="product.image" class="card-img-top">
                                                        <div class="card-body">
                                                            <small class="card-title">{{ product.product_name }}</small>
                                                            <br>
                                                            <span v-if="product.product_quantity >=1" class="btn btn-sm btn-success">Availble</span>
                                                            <span v-else class="btn btn-sm btn-danger">Stock Out</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
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
                this.allCustomer();
                this.allCartProduct();
                this.vat();
                // Reload.$on('afterAdd', ()=>{
                //     this.allCartProduct();
                // })
            }
        },
        data() {
            return {
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
                  phone:'',
              },
                errors:{},
                categories:{},
                products: [],
                searchTerm:'',
                ProductCategory:[],
                errors:{},
                GetsearchTerm:'',
                customers:'',
                carts:[],
                vats:'',
                customer_id:'',
                pay:'',
                payby:'',
                //pagination
                itemPerpage:12,
                currentPage:1, 
                
            };
        },
        created(){
            axios.get('/api/category/')
            .then(response => {
                this.categories = response.data;
            })
            .catch(error =>{
                console.log(error)
            });
        },
        computed: {
            filterSearch() {
                const searchTermLowerCase = this.searchTerm.toLowerCase();
                return this.products.filter(product => {
                    const nameMatch = product.product_name.toLowerCase().includes(searchTermLowerCase);
                    const codeMatch = product.product_code.toLowerCase().includes(searchTermLowerCase);
                    const priceMatch = product.selling_price.toLowerCase().includes(searchTermLowerCase);
                    const categoryMatch = product.category_name.toLowerCase().includes(searchTermLowerCase);

                    return nameMatch || codeMatch || priceMatch || categoryMatch;
                });
            },
            filerGetitem() {
                const productSearchTermLowerCase = this.GetsearchTerm.toLowerCase();
                return this.ProductCategory.filter(productItem => {
                    const nameMatch = productItem.product_name.toLowerCase().includes(productSearchTermLowerCase);
                    const codeMatch = productItem.product_code.toLowerCase().includes(productSearchTermLowerCase);
                    const priceMatch = productItem.selling_price.toLowerCase().includes(productSearchTermLowerCase);
                    //const categoryMatch = productItem.category_name.toLowerCase().includes(productSearchTermLowerCase);
                    
                    return nameMatch || codeMatch || priceMatch || categoryMatch;
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
            vat(){
                axios.get('/api/extra/')
                .then(({data}) =>{
                    this.vats = data;
                })
                .catch(console.log('error'))
            },
            Increment(id){
                axios.get('/api/increment/'+id)
                .then(() =>{
                    this.allCartProduct();
                    Toast.fire({
                    icon: "success",
                    title: "Product Increment successfull"
                    });
                })
                .catch(console.log('error'))
            },
            Decrement(id){
                axios.get('/api/decrement/'+id)
                .then(() =>{
                    this.allCartProduct();
                    Toast.fire({
                    icon: "error",
                    title: "Product Decrement successfull"
                    });
                })
                .catch(console.log('error'))
            },
            AddToCart(id){
                axios.post('/api/add-cart/'+id)
                .then(()=>{
                    //Reload.$emit('afterAdd');
                    this.allCartProduct();
                    Toast.fire({
                    icon: "success",
                    title: "Product Added successfull"
                    });
                })
                .catch(console.log("product not added to cart"))
            },
            allCartProduct(){
                axios.get('/api/all-cart-product/')
                .then(response => {
                this.carts = response.data;
                })
                .catch(error => console.error(error));
            },
            allProduct() {
                axios.get('/api/product/')
                .then(response => {
                this.products = response.data;
                })
                .catch(error => console.error(error));
            },
            subproduct(id){
                axios.get('/api/category/item/'+id)
                .then(response=>{
                    this.ProductCategory = response.data;
                })
                .catch(error=>{
                    this.errors = error.response.data.errors;
                })
            },
            allCustomer(){
                axios.get('/api/customer/')
                .then(({data})=>{this.customers = data})
                .catch(error =>{
                    console.log(error)
                });
            },
            customerInsert() {
                axios.post('/api/customer', this.form)
                .then(() => {
                    $('#closeModal').click();
                    Toast.fire({
                        icon: "success",
                        title: "Customer inserted successfully"
                    });
                    this.customers = this.customers.filter(customer =>{
                        return customer.id != id 
                    });
                })
                .catch(error => {
                    console.log(error);
                    //this.errors = error.response.data.errors;
                });
            },
            removeItem(id){
                axios.get('/api/remove/'+id)
                .then(()=>{
                    this.carts = this.carts.filter(cart =>{
                            return cart.id != id
                        })
                    Toast.fire({
                    icon: "error",
                    title: "Product Delete successfull"
                    });
                })
                .catch(console.log('error'))
            },
            qty(){
                let sum = 0;
                for(let i=0 ;i<this.carts.length;i++){
                    sum += (parseFloat(this.carts[i].pro_qty))
                }
                return sum;
            },
            subTotal(){
                let sum = 0;
                for(let i = 0; i<this.carts.length;i++){
                    sum += (parseFloat(this.carts[i].sub_total))
                }
                return sum;
            },
            total(){
                let total = (this.subTotal() * this.vats.vat /100) + this.subTotal();
                return total;
            },
            dues(){
                let due = this.total() - this.pay;
                return due
            },
            orderDone(){
                let data = {qty: this.qty(), subTotal:this.subTotal(), customer_id:this.customer_id, payby:this.payby,
                pay:this.pay,due:this.dues(), vat:this.vats.vat, total:this.total()}

                axios.post('/api/orderdone/',data)
                .then(() =>{
                    Toast.fire({
                        icon: "success",
                        title: "Order Done successfully"
                    });
                    this.$router.push({name:'/'});
                })
                .catch(console.log('error'))
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
    #em_photo{
        height: 100px;
        width: 90px;
    }
    </style>