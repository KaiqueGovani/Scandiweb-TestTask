function changeProductType() {
    var productType = document.getElementById("productType").value;
    var sizeContainer = document.getElementById("sizeContainer");
    var weightContainer = document.getElementById("weightContainer");
    var dimensionsContainer = document.getElementById("dimensionsContainer");

    // Hide all type-specific attribute containers
    sizeContainer.classList.add("hide");
    weightContainer.classList.add("hide");
    dimensionsContainer.classList.add("hide");

    // Show the appropriate type-specific attribute container
    if (productType == "DVD") {
        sizeContainer.classList.remove("hide");
    } else if (productType == "Book") {
        weightContainer.classList.remove("hide");
    } else if (productType == "Furniture") {
        dimensionsContainer.classList.remove("hide");
    }
}