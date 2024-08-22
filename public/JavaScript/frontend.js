// Utility function to toggle class
function toggleClass(elementSelector, className) {
    var element = document.querySelector(elementSelector);
    if (element) {
        element.classList.toggle(className);
    } else {
        console.error('Element not found: ' + elementSelector);
    }
}

// Front model functionality
document.addEventListener("DOMContentLoaded", function() {
    window.closeFrontModel = function() {
        var frontModel = document.querySelector(".frontmodel");
        frontModel.classList.add("hidden");
        toggleClass(".whole", "active");
        document.getElementById('overlay').style.display = "none";
        document.body.style.overflow = "initial";
    };

    document.body.style.overflow = "hidden";
});

// Open product in popup
document.addEventListener('DOMContentLoaded', (event) => {
    const imgboxes = document.querySelectorAll('.imgbox');
    const popup = document.getElementById('popup');
    const popupImg = document.getElementById('popup-img');
    const popupTitle = document.getElementById('popup-title');
    const popupPrice = document.getElementById('popup-price');
    // const dropdownRs = document.getElementById('rs');
    // const originalprice = document.getElementById('originalprice');
    // const addtocartprice = document.getElementById('cart-price');
    const overlay = document.createElement('div');
    overlay.id = 'popup-overlay';

    document.body.appendChild(overlay);

    // imgboxes.forEach((imgbox) => {
    //     const addToCartButton = imgbox.querySelector('.cartbtn');

    //     if (addToCartButton) {
    //         addToCartButton.addEventListener('click', (event) => {
    //             event.stopPropagation(); // Prevent the event from bubbling up

    //             const imgSrc = imgbox.querySelector('img').src;
    //             const productName = imgbox.querySelector('.product_name').innerText;
    //             const productPrice = imgbox.querySelector('.product_price').innerText;
    //             document.getElementById('closeButton').style.display = 'block';
    //             document.querySelector(".popwhole").style.filter = "blur(2px)";
    //             document.querySelector(".popwhole").style.pointerEvents = "none";
    //             document.body.style.overflow = "hidden";

    //             popupImg.src = imgSrc;
    //             popupTitle.innerText = productName;
    //             popupPrice.innerText = productPrice;
    //             // dropdownRs.innerText = productPrice;
    //             // originalprice.innerText = productPrice;
    //             // addtocartprice.innerText=productPrice;
    //             popup.style.display = 'block';
    //             overlay.style.display = 'block';
    //         });
    //     }
    // });

    overlay.addEventListener('click', () => {
        popup.style.display = 'none';
        overlay.style.display = 'none';

    });
});

// Dropdown function
function toggleDropdown() {
    const dropdownContent = document.getElementById('dropdown-content');
    const arrow = document.querySelector('.arrow');

    if (dropdownContent.classList.contains('active')) {
        dropdownContent.classList.remove('active');
        arrow.classList.remove('active');
    } else {
        dropdownContent.classList.add('active');
        arrow.classList.add('active');
    }
}

// // Popclose function
// function closePopup() {
//     document.getElementById('popup').style.display = 'none';
//     document.getElementById('closeButton').style.display = 'none';
//     document.querySelector(".popwhole").style.filter = 'initial';
//     document.querySelector(".popwhole").style.pointerEvents = "auto";
//     document.body.style.overflow = "initial";
// }

// Show and hide login
document.getElementById('profileImg').onclick = function() {
    document.getElementById('overlay').style.display = "block";
    document.getElementById('logincomponent').style.display = "flex";
    toggleClass(".whole", "active");
    document.querySelector(".temp").style.display = "block";
    // document.querySelector(".temp").style.filter = "blur(3px)";
    document.querySelector(".temp").style.pointerEvents = "none";
    document.body.style.overflow = "hidden";
};

document.querySelector('.close').onclick = function() {
    document.getElementById('overlay').style.display = "none";
    document.getElementById('logincomponent').style.display = "none";
    toggleClass(".whole", "active");
    document.querySelector(".temp").style.pointerEvents = "auto";
    document.body.style.overflow = "initial";
};

// Show and hide signup
document.querySelector('.signbtn').onclick = function() {
    document.getElementById('signupcomponent').style.display = "flex";
    document.getElementById('logincomponent').style.display = "none";
    document.body.classList.add("no-scroll");
};

document.querySelector('.closee').onclick = function() {
    document.getElementById('overlay').style.display = "none";
    document.getElementById('signupcomponent').style.display = "none";
    toggleClass(".whole", "active");
    document.querySelector(".temp").style.pointerEvents = "auto";
    document.body.classList.remove("no-scroll");
};

document.querySelector('.alraccount').onclick = function() {
    document.getElementById('signupcomponent').style.display = "none";
    document.getElementById('logincomponent').style.display = "flex";
    document.body.classList.add("no-scroll");
};

// Cart functionality