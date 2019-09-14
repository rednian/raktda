@extends('layouts.admin.admin-app')
@section('content')
<section class="kt-portlet">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
      <div class="kt-portlet__head-label">
        {{-- <h3 class="kt-portlet__head-title">Artist Permit Application Details</h3> --}}
      </div>
      <div class="kt-portlet__head-toolbar">
        <a href="{{ URL::previous() }}" class="btn btn-sm btn-light btn-elevate"><i class="la la-arrow-left"></i> Back</a>
      </div>
    </div>
    <div class="kt-portlet__body">
        <div class="kt-widget kt-widget--user-profile-3">
            <div class="kt-widget__top">
                @if ($artist_permit->thumbnail)
                   <div class="kt-widget__media">
                       <img src="{{ asset('/storage/'.$artist_permit->thumbnail) }}" alt="image">
                   </div>
                @else
                <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light">
                    {{ profile($artist_permit->artist->firstname_en, $artist_permit->artist->lastname_en) }}
                </div>
                @endif
               
                <div class="kt-widget__content">
                    <div class="kt-widget__head">
                        <a href="#" class="kt-widget__username">
                            {{ ucwords($artist_permit->artist->fullName) }}
                            <i class="flaticon2-correct kt-font-success"></i>
                        </a>
                        <div class="kt-widget__action">
                            <button type="button" class="btn btn-label-success btn-sm btn-upper">ask</button>&nbsp;
                            <button type="button" class="btn btn-brand btn-sm btn-upper">hire</button>
                        </div>
                    </div>
                    <div class="kt-widget__subhead">
                        <a href="#"><i class="flaticon2-new-email"></i>{{ $artist_permit->email }}</a>
                        <a href="#"><i class="flaticon2-calendar-3"></i>{{ $artist_permit->mobile_number }} </a>
                        <a href="#"><i class="flaticon2-placeholder"></i>{{ $artist_permit->phone_number }}</a>
                    </div>
                    <div class="kt-widget__info">
                        <div class="kt-widget__desc">
                            I distinguish three main text objektive could be merely to inform people.<br>
                            A second could be persuade people.You want people to bay objective
                        </div>
                        <div class="kt-widget__progress">
                            <div class="kt-widget__text">
                                Progress
                            </div>
                            <div class="progress" style="height: 5px;width: 100%;">
                                <div class="progress-bar kt-bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="kt-widget__stats">
                                78%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-widget__bottom">
                <div class="kt-widget__item">
                    <div class="kt-widget__details">
                        <span class="kt-widget__title">Number of Active Permi</span>
                        <span class="kt-widget__value"><span>$</span>249,500</span>
                    </div>
                </div>
                <div class="kt-widget__item">
                    <div class="kt-widget__icon">
                        <i class="flaticon-confetti"></i>
                    </div>
                    <div class="kt-widget__details">
                        <span class="kt-widget__title">Expenses</span>
                        <span class="kt-widget__value"><span>$</span>164,700</span>
                    </div>
                </div>
                <div class="kt-widget__item">
                    <div class="kt-widget__icon">
                        <i class="flaticon-pie-chart"></i>
                    </div>
                    <div class="kt-widget__details">
                        <span class="kt-widget__title">Net</span>
                        <span class="kt-widget__value"><span>$</span>782,300</span>
                    </div>
                </div>
                <div class="kt-widget__item">
                    <div class="kt-widget__icon">
                        <i class="flaticon-file-2"></i>
                    </div>
                    <div class="kt-widget__details">
                        <span class="kt-widget__title">73 Tasks</span>
                        <a href="#" class="kt-widget__value kt-font-brand">View</a>
                    </div>
                </div>
                <div class="kt-widget__item">
                    <div class="kt-widget__icon">
                        <i class="flaticon-chat-1"></i>
                    </div>
                    <div class="kt-widget__details">
                        <span class="kt-widget__title">648 Comments</span>
                        <a href="#" class="kt-widget__value kt-font-brand">View</a>
                    </div>
                </div>
                <div class="kt-widget__item">
                    <div class="kt-widget__icon">
                        <i class="flaticon-network"></i>
                    </div>
                    <div class="kt-widget__details">
                        <div class="kt-section__content kt-section__content--solid">
                            <div class="kt-badge kt-badge__pics">
                                <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="John Myer">
                                    <img src="./assets/media/users/100_7.jpg" alt="image">
                                </a>
                                <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Alison Brandy">
                                    <img src="./assets/media/users/100_3.jpg" alt="image">
                                </a>
                                <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Selina Cranson">
                                    <img src="./assets/media/users/100_2.jpg" alt="image">
                                </a>
                                <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Luke Walls">
                                    <img src="./assets/media/users/100_13.jpg" alt="image">
                                </a>
                                <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Micheal York">
                                    <img src="./assets/media/users/100_4.jpg" alt="image">
                                </a>
                                <a href="#" class="kt-badge__pic kt-badge__pic--last kt-font-brand">
                                    +7
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>   
@endsection