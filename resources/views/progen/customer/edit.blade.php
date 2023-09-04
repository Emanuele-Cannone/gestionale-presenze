@section('script')
    <script>
        
        $(document).ready(function() {
            // Select2 Multiple
            let selectUsers = $('#selectUsers').select2({
                placeholder: "Seleziona utenti",
                allowClear: true,
            });

        });

    </script>
@endsection

<x-app-layout>
    <x-slot name="header">
            
        <!-- Breadcrumb -->
        <nav class="justify-between text-gray-700 sm:flex sm:px-5 bg-gray-50 dark:bg-gray-800" aria-label="Breadcrumb">
            <ol class="inline-flex items-center mb-3 space-x-1 md:space-x-3 sm:mb-0">
                <!-- Home -->
                <li>
                    <div class="flex items-center">
                        <a href="{{route('dashboard')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                        </a>
                    </div>
                </li>

                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('progen.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Progen</a>
                    </div>
                </li>

                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="mx-1 text-sm font-medium text-gray-500 md:mx-2 dark:text-gray-400">{{ $customer->name}}</span>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 hidden sm:flex">Cliente</span>
                    </div>
                </li>
            </ol>
            <div>
                <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-300 dark:focus:ring-gray-700">
                    <svg class="w-3 h-3 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm9-10v.4A3.6 3.6 0 0 1 8.4 9H6.61A3.6 3.6 0 0 0 3 12.605M14.458 3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                    </svg>
                    {{ __('common.actions') }}
                    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                        <li>
                            <a href="{{ route('progen.edit', $customer->id)}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('progen.customer.edit_customer.manage_people')}}</a>
                        </li>
                    </ul>
                </div>  
            </div>
        </nav>
  
  

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{route('progen.updateCustomerUsers', $customer->id)}}" method="post">
                @method('PUT')
                @csrf
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <x-form-section submit="createCustomer">
                        <x-slot name="title">
                            {{ __('progen.customer.edit_customer.manage_people') }}
                        </x-slot>
                    
                        <x-slot name="description">
                            {{ __('progen.customer.edit_customer.manage_people_description') }}
                        </x-slot>
                    
                        <x-slot name="form">           

                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="selectUserType" value="{{ __('progen.customer.users.user_type') }}" />
                                <select class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                    name="users_type" id="selectUserType" required>
                                    <option value="" selected disabled></option>
                                    @foreach ($user_types as $key => $user_type)
                                        <option value="{{ $key }}">{{ $user_type }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="selectUsers" value="{{ __('progen.customer.users.select_users') }}" />
                                <select class="mt-1 block w-full" name="users[]" multiple="multiple" id="selectUsers" required>
                                    @foreach ($users as $user)
                                        @if(!in_array($user->id, $customer->users->pluck('id')->toArray()))
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endif
                                    @endforeach           
                                </select>
                            </div>
                            
                        </x-slot>
                    
                        <x-slot name="actions">
                            <x-button>
                                {{ __('common.confirm') }}
                            </x-button>
                        </x-slot>
                    </x-form-section>
                </div>
            </form>

            <div class="mt-5 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('common.name') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('common.email') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('progen.customer.users.user_type') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('progen.customer.users.user_leader') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('common.actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>            
                            @foreach ($customer->users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ $user_types[$user->pivot->user_type] }}</td>
                                    <td class="px-6 py-4">{{ $user->pivot->leader ? 'Y' : 'N' }}</td>
                                    <td class="px-6 py-4">
                                        <a href="#" class="focus:outline-none text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                                            {{__('common.edit')}}
                                        </a>
                                        <a href="#" class="ml-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                            {{__('common.delete')}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
