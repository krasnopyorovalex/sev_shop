document.addEventListener('DOMContentLoaded', () => {

    const buyButtons = document.querySelectorAll('.buy button.btn');

    if (buyButtons.length) {
        const tasksLength = buyButtons.length;

        for (let i = 0; i < tasksLength; i++) {
            buyButtons[i].addEventListener("click", (event) => {
                event.preventDefault();
                const productId = event.currentTarget.getAttribute('data-product');
                const count = event.currentTarget.closest('.buy').querySelector('input');

                return axios.post(`cart/add/${productId}`, {'count': parseInt(count.value)})
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            });
        }
    }
});
