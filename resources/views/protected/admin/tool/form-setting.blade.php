<div id="{{$id}}" class="row marginTop10">
    <div class="col-md-4" style="margin-left: {{40 * explode('_', $id)[1]}}px">
        <div class="form-inline">
            <button class="btn blue margin0" type="button"><i class="fa fa-plus"></i></button>
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
        <button onclick="remove()" class="btn red margin0" type="button"><i class="fa fa-times"></i></button>
        <button class="btn green margin0" type="button"><i class="fa fa-paper-plane-o"></i></button>
    </div>
</div>
<!-- /.row -->