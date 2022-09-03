@if (count($categories) > 0)
    <div class="overflow-x-auto rounded-lg bg-gray-200">
        <table class="w-full text-left">
            <thead class="bg-gray-300">
                <tr>
                    <th class="py-3 px-6">Name</th>
                    <th class="py-3 px-6">References</th>
                    <th class="py-3 px-6">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="border-b border-gray-300 last:border-b-0">
                        <td class="py-3 px-6">{{ $category->name }}</td>
                        <td class="py-3 px-6">{{ count($category->posts) }}</td>
                        <td class="py-3 px-6">
                            <a href="#">Edit</a>
                            <a href="#">Remove</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pt-6">
        {{ $categories->appends(request()->input())->links() }}
    </div>
@else
    <p>No categories was found</p>
@endif