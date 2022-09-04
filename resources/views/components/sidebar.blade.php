<!-- Sidebar section start -->
 @foreach ($sections as $key => $value)
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 last:mb-0">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="pb-3 text-center font-black text-sm uppercase tracking-widest">{{ $value['title'] }}</h2>
            <ul>
                @foreach ($value['links'] as $sub_key => $sub_value)
                    <li class="flex border-b last:border-b-0 hover:bg-teal-100 transition-colors duration-250 flex items-center hover:pl-2 transition-all duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <a href="{{ route('dashboard') }}{{ $sub_value }}" class="grow p-1">{{ $sub_key }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endforeach
<!-- Sidebar section end -->
