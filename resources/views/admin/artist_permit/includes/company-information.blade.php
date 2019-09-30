<section class="row kt-margin-b-10">
	 <div class="col-6">
			<section class="kt-section kt-padding-10 border">
				 <div class="kt-section__desc">
						<h6 class="kt-font-dark kt-font-bold kt-margin-b-15">Permit Information</h6>
						<table class="table table-borderless table-sm">
							 <tr>
									<td>Reference No. :</td>
									<td class="text-danger kt-font-bolder">{{ $permit->reference_number }}</td>
							 </tr>
							 <tr>
									<td>Request Type:</td>
									<td>{{ ucfirst($permit->request_type) }} Application</td>
							 </tr>
							 <tr>
									<td>Permit Status :</td>
									<td>
							<?php
							$status = $permit->permit_status;
							$class_name = 'warning';
							if (strtolower($permit->permit_status) == 'new') {
								$class_name = 'success';
							}
							if (strtolower($permit->permit_status) == 'processing' || strtolower($permit->permit_status) == 'modification request') {

								$class_name = 'warning';
							}
							if (strtolower($permit->permit_status) == 'pending from client') {
								$class_name = 'info';
							}
							if (strtolower($permit->permit_status) == 'new-update from client') {
								$class_name = 'info';
							}
							if (strtolower($permit->permit_status) == 'unprocessed') {
								$class_name = 'danger';
							}
							if (strtolower($permit->permit_status) == 'modification request') {
								$status = 'need modification';
							}
							?>
										 <span
												 class="kt-badge kt-badge--inline kt-badge--{{$class_name}}">{{ ucwords($status) }}</span>
									</td>
							 </tr>
							 @if ($permit->number)
									<tr>
										 <td>Permit Number :</td>
										 <td>{{ $permit->permit_number ? $permit->permit_number : null   }}</td>
									</tr>
							 @endif
							 <tr>
									<td width="35%">Submitted Date:</td>
									<td>
                            <span class="kt-font-transform-u">
                              {{ $permit->created_at ? $permit->created_at->format('d-M-Y') : null   }}
                            </span>
									</td>
							 </tr>
							 <tr>
									<td>Permit Start :</td>
									<td>
                            <span class="kt-font-transform-u">
                              {{ $permit->issued_date ? $permit->issued_date->format('d-M-Y') : null }}
                            </span>
									</td>
							 </tr>
							 <tr>
									<td>Work Location :</td>
									<td>{{ ucwords($permit->work_location) }}</td>
							 </tr>
							 <tr>
									<td>Number of Artist :</td>
									<td>{{ $permit->artistpermit()->count() }}</td>
							 </tr>
							 @if ($permit->artist->where('artist_status', 'block')->count() > 0)
									<tr>
										 <td>Block Artist :</td>
										 <td>{{ $permit->artist->where('artist_status', 'block')->count() }}</td>
									</tr>
							 @endif
							 
							 {{-- <tr>
									 <td>Permit Revision :</td>
									 <td>{{ $permit->artist->where('artist_status', 'block')->count() }}</td>
							 </tr> --}}
						</table>
				 </div>
			</section>
	 </div>
	 <div class="col-6">
			<section class="kt-section border kt-padding-10 kt-margin-b-20">
				 <div class="kt-section__desc">
						<h6 class="kt-font-dark kt-font-bold kt-margin-b-10">Establishment Information</h6>
						<table class="table table-borderless table-sm">
							 <tr>
									<td width="36%">Establishment Name :</td>
									<td class="text-danger kt-font-bolder">{{ ucwords($permit->company->company_name) }}</td>
							 </tr>
							 <tr>
									<td>Trade License Number :</td>
									<td>{{ $permit->company->company_trade_license }}</td>
							 </tr>
							 <tr>
									<td>Establishment Status :</td>
									
									<td>
										 @if($permit->company->company_status == 'active')
												<span class="kt-badge kt-badge--success kt-badge--inline">{{ ucfirst($permit->company->company_status) }}</span>
										 @endif
										 @if($permit->company->company_status == 'block')
												<span class="kt-badge kt-badge--danger kt-badge--inline">{{ ucfirst($permit->company->company_status) }}</span>
										 @endif
									</td>
							 </tr>
						</table>
						<h6 class="kt-font-dark kt-font-bold kt-margin-b-10 kt-margin-t-20">Contact information</h6>
						<table class="table table-borderless table-sm">
							 <tr>
									<td width="36%"> Contact Person :</td>
									<td class=" kt-font-bolder ">{{ ucwords($permit->company->contact_person) }}</td>
							 </tr>
							 <tr>
									<td> Mobile Number :</td>
									<td>{{ $permit->company->company_mobile_number }}</td>
							 </tr>
							 <tr>
									<td> Phone Number :</td>
									<td>{{ $permit->company->company_phone_number }}</td>
							 </tr>
							 <tr>
									<td>Company Email :</td>
									<td>{{ $permit->company->company_email }}</td>
							 </tr>
						</table>
				 </div>
			</section>
	 </div>
</section>