<template>
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
                <a href="javascript:void(0);">City-List</a>
              </li>
            </ol>
          </div>
          <h4 class="page-title">City List</h4>
        </div>
        <!--end page-title-box-->
      </div>
      <!--end col-->
      <div class="col-md-12" v-if="pageShow">
        <form  class="vld-parent">
        <div class="card">
          <div class="card-body">
            <router-link :to="{name:'addCity'}" 
              ><button type="button" class="btn btn-primary px-4 mt-0 mb-3">
                <i class="mdi mdi-plus-circle-outline mr-2"></i>Add New City
              </button>
            </router-link>
            <div class="table-responsive">
              <table class="table" id="datatable">
                <thead class="thead-light">
                  <tr>
                    <!-- <th>#</th> -->
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="city in cities.data" :key="city.id">
                    <!-- <th>{{ city.id }}</th> -->
                    <td><img src="project1.jpg" alt="" class="rounded-circle thumb-sm mr-1">{{ city.city }}</td>
                    <td>{{ city.state }}</td>
                    <td>{{ city.country }}</td>

                    <td class="text-right">
                      <!-- <a
                        @click.prevent="getCar(car.id)"
                        class="btn btn-primary ml-2"
                        data-toggle="modal"
                        data-target="#myModal"
                        ><i class="dripicons-pencil text-light"></i
                      ></a> -->
                      <router-link
                        :to="{ name: 'editCity', params: { id: city.id } }"
                        router-link-exact-active="exact-active"
                        class="btn btn-primary"
                      >
                        <i class="dripicons-pencil text-light"></i>
                      </router-link>

                      <a
                        @click.prevent="deleteCity(city.id)"
                        class="btn btn-danger ml-2"
                      >
                        <i class="dripicons-trash text-light"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <hr />
            <pagination :data="cities" @pagination-change-page="getCities">
            </pagination>

            <loading
                :active.sync="isLoading"
                :can-cancel="true"
                loader="bars"
                color="#007BFF"
                :is-full-page="false"
              ></loading>
          </div>
        </div>
        </form>
      </div>  
      
      <div class="col-md-11" v-else>
        <div class="card col-md-12  ml-5">
          <div class="card-body ">
            <h4 class="ml-2">Can not access this page! User does not have the right permissions.</h4>
          </div>
        </div>
      </div>


    </div>
  </div>
  <!-- container -->
  </div>
</template>

<script>
import Vue from "vue";
Vue.component("pagination", require("laravel-vue-pagination"));
import VueToast from "vue-toast-notification";
Vue.use(VueToast);
import Url from "../../url";
import Loading from "vue-loading-overlay";
export default {
  data() {
    return {
      cities: {},
      city: {},
      isLoading: false,
      fullPage: true,
      pageShow:true
    };
  },

  created() {
    this.getCities();
  },
  mounted() { 
    this.getCities();
  },
  components: {
    Loading,
  },

  methods: {
    // getCars() {
    //   User.getCars().then((response) => {
    //     this.cars = response.data;
    //   });
    // },

    getCities(page) {
      // for loader
      this.isLoading = true;
      // setTimeout(() => {
      //   this.isLoading = false;
      // }, 1000);
      if (typeof page === "undefined") {
        page = 1;
      }
      Url.get("/getCities?page=" + page).then((response) => {
        this.cities = response.data;
        this.isLoading = false;
      })
      .catch((error) => {
         if (error.response.status === 403) {
          //   Vue.$toast.open({
          //   message: "User does not have the right permissions.",
          //   type: "error",
          //   position: 'top',
          //   duration: 5000,
          // })
          
          this.pageShow=false;
          console.log("Delete car: " + error);
         }

         if (error.response.status === 422) {
            Vue.$toast.open({
            message: "Internal server error",
            type: "error",
            position: 'top',
            duration: 5000,
          })
         }
        });
    },

    deleteCity(id) {
      var _this=this;
      if(confirm("Do you really want to delete?")){
      Url.post("/deleteCity/" + id)
        .then(function (response) {
          _this.getCities();
          Vue.$toast.open({
            message: "Record Deleted Successfully!",
            type: "success",
            position: 'top',
            duration: 3000
          });
          
          console.log(response.data);
        })
        .catch((error) => {
         if (error.response.status === 403) {
            Vue.$toast.open({
            message: "User does not have the right permissions.",
            type: "error",
            position: 'top',
            duration: 5000,
          })
          
          console.log("Delete car: " + error);
         }

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
    }
  },
};
</script>
