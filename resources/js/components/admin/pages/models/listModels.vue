<template>
<div class="page-wrapper">
    <MainMenuComponent />
    <!--main menu & sub-menu component-->
    <div class="page-content">
      <TopbarComponent  />
  <div class="page-content-inner">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="page-title-box">
            <div class="float-right">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="javascript:void(0);">Models</a>
                </li>
              </ol>
            </div>
            <h4 class="page-title">Manage Models</h4>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row" v-if="pageShow">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 ml-2">
                <router-link :to="{name:'createModels'}"
                ><button type="button" class="btn btn-primary  ml-2 ">
                  <i class="mdi mdi-plus-circle-outline mr-2"></i>Add New
                </button></router-link
              >
              </div>
            
              <div class="col-md-4 ml-2">
                <div class="input-group">
                  <input
                    type="text"
                    id="example-input2-group2"
                    v-model="search"
                    class="form-control"
                    placeholder="Search by model name..."
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
                      <th>Model Name</th>
                      <th class="text-right">Action</th>
                    </tr>
                  </thead>
                  <tbody v-for="model in models.data" :key="model.id">
                    <tr>
                      <td>{{model.id}}</td>
                      <td>{{model.manu_name}}</td>
                      <td>{{model.model_num}}</td>
                      <td class="text-right">
                        <router-link 
                          :to="{ name: 'editModels', params: { id: model.id } }"
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-11" v-else>
        <div class="card col-md-12  ml-5">
          <div class="card-body ">
            <h4 class="ml-2">{{errors}}</h4>
          </div>
        </div>
      </div>
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
        select:"",
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
        this.isLoading = true;
        if (typeof page === "undefined") {
          page = 1;
        }
        Url.get("/getModels?page=" + page).then((response) => {
          this.models = response.data;
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

      getBrands() {
        this.isLoading = true;
        Url.get("/getBrandCont").then((response) => {
          this.brands = response.data;
            this.isLoading = false;
        });
      },

      searchValue() {
        Url.post("/getModels", { search: this.search }).then((response) => {
            this.models = response.data;
            console.log(response.data);
        });
      },

      clearValue(){
        this.search='';
        this.getModels();
      },
    }
  }
</script>