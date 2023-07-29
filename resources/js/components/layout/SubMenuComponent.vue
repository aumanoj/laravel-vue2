<template>
  <div class="main-menu-inner">
    <div class="menu-body slimscroll">
      <div id="MetricaFranchise" class="main-icon-menu-pane">
        <div class="title-box">
          <h6 class="menu-title">Admin</h6>       
        </div>
        <ul class="nav">
          <router-link tag="li" :to="{name:'Dashboard'}" class="nav-item"><a class="nav-link" :class="{ 'active': isActive_dash }"><i class="dripicons-device-desktop"></i>Dashboard</a></router-link>
          <router-link tag="li" :to="{name:'adminList'}" class="nav-item" ><a class="nav-link"  :class="{ 'active': isActive_admin }" ><i class="dripicons-user-group"></i>Admin list</a></router-link>
          <!-- <router-link tag="li" :to="{name:'cityList'}" class="nav-item" ><a class="nav-link" :class="{ 'active': isActive_city }" ><i class="dripicons-home"></i>City list</a></router-link> -->
          <router-link tag="li" :to="{name:'roleList'}" class="nav-item"><a class="nav-link" :class="{ 'active': isActive_role }"><i class="dripicons-user"></i>Role & Permissions</a></router-link>
          <router-link tag="li" :to="{name:'changePassword'}" class="nav-item" ><a class="nav-link" :class="{ 'active': isActive_change_pass }"><i class="dripicons-lock-open"></i>Change Password</a></router-link>
          <router-link tag="li" :to="{name:'tools'}" class="nav-item" ><a class="nav-link"  :class="{ 'active': isActive_tools }" ><i class="mdi mdi-toolbox"></i>Tools</a></router-link>
          <router-link tag="li" :to="{name:'toolSelections'}" class="nav-item" ><a class="nav-link"  :class="{ 'active': isActive_toolSelections }" ><i class="dripicons-checklist"></i>Tools Selections</a></router-link>

          <router-link tag="li" :to="{name:'topOrders'}" class="nav-item"><a class="nav-link" :class="{ 'active' : isActive_topOrders }" ><i class="dripicons-checklist"></i>Top Orders</a></router-link>

          <router-link tag="li" :to="{name: 'reportOrderDetails'}" class="nav-item"><a class="nav-link" :class="{ 'active' : isActive_reportOrderDetails }"><i class="dripicons-checklist"></i>Order Details</a></router-link>
                                
                                
                                
                                <router-link tag="li" :to="{name:'addAdmin'}" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <router-link tag="li" :to="{ name: 'editAdmin', params: { id: param_id } }" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <router-link tag="li" :to="{ name: 'editProfile', params: { id: param_id } }" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <!-- <router-link tag="li" :to="{ name: 'addCity' }" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <router-link tag="li" :to="{ name: 'editCity', params: { id: param_id } }" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link> -->
                                <router-link tag="li" :to="{name:'addRole'}" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <router-link tag="li" :to="{ name: 'editRole', params: { id: param_id } }" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <router-link tag="li" :to="{name:'createTool'}" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <router-link tag="li" :to="{ name: 'editTool', params: { id: param_id } }" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <router-link tag="li" :to="{name:'addToolSelections'}" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <router-link tag="li" :to="{ name: 'editToolSelections', params: { id: param_id } }" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                 <!-- <li class="nav-item"><a class="nav-link" href="change_password.php"><i class="dripicons-lock-open"></i>Change Password</a></li> -->
                                <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-user-group"></i> Sub Franchise</a></li>  -->
                            </ul>
                        </div><!-- end Analytic -->
                        <div id="MetricaMaster" class="main-icon-menu-pane">
                            <div class="title-box">
                                <h6 class="menu-title">Orders</h6>
                            </div>
                            <ul class="nav">
                                <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-basket"></i>Paid Orders</a></li> -->
                                 <router-link tag="li" :to="{name:'order'}" class="nav-item" ><a class="nav-link" :class="{ 'active': isActive_order }"><i class="dripicons-basket"></i>Paid Orders</a></router-link>
                                 <router-link tag="li" :to="{name:'oldorder'}" class="nav-item" ><a class="nav-link" :class="{ 'active': isActive_oldOrder }"><i class="dripicons-basket"></i>Old Paid Orders</a></router-link>
                                <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-home"></i>City List</a></li> -->
                                <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-user"></i>Customers</a></li> -->
                                <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-calendar"></i>Holidays</a></li>
                                <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-user-group"></i>Group</a></li> -->
                                
                            </ul>
                        </div><!-- end Crypto -->
                        <div id="MetricaProduct" class="main-icon-menu-pane">
                            <div class="title-box">
                                <h6 class="menu-title">Pages</h6>        
                            </div>
                            <ul class="nav">
                                <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-home"></i>Home Page</a></li> -->
                                <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-tags"></i>Brand Page</a></li> -->
                                <router-link tag="li" :to="{name:'brandList'}" class="nav-item" ><a class="nav-link" :class="{ 'active': isActive_brandList }"><i class="dripicons-tags"></i>Brand Page</a></router-link>
      <router-link tag="li" :to="{name:'listModels'}" class="nav-item" ><a class="nav-link" :class="{ 'active': isActive_listModels }"><i class="dripicons-jewel"></i> Models</a></router-link>
      <router-link tag="li" :to="{name:'modelList'}" class="nav-item" ><a class="nav-link" :class="{ 'active': isActive_modelList }"><i class="dripicons-jewel"></i>Model Content Page</a></router-link>

                                <router-link tag="li" :to="{name:'assetList'}" class="nav-item" ><a class="nav-link" :class="{ 'active': isActive_assetList }"><i class="dripicons-checklist"></i>Manage Assets</a></router-link>
                                <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-jewel"></i>Model Page</a></li> -->
                                <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-tags"></i>Add-Ons</a></li>
                                <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-jewel"></i>Price</a></li> -->

                                <router-link tag="li" :to="{ name: 'createBrand', params: { id: param_id } }" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <router-link tag="li" :to="{ name: 'editBrand', params: { id: param_id } }" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <router-link tag="li" :to="{ name: 'createModel', params: { id: param_id } }" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <router-link tag="li" :to="{ name: 'editModel', params: { id: param_id } }" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <router-link tag="li" :to="{ name: 'createAsset', params: { id: param_id } }" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>
                                <router-link tag="li" :to="{ name: 'editAsset', params: { id: param_id } }" class="nav-item " ><a class="nav-link" style="display:none" >h</a></router-link>

                                
                                
                                
                            </ul>
                        </div><!-- end  Project-->
                        <div id="MetricaDiscount" class="main-icon-menu-pane">
                            <div class="title-box">
                                <h6 class="menu-title">Discount</h6>           
                            </div>
                            <ul class="nav">
                                <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-tags"></i>Discount-Slab</a></li>
                                <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-ticket"></i>Coupan-Discount</a></li>
                            </ul>
                        </div><!-- end Ecommerce -->
                        <div id="MetricaSettings" class="main-icon-menu-pane">
                            <div class="title-box">
                                <h6 class="menu-title">Settings</h6>          
                            </div>
                            <ul class="nav">
                                <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-user"></i>My Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#"><i class="dripicons-lock-open"></i>Change Password</a></li>
                                
                            </ul>
                        </div><!-- end CRM -->
                        
                    </div><!--end menu-body-->
        </div><!-- end main-menu-inner-->


</template>

<script>

export default {
  data(){
      return{
          param_id:this.$route.params.id
      }
  },

mounted() {
    console.log('Component mounted.')
},
computed: {
  isActive_admin() {
    return this.$route.name === 'addAdmin' || this.$route.name === 'editAdmin' || this.$route.name ==='adminList' || this.$route.name ==='editProfile';
  },
  isActive_role() {
    return this.$route.name === 'addRole' || this.$route.name === 'editRole' || this.$route.name ==='roleList';
  },
  isActive_city() {
    return this.$route.name === 'addCity' || this.$route.name === 'editCity' || this.$route.name ==='cityList';
  },
  isActive_change_pass() {
    return this.$route.name === 'changePassword';
  },
  isActive_dash() {
    return this.$route.name === 'Dashboard';
  },
  isActive_order() {
    return this.$route.name === 'order';
  },
  isActive_oldOrder() {
    return this.$route.name === 'oldorder';
  },
   isActive_brandList() {
    return this.$route.name === 'brandList' || this.$route.name === 'editBrand' || this.$route.name === 'createBrand';
  },

  isActive_modelList() {
    return this.$route.name === 'modelList' || this.$route.name === 'editModel'|| this.$route.name === 'createModel';
  },
  isActive_listModels() {
    return this.$route.name == 'listModels' || this.$route.name === 'editModels' || this.$route.name === 'createModels';
  },
  isActive_assetList() {
    return this.$route.name === 'assetList' || this.$route.name === 'editAsset'|| this.$route.name === 'createAsset';
  },

  isActive_tools() {
    return this.$route.name === 'tools'||this.$route.name === 'createTool'||this.$route.name === 'editTool';
  },

  isActive_toolSelections() {
    return this.$route.name === 'toolSelections'|| this.$route.name==='addToolSelections'||this.$route.name==='editToolSelections';
  },

  isActive_topOrders() {
    return this.$route.name === 'topOrders'
  },

  isActive_reportOrderDetails() {
    return this.$route.name == 'reportOrderDetails'
  },
}
    }
</script>

<style scoped>
    .hide{
        margin-bottom: 100px;
    }
</style>

   