<div id="{{$id}}">
    <div  class="row marginTop10">
        <div class="col-md-4" style="margin-left: {{ 20 * $margin }}px">
            <div class="form-inline">
                {{--<button class="btn blue margin0" type="button"><i class="fa fa-plus"></i></button>--}}
                <select name="tags[{{$id}}]" class="form-control">
                    <option value="div">div</option>
                    <option value="ul">ul</option>
                    <option value="li">li</option>
                    <option value="p">p</option>
                    <option value="span">span</option>
                    <option value="a">link a</option>
                    <option value="img">img</option>
                    <option value="h1">h1</option>
                    <option value="h2">h2</option>
                    <option value="h3">h3</option>
                    <option value="h4">h4</option>
                    <option value="h4">h5</option>
                    <option value="b">b</option>
                    <option value="i">i</option>
                </select>
                <input name="htmls[{{$id}}]" type="text" class="form-control">
                <input type="hidden" name="depths[]" value="{{$id}}">
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
            <input type="hidden" name="hid_fields[{{$id}}]" value="" id="hid-field-{{$id}}">
        </div>
        <div class="col-md-2">
            <select name="types[{{$id}}]" class="form-control">
                <option value="">select type</option>
                <option value="0">text</option>
                <option value="1">image</option>
                <option value="2">link</option>
            </select>
        </div>
    </div>
</div>
<!-- /.row -->