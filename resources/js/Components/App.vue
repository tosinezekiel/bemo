<template>
    <Guest>
        <div>
            <router-view></router-view>
        </div>
    </Guest>
</template>
<script>
    import Guest from '../Layouts/Guest';

    export default {
        components:{
            Guest
        }
    }
</script>