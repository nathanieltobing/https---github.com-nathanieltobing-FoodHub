@extends('master')

@section('content')


  <section class="content">
    <main>
        <div class="" style="margin-top: 5%">

            <p style="font-size: 30px;font-family: Poppins; font-weight:700;text-align:center;margin-right:100px">Admin </p>
      </div>


      <div class="box-info" style="margin-top: 5%; margin-right:3%">
        <li>
            <i class="fas fa-people-group"></i>
            <span class="texts" style="line-height: 1.0;
            margin-bottom: -25px">
              <h3 style="font-size: 30px">{{$totalCustomer}}</h3>
              <p>Customers</p>
            </span>
          </li>
        <li>
          <i class="fas fa-people-group"></i>
          <span class="texts" style="line-height: 1.0;
          margin-bottom: -25px">
            <h3 style="font-size: 30px">{{$totalVendor}}</h3>
            <p>Vendors</p>
          </span>
        </li>

      </div>

      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3 style="font-size: 20px">Customers</h3>

          </div>

          <table>
            <thead>
              <tr class="fontstyle">
                <th style="font-size: 16px">User</th>
                <th style="font-size: 16px">Created Date</th>
                <th style="font-size: 16px">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($customers as $c)
                <tr>
                  <td>
                    @if ($c->image !=null)
                      <img src="/storage/{{$c->image}}" alt="" />
                    @else
                      <i class="bx bx-user-circle text-center mb-2" role="button" aria-expanded="false" style="font-size:2rem"> </i>
                    @endif
                    <p class="fontstyle">{{$c->name}}</p>
                  </td>
                  <td class="fontstyle">{{\Carbon\Carbon::parse($c->created_at)->format('d-m-Y')}}</td>
                  @if ($c->status == 'ACTIVE')
                  <form action="/deactivate/{{$c->id}}" method="POST">
                    {{method_field('PUT')}}
                    @csrf
                    <input type="hidden" id="hidden1" name="role" value="CUSTOMER">

                    <td><button class="status complete" style="border:none">Active</button></td>
                  </form>


                  @else
                  <form action="/activate/{{$c->id}}" method="POST">
                    {{method_field('PUT')}}
                    @csrf
                    <input type="hidden" id="hidden1" name="role" value="CUSTOMER">
                    <td><button class="status pending" style="border:none;">Inactive</button></td>
                  </form>
                  @endif

                </tr>
              @empty

              @endforelse
            </tbody>
          </table>
            <div class = "d-flex justify-content-center mt-4">
              {{$customers->appends(['vendors' => $vendors->currentPage()])->links()}}
            </div>
        </div>

        <div class="order" style="margin-right: 3%">
            <div class="head">
              <h3 style="font-size: 20px">Vendors</h3>
              {{-- <i class="fas fa-search"></i>
              <i class="fas fa-filter"></i> --}}
            </div>

            <table>
              <thead>
                <tr class="fontstyle">
                  <th style="font-size: 16px">User</th>
                  <th style="font-size: 16px">Created Date</th>
                  <th style="font-size: 16px">Status</th>
                  <th style="font-size: 16px">Number Of Transaction</th>
                  <th style="font-size: 16px">Total Sales</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($vendors as $v)
                <tr>
                  <td>
                    <img src="/storage/{{$v->image}}" alt="" />
                    <p class="fontstyle">{{$v->name}}</p>
                  </td>
                  <td class="fontstyle">{{\Carbon\Carbon::parse($v->created_at)->format('d-m-Y')}}</td>
                  @if ($v->status == 'ACTIVE')
                  <form action="/deactivate/{{$v->id}}" method="POST">
                    {{method_field('PUT')}}
                    @csrf
                    <input type="hidden" id="hidden1" name="role" value="VENDOR">
                    {{-- <button type="submit" style="border:0; background:none;"><span class="plus">+ </span></i></button>  --}}
                    <td><button class="status complete " style="border:none">Active</button></td>
                  </form>
                  @else
                  <form action="/activate/{{$v->id}}" method="POST">
                    {{method_field('PUT')}}
                    @csrf
                    <input type="hidden" id="hidden1" name="role" value="VENDOR">
                    {{-- <button type="submit" style="border:0; background:none;"><span class="plus">+ </span></i></button>  --}}
                    <td><button class="status pending" style="border:none;">Inactive</button></td>
                  </form>
                  @endif
                  <td>
                    <p class="fontstyle">{{$v->name}}</p>
                  </td>
                  <td>
                    <p class="fontstyle">{{$v->name}}</p>
                  </td>
                </tr>
              @empty

              @endforelse
              </tbody>
            </table>
            <div class = "d-flex justify-content-center mt-4">
              {{$vendors->appends(['customers' => $customers->currentPage()])->links()}}
            </div>


          </div>

      </div>
      <div class="box-info" style="margin-top: 5%; margin-right:3%">
        <li>

            <span  style="line-height: 1.0;">
              <p   style="text-align:center;font-size:30px;font-weight:700;font-family:Poppins;margin-top:-120px;margin-left: 205px;margin-bottom: 65px ">Top Category</p>
              <div class="justify-content-center align-items-center">

              <span style="font-size:30px;font-weight:700;font-family:Poppins;margin-left: 260px">Main Course</span>
              <span style="font-size:30px;font-weight:700;font-family:Poppins;margin-left: 351px">Products Sold : 117</span>
            </div>
            </span>
          </li>
        <li>
          <span class="texts" style="line-height: 1.0;">
            <p  style="font-size:30px;font-weight:700;font-family:Poppins;margin-left: 522px ">Top Vendor</p>
                    <img style="width: 200px" src="/storage/{{$v->image}}" alt="" />
                    <span  style="font-size:30px;font-weight:700;font-family:Poppins;"  class="fontstyle">{{$v->name}} </span>
                    <span style="font-size:30px;font-weight:700;font-family:Poppins;margin-left: 215px"> Total Earning: Rp 20.000.000</span>
          </span>
        </li>

      </div>
    </main>
  </section>


@endsection
