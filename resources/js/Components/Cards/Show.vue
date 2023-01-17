<template>
    <div class="w-full my-3 overflow-hidden rounded-md shadow" @click="showEditForm(columnId)">
        <span class="bg-gray-100 hover:cursor-pointer hover:bg-gray-200 px-2 flex py-4 sm:px-3"> 
            {{ resource.title }}
        </span>
    </div>
</template>

<script>
    import EditCard from "../Cards/Edit";
    import CardService from "../../services/Card";
    export default {
      props: {
        card: Object,
        columnId: Number
      },
      data(){
          return {
              resource: this.card,
              currentColumnId: this.columnId,
          }
      },
      components:{
        EditCard,
      },
      methods:{
            showEditForm(){
                this.$modal.show(EditCard, 
                    { card: this.resource},
                    { height: 'auto' },
                    { 'before-close': event => {
                        this.reloadCard()
                    } }
                );
            },
            async reloadCard(){
                const column = await CardService.show(this.resource.id)
                .then(response => {
                    this.resource = response.data
                });
            }
        },
    }
</script>