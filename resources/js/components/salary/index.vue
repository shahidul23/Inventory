<template>
    <div>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tables</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                <li class="breadcrumb-item active">Paid Salary</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    pay Salary
                    <router-link class="btn btn-sm btn-info" style="float: right;" id="add_new" :to="{name:'given-salary'}">Pay Salary</router-link>
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
                                    <th>Salary</th>
                                    <th>Month Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(salary,index) in filterSearch" :key="index">
                                    <td><img :src="salary.photo" alt="Employee Photo" id="em_photo" style="height: 40px; width: 40px;"></td>
                                    <td>{{ salary.name }}</td>
                                    <td>{{ salary.phone }}</td>
                                    <td>{{ salary.salary }}</td>
                                    <td>{{ salary.salary_month }}</td>
                                    <td>{{ salary.salary_date }}</td>
                                    <td>
                                        <router-link :to="{ name: 'edit-salary', params:{id: salary.id} }" class="btn btn-sm btn-info"><i class="fa-solid fa-pen-to-square"></i></router-link>
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
                this.allSalary();
            }
        },
        data() {
            return {
                Salaries: [],
                searchTerm:''
            };
        },
        computed:{
            filterSearch(){
                const searchTermLowerCase = this.searchTerm.toLowerCase();
                return this.Salaries.filter(Salary =>{
                    const nameMatch = Salary.name.toLowerCase().includes(searchTermLowerCase);
                    const salaryMatch = Salary.salary.toLowerCase().includes(searchTermLowerCase);
                    const phoneMatch = Salary.phone.toLowerCase().includes(searchTermLowerCase);
                    const montheMatch = Salary.salary_month.toLowerCase().includes(searchTermLowerCase);
    
                    return nameMatch || salaryMatch || phoneMatch || montheMatch;
                });
            }
        },
        methods: {
            allSalary() {
                axios.get('/api/salary/')
                .then(response => {
                this.Salaries = response.data;
                })
                .catch(error => console.error(error));
            },
        }
    };
    </script>
    
    <style scoped>
    
    </style>