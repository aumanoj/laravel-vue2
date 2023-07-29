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
            <h4 class="page-title">Order Details Report</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row mt-4">
              <div class="table-responsive">
                <table class="table" id="datatable">
                  <thead class="thead-light">
                    <tr>
                      <tr v-if='isGroup===0'>
                        <th>OrderID</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Country</th>
                        <th>Network</th>
                        <th>Paid</th>
                        <th>Refund</th>
                      
                      <tr v-else>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Country</th>
                        <th>Network</th>
                        <th>Total Qty</th>
                        <th>Paid</th>
                        <td>Refund</td>
                      </tr>
                      
                    </tr>
                  </thead>
                  <tbody v-for="orderDetail in orderDetails" :key="orderDetail.id">
                    <tr v-if='isGroup===0'>
                      <td>{{orderDetail.order_id}}</td>
                      <td>{{orderDetail.manu_name}}</td>
                      <td>{{orderDetail.model_num}}</td>
                      <td>{{orderDetail.country_name}}</td>
                      <td>{{orderDetail.network_name}}</td>
                      <td>{{orderDetail.paid_amount}}</td>
                      <td>{{moment(orderDetail.insert_time).format("DD-MM-YYYY")}}</td>
                    <tr v-else>
                      <td>{{orderDetail.manu_name}}</td>
                      <td>{{orderDetail.model_num}}</td>
                      <td>{{orderDetail.country_name}}</td>
                      <td>{{orderDetail.network_name}}</td>
                      <td>{{orderDetail.qty}}</td>
                      <td>{{orderDetail.paid}}</td>
                      <td>{{orderDetail.refund}}</td>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <FooterComponent />
  </div>
</div>
</template>

<script>
  import Vue from 'vue';
  import Url from "../../../url";
  import VueToast from 'vue-toast-notification';
  import Loading from "vue-loading-overlay";
  import moment from "moment";
  import MainMenuComponent from "../../layout/MainMenuComponent.vue";
import TopbarComponent from "../../layout/TopbarComponent.vue";
import FooterComponent from "../../layout/FooterComponent.vue";
  Vue.use(VueToast);
  export default {
    data(){
      return {
        orderDetails:{},
        isLoading:false,
        isGroup:0,
        moment:moment
      }
    },
    mounted() {
      this.getOrderDetails();
    },
    components: {
      MainMenuComponent,
    TopbarComponent,
    FooterComponent,
      Loading,
    },
    methods: {
      getOrderDetails() {
        this.isLoading = true;
        Url.get('/getOrderDetailContent')
          .then((response) => {
            this.isGroup = response.data.isGroup;
            this.orderDetails = response.data.tblOrder;
            console.log('success');
            console.log(this.isGroup);
            console.log(this.orderDetails);
            this.isLoading = false;
          })
      },
    }
  }
</script>
