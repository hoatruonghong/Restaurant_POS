// dishes
const dishes = [
    {
        id: 0,
        type: 1,
        name: "Cheeseburger",
        price: 50000,
        nutrient_info:"Không có thông tin",
        additives:"Không có thông tin",
        food_decoration: "Không có thông tin",
        side_dishes: [
            {
                sname:"Khoai tây chiên",
                sprice: 20000
            }
        ],
        srcImg:"images/hamburger.png"
    },
    {
        id: 1,
        type: 2,
        name: "Coca",
        price: 12000,
        nutrient_info:"Không có thông tin",
        additives:"Không có thông tin",
        food_decoration: "Không có thông tin",
        side_dishes: [],
        srcImg:"images/coca.png"
    },
    {
        id: 3,
        type: 3,
        name: "Nước cam ép",
        price: 30000,
        nutrient_info:"Không có thông tin",
        additives:"Không có thông tin",
        food_decoration: "Không có thông tin",
        side_dishes: [],
        srcImg:"images/orangejuice.png"
    },
    {
        id: 4,
        type: 4,
        name: "Mì ý",
        price: 60000,
        nutrient_info:"Không có thông tin",
        additives:"Không có thông tin",
        food_decoration: "Không có thông tin",
        side_dishes: [
            {
                sname:"Khoai tây chiên",
                sprice: 20000
            }
        ],
        srcImg:"images/spaghetti.png"
    },
    {
        id: 5,
        type: 4,
        name: "Mì ý đặc biệt",
        price: 80000,
        nutrient_info:"Không có thông tin",
        additives:"Không có thông tin",
        food_decoration: "Không có thông tin",
        side_dishes: [
            {
                sname:"Rau",
                sprice: 20000
            }
        ],
        srcImg:"images/sspaghetti.png"
    },
    {
        id: 6,
        type: 5,
        name: "Bánh kem sô cô la",
        price: 30000,
        nutrient_info:"Không có thông tin",
        additives:"Không có thông tin",
        food_decoration: "Không có thông tin",
        side_dishes: [],
        srcImg:"images/cake.png"
    },
    ];
    
    //types
    const types = [
    {
        name:"Tất cả",
        type: 0,
        srcImg:"images/allfood.png"
    },
    {
        name: "Burger",
        type: 1,
        srcImg:"images/hamburger.png"
    },
    {
        name: "Coca",
        type: 2,
        srcImg:"images/coca.png"
    },
    {
        name: "Nước ép",
        type: 3,
        srcImg:"images/orangejuice.png"
    },
    {
        name: "Mỳ Ý",
        type: 4,
        srcImg:"images/spaghetti.png"
    },
    {
        name: "Tráng miệng",
        type: 5,
        srcImg:"images/cake.png"
    },

    ];


let count = 1;
// cart array


// SELECT ELEMENTS
const dishesEl = document.querySelector(".main-menu");
const cartItemsEl = document.querySelector(".order-list");
const subtotalEl = document.querySelector(".subtotal");
const taxtotalEl = document.querySelector('.totaltax');
const categoryEl = document.querySelector("#category");
const foodInfo = document.querySelector(".food-info-modal");




//render category
function renderCategory(){

    types.forEach((type) => {
        categoryEl.innerHTML += `
        <div id = "${type.type}" onClick = "renderMenu(${type.type})" style="margin-right: 25px;margin-left: 5px;">
            <div class="card border-0 shadow ">
                <img src="${type.srcImg}" class="card-img-top m-auto" style="height: 105px; width: 135px;" >
                <div class="card-body">
                    <div class="card-title text-center">
                        <b style="color:#2C3A57;font-size:13pt;">${type.name}</b>
                    </div>
                </div>
            </div>
        </div>
        `;
    });
}

renderCategory();
$(document).ready(function(){
    $(".owl-carousel").owlCarousel();
  });

//render menu
function renderMenu(typeID){
    foodInfo.innerHTML="";
    const menuItems = document.querySelector(".main-menu");
    menuItems.innerHTML = "";
    dishes.forEach((dish) => {
        if(dish.type == typeID || typeID == 0){
            menuItems.innerHTML += `
            <div class="col-sm-4 col-6" style="padding-bottom: 15px;">
                    <div class="card main-item" data-bs-toggle="modal" data-bs-target="#sp${dish.id}">
                        <img class="card-img-top card-img-top-main" style="height: 135px; width: 135px;"  src="${dish.srcImg}" alt="Card image">
                        <div class="card-body card-body-bottom">
                            <h4 class="card-title"><span class="price">
                            ${dish.id}. 
                            </span>${dish.name}</h4>
                            <hr>
                            <h4 class="price">${dish.price} đ</h4>
                            <img class="cart-icon" src="images/cart1.png" onclick="addToCart(${dish.id})">
                        </div>
                    </div>
                </div>
            `;
            renderFoodInfo(dish);
        }
    });
}
renderMenu(0);

//render modal food informatiion
function renderFoodInfo(dish){    
    foodInfo.innerHTML+=`
    <div class="modal fade" id="sp${dish.id}" tabindex="-1" aria-labelledby="ItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <div class="modal-header">
          <b class="modal-title" style="color:#2C3A57;font-size:15pt;">THÔNG TIN MÓN ĂN</b>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="modal-img-container" style="margin-left:30px;">
            <img src="${dish.srcImg}" alt="${dish.name}" style="height: 180px;padding: left 10px;">
          </div>
          <div class="modal-info">
            <div class="row">
                <div class="col-sm-3">
                    <b style="color:#2C3A57;font-size:13pt;">Mã món ăn</b><br>
                    <p style="font-size:12pt; margin-top: 5px;">${dish.id}</p>
                </div>
                <div class="col-sm-6">
                    <b style="color:#2C3A57;font-size:13pt;">Tên món ăn</b><br>
                    <p style="font-size:12pt;margin-top: 5px;">${dish.name}</p>
                </div>
                <div class="col-sm-3" style="text-align: right;">
                    <b style="color:#2C3A57;font-size:13pt;">Đơn giá</b><br>
                    <b style="color:red;font-size:18pt;">${dish.price} đ</b>
                </div>
            </div>
            <hr style="margin-top: 5px; color: #C4C4C4;">
            <div class="row">
                <div class="col-sm-8">
                    <b style="color:#2C3A57;font-size:15pt;">Số lượng</b><br>
                </div>
                <div class="col-sm-4" style="text-align: right;">
                    <button type="button" class="quantity-btn" onclick="changeNumberOfUnits('minus', ${dish.id})">-</button>
                        <span style="padding: 0 5px;font-size:15pt;">1</span>
                    <button type="button" class="quantity-btn" onclick="changeNumberOfUnits('plus', ${dish.id})">+</button>
                </div>
            </div>
            <hr style="margin-top: 15px; color: #C4C4C4;">
            <div class="row">
                <div class="col-sm-4">
                    <b style="color:#2C3A57;font-size:12pt;">Thông tin dinh dưỡng: </b>
                </div>
                <div class="col-sm-8">
                    <p style="font-size:12pt;">${dish.nutrient_info}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <b style="color:#2C3A57;font-size:12pt;">Phụ gia: </b>
                </div>
                <div class="col-sm-8">
                    <p style="font-size:12pt;">${dish.additives}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <b style="color:#2C3A57;font-size:12pt;">Trang trí món ăn: </b>
                </div>
                <div class="col-sm-8">
                    <p style="font-size:12pt;">${dish.food_decoration}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <b style="color:#2C3A57;font-size:12pt;">Yêu cầu đặc biệt: </b>
                    <p style="color:#2C3A57;font-size:10pt;">(Không bắt buộc)</p>
                </div>
                <div class="col-sm-8">
                    <textarea id="note" class="form-control" aria-label="With textarea" placeholder="VD: không bỏ hành"></textarea>
                </div>
            </div>
            <b style="color:#2C3A57;font-size:12pt;">Món ăn kèm</b>
            <p id="temp_${dish.id}">Quý khách có thể chọn một số món ăn kèm sau đây:</p>
            <div class="form-check" id="side-dishes_${dish.id}">
                
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="addToCart(${dish.id})" class="btn btn-default btn-add" data-bs-dismiss="modal" style="height: 40px;width: 70%;background-color:rgb(235, 235, 156);text-align: center;color: white;background-color: red;">
            <p><img style="height: 30px;" src="images/cart1.png"/><b style="font-size:12pt;margin-left:2%;">Thêm vào đơn hàng</b></p></button>
        </div>
      </div>
    </div>
  </div>
    `;
    const temp = document.getElementById("side-dishes_"+dish.id);
    if(dish.side_dishes.length == 0){
        document.getElementById("temp_"+dish.id).innerHTML="Không có món ăn kèm theo"
    }
    else{
        let i = -1;
        dish.side_dishes.forEach((sdish)=>{
            i = i + 1;
            temp.innerHTML+=`
            <input class="form-check-input" type="checkbox" value="" id="sdish_${i}">
            <label class="form-check-label" for="sdish_${i}" style="color:#2C3A57;font-size:12pt;">${sdish.sname}</label>
            `;
        });  
    }      
}

let cart = JSON.parse(localStorage.getItem("CART")) || [];
updateCart();


// ADD TO CART
function addToCart(id) {
  // check if prodcut already exist in cart
  if (cart.some((item) => item.id === id)) {
    changeNumberOfUnits("plus", id);
  } else {
    const item = dishes.find((dish) => dish.id === id);
    
    cart.push({
      ...item,
      numberOfUnits: 1,
    });
    console.log(cart);
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
            <div class="row g-0">
                <div class="col-2" style="display: flex;justify-content: center;">
                    <img src="${item.srcImg}" class="rounded-start dish-img" alt="coca">
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


//Search by name

//render search menu
function renderSearchMenu(dish){    
    const menuItems = document.querySelector(".main-menu");
    menuItems.innerHTML += `
            <div class="col-sm-4 col-6" style="padding-bottom: 15px;">
                    <div class="card main-item" data-bs-toggle="modal" data-bs-target="#sp${dish.id}">
                        <img class="card-img-top card-img-top-main" style="height: 135px; width: 135px;"  src="${dish.srcImg}" alt="Card image">
                        <div class="card-body card-body-bottom">
                            <h4 class="card-title"><span class="price">
                            ${dish.id}. 
                            </span>${dish.name}</h4>
                            <hr>
                            <h4 class="price">${dish.price} đ</h4>
                            <img class="cart-icon" src="images/cart1.png">
                        </div>
                    </div>
                </div>
            `;
    renderFoodInfo(dish);
}

function searchByFoodName(){
    let foodName = String(document.getElementById("SearchByName").value);
    const menuItems = document.querySelector(".main-menu");
    menuItems.innerHTML = "";
    foodInfo.innerHTML="";
    dishes.forEach((dish)=>{
        if(dish.name.search(foodName) != -1){
            renderSearchMenu(dish);
        }
    });
}