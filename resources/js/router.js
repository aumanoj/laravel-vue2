import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../js/components/Home";
import Login from "../js/components/Login";
// import Register from "../js/components/Register";
import Dashboard from "../js/components/Dashboard";
import ForgotPassword from "../js/components/Forgot-password";
import ResetPassword from "../js/components/Reset-password";
import changePassword from "../js/components/Change-password";

import addCity from "../js/components/city/addCity";
import editCity from "../js/components/city/editCity";
import cityList from "../js/components/city/cityList";

import addAdmin from "../js/components/admin/createAdmin";
import adminList from "../js/components/admin/adminList";
import editAdmin from "../js/components/admin/editAdmin";
import editProfile from "../js/components/admin/editProfile";

import addRole from "../js/components/admin/role/createRole";
import roleList from "../js/components/admin/role/roleList";
import editRole from "../js/components/admin/role/editRole";

import oldorder from "../js/components/admin/reports/oldOrder";

import order from "../js/components/admin/reports/Order";
import orderDetails from "../js/components/admin/reports/Order_details";

import brandList from "../js/components/admin/pages/brand/brandList";
import createBrand from "../js/components/admin/pages/brand/createBrand";
import editBrand from "../js/components/admin/pages/brand/editBrand";

import modelList from "../js/components/admin/pages/model/modelList";
import createModel from "../js/components/admin/pages/model/createModel";
import editModel from "../js/components/admin/pages/model/editModel";

import assetList from "../js/components/admin/pages/manage-assets/assetList";
import createAsset from "../js/components/admin/pages/manage-assets/createAsset";
import editAsset from "../js/components/admin/pages/manage-assets/editAsset";




import tools from "../js/components/admin/tools/tools";
import createTool from "../js/components/admin/tools/createTool";
import editTool from "../js/components/admin/tools/editTool";

import toolSelections from "../js/components/admin/toolSelections/toolSelectionList";
import editToolSelections from "../js/components/admin/toolSelections/editToolSelections";
import addToolSelections from "../js/components/admin/toolSelections/addToolSelections";

import topOrders from "../js/components/admin/reports/TopOrders";
import reportOrderDetails from "../js/components/admin/reports/ReportOrderDetails";
import generateReportsA from "../js/components/admin/reports/GenerateReports";
import listModels from "../js/components/admin/pages/models/listModels";
import createModels from "../js/components/admin/pages/models/createModels";
import editModels from "../js/components/admin/pages/models//editModels";

Vue.use(VueRouter);

const routesWithPrefix = (prefix, routes) => {
  return routes.map(route => {
  route.path = `${prefix}${route.path}`

    return route
  })
}


const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: { guestOnly: true }
  },
  
  
  
  // {
  //   path: "/register",
  //   name: "Register",
  //   component: Register,
  //   meta: { guestOnly: true }
  // },
  
  
  
  //used for group prefix route same as laravel group route
  ...routesWithPrefix('/admin', [

    {
      path: "/login",
      name: "Login",
      component: Login,
      meta: { guestOnly: true }
    },
    {
      path: "/forgot-password",
      name: "ForgotPassword",
      component: ForgotPassword,
      meta: { guestOnly: true }
    },
    {
      path: "/reset-password/:token",
      name: "ResetPassword",
      component: ResetPassword,
      meta: { guestOnly: true }
    },

    {
      path: "/dashboard",
      name: "Dashboard",
      component: Dashboard,
      meta: { authOnly: true }
    },

    {
      path: "/add-admin",
      name: "addAdmin",
      component: addAdmin,
      meta: { authOnly: true }
    },
    {
      path: "/admins",
      name: "adminList",
      component: adminList,
      meta: { authOnly: true }
    },
    {
      path: "/edit-user/:id",
      name: "editAdmin",
      component: editAdmin,
      meta: { authOnly: true }
    },
    {
      path: "/edit-profile/:id",
      name: "editProfile",
      component: editProfile,
      meta: { authOnly: true }
    },
    
    // {
    //   path: "/cities/add-city",
    //   name: "addCity",
    //   component: addCity,
    //   meta: { authOnly: true }
    // },
    // {
    //   path: "/cities/edit-city/:id",
    //   name: "editCity",
    //   component: editCity,
    //   meta: { authOnly: true }
    // },
  
    // {
    //   path: "/cities",
    //   name: "cityList",
    //   component: cityList,
    //   meta: { authOnly: true }
    // },

    {
      path: "/roles/add-role",
      name: "addRole",
      component: addRole,
      meta: { authOnly: true }
    },
    {
      path: "/roles",
      name: "roleList",
      component: roleList,
      meta: { authOnly: true }
    },
    {
      path: "/roles/edit-role/:id",
      name: "editRole",
      component: editRole,
      meta: { authOnly: true }
    },

    {
      path: "/change-password",
      name: "changePassword",
      component: changePassword,
      meta: { authOnly: true }
    },

    {
      path: "/reports/old-order",
      name: "oldorder",
      component: oldorder,
      meta: { authOnly: true }
    },

    {
      path: "/reports/order",
      name: "order",
      component: order,
      meta: { authOnly: true }
    },

    {
      path: "/reports/order-details/:id",
      name: "orderDetails",
      component: orderDetails,
      meta: { authOnly: true }
    },
  
    {
      path: "/brands/brand-content-list",
      name: "brandList",
      component: brandList,
      meta: { authOnly: true }
    },

    {
      path: "/brands/create-brand-content",
      name: "createBrand",
      component: createBrand,
      meta: { authOnly: true }
    },
  
    {
      path: "/brands/edit-brand-content/:id",
      name: "editBrand",
      component: editBrand,
      meta: { authOnly: true }
    },
  
    {
      path: "/models/model-content-list",
      name: "modelList",
      component: modelList,
      meta: { authOnly: true }
    },
    
    {
      path: "/models/create-model-content",
      name: "createModel",
      component: createModel,
      meta: { authOnly: true }
    },

    {
      path: "/models/edit-model-content/:id",
      name: "editModel",
      component: editModel,
      meta: { authOnly: true }
    },


    {
      path: "/manage-assets/asset-list",
      name: "assetList",
      component: assetList,
      meta: { authOnly: true }
    },
    
    {
      path: "/manage-assets/create-asset",
      name: "createAsset",
      component: createAsset,
      meta: { authOnly: true }
    },

    {
      path: "/manage-assets/edit-asset/:id",
      name: "editAsset",
      component: editAsset,
      meta: { authOnly: true }
    },


    {
      path: "/tools",
      name: "tools",
      component: tools,
      meta: { authOnly: true }
    },

    {
      path: "/create-tool",
      name: "createTool",
      component: createTool,
      meta: { authOnly: true }
    },

    {
      path: "/edit-tool/:id",
      name: "editTool",
      component: editTool,
      meta: { authOnly: true }
    },

    {
      path: "/toolSelections",
      name: "toolSelections",
      component: toolSelections,
      meta: { authOnly: true }
    },

    {
      path: "/topOrders",
      name: "topOrders",
      component: topOrders,
      meta: { authOnly: true }
    },
    {
      path: "/reportOrderDetails",
      name: "reportOrderDetails",
      component: reportOrderDetails,
      meta: { authOnly: true }
    },
    {
      path: "/generateReportA",
      name: "generateReportA",
      component: generateReportsA,
      meta: { authOnly: true }
    },
    {
      path: "/models/list-models",
      name: "listModels",
      component: listModels,
      meta: { authOnly: true }
    },
    
    {
      path: "/models/create-models",
      name: "createModels",
      component: createModels,
      meta: { authOnly: true }
    },

    {
      path: "/models/edit-models/:id",
      name: "editModels",
      component: editModels,
      meta: { authOnly: true }
    },
    {
      path: "/edit-tool-selections/:id",
      name: "editToolSelections",
      component: editToolSelections,
      meta: { authOnly: true }
    },

    {
      path: "/add-tool-selections",
      name: "addToolSelections",
      component: addToolSelections,
      meta: { authOnly: true }
    },

  ]), 

 

];


const router = new VueRouter({
  mode: "history",
  routes,
  // base:"/admin"
  // linkActiveClass: "active",
  // linkExactActiveClass: "exact-active",
});

function isLoggedIn() {
  return localStorage.getItem("auth");
}

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.authOnly)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (!isLoggedIn()) {
      next({
        name: "Login",
        query: { redirect: to.fullPath }
      });
    } else {
      next();
    }
  } else if (to.matched.some(record => record.meta.guestOnly)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (isLoggedIn()) {
      next({
        name: "Dashboard",
        query: { redirect: to.fullPath }
      });
    } else {
      next();
    }
  } else {
    next({
      name: "Dashboard",
      query: { redirect: to.fullPath }
    }); // make sure to always call next()!
  }
});

export default router;