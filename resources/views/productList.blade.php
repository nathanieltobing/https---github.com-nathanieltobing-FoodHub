@extends('master')
@section('content')

{{-- <div class="toast">
    <div class="toast-content">
        <i class="fas fa-solid fa-check check"></i>
        <div class="message">
            <span class="text text-1">Success</span>
            <span class="text text-2">Your changes has been saved</span>
        </div>
    </div>
    <i class="fa-solid fa-xmark close"></i>
    <div class="progress"></div>
</div> --}}


    <div class="covering mt-5" style="padding-top:7rem">
        <div class="cards">
            <div class="imgBx">
                @if(!$vendor->image)
                    <i class="bx bx-user-circle" style="font-size: 10rem;margin-right:10px"></i>
                @endif
                @if ($vendor->image)
                    <img src="{{Storage::url($vendor->image)}}">
                @endif
                {{-- <img src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt=""> --}}
            </div>
            <div class="content" style="margin-left: -80%;">
                <div class="details fontstyle" style="height: 250px">
                     <h2 >{{$vendor->name}}</h2>      <span> {{$vendor->description}}</span>

                    <div class="data">
                        {{-- <span> {{$vendor->description}}</span> --}}


   <div class="container mt-5">
        <div class="mt-5" style="padding-top:7rem">
                <div class="cards">
                    <div class="imgBx">
                        @if(!$vendor->image)
                            <i class="bx bx-user-circle" style="font-size: 10rem;margin-right:10px"></i>
                        @endif
                        @if ($vendor->image)
                            <img src="{{Storage::url($vendor->image)}}">
                        @endif
                    </div>

                    <div class="content" style="margin-left: -80%;">
                        <div class="details" style="height: 250px">
                            <h2>{{$vendor->name}}</h2>      <span> {{$vendor->description}}</span>

                            <div class="data">

                            </div>
                            <div class="actionBtn" style="width: 100%">
                                <button style="margin-top: 10px">{{$vendor->phone}}</button>
                            </div>
                        </div>

                    </div>
                </div>
        </div>


    </div>


   <div class="container mt-5">
        @if (Auth::guard('webcustomer')->check())
            <h1 class="fontstyle" style="font-size:30px;font-weight:700">Product List</h1>
        @elseif(Auth::guard('webvendor')->check())
            <div class="d-flex">
                <h1 style="padding-top :0%;font-size:30px;font-weight:700" class="align-self-end fontstyle">Product List</h1>
            <a href="/product/vendor/add" class="submit-button ms-auto" style="width: 20%;background-color:var(--indigo-500);;text-decoration:none;color:white"id="editProduct">Add Product</a>

            </div>
        @else
            <h3 class="mt-5">Product List</h3>
        @endif
        <hr class="bg-dark">
        <form action="/products/search/{{$vendor->id}}" class="row justify-content-start mb-4" role="search">
            <div class="col-md-4 input-group">
                <input class="form-control me-2"  name="search" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <a href="/products/{{$vendor->id}}" class="btn btn-outline-primary">Reset</a>
                </div>
            </div>
        </form>

        <div class="row justify-content-start">
            @forelse($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card shadow text-center" style="border-radius: 15px;" >
                        <img src="{{Storage::url($product->image)}}" class="card-img-top" alt="Product Image" style="border-top-left-radius: 15px; border-top-right-radius: 15px; object-fit:cover; height: 12.5rem;">
                        <div class="card-body" style="height: 17.5rem; overflow: hidden;">
                            <h5 class="card-title fontstyle">{{ $product->name }}</h5>
                            <h6 class="card-title text-secondary fontstyle">{{ $product->categories->name }}</h6>
                            <p class="card-text fontstyle" style="height:5rem; overflow:hidden;" >{{ $product->description }}</p>
                            @if(!$product->promotions)
                                <h6 class="card-text mb-4 fontstyle">Rp{{number_format($product->price,2,",",".")}}</h6>
                            @else
                                <h6 class="card-text fontstyle" style="margin-top:-0.9rem">Rp{{number_format($product->promotions->discount,2,",",".")}}</h6>
                                <small><p class="card-text mb-2 fontstyle" style="text-decoration: line-through">Rp{{number_format($product->price,2,",",".")}}</p></small>
                            @endif
                            @if (Auth::guard('webcustomer')->check())
                                @if ($error == '-1')
                                    <form action="/products/add/{{$product->id}}" method="POST">
                                        @csrf

                                        <button class="submit-button fontstyle" style="margin-left:5em;" type="submit" id="error_trigger">Add to Cart</button>
                                    </form>
                                @else
                                    <button class="submit-button fontstyle" style="margin-left:5em;" class="btnAdd" name="btnAdd" type="submit" id="error_trigger">Add to Cart</button>
                                @endif
                            @elseif(Auth::guard('webvendor')->check())
                                <a href="/product/vendor/edit/{{$product->id}}" class="submit-button fontstyle" style="margin-left:5em;text-decoration:none;color:white">Edit</a>
                            @else
                                <a href="/login" class="submit-button fontstyle" style="margin-left:3em;text-decoration:none;color:white;width:70%;margin-top:1.3em">Login to add to cart</a>
                            @endif

                        </div>
                    </div>
                </div>
            @empty
                <p>No products available</p>
            @endforelse
            <div class = "d-flex justify-content-center mt-4">
                {{$products->links()}}
              </div>
              @if (Auth::guard('webcustomer')->check())
                <input type="hidden" id="hidden1" name="role" value={{$error}}>
                <div class="popups" id="error" style="width: 30%">
                    <div class="popup-content">
                        <div class="imgbox">
                        <img src="{{ asset('assets/images/cancel.png') }}" alt="" class="img">
                        </div>
                        <p class="para fontstyle">YOU CAN'T ADD PRODUCTS FROM TWO DIFFERENT VENDORS</p>
                        <form action="">
                        <a href="#" class="buttons" id="e_button">EXIT</a>
                        </form>
                    </div>
                </div>

              @endif
              <script src="{{ asset('assets/popup.js') }}"></script>
              <h3>Reviews</h3>

                <div class="review-section my-4" style=" flex: 1; overflow-x: auto; white-space: nowrap;">
                    <div class="review-container mb-5">
                    @forelse ($vendor->reviews as $review)
                        <div class="card shadow" style="display: inline-block; margin-right: 10px; max-width: 300px; height: 160px; overflow:hidden">
                            <div class="card-body">
                                <h5 class="card-title">{{$review->order->customers->name}}</h5>
                                <div class="stars">
                                    @for ($i = 0; $i < $review->rating ; $i++)
                                      <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <p class="card-text" style="white-space: pre-line;">{{$review->comment}}</p>
                            </div>
                        </div>
                    @empty
                    <p>There is no review yet!</p>
                    @endforelse
                    </div>
                </div>
        </div>
    </div>
@endsection
