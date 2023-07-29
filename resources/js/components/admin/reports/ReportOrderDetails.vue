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
                  <a href="javascript:void(0);">Admin</a>
                </li>
                <li class="breadcrumb-item active">Detail Order</li>
              </ol>
            </div>
            <h4 class="page-title">Detail Order</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="row" v-if="pageShow">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-5 ml-1">
                <h6><b>Select Optional Details</b></h6>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 ml-1">
                <label><b>Brand</b></label>
                <select class='form-control selectpicker'
                  multiple data-live-search="true"
                   v-model='manu_id' 
                   @change='getModels()'
                    >
                  <option value="" disabled> Select Brand </option>
                  <option v-for="brand in brands"
                    :key="brand.id"
                    :value="brand.manu_id"> 
                    {{ brand.manu_name }}
                  </option>
                </select>
              </div>
              <div class="col-md-2 ml-1">
                <label><b>Model</b></label>
                <select class="form-control selectpicker"
                  multiple data-live-search="true"
                  v-model="model_id">
                  <option value="" disabled> Select Model</option>
                  <option v-for="model in models"
                    :key="model.id"
                    :value="model.model_id">
                    {{ model.model_num }}
                  </option>
                </select>
              </div>
              <div class="col-md-2 ml-1">
                <label><b>Country</b></label>
                <select class="form-control selectpicker"
                  multiple data-live-search="true"
                  v-model="country_id"
                  @change='getNetworks()'>
                  <option value="" disabled> Select Country</option>
                  <option v-for="country in countries"
                    :key="country.id"
                    :value="country.country_id">
                    {{ country.country_name }}
                  </option>
                </select>
              </div>
              <div class="col-md-2 ml-1">
                <label><b>Network</b></label>
                <select class="form-control selectpicker"
                  multiple data-live-search="true"
                  v-model="network_id">
                  <option value="" disabled> Select Network</option>
                  <option v-for="network in networks"
                    :key="network.id"
                    :value="network.network_id">
                    {{ network.network_name }}
                  </option>
                </select>
              </div>
              <div class="col-md-3 ml-1 select1" >
                <label><b>User Country</b></label>
                <select class="form-control selectpicker"
                  multiple data-live-search="true" 
                  v-model="user_country_id">
                  <option value="" disabled> Select User Country</option>
                  <option v-for="userCountry in userCountries"
                    :key="userCountry.id"
                    :value="userCountry.country_code">
                    {{ userCountry.country_name }}
                  </option>
                </select>
              </div>
            </div>
            <div class="row">
              <br/>
            </div>
            <div class="row">
              <div class="col-md-3 ml-2">
                <label><b>Order Status</b></label>
                <select class="form-control selectpicker"
                  multiple data-live-search="true"
                  v-model="order_status">
                  <option value="" disabled> Select Order Status</option>
                  <option value='Delivered'>Delivered</option>
                  <option value='Failed'>Failed</option>
                  <option value='Waiting'>Waiting</option>
                  <option value='0'>Unprocessed</option>
                </select>
              </div>
              <div class="col-md-3 ml-2">
                <label><b>Payment Status</b></label>
                <select class="form-control selectpicker" 
                multiple data-live-search="true" 
                v-model="payment_status">
                  <option value="" disabled> Select Payment Status</option>
                  <option value='0'>Not Paid</option>
                  <option value='1'>Paid</option>
                  <option value='Refunded'>Refunded</option>
                  <option value='Unavailable'>Unavailable</option>
                </select>
              </div>
              <!--<div class="col-md-3 ml-2">
                <label><b>Order Reference Status</b></label>
                <select class="form-control selectpicker"
                multiple data-live-search="true"
                v-model="order_reference_status">
                  <option value="" disabled> Select Order reference</option>
                  <option value="aweber">Aweber</option>
                  <option value="email">Email</option>
                  <option value="android">Android</option>
                  <option value="Adwords">Adwords</option>
                </select>
              </div>-->
            </div>
            <div class="row">
              <br/>
            </div>
            <div class="row">
              <nav class="navbar navbar-default">
                <ul class="nav">
                  <li class="nav-item">
                      <label><b>Grouping By</b></label>
                  </li>
                  <li class="nav-item">
                    <div class="col-md-3 ml-2">
                    </div>
                  </li>
                  <li class="nav-item">
                    <div class="col-md-3 ml-2">
                      <div class="checkbox checkbox-primary checkbox-inline">
                        <input type="checkbox" v-model="chk_brand" id="chk_brand">
                        <label class="custom-control-label" for="chk_brand"><b>Brand</b></label>
                      </div>
                    </div>
                  </li>
                  <li  class="nav-item">
                    <div class="col-md-3 ml-2">
                      <div class="checkbox checkbox-primary checkbox-inline">
                        <input type="checkbox" v-model="chk_model" id="chk_model">
                        <label class="custom-control-label" for="chk_model"><b>Model</b></label>
                      </div>
                    </div>
                  </li>
                  <li  class="nav-item">
                    <div class="col-md-3 ml-2">
                      <div class="checkbox checkbox-primary checkbox-inline">
                        <input type="checkbox" v-model="chk_country" id="chk_country">
                        <label class="custom-control-label" for="chk_country"><b>Country</b></label>
                      </div>
                    </div>
                  </li>
                  <li  class="nav-item">
                    <div class="col-md-3 ml-2">
                      <div class="checkbox checkbox-primary checkbox-inline">
                        <input type="checkbox" v-model="chk_network" id="chk_network">
                        <label class="custom-control-label" for="chk_network"><b>Network</b></label>
                      </div>
                    </div>
                  </li>
                </ul>
              </nav>
            </div>
            <br/>
            <div class="row">
              <div class="col-md-3 ml-2">
                <label><b>Start Date</b></label>
                <datepicker name="start_date" v-model="start_date"></datepicker>
              </div>
              <div class="col-md-3 ml-2">
                <label><b>End Date</b></label>
                <datepicker name="end_date" v-model="end_date"></datepicker>
              </div>
              <div class="col-md-4 ml-3">
                <button style="margin-top:15px" type="button" @click.stop.prevent='generateReport' class="btn btn-primary wave-effect waves-light">Generate Report</button>
              </div>
            </div>
            <br/>
            <div class="row">
              <div class="col-md-5 ml-2">
                <button type="button" @click.stop.prevent='generateReportExcel' class="btn btn-primary wave-effect waves-light">Download in Excel</button>
              </div>
            </div>
            <loading :active.sync="isLoading" :can-cancel="true" loader="bars" color="#007BFF" :is-full-page="false"></loading>
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
  import Url from "../../../url";
  import Loading from "vue-loading-overlay";
  import Multiselect from 'vue-multiselect';
  import Datepicker from 'vuejs-datepicker';
  import MainMenuComponent from "../../layout/MainMenuComponent.vue";
import TopbarComponent from "../../layout/TopbarComponent.vue";
import FooterComponent from "../../layout/FooterComponent.vue";
  export default {
    data() {
      return {
        manu_id: [],
        brands: [],
        model_id: [],
        models: [],
        country_id: [],
        countries: [],
        network_id: [],
        networks: [],
        user_country_id: [],
        userCountries: [],
        order_status:[],
        orderStatuses:["Delivered","Failed","Waiting","Unprocessed"],
        payment_status:[],
        paymentStatuses:["Not paid","Paid","Refunded","Unavailable"],
        order_reference_status:[],
        orderReferenceStatuses:['Aweber','Email','Android','Adwords'],
        start_date:'',
        end_date:'',
        chk_brand:0,
        chk_model:0,
        chk_country:0,
        chk_network:0,
        isLoading: false,
        pageShow:true
      }
    },
    mounted() {
      require("../../../../../public/assets/js/bootstrap-select");
      require("../../../../../public/assets/css/bootstrap-select.min.css");
      this.getBrands();
      this.getCountries();
      this.getUserCountries();
      this.getReportData();

    },
    components: {
      MainMenuComponent,
    TopbarComponent,
    FooterComponent,
      Loading,
      Multiselect,
      Datepicker,
    },
    props: {
      placeholderOrderStatus: {
        default: 'Order Status'
      },
      placeholderPaymentStatus: {
        default: 'Payment Status'
      },
      placeholderOrderReferenceStatus: {
        default: 'Order Reference Status'
      }
    }, 
    methods: {

       getReportData() {
        this.isLoading = true;
        Url.get("/getReportData/").then((response) => {
          this.retportData = response.data;
        }).catch((error) => {

          if (error.response.status === 403) {
            this.errors = error.response.data.message;
            this.pageShow=false;
            if(this.errors=='User is not logged in.'){
            localStorage.removeItem("auth");
          this.$router.push({ name: "Login" });
          }
           }
        });
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
      getModels() {
        this.isLoading = true;
        Url.get("/getMultipleModelList/"+this.manu_id).then((response) => {
          this.models = response.data;
          this.isLoading = false;
          setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
          }, 300);
        })
        .catch((error) => {
            if (error.response.status === 404)
            {
              //console.log(error)
              console.log('fail')
              this.models = null;
            setTimeout(function () {
              $(".selectpicker").selectpicker("refresh");
            }, 300);
              this.isLoading = false;
            }
        });
      },
      getCountries() {
        this.isLoading = true;
        Url.get("/getCountryList").then((response) => {
          this.countries = response.data;
          this.isLoading = false;
          setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
          },300);
        });
      },
      getNetworks() {
        this.isLoading = true;
        Url.get("/getNetworkList/"+this.country_id).then((response) => {
          this.networks = response.data;
          this.isLoading = false;
          setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
          },300);
        })
        .catch((error) => {
            if (error.response.status === 404)
            {
              //console.log(error)
              console.log('fail')
              this.networks = null;
              setTimeout(function () {
                $(".selectpicker").selectpicker("refresh");
              }, 300);
              this.isLoading = false;
            }
        });
      },
      getUserCountries() {
        this.isLoading = true;
        Url.get("/getUserCountryList/").then((response) => {
          this.userCountries = response.data;
          this.isLoading = false;
          setTimeout(function () {
            $(".selectpicker").selectpicker("refresh");
          },300);
        });
      },
      generateReport(){
        Url.post('/generateReportData',{
          manu_id:this.manu_id,
          model_id:this.model_id,
          country_id:this.country_id,
          network_id:this.network_id,
          user_country_id:this.user_country_id,
          order_status:this.order_status,
          payment_status:this.payment_status,
          order_reference_status:this.order_reference_status,
          chk_brand:this.chk_brand,
          chk_model:this.chk_model,
          chk_country:this.chk_country,
          chk_network:this.chk_network,
          start_date:this.start_date,
          end_date:this.end_date,
        })
        .then((response) => {
          //console.log(response.data);
          console.log("success");
          window.open("/generateReport", '_blank');
          //window.open("/admin/generateReportA", '_blank');
          this.isLoading = false;
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
      generateReportExcel(){
        this.isLoading = true;
        var exl = 'YES';
        Url.post('/generateReportData',{
        //Url.post('generateReportDataExcel',{
          manu_id:this.manu_id,
          model_id:this.model_id,
          country_id:this.country_id,
          network_id:this.network_id,
          user_country_id:this.user_country_id,
          order_status:this.order_status,
          payment_status:this.payment_status,
          order_reference_status:this.order_reference_status,
          chk_brand:this.chk_brand,
          chk_model:this.chk_model,
          chk_country:this.chk_country,
          chk_network:this.chk_network,
          start_date:this.start_date,
          end_date:this.end_date,
          exl: 'YES',
        })
        .then((response) => {
          console.log(response.data);
          console.log("success");
          /*var myWindow = window.open("/generateReport",'_blank','scrollbars=no,width=10,height=10,top=10');
          myWindow.focus();
          setTimeout(function() {
            myWindow.close();
          }, 300);*/
         var repWin = window.open("/generateReport",'_blank');
         repWin.blur();
          Vue.$toast.open({
            message: "Excel Downloaded Successfully !",
            type: "success",
            position: "top",
            duration: 3000,
          });
          this.isLoading = false;
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
    }
  }
</script>

<style type="text/css">
  .select1 .bootstrap-select .dropdown-menu{
    max-width: 100px;
  }
</style>