
let search = document.querySelector('.header__search');

search.addEventListener("keydown", function(e) {
   if (e.code === "Enter" && e.target.value !== '') {
       e.preventDefault();
       document.location.href = `main_page.php?search=${e.target.value}&page=0`;
   }
});
