$(document).ready(function() {
    $('#ModalquickView').on('show.bs.modal', function(e) {
        //get data-id attribute of the clicked element
        var id = $(e.relatedTarget).data('id');
        var sku = $(e.relatedTarget).data('sku');
        var name = $(e.relatedTarget).data('name');
        var image = $(e.relatedTarget).data('image');
        var description = $(e.relatedTarget).data('description');
        var notes = $(e.relatedTarget).data('notes');
        var price = $(e.relatedTarget).data('price');
        var currency = $(e.relatedTarget).data('currency-name');
        var url = $(e.relatedTarget).data('url');
        var qty = $(e.relatedTarget).data('qty');
        var colors = $(e.relatedTarget).data('colors');
        var sizes = $(e.relatedTarget).data('sizes');

        //populate the textbox
        $(e.currentTarget).find('#element-id').text(id);
        $(e.currentTarget).find('#element-sku').text(sku);
        $(e.currentTarget).find('#element-image').attr('src', image);
        $(e.currentTarget).find('#element-name').text(name);
        $(e.currentTarget).find('#element-description').text(description);
        $(e.currentTarget).find('#element-notes').text(notes);
        $(e.currentTarget).find('#element-price').text(price);
        $(e.currentTarget).find('#element-currency-name').text(currency);
        $(e.currentTarget).find('#element-qty').text(qty);
        $(e.currentTarget).find('#element-url').attr('href', url);
        $(e.currentTarget).find('#element-colors').text(colors);
        $(e.currentTarget).find('#element-sizes').text(sizes);
    });

    // Product Page --> add Product to Cart
    // OnChanging Size DropDown
    // $('[id^="size-"]').on('change', function(e) {
    //     productId = $(this).attr('data-element-id');
    //     $(`a[id^=color-id-]`).addClass('d-none');
    // $(`a[id^="color-id-`).attr('qty', '');
    //     $(`li[class^=color-id-element]`).removeClass('active');
    //     // reset the max-qty
    //     $(`#max-qty-${productId}`).attr('size', 1);
    //     $(`#max-qty-${productId}`).attr('value', 1);
    //     $(`#add_to_cart_${productId}`).attr('disabled', 'disabled');
    //     size_id = e.target.value;
    //     product_id = $(`#product_id_${productId}`).attr('value');
    //     $(`input[name=size_id_${productId}]`).attr('value', size_id);
    //     // reset the qty input
    //     $(`input[name=qty_${productId}]`).attr('value', 1);
    //     return axios.get('/api/qty', {params: {size_id, product_id}}).then(r => {
    //         if (r.data.length >= 1) {
    //             $(`#color-${productId}`).removeClass('d-none');
    //             _.each(r.data, (e, i) => {
    //                 console.log('the',e);
    //                 color_element = $(`#color-id-${productId}-${e.color_id}`);
    //                 color_element.removeClass('d-none');
    //                 color_element.attr('data-qty', e.qty);
    //                 color_element.attr('data-product-attribute-id', e.id);
    //             });
    //         }
    //     }).catch(e => console.log(e));
    // });
    //
    // $('a[id^="color-id-"]').on('click', function(e) {
    //     color_id = $(this).data('color-id');
    //     qty = $(this).data('qty');
    //     product_attribute_id = $(this).data('product-attribute-id');
    //     $(`#max-qty-${productId}`).attr('size', qty);
    //     $(`input[id=color_id_${productId}]`).attr('value', color_id);
    //     $(`input[id=size_id_${productId}]`).attr('value', size_id);
    //     $(`input[id=product_attribute_id_${productId}]`).attr('value', product_attribute_id);
    //     $(`#add_to_cart_${productId}`).attr('disabled', false);
    // });
    //
    $(`[id^=plus-btn]`).on('click', function() {
        productId = $(this).data('product-id');
        let qty = $(`input[id=qty_${productId}]`);
        currentQty = Number(qty.attr('value'));
        maxSize = Number($(`#max-qty-${productId}`).attr('size'));
        newQty = Number(_.sum([currentQty, 1]));
        if (newQty <= maxSize) {
            qty.attr('value', newQty);
            $(`#max-qty-${productId}`).attr('value', newQty);
            $(`#max-qty-${productId}`).attr('placeholder', newQty);
        }
    })

    $(`[id^=minus-btn]`).on('click', function() {
        productId = $(this).data('product-id');
        let qty = $(`input[id=qty_${productId}]`);
        currentQty = parseInt(qty.attr('value'));
        maxSize = Number($(`#max-qty-${productId}`).attr('size'));
        newQty = _.sum([currentQty, -1]);
        if (newQty <= maxSize  && newQty > 0) {
            qty.attr('value', newQty);
            $(`#max-qty-${productId}`).attr('value', newQty);
            $(`#max-qty-${productId}`).attr('placeholder', newQty);
        }
    })
});
