<template>
  <!-- <div class="home col-5 mx-auto py-5 mt-5">
    <h1 class="text-center">Login</h1>
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="email">Email address:</label>
          <input
            type="email"
            v-model="form.email"
            class="form-control"
            id="email"
          />
          <span class="text-danger" v-if="errors.email">
            {{ errors.email[0] }}
          </span>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input
            type="password"
            v-model="form.password"
            class="form-control"
            id="password"
          />
          <span class="text-danger" v-if="errors.password">
            {{ errors.password[0] }}
          </span>
        </div>
        <button @click.prevent="login" class="btn btn-primary btn-block">
          Login
        </button>
      </div>
    </div>
  </div> -->
  <!-- Page Content-->
  <div class="page-content-inner">
  <div class="account-body accountbg dark-sidenav-iconbar py-4 mb-2">
    <div class="col-12 align-self-center">
      <div class="auth-page">
        <div class="card auth-card shadow-lg mt-5">
          <div class="card-body">
            <div class="px-3">
              <div class="auth-logo-box">
                <a href="#" class="logo logo-admin"
                  ><img
                    src="logo-sm.png"
                    height="55"
                    alt="logo"
                    class="auth-logo"
                /></a>
              </div>
              <!--end auth-logo-box-->

              <div class="text-center auth-logo-text">
                <h4 class="mt-0 mb-3 mt-5">Let's Get Started Admin</h4>
                <p class="text-muted mb-0">Sign in to continue to Admin.</p>
              </div>
              <!--end auth-logo-text-->

              <form class="auth-form my-4" @submit.prevent="login">
                <span class="text-danger" v-if="errors.email">
                  {{ errors.email[0] }}
                </span>
                <div class="form-group">
                  <label for="username"
                    >Username <b class="required"> *</b></label
                  >
                  <div class="input-group mb-3">
                    <span class="auth-form-icon">
                      <i class="dripicons-user"></i>
                    </span>
                    <input
                      type="email"
                      v-model="form.email"
                      class="form-control"
                      id="email"
                      autofocus
                      :class="{
                        'is-invalid': submitted && $v.form.email.$error,
                      }"
                    />
                    <div
                      v-if="submitted && !$v.form.email.required"
                      class="invalid-feedback"
                    >
                      Username is required
                    </div>
                    <div
                      v-if="submitted && !$v.form.email.email"
                      class="invalid-feedback"
                    >
                      Username is invalid
                    </div>
                  </div>
                  <!-- <span class="text-danger" v-if="errors.email">
                      {{ errors.email[0] }}
                    </span> -->
                </div>
                <!--end form-group-->

                <div class="form-group">
                  <label for="userpassword"
                    >Password <b class="required"> *</b></label
                  >
                  <div class="input-group mb-3">
                    <span class="auth-form-icon">
                      <i class="dripicons-lock"></i>
                    </span>
                    <input
                      type="password"
                      v-model="form.password"
                      class="form-control"
                      id="password"
                      :class="{
                        'is-invalid': submitted && $v.form.password.$error,
                      }"
                    />
                    <div
                      v-if="submitted && !$v.form.password.required"
                      class="invalid-feedback"
                    >
                      Password is required
                    </div>
                    <div
                      v-if="submitted && !$v.form.password.minLength"
                      class="invalid-feedback"
                    >
                      Password must be at least 8 characters
                    </div>
                  </div>
                  <!-- <span class="text-danger" v-if="errors.password">
                      {{ errors.password[0] }}
                    </span> -->
                </div>
                <!--end form-group-->

                <div class="form-group row mt-4">
                  <div class="col-sm-6">
                    <!-- <div class="custom-control custom-switch switch-success">
                                                <input type="checkbox" class="custom-control-input" id="customSwitchSuccess">
                                                <label class="custom-control-label text-muted" for="customSwitchSuccess">Remember me</label>
                                            </div> -->
                  </div>
                  <!--end col-->
                  <div class="col-sm-6 text-right">
                    <!-- <a href="#" class="text-muted font-13"
                      ><i class="dripicons-lock"></i> Forgot password?
                    </a> -->
                    <router-link
                      :to="{name:'ForgotPassword'}"
                      class="text-muted font-13"
                    >
                      <i class="dripicons-lock"></i> Forgot password?
                    </router-link>
                  </div>
                  <!--end col-->
                </div>
                <!--end form-group-->
                <div class="form-group mb-2 row">
                  <!-- <label for="robot" class="col-sm-2 col-form-label"></label> -->
                  <div class="col-12">
                    <vue-recaptcha
                      @verify="onVerify"
                      sitekey="6LcqaeQZAAAAAFZCuyMhGgqhDuHzcZqWfqXJOsiU"
                      :loadRecaptchaScript="true"
                    >
                    </vue-recaptcha>
                    <div><p class="required" id="recaptcha"></p></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <label class="required" for="invalidCheck">
                      (*) Mandatory fields
                    </label>
                  </div>
                </div>
                <div class="form-group mb-0 row">
                  <div class="col-12 mt-2">
                    <button
                      class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light"
                    >
                      Log In <i class="fas fa-sign-in-alt ml-1"></i>
                    </button>
                  </div>
                  <!--end col-->
                </div>
                <!--end form-group-->
              </form>
              <!--end form-->
            </div>
            <!--end /div-->

            <!-- <div class="m-3 text-center text-muted">
                                <p class="">Don't have an account ?  <a href="#" class="text-primary ml-2">Free Resister</a></p>
                            </div> -->
          </div>
          <!--end card-body-->
        </div>
        <!--end card-->
      </div>
      <!--end auth-page-->
    </div>
    <!--end col-->
  </div>
  <!--end row-->

  <!-- End Log In page -->
  </div>
</template>

<script>

import { required,email, minLength, } from "vuelidate/lib/validators";
import Axios from 'axios';
import VueRecaptcha from "vue-recaptcha";
export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
        robot:false
      },
      errors: '',
      user: [],
      submitted:false,
    };
  },

  validations: {
    form: {
      email: { required,email},
      password: { required,minLength: minLength(8) },
    },
  },

  components: {
    VueRecaptcha,
  },

  methods: {
    onVerify: function (response) {
      if (response) this.form.robot = true;
      $('#recaptcha').hide();
    },
    login() {
      this.submitted = true;
      this.$v.$touch();
        if (this.$v.$invalid) {
          return;
        }
        if (!this.form.robot) {
          $('#recaptcha').text('This field is required');
        return true; // prevent form from submitting checking recaptcha
      }
      Axios.post("/adminLogin",this.form)
        .then((response) => {
          this.$root.$emit("login", true);
          localStorage.setItem("auth", "true");
          this.$router.push({ name: "Dashboard" });
          this.user = response.data;
          localStorage.setItem("user", this.user.name);
          localStorage.setItem("userID", this.user.id);
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
  },
};
</script>
