<template>
    <div>
        <Header />
        <div class="flex flex-grow h-screen overflow-auto bg-gray-200">
            <div class="relative flex-grow flex flex-col">
                <main>
                    <div class="py-8 w-full ml-24">
                        <slot></slot>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
<script>
    import Header from '../Components/Header';

    export default {
        components:{
            Header
        }
    }
</script>