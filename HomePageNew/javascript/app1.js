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


//select elements
const categoryEl = document.querySelector("#category");
const foodInfo = document.querySelector(".food-info-modal");

//render category
function renderCategory(){
    types.forEach((type) => {
        categoryEl.innerHTML += `
        <div class="item mb-4" id = "${type.type}" onClick = "renderMenu(${type.type})">
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
                        <img class="card-img-top card-img-top-main" style="width: 60%;"  src="${dish.srcImg}" alt="Card image">
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
    });
}

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
                    <button type="button" class="quantity-btn">-</button>
                        <span style="padding: 0 5px;font-size:15pt;">1</span>
                    <button type="button" class="quantity-btn">+</button>
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
            <p>Quý khách có thể chọn một số món ăn kèm sau đây:</p>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault" style="color:#2C3A57;font-size:12pt;">Rau</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-add" data-bs-dismiss="modal" style="height: 40px;width: 70%;background-color:rgb(235, 235, 156);text-align: center;color: white;background-color: red;">
            <p><img style="height: 30px;" src="images/cart1.png"/><b style="font-size:12pt;margin-left:2%;">Thêm vào đơn hàng</b></p></button>
        </div>
      </div>
    </div>
  </div>
    `;
    
}