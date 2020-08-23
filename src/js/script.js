let search_bar = document.getElementsByClassName("header__search")[0];
let profile_menu_btn = document.querySelector('.header__profile_submenu');
let profile_menu = document.querySelector(".header__profile_submenu_options");
let header_burger = document.querySelector('.header__burger');
let header_menu = document.querySelector('.header__menu');
let header_profile = document.querySelector('.header__profile');
let sidebar = document.querySelector('.sidebar');

function removeOrSetAttribute(objectClass) {
	if (objectClass.hasAttribute("active")) {
		objectClass.removeAttribute("active");
	}
	else {
		objectClass.setAttribute("active", "isActive");
	}
}

function openSearchBar() {
	search_bar.classList.toggle("header__search_momile");
	if (header_profile.hasAttribute("active") && !search_bar.hasAttribute("active")) {
		profileAction();
	}
	if (header_menu.hasAttribute("active") && !search_bar.hasAttribute("active")) {
		menuAction();
	}
	removeOrSetAttribute(search_bar);
}

header_profile.addEventListener("click", profileAction = function () {
	profile_menu.classList.toggle("header__menu_mobile");
	document.body.classList.toggle("overflow_hidden");
	if (search_bar.hasAttribute("active") && !header_profile.hasAttribute("active")) {
		openSearchBar();
	}
	if (header_menu.hasAttribute("active") && !header_profile.hasAttribute("active")) {
		menuAction();
	}
	removeOrSetAttribute(header_profile);
})

header_burger.addEventListener("click", menuAction = function () {
	header_menu.classList.toggle("header__menu_mobile");
	document.body.classList.toggle("overflow_hidden");
	if (header_profile.hasAttribute("active") && !header_menu.hasAttribute("active")) {
		profileAction();
	}
	if (search_bar.hasAttribute("active") && !header_menu.hasAttribute("active")) {
		openSearchBar();
	}
	removeOrSetAttribute(header_menu);
})

profile_menu_btn.addEventListener("mouseover", function () {
	if (document.documentElement.clientWidth > 820) {
		profile_menu.classList.add("display_flex");
	}
})

profile_menu_btn.addEventListener("mouseout", function () {
	if (document.documentElement.clientWidth > 820) {
		profile_menu.classList.remove("display_flex");
	}
})

window.addEventListener("scroll", function () {
	sidebar.style.margin = document.body.scrollTop || document.documentElement.scrollTop + "px 0 0 0";
})







