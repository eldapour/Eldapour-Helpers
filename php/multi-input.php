<div class="row">
    <label class="control-label">element</label>
    <div class="col-4">
        <div class="form-group itemItems">
            <input type="text" name="items[]" class="form-control InputItem InputItemExtra" value="">
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.delItem', function () {
        var Item = $('.InputItemExtra').last();
        if (Item.val() == '') {
            Item.fadeOut();
            Item.remove();
            $('.Issue').removeClass('badge-danger').addClass('badge-success');
            $('.Issue').html('The element deleted');
            setTimeout(function () {
                $('.Issue').html('');
            }, 3000)
        } else {
            $('.Issue').html('The element must be empty');
            setTimeout(function () {
                $('.Issue').html('');
            }, 3000)

        }
    })

    $(document).on('click', '.MoreItem', function () {
        var Item = $('.InputItemExtra').last();
        if (Item.val() !== '') {
            $('.itemItems').append('<input type="text" name="items[]" class="form-control InputItemExtra mt-3">')
        }
    })
</script>