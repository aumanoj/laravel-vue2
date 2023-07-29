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
              <li class="breadcrumb-item">
                <a href="javascript:void(0);">Edit-Profile</a>
              </li>
            </ol>
          </div>
          <h4 class="page-title">Edit Profile</h4>
        </div>
        <!--end page-title-box-->
      </div>
      <!--end col-->
      <div class="col-md-12" v-if="pageShow">
        <!-- <router-link :to="{name:'adminList'}"
          ><button type="button" class="btn btn-primary px-4 mt-0 mb-3">
            Back
          </button></router-link
        > -->
        
        <form >
          <div class="card">
            <div class="card-body">

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Name<b class="required"> *</b></div>
                <div class="col-md-7">
                <input
                  type="text"
                  v-model="user.user.name"
                  class="form-control"
                  placeholder="Enter name"
                  id="name"
                />
                <span class="text-danger" v-if="errors.name">
                {{ errors.name[0] }}
              </span>
                <div
                  v-if="submitted && !$v.user.name.required"
                  class="invalid-feedback"
                >
                  Name is required
                </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Email<b class="required"> *</b></div>
                <div class="col-md-7">
                <input
                  type="text"
                  v-model="user.user.email"
                  class="form-control"
                  placeholder="Enter email "
                  id="email"
                />
                <span class="text-danger" v-if="errors.email">
                {{ errors.email[0] }}
              </span>

                <div
                  v-if="submitted && !$v.user.email.required"
                  class="invalid-feedback"
                >
                  Email is required
                </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Phone<b class="required"> *</b></div>
                <div class="col-md-7">
                <input
                  type="text"
                  v-model="user.user.phone"
                  class="form-control"
                  placeholder="Enter phone "
                  id="phone"
                />
                <span class="text-danger" v-if="errors.phone">
                {{ errors.phone[0] }}
              </span>
                <div
                  v-if="submitted && !$v.user.phone.required"
                  class="invalid-feedback"
                >
                  Phone is required
                </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Password</div>
                <div class="col-md-7">
                <input
                  type="password"
                  v-model="password"
                  class="form-control"
                  placeholder="Enter password"
                  id="password"
                  
                />
                <!-- <span class="text-danger" v-if="errors.password">
                {{ "The password must be at least one character and number."}}
              </span> -->
                <!-- <div
                  v-if="submitted && !$v.form.password.required"
                  class="invalid-feedback"
                >
                  Password is required
                </div> -->
                <!-- <div
                  v-if="submitted && !$v.form.password.minLength"
                  class="invalid-feedback"
                >
                  Password must be at least 8 characters
                </div> -->
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Confirm Password</div>
                <div class="col-md-7">
                <input
                  type="password"
                  v-model="password_confirmation"
                  class="form-control"
                  placeholder="Please re-enter password"
                  id="password_confirmation"
                  v-on:blur="validate"
                />

                <!-- <div
                  v-if="submitted && !$v.form.password_confirmation.required"
                  class="invalid-feedback"
                >
                  Confirm Password is required
                </div>
                <div
                  v-if="
                    submitted && !$v.form.password_confirmation.sameAsPassword
                  "
                  class="invalid-feedback"
                >
                  Passwords must match
                </div> -->
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-2 ml-5">Role<b class="required"> *</b></div>
                <div class="col-md-7">
                  <select class="form-control" v-model="user.userRole[0]">
                    <option value="" selected disabled>
                      Please Select Role
                    </option>
                    <option
                      v-for="role in user.roles"
                      :key="role.id"
                      :value="role"
                    >
                      {{ role }}
                    </option>
                  </select>
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
                  type="button" @click.prevent="updateUser"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Update
                </button>
                <router-link :to="{name:'adminList'}"
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

import Url from "../../url";
import Vue from "vue";
import VueToast from "vue-toast-notification";
Vue.use(VueToast);
import { required,minLength, sameAs } from "vuelidate/lib/validators";
import Loading from "vue-loading-overlay";
import MainMenuComponent from "../layout/MainMenuComponent.vue";
import TopbarComponent from "../layout/TopbarComponent.vue";
import FooterComponent from "../layout/FooterComponent.vue";
export default {
  data() {
    return {
      user:"",
      name: "",
      email: "",
      phone: "",
      roles: "",
      
      user:{
        userRole: [],
        user:{
          name:"",
          email: "",
          phone: "",
        }
      },
      password:"",
      password_confirmation:"",
      errors:[],
      submitted: false,
      submit:false,
      isLoading: false,
      fullPage: true,
      pageShow:true,
      p_roles: "",
      role: "",
    };
  },

  validations: {
   // user: {
      // name: { required },
      // email: { required, email },
      // phone: { required },
      // roles: { required },
      password: { required, minLength: minLength(8) },
      password_confirmation: { required, sameAsPassword: sameAs("password") },
    //},
  },
  mounted() {
    this.getUser();
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
      Url.get("/getRole").then((response) => {
        this.p_roles = response.data;
      })
      
    },
    getUser() {
      // for loader
      this.isLoading = true;
      // setTimeout(() => {
        
      // }, 1000);
      Url.get("/editUser/" + this.$route.params.id).then((response) => {
        this.user = response.data;
        this.isLoading = false;
        console.log(this.user);
        
      })
      .catch((error) => {
          if (error.response.status === 403) {
            this.pageShow = false;
            this.errors = error.response.data.message;
            if(this.errors=='User is not logged in.'){
            localStorage.removeItem("auth");
          this.$router.push({ name: "Login" });
          }
          }

          if (error.response.status === 422) {
            Vue.$toast.open({
              message: "Internal server error",
              type: "error",
              position: "top",
              duration: 5000,
            });
          }
        });
    },
    validate() {
        if(this.password === this.password_confirmation){
          return true
        }
        else{
          return false;
          //alert("Password does not match")
        //   Vue.$toast.open({
        //   message: "Passwords don't match.",
        //   type: "error",
        //   position: "top",
        //   duration: 5000,
        // });
        }
    },
    updateUser() {
      //this.submitted = true;
      // this.$v.$touch();
      // if (this.$v.$invalid) {
      //   return;
      // }
      this.submit=this.validate();
     if(this.submit==true){
        Url.post("/updateUser/" + this.$route.params.id, {
        name: this.user.user.name,
        email: this.user.user.email,
        phone: this.user.user.phone,
        roles: this.user.userRole[0],
        password:this.password
      }).then((response) => {
        Vue.$toast.open({
          message: "Record Updated Successfully!",
          type: "success",
          position: "top",
          duration: 3000,
        });
        console.log(response.data);
        this.$router.push({ name: "adminList" });
      })
      .catch((error) => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors;
              this.scrollToTop();
            }
            
        //   Vue.$toast.open({
        //   message: "All fields are required",
        //   type: "error",
        //   position: "top",
        //   duration: 5000,
        // });
      });
     }
     else{
         Vue.$toast.open({
          message: "Passwords does not match",
          type: "error",
          position: "top",
          duration: 5000,
        });
     }
    },

    
  },
};
</script>