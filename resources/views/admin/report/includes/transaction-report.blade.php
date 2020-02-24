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
    .navbar-nav .active {
        border-bottom: 1px solid #b45454;

    }
    #tooltipMonth{
        position: absolute;
        margin-top: -23px;
        margin-left: -20px;
        border: none;
        box-shadow: 0px 3px 3px -1px grey;
        border-radius: 9px;
        color: #464646;

    }
    #navbarText ul li{
        white-space: nowrap;
    }
    .navbar-nav .nav-item:not(.active) {
        border-color: transparent !important;
    }

    #artist-transaction-table_wrapper .dt-buttons {
        background-color: #f7f8fa;
    }

    .dt-button-collection .button-page-length {
    }
</style>

<section id="tabs">

    <ul style="margin-top: -16px" class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-1x nav-tabs-line-danger" role="tablist">
        <li class="nav-item" id="lastSevenButton">
            <a class="nav-link active" style="font-size: 12px;margin-top: 1px"  href="#">{{__('LAST 7 DAYS')}}</a>
            <input type="text" value="-7" id="lastSeven" hidden>
        </li>
        <li class="nav-item active"  id="allTransactions">
            <a class="nav-link" style="font-size: 12px;margin-top: 1px"  href="#">{{__('ALL')}}<span class="sr-only">(current)</span></a>
            <input type="text" value="all" id="allTransactionsInput" hidden>
        </li>
        <li class="nav-item"  id="todayButtonClick">
            <a class="nav-link" style="font-size: 12px;margin-top: 1px"  href="#">{{__('TODAY')}} <span class="sr-only">(current)</span></a>
            <input type="text" value="today" id="today" hidden>
        </li>

        <li class="nav-item" id="lastThirtyButton">
            <a class="nav-link" style="font-size: 12px;margin-top: 1px"  href="#">{{__('LAST 30 DAYS')}}</a>
            <input type="text" value="-30" id="lastThirty" hidden>
        </li>

        <li class="nav-item" id="thismonthButton">
            <a class="nav-link" style="font-size: 12px;margin-top: 1px"  href="#">{{__('THIS MONTH')}}</a>
            <input type="text" value="month" id="thisMonth" hidden>
        </li>

        <li class="nav-item" id="selectmonth">
            <button id="tooltipMonth" disabled style="display: none;font-size: 12px">{{__('Select month to get transactions')}}</button>
            <a class="nav-link" href="#"   style="margin-right:12px"><input style="height: 16px;width: 112px;background-color: #f7f8f9;border: 1px solid #d6d6d6;border-radius: 1px" type="text" class="form-control form-control-1 input-sm" id="amountCollectedMonth" placeholder="Select Month"></a>
        </li>

        <li class="nav-item" style="width: 23%;">
            <a class="nav-link input-group sm-2">
                <div class="input-group-prepend">
                    <input style="height: 19px;width: 50%" type="text" class="form-control"  id="startDate" placeholder="{{__('From')}}">
                    <input style="height: 19px;width:50%" type="text" class="form-control" id="endDate" placeholder="{{__('To')}}">
                </div>

            </a>
        </li>
        <li class="nav-item" style="line-height: 43px">
            Total Amount : <span style="color: #6d6d6d;font-weight: 500" id="totalAmount"></span>

        </li>
    </ul>
    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
        <div class="tab-pane fade show active" id="artist-transaction-report" role="tabpanel"
             aria-labelledby="artist-transaction-tab">
            <table class="table  table-striped table-hover table-bordered" id="artist-transaction-table">
                <thead>
                <tr>
                    <th style="">TRANSACTION ID</th>
                    <th style="text-align: right">TYPE</th>
                    <th style="">TRANSACTION DATE</th>
                    <th style="text-align: right">AMOUNT (AED)</th>
                    <th style="text-align: right">VAT (5%)</th>
                    <th style="text-align: right">TOTAL (AED)</th>

                    <th style="">ACTION</th>
                </tr>
                </thead>
                <tfoot align="right">
                <tr><th></th>
                    <th></th><th  class="text-right">Total</th>
                    <th><span id="amountFooter"></span></th>
                    <th> <span  id="vatFooter"></span></th>
                    <th> <span  id="totalFooter"></span></th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="col">
            <input class="btn btn-secondary" style="width: 123px;height: 24px;" type="text" id="yearSelected" placeholder="Select Year">
            <input class="btn btn-secondary" style="width: 123px;height: 24px;" type="text" id="monthSelected" placeholder="Select Month">
            {{--<button id="printChart"  class="bt btn-secondary">Print Chart</button>--}}
        </div>
        <div class="chart-container">
            <div class="bar-chart-container" id="printContentChart">
                <canvas id="bar-chart"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-3" style="white-space: nowrap;font-weight: bold">Total Amount: </div><div class="col-4" id="totalAmountInMonth"> </div>
        </div>
    </div>

</section>
