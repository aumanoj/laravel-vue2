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
                <li class="breadcrumb-item active">Edit-Model-Content</li>
              </ol>
            </div>
            <h4 class="page-title">Edit-Model-Content</h4>
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
              <div class="col-md-2 ml-5"><b>Brand</b></div>
              <div class="col-md-6">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Enter brand name "
                  id="name"
                  v-model="editModels.model.manufacturers.manu_name"
                  disabled
                />
                <!-- <label class="ml-2">{{model.manufacturers.manu_name}}</label> -->
              </div>
            </div>

            <!-- <input type="hidden" v-model="model.model_id"/> -->
            <!-- <input type="hidden" v-model="model.manufacturers.manu_id"/> -->
            
            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Model</b></div>
              <div class="col-md-6">
                <input
                  type="text"
                  class="form-control"
                  v-model="editModels.model.model_num"
                  placeholder=""
                  id="name"
                  disabled
                />
                <!-- <label class="ml-2">{{model.model_num}}</label> -->
                
                <span class="text-danger" v-if="errors.model_num">
                {{ errors.model_num[0] }}
                </span>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Page Content</b><b class="required"> *</b></div>
              <div class="col-md-6">    
                <textarea
                  id="editor1"
                  class="form-control editor"
                  v-model="editModels.model.description"
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
                  v-model="editModels.model.meta_title"
                  placeholder="Add Texet"
                  id="message"
                ></textarea>
                <span class="text-danger" v-if="errors.meta_title">
                {{ errors.meta_title[0] }}
                </span>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Focused Keywords</b>></div>
              <div class="col-md-6">
                <textarea
                  class="form-control"
                  rows="3"
                  v-model="editModels.model.meta_keyword"
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
                  v-model="editModels.model.meta_desc"
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
                  v-model="editModels.model.heading_title"
                  placeholder="Add Texet"
                  id="message"
                ></textarea>
                
              </div>
            </div>

            <!-- <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Instruction URL</b></div>
              <div class="col-md-6">
                <textarea
                  class="form-control"
                  rows="2"
                  placeholder="Add Texet"
                  id="message"
                ></textarea>
              </div>
            </div> -->

            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Image Gallery</b></div>
              <div class="col-md-6">
                <input type="file" accept="image/*" id=attachments  multiple class="form-control" @change="uploadFieldChange"/>
              </div>
              
            </div>

            <div class="row mt-4 ml-5">
              <div class="col-md-3" v-for="att in editModels.images" :key="att.id">
                <img v-if="att.image_name" :src="'/images/model/'+att.image_name"  width="30%" height="100">
                <span class=""  @click="removeImage(att.id)"><button class="btn btn-xs btn-danger mt-2 ml-2">Remove</button></span>
                <br><span class="label label-primary mt-1">{{ att.image_name }}</span> 
                
              </div>
            </div>

            <div class="row mt-4 ml-5">
              
              <div class="col-md-3 " v-for="attachment in attachments" :key="attachment.id">
                <!-- <img v-if="attachment" :src="attachment"  width="30%" height="100"> -->
                <span class="label label-primary mt-1">{{ attachment.name }}</span> 
                <span class=""  @click="removeAttachment(attachment)"><button class="btn btn-xs btn-danger mt-2 ml-2">Remove</button></span>
              </div>
            </div>

            <!-- <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Priority Number</b></div>
              <div class="col-md-3">
                
                  <select  class=" form-control " v-model="model.priority_number"  >
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
                
                  <select  class=" form-control " v-model="model.status"  >
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
                  type="button" @click.prevent="updateModel"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Update
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
import MainMenuComponent from "../../../layout/MainMenuComponent.vue";
import TopbarComponent from "../../../layout/TopbarComponent.vue";
import FooterComponent from "../../../layout/FooterComponent.vue";
export default {
    data(){
        return{
            editModels:"",
            editModels:{
                model:{
                  manufacturers:{
                    manu_name:""
                    },
                },
                images:{
                  image_name:""
                }
                },
              model:"",
            model_image:"",
            model_num:"",
            meta_title:"",
            meta_desc:"",
            description:"",
            meta_keyword:"",
            manu_id:"",
            model_id:"",
            errors:"",
            heading_title:"",
            priority_number:"",
            status:"",
            m_image:"",
            isLoading:false,
            url:null,
            attachment:"",
            attachments: [],
            data: new FormData(),
            m_image:[],
            pageShow:true

        }
    },


  mounted() {

      this.editModel();

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

  

    editModel() {
      //for loader
      this.isLoading = true;
      // setTimeout(() => {
      //   this.isLoading = false;
      // }, 1000);
      Url.get("/editModelContent/"+this.$route.params.id).then((response) => {
        this.editModels = response.data;
        tinyMCE.get('editor1').setContent(this.editModels.model.description);
        this.isLoading = false;

        for (let t of this.editModels.images) {
        this.m_image.push(t.image_name);
        }

        // alert(this.editModels.images.image_name)
        
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

    uploadFieldChange(e) {
              
                var files = e.target.files || e.dataTransfer.files; 
                if (!files.length)
                    return;

                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                    //this.model_image.push(URL.createObjectURL(files[i]));   
                }
                console.log(this.attachments)
            },

    removeAttachment(attachment) { 
                this.attachments.splice(this.attachments.indexOf(attachment), 1);
    },

    removeImage(att) { 
      var _this=this;
      if(confirm("Do you really want to delete?")){
      Url.post("/deleteModelContentImg/" + att)
        .then(function (response) {   
          //this.editModels.images.splice(this.editModels.images.indexOf(att), 1);

          _this.editModel();
          Vue.$toast.open({
            message: "Record Deleted Successfully!",
            type: "success",
            position: 'top',
            duration: 3000
          });
          
          console.log(response.data);
        })
        .catch((error) => {
         if (error.response.status === 422) {
            Vue.$toast.open({
            message: "Internal server error",
            type: "error",
            position: 'top',
            duration: 5000,
          })
         }
        });
    }

            },

     updateModel() {
      // this.submitted = true;
      // this.$v.$touch();
      // if (this.$v.$invalid) {
      //   return;
      // }
      var description =  tinyMCE.get('editor1').getContent();
      this.data.delete('model_image[]'); 
      for (let i = 0; i < this.attachments.length; i++) {
      this.data.append('model_image[]',this.attachments[i])
      }

      this.data.append('manu_id',this.editModels.model.manu_id)
      this.data.append('model_id',this.editModels.model.model_id)
      this.data.append('model_num',this.editModels.model.model_num)
      this.data.append('description',description)
      this.data.append('meta_title',this.editModels.model.meta_title)
      this.data.append('meta_desc',this.editModels.model.meta_desc)
      this.data.append('meta_keyword',this.editModels.model.meta_keyword)
      this.data.append('heading_title',this.editModels.model.heading_title)

       document.getElementById("attachments").value = [];
       
      Url.post("/updateModelContent/" + this.$route.params.id,this.data)
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

    onFileChange(e) {
      const file = e.target.files[0];
      this.model.model_image = URL.createObjectURL(file);
    }

  }
};
</script>
