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
                <a href="javascript:void(0);">Edit-Asset</a>
              </li>
            </ol>
          </div>
          <h4 class="page-title">Edit-Asset</h4>
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
                    v-model="asset.slug"
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
                  <span class="required" v-if="errors.slug">
                {{ errors.slug[0] }}
                </span>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Script<b class="required"> *</b></div>
                <div class="col-md-7">
                  <textarea
                  class="form-control"
                  rows="3"
                  v-model="asset.content"
                  placeholder="Add Texet"
                  id=""
                ></textarea>
                  <span class="required" v-if="errors.content">
                {{ errors.content[0] }}
                </span>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Status<b class="required"> *</b></div>
                <div class="col-md-7">
                  <select
                    class="form-control"
                    v-model="asset.status"
                    
                  >
                    <option value="" selected disabled>
                      Please Select
                    </option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                  <span class="required" v-if="errors.status">
                {{ errors.status[0] }}
                </span>
                </div>
              </div>

              <div class="row mt-4">
                <div class="form-check">
                  <label class="required" for="invalidCheck">
                    (*) Mandatory fields
                  </label>
                </div>
              </div>

              <loading
            :active.sync="isLoading"
            :can-cancel="true"
            loader="bars"
            color="#007BFF"
            :is-full-page="false"
          ></loading>
              <div class="row mt-3">
              <div class="col-md-2 ml-5"></div>
              <div class="col-md-6">
                <button
                  type="button" @click.prevent="updateAsset"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Update
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
      asset:"",
      slug: "",
      content:"",
      status:"",
      errors: "",
      submitted: false,
      pageShow:true,
      isLoading:false,
      
    };
  },

  components:{
    MainMenuComponent,
    TopbarComponent,
    FooterComponent,
    Loading
  },

  

  mounted() {
     this.editAsset();
  },
  methods: {

    //scrolling page for errors detecting
     scrollToTop() {
        window.scrollTo(0,0);
      },

    editAsset() {
      //for loader
      this.isLoading = true;
      Url.get("/editAsset/"+this.$route.params.id).then((response) => {
        this.asset = response.data;
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

    updateAsset() {
      Url.post("/updateAsset/"+ this.$route.params.id,{
        slug:this.asset.slug,
        content:this.asset.content,
        status:this.asset.status

      })
        .then(() => {
          Vue.$toast.open({
            message: "Record Updated Successfully!",
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
        });
    },
  },
};
</script>