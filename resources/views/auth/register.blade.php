@extends('layouts.frontend')

@section('title', 'Login')

@section('content')
  <div class="flex flex-col items-center px-6 py-10 min-h-dvh">
    <img src="{{ asset('assets/svgs/logo.svg') }}" class="mb-[53px]" alt="">
    <form method="POST" action="{{ route('register') }}"
      class="mx-auto max-w-[345px] w-full p-6 bg-white rounded-3xl mt-auto" id="deliveryForm">
      @csrf

      <div class="flex flex-col gap-5">
        <p class="text-[22px] font-bold">
          New Account
        </p>
        <!-- Full Name -->
        <div class="flex flex-col gap-2.5">
          <label for="name" class="text-base font-semibold">Full Name</label>
          <input type="text" name="name" id="name__" class="form-input" placeholder="Write your full name"
            style="background-image: url('{{ asset('assets/svgs/ic-profile.svg') }}')" :value="old('name')">
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Email Address -->
        <div class="flex flex-col gap-2.5">
          <label for="email" class="text-base font-semibold">Email Address</label>
          <input type="email" name="email" id="email__" class="form-input" placeholder="Your email address"
            style="background-image: url('{{ asset('assets/svgs/ic-email.svg') }}')" :value="old('email')">
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="flex flex-col gap-2.5">
          <label for="password" class="text-base font-semibold">Password</label>
          <input type="password" name="password" id="password__" class="form-input" placeholder="Protect your password"
            style="background-image: url('{{ asset('assets/svgs/ic-lock.svg') }}')">
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <!-- Confirm Password -->
        <div class="flex flex-col gap-2.5">
          <label for="password" class="text-base font-semibold">Confirm Password</label>
          <input type="password" name="password_confirmation" id="password_confirmation__" class="form-input"
            placeholder="Protect your password" style="background-image: url('{{ asset('assets/svgs/ic-lock.svg') }}')">
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <button type="submit"
          class="inline-flex text-white font-bold text-base bg-primary rounded-full whitespace-nowrap px-[30px] py-3 justify-center items-center">
          Create My Account
        </button>
      </div>
    </form>
    <a href="{{ route('login') }}" class="font-semibold text-base mt-[30px] underline">
      Sign In to My Account
    </a>
  </div>
@endsection
