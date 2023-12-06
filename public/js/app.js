$('.link-icon').on('click', function () {
    $(".list-qview").removeClass("qview-show");
    var code = $(this).attr('attr-home-code');
    $('.list-qview'+code).addClass('qview-show');
});
$('.clo-list').on('click', function () {
    $(".list-qview").removeClass("qview-show");
});

$('#search-desktop').on('click', function (){
    var category = $('#category-desktop');
    var provincy = $('#provincy-desktop');
    filterIcons(category, provincy);
})

$('#search-mobile').on('click', function (){
    var category = $('#category-mobile');
    var provincy = $('#provincy-mobile');
    filterIcons(category, provincy);
})

$('#search-province-desktop').on('click', function (){
    var provincy = $('#provincy-desktop');
    filterProvinceIcons(provincy);
})

$('#search-province-mobile').on('click', function (){
    var provincy = $('#provincy-mobile');
    filterProvinceIcons(provincy);
})
function filterIcons(category, provincy){
    var url = $('#url').val();
    if(category.val() != 0 && provincy.val() != 0) {
        window.location.href = url + "/" + category.val() + "/" + provincy.val();
    } else if(category.val() != 0 && provincy.val() == 0) {
        alert('Debes seleccionar una provincía');
    }else if(category.val() == 0 && provincy.val() != 0) {
        alert('Debes seleccionar una categoría');
    }else if(category.val() == 0 && provincy.val() == 0) {
        alert('Debes seleccionar una categoría y una provincía');
    }
}

function filterProvinceIcons(provincy){
    var url = "";
    if(provincy.val() == 0) {
        url = $('#url').val();
        window.location.href = url + "/";
    }else if(provincy.val() !== 0) {
        url = $('#url').val();
        window.location.href = url + "/" + provincy.val();
    } else {
        alert('Selecciona una provincia');
    }
}

$('#menu-item-buscar').on('click', function () {
    if($('#sub-menu-buscar').hasClass('show')) {
        $(this).addClass('toggle-custom-menu');
        $(this).addClass('active');
    } else {
        $(this).removeClass('toggle-custom-menu');
        $(this).removeClass('active');
    }
});

$(document).on('click', function (event) {
    if (!$(event.target).closest('#menu-item-buscar').length) {
        $('#menu-item-buscar').removeClass('toggle-custom-menu');
        $('#menu-item-buscar').removeClass('active');
    }

    if (!$(event.target).closest('.link-icon').length) {
        $(".list-qview").removeClass("qview-show");
    }
});

$('.content-img').mouseenter(function() {
    $('.bg-overlay',this).fadeIn()
})

$('.content-img').mouseleave(function() {
    $('.bg-overlay',this).fadeOut()
})

