@extends('layouts.admin')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <span class="text-muted mt-1 tx-13 mr-2 mb-0"> مشخصات کاربری</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <span type="button" class="text-info">{{verta()->format('%B %d، %Y')}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title font-weight-bold text-primary mb-3">مشخصات پروفایل شما</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
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
        </div><!-- COL END -->
    </div>
    <!-- row closed  -->
@endsection
