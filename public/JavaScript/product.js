/*  
    |---------------------------------------------------------------|
    |==================== Add Product functions ====================|
    |---------------------------------------------------------------|
*/

function addProduct() {
    let overlay = document.getElementById("overlay");
    let popup = document.getElementById("newProduct");

    let message = document.getElementById("msg");
    message.style.display = "none";
    message.style.margin = "0";
    message.style.padding = "10px";
    message.style.fontSize = "10px";
    message.style.color = "red";

    overlay.style.display = "block";
    popup.style.display = "flex";
}

function createInputField(labelText, inputType, inputName, inputPlaceholder) {
    const label = document.createElement("label");
    label.textContent = labelText;

    const input = document.createElement("input");
    input.type = inputType;

    if (inputType === "number") {
        input.min = 1;
    }
    input.name = inputName;
    input.placeholder = inputPlaceholder;
    input.required = true;

    return { label, input };
}

function updateVariationFields(number) {
    const variationsGroup = document.getElementById("variationsGroup");
    let message = document.getElementById("msg");
    variationsGroup.innerHTML = "";
    message.textContent = "";
    message.style.display = "none";
    const count = parseInt(number) || 0;
    if (number < 1) {
        message.style.display = "block";
        message.textContent = "Number Should be Greater then or equal to 1.";
    } else {
        for (let i = 0; i < count; i++) {
            const variationsDiv = document.createElement("div");
            variationsDiv.className = "variation-item";

            const productVariationDiv = document.createElement("div");
            productVariationDiv.className = "product-variation";

            const productPriceDiv = document.createElement("div");
            productPriceDiv.className = "product-price";

            const productVariation = createInputField(
                `Product Variation ${i + 1}`,
                "text",
                `productVariation${i + 1}`,
                `Product Variation ${i + 1}`
            );

            const priceVariation = createInputField(
                `Price ${i + 1}`,
                "number",
                `price${i + 1}`,
                `Price ${i + 1}`
            );

            productVariationDiv.appendChild(productVariation.label);
            productVariationDiv.appendChild(productVariation.input);

            productPriceDiv.appendChild(priceVariation.label);
            productPriceDiv.appendChild(priceVariation.input);

            variationsDiv.appendChild(productVariationDiv);
            variationsDiv.appendChild(productPriceDiv);

            variationsGroup.appendChild(variationsDiv);
        }
    }
}

function closeAddProduct() {
    let overlay = document.getElementById("overlay");
    let popup = document.getElementById("newProduct");

    overlay.style.display = "none";
    popup.style.display = "none";
}

/*  
|---------------------------------------------------------------|
|=================== Edit Product functions ====================|
|---------------------------------------------------------------|
*/

function editProduct(product, allProducts) {
    const overlay = document.getElementById("editOverlay");
    const popup = document.getElementById("editProduct");

    let count = 0;
    variations = [];
    prices = [];

    document.getElementById("pId").value = product.id;
    document.getElementById("pName").value = product.productName;

    allProducts.forEach((element) => {
        if (product.productName === element.productName) {
            variations.push(element.productVariation);
            prices.push(element.productPrice);
            count++;
        }
    });

    editUpdateVariationFields(count, variations, prices);

    overlay.style.display = "block";
    popup.style.display = "flex";
}

function editUpdateVariationFields(number, variations, prices) {
    const variationsGroup = document.getElementById("editVariationsGroup");
    variationsGroup.innerHTML = "";
    const count = parseInt(number) || 0;

    for (let i = 0; i < count; i++) {
        const variationsDiv = document.createElement("div");
        variationsDiv.className = "variation-item";

        const productVariationDiv = document.createElement("div");
        productVariationDiv.className = "product-variation";

        const productPriceDiv = document.createElement("div");
        productPriceDiv.className = "product-price";

        const productVariation = editCreateInputField(
            `Product Variation ${i + 1}`,
            "text",
            `productVariation${i + 1}`,
            `${variations[i]}`
        );

        const priceVariation = editCreateInputField(
            `Price ${i + 1}`,
            "number",
            `price${i + 1}`,
            `${prices[i]}`
        );

        productVariationDiv.appendChild(productVariation.label);
        productVariationDiv.appendChild(productVariation.input);

        productPriceDiv.appendChild(priceVariation.label);
        productPriceDiv.appendChild(priceVariation.input);

        variationsDiv.appendChild(productVariationDiv);
        variationsDiv.appendChild(productPriceDiv);

        variationsGroup.appendChild(variationsDiv);
    }
}

function editCreateInputField(labelText, inputType, inputName, inputValue) {
    const label = document.createElement("label");
    label.textContent = labelText;

    const input = document.createElement("input");
    input.type = inputType;
    input.name = inputName;
    input.value = inputValue;
    input.required = true;

    return { label, input };
}

function closeEditProduct() {
    let overlay = document.getElementById("editOverlay");
    let popup = document.getElementById("editProduct");

    overlay.style.display = "none";
    popup.style.display = "none";
}

/*  
    |---------------------------------------------------------------|
    |====================== other functions ========================|
    |---------------------------------------------------------------|
*/

const uploadUpdatedFile = document.getElementById("upload-update-file");
const filenamSpan = document.getElementById("namefile");
uploadUpdatedFile.addEventListener("change", function(e) {
    const fileNam = this.value.split("\\").pop();
    filenamSpan.textContent = fileNam ? fileNam : "No file chosen";
});

const uploadFile = document.getElementById("upload-file");
const filenameSpan = document.getElementById("filename");
const message = document.getElementById("message");

uploadFile.addEventListener("change", function(e) {
    const fileName = this.value.split("\\").pop();
    filenameSpan.textContent = fileName ? fileName : "No file chosen";
});