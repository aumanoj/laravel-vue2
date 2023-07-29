<template>
      <!-- Top Bar Start -->
<div class="topbar">

<!-- LOGO -->
<div class="topbar-left">
    <a href="#" class="logo">
        <span>
           <b> {{user}}</b>
        </span>
    </a>
</div>
<!--end logo-->
<!-- Navbar -->
<nav class="navbar-custom">    
    <ul class="list-unstyled topbar-nav float-right mb-0"> 
        <li class="dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <img src="/images/users/user-4.jpg" alt="profile-user" class="rounded-circle" /> 
                <span class="ml-1 nav-user-name hidden-sm">{{user}} <i class="mdi mdi-chevron-down"></i> </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <router-link :to="{ name: 'editProfile', params: { id: userID } }" class="dropdown-item"><i class="dripicons-user text-muted mr-2"></i> Profile</router-link>
                <!-- <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> -->
                <!-- <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> -->
                <!-- <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" @click.prevent="logout"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
            </div>
        </li>
    </ul><!--end topbar-nav-->

    <ul class="list-unstyled topbar-nav mb-0">                        
        <li>
            <button class="button-menu-mobile nav-link waves-effect waves-light">
                <i class="dripicons-menu nav-icon"></i>
            </button>
        </li>
        <li class="hide-phone app-search">
            <form role="search" class="">
                <input type="text" placeholder="Search..." class="form-control">
                <a href="#"><i class="fas fa-search"></i></a>
            </form>
        </li>
    </ul>
</nav>
<!-- end navbar-->
</div>
<!-- Top Bar End -->
</template>

<script> 
import Axios from 'axios';
export default { 
          
 data() {
    return {
      isLoggedIn: false,
      user:[],
      userID:[]
    }; 
  },

  mounted() {
    this.$root.$on("login", () => {
      this.isLoggedIn = true;
    });
    this.isLoggedIn = !!localStorage.getItem("auth");
    this.user=localStorage.getItem("user");
    this.userID=localStorage.getItem("userID");
    
  },

    methods: {
    logout() {
      Axios.post("/adminLogout").then(() => {
        localStorage.removeItem("auth");
        this.isLoggedIn = false;
        this.$router.go(0)
        setTimeout(function(){
                    this.$router.push({ name: "Login" });
                }, 3000);
      });
    },
  } 
}
</script>