@extends('layouts.app')

@section('content')
    <div class="border-b border-gray-200 mt-4 pb-4 w-4/5 m-auto pt-10 flex justify-center">
        <h4 class="text-3xl font-bold ">Order List</h4>
    </div>

    <div class="pt-8 flex flex-col justify-center mx-40">
      <table class="border-separate border-t border-b border-gray-400">
          <tbody>
            <tr>
              <td class="py-1">Amount</td>
              <td class="py-1">RM {{ $total }}</td>
            </tr>
            <tr>
              <td class="py-1">Tax</td>
              <td class="py-1">RM 0.00</td>
            </tr>
            <tr>
              <td class="py-1">Delivery</td>
              <td class="py-1">RM 0.00</td>
            </tr>
            <tr>
              <td class="py-1">Total Amount</td>
              <td class="py-1">RM {{ $total }}</td>
            </tr>
          </tbody>
      </table>
    </div>

    <div class="flex flex-col items-center justify-center pt-8">
      <form 
      action="/orderplace"
      method="POST">
      @csrf
      <div class="block mb-7">
          <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-10 block pb-4">Address: </label>
          <textarea 
              name="address" 
              cols="50"
              rows="6"
              class="apperance none bg-gray-50 border border-gray-700 text-gray-700 rounded leading-tight py-3 px-4 mb-3 text-area">{{ $user->address }}</textarea>
      </div>  

      <div class="mt-4">
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