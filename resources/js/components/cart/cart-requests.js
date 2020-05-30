class CartRequests {

    add(productId, btn, boxBuy, hCartCount) {
        axios.post(`/cart/add/${productId}`)
            .then(function (response) {
                btn.classList.remove('loading');
                return response.data;
            })
            .then(function (data) {
                hCartCount.innerText = data.quantity;
                boxBuy.insertAdjacentHTML('afterend', data.message);
                const infoCart = document.querySelector('.cart-add-info');
                return setTimeout(() => {
                    return infoCart.remove();
                }, 2000);
            })
            .catch(function () {
                return btn.classList.remove('loading');
            });
    }

    update (cartListItem, quantity, hCartCount, panelInfo = null, formOrderBtn = null) {
        const productId = cartListItem.getAttribute('data-product');

        axios.post(`cart/update/${productId}/${quantity}`)
            .then(function (response) {
                return response.data;
            })
            .then(function (data) {
                if (panelInfo) {
                    panelInfo.querySelector('.total-value').innerText = data.total;
                    panelInfo.querySelector('.cart-list-item-quantity').innerText = data.quantity;
                }

                const totalInt = parseFloat(data.total);
                formOrderBtn.disabled = !(formOrderBtn && totalInt >= 1000);

                cartListItem.querySelector('.cart-list-item-sum .value').innerText = data.productPrice;

                return hCartCount.innerText = data.quantity;
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    remove(productId, btn, hCartCount, panelInfo = null) {
        axios.post(`cart/remove/${productId}`)
            .then(function (response) {
                btn.closest('.cart-list-item').remove();

                return response.data;
            })
            .then(function (data) {
                if (panelInfo) {
                    panelInfo.querySelector('.total-value').innerText = data.total;
                    panelInfo.querySelector('.cart-list-item-quantity').innerText = data.quantity;
                }
                return hCartCount.innerText = data.quantity;
            })
            .catch(function (error) {
                console.log(error);
            });
    }
}

export default CartRequests;
