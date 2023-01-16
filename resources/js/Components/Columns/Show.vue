<template>
    <div class="py-12 mr-4 w-96">
        <div class="divide-y divide-gray-200 overflow-hidden rounded-md bg-white shadow">
            <div class="px-4 py-2 sm:px-6 flex justify-between">
            <span class="text-lg font-semibold">{{ column.title }}</span>
            <span class="hover:cursor-pointer" @click="deleteColumn(column.id)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
            </div>
            <div class="px-2 py-5 space-y-2">
                <div v-if="cards.length" class="space-y-2">
                    <show-card v-for="(card, index) in cards" 
                    :key="index" 
                    :id="currentColumn.id"
                    :card="card"/>
                </div>

                <div class="divide-y divide-gray-200 overflow-hidden rounded-md shadow" @click="showCardForm(currentColumn.id)">
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
                columnId:null,
                currentColumn: this.column,
                cards: this.column.cards
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
                this.$modal.show(CreateCard, 
                    { columnId: columnId },
                    { height: 'auto' },
                    { 'before-close': event => {
                        this.reloadColumn()
                    } }
                );
            },
            async reloadColumn(){
                const column = await ColumnService.show(this.currentColumn.id)
                .then(response => {
                    this.cards = [...response.data.cards]
                });
            }
        },
    }
</script>