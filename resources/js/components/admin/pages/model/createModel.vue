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
                <li class="breadcrumb-item active">Create-Model-Content</li>
              </ol>
            </div>
            <h4 class="page-title">Create-Model-Content</h4>
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
                <select class="form-control selectpicker" data-live-search="true" v-model="manu_id" @change="getModels()" :class="{ 'is-invalid': submitted && $v.manu_id.$error }">
                    <option value="" selected disabled>
                      Select Brand
                    </option >
                    <option :value="0" >All</option>
                    <option v-for="brand in brands" 
                      :key="brand.id"
                      :value="brand.manu_id" >
                      {{ brand.manu_name }}
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

            <!-- <input type="hidden" v-model="model.model_id"/> -->
            <!-- <input type="hidden" v-model="model.manufacturers.manu_id"/> -->
            
            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Model</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <select class="form-control selectpicker" data-live-search="true" id="model_name" @change="getModelName()" v-model="model_id" :class="{ 'is-invalid': submitted && $v.model_id.$error }">
                    <option value="" selected disabled>
                      Select Model
                    </option >
                    <option :value="0" >All</option>
                    <option v-for="model in models" 
                      :key="model.id"
                      :value="model.model_id" >
                      {{ model.model_num }}
                    </option> 
                  </select>
                <div
                  v-if="submitted && !$v.model_id.required"
                  class="danger"
                >
                  Model is required
                </div>
                <span class="text-danger" v-if="errors.model_id">
                {{ errors.model_id[0] }}
                </span>
              </div>
            </div>

            <!-- <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Model Id</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <input
                  type="text"
                  class="form-control"
                  v-model="model_id"
                  placeholder=""
                  id="name"
                  :class="{ 'is-invalid': submitted && $v.model_id.$error }"
                />
                <div
                  v-if="submitted && !$v.model_id.required"
                  class="invalid-feedback"
                >
                  Model Id is required
                </div>
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
                  id="message"
                  :class="{ 'is-invalid': submitted && $v.meta_title.$error }"
                ></textarea>
                <div
                  v-if="submitted && !$v.meta_title.required"
                  class="invalid-feedback"
                >
                  Meta title is required
                </div>
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
                  placeholder="Add Texet"
                  v-model="heading_title"
                  id="message"
                  
                ></textarea>
                
              </div>
            </div>

            

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Image Gallery</b></div>
              <div class="col-md-6">
                <input multiple  type="file"  accept="image/*" id=attachments   class="form-control" @change="uploadFieldChange" 
                     />
                <!-- <div
                  v-if="submitted && !$v.model_image.required"
                  class="invalid-feedback"
                >
                  Image is required
                </div> -->
                
              </div>
            </div>

            <div class="row mt-4 ml-5">
              <!-- <div class="col-md-6"  v-for="att in model_image" :key="att.id">
                <img v-if="att" :src="att"  width="30%" height="100">
              </div> -->
                <div class="col-md-3"  v-for="attachment in attachments" :key="attachment.id"> 
                        <!-- <img v-if="attachment" :src="attachment"  width="30%" height="100"> -->
                      <span class="label label-primary mt-1">{{ attachment.name }}</span> 
                      <span class=""  @click="removeAttachment(attachment)"><button class="btn btn-xs btn-danger mt-2 ml-2">Remove</button></span>
                </div>
                
            </div>

            <!-- <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Priority Number</b></div>
              <div class="col-md-3">
                  <select  class=" form-control " v-model="priority_number"  >
                  <option  value="" disabled>Select</option>
                    <option value="1" >
                      {{ ' High' }}
                    </option>
                    <option  value="0">
                      {{ ' Low' }}
                    </option>
                </select> 
              </div>
            </div> -->

            <!-- <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Status</b></div>
              <div class="col-md-3">
                  <select  class=" form-control " v-model="status"  >
                  <option  value="" disabled>Select</option>
                    <option value="1" >
                      {{ ' Active' }}
                    </option>
                    <option  value="0">
                      {{ ' Inactive' }}
                    </option>
                </select> 
              </div>
            </div> -->

            

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
                  type="button" @click.prevent="createModel"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Save
                </button>
                <router-link :to="{name:'modelList'}"
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
            model:"",
            models:"",
            brands:"",
            manu_id:"",
            model_image:[],
            files:[],
            model_num:"",
            model_id:"",
            meta_title:"",
            meta_desc:"",
            meta_keyword:"",
            manu_id:"",
            model_id:"",
            description:"",
            select:"",
            instruction_url:"",
            heading_title:"",
            priority_number:"1",
            status:"1",
            isLoading:false,
            submitted:false,
            url:null,
            errors:"",
            // You can store all your files here
            attachments: [],
            // Each file will need to be sent as FormData element
            data: new FormData(),
            pageShow:true

        }
    },

    validations: {
    
      manu_id: { required },
      model_id: {required},
      meta_title: { required },
     
      
     
    },

  mounted() {

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


    // prepareFields() {
                
                // if (this.attachments.length > 0) {
                //     for (var i = 0; i < this.attachments.length; i++) {
                //         let attachment = this.attachments[i];
                //         this.data.append('attachments[]', attachment);
                //     }

                //    // alert(this.data)
                // }
    //         },
            // This function will be called every time you add a file
            uploadFieldChange(e) {
              
                var files = e.target.files || e.dataTransfer.files; 
                if (!files.length)
                    return;

                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                    this.model_image.push(URL.createObjectURL(files[i]));
                    
                }
                console.log(this.attachments)
                // alert(this.attachments)
            },
            
            removeAttachment(attachment) { 
                this.attachments.splice(this.attachments.indexOf(attachment), 1);
            },
    getBrands() {
      //for loader
      this.isLoading = true;
      Url.get("/getBrandCont").then((response) => {
        this.brands = response.data;
        this.isLoading = false;
        setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
        }, 300);
      });
    },

    getModels() {
      //for loader
      this.isLoading = true;
      Url.get("/getModelList/"+this.manu_id).then((response) => {
        this.models = response.data;
        this.isLoading = false;
        setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
        }, 300);
      });
    },

    getModelName(){
      this.model_num=$("#model_name option:selected").text();
        // alert(this.model_num)
    },

     createModel() {
      // stop here if form is invalid
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return this.scrollToTop();
      }
      var description =  tinyMCE.get('editor1').getContent();

      this.data.delete('model_image[]'); 
      for (let i = 0; i < this.attachments.length; i++) {
      this.data.append('model_image[]',this.attachments[i])
      }

      this.data.append('manu_id',this.manu_id)
      this.data.append('model_id',this.model_id)
      this.data.append('model_num',this.model_num)
      this.data.append('description',description)
      this.data.append('meta_title',this.meta_title)
      this.data.append('meta_desc',this.meta_desc)
      this.data.append('meta_keyword',this.meta_keyword)
      this.data.append('heading_title',this.heading_title)
      // const config = {headers: {'Content-Type': 'multipart/form-data'}}

      document.getElementById("attachments").value = [];
      
      
      Url.post("/createModelContent" ,this.data)
        .then((response) => {
          Vue.$toast.open({
            message: "Record Updated Successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          console.log(response.data);
          this.$router.push({ name: "modelList" });
        })

        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            this.scrollToTop();
            //this.scrollToTop();
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

    

    // onFileChange(e) {
    //   const file = e.target.files[0];
    //   this.model_image = URL.createObjectURL(file);
    // }

  }
};
</script>

<style scoped>
.danger{
  width: 100%; 
  font-size: 80%;
  margin-top: .50rem;
  color: #dc3545;
}
</style>