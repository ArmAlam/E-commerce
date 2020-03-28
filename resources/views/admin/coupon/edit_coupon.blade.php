@extends('admin.admin_layouts')
@section('admin_content')
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
          <div class="sl-page-title">
            <h5>Coupon Update</h5>
          </div><!-- sl-page-title -->
  
          <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title"> Coupon Update </h6>
            <br>
            <div class="table-wrapper">
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors as $erro)
                      <li> {{$error}} </li>
                    @endforeach
                  </ul>
                </div>    
              @endif
              
  
              <form method="POST" action="{{ url('update/coupon/' . $coupon->id) }}">
                  @csrf
                  <div class="modal-body pd-20">               
                      <div class="form-group">
                        <label for="">Coupon Code</label>
                      <input type="text" class="form-control" id="" value="{{ $coupon->coupon }}" name="coupon">
                      </div>
                      <div class="form-group">
                        <label for="">Coupon Discount</label>
                      <input type="text" class="form-control" id="" value="{{ $coupon->discount }}" name="discount">
                      </div>         
                  </div><!-- modal-body -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">Update</button>
                  </div>
              </form>
            </div><!-- table-wrapper -->
          </div><!-- card -->
        </div><!-- sl-pagebody -->

@endsection