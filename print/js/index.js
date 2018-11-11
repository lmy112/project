(function ($) {
  let skroll = skrollr.init()
  $(window).scroll(function (evt) {
    let $navbar = $('.print__navbar')
    if ($(window).scrollTop() > 0) {
      $navbar.removeClass('bg-light')
      $navbar.removeClass('navbar-light')
      $navbar.addClass('navbar-dark')
      $navbar.addClass('bg-dark')
    } else {
      $navbar.removeClass('bg-dark')
      $navbar.removeClass('navbar-dark')
      $navbar.addClass('navbar-light')
      $navbar.addClass('bg-light')
    }
  })
  $('.nav-link').on('click', function () {
    $('.navbar-nav').find('li.active').removeClass('active')
    $(this).parent('li').addClass('active')
  })
})($)