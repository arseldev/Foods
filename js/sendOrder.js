const buttons = document.querySelectorAll(".button-menu");

buttons.forEach((button) => {
  button.addEventListener("click", () => {
    console.log(button);
    const form = button.closest("form");
    form.action = "src/selectMenu.php";
    form.method = "POST";
    form.submit();
  });
});
