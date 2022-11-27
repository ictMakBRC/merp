
<!--  --------------------------------------------- -->

     <div class="tab-pane fade show active" id="stockstatus" role="tabpanel" aria-labelledby="list-settings-list">
            <h5>Stock status Report form</h5>
            <form method="POST" action="{{url('inventory/report/view/stock')}}">
                @csrf
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
                            <label for="subCategory">Subcategory</label>

                            <select name="inv_subunit_id" id="inv_subunit_id" class="form-control myselect">
                                <option selected value="0" selected>All sub Units</option>
                                @foreach($subunits as $subunit)
                                <option value="{{$subunit->id}}">{{$subunit->subunit_name}}</option>
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
                    <button type="submit" class="btn btn-primary mt-2 text-sm-end"><i class="fa fa-file"></i> Show report</button>
            </form>
    </div>
   


<script>
    $(document).ready(function(){
    $('#inv_subunit_id').change(function() {

        var itemID = $(this).val();
        $("#inv_items_id").empty();
        $("#inv_items_id").append('<option value="0">All items</option>');

        if (itemID) {
            $.ajax({
                type: "GET",
                url: "{{ url('inventory/manage/getSubDptData') }}?sub_id=" + itemID,
                success: function(response) {

                    var len = 0;
         if(response['item'] != null){
           len = response['item'].length;
         }

         if(len > 0){
           // Read data and create <option >
           for(var i=0; i<len; i++){

            var item_id =  response['item'][i].item_id;
            var item_name =  response['item'][i].item_name;

            var optionitem = "<option value='"+item_id+"'>"+item_name+"</option>";

            $("#inv_items_id").append(optionitem);
             
           }
         }
                }
            });
        } else {

            $("#inv_items_id").empty();
        $("#inv_items_id").append('<option value="0">No Data</option>');

        }
    });
});
</script>

