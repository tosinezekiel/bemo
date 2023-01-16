<template>
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl">
        <div class="flex h-12 justify-between">
        <div class="flex">
            <div class="md:flex md:items-center md:space-x-4">
                <router-link to="/dashboard" class="text-white px-3 py-2 rounded-md text-sm font-medium">Trello</router-link>
            </div>
        </div>
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <router-link to="/" class="relative inline-flex items-center rounded-md border border-transparent bg-slate-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span>Boards</span>
                </router-link>
            </div>
            <div class="md:ml-4 md:flex md:flex-shrink-0 md:items-center">
                <div class="relative ml-3">
                    <div>
                        <button type="button" class="w-10 h-10 bg-gray-100 rounded-full flex justify-center items-center" aria-expanded="false" aria-haspopup="true">
                                <span class="text-2xl">{{ "Tosin".toUpperCase().charAt(0) }} </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
  </nav>
</template>

<script>
    export default {
        
    }
</script>