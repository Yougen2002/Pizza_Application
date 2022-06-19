<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Order;
use App\Models\product;
use App\Models\Topping;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class CartController extends Controller
{

    public function store(Request $request)

    {

        $validated = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1'
        ]);

        //create an instance of the product
        $product = (new Product())->findOrFail($validated['product_id']);

        //check if a cart exist for this autherized user
        $cart = Cart::where('user_id', auth()->id())
            ->where('is_paid', false)
            ->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => auth()->id(),
                'total' => 0,
                'is_paid' => false,
            ]);
        }

        //check whether the product is already in the cart and remove
        $cart->products()->detach($product->id);

        //calculate product total
        $product_total = $product->price * $validated['quantity'];


        //check if there are any toppings and add them to the product total
        if ($request->toppings) {
            foreach ($request->toppings as $topping) {
                $product_total += (new Topping())->findOrFail($topping)->price * $validated['quantity'];
            }
        }



        //add products to the cart
        $cart->products()->attach(
            [
                $product->id => [
                    'quantity' => $validated['quantity'],
                    'price' => $product->price,
                    'total' => $product_total,
                    'toppings' => $request->toppings ? json_encode($request->toppings) : null,
                ],
            ]
        );



        //calculating the final total
        $cart->total = 0;
        foreach ($cart->products as $product) {
            $cart->total += $product->pivot->total;
        }
        $cart->save();

        return redirect()->route('cart.show', $cart->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Cart $cart)
    {

        if ($cart->is_paid) {
            return redirect()->route('home');
        }



        //check if the cart belongs to the authenticated user
        if ($cart->user_id !== $request->user()->id) {
            abort(403, 'Sorry!!!, This cart does not belong to you');
        }


        return view('cart.show', compact('cart'));
    }

    //***********************check out controller*******************************************
    public function checkout(Request $request, Cart $cart)
    {

        if ($cart->is_paid) {
            return redirect()->route('home');
        }

        //check if the checkout belongs to the authenticated user
        if ($cart->user_id !== $request->user()->id) {
            abort(403, 'Sorry!!!, This checkout does not belong to you');
        }

        //create an order for the cart
        $order = Order::where('cart_id', $cart->id)
            ->where('user_id', $request->user()->id)->first();

        //if the order is null,create a new order

        if (!$order) {
            $order = Order::create([
                'cart_id' => $cart->id,
                'user_id' => $request->user()->id,
                'status' => 'pending',
                'payment_status' => 'pending',
                'delivery_method' => 'delivery',
                'total' => $cart->total,
            ]);
        }

        //create an instance of deal and check if the deal is applicable for the cart

        $deal = (new \App\Models\Deal())->find($order->deal_id);

        if ($deal) {
            //check for the deal type
            if ($deal->type == 'number_of_items_validation') {
                // check if deal has a value and that is equal to the number of items in the cart
                //count all the products in the cart
                $count = 0;

                foreach ($cart->products as $product) {
                    $count += $product->pivot->quantity;
                }
                //for large pizza
                if ($deal->value == $count && $product->size == 'large' && $deal->size == 'large' && $deal->code == 'BOGOF') {

                    //attach the deal to the order
                    $order->deal_id = $deal->id;

                    //check for the deal price type and calculate the total
                    if ($deal->price_type == 'fixed' &&  $deal->size == 'large' && $product->size == 'large') {

                        $order->total = $cart->total - $deal->price_value;

                        $order->discount = $cart->total - $order->total;
                    } else if ($deal->price_type == 'percentage' && $product->size == 'large') {

                        $order->total = ($cart->total - ($cart->total * $deal->price_value / 100))/2;
                        $order->discount = $cart->total - $order->total;
                    }

                    //save the order
                    $order->save();

                    session()->flash('deal_success', $deal->name . 'Deal applied successfully');
                }
                //for medium pizza
                elseif ($deal->value == $count && $deal->size == 'medium' && $product->size == 'medium' && $deal->code == 'BOGOF') {

                    //attach the deal to the order
                    $order->deal_id = $deal->id;

                    //check for the deal price type and calculate the total
                    if ($deal->price_type == 'fixed' && $deal->size == 'medium' && $product->size == 'medium') {

                        $order->total = $cart->total - $deal->price_value;

                        $order->discount = $cart->total - $order->total;
                    } else if ($deal->price_type == 'percentage' && $product->size == 'medium') {

                        $order->total =($cart->total - ($cart->total * $deal->price_value / 100))/2;
                        $order->discount = $cart->total - $order->total;
                    }

                    //save the order
                    $order->save();

                    session()->flash('deal_success', $deal->name . 'Deal applied successfully');
                }
                //3for 2 deal 
                elseif ($deal->value == $count &&  $deal->code == '3FOR2') {
                    //attach the deal to the order
                    $order->deal_id = $deal->id;
                    //check for the deal price type and calculate the total
                    if ($deal->price_type == 'fixed') {

                        $order->total = $cart->total - $deal->price_value;

                        $order->discount = $cart->total - $order->total;
                    } else if ($deal->price_type == 'percentage') {

                        $order->total = $cart->total - ($cart->total * $deal->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }

                    //save the order
                    $order->save();

                    session()->flash('deal_success', $deal->name . 'Deal applied successfully');
                }
                //Family Feast deal
                elseif ($deal->value == $count &&  $deal->code == 'FF' && $deal->size == 'medium') {

                    //attach the deal to the order
                    $order->deal_id = $deal->id;
                    //check for the deal price type and calculate the total
                    if ($deal->price_type == 'fixed') {

                        $order->total =  $deal->price_value;

                        $order->discount = $deal->price_value;
                    } else if ($deal->price_type == 'percentage') {

                        $order->total = $cart->total - ($cart->total * $deal->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }

                    //save the order
                    $order->save();

                    session()->flash('deal_success', $deal->name . 'Deal applied successfully');
                }
                //2 large pizza deal
                elseif ($deal->value == $count &&  $deal->code == '2L' &&  $product->size == 'large' && $product->typeofpizza->name != "Create Your Own Pizza") {

                    //attach the deal to the order
                    $order->deal_id = $deal->id;
                    //check for the deal price type and calculate the total
                    if ($deal->price_type == 'fixed' &&  $product->size == 'large') {

                        $order->total =  $deal->price_value;

                        $order->discount = $deal->price_value;
                    } else if ($deal->price_type == 'percentage') {

                        $order->total = $cart->total - ($cart->total * $deal->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }

                    //save the order
                    $order->save();

                    session()->flash('deal_success', $deal->name . 'Deal applied successfully');
                }
                //2 medium pizza deal
                elseif ($deal->value == $count &&  $deal->code == '2M' && $product->size == 'medium' && $product->typeofpizza->name != "Create Your Own Pizza") {

                    //attach the deal to the order
                    $order->deal_id = $deal->id;
                    //check for the deal price type and calculate the total
                    if ($deal->price_type == 'fixed' && $product->size == 'medium') {

                        $order->total =  $deal->price_value;

                        $order->discount = $deal->price_value;
                    } else if ($deal->price_type == 'percentage') {

                        $order->total = $cart->total - ($cart->total * $deal->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }

                    //save the order
                    $order->save();

                    session()->flash('deal_success', $deal->name . 'Deal applied successfully');
                }
                //2 small pizza deal
                elseif ($deal->value == $count &&  $deal->code == '2S' && $product->size == 'small') {
                    //attach the deal to the order
                    $order->deal_id = $deal->id;
                    //check for the deal price type and calculate the total
                    if ($deal->price_type == 'fixed' && $deal->size == 'small') {

                        $order->total =  $deal->price_value;

                        $order->discount = $deal->price_value;
                    } else if ($deal->price_type == 'percentage') {

                        $order->total = $cart->total - ($cart->total * $deal->price_value / 100);
                        $order->discount = $cart->total - $order->total;
                    }

                    //save the order
                    $order->save();

                    session()->flash('deal_success', $deal->name . 'Deal applied successfully');
                } else {

                    $order->total = $cart->total;
                    $order->discount = 0;
                    $order->deal_id = null;
                    $order->save();

                    session()->flash('error', 'Sorry!!!', $deal->name . ' is not applicable for your cart');
                }
            }
        }


        //get all active deals
        $deals = \App\Models\Deal::where('is_active', true)->get();

        return view('cart.checkout', [
            'cart' => $cart,
            'user' => $request->user(),
            'deals' => $deals,
            'order' => $order

        ]);
    }
    //**********************************Order controller*********************************************
    public function updateOrder(Request $request, Cart $cart, Order $order)
    {

        //check if the deal has an id
        $request->validate([
            'deal_id' => 'required|numeric|exists:deals,id',
        ]);

        //create an instance of deal and check if the deal is applicable for the cart

        $deal = (new \App\Models\Deal())->findOrFail($request->deal_id);

        //check for the deal type
        if ($deal->type == 'number_of_items_validation') {
            // check if deal has a value and that is equal to the number of items in the cart
            //count all the products in the cart
            $count = 0;

            foreach ($cart->products as $product) {
                $count += $product->pivot->quantity;
            }
            //for large pizza
            if ($deal->value == $count && $deal->size == 'large' && $product->size == 'large' && $deal->code == 'BOGOF') {

                //attach the deal to the order
                $order->deal_id = $deal->id;

                //check for the deal price type and calculate the total
                if ($deal->price_type == 'fixed' && $deal->size == 'large' && $product->size == 'large') {

                    $order->total = $cart->total - $deal->price_value;

                    $order->discount = $cart->total - $order->total;
                } else if ($deal->price_type == 'percentage' && $deal->size == 'large' && $product->size == 'large') {

                    $order->total = ($cart->total - ($cart->total * $deal->price_value / 100))/2;

                    $order->discount = $cart->total - $order->total;
                }

                //save the order
                $order->save();
                session()->flash('deal_success', $deal->name . 'Deal applied successfully');
            }
            //for medium pizza
            elseif ($deal->value == $count && $deal->size == 'medium' && $product->size == 'medium' && $deal->code == 'BOGOF') {

                //attach the deal to the order
                $order->deal_id = $deal->id;

                //check for the deal price type and calculate the total
                if ($deal->price_type == 'fixed' && $deal->size == 'medium' && $product->size == 'medium') {

                    $order->total = $cart->total - $deal->price_value;

                    $order->discount = $cart->total - $order->total;
                } else if ($deal->price_type == 'percentage' && $deal->size == 'medium' && $product->size == 'medium') {

                    $order->total = ($cart->total - ($cart->total * $deal->price_value / 100))/2;
                    $order->discount = $cart->total - $order->total;
                }

                //save the order
                $order->save();

                session()->flash('deal_success', $deal->name . 'Deal applied successfully');
            }
            //3for2 deal 
            elseif ($deal->value == $count &&  $deal->code == '3FOR2') {
                //attach the deal to the order
                $order->deal_id = $deal->id;
                //check for the deal price type and calculate the total
                if ($deal->price_type == 'fixed') {

                    $order->total = $cart->total - $deal->price_value;

                    $order->discount = $cart->total - $order->total;
                } else if ($deal->price_type == 'percentage') {

                    $order->total = $cart->total - ($cart->total * $deal->price_value / 100);
                    $order->discount = $cart->total - $order->total;
                }

                //save the order
                $order->save();

                session()->flash('deal_success', $deal->name . 'Deal applied successfully');
            }
            //Family Feast deal
            elseif ($deal->value == $count &&  $deal->code == 'FF' && $deal->size == 'medium') {

                //attach the deal to the order
                $order->deal_id = $deal->id;
                //check for the deal price type and calculate the total
                if ($deal->price_type == 'fixed') {

                    $order->total =  $deal->price_value;

                    $order->discount = $deal->price_value;
                } else if ($deal->price_type == 'percentage') {

                    $order->total = $cart->total - ($cart->total * $deal->price_value / 100);
                    $order->discount = $cart->total - $order->total;
                }

                //save the order
                $order->save();

                session()->flash('deal_success', $deal->name . 'Deal applied successfully');
            }
            //2 large pizza deal
            elseif ($deal->value == $count &&  $deal->code == '2L' && $product->size == 'large' && 
            $product->typeofpizza->name != "Create Your Own Pizza") {

                //attach the deal to the order
                $order->deal_id = $deal->id;
                //check for the deal price type and calculate the total
                if ($deal->price_type == 'fixed' && $product->size == 'large') {

                    $order->total =  $deal->price_value;

                    $order->discount = $deal->price_value;
                } else if ($deal->price_type == 'percentage') {

                    $order->total = $cart->total - ($cart->total * $deal->price_value / 100);
                    $order->discount = $cart->total - $order->total;
                }

                //save the order
                $order->save();

                session()->flash('deal_success', $deal->name . 'Deal applied successfully');
            }
            //2 medium pizza deal
            elseif ($deal->value == $count &&  $deal->code == '2M' && $product->size == 'medium' && 
            $product->typeofpizza->name != "Create Your Own Pizza") {

                //attach the deal to the order
                $order->deal_id = $deal->id;
                //check for the deal price type and calculate the total
                if ($deal->price_type == 'fixed' && $deal->size == 'medium') {

                    $order->total =  $deal->price_value;

                    $order->discount = $deal->price_value;
                } else if ($deal->price_type == 'percentage') {

                    $order->total = $cart->total - ($cart->total * $deal->price_value / 100);
                    $order->discount = $cart->total - $order->total;
                }

                //save the order
                $order->save();

                session()->flash('deal_success', $deal->name . 'Deal applied successfully');
            }
            //2 small pizza deal
            elseif ($deal->value == $count &&  $deal->code == '2S' && $product->size == 'small') {
                //attach the deal to the order
                $order->deal_id = $deal->id;
                //check for the deal price type and calculate the total
                if ($deal->price_type == 'fixed' && $deal->size == 'small') {

                    $order->total =  $deal->price_value;

                    $order->discount = $deal->price_value;
                } else if ($deal->price_type == 'percentage') {

                    $order->total = $cart->total - ($cart->total * $deal->price_value / 100);
                    $order->discount = $cart->total - $order->total;
                }

                //save the order
                $order->save();

                session()->flash('deal_success', $deal->name . 'Deal applied successfully');
            } else {

                $order->total = $cart->total;
                $order->discount = 0;
                $order->deal_id = null;
                $order->save();

                session()->flash('error', 'Sorry!!! ,' . $deal->name . ' deal is not applicable for your cart');
            }
        }

        //redirect to checkout page
        return redirect()->route('cart.checkout', $cart->id);
    }

    public function completecheckout(Request $request, Cart $cart, Order $order)
    {


        $validated = $request->validate([
            "title" => "required",
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "gender" => "required",
            "date_of_birth" => "required|date",
            "address_1" => "required|string",
            "address_2" => "required|string",
            "city" => "required|string|max:255",
            "postcode" => "required|string|max:255",
            "phone" => "required|string|max:255",
            "mobile" => "required|string|max:255",
        ]);

        //get the user from the request

        $user = $request->user();

        // update the user with validated data
        $user->update($validated);

        //update the order with the validated data
        $order->update([
            'status' => 'processing',
            'payment_status' => 'paid',
            'delivery_method' => 'collection','delivery',
            'address_1' => $validated['address_1'],
            'address_2' => $validated['address_2'],
            'city' => $validated['city'],
            'postcode' => $validated['postcode'],
            'phone' => $validated['phone'],
            'mobile' => $validated['mobile'],
        ]);

        //update the cart and set the payment status to true

        $cart->update([

            'is_paid' => true
        ]);


        return view('cart.complete', [
            'cart' => $cart,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {

        $validated = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1'
        ]);

        //create an instance of the product
        $product = (new Product())->findOrFail($validated['product_id']);

        //check whether the product is already in the cart and remove
        $cart->products()->detach($product->id);

        $cart->products()->attach([
            $product->id => [
                'quantity' => $validated['quantity'],
                'price' => $product->price,
                'total' => $product->price * $validated['quantity']
            ],
        ]);


        //calculating the final total
        $cart->total = 0;
        foreach ($cart->products as $product) {
            $cart->total += $product->pivot->total;
        }
        $cart->save();

        return redirect()->route('cart.show', $cart->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cart $cart)
    {
        $cart->products()->detach($request->product_id);

        // loop through the products in the cart and calculate the total
        $cart->total = 0;
        foreach ($cart->products as $product) {
            $cart->total += $product->pivot->total;
        }
        $cart->save();

        return redirect()->route('cart.show', $cart->id);
    }
}
