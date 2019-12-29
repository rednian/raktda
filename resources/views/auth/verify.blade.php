@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon-multimedia"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                       {{ __('Verify Your Email Address') }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-padding-t-0 kt-padding-b-0">
              <div class="card-body">
                  @if (session('resent'))
                      <div class="alert alert-success" role="alert">
                          {{ __('A fresh verifiscation link has been sent to your email address.') }}
                      </div>
                  @endif
                  <p class="kt-font-dark">
                       {{ __('Before proceeding, please check your email for a verification link.') }}
                  {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                  </p>
              </div>  
            </div>
            
        </div>
        
    </div>
</div>
@endsection
