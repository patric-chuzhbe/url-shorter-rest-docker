<template>
    <div class="shortLinksGenerator">
        <form @submit.prevent="doShortTheUrl">
            <div class="shortLinksGenerator-error" v-if="error">{{ error }}</div>
            <h1 class="text-xl font-bold">Генератор коротких ссылок</h1>
            <div class="mt-4">
                <label for="urlToShort" class="block">Ссылка для сокращения:</label>
                <input ref="urlToShort"
                       id="urlToShort"
                       type="text"
                       v-model="urlToShort"
                       class="w-full mt-1 px-2 py-1 border border-gray-300 rounded"
                       @input="validateUrlToShort"
                       required
                       :placeholder="urlToShortPlaceholder">
                <div class="text-red-500 mt-1"
                     v-if="!isUrlToShortValid">
                    Ошибка в URL
                </div>
            </div>
            <preloader v-if="pending"></preloader>
            <div v-if="shortedUrl && !pending" class="mt-4">
                <label for="shortedUrl"
                       class="block">
                    Сокращенная ссылка:
                </label>
                <div class="flex mt-2">
                    <input id="shortedUrl"
                           type="text"
                           v-model="shortedUrl"
                           readonly
                           class="w-full px-2 py-1 border border-gray-300 rounded flex-grow mr-2">
                    <button type="button"
                            @click="copyToClipboard"
                            class="bg-blue-500 text-white px-3 py-1 rounded"
                            title="Сохранить">
                        <i class="fas fa-save"></i>
                    </button>
                </div>
            </div>
            <button type="submit"
                    class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                    value="Сократить">
                Сократить
            </button>
        </form>

        <div v-if="showPopup"
             class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
             @click="closePopup">
            <div class="bg-white p-6 rounded shadow-lg flex flex-col items-center"
                 @click.stop>
                <span class="text-xl mb-4">Ссылка скопирована!</span>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        @click="closePopup">OK
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

const EXAMPLE_URL = 'https://example.com';

export default {
    data: function () {
        return {
            urlToShort: '',
            shortedUrl: null,
            pending: false,
            error: null,
            isUrlToShortValid: true,
            showPopup: false,
        };
    },
    computed: {
        urlToShortPlaceholder: function () {
            return this.urlToShort || EXAMPLE_URL;
        },
    },
    methods: {
        doShortTheUrl: function () {
            let vm = this;

            if (!vm.validateUrlToShort()) {
                return;
            }

            vm.pending = true;

            vm.shortedUrl = null;

            axios.post('/api/do-short-the-url', {
                urlToShort: vm.urlToShort,
            })
                .then(response => {
                    vm.pending = false;
                    vm.shortedUrl = response.data.shortedUrl;
                    vm.error = null;
                })
                .catch(error => {
                    vm.pending = false;
                    vm.error = error;
                });
        },
        validateUrlToShort: function () {
            let vm = this;

            const urlRegex = /^(https?:\/\/)?[\w.-]+\.[a-zA-Z]{2,}(\/\S*)?$/;
            let out = urlRegex.test(vm.urlToShort);
            vm.isUrlToShortValid = out;

            return out;
        },
        clearUrlToShort: function () {
            this.urlToShort = '';
        },
        copyToClipboard: function () {
            let vm = this;
            navigator.clipboard.writeText(vm.shortedUrl);
            vm.showPopup = true;
        },
        closePopup: function () {
            this.showPopup = false;
        },
    }
};
</script>

<style>
.shortLinksGenerator {
    width: 50%;
    margin: auto;
}

.shortLinksGenerator .shortLinksGenerator-error {
    background-color: orangered;
}
</style>
