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
                <li class="breadcrumb-item active">Manage Tool</li>
              </ol>
            </div>
            <h4 class="page-title">Manage Tool (Manual Tool Selection)</h4>
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
                <router-link :to="{name:'addToolSelections'}"
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
                    class="form-control"
                    v-model="search"
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
                      <th>Brand Name</th>
                      <th>Tool Name</th>
                      <th>Process</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody v-for="toolSel in toolSelections.data" :key="toolSel.id" >
                    <tr>
                      <td>{{toolSel.toolID}}</td>
                      <td>{{toolSel.brandname}}</td>
                      <td>{{toolSel.tool_name}}</td>
                      <td>{{toolSel.autoprocess}}</td>
                      <td>{{toolSel.createdate}}</td>
                      <td>
                        <router-link 
                          :to="{ name: 'editToolSelections', params: { id: toolSel.toolID } }"
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
              <pagination :data="toolSelections" @pagination-change-page="getToolSel">
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
      toolSelections: {},
      toolSel: {},
      search:"",
      isLoading: false,
      fullPage: true,
      pageShow:true
    };
  },

  mounted() { 
    this.getToolSel();
  },
  components: {
    MainMenuComponent,
    TopbarComponent,
    FooterComponent,
    Loading,
  },
  methods: {
    getToolSel(page) {
      // for loader
      this.isLoading = true;
      // setTimeout(() => { 
      // }, 1000);
      if (typeof page === "undefined") {
        page = 1;
      }
      Url.get("/toolSelections?page=" + page ).then((response) => {
        this.toolSelections = response.data;
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
      Url.post("/searchToolSelection", { search: this.search }).then((response) => {
        this.toolSelections = response.data;
      });
    },

    clearValue(){
       this.search='';
       this.getToolSel();
    },

   
  },

};
</script>