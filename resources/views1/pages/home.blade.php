@extends('layouts.generic')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/selectize.css')}}">
    <link rel="stylesheet" href="{{asset('css/pages/category.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/jquery-sortable.js')}}"></script>
    <script src="{{asset('js/bootstrap-filestyle.min.js')}}"></script>
    <script src="{{asset('js/microevent.js')}}"></script>
    <script src="{{asset('js/selectize.js')}}"></script>
    <script src="{{asset('js/pages/category.js')}}"></script>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/lightslider.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">
@endsection
@section('scripts')
    <script src="{{asset('js/lightslider.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                navigation : true, // Show next and prev buttons
                slideSpeed : 300,
                paginationSpeed : 400,
                items : 1,
                itemsDesktop : false,
                itemsDesktopSmall : false,
                itemsTablet: false,
                itemsMobile : true,
            });

            if ($(window).width() < 960) {
                $( ".itemListing" ).each(function( index ) {
                    if((index % 5) == 0 && index || 0){
                        $( this ).after($('.ads-1').html());
                    }
                });
            }
        });
    </script>
    <script>
var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>
@endsection

@section('content')

    @if (1 >= Request::get('page'))
    <div class="homeHeader">

        <div class="containerBackground">

            <div id="owl-demo" class="owl-carousel owl-theme">

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                    <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                     <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                     <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img style="width: 100%;" src="{{asset('img/slider/201.jpg')}}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                      <img style="width: 100%;"src="{{asset('img/slider/2.jpg')}}" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                      <img style="width: 100%;" src="{{asset('img/slider/3.jpg')}}" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                      <img style="width: 100%;" src="{{asset('img/slider/4.jpg')}}" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                      <img style="width: 100%;" src="{{asset('img/slider/5.jpg')}}" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                      <img style="width: 100%;" src="{{asset('img/slider/6.jpg')}}" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                      <img style="width: 100%;" src="{{asset('img/slider/7.jpg')}}" alt="Third slide">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">{{ __('Previous') }}</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">{{ __('Next') }}</span>
                  </a>

            </div>

            </div>
        </div>
        <div class="override-margin"></div>

    </div>

    <div class="homeheading"><h6>"Life is too short to drive boring cars"</h6></div>
    <br />
    @endif
    <div id="page-wrapper" class="wrapper home" style=" border:0px solid green;width: 76%">
        <div class="row">
            <div class="col-lg-8 text-white" style="margin-top: 10px;margin-bottom: 20px;padding: 0px;margin-left: auto; margin-right: auto;">
                @if($type == 'Car')
                    @include('elements.listings')
                @elseif($type == 2)
                    <div class="the-content">
                        <p>{{ __('available soon') }}</p>
                        <p><img class="size-full-img" src="http://www.ccfb.biz/wp-content/uploads/2016/11/BonnevilleT100EFI_3.png" alt="" width="800" height="450"></p>
                        <p>&nbsp;</p>
                    </div>
                @elseif($type == 3)
                    <div class="the-content">
                        <p>{{ __('available soon') }}</p>
                        <p><img class="size-full-img" src="http://www.ccfb.biz/wp-content/uploads/2017/06/Brommer9.jpg" alt="" width="800" height="450"></p>
                        <p>&nbsp;</p>
                    </div>
                @elseif($type == 4)
                    <div class="the-content">
                        <p>{{ __('available soon') }}</p>
                        <p><img class="size-full-img" src="http://www.ccfb.biz/wp-content/uploads/2016/11/9221d4f8347a79b264b5c165fc9b3cdc.jpg" alt="" width="800" height="450"></p>
                        <p>&nbsp;</p>
                    </div>
                @elseif($type == 5)
                    <div class="the-content">
                        <p>{{ __('available soon') }}</p>
                        <p><img class="size-full-img" src="http://www.ccfb.biz/wp-content/uploads/2016/11/1425919254-08593d92ae74ab427c55dd685bfcf3a4-1366x909.jpg" alt="" width="800" height="450"></p>
                        <p>&nbsp;</p>
                    </div>
                @elseif($type == 6)
                    <div class="the-content">
                        <p>{{ __('available soon') }}</p>
                        <p><img class="size-full-img" src="http://www.ccfb.biz/wp-content/uploads/2016/11/BonnevilleT100EFI_3.png" alt="" width="800" height="450"></p>
                        <p>&nbsp;</p>
                    </div>
                @endif
            </div>

            @include('elements.sidebar-footer-ads')
    </div>

@stop

