<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'desc')->latest()->paginate(9);
        return view('Admin.modun.coupons.index', ['title' => 'Mã Giảm Giá'], compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.modun.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'code'      => 'required|max:255|unique:coupons,code',
            'expires_at'   => 'required',
            'type'   => 'not_in:0',
            'amount'        => 'required|integer|min:1',
            'slug'          => 'required|max:255',


        ];

        // Define custom error messages
        $messages = [
            'code.required' => 'Chưa nhập mã giảm giá',
            'expires_at.required'    => 'Chưa nhập hạn cho mã',
            'code.unique' => 'Mã giảm giá đã được sử dụng',
            'amount.required'   => 'Chưa nhập số lượng giảm',
            'slug.required'     => 'Chưa có slug',
            'type.not_in'     => 'Chưa chọn loại giảm giá',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules, $messages);
        $coupon = Coupon::create($request->all());

        return redirect()->route('coupons.index')->with('success', "Tạo Mã Giảm Giá Thành Công Với Code {$coupon->code}");
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
    public function edit($id)
    {
        $coupons = Coupon::find($id);
        return view('Admin.modun.coupons.edit', compact('coupons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coupons = Coupon::find($id);
        $dataUpdate = $request->all();
        $coupons->update($dataUpdate);

        return redirect()->route('coupons.index')->with('success', "Tạo Mã Giảm Giá Thành Công Với Code {$coupons->code}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupons = Coupon::find($id);
        $coupons->delete();
        return redirect()->route('coupons.index')->with('success', 'Xóa Mã Giảm Giá thành công!');
    }
}
