
@extends('inventdashboard.layouts.tableLayout')
@section('title', 'stock details')
@section('content')
<div class="container-fluid">

    <!-- start quote -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="{{url('inventory/stockLevels')}}">Stock</a></li>
                          <li class="breadcrumb-item active"> Stock details</li>

                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end quote -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
        <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane show active" id="scroll-horizontal-preview">
                        <table id="" class="table w-100 nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Item name</th>
                                    <th>Belongs to</th>
                                    <th>Description</th>
                                    <th>UOM</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>
                                    <th>Total Cost</th>
                                    <th>As of</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($values)>0)
                                @php($i=1)
                                @foreach($values as $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value->item_name}}<input type="hidden" name="item[]" value="{{$value->itemid}}"></td>
                                    <td>{{ $value->name}}</td>
                                    <td>{{ $value->description}}</td>
                                    <td>{{ $value->uom_name}}</td>
                                    <td>{{ $value->stock_qty}} <input type="hidden" name="quantity[]" value="{{$value->stock_qty}}"></td>
                                    <td>{{ $value->unit_cost}}</td>
                                    <td>{{ $value->unit_cost*$value->stock_qty}} <input type="hidden" name="amount" value="{{ $value->unit_cost*$value->stock_qty}} "></td>
                                    <td>{{ $value->created_at}}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <p class="text-end mt-2">Total Amount: <strong><span id="totalamt"></span></strong></p>
                    </div> <!-- end preview-->

                    <div class="text-sm-end mt-3">

                    </div>
                </div> <!-- end tab-content-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<script type="text/javascript">

    window.sumInputs = function() {
        var inputs = document.getElementsByName('amount'),

            sum = 0;

        for(var i=0; i<inputs.length; i++) {
            var ip = inputs[i];

            if (ip.name && ip.name.indexOf("total") < 0) {
                sum += parseFloat(ip.value) || 0;
            }

        }


        var ked = sum;
      var num = 'UGX: ' + ked.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    document.getElementById('totalamt').innerHTML = num;
    document.getElementById('stktotalamt').value = sum;
    }
    sumInputs();


    </script>
@endsection
