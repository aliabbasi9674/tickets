@extends('layouts.home')


@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">مشخصات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <div class="row row-sm">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title font-weight-bold text-primary mb-3">مشخات کاربری </h4>
                    <p class="mb-2">اطلاعات کاربری خود را در فرم زیر می توانید مشاهده کنید.</p>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                @include('include.home.avatar')
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">نام و نام خانوادگی</label>
                                <input type="text" disabled value="{{auth()->user()->Name}}" class="form-control"
                                       id="inputName" placeholder="نام و نام خانوادگی">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">شماره همراه</label>
                            <div class="custom-file">
                                <input type="tel" disabled value="{{auth()->user()->Phone}}" class="form-control"
                                       id="inputName" placeholder="شماره همراه">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
