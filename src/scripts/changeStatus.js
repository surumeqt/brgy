document.addEventListener("DOMContentLoaded", () => {
  console.log("Script loaded"); // ✅

  const modal = document.getElementById("status-modal");
  const docketInput = document.getElementById("modal-docket");

  const buttons = document.querySelectorAll(".open-status-modal");
  console.log("Buttons found:", buttons.length); // ✅ Check count

  buttons.forEach(button => {
    button.addEventListener("click", () => {
      const docket = button.getAttribute("data-docket");
      console.log("Docket clicked:", docket); // ✅ Should log
      docketInput.value = docket;
      modal.style.display = "flex";
    });
  });

  modal.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
});
