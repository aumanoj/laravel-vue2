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
                <li class="breadcrumb-item active">Create-Brand-Content</li>
              </ol>
            </div>
            <h4 class="page-title">Create-Brand-Content</h4>
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
              <div class="col-md-2 ml-5"><b>Brand</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <select class=" form-control mb-3 selectpicker"  data-live-search="true" id="brand_name" @change="getBrandName()" v-model="manu_id"  :class="{ 'is-invalid': submitted && $v.manu_id.$error }">
                  <option value="" disabled>Select Brand</option>
                  <option :value="0" >All</option>
                    <option  v-for="brand in brands"
                      :key="brand.id"
                      :value="brand.manu_id"  >
                      {{brand.manu_name}}
                    </option>
                </select>
                <div
                  v-if="submitted && !$v.manu_id.required"
                  class="danger"
                >
                  Brand is required
                </div>
                <span class="text-danger" v-if="errors.manu_id">
                {{ errors.manu_id[0] }}
                </span>
              </div>
            </div>


            <input type="hidden" id="" v-model="manu_id"/>

            <!-- <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Brand Id</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <input
                  type="text"
                  class="form-control"
                  v-model="manu_id"
                  placeholder="Enter brand Id "
                  id="name"
                  :class="{ 'is-invalid': submitted && $v.manu_id.$error }"
                />
                <div
                  v-if="submitted && !$v.manu_id.required"
                  class="invalid-feedback"
                >
                  Brand Id is required
                </div>
                <span class="text-danger" v-if="errors.manu_id">
                {{ errors.manu_id[0] }}
                </span>
              </div>
            </div> -->
            

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Page Content</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <textarea
                  id="editor1"
                  class="form-control editor"
                  v-model="description"
                ></textarea>
                <span class="text-danger" v-if="errors.description">
                {{ errors.description[0] }}
                </span>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Meta Tilte</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <textarea
                  class="form-control"
                  rows="3"
                  v-model="meta_title"
                  placeholder="Add Texet"
                  id="message" :class="{ 'is-invalid': submitted && $v.meta_title.$error }"
                ></textarea>
                <div
                  v-if="submitted && !$v.meta_title.required"
                  class="invalid-feedback"
                >
                  Meta title is required
                </div>
                <span class="text-danger" v-if="errors.meta_title">
                {{ errors.meta_title[0] }}
                </span>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Focused Keywords</b></div>
              <div class="col-md-6">
                <textarea
                  class="form-control"
                  rows="3"
                  v-model="meta_keyword"
                  placeholder="Add Texet"
                  id="message" 
                ></textarea>
                 
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Meta Description</b></div>
              <div class="col-md-6">
                <textarea
                  class="form-control"
                  rows="3"
                  v-model="meta_desc"
                  placeholder="Add Texet"
                  id="message"
                  
                ></textarea>
                 
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>H1 Contents</b></div>
              <div class="col-md-6">
                <textarea
                  class="form-control"
                  rows="3"
                  v-model="heading_title"
                  placeholder="Add Texet"
                  id="message"
                  
                ></textarea>
                
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Instruction URL</b></div>
              <div class="col-md-6">
                <textarea
                  class="form-control"
                  rows="2"
                  v-model="instruction_url"
                  placeholder="Add Texet"
                  id="message"
                
                ></textarea>
                
              </div>
            </div> 

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Back Track Links</b></div>
              <div class="col-md-6">
                <textarea
                  id="editor2"
                  class="form-control editor"
                  v-model="backtracklinks"
                ></textarea>
                
              </div>
            </div>

            <div class="row mt-5">
                            <div class="col-md-2 ml-5"><b>Price Range</b></div>
                            <div class="col-md-1 mt-1">
                              Minimum Price
                            </div>
                            <div class="col-md-2">
                              <input type="number" 
                                v-model="minimum_price"
                                class="form-control" 
                                placeholder="Min Price">
                                
                            </div>
                            <div class="col-md-1 mt-1">
                              Maximum Price
                            </div>
                            <div class="col-md-2">
                              <input type="number" 
                                v-model="maximum_price"
                                class="form-control" 
                                placeholder="Max Price">
                                
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
                  type="button" @click.prevent="createBrand"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Save
                </button>
                <router-link :to="{name:'brandList'}"
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
import $ from "jquery";
import Url from "../../../../url";
import Loading from "vue-loading-overlay";
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import MainMenuComponent from "../../../layout/MainMenuComponent.vue";
import TopbarComponent from "../../../layout/TopbarComponent.vue";
import FooterComponent from "../../../layout/FooterComponent.vue";
export default {

      data(){
      return{
        brand:"",
        brands:"",
        manu_id:"",
        manu_name:"",
        meta_title:"",
        meta_desc:"",
        meta_keyword:"",
        description:"",
        heading_title:"",
        instruction_url:"",
        backtracklinks:"",
        minimum_price:"",
        maximum_price:"",
        errors:"",
        isLoading:false,
        submitted:false,
        pageShow:true
      }
    },

    validations: {

      manu_id:{required},
      meta_title: { required },
      

     
    },

  mounted() {

    //For search data in dropdown
    require("../../../../../../public/assets/js/bootstrap-select");
    require("../../../../../../public/assets/css/bootstrap-select.min.css");
    this.getBrands();

    $(document).ready(function () {
      $('.selectpicker').selectpicker();
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

    components: {
      MainMenuComponent,
    TopbarComponent,
    FooterComponent,
    Loading,
  },

  methods: {
    //scrolling page for errors detecting
     scrollToTop() {
        window.scrollTo(0,0);
      },

      getBrandName(){
        this.manu_name=$("#brand_name option:selected").text();
        // alert(this.manu_name);
      },

      getBrands(){
        Url.get("/getBrandsCont").then((response) => {
        this.brands = response.data;
        this.isLoading = false;
        setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
        }, 300);
      })
      },
    
    createBrand() {

    // stop here if form is invalid
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return this.scrollToTop();
      }
      
      var description =  tinyMCE.get('editor1').getContent();
      var backtracklinks =  tinyMCE.get('editor2').getContent();

      Url.post("/createBrandContent" , {
        manu_id: this.manu_id,
        manu_name: this.manu_name,
        description:description,
        meta_title: this.meta_title,
        meta_desc:this.meta_desc,
        meta_keyword:this.meta_keyword,
        backtracklinks:backtracklinks,
        heading_title:this.heading_title,
        instruction_url:this.instruction_url,
        minimum_price:this.minimum_price,
        maximum_price:this.maximum_price
      })
        .then((response) => {
          Vue.$toast.open({
            message: "Record Updated Successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          console.log(response.data);
          this.$router.push({ name: "brandList" });
        })

        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            this.scrollToTop();
            // Vue.$toast.open({
            //   message: "All fields are required",
            //   type: "error",
            //   position: "top",
            //   duration: 5000,
            // });
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
    },


  }
    
  
};
</script>

<style scoped>
.danger{
  width: 100%; 
  font-size: 80%;
  margin-top: .30rem;
  color: #dc3545;
}


</style>