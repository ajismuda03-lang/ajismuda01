document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    if (form) {
        form.addEventListener("submit", function (e) {
            const nik = document.getElementById("nik").value;

            if (nik.length !== 16 || isNaN(nik)) {
                alert("NIK harus terdiri dari tepat 16 digit angka!");
                e.preventDefault(); // Batalkan pengiriman form
            }
        });
    }
});