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
                <a href="javascript:void(0);">Manage-Assets</a>
              </li>
              <li class="breadcrumb-item">
                <a href="javascript:void(0);">Add-New</a>
              </li>
            </ol>
          </div>
          <h4 class="page-title">Add New</h4>
        </div>
        <!--end page-title-box-->
      </div>
      <!--end col-->
      <div class="col-md-12" v-if="pageShow">
        <form >
          <div class="card">
            <div class="card-body">
              
              <div class="row mt-4">
                <div class="col-md-2 ml-5">Slug<b class="required"> *</b></div>
                <div class="col-md-7">
                  <select
                    class="form-control"
                    v-model="form.slug"
                    :class="{ 'is-invalid': submitted && $v.form.slug.$error }"
                  >
                    <option value="" selected disabled>
                      Please Select
                    </option>
                    <option value="all-header">All-Header</option>
                    <option value="all-footer">All-Footer</option>
                    <option value="home-header">Home-Header</option>
                    <option value="home-footer">Home-Footer</option>
                    <option value="brand-header">Brand-Header</option>
                    <option value="brand-footer">Brand-Footer</option>
                    <option value="model-header">Model-Header</option>
                    <option value="model-footer">Model-Footer</option>
                    <option value="checkout-header">Checkout-Header</option>
                    <option value="checkout-footer">Checkout-Footer</option>
                    <option value="thankyou-header">Thankyou-Header</option>
                    <option value="thankyou-footer">Thankyou-Footer</option>
                  </select>
                  <div
                    v-if="submitted && !$v.form.slug.required"
                    class="invalid-feedback"
                  >
                    Slug is required
                  </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Script<b class="required"> *</b></div>
                <div class="col-md-7">
                  <textarea
                  class="form-control"
                  rows="3"
                  v-model="form.content"
                  placeholder="Add Texet"
                  id=""
                  :class="{ 'is-invalid': submitted && $v.form.content.$error }"
                ></textarea>
                  <div
                    v-if="submitted && !$v.form.content.required"
                    class="invalid-feedback"
                  >
                    Script is required
                  </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Status<b class="required"> *</b></div>
                <div class="col-md-7">
                  <select
                    class="form-control"
                    v-model="form.status"
                    :class="{ 'is-invalid': submitted && $v.form.status.$error }"
                  >
                    <option value="" selected disabled>
                      Please Select
                    </option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    
                  </select>
                  <div
                    v-if="submitted && !$v.form.status.required"
                    class="invalid-feedback"
                  >
                    Status is required
                  </div>
                </div>
              </div>

              <div class="row mt-4">
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
                  type="button" @click.prevent="createAsset"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Save
                </button>
                <router-link :to="{name:'assetList'}"
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
            </div>
        </form>
      </div>
      <div class="col-md-11" v-else>
        <div class="card col-md-12  ml-5">
          <div class="card-body ">
            <h4 class="ml-2">{{errors}}</h4>
          </div>
        </div>
      </div>


      
    </div>
    <!-- end page title end breadcrumb -->
  </div>
  <!-- container -->
  </div>

  <FooterComponent />
  </div>
</div>
</template>

<script>
import $ from "jquery";
import Url from "../../../../url";
import Loading from "vue-loading-overlay";
import { required, } from "vuelidate/lib/validators";
import MainMenuComponent from "../../../layout/MainMenuComponent.vue";
import TopbarComponent from "../../../layout/TopbarComponent.vue";
import FooterComponent from "../../../layout/FooterComponent.vue";
export default {
  data() {
    return {
      form: {
        slug: "",
        content:"",
        status:""
        
      },
      errors: "",
      submitted: false,
      pageShow:true
      
    };
  },

  components:{
    MainMenuComponent,
    TopbarComponent,
    FooterComponent,
  },

  validations: {
    form: {
      slug: { required },
      content: { required},
      status: { required},
     
    },
  },

  mounted() {
    // this.getRole();
  },
  methods: {

    //scrolling page for errors detecting
     scrollToTop() {
        window.scrollTo(0,0);
      },

    // getRole() {
    //   Url.get("/getRole").then((response) => {
    //     this.p_roles = response.data;
    //   })
    //   .catch((error) => {
    //      if (error.response.status === 403) {
    //       this.pageShow=false;
    //       console.log("Delete : " + error);
    //      }

    //      if (error.response.status === 422) {
    //         Vue.$toast.open({
    //         message: "Internal server error",
    //         type: "error",
    //         position: 'top',
    //         duration: 5000,
    //       })
    //      }
    //     });
    // },
    createAsset() {
      // stop here if form is invalid
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return this.scrollToTop();
      }
      Url.post("/createAsset",this.form)
        .then(() => {
          Vue.$toast.open({
            message: "Record Added Successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          this.$router.push({ name: "assetList" });
        })

        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            this.scrollToTop();
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
  },
};
</script>