<template>
    <div class="w-full overflow-hidden rounded-md shadow">
        <span class="bg-gray-100 hover:cursor-pointer hover:bg-gray-200 px-2 flex py-4 sm:px-3"> 
            {{ card.title }}
        </span>
    </div>
</template>

<script>
    export default {
      props: {
        card: Array,
      },
    }
</script>