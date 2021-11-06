const dishes = [
  {
    id: 0,
    stt: 1,
    name: "Hamburger",
    price: 50000,
    imgSrc: "images/hamburger.png",
  },

  {
    id: 1,
    stt: 2,
    name: "Spaghetti",
    price: 30000,
    imgSrc: "images/spaghetti.png",
  },

  {
    id: 2,
    stt: 3,
    name: "Coca",
    price: 10000,
    imgSrc: "images/coca.png",
  },

  {
    id: 3,
    stt: 4,
    name: "Salad",
    price: 10000,
    imgSrc: "images/salad.png",
  },

  {
    id: 4,
    stt: 5,
    name: "Orange juice",
    price: 10000,
    imgSrc: "images/orangejuice.png",
  },

  {
    id: 5,
    stt: 6,
    name: "Sspaghetti",
    price: 50000,
    imgSrc: "images/sspaghetti.png",
  },
];
let count = 1;


// SELECT ELEMENTS
const dishesEl = document.querySelector(".main-menu");
const cartItemsEl = document.querySelector(".order-list");
const subtotalEl = document.querySelector(".subtotal");
const taxtotalEl = document.querySelector('.totaltax');

// RENDER dishes
function renderProdcuts() {
  dishes.forEach((dish) => {
    dishesEl.innerHTML += `
            <div class="col-sm-4 col-6" style="padding-bottom: 15px;">
                <div class="card main-item" onclick="addToCart(${dish.id})">
                    <img class="card-img-top card-img-top-main" style="width: 60%;"  src="${dish.imgSrc}" alt="Card image">
                    <div class="card-body card-body-bottom">
                        <h4 class="card-title"><span class="price">
                            ${dish.stt}. 
                        </span>${dish.name}</h4>
                        <hr>
                        <h4 class="price">${dish.price}đ</h4>
                        <img class="cart-icon" src="images/cart1.png" ></img>
                    </div>
                </div>
            </div>
        `;
  });
}
renderProdcuts();

// cart array
let cart = JSON.parse(localStorage.getItem("CART")) || [];
updateCart();

// ADD TO CART
function addToCart(id) {
  console.log(cart);
  // check if prodcut already exist in cart
  if (cart.some((item) => item.id === id)) {
    changeNumberOfUnits("plus", id);
  } else {
    const item = dishes.find((dish) => dish.id === id);

    cart.push({
      ...item,
      numberOfUnits: 1,
    });
  }

  updateCart();
}

// update cart
function updateCart() {
  renderCartItems();
  renderSubtotal();

  // save cart to local storage
  localStorage.setItem("CART", JSON.stringify(cart));
}

// calculate and render subtotal
function renderSubtotal() {
  let totalPrice = 0;
  let totalTax = 0;

  cart.forEach((item) => {
    totalPrice += item.price * item.numberOfUnits;
  });
  totalTax = totalPrice / 10;
  

  subtotalEl.innerHTML = `${totalPrice}đ`;
  `"(Thuế GTGT 10% = ${totalTax})"`
  taxtotalEl.innerHTML =  `(Thuế GTGT 10% = ${totalTax})`;
}


// render cart items
function renderCartItems() {
  cartItemsEl.innerHTML = ""; // clear cart element
  count = 1;
  cart.forEach((item) => {
    
    cartItemsEl.innerHTML += `
        <div class="card">
            <div class="row">
                <div class="col-2" style="display: flex; justify-content: center; align-items: center;">
                    <img src="${item.imgSrc}" class="rounded-start dish-img" alt="coca">
                </div>
                <div class="col-10">
                    <div class="card-body">
                        <h4 class="card-title"><span class="price">${ count }. </span> ${item.name}
                            <span onclick="removeItemFromCart(${item.id})"><img class="close-icon" src="images/close.png"></img></span></h4>


                        <div class="card-text">
                            <button type="button" class="quantity-btn" onclick="changeNumberOfUnits('minus', ${item.id})">-</button>
                            <span >${item.numberOfUnits}</span>
                            <button type="button" class="quantity-btn" onclick="changeNumberOfUnits('plus', ${item.id})">+</button>
                            <div style="display: flex; flex-direction: column;">
                            <h4 class="price" style="text-align: right;">${item.price}</h4>
                            <p> (Thuế GTGT 10% = 2.300đ)</p>
                            </div> 

                        </div>

                    </div>
                </div>
            </div>
        </div>
      `;
    count = count + 1;
  });
}

// remove item from cart
function removeItemFromCart(id) {
  cart = cart.filter((item) => item.id !== id);

  updateCart();
}

// change number of units for an item
function changeNumberOfUnits(action, id) {
  cart = cart.map((item) => {
    let numberOfUnits = item.numberOfUnits;

    if (item.id === id) {
      if(action === "minus" && numberOfUnits === 1)
          removeItemFromCart(id);
      if (action === "minus" && numberOfUnits > 1) {
        numberOfUnits--;
      } else if (action === "plus") {
        numberOfUnits++;
      }
    }

    return {
      ...item,
      numberOfUnits,
    };
  });

  updateCart();
}
