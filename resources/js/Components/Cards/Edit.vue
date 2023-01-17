<template>
    <div class="p-5 w-full divide-y divide-gray-200 space-y-3 overflow-hidden rounded-md shadow">
        <p class="text-xl capitalize font-bold">
            Edit Card
        </p>
        <div>
            <div class="mt-1">
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" v-model="form.title" id="title" placeholder="Enter column title" class="block w-full px-2 py-2 rounded-sm border-gray-300 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm"/>
                    <span class="text-xs text-red-600" style="color:red;" v-if="errors.hasOwnProperty('title')">
                        {{ errors.title[0] }}
                    </span>
                </div>
            </div>
            <div class="mt-1">
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <div class="mt-1">
                        <textarea rows="4" v-model="form.description" id="description" class="block w-full pl-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm" />
                        <span class="text-xs text-red-600" style="color:red;" v-if="errors.hasOwnProperty('description')">
                            {{ errors.description[0] }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex mt-2">
                <button type="button" @click.prevent="save()" class="mr-2 inline-flex items-center rounded border border-transparent bg-slate-600 px-2.5 py-1.5 text-xs font-medium text-white shadow-sm hover:bg-slate-700">
                    Save
                </button>
                <button type="button" @click="$emit('close')" class="inline-flex items-center rounded border border-transparent bg-white px-2.5 py-1.5 text-xs font-medium text-black shadow-sm">
                    cancel
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import CardService from "../../services/Card";
export default {
    data(){
        return {
            form:{
                title: this.card.title,
                description: this.card.description,
            },
            cardId: this.card.id,
            columnId: this.card.column_id,
            errors: {}
        }
    },
    props:{
        card: Object
    },
    methods:{
        async save(){
            const column = await CardService.update(this.columnId, this.cardId, this.form)
            .then(response => {
                this.form.title = "";
                this.form.description = "";
                this.$emit('close');
            }, (error) => {
                this.errors = error.response.data.errors;
            });
        }
    }
}
</script>
