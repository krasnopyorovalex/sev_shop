class CartRequests {

    update = (productId, quantity) => {
        return axios.post(`cart/update/${productId}/${quantity}`)
            .then(function () {

            })
            .catch(function (error) {
                console.log(error);
            });
    }
}

export default CartRequests;
