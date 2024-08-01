@extends('layouts.frontend')

@section('title', 'Login')

@section('content')

  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />
  <div class="flex flex-col items-center px-6 py-10 min-h-dvh">
    <img src="{{ asset('assets/svgs/logo.svg') }}" class="mb-[53px]" alt="">
    <form action="{{ route('login') }}" method="POST" class="mx-auto max-w-[345px] w-full p-6 bg-white rounded-3xl mt-auto"
      id="deliveryForm">
      @csrf

      <div class="flex flex-col gap-5">
        <p class="text-[22px] font-bold">
          Sign In
        </p>
        <!-- Email Address -->
        <div class="flex flex-col gap-2.5">
          <label for="email" class="text-base font-semibold">Email Address</label>
          <input type="email" name="email" id="email__"
            style="background-image: url('{{ asset('assets/svgs/ic-email.svg') }}')" class="form-input"
            placeholder="Your email address" :value="old('email')">
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="flex flex-col gap-2.5">
          <label for="password" class="text-base font-semibold">Password</label>
          <input type="password" name="password" id="password__"
            style="background-image: url('{{ asset('assets/svgs/ic-lock.svg') }}')" class="form-input"
            placeholder="Protect your password">
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <button type="submit"
          class="inline-flex text-white font-bold text-base bg-primary rounded-full whitespace-nowrap px-[30px] py-3 justify-center items-center">
          Sign In
        </button>
      </div>
    </form>
    <a href="{{ route('register') }}" class="font-semibold text-base mt-[30px] underline">
      Create New Account
    </a>
  </div>
@endsection
