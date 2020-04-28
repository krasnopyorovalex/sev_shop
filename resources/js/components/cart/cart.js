import CartRequests from "./cart-requests";

document.addEventListener('DOMContentLoaded', () => {

    const cartRequests = new CartRequests();
    const hCartCount = document.querySelector('header .h-cart-count');
    const panelInfo = document.querySelector('.panel-info');
    const formOrderBtn = document.querySelector('.form-order button[type=submit]');

    const buyButtons = document.querySelectorAll('.buy button.btn');
    if (buyButtons.length) {
        const tasksLength = buyButtons.length;

        for (let i = 0; i < tasksLength; i++) {
            buyButtons[i].addEventListener("click", (event) => {
                event.preventDefault();
                const productId = event.currentTarget.getAttribute('data-product');
                const btn = event.currentTarget;

                btn.classList.add('loading');

                const boxBuy = event.currentTarget.closest('.buy');

                return cartRequests.add(productId, btn, boxBuy, hCartCount);
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

                return cartRequests.remove(productId, btn, hCartCount, panelInfo);
            });
        }
    }

    const buyPlusButtons = document.querySelectorAll('.buy .buy-count-plus');
    const buyMinusButtons = document.querySelectorAll('.buy .buy-count-minus');
    const buyInputs = document.querySelectorAll('.buy input');
    const buyForms = document.querySelectorAll('.buy form');

    if (buyPlusButtons.length && buyMinusButtons.length) {
        const buyPlusButtonsLength = buyPlusButtons.length;
        const buyMinusButtonsLength = buyMinusButtons.length;
        const buyInputsLength = buyInputs.length;
        const buyFormsLength = buyForms.length;

        const cacheValues = [];
        for (let i = 0; i < buyInputsLength; i++) {
            buyInputs[i].addEventListener("change", (event) => {
                const intValue = parseInt(event.currentTarget.value);
                const cartListItem = event.currentTarget.closest('.cart-list-item');

                event.currentTarget.value = intValue ? Math.abs(intValue) : cacheValues[i];

                const valueToServer = event.currentTarget.value >= cacheValues[i]
                    ? event.currentTarget.value - cacheValues[i]
                    : (cacheValues[i] - event.currentTarget.value) * -1;

                cacheValues[i] = intValue ? Math.abs(intValue) : cacheValues[i];

                return cartRequests.update(cartListItem, valueToServer, hCartCount, panelInfo, formOrderBtn);
            });
            cacheValues[i] = buyInputs[i].value;
        }

        for (let i = 0; i < buyPlusButtonsLength; i++) {
            buyPlusButtons[i].addEventListener("click", (event) => {
                const input = event.currentTarget.closest('form').querySelector('input');
                const cartListItem = event.currentTarget.closest('.cart-list-item');

                input.value = parseInt(input.value) + 1;

                const valueToServer = input.value - cacheValues[i];

                cacheValues[i] = input.value;

                return cartRequests.update(cartListItem, valueToServer, hCartCount, panelInfo, formOrderBtn);
            });
        }

        for (let i = 0; i < buyMinusButtonsLength; i++) {
            buyMinusButtons[i].addEventListener("click", (event) => {
                const input = event.currentTarget.closest('form').querySelector('input');
                const cartListItem = event.currentTarget.closest('.cart-list-item');

                input.value = parseInt(input.value) <= 1
                    ? 1
                    : parseInt(input.value) - 1;

                const valueToServer = cacheValues[i] - input.value;

                cacheValues[i] = input.value;

                return cartRequests.update(cartListItem, valueToServer * -1, hCartCount, panelInfo, formOrderBtn);
            });
        }

        for (let i = 0; i < buyFormsLength; i++) {
            buyForms[i].addEventListener("submit", (event) => event.preventDefault());
        }
    }
});
