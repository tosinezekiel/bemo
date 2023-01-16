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

                <div class="divide-y divide-gray-200 overflow-hidden rounded-md shadow" @click="showCardForm()">
                    <div class="bg-gray-100 hover:cursor-pointer hover:bg-gray-200 px-4 flex py-2 sm:px-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                        <span>Add card </span>
                    </div>
                </div>
            </div>
        </div>

        <modal name="create-card" :width="450" :height="250">
            <div class="p-5 w-full">
                <p>
                    {{ column.id }}
                </p>
                <div class="mt-1">
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" v-model="title" id="title" placeholder="Enter column title" class="block w-full px-2 py-2 rounded-sm border-gray-300 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm"/>
                    </div>
                </div>
                <div class="mt-1">
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <div class="mt-1">
                        <textarea rows="4" v-model="description" id="description" class="block w-full pl-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                        </div>
                    </div>
                </div>
                <div class="flex mt-2">
                    <button type="button" @click.prevent="save()" class="mr-2 inline-flex items-center rounded border border-transparent bg-indigo-600 px-2.5 py-1.5 text-xs font-medium text-white shadow-sm hover:bg-indigo-700">
                        Save
                    </button>
                    <button type="button" @click="close()" class="inline-flex items-center rounded border border-transparent bg-white px-2.5 py-1.5 text-xs font-medium text-black shadow-sm">
                        cancel
                    </button>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
    import ShowCard from "../Cards/Show";
    import CreateCard from "../Cards/Create";
    import ColumnService from "../../services/Column";
    import CardService from "../../services/Card";

    export default {
        components:{
            ShowCard,
            CreateCard,
        },
         data(){
            return {
                title: "",
                description: ""
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
            showCardForm(){
                this.$modal.show('create-card');
            },
            save(){
            console.log(this.column.id)
            // let data = {
            //     title: this.title,
            //     description: this.description
            // };

            // const column = await CardService.save(this.resourceId, data)
            // .then(response => {
            //     this.title = "";
            //     this.description = "";
            //     this.$emit('reloadColumn')
            //     this.$modal.hide('create-card');
            // },(error) => {
            //     console.log(error)
            // });
            },
            close(){
                this.$modal.hide('create-card');
            },
            async reloadColumns(){
                const column = await ColumnService.show(this.column.id)
                .then(response => {
                    this.column = response.data
                });
            }
        },
    }
</script>