// Show Password Toggle
const passwordInput = document.getElementById('password-input');
const showPasswordToggle = document.getElementById('show-password-toggle');

// Tambahkan event listener untuk mengubah tipe input password saat ikon mata diklik
showPasswordToggle.addEventListener('click', function (e) {
      e.preventDefault();

      // Periksa tipe input password, ubah ke tipe text jika password sedang tersembunyi, dan sebaliknya
      if (passwordInput.type === 'password') {
         passwordInput.type = 'text';
      } else {
         passwordInput.type = 'password';
      }
});


function closeModal() {
   console.log('tess')
   var modal = document.getElementById('modal-popup');
   modal.classList.remove('d-block');
}