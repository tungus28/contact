let $ = jQuery;
function editContact(id) {
   $('table').find('tr').each(function (index) {
        if($(this).attr('data-id') == id) {
            $('.update').find('input').eq(0).val($(this).find('td').eq(0).text())
            $('.update').find('input').eq(1).val($(this).find('td').eq(1).text())
            $('.update').find('input').eq(2).val($(this).find('td').eq(2).text())
            $('.update').find('input').eq(3).val($(this).find('td').eq(3).text())
            $('.update').find('input').eq(4).val(id)
        }
   })
}

