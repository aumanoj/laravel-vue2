<template>
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
            <h5 class="modal-title mt-0" id="myModalLabel">Order Detail</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >×</button>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="modal-body" v-for="order in orders" :key="order.id">
                <div class="row">
                  <label><b>User Details </b></label>
                </div>
                <hr/>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Name :</div>
                  <div class="col-md-6">{{order.tbl_orders.fname}} {{order.tbl_orders.lname}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Email :</div>
                  <div class="col-md-6">{{order.tbl_orders.email}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Password:</div>
                  <div class="col-md-6">HWE2345Q</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">User IP :</div>
                  <div class="col-md-6">{{order.tbl_orders.user_ip_address}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">User Country :</div>
                  <div class="col-md-6">{{order.tbl_orders.address_country}}</div>
                </div>
                <div class="row mt-5">
                  <label><b>Order Details </b></label>
                </div>
                <hr/>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Brand :</div>
                  <div class="col-md-6">{{order.manufacturer.manu_name}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Model :</div>
                  <div class="col-md-6">{{order.model.model_num}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Network :</div>
                  <div class="col-md-6">{{order.network.network_name}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Paid Amount :</div>
                  <div class="col-md-6">{{order.tbl_orders.paid_amount}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Country:</div>
                  <div class="col-md-6">{{order.network.country_name}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Tool Id :</div>
                  <div class="col-md-6">{{order.credits.tool_id}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Tool :</div>
                  <div class="col-md-6">{{order.credits.tool_name}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">IMEI No :</div>
                  <div class="col-md-6">{{order.imei_code}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Transaction Id :</div>
                  <div class="col-md-6"></div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Order Date :</div>
                  <div class="col-md-6">{{order.order_dt_tm}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Unlock Id :</div>
                  <div class="col-md-6">{{order.unlock_id}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Unlock Code :</div>
                  <div class="col-md-6">{{order.unlock_code}}</div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5">Select Tool :</div>
                  <div class="col-md-6">
                    <select
                    class="form-control "
                    v-model="order.credits.tool_name"
                    >
                    <option value="" selected disabled>
                      Please Select Role
                    </option>
                    <option
                      
                      :value="select"
                    >
                      {{ order.credits.tool_name }}
                    </option>
                  </select>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5"></div>
                  <div class="col-md-6">
                      <button type="button" class="btn btn-primary waves-effect waves-light">
                          Reorder 
                        </button>
                        <button type="button" class="btn btn-primary waves-effect waves-light ml-2">
                          Refund
                        </button>
                        <button type="button" class="btn btn-primary waves-effect waves-light ml-2">
                          Refunded by the Provider
                        </button>
                  </div>
                </div>

                <div class="row mt-5">
                  <label><b>Comment </b></label>
                </div>
                <hr/>
                <div class="row mt-3">
                  <div class="col-md-2 ml-5">Comment - 1 :</div>
                  <div class="col-md-6"></div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-2 ml-5">Add Comment :</div>
                  <div class="col-md-6">
                      <textarea class="form-control" rows="3" placeholder="Add Comments" id="message"></textarea>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-2 ml-5"></div>
                  <div class="col-md-6">
                      <button type="button" class="btn btn-primary waves-effect waves-light">
                          Save
                        </button>
                        <button type="button" class="btn btn-primary waves-effect waves-light ml-2">
                          Back
                        </button>
                  </div>
                </div>
              </div>
              <button
                type="button"
                class="btn btn-secondary waves-effect float-right ml-2"
                data-dismiss="modal"
              >
                Close
              </button>
              <button
                type="button"
                class="btn btn-primary waves-effect waves-light float-right"
              >
                Save
              </button>
            </div>
            <!--end card-body-->
          </div>
          <!--end card-->
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </div>
  <!--end col-->
</template>

<script>

import Url from "../../../url";
export default {
    data(){
        return{
            orders:{},
            order:{},
            searchQuery: null,
            select:""
        }
    },
    mounted(){
        this.getOrders();
    },

  methods:{
      getOrders() {
      Url.get("/getOrder/").then((response) => {
        this.orders = response.data;
      })
    },

  },
}
</script>