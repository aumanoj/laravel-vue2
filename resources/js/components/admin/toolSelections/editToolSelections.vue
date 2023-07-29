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
            <h4 class="page-title">Edit Brand Rule</h4>
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
        <!-- <router-link to="/brands/brand-list"
          ><button type="button" class="btn btn-primary px-4 mt-0 mb-3">
            Back
        </button></router-link> -->
        <div class="card">
          <div class="card-body">
            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Tool</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <select id="select_edit" class="select2 form-control mb-3 custom-select" v-model="toolSel.tools.tool_id"  >
                  <option data-limit='150' class="short" value="" disabled>Select</option>
                    <option data-limit='120' class="short" v-for="tool in toolSel.toollist"
                      :key="tool.id"
                      :value="tool.tool_id">
                      {{tool.tool_name}}
                    </option> 
                </select>
                <span class="text-danger" v-if="errors.tool_id">
                The tool field is required
                </span>
              </div>
            </div>

           
            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Brand</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <select class=" form-control mb-3 selectpicker" data-live-search="true" v-model="toolSel.tools.brand_id" @change="onChangeBrand()">
                  <option value="" disabled>Select</option>
                    <option v-for="brand in toolSel.manufacturers"
                      :key="brand.id"
                      :value="brand.manu_id">
                      {{brand.manu_name}}
                    </option>
                </select>
                <span class="text-danger" v-if="errors.brand_id">
                The brand field is required
                </span>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-md-2 ml-5 mt-1"><b>Model</b><b class="required"> *</b></div>
              <div class="col-md-6" >
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="model_select_all" value="1" v-model="toolSel.tools.model_type" @click="modelType"  class="custom-control-input">
                            <label class="custom-control-label" for="model_select_all">Select All</label>
                    </div>
                </div>
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="model_select_manually" value="2" v-model="toolSel.tools.model_type" @click="modelType"  class="custom-control-input">
                            <label class="custom-control-label" for="model_select_manually">Select Manually</label>
                    </div>
                </div>
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="model_select_all_rm" value="3" v-model="toolSel.tools.model_type" @click="modelType" class="custom-control-input">
                            <label class="custom-control-label" for="model_select_all_rm">Select all except</label>
                    </div>
                </div>
              </div>
            </div>

            <div class="row mt-2" id="modelShow">
              <div class="col-md-2 ml-5"><b></b></div>
              <div class="col-md-6">

                <select v-if="models" class="selectpicker form-control" multiple data-live-search="true" v-model="model_id">
                  <option value="" disabled>Select</option>
                    <option v-for="model in models"
                      :key="model.id" 
                      :value="model.model_id">
                      {{model.model_num}}
                    </option>
                </select>

                <select v-else class="selectpicker form-control" multiple data-live-search="true" v-model="model_id">
                  <option value="" disabled>Select</option>
                    <option v-for="model in toolSel.models"
                      :key="model.id" 
                      :value="model.model_id">
                      {{model.model_num}}
                    </option>
                </select>

                <span class="text-danger" v-if="errors.model_id">
                The model field is required
                </span>

                <div
                  v-if="model_error==false"
                  class="danger"
                >
                  Model is required
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5 mt-1"><b>Country</b><b class="required"> *</b></div>
              <div class="col-md-6" >
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="country_select_all" value="1" v-model="toolSel.tools.country_type" @click="countryType" class="custom-control-input">
                            <label class="custom-control-label" for="country_select_all">Select All</label>
                    </div>
                </div>
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="country_select_manually" value="2" v-model="toolSel.tools.country_type" @click="countryType"  class="custom-control-input">
                            <label class="custom-control-label" for="country_select_manually">Select Manually</label>
                    </div>
                </div>
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="country_select_all_rm" value="3" v-model="toolSel.tools.country_type" @click="countryType" class="custom-control-input">
                            <label class="custom-control-label" for="country_select_all_rm">Select all except</label>
                    </div>
                </div>
              </div>
            </div>

            <div class="row mt-2" id="countryShow">
              <div class="col-md-2 ml-5"><b></b></div>
              <div class="col-md-6">
                <select class="selectpicker form-control" multiple data-live-search="true" v-model="country_id" @change="onChangeCountry()">
                  <option value="" disabled>Select</option>
                    <option v-for="country in toolSel.countries"
                      :key="country.id" 
                      :value="country.country_id">
                      {{country.country_name}}
                    </option>  
                </select>
                <span class="text-danger" v-if="errors.country_id">
                The country field is required
                </span>

                <div
                  v-if="country_error==false"
                  class="danger"
                >
                  Country is required
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5 mt-1"><b>Network</b><b class="required"> *</b></div>
              <div class="col-md-6" >
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="network_select_all" value="1" v-model="toolSel.tools.network_type" @click="networkType" class="custom-control-input">
                            <label class="custom-control-label" for="network_select_all">Select All</label>
                    </div>
                </div>
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="network_select_manually" value="2" v-model="toolSel.tools.network_type" @click="networkType"  class="custom-control-input">
                            <label class="custom-control-label" for="network_select_manually">Select Manually</label>
                    </div>
                </div>
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="network_select_all_rm" value="3" v-model="toolSel.tools.network_type" @click="networkType" class="custom-control-input">
                            <label class="custom-control-label" for="network_select_all_rm">Select all except</label>
                    </div>
                </div>
              </div>
            </div>

            <div class="row mt-4" id="networkShow">
              <div class="col-md-2 ml-5"><b></b></div>
              <div class="col-md-6">
                <select v-if="networks" class="selectpicker form-control" multiple data-live-search="true" v-model="network_id">
                  <option value="" disabled>Select</option>
                    <option v-for="network in networks"
                      :key="network.id" 
                      :value="network.network_id">
                      {{network.network_name}}
                    </option>
                </select>

                <select v-else class="selectpicker form-control" multiple data-live-search="true" v-model="network_id">
                  <option value="" disabled>Select</option>
                    <option v-for="network in toolSel.networks"
                      :key="network.id" 
                      :value="network.network_id">
                      {{network.network_name}}
                    </option>
                </select>

                <span class="text-danger" v-if="errors.network_id">
                The network field is required
                </span>
                <div
                  v-if="network_error==false"
                  class="danger"
                >
                  Network is required
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5 mt-3"><b>Auto Process</b></div>
              <div class="col-md-6">
                <div class="form-check-inline my-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" v-model="toolSel.tools.auto_process"  id="auto_process" data-parsley-multiple="groups" data-parsley-mincheck="2">
                            <label class="custom-control-label" for="auto_process"></label>
                    </div>
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Status</b></div>
              <div class="col-md-6">
                <select class="form-control" v-model="toolSel.tools.status">
                    <option value="" selected disabled>
                      Please Select
                    </option >
                    <option value="1" >
                      {{ ' Published' }} 
                    </option>
                    <option  value="0">
                      {{ ' Unpublished' }}
                    </option>
                  </select>
              </div>
            </div>
            
             <loading
            :active.sync="isLoading"
            :can-cancel="true"
            loader="bars"
            color="#007BFF"
            :is-full-page="false"
          ></loading>

            <div class="form-group mt-5">
                <div class="form-check">
                  <label class="required" for="invalidCheck">
                    (*) Mandatory fields
                  </label>
                </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-2 ml-5"></div>
              <div class="col-md-6">
                <button
                  type="button"  @click.prevent="updateToolSel"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Update
                </button>
                <router-link :to="{name:'toolSelections'}"
                  ><button
                    type="button"
                    class="btn btn-primary waves-effect waves-light ml-2"
                  >
                    Cancel
                  </button></router-link
                >
                
              </div>
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

<style>
 /* @import url('https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'); */
 /* @import url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css'); */

</style>
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

  data(){ 
    return{
      toolSel:{
        toollist:{
          tool_name:""
        },
        tools:{model_type:"",country_type:""},
        // models:{model_num:[]},
        // countries:{country_name:[]},
        // networks:{network_name:[]}

      },
      tool_name:"",
      brand_name:"",
      tool_id:"",
      brand_id:"",
      models:"",
      networks:"",
      country:[],
      modelid:[],
      selcountry:[],
      selmodel:[],
      model_id:[],
      country_id:[],
      network_id:[],
      auto_process:"",
      status:"",
      model_select:"",
      country_select:"",
      network_select:"",
      model_error:true,
      country_error:true,
      network_error:true,
      isLoading:false,
      errors:"",
      pageShow:true
    } 
  },


  
mounted(){

    this.getToolSel();

  
  require("../../../../../public/assets/js/bootstrap-select");
  require("../../../../../public/assets/css/bootstrap-select.min.css");

  // Tool select option setting width
$(document).ready(function(){
  $("#select_edit").hover(function(){
  var e=document.querySelectorAll('.short')
  e.forEach(x=>{
    if(x.textContent.length>100)
    x.textContent=x.textContent.substring(0,100)+'...';
  })

  });

  

});

  $(document).ready(function() {
        
        $('.selectpicker').selectpicker();
        //model hide and show 
        $('#model_select_all').on('click', function(){
          $('#modelShow').hide();
        });

        $('#model_select_manually').on('click', function(){
          $('#modelShow').show();
          
        });

        $('#model_select_all_rm').on('click', function(){
          $('#modelShow').show();
        });

        //country hide and show 
        $('#country_select_all').on('click', function(){
          $('#countryShow').hide();
        });

        $('#country_select_manually').on('click', function(){
          $('#countryShow').show();
        });

        $('#country_select_all_rm').on('click', function(){
          $('#countryShow').show();
        });

        //network hide and show 
        $('#network_select_all').on('click', function(){
          $('#networkShow').hide();
        });

        $('#network_select_manually').on('click', function(){
          $('#networkShow').show();
        });

        $('#network_select_all_rm').on('click', function(){
          $('#networkShow').show();
        });
        
        
        
    });

 },

 components: {
   MainMenuComponent,
    TopbarComponent,
    FooterComponent,
    Loading,
  },

 methods:{

   //scrolling page for errors detecting
     scrollToTop() {
        window.scrollTo(0,0);
      },

    modelType(event){
     this.model_select=event.target.value;
   },

   countryType(event){
     this.country_select=event.target.value;
   },

   networkType(event){
     this.network_select=event.target.value;
   },

   getToolSel() {
      // for loader
      this.isLoading = true;
      Url.get("/editToolSelections/"+this.$route.params.id).then((response) => {
        this.toolSel = response.data;
          setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
        }, 300);
        this.model_id=this.toolSel.tools.model_id.split(",").map(Number);
        this.country_id=this.toolSel.tools.country_id.split(",").map(Number);
        this.network_id=this.toolSel.tools.network_id.split(",").map(Number);
        this.isLoading = false;
        setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
        }, 300);

        if(this.toolSel.tools.model_type==1){
          $('#model_select_all').trigger('click');
        }
        if(this.toolSel.tools.country_type==1){
          $('#country_select_all').trigger('click');
        }
        if(this.toolSel.tools.network_type==1){
          $('#network_select_all').trigger('click');
        }
      }).catch((error) => {
          if (error.response.status === 403) {
           this.errors = error.response.data.message;
            this.pageShow = false;

            if(this.errors=='User is not logged in.'){
            localStorage.removeItem("auth");
          this.$router.push({ name: "Login" });
          }
          }
        });
    },

  onChangeBrand() {
     //var brand_id = event.target.value;
   Url.get("/getModelList/"+ this.toolSel.tools.brand_id).then((response) => {
        this.models = response.data;
        setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
        }, 500);
   });
  },

  onChangeCountry() {
     //var brand_id = event.target.value;
   Url.get("/getNetworkList/"+ this.country_id).then((response) => {
     setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
        }, 300);
        this.networks = response.data;
        setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
        }, 300);
   });
  },

    updateToolSel(){


      //for model
      if(this.model_select==1){
          this.model_id=[null];
        }

      if(this.model_select==2){
        if(this.model_id!=''){
          this.model_id;
        }else{
          this.model_error=false;
          this.scrollToTop();
          return false
        }
      }

      if(this.model_select==3){
        if(this.model_id!=''){
          this.model_id;
        }else{
          this.model_error=false;
          this.scrollToTop();
          return false
        }
      }
      // for country
      if(this.country_select==1){
          this.country_id=[null];
        }

      if(this.country_select==2){
        if(this.country_id!=''){
          this.country_id;
        }else{
          this.country_error=false;
          this.scrollToTop();
          return false
        }
      }

      if(this.country_select==3){
        if(this.country_id!=''){
          this.country_id;
        }else{
          this.country_error=false;
          this.scrollToTop();
          return false
        }
      }

      //for network

      if(this.network_select==1){
           this.network_id=[null];
        }

      if(this.network_select==2){
        if(this.network_id!=''){
          this.network_id;
        }else{
          this.network_error=false;
          this.scrollToTop();
          return false
        }
      }

      if(this.network_select==3){
        if(this.network_id!=''){
          this.network_id;
        }else{
          this.network_error=false;
          this.scrollToTop();
          return false
        }
      }


      Url.post("/updateToolSel/"+ this.$route.params.id,{
        tool_id:this.toolSel.tools.tool_id,
        brand_id:this.toolSel.tools.brand_id,
        model_id:this.model_id,
        country_id:this.country_id,
        network_id:this.network_id,
        model_type:this.toolSel.tools.model_type,
        country_type:this.toolSel.tools.country_type,
        network_type:this.toolSel.tools.network_type,
        auto_process:this.toolSel.tools.auto_process,
        status:this.toolSel.tools.status


      })
        .then(() => {
          Vue.$toast.open({
            message: "Record updated Successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          this.$router.push({ name: "toolSelections" });
        }).catch((error) => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors;
              
            }
             
          Vue.$toast.open({
          message:"All fields are required",
          type: "error",
          position: "top",
          duration: 5000,
        });
      });

    }
 },
    
}

</script>

<style scoped>
.danger{
  width: 100%; 
  font-size: 80%;
  color: #dc3545;
}
</style>


