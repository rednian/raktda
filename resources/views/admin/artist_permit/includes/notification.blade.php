<div class="alert alert-outline-danger fade show" role="alert">
   <div class="alert-icon"><i class="flaticon-warning"></i></div>
   <div class="alert-text">
      <ul>
         @if ($is_local) <li>{{ __('The artist is an UAE national.') }}</li> @endif
         @if ($is_europe) <li>{{ __('The artist is from Europe & visa is not required.') }}</li> @endif
         @if ($age < 18) <li>{{ __('The artist age is below 18 years old.') }}</li> @endif
         @if ($status != 'active') 
            <li>
            {{ __('The artist is currently blocked with the reason below:') }}
            <ul>
               <li>{{ ucfirst($reason) }}</li>
            </ul>
            </li> 
         @endif
         @if ($permit_count > 0)
            <li>
               {{ __("The artist currently has active permit.") }}
            </li>
         @endif
      </ul>
   </div>
   <div class="alert-close">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true"><i class="la la-close"></i></span>
      </button>
   </div>
</div>