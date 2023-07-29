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
                <a href="javascript:void(0);">Manage-Assets</a>
              </li>
              <li class="breadcrumb-item">
                <a href="javascript:void(0);">Asset-List</a>
              </li>
            </ol>
          </div>
          <h4 class="page-title">Manage-Assets</h4>
        </div>
        <!--end page-title-box-->
      </div>
      <!--end col-->
      <div class="col-md-12" v-if="pageShow" >
        <form class="vld-parent">
          <div class="card">
            <div class="card-body">
              <router-link :to="{name:'createAsset'}"
                ><button type="button" class="btn btn-primary px-4 mt-0 mb-3">
                  <i class="mdi mdi-plus-circle-outline mr-2"></i>Add New 
                </button></router-link
              >
              <div class="table-responsive">
                <table class="table" id="datatable">
                  <thead class="thead-light">
                    <tr>
                      <!-- <th>#</th> -->
                      <!-- <th>No#</th> -->
                      <th>Slug</th>
                      <th>Script</th>
                      <th>Status</th>
                      <th class="text-right">Actions</th>
                    </tr>
                  </thead>
                  <tbody v-for="asset in assets.data" :key="asset.id">
                    <tr>
                      <!-- <th class="">{{ asset.id }}</th> -->
                      <td>{{ asset.slug }}</td>
                      <td>{{ asset.content }}</td>
                      <td>{{ asset.status }}</td>
                      
                      <td class="text-right">
                        <router-link
                          :to="{ name: 'editAsset', params: { id: asset.id } }"
                          class="btn btn-primary mb-1"
                        >
                          <i class="dripicons-pencil text-light "></i>
                        </router-link>
                        <a
                          @click.prevent="deleteAsset(asset.id)"
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
              <!-- <pagination :data="" @pagination-change-page="">
              </pagination> -->
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
import Url from "../../../../url";
import VueToast from "vue-toast-notification";
import Loading from "vue-loading-overlay";
import MainMenuComponent from "../../../layout/MainMenuComponent.vue";
import TopbarComponent from "../../../layout/TopbarComponent.vue";
import FooterComponent from "../../../layout/FooterComponent.vue";
Vue.use(VueToast);
export default {

    data(){
        return{
           assets:"",
            isLoading: false,
            pageShow:true
        }
    },



    mounted() {
   
    this.getAssets();
    },

    components: {
    MainMenuComponent,
    TopbarComponent,
    FooterComponent,
    Loading,
  },
    methods: {
    getAssets(page) {
      // for loader
      this.isLoading = true;
      // setTimeout(() => { 
      // }, 1000);
      if (typeof page === "undefined") {
        page = 1;
      }
      Url.get("/getAsset?page=" + page).then((response) => {
        this.assets = response.data;
        this.isLoading = false;
      }).catch((error) => {
         if (error.response.status === 403) {
          this.errors = error.response.data.message;
          this.pageShow=false;
          if(this.errors=='User is not logged in.'){
            localStorage.removeItem("auth");
          this.$router.push({ name: "Login" });
          }
          console.log("Delete car: " + error);
         }
      });
    },


    deleteAsset(id) {
      var _this=this;
      if(confirm("Do you really want to delete?")){
      Url.post("/deleteAsset/" + id)
        .then(function (response) {
          _this.getAssets();
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
    

    
    

  }
}
</script>