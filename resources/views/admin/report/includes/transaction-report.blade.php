<style>
    #event-transaction-table_filter {
        width: 42%;
        float: right;
    }

    #artist-transaction-table_filter {
        width: 42%;
        float: right;
    }

    .button_date {
        width: 100%;
        height: 26px;
        border-radius: 3px;
        font-size: 11px;
        line-height: 2px;
    }

    #artist-transaction-table_wrapper .dt-buttons {
        background-color: #f7f8fa;
    }

    .dt-button-collection .button-page-length {
    }
</style>

<section id="tabs">
    <div class="container-fluid col-12">
        <div class="container-fluid" style="    height: 31px;margin-left: -9px;">
            <div class="btn-group col-3 pull-left" style="margin-left: -8px">
                <button type="button" style="" class="btn btn-sm col-6 btn-warning dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{__('FILTER')}}
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" style="box-shadow: 5px 8px 11px -4px #afafaf">
                    <ul style="list-style: none;width:76%;">
                        <li>
                            <button class="btn btn-secondary btn-sm btn-block border-0" id="todayButton">Today</button>
                            <input type="text" value="today" id="today" hidden>
                        </li>
                    {{--    <li>
                            <button class="btn btn-secondary btn-sm btn-block border-0" id="lastSevenButton">7 Days</button>
                            <input type="text" value="-7" id="lastSeven" hidden></li>
                        <li>--}}
                            <button class="btn btn-secondary btn-sm btn-block border-0" id="lastThirtyButton">30 Days</button>
                            <input type="text" value="-30" id="lastThirty" hidden>
                        </li>
                        <li>
                            <button class="btn btn-secondary btn-sm btn-block border-0" id="thismonthButton">This Month
                            </button>
                            <input type="text" value="month" id="thisMonth" hidden>
                        </li>{{--         <li>
                            <button style="width: 105px" type="button" class="btn btn-secondary btn-sm btn-block border-0" data-toggle="modal" data-target="#exampleModal">
                               Select Month
                            </button>
                        </li>--}}

                    </ul>
                </div>
            </div>

      {{--      <div class="row">
                <div class="col-3">
                <input class="form-control" style="margin-left: -69%;height: 32px" id="startDate" placeholder="From Date"/>
                </div>
                <div class="col-3">
                <input class="form-control" id="endDate" style="margin-left: -80%;height: 32px" placeholder="To Date"/>
                </div>
            </div>
--}}
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="font-size: inherit;margin-left: 33%">Select Month and Year</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span class="container">
                                <input type="text" class="form-control form-control-1 input-sm" id="amountCollectedMonth" >
                                <i style="    position: absolute; font-size: 23px; line-height: 39px; margin-left: 88%; margin-top: -8%;" class="fa fa-calendar"></i>
                            </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" style="border-radius: 3px" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
                            <button style="border-radius: 3px" id="getDataByMonth" type="button" class="btn btn-outline-warning btn-sm ">Submit</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" id="transaction_toggle_calender" style="display: none">
                <div class='col-md-3'>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker6'>
                            <input id="start_date" style="height: 29px" type='text' class="form-control"
                                   placeholder="Select Date"/>
                            <span class="input-group-addon">
                    <span style="font-size: 19px;position: relative;margin-left: -22px;line-height: 29px;"
                          class="fa fa-calendar"></span>
                </span>
                        </div>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker7'>
                            <input id="end_date" style="height: 29px" type='text' class="form-control"
                                   placeholder="Select Date"/>
                            <span class="input-group-addon">
                    <span class="fa fa-calendar"
                          style="font-size: 19px;position: relative;margin-left: -22px;line-height: 29px;"></span>
                </span>
                        </div>
                    </div>
                </div>
                <button id="transaction_date_submit"
                        style="height: 31px;line-height: 30px;background-color: white;border: none"><i
                        style="font-size: 16px;color: #b45454;text-shadow: 1px 3px 2px #bdbdbd" class="fa fa-search"
                        aria-hidden="true"></i></button>
            </div>
        </div>

        <div class="col-sm-3 col-lg-3 col-md-3 col-xs-3" style="color: #969696;
                                       background-color: #f5f5f5;
                                       float: right;

                                       white-space: nowrap;
                                       margin-top: -30px;
                                       padding: 7px;
                                       line-height: 13px;
                                       font-weight: 400;
                                       border-radius: 5px;">Total Amount : <span style="color: #6d6d6d;float: right;font-weight: 500"
                                                                                   id="totalAmount"></span></div>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade show active" id="artist-transaction-report" role="tabpanel"
                 aria-labelledby="artist-transaction-tab">

                <table class="table  table-striped table-hover table-bordered" id="artist-transaction-table">
                    <thead>
                 {{--   <tr>
                        <th colspan="6"><span id="appendAmount"></span></th>
                    </tr>--}}
                    <tr>
                        <th style="">TRANSACTION ID</th>
                        <th style="">TRANSACTION DATE</th>
                        <th style="text-align: right">AMOUNT (AED)</th>
                        <th style="text-align: right">VAT (AED)</th>
                        <th style="text-align: right">TOTAL (AED)</th>
                        <th style="">ACTION</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</section>
