@extends('layouts.home')


@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">ثبت تیکت</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <div class="row row-sm">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title font-weight-bold text-primary mb-3">سیستم پشتیبانی </h4>
                    <p class="mb-2">با انتخاب موضوع و سرویس مورد نظرتان می توانید در سریع ترین زمان ممکن جواب سوال خود را دریافت کنید.</p>
                </div>
                <div class="card-body pt-0">
                    <form class="form-horizontal" method="post" action="{{route('home.tickets.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="towerId">کد ساختمان</label>
                                    <select required name="towerId" class="form-control select2-no-search">
                                        <option label="انتخاب">
                                        </option>
                                        @foreach(listInfoTower(auth()->user()->Phone) as $data)
                                            <option value="{{$data['TowerID']}}">
                                                {{$data['TowerID']."-".$data['Title']}}
                                            </option>
                                        @endforeach


                                    </select>
                                    @error('towerId')
                                    <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">موضوع تیکت</label>
                                    <input required type="text" name="subject" class="form-control" id="inputName" placeholder="موضوع تیکت را وارد کنید">
                                    @error('subject')
                                    <p class="text-danger  mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">سرویس تیکت</label>
                                    <select required name="categoryId" class="form-control select2-no-search">
                                        <option label="انتخاب">
                                        </option>
                                        @if(count($categories) >0)
                                            @foreach($categories as $category)
                                                <option value="{{$category->Id}}">
                                                    {{$category->Name}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('categoryId')
                                    <p class="text-danger  mt-1">{{$message}}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">پیام</label>
                                    <textarea required type="text" name="message" class="form-control" rows="7" id="inputName" placeholder="متن پیام خود را وارد کنید..."></textarea>
                                    @error('message')
                                    <p class="text-danger  mt-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="custom-file">
                                    <input class="custom-file-input" name="file1" type="file"> <label class="custom-file-label" for="customFile">انتخاب فایل</label>
                                </div>
                                @error('file1')
                                <p class="text-danger  mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="custom-file">
                                    <input class="custom-file-input" name="file2"  type="file"> <label class="custom-file-label" for="customFile">انتخاب فایل</label>
                                </div>
                                @error('file1')
                                <p class="text-danger  mt-1">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-primary">ارسال تیکت</button>
                                <a href="{{route('home.tickets.index')}}"><button type="button" class="btn btn-gray-700">بازگشت</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
