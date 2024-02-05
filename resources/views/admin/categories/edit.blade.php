@extends('layouts.admin')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">ویرایش سرویس تیکت</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <div class="row row-sm">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title text-primary mb-3">ویرایش سرویس تیکت </h4>
                </div>
                <div class="card-body pt-0">
                    @include('include.admin.message')
                    <form class="form-horizontal" method="POST" action="{{route('admin.categories.update',['category'=>$category->Id])}}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">نام</label>
                                    <input type="text" name="name" value="{{$category->Name}}" class="form-control" id="inputName" placeholder="نام را وارد کنید">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="status">وضعیت</label>
                                <div class="form-control-select">
                                    <select class="form-control" id="status" name="status">
                                        <option
                                            value="1" {{$category->getRawOriginal('status')==1 ? 'selected': ''}}>
                                            فعال
                                        </option>
                                        <option
                                            value="0" {{$category->getRawOriginal('status')==0 ? 'selected': ''}}>
                                            غیر فعال
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-success">ذخیره اطلاعات</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
