<label class="control-label">itemes</label>
<div class="col-4">
    <div class="form-group itemKeys">
        <label class="control-label">Key</label>
        <input type="text" name="items[0][key]" class="form-control InputKey">
    </div>
</div>
<div class="col-4">
    <div class="form-group itemItems">
        <label class="control-label">Value</label>
        <input type="text" name="items[0][value]" class="form-control InputItem">
    </div>
</div>
<div class="col-4">
    <div class="form-group ButtonItems">
        <button type="button" class="btn btn-sm btn-primary MoreItem">More items</button>
    </div>
</div>
<script>
    var i = 0;
    $('.MoreItem').on('click', function () {
        var Item = $('.InputItemExtra').last();
        if (Item.val() !== '') {
            ++i;
            $('.itemKeys').append('<label class="control-label">Key</label><input type="text" name="items[' + i + '][key]" class="form-control InputKeyExtra">')
            $('.itemItems').append(' <label class="control-label">Value</label><input type="text" name="items[' + i + '][value]" class="form-control InputItemExtra">')
        }
    })
</script>