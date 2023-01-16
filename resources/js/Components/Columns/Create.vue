<template>
    <div class="py-12 mr-4 w-80">
        <div class="divide-y divide-gray-200 overflow-hidden rounded-md shadow">
            <div class="bg-gray-100 hover:cursor-pointer hover:bg-gray-200 px-4 flex py-4 sm:px-6" @click="toggleForm()" v-if="!showForm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                </svg>
            
                <span>Add another column</span>
            </div>

            <div class="my-2 px-2" v-else>
                <div class="mt-1">
                    <input type="text" v-model="title" id="title" placeholder="Enter column title" class="block w-full px-2 py-2 rounded-sm border-gray-300 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm"/>
                    <span class="text-xs text-red-600" style="color:red;" v-if="errors.hasOwnProperty('title')">
                        {{ errors.title[0] }}
                    </span>
                </div>
                <div class="flex mt-2">
                    <button type="button" @click.prevent="add()" class="inline-flex items-center rounded border border-transparent bg-slate-600 px-2.5 py-1.5 text-xs font-medium text-white shadow-sm hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                        Add column
                    </button>
                     <span class="hover:cursor-pointer mt-1 ml-2" @click="toggleForm()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ColumnService from "../../services/Column";
export default {
    data(){
        return {
            showForm:false,
            title: "",
            errors: {}
        }
    },
    methods:{
        toggleForm(){
            this.showForm = !this.showForm
        },
        async add(){
            let data = {
                title: this.title
            };

            const column = await ColumnService.save(data)
            .then(response => {
                this.title = "";
                this.$emit('reload')
                this.toggleForm()
            }, (error) => {
                this.errors = error.response.data.errors;
            });
        }
    }
}
</script>
