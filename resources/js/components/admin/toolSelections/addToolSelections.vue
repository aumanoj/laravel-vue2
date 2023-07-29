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
            <h4 class="page-title">Add Brand Rule</h4>
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
                <select id="select1" class="select2 form-control mb-3 custom-select" v-model="tool_id" 
                    :class="{ 'is-invalid': submitted && $v.tool_id.$error }" >
                  <option   value="" class="short" disabled>Select</option>
                    <option data-limit='120' class="short" v-for="tool in toolSel.tools"
                      :key="tool.id"
                      :value="tool.tool_id">
                      {{tool.tool_name}}
                    </option> 
                </select>
                <div
                  v-if="submitted && !$v.tool_id.required"
                  class="invalid-feedback"
                >
                  Tool is required
                </div>
              </div>
            </div>

           
            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Brand</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <select class=" form-control mb-3 selectpicker" data-live-search="true" v-model="brand_id" @change="onChangeBrand()" :class="{ 'is-invalid': submitted && $v.brand_id.$error }">
                  <option value="" disabled>Select Brand</option>
                    <option  v-for="brand in toolSel.manufacturers"
                      :key="brand.id"
                      :value="brand.manu_id"  >
                      {{brand.manu_name}}
                    </option>
                </select>
                <div
                  v-if="submitted && !$v.brand_id.required"
                  class="danger"
                >
                  Brand is required
                </div>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-md-2 ml-5 mt-1"><b>Model</b><b class="required"> *</b></div>
              <div class="col-md-6" >
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="model_select_all" value="1" v-model="model_type" @click="modelType"  class="custom-control-input">
                            <label class="custom-control-label" for="model_select_all">Select All</label>
                    </div>
                </div>
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="model_select_manually" value="2" v-model="model_type" @click="modelType" class="custom-control-input">
                            <label class="custom-control-label" for="model_select_manually">Select Manually</label>
                    </div>
                </div>
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="model_select_all_rm" value="3" v-model="model_type" @click="modelType" class="custom-control-input">
                            <label class="custom-control-label" for="model_select_all_rm">Select all except</label>
                    </div>
                </div>
              </div>
            </div>

            <div class="row mt-2" id="modelShow">
              <div class="col-md-2 ml-5"><b></b></div>
              <div class="col-md-6">
                <select class="selectpicker form-control" multiple data-live-search="true" v-model="model_id" >
                  <option value="" disabled>Select Model</option>
                    <option v-for="model in models"
                      :key="model.id" 
                      :value="model.model_id">
                      {{model.model_num}}
                    </option>
                </select>
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
                        <input type="radio" id="country_select_all" value="1"  v-model="country_type" @click="countryType" class="custom-control-input">
                            <label class="custom-control-label" for="country_select_all">Select All</label>
                    </div>
                </div>
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="country_select_manually" value="2" v-model="country_type" @click="countryType"  class="custom-control-input">
                            <label class="custom-control-label" for="country_select_manually">Select Manually</label>
                    </div>
                </div>
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="country_select_all_rm" value="3" v-model="country_type" @click="countryType"  class="custom-control-input">
                            <label class="custom-control-label" for="country_select_all_rm">Select all except</label>
                    </div>
                </div>
              </div>
            </div>

            <div class="row mt-2" id="countryShow">
              <div class="col-md-2 ml-5"><b></b></div>
              <div class="col-md-6">
                <select class="selectpicker form-control" multiple data-live-search="true" v-model="country_id" @change="onChangeCountry()" >
                  <option value="" disabled>Select</option>
                    <option v-for="country in toolSel.countries"
                      :key="country.id" 
                      :value="country.country_id">
                      {{country.country_name}}
                    </option>
                </select>
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
                        <input type="radio" id="network_select_all" value="1" v-model="network_type" @click="networkType"  class="custom-control-input">
                            <label class="custom-control-label" for="network_select_all">Select All</label>
                    </div>
                </div>
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="network_select_manually" value="2" v-model="network_type" @click="networkType"  class="custom-control-input">
                            <label class="custom-control-label" for="network_select_manually">Select Manually</label>
                    </div>
                </div>
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="network_select_all_rm" value="3" v-model="network_type" @click="networkType" class="custom-control-input">
                            <label class="custom-control-label" for="network_select_all_rm">Select all except</label>
                    </div>
                </div>
              </div>
            </div>

            <div class="row mt-4" id="networkShow">
              <div class="col-md-2 ml-5"><b></b></div>
              <div class="col-md-6">
                <select class="selectpicker form-control" multiple data-live-search="true" v-model="network_id" >
                  <option value="" disabled>Select</option>
                    <option v-for="network in networks"
                      :key="network.id" 
                      :value="network.network_id">
                      {{network.network_name}}
                    </option>
                </select>
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
                        <input type="checkbox" class="custom-control-input" v-model="auto_process"  id="auto_process" data-parsley-multiple="groups" data-parsley-mincheck="2">
                            <label class="custom-control-label" for="auto_process"></label>
                    </div>
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Status</b></div>
              <div class="col-md-6">
                  <select  class=" form-control " v-model="status"  >
                  <option  value="" disabled>Select</option>
                    <option value="1" >
                      {{ ' Published' }}
                    </option>
                    <option  value="0">
                      {{ ' Unpublished' }}
                    </option>
                </select> 
              </div>
            </div>


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
                  type="button"  @click.prevent="createToolSel"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Save
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
    <loading
            :active.sync="isLoading"
            :can-cancel="true"
            loader="bars"
            color="#007BFF"
            :is-full-page="false"
          ></loading>
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
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
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
      },
      model_type:"2",
      network_type:"2",
      country_type:"2",
      tool_name:"",
      brand_name:"",
      tool_id:"",
      brand_id:"",
      model_id:[],
      network_id:[],
      country_id:[],
      status:"1",
      auto_process:"", 
      models:[],
      networks:[],
      brandID:"",
      model_select:"",
      country_select:"",
      network_select:"",
      model_error:true,
      country_error:true,
      network_error:true,
      isLoading:false,
      submitted: false,
      pageShow:true
    } 
  },

  validations: {
    
    tool_id:{required},
    brand_id:{required},
    // model_id:{required},
    // country_id:{required},
    // network_id:{required},
     
    },
  
mounted(){

    this.getToolSel();
    
    
  //For search data in dropdown
  require("../../../../../public/assets/js/bootstrap-select");
  require("../../../../../public/assets/css/bootstrap-select.min.css");

// Tool select option setting width
$(document).ready(function(){
  $("#select1").hover(function(){
  var e=document.querySelectorAll('.short')
  e.forEach(x=>{
    if(x.textContent.length>100)
    x.textContent=x.textContent.substring(0,100)+'...';
  })
  });

});

  // for hide/show multi-select box
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
   
    $('#model_select_manually').trigger('click');
    $('#country_select_manually').trigger('click');
    $('#network_select_manually').trigger('click');
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
    //  alert(this.model_select)
   },

   countryType(event){
     this.country_select=event.target.value;
    //  alert(this.country_select)
   },

   networkType(event){
     this.network_select=event.target.value;
    //  alert(this.network_select)
   },

   getToolSel() {
      // for loader
      this.isLoading = true;
      Url.get("/createToolSelections").then((response) => {
        this.toolSel = response.data;
        this.isLoading = false;
        setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
        }, 500);
      })
    },

    onChangeBrand() {
     //var brand_id = event.target.value;
   Url.get("/getModelList/"+ this.brand_id).then((response) => {
        this.models = response.data;
        setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
        }, 300);
   });
  },

  onChangeCountry() {
     //var brand_id = event.target.value;
   Url.get("/getNetworkList/"+ this.country_id).then((response) => {
        this.networks = response.data;
        setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
        }, 300);
   });
  },

  
    createToolSel(){

      // stop here if form is invalid
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return this.scrollToTop();
      }
      
      //for model
      if(this.model_select==1){
          this.model_id=[];
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
          this.country_id=[];
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
           this.network_id=[];
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

      

      Url.post("/storeToolSel",{
        tool_id:this.tool_id,
        brand_id:this.brand_id,
        model_type:this.model_type,
        model_id:this.model_id,
        country_type:this.country_type,
        network_id:this.network_id,
        network_type:this.network_type,
        country_id:this.country_id,
        auto_process:this.auto_process,
        status:this.status
      })
        .then(() => {
          Vue.$toast.open({
            message: "Record Added Successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          this.$router.push({ name: "toolSelections" });
        }).catch((error) => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors;
              
            }

            if (error.response.status === 403) {
            Vue.$toast.open({
            message: "User does not have the right permissions.",
            type: "error",
            position: 'top',
            duration: 5000,
            })
           }
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



