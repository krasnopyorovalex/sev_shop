document.addEventListener('DOMContentLoaded', () => {

    const buyButtons = document.querySelectorAll('.buy button.btn');
    if (buyButtons.length) {
        const tasksLength = buyButtons.length;

        for (let i = 0; i < tasksLength; i++) {
            buyButtons[i].addEventListener("click", (event) => {
                event.preventDefault();
                const productId = event.currentTarget.getAttribute('data-product');
                const btn = event.currentTarget;

                btn.classList.add('loading');

                return axios.post(`cart/add/${productId}`)
                    .then(function (response) {
                        console.log(response);
                        btn.classList.remove('loading');
                    })
                    .catch(function (error) {
                        btn.classList.remove('loading');
                        console.log(error);
                    });
            });
        }
    }

    const cartRemoveButtons = document.querySelectorAll('.cart-list .btn-remove');
    if (cartRemoveButtons.length) {
        const cartRemoveButtonsLength = cartRemoveButtons.length;

        for (let i = 0; i < cartRemoveButtonsLength; i++) {
            cartRemoveButtons[i].addEventListener("click", (event) => {
                const btn = event.currentTarget;
                const productId = btn.getAttribute('data-product');

                return axios.post(`cart/remove/${productId}`)
                    .then(function () {
                        return btn.closest('.cart-list-item').remove();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            });
        }
    }

    const cartListPlusButtons = document.querySelectorAll('.cart-list .buy-count-plus');
    const cartListMinusButtons = document.querySelectorAll('.cat-list .buy-count-minus');

    if (cartListPlusButtons.length && cartListMinusButtons.length) {
        const cartListCountButtonsLength = cartListPlusButtons.length;

        for (let i = 0; i < cartListCountButtonsLength; i++) {
            cartListPlusButtons[i].addEventListener("click", (event) => {
                //const btn = event.currentTarget;
                console.log('clicked');
            });
        }
    }

    // var buy = jQuery(".buy");
    // if (buy.length) {
    //     buy.on("click", ".buy-count-minus", function () {
    //             var input = jQuery(this).next("input");
    //             var value = parseInt(input.val()) > 1 ? parseInt(input.val()) - 1 : 1;
    //
    //             return input.val(value);
    //     });
    //     buy.on("click", ".buy-count-plus", function () {
    //             var input = jQuery(this).prev("input");
    //             var value = parseInt(input.val()) + 1;
    //
    //             return input.val(value);
    //     });
    //     buy.on("keyup", "input", function () {
    //         return jQuery(this).val(jQuery(this).val().replace(/\D+/g,""));
    //     });
    //     buy.on("blur", "input", function () {
    //         var intValue = parseInt(jQuery(this).val());
    //         var value = intValue ? Math.abs(intValue) : 1;
    //
    //         return jQuery(this).val(value);
    //     });
    // }
});
