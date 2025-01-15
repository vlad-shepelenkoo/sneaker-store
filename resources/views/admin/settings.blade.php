@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Settings</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('admin.index')}}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Settings</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="col-lg-12">
                <div class="page-content my-account__edit">
                    @if(Session::has('status'))
                        <p class="alert alert-success">{{Session::get('status')}}</p>
                    @endif
                    <div class="my-account__edit-form">
                        <form name="account_edit_form" action="{{route('admin.settings.update')}}" method="POST"
                            class="form-new-product form-style-1 needs-validation"
                            novalidate="">
                            @csrf
                            @method('PUT')

                            <input type="hidden" value="{{$user->id}}" />
                            <fieldset class="name">
                                <div class="body-title">Name <span class="tf-color-1">*</span>
                                </div>
                                <input class="flex-grow" type="text" placeholder="Full Name"
                                    name="name" tabindex="0" value="{{$user->name}}" aria-required="true"
                                    required="">
                            </fieldset>
                            @error('name')<span class="alert alert-danger text-center"> {{$message}} </span> @enderror
                            <fieldset class="mobile">
                                <div class="body-title">Mobile Number <span
                                        class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="text" placeholder="Mobile Number"
                                    name="mobile" tabindex="0" value="{{$user->mobile}}" aria-required="true"
                                    required="">
                            </fieldset>
                            @error('mobile')<span class="alert alert-danger text-center"> {{$message}} </span> @enderror
                            <fieldset class="email">
                                <div class="body-title">Email Address <span
                                        class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="text" placeholder="Email Address"
                                    name="email" tabindex="0" value="{{$user->email}}" aria-required="true"
                                    required="">
                            </fieldset>
                            @error('email')<span class="alert alert-danger text-center"> {{$message}} </span> @enderror
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="my-3">
                                        <h5 class="text-uppercase mb-0">Password Change</h5>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <fieldset class="name">
                                        <div class="body-title pb-3">Old password <span
                                                class="tf-color-1">*</span>
                                        </div>
                                        <input class="flex-grow" type="password"
                                            placeholder="Old password" id="old_password"
                                            name="old_password" aria-required="true"
                                            required="">
                                    </fieldset>
                                </div>
                                @error('old_password')<span class="alert alert-danger text-center"> {{$message}} </span> @enderror
                                <div class="col-md-12">
                                    <fieldset class="name">
                                        <div class="body-title pb-3">New password <span
                                                class="tf-color-1">*</span>
                                        </div>
                                        <input class="flex-grow" type="password"
                                            placeholder="New password" id="new_password"
                                            name="password" aria-required="true"
                                            required="">
                                    </fieldset>
                                </div>
                                @error('password')<span class="alert alert-danger text-center"> {{$message}} </span> @enderror
                                <div class="col-md-12">
                                    <fieldset class="name">
                                        <div class="body-title pb-3">Confirm new password <span
                                                class="tf-color-1">*</span></div>
                                        <input class="flex-grow" type="password"
                                            placeholder="Confirm new password" cfpwd=""
                                            data-cf-pwd="#new_password"
                                            id="new_password_confirmation"
                                            name="password_confirmation"
                                            aria-required="true" required="">
                                        <div class="invalid-feedback">Passwords did not match!
                                        </div>
                                    </fieldset>
                                </div>
                                @error('password_confirmation')<span class="alert alert-danger text-center"> {{$message}} </span> @enderror
                                <div class="col-md-12">
                                    <div class="my-3">
                                        <button type="submit"
                                            class="btn btn-primary tf-button w208">Save
                                            Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection