@extends('layouts.app')

@section('content')
    @if (session()->has('message'))
    <div id="message_visibility" class="m-10 text-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Hey!</strong>
        <span class="block sm:inline">{{ session()->get('message') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <a href="#" class="fa fa-times" id="close"></a>
    </div> 
    @endif
    
    <div class="border-b border-gray-200 mt-4 pb-4 w-4/5 m-auto pt-10 flex justify-center">
        <h4 class="text-3xl font-bold ">Order List</h4>
    </div>

    <div class="pt-8 flex flex-col justify-center mx-72">
      <table class="min-w-full divide-y divide-gray-400">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
              Items
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
              Quantity
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
              Total price
            </th>
          </tr>
        </thead>
        <tbody class="bg-gray-100 divide-y divide-gray-200">
          <?php $i=0 ?>
          @foreach ($products as $product)
            <?php $i++ ?>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="ml-4">
                  <div class="text-sm font-sm text-gray-900">
                    {{ $i }}. {{ $product->name }} ({{ $product->size }})
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="ml-4">
                  <div class="text-sm text-gray-900">
                    {{ $product->quantity }}
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">
                  RM {{ number_format($product->total_price, 2, '.', '') }}
                </div>
              </td>
            </tr>
          @endforeach
          <!-- More products... -->
        </tbody>
      </table>
      <table class="border-separate border-t border-b border-gray-400">
          <tbody class="bg-gray-100">
            <tr>
              <td class="py-1 uppercase text-sm">Total Amount:</td>
              <td class="py-1">RM {{ number_format($total, 2, '.', '') }}</td>
            </tr>
            <tr>
              <td class="py-1 uppercase text-sm">Tax:</td>
              <td class="py-1">RM 0.00</td>
            </tr>
            <tr>
              <td class="py-1 uppercase text-sm">Delivery:</td>
              <td class="py-1">RM 4.00</td>
            </tr>
            <tr>
              <?php $total += 4 ?>
              <td class="py-1 uppercase text-sm">Total Payment:</td>
              <td class="py-1">RM {{ number_format($total, 2, '.', '') }}</td>
            </tr>
          </tbody>
      </table>
    </div>

    <div class="flex flex-col items-center justify-center pt-8">
      <form 
        action="/orderplace"
        method="POST">
        @csrf

        <input type="hidden" name="delivery_fee" value="4">
        <input type="hidden" name="total_payment" value="{{ $total }}">
        <div class="block mb-7">
            <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-10 block pb-4">Address: </label>
            <textarea 
                name="address" 
                cols="50"
                rows="6"
                class="apperance none bg-gray-50 border border-gray-700 text-gray-700 rounded leading-tight py-3 px-4 mb-3 text-area">{{ $user->address }}</textarea>
        </div>  

        <div class="mt-4 mb-10">
          <span class="uppercase tracking-wide text-gray-700 text-l font-bold pr-10 block pb-4">Payment Method: </span>
          <div class="mt-2">
            <label class="inline-flex items-center">
              <input type="radio" class="form-radio" name="payment" value="online banking">
              <span class="ml-2">Online Banking</span>
            </label>
            <label class="inline-flex items-center ml-6">
              <input type="radio" class="form-radio" name="payment" value="banking app">
              <span class="ml-2">Banking App</span>
            </label>
            <label class="inline-flex items-center ml-6">
              <input type="radio" class="form-radio" name="payment" value="debit/credit card">
              <span class="ml-2">Debit/Credit Card</span>
            </label>
          </div>
        </div>

        <div class="block mb-2">
          <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-8">Card Number: </label>
          <input 
              id="card_number"
              type="text" 
              name="card_number" 
              class="appearance-none w-1/2 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
        </div>

        <div class="block mb-2">
          <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-7">Expiry Month: </label>
          <input 
              placeholder="MM"
              id="exp_month"
              type="text" 
              name="exp_month" 
              class="appearance-none w-1/2 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
        </div>


        <div class="block mb-2">
          <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-12">Expiry Year: </label>
          <input 
              placeholder="YYYY"
              id="exp_year"
              type="text" 
              name="exp_year" 
              class="appearance-none w-1/2 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
        </div>

        <div class="block mb-2">
          <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-28">CVC: </label>
          <input 
              id="cvc"
              type="password" 
              name="cvc" 
              class="appearance-none w-1/2 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3 ml-2">
        </div>

        <div class="flex justify-center">
          <button 
              type="submit"
              class="uppercase mt-10 shadow-lg bg-yellow-500 hover:bg-yellow-400 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-2xl">
              Order Now
          </button>
        </div>
      </form>
    </div>

@endsection