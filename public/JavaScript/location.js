// 33.786080201690936, 72.72

const http = new XMLHttpRequest();
const apiKey = "4b18909ba78c4a439b61458413f4f159"; // Your OpenCage API key

document.querySelector(".btnloc").addEventListener("click", () => {
    findmylocation();
});

let formattedAddress = "";
let city = "";
let state = "";
let district = "";

function SelectLocation() {
    var frontModel = document.querySelector(".frontmodel");
    frontModel.classList.add("hidden");
    toggleClass(".whole", "active");
    document.body.style.overflow = "initial";
    selectLocation(formattedAddress);

    document.getElementById("overlay").style.display = "none";
}

function findmylocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const Api = `https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=${apiKey}`;
                getAPI(Api);
            },
            (err) => {
                console.error("Error:", err.message);
                alert("Error: " + err.message);
            }, {
                enableHighAccuracy: true, // Request high accuracy
                timeout: 10000, // Timeout in milliseconds (10 seconds)
                maximumAge: 0, // Do not use cached data
            }
        );
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function getAPI(Api) {
    http.open("GET", Api);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const result = JSON.parse(this.responseText);
            console.log(result);
            if (result.results && result.results.length > 0) {
                district = result.results[0].components.county;
                city = result.results[0].components.municipality;
                state = result.results[0].components.state;
                formattedAddress = result.results[0].formatted;
                document.querySelector("#district").value = district;
                document.querySelector("#address").value = formattedAddress;
            } else {
                console.log("No results found");
            }
        } else if (this.readyState == 4) {
            console.error("API request failed:", this.statusText);
        }
    };
}

function selectLocation(formattedAddress) {
    const hello = document.querySelector("#addr");
    hello.textContent = formattedAddress;
}