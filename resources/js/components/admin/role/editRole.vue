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
                <a href="javascript:void(0);">Role</a>
              </li>
              <li class="breadcrumb-item">
                <a href="javascript:void(0);">Edit-Role</a>
              </li>
            </ol>
          </div>
          <h4 class="page-title">Edit Role</h4>
        </div>
        <!--end page-title-box-->
      </div>
      <!--end col-->
      <div class="col-md-12" v-if="pageShow">
        <!-- <router-link :to="{name:'roleList'}"
          ><button type="button" class="btn btn-primary px-4 mt-0 mb-3">
            Back
          </button></router-link
        > -->

        <form >
          <div class="card">
            <div class="card-body">

              <div class="row mt-4">
                <div class="col-md-2 ">Role Name<b class="required"> *</b></div>
                <div class="col-md-7">
                <input
                  type="text"
                  v-model="role.role.name"
                  class="form-control"
                  placeholder="Enter role name"
                  id="name"
                />
                <span class="text-danger" v-if="errors.name">
                  {{ errors.name[0] }}
                </span>
                <!-- <div
                  v-if="submitted && !$v.form.name.required"
                  class="invalid-feedback"
                >
                  Name is required
                </div> -->
                </div>
              </div>

              <div class="form-group mb-0 row">
                <label class="col-md-2 my-2 control-label"
                  >Permission <b class="required"> *</b></label
                >
              </div>
              <div class="form-group mb-0 " v-for="page in role.pageName" :key="page.id">
                <div class="">
                <label class="col-md-12 my-2  control-label"
                  ><b>{{page.name}} :</b></label
                ><br>
                </div>
              <div class="form-group" >
                <div class="col-md-12 row ml-5" >
                  <div class="checkbox mt-2" v-for="permission in role.permission" :key="permission.id">
                    <div class="custom-control custom-checkbox ml-5" v-if="page.id == permission.module_id">
                      <input
                        type="checkbox"
                          :id="permission.name"
                          class="custom-control-input"
                          v-model="selpermission"
                          :value="permission.name"
                          data-parsley-multiple="groups"
                          data-parsley-mincheck="2"
                      />&nbsp;
                      
                      <label class=" custom-control-label mb-1" :for="permission.name"
                        >{{permission.name}}</label
                      >
                      <!-- <multiselect v-model="form.permission" 
                        tag-placeholder="Add this as new tag" placeholder="Search or add a tag" 
                        label="name" track-by="name" :options="permissions" :multiple="true" :taggable="true"
                        @tag="addTag" :class="{ 'is-invalid': submitted && $v.form.permission.$error }">
                       </multiselect> -->
                       <!-- <div
                        v-if="submitted && !$v.form.permission.required"
                        class="invalid-feedback"
                      >
                      Permission is required
                      </div> -->
                    </div>
                  </div>
                </div>
                
              </div>
              </div>
              <!-- <pre class="language-json"><code>{{ role.rolePermissions}}</code></pre> -->
              <!-- <span class="text-danger" v-if="errors.permission">
                {{ errors.permission[0] }}
              </span> -->

              <hr />
              <div class="form-group">
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
                  type="button" @click.prevent="updateRole"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Update
                </button>
                <router-link :to="{name:'roleList'}"
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
          <loading
            :active.sync="isLoading"
            :can-cancel="true"
            loader="bars"
            color="#007BFF"
            :is-full-page="false"
          ></loading>
        </form>
      </div>
      <div class="col-md-11" v-else>
        <div class="card col-md-12 ml-5">
          <div class="card-body">
            <h4 class="ml-2">
              {{errors}}
            </h4>
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
import Url from "../../../url";
import Vue from "vue";
import VueToast from "vue-toast-notification";
Vue.use(VueToast);
import Loading from "vue-loading-overlay";
import MainMenuComponent from "../../layout/MainMenuComponent.vue";
import TopbarComponent from "../../layout/TopbarComponent.vue";
import FooterComponent from "../../layout/FooterComponent.vue";
export default {
  data() {
    return {
      form: {
        permission: [],
      },
      role: { 
        role:{
          name: ""
        }
       },
      errors: [],
      // submitted: false,
      isLoading: false,
      fullPage: true,
      pageShow: true,
      permissions: [],
      permission: [],
      selpermission: [],
      temp: "",
    };
  },

  
  mounted() {
    //this.getPermissions();
    this.getRole();
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
    
    getRole() {
      // for loader
      this.isLoading = true;
      
      Url.get("/editRole/" + this.$route.params.id)
        .then((response) => {
          this.role = response.data;
          this.isLoading = false;
          this.temp = this.role.rolePermissions;
          for (let t of this.temp) {
            this.selpermission.push(t.name);
          }
          console.log(this.role);
        })
        .catch((error) => {
          if (error.response.status === 403) {
           this.errors = error.response.data.message;
            this.pageShow = false;
            if(this.errors=='User is not logged in.'){
            localStorage.removeItem("auth");
          this.$router.push({ name: "Login" });
          }
            console.log("Delete : " + error);
          }
        });
    },

    updateRole() {
     
      Url.post("/updateRole/" + this.$route.params.id, {
        permission: this.selpermission,
        name: this.role.role.name,
      })
        .then((response) => {
          Vue.$toast.open({
            message: "Record Updated Successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          console.log(response.data);
          this.$router.push({ name: "roleList" });
        })

        .catch((error) => {
          if (error.response.status === 403) {
            Vue.$toast.open({
              message: "User does not have the right permissions.",
              type: "error",
              position: "top",
              duration: 5000,
            });

            console.log("Delete : " + error);
          }

          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
            this.scrollToTop();
            
          }
        });
    },
  },
};
</script>
