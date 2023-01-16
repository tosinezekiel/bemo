<template>
        <div @click="download()" class="absolute left-24 bottom-16 bg-slate-600 text-white rounded-full shadow-lg hover:cursor-pointer hover:bg-slate-500 p-5 flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
            </svg>
        </div>
</template>

<script>
import ColumnService from "../services/Column";
export default {
    data(){
        return {
            loading:false,
        }
    },
    methods:{
        async download(){
            this.loading = true
            const column = await ColumnService.download()
            .then(response => {
                this.loading = false
            }, (error) => {
                console.log(error);
                this.loading = false
            });
        }
    }
}
</script>
