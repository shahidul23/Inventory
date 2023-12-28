<template>
    <div>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tables</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Supplier Insert
                    <router-link class="btn btn-sm btn-info" style="float: right;" id="add_new" :to="{name: 'add-supplier'}">Add New</router-link>
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
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="supplier in filterSearch" :key="supplier.id">
                                    <td><img :src="supplier.photo" alt="Supplier Photo" id="em_photo" style="height: 40px; width: 40px;"></td>
                                    <td>{{ supplier.name }}</td>
                                    <td>{{ supplier.phone }}</td>
                                    <td>{{ supplier.email }}</td>
                                    <td>{{ supplier.address }}</td>
                                    <td>
                                        <router-link :to="{ name: 'edit-supplier', params:{id: supplier.id} }" class="btn btn-sm btn-info"><i class="fa-solid fa-pen-to-square"></i></router-link>
                                        <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
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
                suppliers: [],
                searchTerm:''
            };
        },
        computed:{
            filterSearch(){
                const searchTermLowerCase = this.searchTerm.toLowerCase();
                return this.suppliers.filter(supplier =>{
                    const nameMatch = supplier.name.toLowerCase().includes(searchTermLowerCase);
                    const emailMatch = supplier.email.toLowerCase().includes(searchTermLowerCase);
                    const phoneMatch = supplier.phone.toLowerCase().includes(searchTermLowerCase);
                    const addressdateMatch = supplier.address.toLowerCase().includes(searchTermLowerCase);
    
                    return nameMatch || emailMatch || phoneMatch || addressdateMatch;
                });
            }
        },
        methods: {
            allEmployee() {
                axios.get('/api/supplier/')
                .then(response => {
                this.suppliers = response.data;
                })
                .catch(error => console.error(error));
            },
            deleteSupplier(id){
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
                    axios.delete('/api/supplier/'+id)
                    .then(()=>{
                        this.suppliers = this.suppliers.filter(supplier =>{
                            return supplier.id != id
                        })
                    })
                    .catch(()=>{
                        this.$router.push({name:'all-supplier'})
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