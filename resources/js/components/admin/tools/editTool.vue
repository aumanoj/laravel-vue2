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
                <li class="breadcrumb-item active"> Edit Tool</li>
              </ol>
            </div>
            <h4 class="page-title">Edit Tool</h4> 
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
             <!-- <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Tool Id</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <input
                  type="text"
                  class="form-control"
                  v-model="tool.tool_id"
                  placeholder="Enter tool Id "
                  id="name"
                />
                <span class="text-danger" v-if="errors.tool_id">
                {{ errors.tool_id[0] }}
                </span>
              </div>
            </div> -->

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Vendor</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <select class="form-control" v-model="tool.suppliers.id" @change="getToolData(tool.suppliers.id)">
                    <option value="" selected disabled>
                      Please Select Role
                    </option>
                    <option  v-for="vendor in vendors"
                      :key="vendor.id"
                      :value="vendor.id" >
                      {{ vendor.suppliar_name }}
                    </option>
                  </select>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Tool ID</b><b class="required"> *</b></div>
              <div class="col-md-6"> 
                <Select2 
                  class="form-control" 
                  v-model="tool.tool_id" 
                  :class="{ 'is-invalid': submitted && $v.tool_id.$error }" 
                  :options="toolOptions"
                  placeholder="Select Tools"
                  @change="getApiPrice(tool.tool_id)"/>

                  <div
                  v-if="submitted && !$v.tool_id.required"
                  class="invalid-feedback"
                >
                  toolID is required
                </div>
              </div>
            </div>

            <!-- <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Tool ID</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <select class="form-control" v-model="tool.tool_id" :class="{ 'is-invalid': submitted && $v.tool_id.$error }">
                    <option value="" selected disabled>
                      Select Tools
                    </option >
                    <option  v-for="funCredit,i in toolOptions"
                      :key="i"
                      :value="funCredit.tool_id"> {{tool.tool_id}}
                    </option>
                  </select>
                  <div
                  v-if="submitted && !$v.tool_id.required"
                  class="invalid-feedback"
                >
                  ToolID is required
                </div>
              </div>
            </div> -->

            

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>API Price</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <input
                  type="text"
                  v-model="tool.api_price"
                  class="form-control"
                  placeholder="Enter api price "
                  id="name"
                />
                <span class="text-danger" v-if="errors.api_price">
                {{ errors.api_price[0] }}
              </span>
              </div>
            </div>

            

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Tool Name</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <input
                  type="text"
                  class="form-control"
                  v-model="tool.tool_name"
                  placeholder="Enter tool name "
                  id="name"
                />
                <span class="text-danger" v-if="errors.tool_name">
                {{ errors.tool_name[0] }}
              </span>
              </div>
            </div>

            

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Selling Price</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <input
                  type="text"
                  v-model="tool.selling_price"
                  class="form-control"
                  placeholder="Enter selling price "
                  id="name"
                />
              <span class="text-danger" v-if="errors.selling_price">
                {{ errors.selling_price[0] }}
              </span>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>MRP</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <input
                  type="text"
                  v-model="tool.mrp"
                  class="form-control"
                  placeholder="Enter MRP "
                  id="name"
                />
                <span class="text-danger" v-if="errors.mrp">
                {{ errors.mrp[0] }}
              </span>
              </div>
            </div>

            <!-- <input type="hidden" v-model="provider_id" /> -->

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Summery</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <textarea
                  id="editor1"
                  v-model="tool.summary"
                  class="form-control editor"
                ></textarea>
                <span class="text-danger" v-if="errors.summary">
                {{ errors.summary[0] }}
              </span>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Detail Summery </b></div>
              <div class="col-md-6">
                <textarea
                  id="editor2"
                  v-model="tool.detail_summary"
                  class="form-control editor"
                ></textarea>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Estimated Time</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <input
                  type="text"
                  v-model="tool.estimated_time"
                  class="form-control"
                  placeholder="Enter estimated time "
                  id="name"
                />
              <span class="text-danger" v-if="errors.estimated_time">
                {{ errors.estimated_time[0] }}
              </span>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Guaranted Time</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <input
                  type="text"
                  class="form-control"
                  v-model="tool.guaranted_time"
                  placeholder="Enter guaranted time "
                  id="name"
                />
                <span class="text-danger" v-if="errors.guaranted_time">
                {{ errors.guaranted_time[0] }}
              </span>
              </div>
            </div>
            

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Instruction</b></div>
              
              <div class="col-md-6">
                <textarea
                  id="editor3"
                  v-model="tool.instruction"
                  class="form-control editor"
                  name=""
                ></textarea>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5 mt-3"><b>PRD Required</b></div>
              <div class="col-md-6">
                <div class="form-check-inline my-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" v-model="tool.is_sip" id="customCheck6" data-parsley-multiple="groups" data-parsley-mincheck="2">
                            <label class="custom-control-label" for="customCheck6"></label>
                    </div>
                </div>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-md-2 ml-5 mt-3"><b>IMEI Required</b></div>
              <div class="col-md-6">
                <div class="form-check-inline my-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" v-model="tool.is_imei" id="customCheck7" data-parsley-multiple="groups" data-parsley-mincheck="2">
                            <label class="custom-control-label" for="customCheck7"></label>
                    </div>
                </div>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-md-2 ml-5 mt-1"><b>Unlock Type</b></div>
              <div class="col-md-6">
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio7" value="imei_unlock" v-model="tool.unlock_type" name="customRadio" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio7">IMEI Unlock</label>
                    </div>
                </div>
                <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio8" value="software_unlock" v-model="tool.unlock_type" name="customRadio" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio8">Software Unlock</label>
                    </div>
                </div>
              </div>
            </div>

             <!-- <loading
            :active.sync="isLoading"
            :can-cancel="true"
            loader="bars"
            color="#007BFF"
            :is-full-page="false"
          ></loading> -->

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
                  type="button" @click.prevent="UpdateTool"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Update
                </button>
                <router-link :to="{name:'tools'}"
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

<script>
import Vue from "vue";
import VueToast from "vue-toast-notification";
Vue.use(VueToast);
import Url from "../../../url";
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import Select2 from 'v-select2-component';
import MainMenuComponent from "../../layout/MainMenuComponent.vue";
import TopbarComponent from "../../layout/TopbarComponent.vue";
import FooterComponent from "../../layout/FooterComponent.vue";
Vue.component ('Select2',Select2);

export default {
    components: {
      Select2,
      MainMenuComponent,
    TopbarComponent,
    FooterComponent,
    },
    data(){
        return{
          funCredits:"",
            tool:"",
            tool:{suppliers:{suppliar_name:""}},
            vendors:"",
            vendor:"",
            tool_id:"",
            provider_id:"",
            tool_name:"",
            api_price:"",
            selling_price:"",
            mrp:"",
            summary:"",
            detail_summary:"",
            estimated_time:"",
            guaranted_time:"",
            instruction:"",
            is_sip:"",
            is_imei:"",
            unlock_type:"",
            isLoading:false,
            errors:"",
            pageShow:true,
            toolOptions: [],
            submitted:false
        }
    },

    mounted() {
        this.getTool();
        this.getVendors();
      

     $(document).ready(function () {
      addTinyMCE();
        tinymce.remove(".editor");
      addTinyMCE();
     });
 
    // Add TinyMCE1
    function addTinyMCE() {
      // Initialize
      tinymce.init({
        selector: ".editor",
        theme: "modern",
        height: 300,
        plugins: [
          "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
          "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
          "save table contextmenu directionality emoticons template paste textcolor",
        ],
        toolbar:
          "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
          { title: "Bold text", inline: "b" },
          { title: "Red text", inline: "span", styles: { color: "#ff0000" } },
          { title: "Red header", block: "h1", styles: { color: "#ff0000" } },
          { title: "Example 1", inline: "span", classes: "example1" },
          { title: "Example 2", inline: "span", classes: "example2" },
          { title: "Table styles" },
          { title: "Table row 1", selector: "tr", classes: "tablerow1" },
        ],
      });
    }

  },

  methods:{

    //scrolling page for errors detecting
     scrollToTop() {
        window.scrollTo(0,0);
      },

    getVendors() {
      Url.get("/getVendor").then((response) => {
        this.vendors = response.data.vendors;
        this.toolOptions = response.data.toolOptions;
      })
    },

      getTool() {
      // for loader
      this.isLoading = true;
      Url.get("/editTool/"+this.$route.params.id).then((response) => {
        this.tool = response.data;
        var summary =  tinyMCE.get('editor1').setContent(this.tool.summary);
        var detail_summary =  tinyMCE.get('editor2').setContent(this.tool.detail_summary);
        var instruction =  tinyMCE.get('editor3').setContent(this.tool.instruction);
        this.isLoading = false;
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

    UpdateTool(){
      var summary =  tinyMCE.get('editor1').getContent();
      var detail_summary =  tinyMCE.get('editor2').getContent();
      var instruction =  tinyMCE.get('editor3').getContent();
      //alert(summary);
      Url.post("/updateTool/"+ this.$route.params.id,{
        tool_id:this.tool.tool_id,
        provider_id:this.tool.suppliers.id,
        tool_name:this.tool.tool_name,
        api_price:this.tool.api_price,
        selling_price:this.tool.selling_price,
        mrp:this.tool.mrp,
        summary:summary,
        detail_summary:detail_summary,
        estimated_time:this.tool.estimated_time,
        guaranted_time:this.tool.guaranted_time,
        instruction:instruction,
        is_sip:this.tool.is_sip,
        is_imei:this.tool.is_imei,
        unlock_type:this.tool.unlock_type

      })
        .then(() => {
          Vue.$toast.open({
            message: "Record Added Successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          this.$router.push({ name: "tools" });
        })

        .catch((error) => {
         if (error.response.status === 422) {
           this.errors = error.response.data.errors;
              this.scrollToTop();
            Vue.$toast.open({
            message: "All (*) fields required.",
            type: "error",
            position: 'top',
            duration: 5000,
          })
         }
        });
        
    },
     getToolData(provider_id)
    {
      //alert(provider_id);
      this.isLoading = true;
      Url.get("/getToolData/"+provider_id).then((response) => {
        this.toolOptions = response.data.toolOptions;
        this.isLoading = false;
      })
    },

    getApiPrice(tool_id)
    {
      
      this.isLoading = true;
      Url.get("/getApiPrice/"+tool_id).then((response) => {
        
        if (response.data.api_price > 0) {
          this.tool.api_price = response.data.api_price;  
        } else {
          this.tool.api_price = '';
        }
        this.isLoading = false;
      })
    },
  }
}
</script>
