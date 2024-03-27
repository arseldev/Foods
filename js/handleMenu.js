const price = document.querySelectorAll(".price");
const buttonMenu = document.querySelectorAll(".button-menu");
const menuName = document.querySelectorAll(".menu-name");
const orderCount = document.querySelector(".order-count");

let savedMenuList = JSON.parse(localStorage.getItem("selectedMenuList")) || [];

updateButtonStatus();
updateOrderCount();

price.forEach((p) => {
  p.textContent = rupiah(p.textContent);
});

buttonMenu.forEach((button, index) => {
  if (button.textContent.trim() === "Added") {
    button.classList.add("button-added");
  }

  button.addEventListener("click", () => {
    button.classList.toggle("button-added");
    const name = menuName[index].textContent;

    if (button.classList.contains("button-added")) {
      button.setAttribute("disabled", true);
      button.textContent = "Added";
      savedMenuList.push({
        name: name,
        price: price[index].textContent,
      });
    } else {
      button.textContent = "Add to cart";
      const indexToRemove = savedMenuList.indexOf(name);
      if (indexToRemove !== -1) {
        savedMenuList.splice(indexToRemove, 1);
      }
    }

    localStorage.setItem("selectedMenuList", JSON.stringify(savedMenuList));
    updateOrderCount();
  });
});

function updateButtonStatus() {
  buttonMenu.forEach((button, index) => {
    const name = menuName[index].textContent;
    if (savedMenuList.some((menu) => menu.name === name)) {
      button.classList.add("button-added");
      button.setAttribute("disabled", true);
      button.textContent = "Added";
    }
  });
}

function updateOrderCount() {
  orderCount.textContent = savedMenuList.length;
}
