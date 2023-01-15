<template>
    <div class="py-12 mr-4 w-96">
        <div class="divide-y divide-gray-200 overflow-hidden rounded-md bg-white shadow">
            <div class="px-4 py-2 sm:px-6 flex justify-between">
            <span>{{ column.title }}</span>
            <span class="hover:cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
            </div>
            <div class="px-2 py-5">
                <div v-if="column.cards.length">
                    <show-card v-for="(card, index) in column.cards" 
                    :key="index" 
                    :card="card"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ShowCard from "../Cards/Show";

    export default {
      components:{
          ShowCard,
      },
      props: {
        column: Object,
      },
    }
</script>