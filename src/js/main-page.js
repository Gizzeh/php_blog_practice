let url = document.location.href;
let page_url = "&page=";

$('.pagination__block').click(function(e) {

    let page = e.target.getAttribute('page');
    let link = document.location.href;
    url = link.slice(0, link.indexOf(page_url) + 6) + page;
    document.location.href = url;

});
