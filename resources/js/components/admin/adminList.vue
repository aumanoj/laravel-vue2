<template>
<div class="page-wrapper">
    <MainMenuComponent />
    <!--main menu & sub-menu component-->
    <div class="page-content">
      <TopbarComponent  />
  <!-- Page Content-->
  <div class="page-content-inner">
    <div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <div class="float-right">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="javascript:void(0);">Admin</a>
              </li>
              <li class="breadcrumb-item">
                <a href="javascript:void(0);">Admin-List</a>
              </li>
            </ol>
          </div>
          <h4 class="page-title">Admin List</h4>
        </div>
        <!--end page-title-box-->
      </div>
      <!--end col-->
      <div class="col-md-12" v-if="pageShow">
        <form class="vld-parent">
          <div class="card">
            <div class="card-body">
              <router-link :to="{name:'addAdmin'}"
                ><button type="button" class="btn btn-primary px-4 mt-0 mb-3">
                  <i class="mdi mdi-plus-circle-outline mr-2"></i>Add New
                </button></router-link
              >
              <div class="table-responsive">
                <table class="table" id="datatable">
                  <thead class="thead-light">
                    <tr>
                      <!-- <th>#</th> -->
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Role</th>
                      <th class="text-right">Actions</th>
                    </tr>
                  </thead>
                  <tbody v-for="user in users.data" :key="user.id">
                    <tr>
                      <!-- <th>{{ user.id }}</th> -->
                      <td><img src="project1.jpg" alt="" class="rounded-circle thumb-sm mr-1">{{ user.name }}</td>
                      <td>{{ user.email }}</td>
                      <td>{{ user.phone }}</td>
                      <td class="badge badge-success mt-3" v-for="role in user.roles" :key="role.id">{{ role.name}}</td>
                      <td class="text-right">
                        <router-link
                          :to="{ name: 'editAdmin', params: { id: user.id } }"
                          class="btn btn-primary"
                        >
                          <i class="dripicons-pencil text-light"></i>
                        </router-link>
                        <a
                          @click.prevent="deleteUser(user.id)"
                          class="btn btn-danger ml-2"
                        >
                          <i class="dripicons-trash text-light"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <hr />
              <pagination :data="users" @pagination-change-page="getUsers">
              </pagination>
              <loading
                :active.sync="isLoading"
                :can-cancel="true"
                loader="bars"
                color="#007BFF"
                :is-full-page="false"
              ></loading>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-11" v-else>
        <div class="card col-md-12  ml-5">
          <div class="card-body ">
            <h4 class="ml-2">{{errors}}</h4>
          </div>
        </div>
      </div>
      <!-- <div class="card col-12" v-else>
        <div class="card-body">
          <h4 class="ml-5">User can not access this page! Only Admin can access.</h4>
        </div>
      </div> -->
    </div>
  </div>
  <!-- container -->
  </div>
  <FooterComponent />
    </div>
</div>
</template>

<script>
import Vue from "vue";
Vue.component("pagination", require("laravel-vue-pagination"));
import VueToast from "vue-toast-notification";
Vue.use(VueToast);
import Url from "../../url";
import Loading from "vue-loading-overlay";
import MainMenuComponent from "../layout/MainMenuComponent.vue";
import TopbarComponent from "../layout/TopbarComponent.vue";
import FooterComponent from "../layout/FooterComponent.vue";
export default {
  data() {
    return {
      users: {},
      user: {},
      isLoading: false,
      fullPage: true,
      pageShow:true,
      
    };
  },



   mounted() { 
    this.getUsers();
  },
  components: {
    MainMenuComponent,
    TopbarComponent,
    FooterComponent,
    Loading,
  },
  methods: {
    // getCars() {
    //   User.getCars().then((response) => {
    //     this.cars = response.data;
    //   });
    // },
     getUsers(page) {
      // for loader
      this.isLoading = true;
      if (typeof page === "undefined") {
        page = 1;
      }
       Url.get("/getUsers?page=" + page).then((response) => {
        this.users = response.data;
        //alert('hello');
        console.log(this.users);
        this.isLoading = false;
      })
      .catch((error) => {
         if (error.response.status === 403) {
           this.pageShow=false;
           this.errors = error.response.data.message;
          if(this.errors=='User is not logged in.'){
            localStorage.removeItem("auth");
          this.$router.push({ name: "Login" });
          }
         }

         if (error.response.status === 422) {
            Vue.$toast.open({
            message: "Internal server error",
            type: "error",
            position: 'top',
            duration: 5000,
          })
         }
        });
    },

    deleteUser(id) {
      var _this=this;
      if(confirm("Do you really want to delete?")){
      Url.post("/deleteUser/" + id)
        .then(function (response) {
          _this.getUsers();
          Vue.$toast.open({
            message: "Record Deleted Successfully!",
            type: "success",
            position: 'top',
            duration: 3000
          });
          
          console.log(response.data);
        })
        .catch((error) => {
         if (error.response.status === 403) {
            Vue.$toast.open({
            message: "User does not have right permissions.",
            type: "error",
            position: 'top',
            duration: 5000,
          })
          
          console.log("Delete car: " + error);
         }

         if (error.response.status === 401) {
            Vue.$toast.open({
            message: "You are currently logged in! So can't delete yourself.",
            type: "info",
            position: 'top',
            duration: 5000,
          })
         }
        });
    }
    }
  },

};
</script>
