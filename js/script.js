// prices for different options (flavour, size, topping)
const flavourPrices = {
  strawberry: 4.99,
  none: 0,
  chocolate: 5.99,
  banana: 3.50,
  mango: 4.99,
  blueberry: 4.29
};

const sizePrices = {
  small: 0,
  none: 0,
  medium: 1.50,
  large: 2.50,
};

const toppingPrices = {
  none: 0,
  granola: 0.50,
  slicedAlmonds: 0.80,
  chocolateChips: 0.50,
  pumpkinSeeds: 0.20
};

let tempFlavor = 0;
let tempSize = 0;
let tempToppings = 0;




//function for geting the form values when the place-order button is clicked by the user
function orderSmoothie() {
  const flavor = document.getElementById('flavor').value;
  const size = document.getElementById('size').value;
  const toppings = document.getElementById('toppings').value;
  const specialInstructions = document.getElementById('specialInstructions').value;

  //condition for checking if the user has selected flavour and size | if not alerting the user to select
  if (flavor == 'none' || size == 'none') {
    alert("Please select flavour and size!");
    refreshPage();
  }
  //function to handle description and total section when user inputs nothing and then the aler comes up then some random message will be shown in the bill area
  function refreshPage() {
    location.reload();
  }
  //function for calculating total
  const totalPrice = totalPriceCalculator(flavor, size, toppings);
  document.getElementById("total").textContent = totalPrice.toFixed(2);



  //smoothie object constructor
  const smoothie = new Smoothie(flavor, size, toppings, specialInstructions);
  //console.log("Smoothie Object:", smoothie);

  //function for creating the description to be displayed to the user
  const smoothieDescription = smoothie.getDescription();
  //displaying the description to the user
  document.getElementById("smoothieDescription").textContent = smoothieDescription;
  //function for clearing the form once the user hits place-order button
  //clearForm();

}
//clears the form, sets the html fields to default and also sets the temp variables to zero which were used to capture the prices
function clearForm() {
  document.getElementById(`smoothieForm`).reset();
  document.getElementById(`dynamicContent`).textContent = '0.00';
  document.getElementById(`smoothieDescription`).textContent = "";
  document.getElementById(`total`).textContent = "";
  tempFlavor = 0;
  tempSize = 0;
  tempToppings = 0;
}
//total price calculation
function totalPriceCalculator(flavor, size, toppings) {
  let totalPrice = flavourPrices[flavor] + sizePrices[size] + toppingPrices[toppings];
  return totalPrice;
}
//object
class Smoothie {
  constructor(flavor, size, toppings, specialInstructions) {
    this.flavor = flavor;
    this.size = size;
    this.toppings = toppings;
    this.specialInstructions = specialInstructions;
  }

  //function declaration for crafting the description to be displayed based on users selection
  getDescription() {
    let description = `You Ordered a ${this.size} ${this.flavor} smoothie   `;
    if (this.toppings == 'none') {
      description += ``;
    } else {
      description += `topped with ${this.toppings}`;
    }
    if (this.specialInstructions) {
      description += `,with the special instruction '${this.specialInstructions}' `;
    }

    return description;
  }
}

//functions for dynamically displaying the total price while the user select different options
function dynamicPriceFlavour() {
  const flavor = document.getElementById('flavor').value;
  price = flavourPrices[flavor];
  updatePrice(price, 'flavor');
}
function dynamicPriceSize() {
  const size = document.getElementById('size').value;
  price = sizePrices[size];
  updatePrice(price, 'size');
}
function dynamicPriceTopping() {
  const topping = document.getElementById('toppings').value;
  price = toppingPrices[topping];
  updatePrice(price, 'toppings');
}


function updatePrice(price, option) {
  let newPrice = price;
  dynamicPrice(newPrice, option);
}

function dynamicPrice(newPrice, option) {
  switch (option) {
    case 'flavor':
      tempFlavor = newPrice;
      break;
    case 'size':
      tempSize = newPrice;
      break;
    case 'toppings':
      tempToppings = newPrice;
      break
  }
  let updatedPrice = tempFlavor + tempSize + tempToppings;
  document.getElementById("dynamicContent").textContent = updatedPrice.toFixed(2);
}
