@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">Address</h2>
      <div class="row">
        <div class="col-lg-3">
            @include('user.account-nav')
        </div>
        <div class="col-lg-9">
          <div class="page-content my-account__address">
              <div class="row">
                  <div class="col-6">
                      <p class="notice">The following addresses will be used on the checkout page by default.</p>
                  </div>
                  <div class="col-6 text-right">
                      <a href="{{route('user.addresses')}}" class="btn btn-sm btn-danger">Back</a>
                  </div>
              </div>

              <div class="row">
                  <div class="col-md-8">
                      <div class="card mb-5">
                          <div class="card-header">
                              <h5>Add New Address</h5>
                          </div>
                          <div class="card-body">
                              <form action="{{route('user.address.store')}}" method="POST">
                                @csrf
                                <input type="hidden" id="user_id" name="user_id" value="{{Auth()->user()->id}}" />
                                <input type="hidden" id="country" name="country" value="USA" />
                                  <div class="row">
                                    <fieldset class="name col-md-6">
                                      <div>
                                          <div class="form-floating my-3">
                                              <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                              <label for="name">Full Name *</label>
                                          </div>
                                      </div>
                                    </fieldset>
                                    @error('name')
                                        <span class="alert alert-danger text-center">{{$message}}</span>
                                    @enderror
                                    <fieldset class="phone col-md-6">
                                      <div>
                                          <div class="form-floating my-3">
                                              <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                                              <label for="phone">Phone Number *</label>
                                          </div>
                                      </div>
                                    </fieldset>
                                    @error('phone')
                                        <span class="alert alert-danger text-center">{{$message}}</span>
                                    @enderror
                                    <fieldset class="zip col-md-4">
                                      <div>
                                          <div class="form-floating my-3">
                                              <input type="text" class="form-control" name="zip" value="{{old('zip')}}">
                                              <label for="zip">Pincode *</label>
                                          </div>
                                      </div>      
                                    </fieldset>   
                                    @error('zip')
                                        <span class="alert alert-danger text-center">{{$message}}</span>
                                    @enderror
                                    <fieldset class="state col-md-4">       
                                      <div>
                                          <div class="form-floating mt-3 mb-3">
                                              <input type="text" class="form-control" name="state" value="{{old('state')}}">
                                              <label for="state">State *</label>
                                          </div>                            
                                      </div>
                                    </fieldset>
                                    @error('state')
                                        <span class="alert alert-danger text-center">{{$message}}</span>
                                    @enderror
                                    <fieldset class="city col-md-4">
                                      <div>
                                          <div class="form-floating my-3">
                                              <input type="text" class="form-control" name="city" value="{{old('city')}}">
                                              <label for="city">Town / City *</label>
                                          </div>
                                      </div>
                                    </fieldset>
                                    @error('city')
                                        <span class="alert alert-danger text-center">{{$message}}</span>
                                    @enderror
                                    <fieldset class="address col-md-6">
                                      <div>
                                          <div class="form-floating my-3">
                                              <input type="text" class="form-control" name="address" value="{{old('address')}}">
                                              <label for="address">House no, Building Name *</label>
                                          </div>
                                      </div>
                                    </fieldset>
                                    @error('address')
                                        <span class="alert alert-danger text-center">{{$message}}</span>
                                    @enderror
                                    <fieldset class="locality col-md-6">
                                      <div>
                                          <div class="form-floating my-3">
                                              <input type="text" class="form-control" name="locality" value="{{old('locality')}}">
                                              <label for="locality">Road Name, Area, Colony *</label>
                                          </div>
                                      </div>    
                                    </fieldset>
                                    @error('locality')
                                        <span class="alert alert-danger text-center">{{$message}}</span>
                                    @enderror
                                    <fieldset class="landmark col-md-12">
                                      <div>
                                          <div class="form-floating my-3">
                                              <input type="text" class="form-control" name="landmark" value="{{old('landmark')}}">
                                              <label for="landmark">Landmark *</label>
                                          </div>
                                      </div>
                                    </fieldset>
                                    @error('landmark')
                                        <span class="alert alert-danger text-center">{{$message}}</span>
                                    @enderror  
                                    <fieldset class="isDefault col-md-6">
                                      <div>
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="1" id="iDdefault" name="isDefault">
                                              <label class="form-check-label" for="isDefault">
                                                  Make as Default address
                                              </label>
                                          </div>
                                      </div>  
                                    </fieldset>
                                    @error('isdefault')
                                        <span class="alert alert-danger text-center">{{$message}}</span>
                                    @enderror
                                      <div class="col-md-12 text-right">
                                          <button type="submit" class="btn btn-success">Submit</button>
                                      </div>                                     
                                  </div>
                              </form> 
                          </div>
                      </div>
                  </div>
              </div>
              <hr>                    
          </div>
      </div>
      </div>
    </section>
  </main>
@endsection