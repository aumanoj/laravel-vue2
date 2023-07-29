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
                  <a href="javascript:void(0);">Brands</a>
                </li>
                <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li> -->
                <li class="breadcrumb-item active">Brand Content</li>
              </ol>
            </div>
            <h4 class="page-title">Manage Brand Content</h4>
          </div>
          <!--end page-title-box-->
        </div>
        <!--end col-->
      </div>
      <!-- end page title end breadcrumb -->
    </div>
    <!-- container -->
    <div class="row" v-if="pageShow">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 ml-2">
                <router-link :to="{name:'createBrand'}"
                ><button type="button" class="btn btn-primary px-4 mt-0 mb-3">
                  <i class="mdi mdi-plus-circle-outline mr-2"></i> Add New
                </button></router-link
              >
              </div>
              <div class="col-md-4 ml-2">
                <!-- <label for="exampleInputPassword1">Password</label> -->
                <!-- <form> -->
                <div class="input-group">
                  <input
                    type="text"
                    id="example-input2-group2"
                    v-model="search"
                    class="form-control"
                    placeholder="Search by name..."
                  />
                  <span class="input-group-append">
                    <button type="submit" @click.prevent="searchValue" class="btn btn-gradient-primary">
                      Search
                    </button>
                    <button type="reset" @click.prevent="clearValue" class="btn btn-gradient-primary ml-2">
                      Clear
                    </button>
                  </span>
                </div>
                <!-- </form> -->
              </div>
              <!-- /btn-group -->
            </div>
            <div class="row mt-4">
              <div class="table-responsive">
                <table class="table" id="datatable">
                  <thead class="thead-light">
                    <tr>
                      <th>No#</th>
                      <th>Brand Name</th>
                      <th class="text-right">Action</th>
                    </tr>
                  </thead>
                  <tbody v-for="brand in brands.data" :key="brand.id">
                    <tr>
                      <td>{{brand.id}}</td>
                      <td>{{brand.manu_name}}</td>
                      <td class="text-right">
                        <router-link 
                          :to="{ name: 'editBrand', params: { id: brand.id } }"
                          class="btn btn-primary"
                        >
                          <i class="dripicons-pencil text-light"></i>
                        </router-link>

                        <a
                          @click.prevent="deleteBrand(brand.id)"
                          class="btn btn-danger ml-2"
                        >
                          <i class="dripicons-trash text-light"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                  <loading
                    :active.sync="isLoading"
                    :can-cancel="true"
                    loader="bars"
                    color="#007BFF"
                    :is-full-page="false"
                  ></loading>
                </table>
                <hr/>
                <pagination :data="brands" @pagination-change-page="getBrands">
                </pagination>
                <!--end /table-->
              </div>
              <!--end /tableresponsive-->
            </div>
          </div>
          <!--end card-body-->
        </div>
        <!--end card-->
      </div>
      <!--end col-->
    </div>
    <div class="col-md-11" v-else>
        <div class="card col-md-12  ml-5">
          <div class="card-body ">
            <h4 class="ml-2">{{errors}}</h4>
          </div>
        </div>
      </div>

  </div>
  <!-- end page content -->
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
        return {
            brands:{},
            search:"",
            isLoading: false,
            pageShow: true
        }
    },

  mounted() {
    this.getBrands();
  },

  components: {
    MainMenuComponent,
    TopbarComponent,
    FooterComponent,
    Loading,
  },
    methods: {
    getBrands(page) {
      // for loader
      this.isLoading = true;
      // setTimeout(() => { 
      // }, 1000);
      if (typeof page === "undefined") {
        page = 1;
      }
      Url.get("/getBrandContent?page=" + page).then((response) => {
        this.brands = response.data;
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

    searchValue() {
      Url.post("/searchBrandContent", { search: this.search }).then((response) => {
        this.brands = response.data;
      });
    },

    clearValue(){
       this.search='';
       this.getBrands();
    },

    deleteBrand(id) {
      var _this=this;
      if(confirm("Do you really want to delete?")){
      Url.post("/deleteBrandContent/" + id)
        .then(function (response) {
          _this.getBrands();
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