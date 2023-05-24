// Shows the appropriate type-specific attribute container when the product type is changed
function changeProductType() {
  // Get the product type and type-specific attribute containers
  var productType = document.getElementById("productType").value;
  var sizeContainer = document.getElementById("sizeContainer");
  var weightContainer = document.getElementById("weightContainer");
  var dimensionsContainer = document.getElementById("dimensionsContainer");

  // Hide all type-specific attribute containers
  sizeContainer.classList.add("hide");
  weightContainer.classList.add("hide");
  dimensionsContainer.classList.add("hide");

  // Remove the 'required' attribute from all type-specific attribute containers
  document.getElementById("size").required = false;
  document.getElementById("weight").required = false;
  document.getElementById("height").required = false;
  document.getElementById("width").required = false;
  document.getElementById("length").required = false;

  // Show the appropriate type-specific attribute container
  if (productType == "DVD") {
    sizeContainer.classList.remove("hide");
    document.getElementById("size").required = true;
    console.log("setting DVD required");
    console.log(document.getElementById("size").required);


  } else if (productType == "Book") {
    weightContainer.classList.remove("hide");
    document.getElementById("weight").required = true;
  } else if (productType == "Furniture") {
    dimensionsContainer.classList.remove("hide");
    document.getElementById("height").required = true;
    document.getElementById("width").required = true;
    document.getElementById("length").required = true;
  }
}


