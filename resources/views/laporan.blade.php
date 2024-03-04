<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Laporan</title>
</head>
<body class="bg-slate-800">

    @include('nav')

    <div class="relative overflow-x-auto p-12">
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
                        orderid
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bayar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        kembalian
                    </th>
                    <th scope="col" class="px-6 py-3">
                        updated_at
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{ $no++ }}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $product->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $product->orderid }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->total }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->pay }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->return }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->updated_at }}
                    </td>
                    <td class="flex items-center px-6 py-4">
                        <!-- Modal toggle -->
                        <button data-modal-target="detail-pembayaran-{{ $product->id }}" data-modal-toggle="detail-pembayaran-{{ $product->id }}" class="font-medium text-yellow-600 dark:text-blue-500 hover:underline" type="button">
                            Detail
                        </button>
                        <!-- Main modal -->
                        <div id="detail-pembayaran-{{ $product->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Detail Transaksi
                                        </h3>
                                    </div>
                                    <div class="text-lg p-4">
                                        @foreach (json_decode($product->detail, true) as $data)
                                            <span>Name : {{ $data['name'] }}</span><br>
                                            <span>Price : {{ $data['price'] }}</span><br>
                                            <span>Quantity : {{ $data['quantity'] }}</span><br><br>
                                        @endforeach
                                        <div>
                                            <Button class="w-full bg-blue-500 text-white p-1">Cetak</Button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <button data-modal-target="delete-pembayaran-{{ $product->id }}" data-modal-toggle="delete-pembayaran-{{ $product->id }}" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3" type="button">
                            Delete
                        </button>
                        
                        <div id="delete-pembayaran-{{ $product->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this history transaksi?</h3>
                                        <form action="{{ route('delete-laporan', $product->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Yes, I'm sure
                                            </button>
                                            <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>