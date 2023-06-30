<template>
    <div class="preloader" v-html="ellipsis"></div>
</template>

<script>
import {onMounted, ref} from 'vue';

export default {
    setup: function () {
        const ellipsis = ref('');

        onMounted(() => {
            let animationDelay = 125; // milliseconds

            let ellipsisTpls = [
                '&nbsp;',
                '.',
                '..',
                '...',
                '....',
                '.....',
                '....',
                '...',
                '..',
                '.',
            ];

            let counter = 0;

            setInterval(
                () => {
                    ellipsis.value = ellipsisTpls[counter++ % ellipsisTpls.length]
                },
                animationDelay
            );
        });

        return {
            ellipsis,
        };
    },
    data: function () {
        return {
            ellipsis: '',
        };
    },
    methods: {}
};
</script>

<style>
.preloader {
    font-size: x-large;
}
</style>
