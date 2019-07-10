@extends('layouts.app')

@section('content')
@component('layouts.subheader')
@slot('heading')
Permits
@endslot
@slot('subheading')
Artists
@endslot
@endcomponent


<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    New Artist Permit Requests
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <a href="/company/add_new_artist" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Artist Permit
                            </a>
                            &nbsp;
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> Export
                            </button>

                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">Choose an option</span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">Print</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">Copy</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>SL/No</th>
                        <th>Artist Name</th>
                        <th>Profession</th>
                        <th>Nationality</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Actions</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Nixie Sailor</td>
                        <td>Singer</td>
                        <td>American</td>
                        <td>+971 55826584</td>
                        <td>nsailor0@livejournal.com</td>
                        <td><button class="btn btn-success">Payment</button></td>
                        <td><a href="#">Details</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Lillon Sailor</td>
                        <td>Singer</td>
                        <td>American</td>
                        <td>+971 55826584</td>
                        <td>nsailor0@livejournal.com</td>
                        <td><button class="btn btn-default">Pending</button></td>
                        <td><a href="#">Details</a></td>
                    </tr>
                </tbody>
            </table>



            <div>
                <p class="kt-section__content">
                    <div class="kt-pagination kt-pagination--sm  kt-pagination--brand kt-pagination--circle">
                        <ul class="kt-pagination__links">
                            <li class="kt-pagination__link--first">
                                <a href="#"><i class="fa fa-angle-double-left kt-font-brand"></i></a>
                            </li>
                            <li class="kt-pagination__link--next">
                                <a href="#"><i class="fa fa-angle-left kt-font-brand"></i></a>
                            </li>
                            <li>
                                <a href="#">...</a>
                            </li>
                            <li>
                                <a href="#">29</a>
                            </li>
                            <li>
                                <a href="#">30</a>
                            </li>
                            <li>
                                <a href="#">31</a>
                            </li>
                            <li class="kt-pagination__link--active">
                                <a href="#">32</a>
                            </li>
                            <li>
                                <a href="#">33</a>
                            </li>
                            <li>
                                <a href="#">34</a>
                            </li>
                            <li>
                                <a href="#">...</a>
                            </li>
                            <li class="kt-pagination__link--prev">
                                <a href="#"><i class="fa fa-angle-right kt-font-brand"></i></a>
                            </li>
                            <li class="kt-pagination__link--last">
                                <a href="#"><i class="fa fa-angle-double-right kt-font-brand"></i></a>
                            </li>
                        </ul>
                        <div class="kt-pagination__toolbar">
                            <select class="form-control kt-font-brand" style="width: 60px;">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="pagination__desc">
                                Displaying 10 of 230 records
                            </span>
                        </div>
                    </div>
                </p>
            </div>
            <!--end: Datatable -->
        </div>
    </div>




    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Existing Artist Requests
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> Export
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">Choose an option</span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">Print</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">Copy</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>SL/No</th>
                        <th>Artist Name</th>
                        <th>Profession</th>
                        <th>Nationality</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Actions</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Nixie Sailor</td>
                        <td>Singer</td>
                        <td>American</td>
                        <td>+971 55826584</td>
                        <td>nsailor0@livejournal.com</td>
                        <td><button class="btn btn-default">Extend</button></td>
                        <td><a href="#">Details</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Lillon Sailor</td>
                        <td>Singer</td>
                        <td>American</td>
                        <td>+971 55826584</td>
                        <td>nsailor0@livejournal.com</td>
                        <td><button class="btn btn-default">Extend</button></td>
                        <td><a href="#">Details</a></td>
                    </tr>


                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
    </div>


</div>
@endsection
