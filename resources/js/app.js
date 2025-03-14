import './bootstrap';

$(document).ready(function () {
    $('#per_page')?.on('change', function (e) {
        $(this).parents('form')?.submit()
    })

    $('.product-qty').on('change', function () {
      $(this).parent().submit()
    })

    $('.product-card-buy').on('click', function(e) {
        e.preventDefault()

        const url = $(this).data('action')

        axios.post(url, {})
            .then((response) => {
                const { data } = response
                iziToast.success({
                    message: data.message,
                    position: 'topRight'
                })
                $('#cartCountBadge').html(data.cart_count)
            })
            .catch((error) => {
                const { data } = error
                console.error(error)

                iziToast.error({
                    message: data.message,
                    position: 'topRight'
                })
            })
    })
})