<template>
    <div>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tables</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                <li class="breadcrumb-item active">Customer Tables</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Customer Insert
                    <router-link class="btn btn-sm btn-info" style="float: right;" id="add_new" :to="{name:'customer'}">Add New</router-link>
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
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(customer,index) in filterSearch" :key="index">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ customer.name }}</td>
                                    <td>{{ customer.phone }}</td>
                                    <td>{{ customer.email }}</td>
                                    <td>{{ customer.address }}</td>
                                    <td>
                                        <router-link :to="{ name: 'edit-customer', params:{id: customer.id} }" class="btn btn-sm btn-info"><i class="fa-solid fa-pen-to-square"></i></router-link>
                                        <a @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
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
                this.allEmployee();
            }
        },
        data() {
            return {
                customers: [],
                searchTerm:''
            };
        },
        computed:{
            filterSearch(){
                const searchTermLowerCase = this.searchTerm.toLowerCase();
                return this.customers.filter(customer =>{
                    const nameMatch = customer.name.toLowerCase().includes(searchTermLowerCase);
                    const emailMatch = customer.email.toLowerCase().includes(searchTermLowerCase);
                    const phoneMatch = customer.phone.toLowerCase().includes(searchTermLowerCase);
                    const AddressMatch = customer.address.toLowerCase().includes(searchTermLowerCase);
    
                    return nameMatch || emailMatch || phoneMatch || AddressMatch;
                });
            }
        },
        methods: {
            allEmployee() {
                axios.get('/api/customer/')
                .then(response => {
                this.customers = response.data;
                })
                .catch(error => console.error(error));
            },
            deleteCustomer(id){
                Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to delete this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/customer/'+id)
                    .then(()=>{
                        this.customers = this.customers.filter(customer =>{
                            return customer.id != id
                        })
                    })
                    .catch(()=>{
                        this.$router.push({name:'all-customer'})
                    })
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                    });
                }
                });
            }
        }
    };
    </script>
    
    <style scoped>
    
    </style>