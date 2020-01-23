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
    <div class="container-fluid col-12">
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
 {{-- <a class="navbar-brand" href="#">Navbar w/ text</a>--}}
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto" style="font-weight: 500">
        <li class="nav-item active"  id="allTransactions">
            <a class="nav-link" href="#">{{__('All')}}<span class="sr-only">(current)</span></a>
            <input type="text" value="all" id="allTransactionsInput" hidden>
        </li>
        <li class="nav-item"  id="todayButtonClick">
            <a class="nav-link" href="#">{{__('Today')}} <span class="sr-only">(current)</span></a>
            <input type="text" value="today" id="today" hidden>
        </li>
      <li class="nav-item" id="lastSevenButton">
        <a class="nav-link" href="#">{{_('Last 7 Days')}}</a>
          <input type="text" value="-7" id="lastSeven" hidden>
      </li>
      <li class="nav-item" id="lastThirtyButton">
        <a class="nav-link" href="#">{{__('Last 30 Days')}}</a>
          <input type="text" value="-30" id="lastThirty" hidden>
      </li>

             <li class="nav-item" id="thismonthButton">
        <a class="nav-link" href="#">{{__('This Month')}}</a>
        <input type="text" value="month" id="thisMonth" hidden>
      </li>
        <li class="nav-item">
            <button id="tooltipMonth" disabled style="display: none;font-size: 12px">{{__('Selected month to get amount')}}</button>
        <a class="nav-link" href="#"   style="margin-right:12px"><input style="height: 16px;width: 112px;background-color: #f7f8f9;border: 1px solid #d6d6d6" type="text" class="form-control form-control-1 input-sm" id="amountCollectedMonth" placeholder="Select Month"></a>
      </li>

<li>
    <div class="row col-10"  style="width:278px">
            <div class="col-5" style="margin-left:-11px" >
                <input style="margin-top: 5px;height: 19px;width: 97px;margin-right: 77px" class="form-control" id="startDate" placeholder="{{__('From')}}"/>
                </div>
        <div class="col-5" style="margin-left:16px">
                <input style="margin-top: 5px;height: 19px;width: 97px;" class="form-control" id="endDate" placeholder="{{__('To')}}"/>
            </div>
    </div>
    </li>
    </ul>
    <span class="navbar-text" style="white-space: nowrap">
      Total Amount : <span style="color: #6d6d6d;font-weight: 500" id="totalAmount"></span></span>
  </div>
</nav>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade show active" id="artist-transaction-report" role="tabpanel"
                 aria-labelledby="artist-transaction-tab">

                <table class="table  table-striped table-hover table-bordered" id="artist-transaction-table">
                    <thead>
                    <tr>

                        <th style="">TRANSACTION ID</th>
                        <th style="">TRANSACTION DATE</th>
                        <th style="text-align: right">AMOUNT (AED)</th>
                        <th style="text-align: right">VAT (AED)</th>
                        <th style="text-align: right">TOTAL (AED)</th>
                        <th style="">ACTION</th>
                    </tr>
                    </thead>

                    <tfoot align="right">
                    <tr><th>Total</th>
                        <th></th>
                        <th><span id="amountFooter"></span></th>
                        <th> <span  id="vatFooter"></span></th>
                        <th> <span  id="totalFooter"></span></th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>

    {{--        <div class="col">
                 <input class="btn btn-secondary" style="width: 123px;height: 24px;" type="text" id="yearSelected" placeholder="Select Year">
                <button id="printChart"  class="bt btn-secondary">Print Chart</button>
            </div>--}}

            <div class="chart-container">
                <div class="bar-chart-container" id="printContentChart">
                    <canvas id="bar-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
