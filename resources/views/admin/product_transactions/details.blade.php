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
                Rp. {{ $productTransaction->total_amount }}
              </h3>
            </div>
          </div>
          <div>
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
        </div>
        <hr class="my-3">

        <h3 class="text-2xl font-bold text-indigo-950">
          List of Items
        </h3>

        <div class="grid grid-cols-4 gap-x-10 mb-3">
          <div class="flex flex-col gap-y-5 col-span-2">
            @forelse ($productTransaction->transactionDetails as $transactionDetail)
              <div class="item-card flex flex-row justify-between items-center">
                <div class="flex flex-row items-center gap-x-3">
                  <img src="{{ Storage::url($transactionDetail->product->photo) }}" alt=""
                    class="w-[50px] h-[80px]">
                  <div>
                    <h3 class="text-2xl font-bold text-indigo-950">
                      {{ $transactionDetail->product->name }}
                    </h3>
                    <p class="text-base text-slate-500">
                      Rp. {{ $transactionDetail->price }}
                    </p>
                  </div>
                </div>
                <p class="text-base text-slate-500">{{ $transactionDetail->product->category->name }}
                </p>
              </div>
            @empty
            @endforelse
          </div>
          <div class="flex flex-col items-end gap-y-5 col-span-2">
            <h3 class="text-2xl font-bold text-indigo-950">
              Proof of Payment:
            </h3>
            <img src="{{ Storage::url($productTransaction->proof) }}"
              alt="{{ Storage::url($productTransaction->proof) }}" class="w-[300px] h-[400px]">
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
                {{ $productTransaction->address }}
              </h3>
            </td>
          </tr>

          <tr>
            <td class="py-3">
              <p class="text-base text-slate-500">City</p>
            </td>
            <td class="py-3">
              <h3 class="text-xl font-bold text-indigo-950">
                {{ $productTransaction->city }}
              </h3>
            </td>
          </tr>

          <tr>
            <td class="py-3">
              <p class="text-base text-slate-500">Post Code</p>
            </td>
            <td class="py-3">
              <h3 class="text-xl font-bold text-indigo-950">
                {{ $productTransaction->post_code }}
              </h3>
            </td>
          </tr>

          <tr>
            <td class="py-3">
              <p class="text-base text-slate-500">Phone Number</p>
            </td>
            <td class="py-3">
              <h3 class="text-xl font-bold text-indigo-950">
                {{ $productTransaction->phone_number }}
              </h3>
            </td>
          </tr>

          <tr>
            <td class="py-3">
              <p class="text-base text-slate-500">Notes</p>
            </td>
            <td class="py-3">
              <h3 class="text-xl font-bold text-indigo-950">
                {{ $productTransaction->notes }}
              </h3>
            </td>
          </tr>
        </table>

        <hr class="my-3">
        @role('owner')
          @if ($productTransaction->is_paid)
            <a href="" class="py-3 px-5 font-bold rounded-full text-white bg-indigo-700 w-fit">
              Whatsapp Customer
            </a>
          @else
            <form method="POST" action="{{ route('product_transactions.update', $productTransaction) }}">
              @csrf
              @method('PUT')
              <button class="py-3 px-5 font-bold rounded-full text-white bg-indigo-700">
                Approve Order
              </button>
            </form>
          @endif
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
