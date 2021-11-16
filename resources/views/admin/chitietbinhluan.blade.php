@extends('admin.layout')
@section('content')

      <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @foreach($dg as $value)
                    <label>Tác giả:</label>
                    <span>{{$value->khTen}}</span>
                    <br/>
                    <label>Ngày bình luận:</label>
                    <span>{{$value->dgNgay}}</span>
                    <br/>
                    <label>Nội dung</label>
                    <div style="border:1px solid black;height: 100px;width: 40%;padding-left: 1rem">
                        {{$value->dgNoidung}}
                    </div>
                    @endforeach
                    <br/>
                    <button class="btn btn-info" type="button" onclick="back()">Trở về</button>
                </div>
            </div>

      </div>

     

@endsection