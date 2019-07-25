@extends('layouts.admin-app')
@section('action')
<a href="#"  class="btn btn-brand">Company Details </a>
@endsection
@section('content')
<section class="row">
  <div class="col-lg-12">
      <section class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--break-sm">
          <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Company Information</h3>
          </div>
        </div>
        <div class="kt-portlet__body">
           <div class="kt-portlet__content">
             {{ $company }}
           </div>
        </div>
      </section>
  </div>
</section>
<section class="row">
  <div class="col-lg-12">
      <section class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--break-sm">
          <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Artist Permit Information</h3>
          </div>
        </div>
        <div class="kt-portlet__body">
           <div class="kt-portlet__content">
             {{ $artist_permit }}
           </div>
        </div>
      </section>
  </div>
</section>

<section class="row">
  <div class="col-lg-12">
      <section class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
          <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Artist List</h3>
          </div>
        </div>
        <div class="kt-portlet__body">
           <div class="kt-portlet__content">
             <table class="table table-condensed table-hover table-sm table-bordered">
               <thead>
                 <tr>
                   <th>Artist Name</th>
                   <th>Profession</th>
                   <th>Submitted On</th>
                   <th>Number of Artist</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
                 @foreach($artist_permit->artist as $artist)
                    <tr>
                      <td>{{ ucwords($artist->name) }}</td>
                      <td>{{ ucwords($artist->profession) }}</td>
                      <td>{{ ucwords($artist->mobile_number) }}</td>
                      <td>{{ ucwords($artist->uid_number) }}</td>
                      <td>{{ ucwords($artist->artist_status) }}</td>
                    </tr>
                 @endforeach
               </tbody>
             </table>
           </div>
        </div>
      </section>
  </div>
</section>
@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection