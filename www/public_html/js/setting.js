let htmlInputPhone = `<input type="text" class="uk-input mask contact-value" data-inputmask="'mask': '+7 (999)9999999'">`;
let htmlInputEmail = `<input type="text" class="uk-input mask contact-value" data-inputmask="'mask': '*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]'">`;

$(function() {


    // Отправка формы и сбор данных текущих
    $('#add').on('click', function (e) {
        e.preventDefault();

        // myString = myString.replace(/\D/g,'');

        let array = [];
        $('.uk-contacts-wrap .item-contact').each(function() {
            let id = $(this).find('.contact-id').val();
            let type = $(this).find('.contact-type').val();
            let val = $(this).find('.contact-value').val();


            if (val == '') return;

            if (type == 'phone') {
                array.push({
                    id: id,
                    type: type,
                    val: val.replace(/\D/g,'')
                });
            } else if (type == 'email') {
                array.push({
                    id: id,
                    type: type,
                    val: val
                });
            }
        })

        $('#contacts').val(encodeURIComponent(JSON.stringify(array)))

        // Собираем данные контактов
        $(this).parents('form').submit();
    })

    $('#addContact').on('click', function (e) {
        e.preventDefault();

        $('.uk-contacts-wrap').append(`            
            <div class="uk-grid item-contact">
                <div class="uk-width-1-4">
                    <select name="" class="uk-select contact-type">
                        <option value="phone">Телефон</option>
                        <option value="email">Емейл</option>
                    </select>
                    <input type="hidden" class="contact-id" />
                </div>
                <div class="uk-width-1-2 item-contact-value">
                    ${htmlInputPhone}
                </div>
                <div class="uk-width-1-5">
                    <a href="" class="uk-contacts-delete"><span class="uk-margin-small-right uk-text-danger" uk-icon="icon: close; ratio: 2"></span></a>
                </div>
            </div>
        `);

        Inputmask().mask(document.querySelectorAll(".mask"));
    })

    $(document).on('click', '.uk-contacts-delete', function (e) {
        e.preventDefault();
        $(this).parents('.item-contact').remove();
    })

    $(document).on('change', '.contact-type', function (e) {
        e.preventDefault();
        if ($(this).val() == 'phone') {
            $(this).parents('.item-contact').find('.item-contact-value').html(htmlInputPhone)
        } else {
            $(this).parents('.item-contact').find('.item-contact-value').html(htmlInputEmail)
        }
        Inputmask().mask(document.querySelectorAll(".mask"));
    })

    Inputmask().mask(document.querySelectorAll(".mask"));

})