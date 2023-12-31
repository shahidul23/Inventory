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
                    Add Categoty
                    <router-link class="btn btn-sm btn-info" style="float: right;" id="add_new" :to="{ name:'add-categoty' }">Add New</router-link>
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
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Categoty Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(category,index) in filterSearch" :key="index">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ category.category_name }}</td>
                                    <td>
                                        <router-link :to="{ name: 'edit-categoty', params:{id: category.id} }" class="btn btn-sm btn-info"><i class="fa-solid fa-pen-to-square"></i></router-link>
                                        <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
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
                Categories: [],
                searchTerm:''
            };
        },
        computed:{
            filterSearch(){
                const searchTermLowerCase = this.searchTerm.toLowerCase();
                return this.Categories.filter(category =>{
                    const nameMatch = category.category_name.toLowerCase().includes(searchTermLowerCase);
                    return nameMatch;
                });
            }
        },
        methods: {
            allEmployee() {
                axios.get('/api/category/')
                .then(response => {
                this.Categories = response.data;
                })
                .catch(error => console.error(error));
            },
            deleteCategory(id){
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
                    axios.delete('/api/category/'+id)
                    .then(()=>{
                        this.Categories = this.Categories.filter(category =>{
                            return category.id != id
                        })
                    })
                    .catch(()=>{
                        this.$router.push({name:'all-categoty'})
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
    th{
        text-align: center;
        font-weight: bold;
    }
    td{
        text-align: center;
    }
    </style>