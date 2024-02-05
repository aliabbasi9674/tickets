<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::latest()->get();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:categories,Name',
            'status' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Category::create([
                'Name' => $request->name,
                'Status' => $request->status,
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error('مشکل در ایجاد سرویس تیکت وجود دارد.', 'خطا')->persistent('باشه');
            return redirect()->back();
        }
        alert()->success('سرویس تیکت با موفقیت اضافه شد.', 'موفق');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,Name,'.$category->Id,
            'status' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $category->update([
                'Name' => $request->name,
                'Status' => $request->status,
            ]);
            $category->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error('مشکل در ویرایش سرویس تیکت وجود دارد.', 'خطا')->persistent('باشه');
            return redirect()->back();
        }
        alert()->success('سرویس تیکت با موفقیت ویرایش شد.', 'موفق');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        alert()->success('سرویس تیکت با موفقیت حذف شد.', 'موفق');
        return redirect()->route('admin.categories.index');
    }
}
