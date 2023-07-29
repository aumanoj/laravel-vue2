<template>
  <div id="app" class="bg-light h-screen">
    <!-- <Navigation v-if="isLoggedIn" /> -->
    <div  v-if="isLoggedIn">
    <!-- <div class="page-wrapper" v-if="isLoggedIn">
      <MainMenuComponent />
      <div class="page-content">
        <TopbarComponent /> -->
        <router-view />
        <!-- <FooterComponent  /> -->
      <!-- </div>
    </div> -->
    </div>
    <div class="page-content" v-if="!isLoggedIn">
      <router-view />
    </div>
   
  </div>
</template>

<script>
// import Navigation from "@/components/Navigation.vue";
import TopbarComponent from "../components/layout/TopbarComponent.vue";
import MainMenuComponent from "../components/layout/MainMenuComponent.vue";
import FooterComponent from "../components/layout/FooterComponent.vue";



var jQuery = require("jquery");
export default {
  components: {
    // Navigation,
    TopbarComponent,
    MainMenuComponent,
    FooterComponent,
  },
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

  methods: {},
};
</script>


