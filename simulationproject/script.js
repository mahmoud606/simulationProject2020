$(document).ready(function () {
    var i=1;
    var j=1;
    $('#add').click(

        function () {
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'">\n' +
                '                                <td><input type="number" name="num1[]"  placeholder="Enter number "  class="form-control name_list" required /></td>'+
                '                                <td><input type="number" name="name[]"  placeholder="Enter number "  class="form-control name_list" required /></td>\n' +'' +
                '                                <td><button type="button" name="add" id="'+i+'" class="btn btn-danger remove">x</button></td>\n' +
                '                            </tr>');

        });
    $(document).on('click', '.remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
    });
    $('#submit').click(function(){
        $.ajax({
            url:"name.php",
            method:"POST",
            data:$('#add_name').serialize(),
            success:function(data)
            {
                alert(data);
                $('#add_name')[0].reset();
            }
        });
    });
});