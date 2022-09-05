<div class="flex flex-col py-3">
    <h2 class="text-2xl font-bold">{{ $categories->total() }} {{ $categories->total() == 1 ? 'Category' : 'Categories' }}</h2>
    <ul class="my-3">
        <li><a href="{{ route('categories.create') }}">New category</a></li>
    </ul>
</div>

@if (count($categories) > 0)
    @if ($categories->hasPages())
        <div class="pb-6">
            {{ $categories->appends(request()->input())->links() }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg bg-gray-200 mb-3">
        <table class="w-full text-left">
            <thead class="bg-gray-300">
                <tr>
                    <th class="py-3 px-6 w-20">
                        <div class="flex items-center">
                            <input type="checkbox">
                        </div>
                    </th>
                    <th class="py-3 px-6">Name</th>
                    <th class="py-3 px-6 w-40">References</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="border-b border-gray-300 last:border-b-0 hover:bg-teal-100">
                        <td class="py-3 px-6">
                            <div class="flex items-center">
                                <input type="checkbox">
                            </div>
                        </td>
                        <td class="py-3 px-6">
                            <a href="{{ route('categories.edit', $category) }}">{{ $category->name }}</a>
                        </td>
                        <td class="py-3 px-6">{{ count($category->posts) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-end">
        <x-button type="red">Remove</x-button>
    </div>

    @if ($categories->hasPages())
        <div class="pt-6">
            {{ $categories->appends(request()->input())->links() }}
        </div>
    @endif
@else
    <p>No categories was found</p>
@endif