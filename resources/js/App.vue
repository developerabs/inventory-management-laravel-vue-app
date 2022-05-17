<script setup>
import {RouterLink, RouterView } from 'vue-router' 
import SidebarAdmin from './components/layouts/SidebarAdmin.vue'
import HeaderAdmin from './components/layouts/HeaderAdmin.vue'
</script>

<template> 
       <!-- sa-app__sidebar -->
      <SidebarAdmin/>
       <!-- sa-app__sidebar / end -->
        <!-- sa-app__content -->
      <div class="sa-app__content">
         <!-- sa-app__toolbar -->
        <HeaderAdmin/>
         <!-- sa-app__toolbar / end -->
        <!-- sa-app__body -->
        <div id="top" class="sa-app__body px-2 px-lg-4">
            <div class="container pb-6"> 
                <RouterView />    
            </div>
        </div>
        <!-- sa-app__body / end -->
        </div>
      <!-- route outlet -->
      <!-- component matched by the route will render here -->
     
</template>

 <style scoped>
 
 </style>