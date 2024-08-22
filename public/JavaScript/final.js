// Function to handle clicks outside the cart and close it
// document.addEventListener('click', function(event) {
//     const cart = document.getElementById('cart');
//     const cartIcon = document.getElementById('locimgg');
//     const frontModel = document.querySelector('.frontmodel');
//     const isClickInsideCart = cart.contains(event.target);
//     const isClickOnIcon = cartIcon.contains(event.target);
//     const isClickInsideFrontModel = frontModel && frontModel.contains(event.target);
//     const isClickOnDeleteBtn = event.target.classList.contains('cart-delete-btn'); // Exclude delete button clicks
//     const isClickOnQuantityBtn = event.target.classList.contains('q_btn'); // Exclude quantity buttons clicks

//     if (!isClickInsideCart && !isClickOnIcon && !isClickInsideFrontModel && !isClickOnDeleteBtn && !isClickOnQuantityBtn) {
//         cart.classList.remove('active');
//         document.body.classList.remove("no-scroll");
//         // document.querySelector(".whole").style.pointerEvents = "auto";
//         // document.querySelector(".whole").style.filter = "initial";
//     }
//     document.getElementById('overlay').style.display = 'none';
// });

// Function to update the cart item price based on the quantity
function updateCartItemPrice1() {
    const quantity = parseInt(document.getElementById('quantity').innerText);
    const totalPrice = selectedPrice * quantity;
    document.getElementById('cart-price').innerText = `Rs. ${totalPrice.toFixed(0)}`;
}

// Function to increase the quantity of an item
function increaseQuantity() {
    const quantityElement = document.getElementById('quantity');
    let quantity = parseInt(quantityElement.innerText);
    quantity += 1;
    quantityElement.innerText = quantity;
    updateCartItemPrice1(); // Update price based on new quantity
}

// Function to decrease the quantity of an item
function decreaseQuantity() {
    const quantityElement = document.getElementById('quantity');
    let quantity = parseInt(quantityElement.innerText);
    if (quantity > 1) {
        quantity -= 1;
        quantityElement.innerText = quantity;
        updateCartItemPrice1(); // Update price based on new quantity
    }
}

// Function to handle adding items to the cart
function handleCartButtonClick() {
    const title = document.getElementById('popup-title').innerText;
    const imageSrc = document.getElementById('popup-img').src;
    const price = parseInt(document.getElementById('cart-price').innerText.replace('Rs. ', '').replace(',', ''));
    const Originalprice = parseInt(document.getElementById('originalprice').innerText.replace('Rs. ', '').replace(',', ''));
    const quantity = parseInt(document.getElementById('quantity').innerText);
    const selectedOption = document.querySelector('input[name="option"]:checked');
    const selectedSizeElement = selectedOption.closest('.dropdown_2').querySelector('.sizee');
    const selectedVariation = selectedSizeElement ? selectedSizeElement.innerText.trim() : 'No variation selected';
    const variationPrice = parseInt(document.querySelector('input[name="option"]:checked').getAttribute('value'));

    let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

    // Check if the item already exists in the cart
    let existingCartItemIndex = -1;
    cartItems.forEach((item, index) => {
        if (item.name === title && item.variation === selectedVariation) {
            existingCartItemIndex = index;
        }
    });
    const cartItem = {
        name: title,
        originalPrice: Originalprice,
        price: price,
        quantity: quantity,
        imgSrc: imageSrc,
        variation: selectedVariation,
        variationPrice: variationPrice
    };

    if (existingCartItemIndex !== -1) {
        cartItems[existingCartItemIndex].quantity += quantity;
        cartItems[existingCartItemIndex].price = cartItems[existingCartItemIndex].variationPrice * cartItems[existingCartItemIndex].quantity;
        console.log(existingCartItemIndex);
    } else {
        console.log(existingCartItemIndex);
        cartItems.push(cartItem);
    }
    // Create a cart item object


    // Get existing cart items from local storage

    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    showMessage();
    closeAddToCart();
}

// Function to toggle the visibility of the cart
function toggleCart() {
    const cart = document.getElementById('cart');
    if (cart.classList.contains('active')) {
        cart.classList.remove('active');
        document.body.classList.remove("no-scroll");
        document.querySelector(".whole").style.pointerEvents = "auto";
        // document.querySelector(".whole").style.filter = "initial";
        document.getElementById('overlay').style.display = 'none';
    } else {
        openCartSidebar();
        cart.classList.add('active');
        document.body.classList.add("no-scroll");
        document.body.style.overflow = "hidden";

        document.getElementById('overlay').style.display = 'block';
        document.querySelector(".whole").style.pointerEvents = "none";
        // document.querySelector(".whole").style.filter = "blur(2px)";
    }
}



function openCartSidebar() {
    updateCartUI();
}

function showMessage() {
    const msgElement = document.querySelector(".msg");

    msgElement.classList.add("show");
    setTimeout(() => {
        msgElement.classList.remove("show");
        msgElement.classList.add("hide");
    }, 1000);

    setTimeout(() => {
        msgElement.classList.remove("hide");
    }, 1000);
}

// Function to update the cart UI based on local storage
function updateCartUI() {
    const cartItemsContainer = document.querySelector('#cart .cartitems');
    cartItemsContainer.innerHTML = ''; // Clear current items
    var cart = document.querySelector(".cart_clear");
    cart.style.display = "block";
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

    if (cartItems.length === 0) {
        document.querySelector('.emptycart').style.display = 'block';
        document.querySelector('.total').style.display = 'none';
        document.querySelector('.cart_clear').style.display = 'none';
    } else {
        document.querySelector('.emptycart').style.display = 'none';
        document.querySelector('.total').style.display = 'flex';
    }

    const img = `${window.location.origin}/Images/OnlineOrdering/delete.png`;

    cartItems.forEach((item, index) => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.innerHTML = `
            <img src="${item.imgSrc}" alt="${item.name}" class="cart-item-img">
            <div class="cart-item-info">
                <span class="cart-item-name">${item.name}</span>
                <span class="cart-item-price" data-original-price="${item.originalPrice}">${item.price}</span>
                <span class="variation">Variation: ${item.variation}</span>
                <div class="cart-items-quantity">
                    <div class="cart-quantity">
                        <button class="q_btn decrease" data-index="${index}">-</button>
                        <div class="quantity">${item.quantity}</div>
                        <button class="q_btn increase" data-index="${index}">+</button>
                    </div>
                    <div class="delbtn">
                        <img class="delete_img" src="${img}" alt="">
                    </div>
                </div>
            </div>
        `;
        cartItemsContainer.appendChild(cartItem);
        attachDeleteHandler(cartItem, index);
    });

    document.body.classList.add("no-scroll");
    // document.querySelector(".whole").style.filter = "blur(2px)";
    updateCartTotals();

    // Add event listeners to quantity buttons
    document.querySelectorAll('.q_btn.decrease').forEach(button => {
        button.addEventListener('click', decreaseCartItemQuantity);
    });
    document.querySelectorAll('.q_btn.increase').forEach(button => {
        button.addEventListener('click', increaseCartItemQuantity);
    });
}

let selectedPrice = 500;

function updatePrice(selectedRadio) {
    console.log('Selected value:', selectedRadio.value);
    selectedPrice = parseInt(selectedRadio.value);
    console.log(selectedPrice);
    document.getElementById('cart-price').innerText = 'Rs. ' + selectedPrice;

    // Reset quantity to 1 when variation changes
    document.getElementById('quantity').innerText = '1';
}



// clear button code
document.querySelector('.cart_clear').onclick = function() {
    document.querySelector('.clear').style.display = "block";
    document.querySelector('.cart_part1').style.filter = "blur(3px)";

};

document.addEventListener('DOMContentLoaded', function() {
    var clearButton = document.querySelector('.clear_Cart_itens');
    var cancelButton = document.querySelector('.cancel');
    document.querySelector('.clearbtn').addEventListener('click', function() {
        localStorage.removeItem('cartItems'); // Remove all cart items from local storage
        updateCartUI(); // Update UI to reflect changes
        document.querySelector('.clear').style.display = "none";
        document.querySelector('.cart_clear').style.display = "none";
        document.querySelector('.emptycart').style.display = "flex";
        document.querySelector('.total').style.display = "none";
        document.querySelector('.cart_part1').style.filter = "initial";
    });
    document.querySelector('.cancel').addEventListener('click', function() {
        document.querySelector(".clear").style.display = 'none';
        document.querySelector('.cart_part1').style.filter = "initial";
    });
});

function updateCartTotals() {
    var subtotal = 0;
    document.querySelectorAll('#cart .cart-item').forEach(function(cartItem) {
        var itemPrice = parseFloat(cartItem.querySelector('.cart-item-price').innerText.replace(/[^0-9.]/g, ''));
        var quantity = parseInt(cartItem.querySelector('.quantity').innerText);
        subtotal += itemPrice;
    });

    var deliveryCharges = 0; // Adjust delivery charges if applicable
    var grandTotal = subtotal + deliveryCharges;

    document.querySelector('.subtotal span:last-child').innerText = 'Rs ' + subtotal.toFixed(2);
    document.querySelector('.delichrge span:last-child').innerText = 'Rs ' + deliveryCharges.toFixed(2);
    document.querySelector('.grandtotal span:last-child').innerText = 'Rs ' + grandTotal.toFixed(2);

    var cart = document.querySelector(".cart_clear");
    var emptyCart = document.querySelector('.emptycart');
    if (subtotal > 0) {
        document.querySelector('.total').style.display = 'flex';
        if (emptyCart) {
            emptyCart.style.display = 'none';
        }
    } else {
        document.querySelector('.total').style.display = 'none';
        if (emptyCart) {
            emptyCart.style.display = 'flex';
        }
    }
}

function decreaseCartItemQuantity(event) {
    const index = event.target.dataset.index;
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const cartItem = cartItems[index];

    if (cartItem.quantity > 1) {
        cartItem.quantity -= 1;
        cartItem.price = cartItem.variationPrice * cartItem.quantity;
        updateCartItemInLocalStorage(index, cartItem);
        updateCartUI();
    }
}

function increaseCartItemQuantity(event) {
    const index = event.target.dataset.index;
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const cartItem = cartItems[index];

    cartItem.quantity += 1;
    cartItem.price = cartItem.variationPrice * cartItem.quantity;
    updateCartItemInLocalStorage(index, cartItem);
    updateCartUI();
}

function updateCartItemInLocalStorage(index, updatedItem) {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    cartItems[index] = updatedItem;
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
}

function attachDeleteHandler(cartItem, index) {
    var deleteButton = cartItem.querySelector('.delete_img');
    deleteButton.classList.add('cart-delete-btn');
    deleteButton.addEventListener('click', function() {
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        // Remove item at the given index
        cartItems.splice(index, 1);
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        updateCartUI(); // Refresh the cart UI
    });
}