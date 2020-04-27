import CartRequests from "./cart-requests";

document.addEventListener('DOMContentLoaded', () => {

    const cartRequests = new CartRequests();

    const buyButtons = document.querySelectorAll('.buy button.btn');
    if (buyButtons.length) {
        const tasksLength = buyButtons.length;

        for (let i = 0; i < tasksLength; i++) {
            buyButtons[i].addEventListener("click", (event) => {
                event.preventDefault();
                const productId = event.currentTarget.getAttribute('data-product');
                const btn = event.currentTarget;

                btn.classList.add('loading');

                return axios.post(`/cart/add/${productId}`)
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

    const buyPlusButtons = document.querySelectorAll('.buy .buy-count-plus');
    const buyMinusButtons = document.querySelectorAll('.buy .buy-count-minus');
    const buyInputs = document.querySelectorAll('.buy input');
    const buyForms = document.querySelectorAll('.buy form');

    if (buyPlusButtons.length && buyMinusButtons.length) {
        const cartListCountButtonsLength = buyPlusButtons.length;
        const buyMinusButtonsLength = buyMinusButtons.length;
        const buyInputsLength = buyInputs.length;
        const buyFormsLength = buyForms.length;

        const cacheValues = [];
        for (let i = 0; i < buyInputsLength; i++) {
            buyInputs[i].addEventListener("change", (event) => {
                const intValue = parseInt(event.currentTarget.value);
                const productId = event.currentTarget.closest('.s').getAttribute('data-product');

                cacheValues[i] = intValue ? Math.abs(intValue) : cacheValues[i];
                event.currentTarget.value = intValue ? Math.abs(intValue) : cacheValues[i];

                return cartRequests.update()
            });
            cacheValues[i] = buyInputs[i].value;
        }

        for (let i = 0; i < cartListCountButtonsLength; i++) {
            buyPlusButtons[i].addEventListener("click", (event) => {
                const input = event.currentTarget.closest('form').querySelector('input');
                input.value = parseInt(input.value) + 1;
                cacheValues[i] = input.value;
            });
        }

        for (let i = 0; i < buyMinusButtonsLength; i++) {
            buyMinusButtons[i].addEventListener("click", (event) => {
                const input = event.currentTarget.closest('form').querySelector('input');
                input.value = parseInt(input.value) <= 1
                    ? 1
                    : parseInt(input.value) - 1;

                cacheValues[i] = input.value;
            });
        }

        for (let i = 0; i < buyFormsLength; i++) {
            buyForms[i].addEventListener("submit", (event) => event.preventDefault());
        }
    }
});
