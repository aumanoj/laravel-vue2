<!--<template>
  <div class="home col-8 mx-auto py-5 mt-5">
    <h1>Dashboard</h1>
    <div class="card">
      <div class="card-body" v-if="user">
        <h3>Hello, {{ user.name }}</h3>
        <span>{{ user.email }}</span>
      </div>
    </div>
  </div>
</template>

<script>
import User from "../apis/User";

export default {
  data() {
    return {
      user: null
    };
  },

  mounted() {
    User.auth().then(response => {
      this.user = response.data;
    });
  }
};
</script>-->

<template>
  <div class="page-wrapper">
    <MainMenuComponent />
    <!--main menu & sub-menu component-->
    <div class="page-content">
      <TopbarComponent />
      <!-- Page Content-->
      <div class="page-content-inner">
        <div class="container-fluid">
          <br />
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
                      <a href="javascript:void(0);">Dashboard</a>
                    </li>
                  </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
              </div>
              <!--end page-title-box-->
            </div>
            <!--end col-->
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="chat-search">
                <div class="form-group">
                  <div class="input-group">
                    <input
                      type="text"
                      id="chat-search"
                      name="chat-search"
                      class="form-control"
                      placeholder="Search"
                    />
                    <span class="input-group-append">
                      <button
                        type="button"
                        class="btn btn-gradient-primary shadow-none"
                      >
                        <i class="fas fa-search"></i>
                      </button>
                    </span>
                  </div>
                </div>
              </div>
              <!--end chat-search-->
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
          <div class="row">
            <div class="col-md-4">
              <div class="col-md-12">
                <a href="#">
                  <div class="card">
                    <div class="card-body">
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-secondary"></i>New
                          Leads
                        </p>
                      </div>
                      <!-- end col-->
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-warning"></i>New
                          Leads Target
                        </p>
                      </div>
                      <!-- end col-->
                    </div>
                    <!--end card-body-->
                  </div>
                  <!--end card-->
                </a>
              </div>
              <!--end col-->
              <div class="col-md-12">
                <a href="#">
                  <div class="card">
                    <div class="card-body">
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-secondary"></i>New
                          Leads
                        </p>
                      </div>
                      <!-- end col-->
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-warning"></i>New
                          Leads Target
                        </p>
                      </div>
                      <!-- end col-->
                    </div>
                    <!--end card-body-->
                  </div>
                  <!--end card-->
                </a>
              </div>
              <!--end col-->
              <div class="col-md-12">
                <a href="#">
                  <div class="card">
                    <div class="card-body">
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-secondary"></i>New
                          Leads
                        </p>
                      </div>
                      <!-- end col-->
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-warning"></i>New
                          Leads Target
                        </p>
                      </div>
                      <!-- end col-->
                    </div>
                    <!--end card-body-->
                  </div>
                  <!--end card-->
                </a>
              </div>
              <!--end col-->
            </div>
            <!--end col-->

            <div class="col-md-4">
              <div class="col-md-12">
                <a href="#">
                  <div class="card">
                    <div class="card-body">
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-secondary"></i>New
                          Leads
                        </p>
                      </div>
                      <!-- end col-->
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-warning"></i>New
                          Leads Target
                        </p>
                      </div>
                      <!-- end col-->
                    </div>
                    <!--end card-body-->
                  </div>
                  <!--end card-->
                </a>
              </div>
              <!--end col-->
              <div class="col-md-12">
                <a href="#">
                  <div class="card">
                    <div class="card-body">
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-secondary"></i>New
                          Leads
                        </p>
                      </div>
                      <!-- end col-->
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-warning"></i>New
                          Leads Target
                        </p>
                      </div>
                      <!-- end col-->
                    </div>
                    <!--end card-body-->
                  </div>
                  <!--end card-->
                </a>
              </div>
              <!--end col-->
              <div class="col-md-12">
                <a href="#">
                  <div class="card">
                    <div class="card-body">
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-secondary"></i>New
                          Leads
                        </p>
                      </div>
                      <!-- end col-->
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-warning"></i>New
                          Leads Target
                        </p>
                      </div>
                      <!-- end col-->
                    </div>
                    <!--end card-body-->
                  </div>
                  <!--end card-->
                </a>
              </div>
              <!--end col-->
            </div>
            <!--end col-->
            <div class="col-md-4">
              <div class="col-md-12">
                <a href="#">
                  <div class="card">
                    <div class="card-body">
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-secondary"></i>New
                          Leads
                        </p>
                      </div>
                      <!-- end col-->
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-warning"></i>New
                          Leads Target
                        </p>
                      </div>
                      <!-- end col-->
                    </div>
                    <!--end card-body-->
                  </div>
                  <!--end card-->
                </a>
              </div>
              <!--end col-->
              <div class="col-md-12">
                <a href="#">
                  <div class="card">
                    <div class="card-body">
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-secondary"></i>New
                          Leads
                        </p>
                      </div>
                      <!-- end col-->
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-warning"></i>New
                          Leads Target
                        </p>
                      </div>
                      <!-- end col-->
                    </div>
                    <!--end card-body-->
                  </div>
                  <!--end card-->
                </a>
              </div>
              <!--end col-->
              <div class="col-md-12">
                <a href="#">
                  <div class="card">
                    <div class="card-body">
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-secondary"></i>New
                          Leads
                        </p>
                      </div>
                      <!-- end col-->
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted font-13">
                          <i class="mdi mdi-album mr-2 text-warning"></i>New
                          Leads Target
                        </p>
                      </div>
                      <!-- end col-->
                    </div>
                    <!--end card-body-->
                  </div>
                  <!--end card-->
                </a>
              </div>
              <!--end col-->
            </div>
            <!--end col-->
          </div>
          <!--end-row-->
        </div>
        <!-- container -->
      </div>
      <FooterComponent />
    </div>
  </div>
</template>

 <script>
import MainMenuComponent from "./layout/MainMenuComponent.vue";
import TopbarComponent from "./layout/TopbarComponent.vue";
import FooterComponent from "./layout/FooterComponent.vue";
export default {
    data() {
    return {
      isLoggedIn: false,
    }; 
  },
  mounted() {
    this.$root.$on("login", () => {
      this.isLoggedIn = true;
    });
    this.isLoggedIn = !!localStorage.getItem("auth");
  },
  components: {
    MainMenuComponent,
    TopbarComponent,
    FooterComponent,
  },
};
</script> 
