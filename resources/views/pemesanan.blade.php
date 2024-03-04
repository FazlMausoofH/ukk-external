<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Pemesanan</title>
</head>
<body class="bg-slate-800">

    @include('nav')
    
    <form action="{{ route('create-pemesanan') }}" method="post" class="max-w-6xl mx-auto mt-10">
        @csrf
        <div class="grid grid-cols-5 gap-5 text-white">
            @foreach ($products as $product)
                <div>
                    <label for="text">{{ $product->name }} ({{ $product->price }}) : </label>
                    <input type="number" name="object[{{ $product->id }}]" class="w-10 text-black">
                </div>
            @endforeach
        </div>
        <div class="mt-2">
            <button type="submit" class="bg-blue-500 w-full text-white p-2 text-1xl ">Pesan Sekarang</button>
        </div>
    </form>
    
    {{-- Data pesanan --}}
    <div class="relative overflow-x-auto p-10 px-28">
        <div class="flex justify-start mb-3">
            <span class="text-2xl text-white">Menu Pembelian :</span>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantity
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach (json_decode($transactions->detail, true) as $data)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{ $no++ }}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $data['name'] }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $data['price'] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $data['quantity'] }}
                    </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>