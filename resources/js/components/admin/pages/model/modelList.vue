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
                  <a href="javascript:void(0);">Models</a>
                </li>
                <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li> -->
                <li class="breadcrumb-item active">Model Content</li>
              </ol>
            </div>
            <h4 class="page-title">Manage Model Content</h4>
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
                <router-link :to="{name:'createModel'}"
                ><button type="button" class="btn btn-primary  ml-2 ">
                  <i class="mdi mdi-plus-circle-outline mr-2"></i>Add New
                </button></router-link
              >
              </div>
              <div class="col-md-3 ml-2">
                <div class="input-group">
                  <select class="form-control float-right" v-model="search" @change="searchValue()">
                    <option value="" selected disabled>
                      Select Brand
                    </option >
                    <option v-for="brand in brands"
                      :key="brand.id"
                      :value="brand.manu_name" >
                      {{ brand.manu_name }}
                    </option>
                  </select>
                  <button type="reset" @click.prevent="clearValue" class="btn btn-gradient-primary ml-2 float-right">
                      Clear
                  </button>
                </div>
              </div>
              <div class="col-md-1 ml-2 ">
                <!-- <button type="button"  class="btn btn-primary ml-2 float-right">
                      Manage
                </button> -->
                <!-- <button type="button"  class="btn btn-gradient-primary ml-2 float-right">
                      +
                </button> -->
                
              </div>
              <!-- /btn-group -->
            </div>
            <div class="row mt-4">
              <div class="table-responsive">
                <table class="table" id="datatable">
                  <thead class="thead-light">
                    <tr>
                      <th>No#</th>
                      <th>Model Name</th>
                      <th class="text-right">Action</th>
                    </tr>
                  </thead>
                  <tbody v-for="model in models.data" :key="model.id">
                    <tr>
                      <td>{{model.id}}</td>
                      <td>{{model.manu_name}} / {{model.model_num}}</td>
                      <td class="text-right">
                        <router-link 
                          :to="{ name: 'editModel', params: { id: model.id } }"
                          class="btn btn-primary"
                        >
                          <i class="dripicons-pencil text-light"></i>
                        </router-link>
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
                <pagination :data="models" @pagination-change-page="getModels">
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
        return{
            select:"",
            iPhone:"",
            models:{},
            brands:"",
            search:"",
            isLoading: false,
            pageShow:true
        }
    },



    mounted() {
    this.getModels(); 
    this.getBrands();
    },

    components: {
      MainMenuComponent,
    TopbarComponent,
    FooterComponent,
    Loading,
  },
    methods: {
    getModels(page) {
      // for loader
      this.isLoading = true;
      // setTimeout(() => { 
      // }, 1000);
      if (typeof page === "undefined") {
        page = 1;
      }
      Url.get("/getModelContent?page=" + page).then((response) => {
        this.models = response.data;
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
          
         }
        });
    },

    getBrands() {
      //for loader
      this.isLoading = true;
      // setTimeout(() => {
      //   this.isLoading = false;
      // }, 1000);
      Url.get("/getBrandCont").then((response) => {
        this.brands = response.data;
        this.isLoading = false;
      });
    },


    searchValue() {
      Url.post("/getModelContent", { search: this.search }).then((response) => {
        this.models = response.data;
      });
    },

    clearValue(){
       this.search='';
       this.getModels();
    },
    

  }
}
</script>