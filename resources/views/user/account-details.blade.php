@extends('layouts.app')
@section('content')
<style>
    .wg-box{
        flex-direction: column;
        gap: 24px;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
        padding: 24px 15px;
    }

    .upload-image{
        display: flex;
        gap: 10px;
    }

    .tf-color-1{
        color: #FF5200
    }

    .body-title{
        color: #111;
        font-size: 14px;
        font-weight: 700;
        line-height: 20px;
    }

    .body-text{
        color: #575864;
        font-size: 14px;
        font-weight: 700;
        line-height: 20px;
    }

    .upload-image .uploadFile{
        text-align: center;
        width: 100%;
        height: 100%;
        position: relative;
        cursor: pointer;
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex-direction: column;
        
    }

    .upload-image > .item > .uploadFile > .icon{
        font-size: 40px;
        color: #2275fc;
    }

    .upload-image .item.up-load{
        min-height: 208px;
        border: 1px dashed #2275fc;
    }
    
    .tf-color{
        color: #2275fc !important;
    }

    #myFile {
        position: absolute;
        opacity: 0;
        visibility: hidden;
    }

    .upload-image > .item{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        border-radius: 12px;
        border: 1px solid #ECF0F4;
    }
</style>
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">Account Details</h2>
      <div class="row">
        <div class="col-lg-3">
            @include('user.account-nav')
        </div>
        <div class="col-lg-9">
          <div class="page-content my-account__edit">
            <div class="my-account__edit-form">
              <form name="account_edit_form" action="{{route('user.account.details.update')}}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$user->id}}" />
                @if(Session::has('status'))
                    <p class="alert alert-success">{{Session::get('status')}}</p>
                @endif
                <div class="row">
                    <fieldset class="name">
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                            <input type="text" class="form-control" placeholder="Full Name" name="name" value="{{$user->name}}" required="">
                            <label for="name">Name</label>
                            </div>
                        </div>
                    </fieldset>
                    @error('name')
                        <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror
                    <fieldset class="mobile">
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                            <input type="text" class="form-control" placeholder="Mobile Number" name="mobile" value="{{$user->mobile}}"
                                required="">
                            <label for="mobile">Mobile Number</label>
                            </div>
                        </div>
                    </fieldset>
                    @error('mobile')
                        <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror
                    <fieldset class="email">
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                            <input type="email" class="form-control" placeholder="Email Address" name="email" value="{{$user->email}}"
                                required="">
                            <label for="account_email">Email Address</label>
                            </div>
                        </div>
                    </fieldset>
                    @error('email')
                        <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror
                    <div class="col-md-12">
                        <div class="my-3">
                        <h5 class="text-uppercase mb-0">Password Change</h5>
                        </div>
                    </div>
                    <fieldset class="old_password">
                    <div class="col-md-12">
                        <div class="form-floating my-3">
                        <input type="password" class="form-control" id="old_password" name="old_password"
                            placeholder="Old password" required="">
                        <label for="old_password">Old password</label>
                        </div>
                    </div>
                    </fieldset>
                    @error('old_password')
                        <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror
                    <fieldset class="new_password">
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="New password" required="">
                            <label for="password">New password</label>
                            </div>
                        </div>
                    </fieldset>
                    @error('password')
                        <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror
                    <fieldset class="new_password_confirmation">
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                            <input type="password" class="form-control" cfpwd="" data-cf-pwd="#new_password"
                                id="password_confirmation" name="password_confirmation"
                                placeholder="Confirm new password" required="">
                            <label for="password_confirmation">Confirm new password</label>
                            <div class="invalid-feedback">Passwords did not match!</div>
                            </div>
                        </div>
                    </fieldset>
                    @error('password_confirmation')
                        <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror
                    <div class="wg-box">
                        <fieldset>
                            <div class="body-title">Upload image <span class="tf-color-1">*</span>
                            </div>
                            <div class="upload-image flex-grow">
                                @if ($user->image)
                                    <div class="item" id="imgpreview">
                                        <img src="{{asset('uploads/users')}}/{{$user->image}}" class="effect8" alt="{{$user->name}}">
                                    </div>
                                @endif
                                <div id="upload-file" class="item up-load">
                                    <label class="uploadFile" for="myFile">
                                        <span class="icon">
                                            <i class="icon-upload-cloud"></i>
                                        </span>
                                        <span class="body-text">Drop your image here or select
                                            <span class="tf-color">click to browse</span></span>
                                        <input type="file" id="myFile" name="image" accept="image/*" />
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        @error('image')<span class="alert alert-danger text-center">{{$message}}</span>@enderror
                    </div>
                  <div class="col-md-12">
                    <div class="my-3">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
@push('scripts')
    <script>
        $(function(){
            $("#myFile").on("change", function(e){
                const photoInp = $("#myFile");
                const [file] = this.files;
                if(file){
                    $("#imgpreview img").attr("src", URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });
        })
    </script>
@endpush