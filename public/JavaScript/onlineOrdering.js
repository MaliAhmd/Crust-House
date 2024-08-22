function addToCart(product, allProducts) {
    const popup = document.getElementById('popup');
    const popupImg = document.getElementById('popup-img');
    const popupTitle = document.getElementById('popup-title');
    const popupPrice = document.getElementById('popup-price');
    const dropdownContainer = document.querySelector('.drop');

    const productArray = Object.values(allProducts);
    let productPrices = [];
    let productVariations = [];

    // Clear previous dropdown options
    dropdownContainer.innerHTML = '';

    productArray.forEach((element) => {
        if (element.productName === product.productName) {
            productPrices.push(element.productPrice);
            productVariations.push(element.productVariation);
        }
    });

    // Create dropdown options dynamically
    productVariations.forEach((variation, index) => {
        const dropdown2 = document.createElement('div');
        dropdown2.className = 'dropdown_2';

        const radioDiv = document.createElement('div');
        const radioInput = document.createElement('input');
        radioInput.type = 'radio';
        radioInput.name = 'option';
        radioInput.value = productPrices[index];
        radioInput.onclick = () => updatePrice(radioInput);
        if (index === 0) radioInput.checked = true;

        radioDiv.appendChild(radioInput);
        dropdown2.appendChild(radioDiv);

        const dropdown3 = document.createElement('div');
        dropdown3.className = 'dropdown_3';

        const sizeSpan = document.createElement('span');
        sizeSpan.className = 'sizee';
        sizeSpan.innerText = variation;

        const priceSpan = document.createElement('span');
        priceSpan.className = 'rs';
        priceSpan.innerText = `Rs. ${productPrices[index]}`;

        dropdown3.appendChild(sizeSpan);
        dropdown3.appendChild(priceSpan);
        dropdown2.appendChild(dropdown3);

        dropdownContainer.appendChild(dropdown2);
    });

    // Update popup content
    popupImg.src = `Images/ProductImages/${product.productImage}`;
    popupTitle.innerText = product.productName;
    popupPrice.innerText = productPrices[0]; // Set initial price based on the first option
    // Set initial price based on the first option
    document.getElementById("originalprice").textContent = product.productPrice;
    document.getElementById("cart-price").textContent = product.productPrice;

    overlay.style.display = "block";
    popup.style.display = "block";
    document.body.classList.add("no-scroll");
    document.body.style.overflow = "hidden";

    document.getElementById("closeButton").style.display = "block";
    document.querySelector(".popwhole").style.pointerEvents = "none";
}


function closeAddToCart() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('popup').style.display = 'none';
    document.querySelector(".popwhole").style.pointerEvents = "auto";
    document.body.style.overflow = "initial";
}

// Check if the 'overlay' element exists
// Ensure the overlay element exists
document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('overlay');
    if (overlay) {
        overlay.addEventListener('click', () => {
            const cart = document.getElementById('cart');
            if (cart.classList.contains('active')) {
                cart.classList.remove('active');
                document.body.classList.remove("no-scroll");
                document.querySelector(".whole").style.pointerEvents = "auto";
                // document.querySelector(".whole").style.filter = "initial";
                overlay.style.display = 'none';
            }
            document.body.classList.add("no-scroll");
            document.body.style.overflow = "initial";
        });
    } else {
        console.error('Overlay element not found.');
    }
});