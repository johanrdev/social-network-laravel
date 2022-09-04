<div class="flex flex-col py-3">
    <h2 class="text-2xl font-bold">{{ $categories->total() }} Category</h2>
    <ul class="my-3">
        <li><a href="#">New category</a></li>
    </ul>
</div>

@if (count($categories) > 0)
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
                    <tr class="border-b border-gray-300 last:border-b-0 hover:bg-green-100">
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
        <input type="button" class="py-2 px-4 rounded bg-red-500 text-white cursor-pointer" value="Remove" />
    </div>

    @if ($categories->hasPages())
        <div class="pt-6">
            {{ $categories->appends(request()->input())->links() }}
        </div>
    @endif
@else
    <p>No categories was found</p>
@endif