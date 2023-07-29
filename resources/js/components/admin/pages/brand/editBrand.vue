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
                <li class="breadcrumb-item active">Edit-Brand-Content</li>
              </ol>
            </div>
            <h4 class="page-title">Edit-Brand-Content</h4>
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
                <!-- <input
                  type="text"
                  class="form-control"
                  v-model="brand.manu_name"
                  placeholder="Enter brand name "
                  id="name"
                /> -->
                <label>{{brand.manu_name}}</label>
                <span class="text-danger" v-if="errors.manu_name">
                {{ errors.manu_name[0] }}
                </span>
              </div>
            </div>
            <input type="hidden"  v-model="brand.manu_id"/>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Page Content</b><b class="required"> *</b></div>
              <div class="col-md-6">
                 
                <textarea
                  id="editor1"
                  class="form-control editor"
                  v-model="brand.description"
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
                  v-model="brand.meta_title"
                  placeholder="Add Texet"
                  id="message"
                ></textarea>
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
                  v-model="brand.meta_keyword"
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
                  v-model="brand.meta_desc"
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
                  v-model="brand.heading_title"
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
                  v-model="brand.instruction_url"
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
                  v-model="brand.backtracklinks"
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
                                v-model="brand.minimum_price"
                                class="form-control" 
                                placeholder="Min Price">
                                
                            </div>
                            <div class="col-md-1 mt-1">
                              Maximum Price
                            </div>
                            <div class="col-md-2">
                              <input type="number" 
                                v-model="brand.maximum_price"
                                class="form-control" 
                                placeholder="Max Price">
                                  
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
                  type="button" @click.prevent="updateBrand"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Update
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
import MainMenuComponent from "../../../layout/MainMenuComponent.vue";
import TopbarComponent from "../../../layout/TopbarComponent.vue";
import FooterComponent from "../../../layout/FooterComponent.vue";
export default {

      data(){
      return{
        brand:"",
        manu_id:"",
        manu_name:"",
        meta_title:"",
        meta_desc:"",
        meta_keyword:"",
        description:"",
        backtracklinks:"",
        heading_title:"",
        instruction_url:"",
        minimum_price:"",
        maximum_price:"",
        errors:"",
        isLoading:false,
        pageShow:true
      }
    },
  mounted() {

    this.editBrand();

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

    components: {
      MainMenuComponent,
    TopbarComponent,
    FooterComponent,
    Loading,
  },

  methods: {
    editBrand() {
      //for loader
      this.isLoading = true;
      // setTimeout(() => {
      //   this.isLoading = false;
      // }, 1000);
      Url.get("/editBrandContent/"+this.$route.params.id).then((response) => {
        this.brand = response.data;
        tinyMCE.get('editor1').setContent(this.brand.description);
        tinyMCE.get('editor2').setContent(this.brand.backtracklinks);
        
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

    updateBrand() {
      // this.submitted = true;
      // this.$v.$touch();
      // if (this.$v.$invalid) {
      //   return;
      // }
      var description =  tinyMCE.get('editor1').getContent();
      var backtracklinks =  tinyMCE.get('editor2').getContent();

      Url.post("/updateBrandContent/" + this.$route.params.id, {
        manu_id: this.brand.manu_id,
        manu_name: this.brand.manu_name,
        description:description,
        backtracklinks:backtracklinks,
        meta_title: this.brand.meta_title,
        meta_desc:this.brand.meta_desc,
        meta_keyword:this.brand.meta_keyword,
        instruction_url:this.brand.instruction_url,
        heading_title:this.brand.heading_title,
        minimum_price:this.brand.minimum_price,
        maximum_price:this.brand.maximum_price
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
            //this.scrollToTop();
            // Vue.$toast.open({
            //   message: "All fields are required",
            //   type: "error",
            //   position: "top",
            //   duration: 5000,
            // });
          }
        });
    },


  }
    
  
};
</script>
