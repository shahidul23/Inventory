<template>
    <div>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tables</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                <li class="breadcrumb-item active">Employees Tables</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Employee Salary Pay
                    
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="employee in filterSearch" :key="employee.id">
                                    <td><img :src="employee.photo" alt="Employee Photo" id="em_photo" style="height: 40px; width: 40px;"></td>
                                    <td>{{ employee.name }}</td>
                                    <td>{{ employee.phone }}</td>
                                    <td>{{ employee.salary }}</td>
                                    <td>
                                        <router-link :to="{ name: 'pay-salary', params:{id: employee.id} }" class="btn btn-sm btn-info">Pay Salary</router-link>
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
                employees: [],
                searchTerm:''
            };
        },
        computed:{
            filterSearch(){
                const searchTermLowerCase = this.searchTerm.toLowerCase();
                return this.employees.filter(employee =>{
                    const nameMatch = employee.name.toLowerCase().includes(searchTermLowerCase);
                    const salaryMatch = employee.salary.toLowerCase().includes(searchTermLowerCase);
                    const phoneMatch = employee.phone.toLowerCase().includes(searchTermLowerCase);
    
                    return nameMatch || salaryMatch || phoneMatch;
                });
            }
        },
        methods: {
            allEmployee() {
                axios.get('/api/employee/')
                .then(response => {
                this.employees = response.data;
                })
                .catch(error => console.error(error));
            },
        }
    };
    </script>
    
    <style scoped>
    
    </style>