<template>
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
                    src="images/logo-sm.png"
                    height="55"
                    alt="logo"
                    class="auth-logo"
                /></a>
              </div>
              <!--end auth-logo-box-->

              <div class="text-center auth-logo-text">
                <h4 class="mt-0 mb-3 mt-5">Let's Get Started Admin</h4>
                <p class="text-muted mb-0">Sign Up to continue to Admin.</p>
              </div>
              <!--end auth-logo-text-->

              <form @submit.prevent="register" class="auth-form my-4">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Name:</label>
                      <input
                        type="text"
                        v-model="form.name"
                        class="form-control"
                        id="name"
                        :class="{
                          'is-invalid': submitted && $v.form.name.$error,
                        }"
                      />
                      <!-- <span class="text-danger" v-if="errors.name">
            {{ errors.name[0] }}
          </span> -->
                      <div
                        v-if="submitted && !$v.form.name.required"
                        class="invalid-feedback"
                      >
                        Name is required
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email">Email address:</label>
                      <input
                        type="email"
                        v-model="form.email"
                        class="form-control"
                        id="email"
                        :class="{
                          'is-invalid': submitted && $v.form.email.$error,
                        }"
                      />
                      <!-- <span class="text-danger" v-if="errors.email">
            {{ errors.email[0] }}
          </span> -->
                      <div
                        v-if="submitted && !$v.form.email.required"
                        class="invalid-feedback"
                      >
                        Email is required
                      </div>
                      <div
                        v-if="submitted && !$v.form.email.email"
                        class="invalid-feedback"
                      >
                        Email is invalid
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email">Phone</label>
                      <input
                        type="number"
                        v-model="form.phone"
                        class="form-control"
                        placeholder=""
                        id="phone"
                        :class="{
                          'is-invalid': submitted && $v.form.phone.$error,
                        }"
                      />
                      <!-- <span class="text-danger" v-if="errors.phone">
                {{ errors.phone[0] }}
              </span> -->
                      <div
                        v-if="submitted && !$v.form.phone.required"
                        class="invalid-feedback"
                      >
                        Phone is required
                      </div>
                      <div
                        v-if="submitted && !$v.form.phone.minLength"
                        class="invalid-feedback"
                      >
                        Phone must be at least 10 char long
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password">Password:</label>
                      <input
                        type="password"
                        v-model="form.password"
                        class="form-control"
                        id="password"
                        :class="{
                          'is-invalid': submitted && $v.form.password.$error,
                        }"
                      />
                      <!-- <span class="text-danger" v-if="errors.password">
            {{ errors.password[0] }}
          </span> -->
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
                    <div class="form-group">
                      <label for="password_confirmation"
                        >Confirm Password:</label
                      >
                      <input
                        type="password"
                        v-model="form.password_confirmation"
                        class="form-control"
                        id="password_confirmation"
                        :class="{
                          'is-invalid':
                            submitted && $v.form.password_confirmation.$error,
                        }"
                      />
                      <!-- <span class="text-danger" v-if="errors.password_confirmation">
            {{ errors.password_confirmation[0] }}
          </span> -->
                      <div
                        v-if="
                          submitted && !$v.form.password_confirmation.required
                        "
                        class="invalid-feedback"
                      >
                        Confirm Password is required
                      </div>
                      <div
                        v-if="
                          submitted &&
                          !$v.form.password_confirmation.sameAsPassword
                        "
                        class="invalid-feedback"
                      >
                        Passwords must match
                      </div>
                    </div>
                    <button class="btn btn-primary btn-block">Register</button>
                  </div>
                </div>
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
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import Axios from "axios";
export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone: "",
        password: "",
        password_confirmation: "",
      },
      errors: '',
      submitted: false,
    };
  },

  validations: {
    form: {
      name: { required },
      email: { required, email },
      phone: { required, minLength: minLength(10) },
      password: { required, minLength: minLength(8) },
      password_confirmation: { required, sameAsPassword: sameAs("password") },
    },
  },

  methods: {
    register() {
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      Axios.post("/register", this.form)
        .then(() => {
          this.$router.push({ name: "Login" });
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
