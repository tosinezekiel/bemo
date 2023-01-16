<template>
        <div @click="download()" class="w-80 absolute right-3 bottom-4 bg-gray-100 rounded-md shadow hover:cursor-pointer hover:bg-gray-200 px-4 flex py-4 sm:px-6 border border-r-2 border-r-slate-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
            </svg>
        
            <span v-if="!loading">Download DB</span>
            <span v-else>Downloading...</span>
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
