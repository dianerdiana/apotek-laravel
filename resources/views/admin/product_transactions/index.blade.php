<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-row justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ Auth::user()->hasRole('owner') ? __('Apotek Orders') : __('My Transactions') }}
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white flex flex-col gap-y-3 overflow-hidden p-10 shadow-sm sm:rounded-lg">
        @forelse ($product_transactions as $productTransaction)
          <div class="item-card flex flex-row justify-between items-center">
            <div class="flex flex-row items-center gap-x-3">
              <a href="{{ route('product_transactions.show', $productTransaction) }}">
                <p class="text-base text-slate-500">
                  Total Transaksi
                </p>
                <h3 class="text-2xl font-bold text-indigo-950">
                  Rp. {{ $productTransaction->total_amount }}
                </h3>
              </a>
            </div>
            <div class="hidden md:flex flex-col">
              <p class="text-base text-slate-500">
                Tanggal
              </p>
              <h3 class="text-2xl font-bold text-indigo-950">
                {{ $productTransaction->created_at }}
              </h3>
            </div>
            @if ($productTransaction->is_paid)
              <span class="py-1 px-3 rounded-full bg-green-500">
                <p class="text-white font-bold text-sm">Success</p>
              </span>
            @else
              <span class="py-1 px-3 rounded-full bg-orange-500">
                <p class="text-white font-bold text-sm">Pending</p>
              </span>
            @endif
            <div class="hidden md:flex flex-row items-center gap-x-3">
              <a href="{{ route('product_transactions.show', $productTransaction) }}"
                class="py-3 px-5 font-bold rounded-full text-white bg-indigo-700">
                View Details
              </a>
            </div>
          </div>
          <hr class="my-3">
        @empty
          <p>
            Belum tersedia transaksi
          </p>
        @endforelse
      </div>
    </div>
  </div>
</x-app-layout>
