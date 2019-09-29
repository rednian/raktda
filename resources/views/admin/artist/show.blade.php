@extends('layouts.admin.admin-app')
@section('content')
	 <section class="kt-portlet">
			<div class="kt-portlet__body">
				 <div class="kt-widget kt-widget--user-profile-3">
						<div class="kt-widget__top">
							 @if(!$artist_permit->thumbnail)
									<div class="kt-widget__media">
										 <img src="{{ asset('/storage/'.$artist_permit->thumbnail) }}" alt="image">
									</div>
									@else
									<div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light">
										 {{ defaultProfile($artist_permit->artist->firstname_en, $artist_permit->artist->lastname_en) }}
									</div>
							 @endif
						
					
							 <div class="kt-widget__content">
									<div class="kt-widget__head">
										 <a href="#" class="kt-widget__username">
											{{ ucwords($artist_permit->artist->fullname) }}
												{!! artistStatus($artist_permit->artist->artist_status) !!}
										 </a>
										 <div class="kt-widget__action">
												<a href="{{ URL::previous() }}" class="btn btn-sm btn-maroon btn-elevated kt-font-transform-u"><i class="la la-arrow-left"></i>back</a>
										 </div>
									</div>
									<div class="kt-widget__subhead">
										 <a href="#"><i class="flaticon2-new-email"></i>jason@siastudio.com</a>
										 <a href="#"><i class="flaticon2-calendar-3"></i>PR Manager </a>
										 <a href="#"><i class="flaticon2-placeholder"></i>Melbourne</a>
									</div>
									<div class="kt-widget__info">
										 <div class="kt-widget__desc">
												I distinguish three main text objektive could be merely to inform people.<br>
												A second could be persuade people.You want people to bay objective
										 </div>
{{--										 <div class="kt-widget__progress">--}}
{{--												<div class="kt-widget__text">--}}
{{--													 Progress--}}
{{--												</div>--}}
{{--												<div class="progress" style="height: 5px;width: 100%;">--}}
{{--													 <div class="progress-bar kt-bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0"--}}
{{--																aria-valuemax="100"></div>--}}
{{--												</div>--}}
{{--												<div class="kt-widget__stats">--}}
{{--													 78%--}}
{{--												</div>--}}
{{--										 </div>--}}
									</div>
							 </div>
						</div>
{{--						<div class="kt-widget__bottom">--}}
{{--							 <div class="kt-widget__item">--}}
{{--									<div class="kt-widget__icon">--}}
{{--										 <i class="flaticon-piggy-bank"></i>--}}
{{--									</div>--}}
{{--									<div class="kt-widget__details">--}}
{{--										 <span class="kt-widget__title">Earnings</span>--}}
{{--										 <span class="kt-widget__value"><span>$</span>249,500</span>--}}
{{--									</div>--}}
{{--							 </div>--}}
{{--							 <div class="kt-widget__item">--}}
{{--									<div class="kt-widget__icon">--}}
{{--										 <i class="flaticon-confetti"></i>--}}
{{--									</div>--}}
{{--									<div class="kt-widget__details">--}}
{{--										 <span class="kt-widget__title">Expenses</span>--}}
{{--										 <span class="kt-widget__value"><span>$</span>164,700</span>--}}
{{--									</div>--}}
{{--							 </div>--}}
{{--							 <div class="kt-widget__item">--}}
{{--									<div class="kt-widget__icon">--}}
{{--										 <i class="flaticon-pie-chart"></i>--}}
{{--									</div>--}}
{{--									<div class="kt-widget__details">--}}
{{--										 <span class="kt-widget__title">Net</span>--}}
{{--										 <span class="kt-widget__value"><span>$</span>782,300</span>--}}
{{--									</div>--}}
{{--							 </div>--}}
{{--							 <div class="kt-widget__item">--}}
{{--									<div class="kt-widget__icon">--}}
{{--										 <i class="flaticon-file-2"></i>--}}
{{--									</div>--}}
{{--									<div class="kt-widget__details">--}}
{{--										 <span class="kt-widget__title">73 Tasks</span>--}}
{{--										 <a href="#" class="kt-widget__value kt-font-brand">View</a>--}}
{{--									</div>--}}
{{--							 </div>--}}
{{--							 <div class="kt-widget__item">--}}
{{--									<div class="kt-widget__icon">--}}
{{--										 <i class="flaticon-chat-1"></i>--}}
{{--									</div>--}}
{{--									<div class="kt-widget__details">--}}
{{--										 <span class="kt-widget__title">648 Comments</span>--}}
{{--										 <a href="#" class="kt-widget__value kt-font-brand">View</a>--}}
{{--									</div>--}}
{{--							 </div>--}}
{{--							 <div class="kt-widget__item">--}}
{{--									<div class="kt-widget__icon">--}}
{{--										 <i class="flaticon-network"></i>--}}
{{--									</div>--}}
{{--									<div class="kt-widget__details">--}}
{{--										 <div class="kt-section__content kt-section__content--solid">--}}
{{--												<div class="kt-badge kt-badge__pics">--}}
{{--													 <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title=""--}}
{{--															data-original-title="John Myer">--}}
{{--															<img src="./assets/media/users/100_7.jpg" alt="image">--}}
{{--													 </a>--}}
{{--													 <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title=""--}}
{{--															data-original-title="Alison Brandy">--}}
{{--															<img src="./assets/media/users/100_3.jpg" alt="image">--}}
{{--													 </a>--}}
{{--													 <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title=""--}}
{{--															data-original-title="Selina Cranson">--}}
{{--															<img src="./assets/media/users/100_2.jpg" alt="image">--}}
{{--													 </a>--}}
{{--													 <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title=""--}}
{{--															data-original-title="Luke Walls">--}}
{{--															<img src="./assets/media/users/100_13.jpg" alt="image">--}}
{{--													 </a>--}}
{{--													 <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title=""--}}
{{--															data-original-title="Micheal York">--}}
{{--															<img src="./assets/media/users/100_4.jpg" alt="image">--}}
{{--													 </a>--}}
{{--													 <a href="#" class="kt-badge__pic kt-badge__pic--last kt-font-brand">--}}
{{--															+7--}}
{{--													 </a>--}}
{{--												</div>--}}
{{--										 </div>--}}
{{--									</div>--}}
{{--							 </div>--}}
{{--						</div>--}}
				 </div>
				 <div class="accordion accordion-solid accordion-toggle-plus kt-padding-t-20" id="accordion-permit-history">
						<div class="card">
							 <div class="card-header" id="heading-one-permit-history">
									<div class="card-title" data-toggle="collapse" data-target="#collapse-one-permit-history" aria-expanded="true" aria-controls="collapse-one-permit-history">
									 <h6 class="kt-font-dark kt-font-transform-u kt-font-bolder"> Permit history</h6>
									</div>
							 </div>
							 <div id="collapse-one-permit-history" class="collapse show" aria-labelledby="heading-one-permit-history" data-parent="#accordion-permit-history">
									<div class="card-body">
										 @if($artist_permit->permit()->count() > 0)
												<table class="table table-striped table-borderless table-hover table-head-noborder" id="artist-permit-history">
												<thead class="thead-dark">
												<tr>
													 <th>Reference No.</th>
													 <th>Company Name</th>
													 <th>Permit No.</th>
													 <th>Issued Date</th>
													 <th>Expired Date</th>
													 <th>Permit Status</th>
												</tr>
												</thead>
										 </table>
												@else
													@empty
														Artist permit is empty
												 @endempty
										 @endif
										 
									</div>
							 </div>
						</div>
				 </div>
				 <div class="accordion accordion-solid accordion-toggle-plus kt-padding-t-20" id="accordion-status-history">
						<div class="card">
							 <div class="card-header" id="heading-one-status-history">
									<div class="card-title" data-toggle="collapse" data-target="#collapse-one-status-history" aria-expanded="true" aria-controls="collapse-one-status-history">
									 <h6 class="kt-font-dark kt-font-transform-u kt-font-bolder"> Status History</h6>
									</div>
							 </div>
							 <div id="collapse-one-status-history" class="collapse show" aria-labelledby="heading-one-status-history" data-parent="#accordion-status-history">
									<div class="card-body">
										 @if($artist_permit->artist->action->count() > 0)
												<table class="table table-striped table-borderless table-hover table-head-noborder" id="status-history">
												<thead class="thead-dark">
												<tr>
													 <th>Action Taken</th>
													 <th>Unblock/Block Reasons</th>
													 <th>Unblock/Block By</th>
													 <th>Unblock/Block On</th>
												</tr>
												</thead>
										 </table>
												@else
												@empty
														Artist status is empty
												 @endempty
										 @endif
									</div>
							 </div>
						</div>
				 </div>
			</div>
	 </section>
@endsection
@section('script')
	 <script>
			$(document).ready(function(){
			   permitHistory();
			   statusHistory();
			   
			});
			function statusHistory(){
			    $('table#status-history').DataTable({
						ajax: {
						   url: '{{ route('admin.artist.status_history', $artist_permit->artist_id) }}',
							 data: function (d) {
									
               }
						},
						columnDefs:[
							 {targets: [0, 3], className: 'no-wrap'}
						],
						columns:[
							 {data: 'action'},
							 {data: 'remarks'},
							 {data: 'user'},
							 {data: 'created_at'}
						]
				 });
			}
			function  permitHistory() {
				  $('table#artist-permit-history').DataTable({
						ajax: {
						   url: '{{ route('admin.artist.permit.history', $artist_permit->artist_id) }}',
							 data: function (d) {
									
               }
						},
						columnDefs:[
							 {targets: [0, 5], className: 'no-wrap'}
						],
						columns:[
							 {data: 'reference_number'},
							 {data: 'company_name'},
							 {data: 'permit_number'},
							 {data: 'issued_date'},
							 {data: 'expired_date'},
							 {data: 'permit_status'},
						]
				 });
      }
	 </script>
@stop