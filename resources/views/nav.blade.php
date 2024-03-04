<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
    <div class="flex justify-center">
        <h1 class="text-white text-4xl my-2">AQUA RESORT</h1>
    </div>
    @if (Auth::user()->role == "admin")
    <ul class="flex flex-wrap -mb-px ml-2">
        <li class="me-2">
            <a href="menu" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Menu</a>
        </li>
        <li class="me-2">
            <a href="pemesanan" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Pemesanan</a>
        </li>
        <li class="me-2">
            <a href="pembayaran" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Pembayaran</a>
        </li>
        <li class="me-2">
            <a href="laporan" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Laporan</a>
        </li>
        <li class="me-2">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Logout</button>
            </form>
        </li>
    </ul>
    @endif
    @if (Auth::user()->role == "kasir")
    <ul class="flex flex-wrap -mb-px ml-2">
        <li class="me-2">
            <a href="pembayaran" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Pembayaran</a>
        </li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Logout</button>
            </form>
        </li>
    </ul>
    @endif
    @if (Auth::user()->role == "owner")
    <ul class="flex flex-wrap -mb-px ml-2">
        <li class="me-2">
            <a href="laporan" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Laporan</a>
        </li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Logout</button>
            </form>
        </li>
    </ul>
    @endif
    @if (Auth::user()->role == "pelanggan")
    <ul class="flex flex-wrap -mb-px ml-2">
        <li class="me-2">
            <a href="pemesanan" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Pemesanan</a>
        </li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Logout</button>
            </form>
        </li>
    </ul>
    @endif
</div>
