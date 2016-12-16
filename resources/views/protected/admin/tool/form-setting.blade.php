<div id="{{$id}}">
    <div  class="row marginTop10">
        <div class="col-md-4" style="margin-left: {{ 20 * $margin }}px">
            <div class="form-inline">
                {{--<button class="btn blue margin0" type="button"><i class="fa fa-plus"></i></button>--}}
                <select class="form-control">
                    <option>Tag</option>
                    <option>ID</option>
                    <option>Class</option>
                </select>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-2 no-padding">
            <button onclick="add('{{$id}}')" class="btn blue margin0" type="button"><i class="fa fa-plus"></i></button>
            <button onclick="remove('{{$id}}')" class="btn red margin0" type="button"><i class="fa fa-times"></i></button>
            <button onclick="selectField('{{$id}}')" class="btn green margin0" type="button"><i class="fa fa-paper-plane-o"></i></button>
        </div>
        <div class="col-md-2">
            <label id="field-{{$id}}" class="control-label col-md-1 col-sm-1 col-xs-12">
            </label>
        </div>
    </div>
</div>
<!-- /.row -->