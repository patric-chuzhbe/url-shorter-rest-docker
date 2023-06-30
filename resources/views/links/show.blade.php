@extends('layouts.main')
@section('content')
    <form action="{{ route('links.send') }}" method="POST" class="linksShow">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Генератор коротких ссылок</h2>
                {{--/*< testCode>*/--}}
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3" role="alert">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                            <p>{{ $error }}</p>
                        </div>
                    @endforeach
                @endif
                @if(session()->has('success'))
                    <p><strong>Новая ссылка: <a href="{{ session()->get('success') }}">{{ session()->get('success') }}</a></strong></p>
                @endif
                {{--/*</testCode>*/--}}
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="company_website" class="block text-sm font-medium leading-6 text-gray-900">
                            URL сайта
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span
                                class="inline-flex items-center px-3 rounded-l-md border-r-0 border-gray-300 bg-gray-50 text-gray-500">
                                https://
                            </span>
                            <input type="text"
                                   name="url"
                                   id="company_website"
                                   class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                   placeholder="https://exaple.com">
                        </div>
                    </div>
                </div>
                <div>
                    <label for="about" class="block test-sm font-medium text-gray-700">
                        Описание ссылки
                    </label>
                    <div class="mt-1">
                        <textarea id="about" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Описание ссылки"></textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                        Вы можете описать назначение сслыки
                    </p>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <!--button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button-->
                <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Сохрнаить
                </button>
            </div>
    </form>
@stop
