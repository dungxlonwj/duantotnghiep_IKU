<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

use Darryldecode\Cart\Facades\CartFacade;


use App\Http\Controllers\OrderController;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $booksInCart=array();

        foreach (CartFacade::getContent() as $key => $value) {
            $booksInCart[$value->id]=Book::getBookInCart($value->id);
        }

        return BaseClass::handlingView('front-end.cart',[
            'booksInCart'       =>$booksInCart,
        ]);
    }
    public function addCart(Request $request)
    {

        $book=Book::select('id','book_name','price','quality','book_image')->find($request->txtBookId);
        // dd($book);
        if (!isset($book)) {
            return 'Có lỗi xảy ra';
        }
        if ($book->quality<$request->qty) {
            return 'Không đủ hàng để cung cấp';
        }
        CartFacade::add([
            'id'        => $book->id,
            'name'      => $book->book_name,
            'quantity'  => $request->qty,
            'price'     => $book->price,
            // 'options'   =>['book_image' => $book->book_image]
        ]);
        // dd(Cart::content());
        return redirect()->route('cart.index');
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request)
    {
        if ($request->btnCheckout=='checkout') {
            OrderController::create();
            die();
        }

        foreach ($request->rowIds as $rowId => $qty) {
            // $id=CartFacade::get($rowId);
            $book=Book::select('quality')->find($rowId);
            // if ($book->quality<$qty) {
            //     return 'Không đủ số lượng hàng trong kho';
            // }
            CartFacade::update($rowId, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $qty
                ),
            ));
        }
        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CartFacade::remove($id);
        return redirect()->back();
    }
}
