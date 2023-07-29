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
                <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li> -->
                <li class="breadcrumb-item active">Manage Tools</li>
              </ol>
            </div>
            <h4 class="page-title">Manage Tool (Manual Tool)</h4>
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
                <div class="col-md-5 ml-2">
                <router-link :to="{name:'createTool'}"
                ><button type="button" class="btn btn-primary px-4 mt-0 mb-3">
                  <i class="mdi mdi-plus-circle-outline mr-2"></i>Add New
                </button></router-link
              >
                </div>
              <div class="col-md-5 ml-2">
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
                    <button type="submit" @click.prevent="searchValue"  class="btn btn-gradient-primary">
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
                      <th>Tool Id</th>
                      <th>Tool Name</th>
                      <th>API Price</th>
                      <th>Selling Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody v-for="tool,i in tools.data" :key="i">
                    <tr v-if='tool.fun_credit_id'>
                      <td>{{tool.id}}</td>
                      <td>{{tool.tool_id}}</td>
                      <td>{{tool.tool_name}}</td>
                      <td>{{tool.api_price}}</td>
                      <td>{{tool.selling_price}}</td>
                      
                      <td>
                        <router-link 
                          :to="{ name: 'editTool', params: { id: tool.id } }"
                          class="btn btn-primary"
                        >
                          <i class="dripicons-pencil text-light"></i>
                        </router-link>

                        <!-- <a
                          
                          class="btn btn-primary ml-2"
                        >
                          <i class="dripicons-pencil text-light"></i>
                        </a> -->
                      </td>
                    </tr>
                    <tr v-else  style="background-color:  red;color:white;">
                      <th><b>{{tool.id}}</b></th>
                      <th><b>{{tool.tool_id}}</b></th>
                      <th><b>{{tool.tool_name}}</b></th>
                      <th><b>{{tool.api_price}}</b></th>
                      <th><b>{{tool.selling_price}}</b></th>
                      
                      <td>
                        <router-link 
                          :to="{ name: 'editTool', params: { id: tool.id } }"
                          class="btn btn-primary"
                        >
                          <i class="dripicons-pencil text-light"></i>
                        </router-link>

                        <!-- <a
                          
                          class="btn btn-primary ml-2"
                        >
                          <i class="dripicons-pencil text-light"></i>
                        </a> -->
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
                <hr /> 
              <pagination :data="tools" @pagination-change-page="getTools">
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
      tools: {},
      tool: {},
      search:"",
      isLoading: false,
      fullPage: true,
      pageShow:true
      
    };
  },

  mounted() { 
    this.getTools();
  },
  components: {
    MainMenuComponent,
    TopbarComponent,
    FooterComponent,
    Loading,
  },
  methods: {
    getTools(page) {
      // for loader
      this.isLoading = true;
      // setTimeout(() => { 
      // }, 1000);
      if (typeof page === "undefined") {
        page = 1;
      }
      Url.get("/tools?page=" + page).then((response) => {
        this.tools = response.data;
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
          console.log("Delete: " + error);
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
      Url.post("/searchTool", { search: this.search }).then((response) => {
        this.tools = response.data;
      });
    },

    clearValue(){
       this.search='';
       this.getTools();
    },

   
  },

};
</script>
