
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language Translator</title>
    <link rel="stylesheet" href="translate.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="container">
        <div class="card input-wrapper">
            <div class="from">
                <span class="heading">From:</span>
                <div class="dropdown-container" id="input-language">
                    <button class="dropdown-toggle" aria-haspopup="listbox" aria-expanded="false">
                        <ion-icon name="globe-outline"></ion-icon>
                        <span class="selected" data-value="auto">Auto Detect</span>
                        <ion-icon name="chevron-down-outline"></ion-icon>
                    </button>
                    <ul class="dropdown-menu"></ul>
                </div>
            </div>
            <div class="text-area">
                <textarea id="input-text" rows="8" placeholder="Enter your text here"></textarea>
                <div class="chars"><span id="input-chars">0</span> / 5000</div>
            </div>
            <div class="card-bottom">
                <p>Or choose your document!</p>
                <label for="upload-document" class="file-label">
                    <span id="upload-title">Choose File</span>
                    <ion-icon name="cloud-upload-outline"></ion-icon>
                    <input type="file" id="upload-document" accept=".txt,.pdf,.doc,.docx" hidden>
                </label>
            </div>
        </div>

        <div class="center">
            <button class="swap-position">
                <ion-icon name="swap-horizontal-outline"></ion-icon>
            </button>
        </div>

        <div class="card output-wrapper">
            <div class="to">
                <span class="heading">To:</span>
                <div class="dropdown-container" id="output-language">
                    <button class="dropdown-toggle">
                        <ion-icon name="globe-outline"></ion-icon>
                        <span class="selected" data-value="en">English</span>
                        <ion-icon name="chevron-down-outline"></ion-icon>
                    </button>
                    <ul class="dropdown-menu"></ul>
                </div>
            </div>
            <textarea id="output-text" rows="8" placeholder="Translated text will appear here" readonly></textarea>
            <div class="card-bottom">
                <p>Download as a document!</p>
                <button id="download-btn">
                    <span>Download</span>
                    <ion-icon name="cloud-download-outline"></ion-icon>
                </button>
            </div>
        </div>
    </div>

    <script>
        const languages = [
  { name: "Auto",native: "Detect",code: "auto",},
  { code: "en", name: "English", native: "English" },
  { code: "es", name: "Spanish", native: "Español" },
  { code: "fr", name: "French", native: "Français" },
  { code: "de", name: "German", native: "Deutsch" },
  { code: "it", name: "Italian", native: "Italiano" },
  { code: "ja", name: "Japanese", native: "日本語" },
  { code: "ko", name: "Korean", native: "한국어" },
  { code: "pt", name: "Portuguese", native: "Português" },
  { code: "ru", name: "Russian", native: "Русский" },
  { code: "zh-CN", name: "Chinese (Simplified)", native: "简体中文" },
  { code: "zh-TW", name: "Chinese (Traditional)", native: "繁體中文" },
  { code: "hi", name: "Hindi", native: "हिन्दी" },
  { code: "ta", name: "Tamil", native: "தமிழ்" },
];

const dropdowns = document.querySelectorAll(".dropdown-container");
const inputLanguageDropdown = document.querySelector("#input-language");
const outputLanguageDropdown = document.querySelector("#output-language");

function populateDropdown(dropdown, options) {
  const menu = dropdown.querySelector("ul");
  menu.innerHTML = "";
  options.forEach((option) => {
    const li = document.createElement("li");
    const title = `${option.name} (${option.native})`;
    li.textContent = title;
    li.dataset.value = option.code;
    li.setAttribute("role", "option");
    li.classList.add("option");
    menu.appendChild(li);
  });
}

populateDropdown(inputLanguageDropdown, languages);
populateDropdown(outputLanguageDropdown, languages);

dropdowns.forEach((dropdown) => {
  const toggle = dropdown.querySelector(".dropdown-toggle");
  const menu = dropdown.querySelector(".dropdown-menu");
  const options = dropdown.querySelectorAll(".option");
  const selected = dropdown.querySelector(".selected");

  toggle.addEventListener("click", () => {
    menu.style.display = menu.style.display === "flex" ? "none" : "flex";
    toggle.setAttribute("aria-expanded", menu.style.display === "flex");
  });

  options.forEach((option) => {
    option.addEventListener("click", () => {
      selected.textContent = option.textContent;
      selected.dataset.value = option.dataset.value;
      menu.style.display = "none";
      toggle.setAttribute("aria-expanded", "false");
      translate();
    });
  });
});

document.addEventListener("click", (e) => {
  dropdowns.forEach((dropdown) => {
    if (!dropdown.contains(e.target)) {
      const menu = dropdown.querySelector(".dropdown-menu");
      const toggle = dropdown.querySelector(".dropdown-toggle");
      menu.style.display = "none";
      toggle.setAttribute("aria-expanded", "false");
    }
  });
});

const swapBtn = document.querySelector(".swap-position");
const inputLanguage = inputLanguageDropdown.querySelector(".selected");
const outputLanguage = outputLanguageDropdown.querySelector(".selected");
const inputTextElem = document.querySelector("#input-text");
const outputTextElem = document.querySelector("#output-text");

swapBtn.addEventListener("click", () => {
  const tempLang = inputLanguage.textContent;
  inputLanguage.textContent = outputLanguage.textContent;
  outputLanguage.textContent = tempLang;

  const tempValue = inputLanguage.dataset.value;
  inputLanguage.dataset.value = outputLanguage.dataset.value;
  outputLanguage.dataset.value = tempValue;

  const tempText = inputTextElem.value;
  inputTextElem.value = outputTextElem.value;
  outputTextElem.value = tempText;

  translate();
});

function translate() {
  const inputText = inputTextElem.value;
  const inputLanguage = inputLanguageDropdown.querySelector(".selected").dataset.value;
  const outputLanguage = outputLanguageDropdown.querySelector(".selected").dataset.value;
  const url = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=${inputLanguage}&tl=${outputLanguage}&dt=t&q=${encodeURIComponent(inputText)}`;
  
  fetch(url)
    .then((response) => response.json())
    .then((json) => {
      outputTextElem.value = json[0].map((item) => item[0]).join("");
    })
    .catch((error) => {
      console.error("Translation error:", error);
      outputTextElem.value = "Error: Could not translate text";
    });
}

inputTextElem.addEventListener("input", () => {
  if (inputTextElem.value.length > 5000) {
    inputTextElem.value = inputTextElem.value.slice(0, 5000);
  }
  document.querySelector("#input-chars").textContent = inputTextElem.value.length;
  translate();
});

const uploadDocument = document.querySelector("#upload-document");
const uploadTitle = document.querySelector("#upload-title");

uploadDocument.addEventListener("change", (e) => {
  const file = e.target.files[0];
  if (file) {
    uploadTitle.textContent = file.name;
    const reader = new FileReader();
    reader.onload = (e) => {
      inputTextElem.value = e.target.result;
      translate();
    };
    reader.readAsText(file);
  }
});

const downloadBtn = document.querySelector("#download-btn");

downloadBtn.addEventListener("click", () => {
  const outputText = outputTextElem.value;
  const outputLanguage = outputLanguageDropdown.querySelector(".selected").dataset.value;
  if (outputText) {
    const blob = new Blob([outputText], { type: "text/plain" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.download = `translated-to-${outputLanguage}.txt`;
    a.href = url;
    a.click();
    URL.revokeObjectURL(url);
  }
});

const darkModeCheckbox = document.getElementById("dark-mode-btn");

darkModeCheckbox.addEventListener("change", () => {
  document.body.classList.toggle("dark");
});

// Initial translation
translate();
    </script>
</body>
</html>
