<div class="col-span-3 flex flex-col">
    <!-- Sidebar section start -->
    @foreach ($sections as $key => $value)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 last:mb-0">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="pb-3 text-center font-bold">{{ $value['title'] }}</h2>
                <ul>
                    @foreach ($value['links'] as $sub_key => $sub_value)
                        <li class="flex border-b last:border-b-0 hover:bg-green-100 transition-colors duration-250">
                            <a href="{{ route('dashboard') }}{{ $sub_value }}" class="grow p-2">{{ $sub_key }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
    <!-- Sidebar section end -->
</div>