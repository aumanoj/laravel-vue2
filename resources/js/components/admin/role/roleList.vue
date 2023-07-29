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
                <a href="javascript:void(0);">Role</a>
              </li>
              <li class="breadcrumb-item">
                <a href="javascript:void(0);">Role-List</a>
              </li>
            </ol>
          </div>
          <h4 class="page-title">Role List</h4>
        </div>
        <!--end page-title-box-->
      </div>
      <!--end col-->
      <div class="col-md-12" v-if="pageShow">
        <form class="vld-parent">
          <div class="card">
            <div class="card-body">
              <router-link :to="{name:'addRole'}"
                ><button   type="button" class="btn btn-primary px-4 mt-0 mb-3">
                  <i class="mdi mdi-plus-circle-outline mr-2"></i>Add New
                </button>
              </router-link>
              <div class="table-responsive">
                <table class="table" id="datatable">
                  <thead class="thead-light">
                    <tr>
                      <!-- <th>#</th> -->
                      <th>Role</th>
                      <th class="text-right">Actions</th>
                    </tr>
                  </thead>
                  <tbody v-for="role in roles.data" :key="role.id">
                    <tr >
                      <!-- <th>{{ role.id }}</th> -->
                      <td> <img src="project1.jpg" alt="" class="rounded-circle thumb-sm mr-1">{{ role.name }}</td>
                      <td class="text-right">
                        <!-- <a
                        @click.prevent="getCar(car.id)"
                        class="btn btn-primary ml-2"
                        data-toggle="modal"
                        data-target="#myModal"
                        ><i class="dripicons-pencil text-light"></i
                      ></a> -->
                        <router-link
                          :to="{ name: 'editRole', params: { id: role.id } }"
                          class="btn btn-primary"
                        >
                          <i class="dripicons-pencil text-light"></i>
                        </router-link>

                        <a
                          @click.prevent="deleteRole(role.id)"
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
              <pagination :data="roles" @pagination-change-page="getRoles">
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
import Url from "../../../url";
import Loading from "vue-loading-overlay";
import MainMenuComponent from "../../layout/MainMenuComponent.vue";
import TopbarComponent from "../../layout/TopbarComponent.vue";
import FooterComponent from "../../layout/FooterComponent.vue";
export default {
  data() {
    return {
      roles: {},
      role: {},
      isLoading: false,
      fullPage: true,
      pageShow: true
    };
  },

  created() {
    this.getRoles();
  },
  mounted() { 
    this.getRoles();
  },
  components: {
    MainMenuComponent,
    TopbarComponent,
    FooterComponent,
    Loading,
  },
  methods: {
    getRoles(page) {
      // for loader
      this.isLoading = true;
      // setTimeout(() => {
      //   this.isLoading = false;
      // }, 1000);
      if (typeof page === "undefined") {
        page = 1;
      }
      Url.get("/getRoles?page=" + page).then((response) => {
        this.roles = response.data;
        this.isLoading = false;
      })
      .catch((error) => {
         if (error.response.status === 403) {
          this.errors = error.response.data.message;
          this.pageShow=false;
          if(this.errors=='User is not logged in.'){
            localStorage.removeItem("auth");
          this.$router.push({ name: "Login" });
          }
          console.log("Delete car: " + error);
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

    deleteRole(id) {
      var _this=this;
      if(confirm("Do you really want to delete?")){
      Url.post("/deleteRole/" + id)
        .then(function (response) {
          _this.getRoles();
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
            message: "User does not have the right permissions.",
            type: "error",
            position: 'top',
            duration: 5000,
          })
          
          console.log("Delete car: " + error);
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
    }
    }
  },

};
</script>
