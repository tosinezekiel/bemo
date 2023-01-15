<template>
  <div>
     <div class="mt-3">
        <h1 class="text-3xl">Welcome home!😊</h1>
    </div>

    <div class="py-3 flex-grow flex overflow-auto">
        <show-column />
        <show-column />
        <show-column />

        <create-column />
    </div>
  </div>
   
</template>
<script>
    import ShowColumn from "../Components/Columns/Show";
    import CreateColumn from "../Components/Columns/Create";

    export default {
      name: "Dashboard",
      components:{
          ShowColumn,
          CreateColumn
      }
    }
</script>
