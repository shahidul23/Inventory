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
                Employee Insert
                <router-link class="btn btn-sm btn-info" style="float: right;" id="add_new" to="/add-employee">Add New</router-link>
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
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Salary</th>
                                <th>Joining Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="employee in VisiblePost" :key="employee.id">
                                <td><img :src="employee.photo" alt="Employee Photo" id="em_photo" style="height: 40px; width: 40px;"></td>
                                <td>{{ employee.name }}</td>
                                <td>{{ employee.phone }}</td>
                                <td>{{ employee.salary }}</td>
                                <td>{{ employee.Joining_date }}</td>
                                <td>
                                    <router-link :to="{ name: 'edit-employee', params:{id: employee.id} }" class="btn btn-sm btn-info"><i class="fa-solid fa-pen-to-square"></i></router-link>
                                    <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row mb-2">
                            <div class="col-md-2">
                                <nav aria-label="Page navigation" style="float: left;">
                                    <ul class="pagination justify-center-center mt-4">
                                        <li class="page-item">
                                            <p class="fw-normal">Total Data : {{ this.employees.length }} entries </p>
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
            this.allEmployee();
        }
    },
    data() {
        return {
            employees: [],
            searchTerm:'',
            //pagination
            itemPerpage:5,
            currentPage:1,
        };
    },
    computed:{
        filterSearch(){
            const searchTermLowerCase = this.searchTerm.toLowerCase();
            return this.employees.filter(employee =>{
                const nameMatch = employee.name.toLowerCase().includes(searchTermLowerCase);
                const salaryMatch = employee.salary.toLowerCase().includes(searchTermLowerCase);
                const phoneMatch = employee.phone.toLowerCase().includes(searchTermLowerCase);
                const JoiningdateMatch = employee.Joining_date.toLowerCase().includes(searchTermLowerCase);

                return nameMatch || salaryMatch || phoneMatch || JoiningdateMatch;
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
        allEmployee() {
            axios.get('/api/employee/')
            .then(response => {
            this.employees = response.data;
            })
            .catch(error => console.error(error));
        },
        deleteEmployee(id){
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
                axios.delete('/api/employee/'+id)
                .then(()=>{
                    this.employees = this.employees.filter(employee =>{
                        return employee.id != id
                    })
                })
                .catch(()=>{
                    this.$router.push({name:'all-employee'})
                })
                Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
                });
            }
            });
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

</style>