function handleModal() {
  const modalMenu = document.getElementById("modalMenu");

  modalMenu.addEventListener("shown.bs.modal", function () {
    const modalBody = document.querySelector(".modal-body");
    let content = "";

    console.log(savedMenuList);

    savedMenuList.forEach((item) => {
      content += `
            <p class="selected-name">${item.name}</p>
            <p class="selected-price">${item.price}</p>
          `;
    });

    if (savedMenuList.length > 0) {
      modalBody.innerHTML = content;
    } else {
      modalBody.innerHTML = `
            <p class="selected-name">No item selected</p>
          `;
    }
  });
}

document.addEventListener("DOMContentLoaded", handleModal);
