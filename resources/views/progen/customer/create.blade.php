<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Progen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <div>
                    <form action="{{route('progen.store')}}" method="post">
                        @csrf
                        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                            <x-form-section submit="createCustomer">
                                <x-slot name="title">
                                    {{ __('progen.customer.new_customer') }}
                                </x-slot>
                            
                                <x-slot name="description">
                                    {{ __('progen.customer.new_customer_details') }}
                                </x-slot>
                            
                                <x-slot name="form">
                            
                                    <div class="col-span-6 sm:col-span-4">
                                        <x-label for="name" value="{{ __('progen.customer.customer_name') }}" />
                                        <x-input id="name" type="text" class="mt-1 block w-full" name="name" value="{{old('name')}}" autofocus />
                                        <x-input-error for="name" class="mt-2" />
                                    </div>
    
                                    <div class="col-span-6 sm:col-span-4 mt-2">
                                        <x-label for="customer_code" value="{{ __('progen.customer.customer_code') }}" />
                                        <x-input id="customer_code" type="number" class="mt-1 block w-full" name="customer_code" value="{{old('customer_code')}}" autofocus />
                                        <x-input-error for="customer_code" class="mt-2" />
                                    </div>    
    
                                    <div class="col-span-6 sm:col-span-4 mt-2">
                                        <x-label value="{{ __('progen.customer.select_import_method') }}" />
                                        <ul class="mt-2 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            @foreach ($arrayImportTypes as $key => $importType)
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">      
                                                    <div class="flex items-center pl-3">
                                                        <input id="horizontal-list-{{ $key }}" type="radio" value="{{ $key }}" name="upload_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label for="horizontal-list-{{ $key }}" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $importType }}</label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
    
                                </x-slot>
                            
                                <x-slot name="actions">
                                    <x-button>
                                        {{ __('common.create') }}
                                    </x-button>
                                </x-slot>
                            </x-form-section>
    
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
