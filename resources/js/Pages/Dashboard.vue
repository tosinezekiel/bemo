<template>
  <div>
     <div class="mt-3">
        <h1 class="text-3xl">Welcome home!😊</h1>
    </div>

    <div class="py-3 flex-grow flex overflow-auto">
        <div v-if="data.length" class="flex">
          <show-column v-for="(column, index) in data"
          @afterDelete="reload()" 
          :key="index" 
          :column="column" />
        </div>

        <create-column @reload="reload()"/>
    </div>
    <div class="max-w-7xl mx-auto overflow-hidden">
      <download />
    </div>
  </div>
   
</template>
<script>
    import ShowColumn from "../Components/Columns/Show";
    import CreateColumn from "../Components/Columns/Create";
    import Download from "../Components/Download";
    import ColumnService from "../services/Column";

    export default {
      name: "Dashboard",
      components:{
          ShowColumn,
          CreateColumn,
          Download
      },
      data(){
        return {
            showForm:false,
            data: []
        };
      },
      methods:{
          async get(){
              const columns = await ColumnService.get().then(response => {
                this.data = response.data;
              });
          },
          reload(){
            this.get()
          }
      },
      created(){
          this.get()
      }
    }
</script>
