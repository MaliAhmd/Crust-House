function addDealToCart(deal, deals, allProducts) {
    let dealProducts = [];

    let pizzaVariation = [];
    let drinkVariation = [];
    let pizzaAddon = [];
    let pizzaAddonPrice = [];
    let dealPizzaVariation = null;
    let dealDrink = null;
    
    deals.forEach((element) => {
        if (element.deal_id === deal.deal_id) {
            dealProducts.push({
                product: element.product,
                product_quantity: element.product_quantity
            });
        }
    });
    
    let productDetails ;
    
    productDetails = dealProducts.map(
            (product) => `${product.product_quantity} ${product.product.productName} (${product.product.productVariation}) `
        )
        .join(", ");
    document.getElementById("deal_popup-dealName").innerHTML = productDetails;
    console.log(dealProducts);
    
    dealProducts.forEach((product) => {
        if (product.product.category_name.toLowerCase() == "pizza") {
            dealPizzaVariation = product.product.productVariation;
        }

        if (product.product.category_name.toLowerCase() == "drinks") {
            dealDrink = product.product.productVariation;
        }
    });
    
    
    allProducts.forEach((element) => {
        if (
            element.category_name.toLowerCase() == "pizza" &&
            element.productVariation == dealPizzaVariation
        ) {
            pizzaVariation.push(element.productName);
        }

        if (
            element.category_name.toLowerCase() == "addons" &&
            element.productVariation == dealPizzaVariation
        ) {
            pizzaAddon.push(element.productName);
            pizzaAddonPrice.push(element.productPrice);
        }

        if (
            element.category_name.toLowerCase() == "drinks" &&
            element.productVariation == dealDrink
        ) {
            drinkVariation.push(element.productName);
        }
    });

    let addons = {
        addonVariation: pizzaAddon,
        addonPrice: pizzaAddonPrice,
    };
    updateDealOption(deal.deal, pizzaVariation, drinkVariation, addons);
    // Create the deal object to store in the cart
   
}

function updateDealOption(deal, pizzaVariation, drinkVariation, pizzaAddon,  productDetails ) {
    const popup = document.getElementById("dealPopup");
    const popupImg = document.getElementById("deal_popup-img");
    const popupTitle = document.getElementById("deal_popup-title");
    const popupPrice = document.getElementById("deal_popup-price");
    const dealcartbtn = document.getElementById("dealaddcart");

    const overlay = document.getElementById("overlay");

    popupImg.src = `Images/DealImages/${deal.dealImage}`;
    popupTitle.innerText = deal.dealTitle;
    popupPrice.innerText = `Rs. ${deal.dealDiscountedPrice.replace(
        /pkr\s*/i,
        ""
    )}`;
    document.getElementById("originalprice").textContent =
        deal.dealDiscountedPrice.replace(/pkr\s*/i, "");
    document.getElementById("cart-price").textContent =
        deal.dealDiscountedPrice.replace(/pkr\s*/i, "");


        dealcartbtn.innerHTML = `
        <div>
            <span id="originalpricee" style="display: none;">${deal.dealDiscountedPrice.replace(/pkr\s*/i, "")}</span>
            <span id="cart-pricee">${deal.dealDiscountedPrice.replace(/pkr\s*/i, "")}</span>
        </div>
        <div>Add to Cart</div>
    `;

    overlay.style.display = "block";
    popup.style.display = "block";
    document.body.classList.add("no-scroll");
    document.body.style.overflow = "hidden";

    document.getElementById("closeDealButton").style.display = "block";
    document.querySelector(".popwhole").style.pointerEvents = "none";

    if (
        (pizzaVariation == null || pizzaVariation.length === 0) &&
        (pizzaAddon["addonVariation"] == null ||
            pizzaAddon["addonVariation"].length === 0) &&
        (drinkVariation == null || drinkVariation.length === 0)
    ) {
        // showAlert("No deal to show.");
        document.getElementById("extra_55").style.display = "none";
        document.getElementById("extra_45").style.display = "none";
        document.getElementById("extra_65").style.display = "none";
    } else {
        if (
            pizzaVariation != null &&
            pizzaVariation.length > 0 &&
            pizzaAddon != null &&
            pizzaAddon.addonVariation.length > 0
        ) {
            dealPizzaVariation(pizzaVariation);
            dealPizzaAddons(pizzaAddon);
            dealDrinks(drinkVariation);

            document.getElementById("extra_55").style.display = "flex";
            document.getElementById("extra_45").style.display = "flex";
            document.getElementById("extra_65").style.display = "flex";
        } else if (drinkVariation != null && drinkVariation.length > 0) {
            dealDrinks(drinkVariation);
            document.getElementById("extra_55").style.display = "none";
            document.getElementById("extra_45").style.display = "none";
            document.getElementById("extra_65").style.display = "flex";
        }
    }
    //  const dealObject = {
    //     dealName: deal.dealTitle,
    //     dealPrice: deal.dealDiscountedPrice,
    //     dealOriginalPrice: deal.dealDiscountedPrice,
    //     dealProduct: productDetails,
    //     dealQuantity: quantity, // You can adjust this based on the quantity selected
    // };

    // let cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];

    // // Create a cartItem specifically for the deal
    // const cartItem = {
    //     name: null, // Nullify regular item properties
    //     originalPrice: null,
    //     price: null,
    //     quantity: null,
    //     imgSrc: null,
    //     variation: null,
    //     variationPrice: null,
    //     topping: null,
    //     deal: dealObject // Store the deal object here
    // };

    // cartItems.push(cartItem);

    // localStorage.setItem("cartItems", JSON.stringify(cartItems));
}

function dealPizzaVariation(pizzaVariation) {
    console.log(pizzaVariation);
    
    const dropdownContainer = document.querySelector(".dealDrop");
    dropdownContainer.innerHTML = "";

    pizzaVariation.forEach((variation, index) => {
        const dropdown2 = document.createElement("div");
        dropdown2.className = "dropdown_2";

        const radioDiv = document.createElement("div");
        const radioInput = document.createElement("input");
        radioInput.type = "radio";
        radioInput.name = "option";
        radioInput.dataset.price = "0";
        radioInput.id = `variation-${index}`;
        radioInput.onclick = () => {
            document
                .querySelectorAll('input[name="addon"]')
                .forEach((checkbox) => {
                    checkbox.checked = false;
                });
            updatePricee(radioInput);
        };
        if (index === 0) {
            updatePricee(radioInput);
        }
        radioDiv.appendChild(radioInput);
        dropdown2.appendChild(radioDiv);

        const dropdown3 = document.createElement("div");
        dropdown3.className = "dropdown_3";

        const sizeSpan = document.createElement("span");
        sizeSpan.className = "sizee";
        sizeSpan.innerText = variation;
        dropdown3.appendChild(sizeSpan);
        dropdown2.appendChild(dropdown3);
        dropdownContainer.appendChild(dropdown2);
    });
}

function dealPizzaAddons(pizzaAddon) {
    const addonsContainer = document.querySelector(".dealAddonDrop");
    addonsContainer.innerHTML = "";
    let addonVariation = pizzaAddon["addonVariation"];
    let addonPriceDeal = pizzaAddon["addonPrice"];

    addonVariation.forEach((addon, index) => {
        const dropdown2 = document.createElement("div");
        dropdown2.className = "dropdown_2";

        const checkboxDiv = document.createElement("div");
        const checkboxInput = document.createElement("input");
        checkboxInput.type = "radio";
        checkboxInput.name = "option";
        checkboxInput.id = `addon-${index}`;
        checkboxInput.value = addonPriceDeal[index];
        checkboxInput.dataset.price = addonPriceDeal[index];
        checkboxInput.onclick = () => {
            updatePricee(checkboxInput);
        };
        checkboxDiv.appendChild(checkboxInput);
        dropdown2.appendChild(checkboxDiv);

        const dropdown3 = document.createElement("div");
        dropdown3.className = "dropdown_3";

        const addonSpan = document.createElement("span");
        addonSpan.className = "addon-name";
        addonSpan.innerText = addon;

        const priceSpan = document.createElement("span");
        priceSpan.className = "rs";
        priceSpan.innerText = `Rs. ${addonPriceDeal[index]}`;

        dropdown3.appendChild(addonSpan);
        dropdown3.appendChild(priceSpan);
        dropdown2.appendChild(dropdown3);
        addonsContainer.appendChild(dropdown2);
    });
}

function dealDrinks(drinkFlavour) {
    console.log(drinkFlavour);
    const drinkContainer = document.querySelector(".dealDrinkDrop");
    drinkContainer.innerHTML = "";

    drinkFlavour.forEach((flavour, index) => {
        const dropdown2 = document.createElement("div");
        dropdown2.className = "dropdown_2";

        const checkboxDiv = document.createElement("div");
        const checkboxInput = document.createElement("input");
        checkboxInput.type = "radio";
        checkboxInput.name = "drink_flavour";
        checkboxInput.id = `drink-${index}`;
        checkboxInput.dataset.price = "0";
        checkboxInput.onclick = () => {
            updatePricee(checkboxInput);
        };
        checkboxDiv.appendChild(checkboxInput);
        dropdown2.appendChild(checkboxDiv);

        const dropdown3 = document.createElement("div");
        dropdown3.className = "dropdown_3";

        const addonSpan = document.createElement("span");
        addonSpan.className = "addon-name";
        addonSpan.innerText = flavour;
        dropdown3.appendChild(addonSpan);
        dropdown2.appendChild(dropdown3);
        drinkContainer.appendChild(dropdown2);
    });
}

let quantity=1;
function increaseQuantityy() {
    quantity++;
    updateQuantityDisplay();
    updatePricee();  // Update price based on new quantity
}

function decreaseQuantityy() {
    if (quantity > 1) {  // Prevent quantity from going below 1
        quantity--;
        updateQuantityDisplay();
        updatePricee();  // Update price based on new quantity
    }
}


function updateQuantityDisplay() {
    document.getElementById("quantityy").textContent = quantity;
}

function updatePricee() {
    // Get the base price from the element
    const basePrice = parseInt(document.getElementById("originalpricee").textContent);
    let totalPrice = basePrice * quantity;

    // Add price of selected pizza variation
    const selectedPizzaVariation = document.querySelector('input[name="option"]:checked');
    if (selectedPizzaVariation) {
        totalPrice += parseInt(selectedPizzaVariation.dataset.price || 0) * quantity;
    }

    // Add price of selected pizza addons
    const selectedAddons = document.querySelectorAll('input[name="addon"]:checked');
    if (selectedAddons.length > 0) {
        selectedAddons.forEach((addon) => {
            totalPrice += parseFloat(addon.dataset.price || 0) * quantity;
        });
    } else {
        // No addons selected, default to 0
        totalPrice += 0;
    }

    // Add price of selected drinks
    const selectedDrink = document.querySelector('input[name="drink_flavour"]:checked');
    if (selectedDrink) {
        totalPrice += parseInt(selectedDrink.dataset.price || 0) * quantity;
    }

    // Update the total price display
    document.getElementById("cart-pricee").textContent = `Rs. ${totalPrice}`;
}

