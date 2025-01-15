@extends('layouts.admin')
@section('content')
<div class="main-content-wrap">
        <div class="flex gap20 flex-wrap-mobile" style="padding: 20px">
            <div class="w-25">

                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-user"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Name</div>
                                <h4>{{$contact->name}}</h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-at-sign"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Email</div>
                                <h4>{{$contact->email}}</h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-phone"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Message</div>
                                <h4>{{$contact->phone}}</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="w-75 wg-chart-default mb-20">

                    <div class="flex items-center justify-between">
                            <div>
                                <div class="body-text mb-2">Message</div>
                                <h4 style="word-break: break-all; padding-right:20px">{{$contact->comment}}</h4>
                            </div>
                    </div>
            </div>
        </div>  
</div>    
@endsection