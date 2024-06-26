<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        @vite('resources/css/app.css')
        <link href="{{ asset('backend/css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    </head>
    <body class="sb-nav-fixed">
        <div id="app">
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" id="topbar" style="display: none;" v-show="$route.path === '/login' || $route.path === '/register' || $route.path === '/forget' ? false : true" >
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">LONE STAR SHOP</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><router-link class="dropdown-item" :to="{name:'Setting'}">Settings</router-link></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><router-link class="dropdown-item" to="/logout">Logout</router-link></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav" class="leftbar" style="display: none;" v-show="$route.path === '/login' || $route.path === '/register' || $route.path === '/forget' ? false : true">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <router-link class="nav-link" to="/">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </router-link>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <router-link class="nav-link" :to="{name:'pos'}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                                POS
                            </router-link>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCoustomer" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                Customer 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCoustomer" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <router-link class="nav-link" :to="{name: 'customer'}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div>
                                        Add Customer</router-link>
                                    <router-link class="nav-link" :to="{name:'all-customer'}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                                        All Customer</router-link>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEmploy" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                                Employee
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseEmploy" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <router-link class="nav-link" :to="{name:'add-employee'}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                                        Add Employee</router-link>
                                    <router-link class="nav-link" :to="{name:'all-employee'}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                        All Employee</router-link>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSupplier" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-industry"></i></div>
                                Suppliers 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseSupplier" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <router-link class="nav-link" :to="{name: 'add-supplier'}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                                        Add Supplier</router-link>
                                    <router-link class="nav-link" :to="{name:'all-supplier'}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                        All Supplier</router-link>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                                Category 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCategory" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <router-link class="nav-link" :to="{name: 'add-categoty'}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div>
                                        Add Category</router-link>
                                    <router-link class="nav-link" :to="{name:'all-categoty'}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                                        All Category</router-link>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-brands fa-product-hunt"></i></div>
                                Products 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProduct" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <router-link class="nav-link" :to="{name: 'add-product'}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div>
                                        Add Product</router-link>
                                    <router-link class="nav-link" :to="{name:'all-product'}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                                        All Product</router-link>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseExpanse" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-credit-card"></i></div>
                                Expenses 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseExpanse" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <router-link class="nav-link" :to="{name: 'add-expense'}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div>
                                        Add Expanse</router-link>
                                    <router-link class="nav-link" :to="{name:'all-expense'}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                                        All Expanse</router-link>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSalary" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                                Salary 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseSalary" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <router-link class="nav-link" :to="{name: 'given-salary'}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div>
                                        Pay Salary</router-link>
                                    <router-link class="nav-link" :to="{name:'all-salary'}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                                        All Salary</router-link>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStock" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-trend-up"></i></div>
                                STOCK 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseStock" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <router-link class="nav-link" :to="{name: 'stock'}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div>
                                        Stock</router-link>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseorder" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                                Orders 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseorder" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <router-link class="nav-link" :to="{name: 'orser'}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-trend-up"></i></div>
                                        Today Order</router-link>
                                        <router-link class="nav-link" :to="{name: 'search'}">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                                        Search</router-link>    
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Configaration</div>
                            <router-link class="nav-link" :to="{name:'Setting'}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                                Settings
                            </router-link>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <router-view></router-view>
            </div>
        </div>
        </div>
        @vite('resources/js/app.js')
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('backend/js/scripts.js')}}"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('backend/assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{ asset('backend/assets/demo/chart-bar-demo.js')}}"></script> -->
        <script src="{{ asset('backend/js/datatables-simple-demo.js')}}"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script> -->
        <script type="text/javascript">
            let token = localStorage.getItem('token');
            if(token){
                $("#topbar").css("display","");
                $(".leftbar").css("display", "");
            }
        </script>
    </body>
</html>