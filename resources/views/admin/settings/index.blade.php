@extends('layouts.app')
@section('content')
<section class="row">
    <div class="col-xl-12">
        <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Settings</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_widget5_tab1_content" role="tab" aria-selected="true">
                                    Artist Profession
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_widget5_tab2_content" role="tab" aria-selected="false">
                                    Event Type
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_widget5_tab3_content" role="tab" aria-selected="false">
                                    All time
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
                            <a href="{{ route('profession.create') }}" style="margin-bottom: 2%" class="btn btn-brand btn-elevate btn-icon-sm pull-right btn-sm">New Artist Profession <i class="la la-plus"></i></a>
                            <div class="clearfix"></div>
                            <section class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped- table-bordered table-hover table-checkable" id="artist-profession">
                                        <thead>
                                            <tr>
                                                <th>Artist Profession Name</th>
                                                <th>Profession Fee</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>                            
                                    </table>
                                </div>
                            </section>
                        </div>
                        <div class="tab-pane" id="kt_widget5_tab2_content">
                            <div class="kt-widget5">
                                <div class="kt-widget5__item">
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__pic">
                                            <img class="kt-widget7__img" src="./assets/media//products/product10.jpg" alt="">
                                        </div>
                                        <div class="kt-widget5__section">
                                            <a href="#" class="kt-widget5__title">
                                                Branding Mockup
                                            </a>
                                            <p class="kt-widget5__desc">
                                                Metronic bootstrap themes.
                                            </p>
                                            <div class="kt-widget5__info">
                                                <span>Author:</span>
                                                <span class="kt-font-info">Fly themes</span>
                                                <span>Released:</span>
                                                <span class="kt-font-info">23.08.17</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__number">24,583</span>
                                            <span class="kt-widget5__sales">sales</span>
                                        </div>
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__number">3809</span>
                                            <span class="kt-widget5__votes">votes</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget5__item">
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__pic">
                                            <img class="kt-widget7__img" src="./assets/media//products/product11.jpg" alt="">
                                        </div>
                                        <div class="kt-widget5__section">
                                            <a href="#" class="kt-widget5__title">
                                                Awesome Mobile App
                                            </a>
                                            <p class="kt-widget5__desc">
                                                Metronic admin themes.Lorem Ipsum Amet
                                            </p>
                                            <div class="kt-widget5__info">
                                                <span>Author:</span>
                                                <span class="kt-font-info">Fly themes</span>
                                                <span>Released:</span>
                                                <span class="kt-font-info">23.08.17</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__number">210,054</span>
                                            <span class="kt-widget5__sales">sales</span>
                                        </div>
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__number">1103</span>
                                            <span class="kt-widget5__votes">votes</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget5__item">
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__pic">
                                            <img class="kt-widget7__img" src="./assets/media//products/product6.jpg" alt="">
                                        </div>
                                        <div class="kt-widget5__section">
                                            <a href="#" class="kt-widget5__title">
                                                Great Logo Designn
                                            </a>
                                            <p class="kt-widget5__desc">
                                                Metronic admin themes.
                                            </p>
                                            <div class="kt-widget5__info">
                                                <span>Author:</span>
                                                <span class="kt-font-info">Keenthemes</span>
                                                <span>Released:</span>
                                                <span class="kt-font-info">23.08.17</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__number">19,200</span>
                                            <span class="kt-widget5__sales">sales</span>
                                        </div>
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__number">1046</span>
                                            <span class="kt-widget5__votes">votes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="kt_widget5_tab3_content">
                            <div class="kt-widget5">
                                <div class="kt-widget5__item">
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__pic">
                                            <img class="kt-widget7__img" src="./assets/media//products/product11.jpg" alt="">
                                        </div>
                                        <div class="kt-widget5__section">
                                            <a href="#" class="kt-widget5__title">
                                                Awesome Mobile App
                                            </a>
                                            <p class="kt-widget5__desc">
                                                Metronic admin themes.Lorem Ipsum Amet
                                            </p>
                                            <div class="kt-widget5__info">
                                                <span>Author:</span>
                                                <span class="kt-font-info">Fly themes</span>
                                                <span>Released:</span>
                                                <span class="kt-font-info">23.08.17</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__number">210,054</span>
                                            <span class="kt-widget5__sales">sales</span>
                                        </div>
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__number">1103</span>
                                            <span class="kt-widget5__votes">votes</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget5__item">
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__pic">
                                            <img class="kt-widget7__img" src="./assets/media//products/product6.jpg" alt="">
                                        </div>
                                        <div class="kt-widget5__section">
                                            <a href="#" class="kt-widget5__title">
                                                Great Logo Designn
                                            </a>
                                            <p class="kt-widget5__desc">
                                                Metronic admin themes.
                                            </p>
                                            <div class="kt-widget5__info">
                                                <span>Author:</span>
                                                <span class="kt-font-info">Keenthemes</span>
                                                <span>Released:</span>
                                                <span class="kt-font-info">23.08.17</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__number">19,200</span>
                                            <span class="kt-widget5__sales">sales</span>
                                        </div>
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__number">1046</span>
                                            <span class="kt-widget5__votes">votes</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget5__item">
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__pic">
                                            <img class="kt-widget7__img" src="./assets/media//products/product10.jpg" alt="">
                                        </div>
                                        <div class="kt-widget5__section">
                                            <a href="#" class="kt-widget5__title">
                                                Branding Mockup
                                            </a>
                                            <p class="kt-widget5__desc">
                                                Metronic bootstrap themes.
                                            </p>
                                            <div class="kt-widget5__info">
                                                <span>Author:</span>
                                                <span class="kt-font-info">Fly themes</span>
                                                <span>Released:</span>
                                                <span class="kt-font-info">23.08.17</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__number">24,583</span>
                                            <span class="kt-widget5__sales">sales</span>
                                        </div>
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__number">3809</span>
                                            <span class="kt-widget5__votes">votes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
@endsection
@section('script')

@endsection