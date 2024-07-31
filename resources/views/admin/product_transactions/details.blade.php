<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-row justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Details') }}
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white flex flex-col gap-y-3 overflow-hidden p-10 shadow-sm sm:rounded-lg">
        <div class="item-card flex flex-row justify-between items-center">
          <div class="flex flex-row items-center gap-x-3">
            <div>
              <p class="text-base text-slate-500">
                Total Transaksi
              </p>
              <h3 class="text-2xl font-bold text-indigo-950">
                Rp. 20.000
              </h3>
            </div>
          </div>
          <div>
            <p class="text-base text-slate-500">
              Tanggal
            </p>
            <h3 class="text-2xl font-bold text-indigo-950">
              25 Feb 2024
            </h3>
          </div>
          <span class="py-1 px-3 rounded-full bg-orange-500">
            <p class="text-white font-bold text-sm">Pending</p>
          </span>
        </div>
        <hr class="my-3">

        <h3 class="text-2xl font-bold text-indigo-950">
          List of Items
        </h3>

        <div class="grid grid-cols-4 gap-x-10 mb-3">
          <div class="flex flex-col gap-y-5 col-span-2">
            <div class="item-card flex flex-row justify-between items-center">
              <div class="flex flex-row items-center gap-x-3">
                <img src="#" alt="" class="w-[50px] h-[80px]">
                <div>
                  <h3 class="text-2xl font-bold text-indigo-950">
                    Produk
                  </h3>
                  <p class="text-base text-slate-500">
                    Rp. Harga
                  </p>
                </div>
              </div>
              <p class="text-base text-slate-500">
                Vitamins
              </p>
            </div>
          </div>
          <div class="flex flex-col items-end gap-y-5 col-span-2">
            <h3 class="text-2xl font-bold text-indigo-950">
              Proof of Payment:
            </h3>
            <img src="#" alt="" class="w-[300px] h-[400px] bg-red-400">
          </div>
        </div>

        <h3 class="text-2xl font-bold text-indigo-950">
          Details of Delivery
        </h3>
        <table class="table-auto gap-y-5">
          <tr>
            <td class="py-3">
              <p class="text-base text-slate-500">Address</p>
            </td>
            <td class="py-3">
              <h3 class="text-xl font-bold text-indigo-950">
                Jl. apapapa
              </h3>
            </td>
          </tr>

          <tr>
            <td class="py-3">
              <p class="text-base text-slate-500">City</p>
            </td>
            <td class="py-3">
              <h3 class="text-xl font-bold text-indigo-950">
                Majalengka
              </h3>
            </td>
          </tr>

          <tr>
            <td class="py-3">
              <p class="text-base text-slate-500">Post Code</p>
            </td>
            <td class="py-3">
              <h3 class="text-xl font-bold text-indigo-950">
                12345
              </h3>
            </td>
          </tr>

          <tr>
            <td class="py-3">
              <p class="text-base text-slate-500">Phone Number</p>
            </td>
            <td class="py-3">
              <h3 class="text-xl font-bold text-indigo-950">
                0811111
              </h3>
            </td>
          </tr>

          <tr>
            <td class="py-3">
              <p class="text-base text-slate-500">Notes</p>
            </td>
            <td class="py-3">
              <h3 class="text-xl font-bold text-indigo-950">
                Dekat balai desa
              </h3>
            </td>
          </tr>
        </table>

        <hr class="my-3">
        @role('owner')
          <form method="POST" action="{{ route('product_transactions.update', 1) }}">
            @csrf
            @method('PUT')
            <button class="py-3 px-5 font-bold rounded-full text-white bg-indigo-700">
              Approve Order
            </button>
          </form>
        @endrole

        @role('buyer')
          <a href="" class="py-3 px-5 font-bold rounded-full text-white bg-indigo-700 w-fit">
            Contact Admin
          </a>
        @endrole
      </div>
    </div>
  </div>
  </div>
</x-app-layout>
