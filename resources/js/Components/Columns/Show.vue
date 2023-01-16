<template>
    <div class="py-12 mr-4 w-96">
        <div class="divide-y divide-gray-200 overflow-hidden rounded-md bg-white shadow">
            <div class="px-4 py-2 sm:px-6 flex justify-between">
            <span>{{ column.title }}</span>
            <span class="hover:cursor-pointer" @click="deleteColumn(column.id)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
            </div>
            <div class="px-2 py-5">
                <div v-if="column.cards.length">
                    <show-card v-for="(card, index) in column.cards" 
                    :key="index" 
                    :id="column.id"
                    :card="card"/>
                </div>

                <div class="divide-y divide-gray-200 overflow-hidden rounded-md shadow" @click="showCardForm(column.id)" @reloadColumn="reloadColumn()">
                    <div class="bg-gray-100 hover:cursor-pointer hover:bg-gray-200 px-4 flex py-2 sm:px-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                        <span>Add card </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ShowCard from "../Cards/Show";
    import CreateCard from "../Cards/Create";
    import ColumnService from "../../services/Column";

    export default {
        components:{
            ShowCard,
            CreateCard,
        },
         data(){
            return {
                columnId:null
            }
        },
        props: {
            column: Object,
        },
        methods:{
            async deleteColumn(columnId){
                const column = await ColumnService.delete(columnId)
                .then(response => {
                    this.$emit('afterDelete');
                });
            },
            showCardForm(columnId){
                this.columnId = columnId;
                this.$modal.show(CreateCard, {
                    columnId: columnId
                });
            },
            async reloadColumn(){
                const column = await ColumnService.show(this.column.id)
                .then(response => {
                    this.column = response.data
                });
            }
        },
    }
</script>