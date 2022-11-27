
<!--  --------------------------------------------- -->

     <div class="tab-pane fade" id="supply" role="tabpanel" aria-labelledby="list-settings-list">
            <h5>Request Report form</h5>
            <form method="POST" action="">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>From</label>
                        <input type="date" name="from" value="{{date('Y-m-d')}}" class="form-control" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                            <label>To</label>
                            <input type="date" name="to" class="form-control" value="{{date('Y-m-d')}}" required="">
                            </div>
                    </div>

                         <div class="col-md-6 mt-2">
                            <div class="form-group">
                            <label>Select Department/Unit/Project</label>
                            <select id="department_id" class="form-control myselect" name="department_id" required>
                                <option selected value="0" selected>All Units</option>

                                @foreach($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name}}</option>
                            @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <div>
                            <label>Select Item</label>
                            <select class="form-control myselect" name="inv_items_id" id="inv_items_id">
                                <option selected value="0">All</option>
                                @foreach($items as $item)
                                <option value="{{$item->item_id}}">{{$item->item_name.' ('.$item->uom_name.')  ->['.$item->name.']'  }}</option>
                                @endforeach

                            </select>
                            </div>
                         </div>

                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i> Show report</button>
            </form>
    </div>
