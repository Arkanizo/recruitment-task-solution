// Tworzenie przycisku
var button = document.createElement("button");
button.innerHTML = "Kliknij mnie";
button.style.position = "fixed";
button.style.top = "10px";
button.style.left = "10px";
button.style.borderRadius = "5px"; // Zaokrąglone krawędzie promieniem 5px
button.style.color = "#fff"; // Kolor tekstu - biały
button.style.background = "linear-gradient(#9b59b6, #8e44ad)"; // Tło - gradient fioletowy
button.style.border = "1px solid #8e44ad"; // Obramowanie
button.style.boxShadow = "0 2px 5px rgba(0, 0, 0, 0.3)"; // Efekt cienia
button.style.cursor = "pointer"; // Kursor w postaci dłoni
button.style.transform = "translateZ(0)"; // Efekt 3D
document.body.appendChild(button);

// Tworzenie komunikatu
var message = document.createElement("div");
message.innerHTML = "Dziękuję za umożliwienie udziału w rekrutacji &#x1F60A;";
message.style.position = "fixed";
message.style.top = "50%";
message.style.left = "50%";
message.style.transform = "translate(-50%, -50%)";
message.style.backgroundColor = "#fff";
message.style.padding = "20px";
message.style.borderRadius = "5px";
message.style.boxShadow = "0 2px 5px rgba(0, 0, 0, 0.3)";
message.style.textAlign = "center";
message.style.fontSize = "24px";
message.style.zIndex = "9999";
message.style.display = "none";
document.body.appendChild(message);

// Obsługa zdarzenia kliknięcia przycisku
button.addEventListener("click", function() {
  message.style.display = "block";
  setTimeout(function() {
    message.style.display = "none";
  }, 5000); // Wygaszenie po 5 sekundach (5000 milisekund)
});
