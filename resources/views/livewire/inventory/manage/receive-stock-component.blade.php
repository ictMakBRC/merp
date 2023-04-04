<div>
    <div class="card">
        <div class="card-body">   
            <h4>Creat stock Document # <span class="text-info">{{$code}}</span> for  <span class="text-info">{{$stock_docement->department->department_name??'N/A'}}</span> Unit</h4>     
            @if ($create_new)
                <form wire:submit.prevent="addNewStockDoc">
                    <div class="row">
                        <label for="package_no">Select a department and the date</label>
                        <div class="col-md-8">
                            <select class="form-control select2" id="defult_department" required wire:model="defult_department">
                                                <option selected value="">Select</option>
                                                @foreach ($departments as $department)
                                                    <option value='{{ $department->id }}'>
                                                        {{ $department->department_name }}</option>
                                                @endforeach
                                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" required wire:model='as_of' id="as_of">
                        </div>
                        <div class="col-md-2">
                            <x-button class="btn-success">{{ __('Proceed') }}</x-button>
                        </div>
                    </div>
                </form>   
                
                <div class="tab-content">
                    <div class="tab-pane show active" id="scroll-horizontal-preview">
                        <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Stock Code</th>
                                    <th>Department</th>
                                    <th>Date Entered</th>
                                    <th>GRN</th>
                                    <th>LPO</th>
                                    <th>Deliver No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($stock_docments)>0)
                                @php($i=1)
                                @foreach($stock_docments as $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value->stock_code??''}}</td>
                                    <td>{{ $value->department->department_name??'N/A'}}</td>
                                    <td>{{ $value->date_added??'N/A'}}</td>
                                    <td>{{ $value->lop??'N/A'}}</td>
                                    <td>{{ $value->grn??'N/A'}} </td>
                                    <td>{{ $value->delivery_no??'N/A'}}</td>
                                    <td> <a  href="javascript: void(0);" wire:click="deleteConfirmation({{$value->id}})" title="Delete!" class="action-icon {{$active}}"> <i class="mdi mdi-delete"></i></a></td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>                       
                    </div> <!-- end preview-->
                  
                   
                </div> <!-- end tab-content-->

                @else

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-0 {{$active}}"> 
                           <form wire:submit.prevent='storeItem'>
                              @csrf
                               <div class="row mb-2 mt-3">                                  
                                <div class="col-sm-4" >
                                    <label for="invitemid">Select Item</label>
                                    <select class="form-select select2" id="invitemid" wire:model="invitemid" required>
                                        <option value="">Select store</option>
                                        @if(count($items)>0)
                                        @foreach($items as $myitem)
                                        <option value="{{$myitem->id}}">{{$myitem->item->item_name.'  ('.$myitem->item->parentUom->uom_name??null.') '.$myitem->item->subUmit->name??null}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
            
                                    <div class="col-sm-2">
                                        <div class="text-sm">
                                            <label>Cost price</label>
                                            <input type="text" class="form-control" wire:model="unit_cost" id="icostprice" required>
                                        </div>
                                    </div>            
                                    <div class="col-sm-3">
                                        <div class="text-sm">
                                        <label>Supplier</label>
                                        <select class="form-control myselect" id="inv_supplier_id" wire:model="inv_supplier_id">
            
                                            @if(count($suppliers)>0)
                                            @foreach($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->sup_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label for="inv_store_id">Store{{$inv_store_id}}</label>
                                        <select class="form-select myselect" id="inv_store_id" wire:model="inv_store_id" required>
                                            <option value="">Select store</option>
                                            @if(count($stores)>0)
                                            @foreach($stores as $store)
                                                <option value="{{ $store->id }}">{{ $store->store_name.' '.$store->store_location}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                               </div>
            
                               <div class="row mb-2 mt-3">
                                    <div class="col-sm-2">
                                        <div class="text-sm">
                                            <label>Quantity</label>
                                            <input type="number" class="form-control" onchange="exp()" required wire:model="stock_qty">
                                        </div>
                                    </div><!-- end col-->
                                    <div class="col-sm-2">
                                        <div class="text-sm">
                                            <label>Batch No.</label>
                                            <input type="text" @if($expires == 'On') required @endif class="form-control" id="batch_no" wire:models="batch_no">
                                        </div>
                                    </div><!-- end col-->
                                    <div class="col-sm-1">
                                        <div class="text-sm">
                                            <label>Expires</label>
                                            <input type="text" readonly value="off" class="form-control" id="expires" wire:model="expires">
                                        </div>
                                    </div><!-- end col-->
                                    
                                    <div class="col-sm-3">
                                        <div class="text-sm">
                                            @php($Date = date("Y-m-d"))
                                            <label>Expiry date</label>
                                            <input type="date" class="form-control" @if($expires == 'On') required @endif min="{{date('Y-m-d', strtotime($Date. ' + 15 days'))}}" id="expiry_date" wire:model="expiry_date" >
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
            
                                        <div class="text-sm">
                                            <label>As of</label>
                                            <input type="date" class="form-control" wire:model='as_of' name="date_added" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="text-sm-end pt-2">
                                            <button type="submit" class="btn btn-primary mb-2 me-1">Add item</button>
                                        </div>
                                    </div><!-- end col-->
                                 </div>                                
                                </form>
                            </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('inventory/save-stock') }}">
                                @csrf
                            <div class="tab-content">
                                <div class="tab-pane show active" id="scroll-horizontal-preview">
                                    <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Item name</th>
                                                <th>Belongs to</th>
                                                <th>UOM</th>
                                                <th>Quantity</th>
                                                <th>Cost</th>
                                                <th>Total Cost</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($stock_items)>0)
                                            @php($i=1)
                                            @foreach($stock_items as $value)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$value->item->item_name??''}}<input type="hidden" name="item[]" required value="{{$value->inv_item_id}}"></td>
                                                <td>{{ $value->item->subUmit->subunit_name??'N/A'}}</td>
                                                <td>{{ $value->item->parentUom->uom_name??'N/A'}}</td>
                                                <td>{{ $value->stock_qty}} <input type="hidden" name="quantity[]" value="{{$value->stock_qty}}"></td>
                                                <td>{{ $value->unit_cost}}</td>
                                                <td>{{ $value->unit_cost*$value->stock_qty}} <input type="hidden" name="amount" value="{{ $value->unit_cost*$value->stock_qty}} "></td>
                                                <td> <a  href="javascript: void(0);" wire:click="deleteConfirmation({{$value->id}})" title="Delete!" class="action-icon {{$active}}"> <i class="mdi mdi-delete"></i></a></td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <p class="text-end mt-2">Total Amount: <strong><span id="totalamt"></span></strong></p>
                                </div> <!-- end preview-->
                                <input type="hidden" class="form-control" name="stockcode"  readonly value="{{ $code }}">
                                <input type="hidden" class="form-control" name="stktotalamt" id="stktotalamt" readonly>
                                <div class="row mt-3">
                                    <div class="col mt-1">
                                        <div class="input-group">
                                        <span class="input-group-text">LPO</span>
                                        <input type="text" name="lpo" value="{{$stock_docement->lpo??''}}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col mt-1">
                                        <div class="input-group">
                                            <span class="input-group-text">GRN</span>
                                        <input type="text" name="grn" value="{{$stock_docement->grn??''}}" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col mt-1">
                                        <div class="input-group">
                                            <span class="input-group-text">Delivery No</span>
                                        <input type="text" name="delivery_no" value="{{$stock_docement->delivery_no??''}}" class="form-control" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="text-sm-end col {{$active}}">
                                        <button type="submit" id="saveStk" disabled class="btn btn-primary mb-2 me-1 mt-1 text-sm-end">Save stock</button>
                                    </div>
                                </div>
                               
                            </div> <!-- end tab-content-->
                         </form>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
               
            @endif
        </div>
    </div> <!-- end card body-->

    @push('scripts')
    <script>
        window.addEventListener('livewire:load', () => {
            initializeSelect2();
        });

        $('#defult_department').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('defult_department', data.id);
        });

        $('#invitemid').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('invitemid', data.id);
        });


        window.addEventListener('livewire:update', () => {
            $('.select2').select2('destroy'); //destroy the previous instances of select2
            initializeSelect2();
        });

        function initializeSelect2() {

            $('.select2').each(function() {
                $(this).select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                        '100%' : 'style',
                    placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Select',
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });
        }
    </script>

<script>  
    window.addEventListener('swal:delete-confirm', event => { 
                swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.livewire.emit('deleteItem');
                }
                else{
                    window.livewire.emit('cancel');
                }
                });
            });
 </script>
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
        var numval = document.getElementById('stktotalamt').value-0;
        if(numval > 0) { 
            //btn.setAttribute('disabled', 'disabled');
            document.getElementById("saveStk").disabled = false; 
        }
        else{
            document.getElementById("saveStk").disabled = true; 
            //btn.removeAttribute("disabled");
        }
    </script>
@endpush
</div>
