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
                  <a href="javascript:void(0);">Manage</a>
                </li>
                <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li> -->
                <li class="breadcrumb-item active">Old Orders</li>
              </ol>
            </div>
            <h4 class="page-title">Manage Order(Complete)</h4>
          </div>
          <!--end page-title-box-->
        </div>
        <!--end col-->
      </div>
      <!-- end page title end breadcrumb -->
    </div>
    <!-- container -->
    <div class="row" v-if="pageShow">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            
                <!-- <label for="exampleInputPassword1">Password</label> -->
                <!-- <form > -->
                  <div class="row">
                    <div class="col-md-3">
                      <div class="input-group mt-1">
                    <input
                      type="text"
                      id="date"
                     v-model="date"
                      name="dates"
                      class="form-control"
                      placeholder="Search by date"
                    />

                    
                    <span class="input-group-append">
                      <button
                        type="submit"
                        @click.prevent="searchValue"
                        class="btn btn-gradient-primary"
                      >
                        Search
                      </button>
                      
                    </span>
                  </div>
                    </div>

                    <div class="col-md-3"> 
                  <select class=" form-control mt-1"   id="brand_name" @change="searchValue()" v-model="manu_id"  >
                  <option value="" disabled>Select Brand</option>
                  <option :value="0" >All</option>
                    <option  v-for="brand in brands"
                      :key="brand.id"
                      :value="brand.manu_id"  >
                      {{brand.manu_name}}
                    </option>
                </select>
                    </div>

                    <div class="col-md-6">
                      <div class="input-group mt-1">
                    <input
                      type="text"
                      id="example-input2-group2"
                      v-model="search"
                      class="form-control"
                      placeholder="Search by IMEI or E-mail or Order Id"
                    />
                    <span class="input-group-append">
                      <button
                        type="submit"
                        @click.prevent="searchValue"
                        class="btn btn-gradient-primary"
                      >
                        Search
                      </button>
                      <button 
                        type="reset"  @click.prevent="clear"
                        class="btn btn-gradient-primary ml-2"
                      >
                        Clear
                      </button>
                    </span>
                  </div>
                    </div>
                  </div>
                <!-- </form> -->
              

              <!-- <div class="col-md-6 mb-2">
                <button
                  type="button"
                  class="btn btn-outline-primary dropdown-toggle float-right mt-1"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  Filter <i class="mdi mdi-chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                </div>
              </div> -->
              <!-- /btn-group -->
            
            <div class="row mt-4">
              <div class="table-responsive">
                <table class="table" id="datatable">
                  <thead class="thead-light">
                    <tr>
                      <th>Order#</th>
                      <th>Name</th>
                      <th>IMEI</th>
                      <th>Tool Name</th>
                      <th>Sale Price</th>
                      <th>API Price</th>
                      <th>Payment Date</th>
                      <th>Payment Status</th>
                      <th>Unlock Status</th>
                      <th>Action</th>
                      <th>Feedback Email</th>
                      <th>Organisation</th>
                    </tr>
                  </thead>
                  <tbody v-for="order in orders.data" :key="order.id">
                    <tr>
                      <td>{{ order!=null?order.order_id:'' }}</td>
                      <td>
                        {{ order.tbl_orders!=null?order.tbl_orders.fname:'' }}
                        {{ order.tbl_orders!=null?order.tbl_orders.lname:'' }}
                      </td>
                      <td>{{ order!=null?order.imei_code:'' }}</td>
                      <td>{{ order.fun_credit!=null ?order.fun_credit.fun_tool_name:'' }}</td>
                      <td>{{ order.custom_price_tool!=null?order.custom_price_tool.selling_price:'' }}</td>
                      <td>{{ order.fun_credit!=null ?order.fun_credit.fun_tool_credits:'' }}</td>
                      <td>{{ order.tbl_orders!=null?order.tbl_orders.payment_date:'' }}</td>
                      <td v-if="order.tbl_orders.pay_status == 1">
                        {{ "Completed" }}
                      </td>
                      <td v-if="order.tbl_orders.pay_status == 0">
                        {{ "Failed" }}
                      </td>
                      <td v-if="order.unlock_status == 1">{{ "Completed" }}</td>
                      <td v-if="order.unlock_status == 0">{{ "Failed" }}</td>
                      <td v-if="order.unlock_status!=0 && order.unlock_status!=1">{{order!=null?order.unlock_status:''}}</td>
                      <td>
                        <button
                          type="submit"
                          @click="getOrder($event)"
                          v-bind:data-id="order.order_id"
                          class="btn btn-gradient-primary waves-effect waves-light"
                          data-toggle="modal"
                          data-target=".bd-example-modal-xl"
                          
                        >
                          Details
                        </button>
                      </td>
                      <td>{{ order.tbl_orders!=null?order.tbl_orders.feedback_email:'' }}</td>
                      <td>{{ order.tbl_orders!=null? order.tbl_orders.organization:'' }}</td>
                    </tr>
                  </tbody>
                  <loading
                    :active.sync="isLoading"
                    :can-cancel="true"
                    loader="bars"
                    color="#007BFF"
                    :is-full-page="false"
                  ></loading>
                </table>
                <hr/>
                <pagination :data="orders" @pagination-change-page="getOrders">
                  </pagination>
                <!--end /table-->
              </div>
              <!--end /tableresponsive-->
            </div>
          </div>
          <!--end card-body-->
        </div>
        <!--end card-->
      </div>
      <!--end col-->
    </div>

    <div class="col-md-11" v-else>
        <div class="card col-md-12  ml-5">
          <div class="card-body ">
            <h4 class="ml-2">{{errors}}</h4>
          </div>
        </div>
      </div>


    <!-- <orderDetails ></orderDetails> -->
    <div class="col-md-6 col-lg-3">
      <!-- sample modal content -->
      <div
        class="modal fade bd-example-modal-xl"
        tabindex="-1"
        role="dialog"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5
                class="modal-title mt-0"
                id="myModalLabel"
                v-for="order in orderDetails.orders"
                :key="order.id"
              >
                <b>Order Detail (Order Id : {{ order!=null?order.order_id:'' }})</b>
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
              >
                ×
              </button>
            </div>

            <div class="card">
              <div class="card-body">
                <div
                  class="modal-body"
                  v-for="order in orderDetails.orders"
                  :key="order.id"
                >
                  <div class="row">
                    <label><b>User Details </b></label>
                  </div>
                  <hr />
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Name :</div>
                    <div class="col-md-6">
                      {{ order.tbl_orders!=null?order.tbl_orders.fname:'' }} {{ order.tbl_orders!=null?order.tbl_orders.lname:'' }}
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Email :</div>
                    <div class="col-md-6">
                      {{ order.tbl_orders.order_users!=null?order.tbl_orders.order_users.email:'' }}
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Password:</div>
                    <div class="col-md-6">
                      {{ order.tbl_orders.order_users!=null?order.tbl_orders.order_users.password:'' }}
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">User IP :</div>
                    <div class="col-md-6">
                      {{ order.tbl_orders!=null?order.tbl_orders.user_ip_address:'' }}
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">User Country :</div>
                    <div class="col-md-6">
                      {{ order.tbl_orders!=null?order.tbl_orders.address_country:'' }}
                    </div>
                  </div>
                  <div class="row mt-5">
                    <label><b>Order Details </b></label>
                  </div>
                  <hr />
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Brand :</div>
                    <div class="col-md-6">
                      {{ order.manufacturer!=null?order.manufacturer.manu_name:'' }}
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Model :</div>
                    <div class="col-md-6">
                      {{ order.model!=null?order.model.model_num :'' }}
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Network :</div>
                    <div class="col-md-6">
                      {{ order.network!=null?order.network.network_name:'' }}
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Paid Amount :</div>
                    <div class="col-md-6">
                      {{ order.tbl_orders!=null?order.tbl_orders.paid_amount:'' }}
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Country:</div>
                    <div class="col-md-6">
                      {{ order.network!=null?order.network.country_name:'' }}
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Tool Id :</div>
                    <div class="col-md-6">
                      {{ order.fun_credit!=null ?order.fun_credit.fun_tool_id:'' }}
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Tool :</div>
                    <div class="col-md-6">
                      {{ order.fun_credit!=null ?order.fun_credit.fun_tool_name:'' }}
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">IMEI No :</div>
                    <div class="col-md-6">{{ order!=null?order.imei_code:'' }}</div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Transaction Id :</div>
                    <div class="col-md-6">{{ order.tbl_orders!=null?order.tbl_orders.txn_id:'' }}</div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Order Date :</div>
                    <div class="col-md-6">{{ order!=null?order.order_dt_tm:'' }}</div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Unlock Id :</div>
                    <div class="col-md-6">{{ order!=null?order.unlock_id:'' }}</div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Unlock Code :</div>
                    <div class="col-md-6">{{ order!=null?order.unlock_code:'' }}</div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5">Select Tool :</div>
                    <div class="col-md-6">
                      <div v-if="errors" class="alert alert-outline-danger  alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                          </button>
                          <strong>{{errors.message}}</strong> 
                      </div>
                      <div v-if="message" class="alert alert-outline-success  alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                          </button>
                          <strong>Re-order created Successfully.</strong> 
                      </div>
                      <div v-if="refund_message" class="alert alert-outline-purple  alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                          </button>
                          <strong>{{refund_message}}</strong> 
                      </div>
                      
                    </div> 
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5"></div>
                    <div class="col-md-6">
                       
                     

                      <button v-if="!order.tbl_orders.payment_status"
                        type="button" @click.prevent="reFund(order.tbl_orders.order_id )"
                        class="btn btn-primary waves-effect waves-light ml-2"
                      >
                        Refund
                      </button>
                      <button
                        type="button"
                        class="btn btn-primary waves-effect waves-light ml-2"
                      >
                        Refunded by the Provider
                      </button>
                    </div>
                  </div>

                  <div class="row mt-5">
                    <label><b>Comment </b></label>
                  </div>
                  <hr />
                  <div class="row mt-3">
                    <div class="col-md-2 ml-5">Comment - 1 :</div>
                    <div class="col-md-6"></div>
                  </div>
                    <input type="hidden" id="orderID" :value="order.order_id"/>
                  <div class="row mt-3">
                    <div class="col-md-2 ml-5">Add Comment :</div>
                    <div class="col-md-6">
                      <textarea
                        class="form-control"
                        rows="3"
                        v-model="comment"
                        placeholder="Add Comments"
                        id="message"
                        :class="{ 'is-invalid': submitted && $v.comment.$error }"
                      ></textarea>
                      <div
                      v-if="submitted && !$v.comment.required"
                      class="invalid-feedback"
                      >
                      This field is required
                      </div>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-2 ml-5"></div>
                    <div class="col-md-6">
                      <button
                        type="button" @click.prevent="commentStore"
                        class="btn btn-primary waves-effect waves-light"
                      >
                        Save
                      </button>
                      <button
                        type="button" data-dismiss="modal"
                        class="btn btn-primary waves-effect waves-light ml-2"
                      >
                        Cancel
                      </button>
                    </div>
                  </div>
                </div>
                <!-- <button
                type="button"
                class="btn btn-secondary waves-effect float-right ml-2"
                data-dismiss="modal"
              >
                Close
              </button> -->
                <!-- <button
                type="button"
                class="btn btn-primary waves-effect waves-light float-right"
              >
                Save
              </button> -->
              </div>
              <!--end card-body-->
            </div>
            <!--end card-->
          </div>
          <!-- /.modal-content -->
          <!-- <loading
            :active.sync="isLoading"
            :can-cancel="true"
            loader="bars"
            color="#007BFF"
            :is-full-page="false"
          ></loading> -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>
    <!-- <loading
      :active.sync="isLoading"
      :can-cancel="true"
      loader="bars"
      color="#007BFF"
      :is-full-page="false"
    ></loading> -->
  </div>
  
  <!-- end page content -->
  <FooterComponent />
  </div>
</div>
</template>
<script>
//var csrf_token = $('meta[name="csrf-token"]').attr('content');
//import orderDetails from "./Order_details"
import Vue from "vue";
Vue.component("pagination", require("laravel-vue-pagination"));
import Url from "../../../url";
import Loading from "vue-loading-overlay";
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import moment from "moment";
import MainMenuComponent from "../../layout/MainMenuComponent.vue";
import TopbarComponent from "../../layout/TopbarComponent.vue";
import FooterComponent from "../../layout/FooterComponent.vue";
export default {
  data() {
    return {
      orders: {},
      order: {
        order_id:""
      },
      orderDetails: {},
      searchQuery: null,
      isLoading: false,
      submitted: false,
      errors:"",
      message:"",
      refund_message:"",
      searchOrders: "",
      search: "",
      select: "",
      comment:"",
      order_id:"",
      orderID:"",
      date:"",
      brands:"",
      
      manu_id:"",
      pageShow:true
    };
  },


    validations: {
        required,
       

    },
  

  mounted() {
    this.getOrders();
    this.getBrands();
    //this.getOrder();
    //this.sortValue();
  
// Tool select option setting width

 require("../../../../../public/plugins/daterangepicker/daterangepicker.css");
      require("../../../../../public/plugins/daterangepicker/daterangepicker");

!function($) {
  "use strict";

  var AdvancedForm = function() {};
  
  AdvancedForm.prototype.init = function() {
    // Date range picker
    $('input[name="dates"]').daterangepicker({
        "alwaysShowCalendars": true,
      });
      $('.open_picker').show();
      
      $('input[name="daterange"]').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      });
    
      $('input[name="datetimes"]').daterangepicker({
        timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
          format: 'M/DD hh:mm A'
        }
      });
    
      $('input[name="birthday"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'),10)
      }, function(start, end, label) {
        var years = moment().diff(start, 'years');
        alert("You are " + years + " years old!");
      });
    
      var start = moment().subtract(29, 'days');
      var end = moment();
    
      function cb(start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }
    
      $('#reportrange').daterangepicker({
          startDate: start,
          endDate: end,
          ranges: {
             'Today': [moment(), moment()],
             'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
             'This Month': [moment().startOf('month'), moment().endOf('month')],
             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          }
      }, cb);
    
          
  },
  //init
  $.AdvancedForm = new AdvancedForm, $.AdvancedForm.Constructor = AdvancedForm
}(window.jQuery),

//initializing
function ($) {
  "use strict";
  $.AdvancedForm.init();
}(window.jQuery);

  
  },
  //   components: {
  //   orderDetails,
  // },
  components: {
     MainMenuComponent,
    TopbarComponent,
    FooterComponent,
    Loading,
  },

  methods: {

    getBrands(){
        Url.get("/getBrandsCont").then((response) => {
        this.brands = response.data;
        this.isLoading = false;
        // setTimeout(function () {
        //     $(".selectpicker").selectpicker("refresh");
        // }, 300);
      })
      },

    //scrolling page for errors detecting
     scrollToTop() {
        window.scrollTo(0,0);
      },

    getOrders(page) {
      // for loader
      this.isLoading = true;
      // setTimeout(() => { 
      // }, 1000);
      if (typeof page === "undefined") {
        page = 1;
      }
      Url.get("/getOldOrders?page=" + page).then((response) => {
        this.orders = response.data;
        console.log(this.orders);
        this.isLoading = false;
      }).catch((error) => {
         if (error.response.status === 403) {
          this.errors = error.response.data.message;
          this.pageShow=false;
          if(this.errors=='User is not logged in.'){
            localStorage.removeItem("auth");
          this.$router.push({ name: "Login" });
          }
          console.log("Delete car: " + error);
         }
      });
    },

    getOrder(e) {
      // for loader
      this.isLoading = true;
      var data_id = e.target.dataset.id;
      Url.get("/getOldOrders/" + data_id).then((response) => {
        this.orderDetails = response.data;
        this.isLoading = false;
      }).catch((error) => {
         if (error.response.status === 403) {
          this.errors = error.response.data.message;
          this.pageShow=false;
          if(this.errors=='User is not logged in.'){
            localStorage.removeItem("auth");
          this.$router.push({ name: "Login" });
          }
          console.log("Delete car: " + error);
         }
      });
      
    },

    reOrder(toolid, orderid)
    {

      Url.get("/reprocess/" + toolid + '/' + orderid).then((response) => {

       // this.orders = response.data;
       console.log(response.data);
       if (response.status === 200){
         this.message=response.data;
         //alert(this.message)
       }
      })
      .catch((error) => {
         if (error.response.status === 422 ||error.response.status === 500) {
           this.errors = error.response.data;//.message;
           //alert(this.errors.message);
         }

      });
      
    },

    reFund(orderid)
    {

      Url.get("/refund/"  + orderid).then((response) => {
       console.log(response.data);
      //  if (response.status === 200){
         this.refund_message= response.data;
         //alert(this.message)
       //}
      })
      .catch((error) => {
         if (error.response.status === 422 ||error.response.status === 500) {
           this.errors = 'failed' //error.response.data;
           //alert(this.errors.message);
         }

      });
      
    },

    searchValue() {
      this.date=document.getElementById("date").value;
      Url.post("/old_search",
       { search: this.search,
          date:this.date,
          manu_id:this.manu_id 
          }).then((response) => {
        this.orders = response;
      });
    },

    clear(){
     this.search="";
     this.date="";
     this.manu_id="";
     this.getOrders();
    },

    commentStore(){
      // stop here if form is invalid
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return this.scrollToTop();
      }
      var orderID = document.getElementById('orderID').value;
      Url.post("/order_comment",{
        order_id:orderID,
        comment:this.comment,
      }

      )
        .then(() => {
          Vue.$toast.open({
            message: "Comment Added Successfully!",
            type: "success",
            position: "top",
            duration: 3000,
          });
          
        })

        .catch((error) => {
         if (error.response.status === 422) {
           this.errors = error.response.data.errors;
            Vue.$toast.open({
            message: "All (*) fields required",
            type: "error",
            position: 'top',
            duration: 5000,
          })
          this.scrollToTop(); 
         }
        });
        
    },
    
  },
  
};
$(document).ready(function(){
  $("#select").click(function(){
  var e=document.querySelectorAll('.short')
  alert(e);
  e.forEach(x=>{
    if(x.textContent.length>100)
    x.textContent=x.textContent.substring(0,100)+'...';
  })
  });

});
</script>


