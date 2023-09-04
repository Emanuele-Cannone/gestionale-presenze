@php
    use Carbon\Carbon;
@endphp

@section('script')

    <script>

    </script>
        
@endsection

<x-app-layout>
    
    <div id="app">
        
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('attendance.attendances') }}
                </h2>
    
                <form action="{{route('attendances.store')}}" method="post">
                    @csrf
                    @if ($activeAttendance)                    
                        <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            {{__('attendance.leave')}}
                            <i class="fa-solid fa-right-from-bracket fa-bounce"></i>
                        </button>
                    @else
                        <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            {{__('attendance.entry')}}
                            <i class="fa-solid fa-right-to-bracket fa-bounce"></i>
                        </button>
                    @endif
                </form>
            </div>
        </x-slot>
    
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('attendance.date') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('attendance.entry') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('attendance.leave') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('attendance.stamped') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('common.actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>            
                                @foreach ($attendances as $attendance)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">{{ Carbon::parse($attendance->enter)->format('d-m-Y') }}</th>
                                        <td class="px-6 py-4">{{ Carbon::parse($attendance->enter)->format('H:i:s')}}</td>
                                        <td class="px-6 py-4">{{ $attendance->leave ? Carbon::parse($attendance->leave)->format('H:i:s') : ' - '}}</td>
                                        <td class="px-6 py-4">{{ Carbon::parse($attendance->leave)->diff(Carbon::parse($attendance->enter))->format('%H:%I:%S') }}</td>
                                        <td class="px-6 py-4">
                                            @if(
                                                    $attendance->leave 
                                                    && (Carbon::parse($attendance->leave)->diffInMinutes(Carbon::parse($attendance->enter)) > 480)
                                                    && (Carbon::parse($attendance->leave)->diffInHours(Carbon::now()) <= 72)
                                                )
                                                <a href="#" class="focus:outline-none text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                                                    Richiedi modifica
                                                </a>
                                                <a href="#" class="ml-1 focus:outline-none text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                                                    Richiedi straordinari
                                                </a>
                                            @elseif(
                                                $attendance->leave
                                                && (Carbon::parse($attendance->leave)->diffInHours(Carbon::now()) <= 72)
                                                )
                                                <a href="#" class="focus:outline-none text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                                                    Richiedi modifica
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div> 

    </div>

</x-app-layout>
