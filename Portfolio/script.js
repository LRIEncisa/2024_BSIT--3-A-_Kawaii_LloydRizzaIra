document.addEventListener("DOMContentLoaded", function() {
    const text = " From Bicol University Polangui";
    const typingElement = document.querySelector(".typing-university");
    let index = 0;

    function typeText() {
        if (index < text.length) {
            typingElement.textContent += text.charAt(index);
            index++;
            setTimeout(typeText, 100); // Adjust typing speed here
        }
    }

    typeTex
