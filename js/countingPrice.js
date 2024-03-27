const reverseRupiah = (rupiah) => {
  const cleaned = rupiah.replace(/[^\d,]/g, "");
  const normalized = cleaned.replace(/\./g, "").replace(/,/g, ".");
  const number = parseFloat(normalized);
  return number;
};

document.addEventListener("DOMContentLoaded", function () {
  const selectedCounts = document.querySelectorAll(".selected-count");

  let initialTotalPrice = 0;
  selectedCounts.forEach(function (selectedCount) {
    const quantity = parseInt(selectedCount.value);
    const pricePerItem = parseFloat(
      reverseRupiah(
        selectedCount.closest(".d-flex").querySelector(".price").textContent
      )
    );
    initialTotalPrice += quantity * pricePerItem;
    selectedCount.dataset.oldvalue = quantity;
  });
  updateTotalPrice(initialTotalPrice);

  selectedCounts.forEach(function (selectedCount) {
    selectedCount.addEventListener("change", function () {
      const quantity = parseInt(selectedCount.value);
      const oldQuantity = parseInt(selectedCount.dataset.oldvalue) || 0;
      const pricePerItem = parseFloat(
        reverseRupiah(
          selectedCount.closest(".d-flex").querySelector(".price").textContent
        )
      );
      const itemPriceChange = (quantity - oldQuantity) * pricePerItem;

      updateTotalPrice(itemPriceChange);
      selectedCount.dataset.oldvalue = quantity;

      const itemPrice = quantity * pricePerItem;
      selectedCount
        .closest(".d-flex")
        .querySelector(".total-item-price").textContent = rupiah(itemPrice);
    });
  });
});

function updateTotalPrice(itemPriceChange) {
  const totalElement = document.querySelector(".total-price");
  const buttonSave = document.querySelector(".btn-save");
  const currentTotal = parseFloat(reverseRupiah(totalElement.textContent));
  const newTotal = currentTotal + itemPriceChange;
  totalElement.textContent = rupiah(newTotal > 0 ? newTotal : 0);

  if (newTotal <= 0) {
    console.log("tes");
    buttonSave.setAttribute("disabled", true);
  } else {
    buttonSave.removeAttribute("disabled");
  }
}
