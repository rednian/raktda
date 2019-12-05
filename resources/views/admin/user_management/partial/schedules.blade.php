@if(!is_null($empSched))
<section class="row kt-margin-t-10">
	@php
    $id = is_null($empSched->is_custom) ? $empSched->schedule_type_id : $empSched->emp_custom_id;
    $schedId = $type == 'custom' ? $sched->emp_custom_id : $sched->schedule_type_id;
    @endphp
    <div class="col-sm-12">
		<div style="border:1px dashed #CCC;padding:10px">
			@if($type == 'system')
			<h5 class="kt-margin-b-20">{{ Auth::user()->LanguageId == 1 ? $sched->schedule_type_name : $sched->schedule_type_name_ar }}</h5>
			@else
			<h5 class="kt-margin-b-20">{{ Auth::user()->LanguageId == 1 ? $sched->emp_custom_name : $sched->emp_custom_name_ar }}</h5>
			@endif
			@if($sched->getSchedule->isNotEmpty())
	    	<span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
				<label>
					<input data-url="{{ route('user_management.set_active_schedule', ['user_id' => $empSched->user_id, 'type' => $type, 'id' => $schedId ]) }}" class="set_active" {{ $id == $schedId ? 'checked disabled' : '' }} type="checkbox" value="1"> <b class="kt-padding-t-5 kt-padding-l-5 kt-font-dark" style="font-weight:normal;display:inline-block;">{{ __('Set as Active Schedule') }}</b>
					<span></span>
				</label>
			</span>
			
			@if($type == 'custom')
			<a href="{{ URL::signedRoute('user_management.schedule.edit', ['user' => $empSched->user_id, 'custom' => $sched->emp_custom_id]) }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('Edit Schedule') }}</a> 

			@if($id !=$sched->emp_custom_id )
			<button data-url="{{ route('user_management.schedule.delete', ['user' => $empSched->user_id, 'custom' => $sched->emp_custom_id]) }}" class="btn btn-sm btn-danger btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10 kt-margin-r-10 btn-delete-schedule">{{ __('Delete Schedule') }}</button>
			@endif
			@endif

	        <table class="table table-borderless table-striped table-hover border">
				<thead>
					<tr>
						<th>{{ __('DAY') }}</th>
						<th>{{ __('STATUS') }}</th>
						<th>{{ __('TIME START') }}</th>
						<th>{{ __('TIME END') }}</th>
					</tr>
				</thead>
				<tbody>
					
					@foreach($sched->getSchedule as $day)
					<tr>
						<td>{{ __($day->day) }}</td>
						<td>{{ $day->is_dayoff == 1 ? __('Day Off') : __('Working') }}</td>
						<td>{{ $day->is_dayoff == 1 ? '--:-- --' : date('h:i A', strtotime($day->time_start)) }}</td>
						<td>{{ $day->is_dayoff == 1 ? '--:-- --' : date('h:i A', strtotime($day->time_end)) }}</td>
					</tr>
					@endforeach
					
				</tbody>
			</table>
			@else
			No added schedule
			@endif
		</div>

		<form method="POST" id="formSetActiveScheduleType">
			@csrf
		</form>

		<form method="POST" id="formDeleteScheduleType">
			@csrf
		</form>
    </div>
</section>
@else
<section class="row kt-margin-t-10">
	@php
    $schedId = $type == 'custom' ? $sched->emp_custom_id : $sched->schedule_type_id;
    @endphp
    <div class="col-sm-12">
		<div style="border:1px dashed #CCC;padding:10px">
			@if($type == 'system')
			<h5 class="kt-margin-b-20">{{ Auth::user()->LanguageId == 1 ? $sched->schedule_type_name : $sched->schedule_type_name_ar }}</h5>
			@else
			<h5 class="kt-margin-b-20">{{ Auth::user()->LanguageId == 1 ? $sched->emp_custom_name : $sched->emp_custom_name_ar }}</h5>
			@endif
			@if($sched->getSchedule->isNotEmpty())
	    	<span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
				<label>
					<input data-url="{{ route('user_management.set_active_schedule', ['user_id' => $user->user_id, 'type' => $type, 'id' => $schedId ]) }}" class="set_active" type="checkbox" value="1"> <b class="kt-padding-t-5 kt-padding-l-5 kt-font-dark" style="font-weight:normal;display:inline-block;">{{ __('Set as Active Schedule') }}</b>
					<span></span>
				</label>
			</span>
			
			@if($type == 'custom')
			<a href="{{ URL::signedRoute('user_management.schedule.edit', ['user' => $user->user_id, 'custom' => $sched->emp_custom_id]) }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('Edit Schedule') }}</a> 

			<button data-url="{{ route('user_management.schedule.delete', ['user' => $user->user_id, 'custom' => $sched->emp_custom_id]) }}" class="btn btn-sm btn-danger btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10 kt-margin-r-10 btn-delete-schedule">{{ __('Delete Schedule') }}</button>
			
			@endif

	        <table class="table table-borderless table-striped table-hover border">
				<thead>
					<tr>
						<th>{{ __('DAY') }}</th>
						<th>{{ __('STATUS') }}</th>
						<th>{{ __('TIME START') }}</th>
						<th>{{ __('TIME END') }}</th>
					</tr>
				</thead>
				<tbody>
					
					@foreach($sched->getSchedule as $day)
					<tr>
						<td>{{ __($day->day) }}</td>
						<td>{{ $day->is_dayoff == 1 ? __('Day Off') : __('Working') }}</td>
						<td>{{ $day->is_dayoff == 1 ? '--:-- --' : date('h:i A', strtotime($day->time_start)) }}</td>
						<td>{{ $day->is_dayoff == 1 ? '--:-- --' : date('h:i A', strtotime($day->time_end)) }}</td>
					</tr>
					@endforeach
					
				</tbody>
			</table>
			@else
			No added schedule
			@endif
		</div>

		<form method="POST" id="formSetActiveScheduleType">
			@csrf
		</form>

		<form method="POST" id="formDeleteScheduleType">
			@csrf
		</form>
    </div>
</section>
@endif