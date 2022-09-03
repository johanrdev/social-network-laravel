<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    
                    <table class="w-full text-left">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-3 px-6">Name</th>
                                <th class="py-3 px-6">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-3 px-6">Test</td>
                                <td class="py-3 px-6">
                                    <a href="#">Edit</a>
                                    <a href="#">Remove</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
