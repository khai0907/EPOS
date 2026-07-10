<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="relative overflow-x-auto pl-6">
        <table>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th>
                        <div class="add-product mt-5">
                            <a href="{{ route('customer.create') }}" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">
                                <span>Add Customer</span>
                            </a>
                        </div>
                    </th>
                </tr>
            </thead>
        </table>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-10">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        First Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Last Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created at
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Updated at
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            @foreach ($customer as $c)
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th class="px-6 py-2 font-bold text-gray-900 whitespace-nowrap dark:text-white hover:underline">
                       <a href="{{ route('customer.edit',$c->id) }}"> {{ $c->first_name ?? '-' }} </a>
                    </th>
                    <th scope="row" class="px-6 py-2 font-bold text-gray-900 whitespace-nowrap dark:text-white hover:underline">
                        <a href="{{ route('customer.edit',$c->id) }}">{{ $c->last_name ?? '-' }}</a>
                    </th>
                    <td class="px-6 py-2">
                        {{ $c->phone ?? '-' }}
                    </td>
                    <td class="px-6 py-2">
                        {{ $c->email ?? '-'}}
                    </td>
                    <td class="px-6 py-2">
                        {{ $c->address ?? '-'}}
                    </td>
                    <td class="px-6 py-2">
                        {{ $c->created_at ?? '-'}}
                    </td>
                    <td class="px-6 py-2">
                        {{ $c->updated_at ?? '-'}}
                    </td>
                    <td class="px-6 py-2">
                        <form action="{{ route('customer.destroy', $c->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="focus:outline-none text-white bg-red-600 hover:bg-red-900 focus:ring-4 focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
            </tbody>     
            @endforeach
        </table>
    </div>
</x-layout>