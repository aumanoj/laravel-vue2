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
                  <a href="javascript:void(0);">Models</a>
                </li>
                <li class="breadcrumb-item active">Edit-Models</li>
              </ol>
            </div>
            <h4 class="page-title">Edit-Models</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="row" v-if="pageShow">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Brand</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <select class="form-control selectpicker" data-live-search="true" v-model="manu_id" :class="{ 'is-invalid': submitted && $v.manu_id.$error }">
                    <option value="" selected disabled>
                      Select Brand
                    </option >
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
            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Model ID</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <input 
                  type="text"
                  placeholder="Enter Model ID"
                  class="form-control"
                  id="model_id"
                  v-model="model_id"
                />
                <div v-if="submitted && !$v.model_id.required" class="danger">
                  Model ID is required
                </div>
                <span class="text-danger" v-if="errors.model_id">{{ errors.model_id[0] }}</span>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-md-2 ml-5"><b>Model</b><b class="required"> *</b></div>
              <div class="col-md-6">
                <input 
                  type="text"
                  placeholder="Enter Model Number"
                  class="form-control"
                  id="model_name"
                  v-model="model_name" 
                />
                <div v-if="submitted && !$v.model_name.required" class="danger"
                >
                  Model number is required
                </div>
              </div>
            </div>
            <div class="row mt-4">
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
            </div>
            <div class="row mt-4">
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
                  type="button" @click.prevent="updateModels"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Update
                </button>
                <router-link :to="{name:'listModels'}"
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
        modle:"",
        brands:"",
        model_id:"",
        model_name:"",
        manu_id:"",
        priority_number:"0",
        status:"1",
        isLoading:false,
        submitted:false,
        url:null,
        errors:"",
        data: new FormData(),
        pageShow:true
        }
    },

    validations: {
      manu_id: { required },
      model_name: {required},
      model_id: {required},
    },

    mounted() {
      require("../../../../../../public/assets/js/bootstrap-select");
      require("../../../../../../public/assets/css/bootstrap-select.min.css");

      this.getBrands();
      this.getModel();
    },

    components: {
      MainMenuComponent,
    TopbarComponent,
    FooterComponent,
      Loading,
    },

    methods: {
      scrollToTop() {
        window.scrollTo(0,0);
      },
      getBrands() {
          this.isLoading = true;
        Url.get("/getBrandCont").then((response) => {
          this.brands = response.data;
          this.isLoading = false;
          setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
          }, 300);
        });
      },
      getModel() {
        //alert('hdsgh');
        this.isLoading = true;
        Url.get('/editModel/'+this.$route.params.id).then((
          response) => {
          this.manu_id = response.data.manu_id;
          this.model_id = response.data.model_id;
          this.model_name = response.data.model_num;
          this.priority_number=response.data.priority_number;
          this.status=response.data.status;
          this.isLoading=false;
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
      updateModels() {
      Url.post("/updateModel/"+ this.$route.params.id,{
        manu_id:this.manu_id,
        model_id:this.model_id,
        model_name:this.model_name,
        priority_number:this.priority_number,
        status:this.status
      })
        .then(() => {
          Vue.$toast.open({
            message: "Record Updated Successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          this.$router.push({ name: "listModels" });
        })
      },
      
    },
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