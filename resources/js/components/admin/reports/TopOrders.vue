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
                           <a href="javascript:void(0);">Admin</a>
                        </li>
                        <li class="breadcrumb-item active">Top Order</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Top Order</h4>
               </div>
               <!--end page-title-box-->
            </div>
            <!--end col-->
         </div>
         <!-- end page title end breadcrumb -->
      </div>
      <div class="row" v-if="pageShow">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-5 ml-2">
                     </div>
                     <div class="col-md-5 ml-2">
                        <div class="input-group">
                           <!--<input type="text" id="example-input2-group2" class="form-control" v-model="search" placeholder="Search by name..."/>
                           <span class="input-group-append">
                              <button type="submit" @click.prevent="searchValue"  class="btn btn-gradient-primary">
                                 Search
                              </button>
                              <button type="reset" @click.prevent="clearValue" class="btn btn-gradient-primary ml-2">
                                 Clear
                              </button>
                           </span>-->
                        </div>
                     </div>
                  </div>
                  <div class="row mt-4">
                     <div class="table-responsive">
                        <table class="table" id="datatable">
                           <thead class="thead-light">
                              <tr>
                                 <th>No#</th>
                                 <th>Brand Name / Model Name</th>
                                 <th>Network Name / Country Name</th>
                                 <th>Qty</th>
                                 <th>Service Provider</th>
                                 <th>Unit Price / API Price</th>
                                 <th>MRP</th>
                                 <th>Last Updated On</th>
                              </tr>
                           </thead>
                           <tbody v-for="tOrder in topOrders.data" :key="tOrder.id" >
                              <tr v-if="tOrder.service_provider=='x'" class="danger">
                                 <td>{{tOrder.id}} </td>
                                 <td>{{tOrder.top_manu_name}} / {{tOrder.top_model_name}}</td>
                                 <td>{{tOrder.top_network_Name}} / {{tOrder.top_country_name}}</td>
                                 <td>{{tOrder.top_qty}}</td>
                                 <td>{{tOrder.service_provider}}</td>
                                 <td>{{tOrder.unit_price}} / {{tOrder.api_price}}</td>
                                 <td>{{tOrder.mrp}}</td>
                                 <td>{{moment(tOrder.last_updated_on).format("DD-MM-YYYY")}}</td>
                              </tr>
                              <tr v-else>
                                 <td>{{tOrder.id}}</td>
                                 <td>{{tOrder.top_manu_name}} / {{tOrder.top_model_name}}</td>
                                 <td>{{tOrder.top_network_Name}} / {{tOrder.top_country_name}}</td>
                                 <td>{{tOrder.top_qty}}</td>
                                 <td>{{tOrder.service_provider}}</td>
                                 <td>{{tOrder.unit_price}} / {{tOrder.api_price}}</td>
                                 <td>{{tOrder.mrp}}</td>
                                 <td>{{moment(tOrder.last_updated_on).format("DD-MM-YYYY")}}</td>
                              </tr>
                           </tbody>
                           <loading :active.sync="isLoading" :can-cancel="true" loader="bars" color="#007BFF" :is-full-page="false"></loading>
                        </table>
                        <hr />
                        <pagination :data="topOrders" @pagination-change-page="getTopOrder">
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
   import VueToast from "vue-toast-notification";
   Vue.use(VueToast);
   import Url from "../../../url";
   import Loading from "vue-loading-overlay";
   import moment from "moment";
   import MainMenuComponent from "../../layout/MainMenuComponent.vue";
import TopbarComponent from "../../layout/TopbarComponent.vue";
import FooterComponent from "../../layout/FooterComponent.vue";
   export default {
      data() {
         return {
            topOrders: {},
            tOrder: {},
            search:"",
            isLoading: false,
            fullPage: true,
            moment: moment,
            pageShow:true
         };
      },

      mounted() { 
         this.getTopOrder();
      },
      components: {
         MainMenuComponent,
    TopbarComponent,
    FooterComponent,
         Loading,
      },
      methods: {
         getTopOrder(page) {
            // for loader
            this.isLoading = true;
            // setTimeout(() => { 
            // }, 1000);
            if (typeof page === "undefined") {
               page = 1;
            }
            Url.get("/topOrdersView?page=" + page ).then((response) => {
               this.topOrders = response.data;
               this.isLoading = false;
            })
            .catch((error) => {
               if (error.response.status === 403) {
                  this.errors = error.response.data.message;
                  this.pageShow=false;
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
         /*searchValue() {
            Url.post("/searchTopOrder", { search: this.search }).then((response) => {
               this.topOrders = response.data;
            });
         },
         clearValue(){
            this.search='';
            this.getTopOrder();
         },*/
      },
   };
</script>

<style type="text/css">
   .danger{
      color:red;
   }
</style>