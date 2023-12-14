@extends('master')


@section('content')
<div >


        <div class="inner" style="margin-top: 100px;text-align: center;">
            <h2 class="h2-text">Promotion</h2>
            <div class="border"></div>
        </div>
<div  class="slider" style="margin-top: 30px">
    <div class="list">
      @foreach ($featuredVendors as $vendor)
        <div class="item">
          <img src="{{Storage::url($vendor->vendor_picture)}}" alt="">
        </div>
      @endforeach
    </div>
    <div class="buttons">
        <button id="prev"><</button>
        <button id="next">></button>
    </div>
    <ul class="dots">
        <li class="active"></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    </div>

</div>
<script src="{{ asset('assets/script.js') }}"></script>

<div class="about-us">
    <div class="about-section">
        <div class="inner-container">
         <h1>ABOUT US</h1>
            <p class="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium minus eum beatae veniam odio ducimus quo iste sint adipisci libero similique consequuntur natus, minima suscipit, quisquam amet? Est, temporibus quae!

           </p>
          <div class="skills">
            <span> Food Management</span>
            <span> Service & Quality</span>
            <span> Vendors & Deliveries</span>
         </div>
        </div>

    </div>
</div>

<div class="testimonials">
    <div class="inner">
      <h2 class="h2-text">Best Vendors</h2>
      <div class="border"></div>
      
      <div class="row">
        @foreach ($topRatedVendors as $vendor)
          <div class="col">
            <div class="testimonial">
              <img src="{{Storage::url($vendor->vendor_picture)}}" alt="">
              <div class="name">{{$vendor->name}}</div>
              <div class="stars">
                @for ($i = 0; $i < $vendor->rating ; $i++)
                  <i class="fas fa-star"></i>
               @endfor             
              </div>


            </div>
          </div>
            
        @endforeach

      </div>
    </div>
  </div>
</div>


</body>

@endsection
