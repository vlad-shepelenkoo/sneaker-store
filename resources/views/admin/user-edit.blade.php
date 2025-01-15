@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>User infomation</h3>
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
                    <a href="{{route('admin.users')}}">
                        <div class="text-tiny">Users</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Edit User</div>
                </li>
            </ul>
        </div>
        <div class="wg-box">
            <form class="form-new-product form-style-1" method="POST" action="{{route('admin.user.update')}}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$user->id}}" />
                <fieldset class="name">
                    <div class="body-title">Name<span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Name" name="name" tabindex="0" value="{{$user->name}}" aria-required="true" required="">
                </fieldset>
                @error('name')<span class="alert alert-danger text-center"> {{$message}} </span> @enderror
                <fieldset class="email">
                    <div class="body-title">Email<span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="email" placeholder="Email" name="email" tabindex="0" value="{{$user->email}}" aria-required="true" required="">
                </fieldset>
                @error('email')<span class="alert alert-danger text-center"> {{$message}} </span> @enderror
                <fieldset class="mobile">
                    <div class="body-title">Mobile <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Mobile" name="mobile" tabindex="0" value="{{$user->mobile}}" aria-required="true" required="">
                </fieldset>
                @error('mobile')<span class="alert alert-danger text-center"> {{$message}} </span> @enderror
                <fieldset class="utype">
                    <div class="body-title">User Role</div>
                    <div class="select flex-grow">
                        <select class="" name="utype">
                            <option value="ADM" {{$user->utype == 'ADM' ? 'selected' : ''}}>Admin</option>
                            <option value="USR" {{$user->utype == 'USR' ? 'selected' : ''}}>User</option>
                        </select>
                    </div>
                </fieldset>
                @error('utype')<span class="alert alert-danger text-center"> {{$message}} </span> @enderror
                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection