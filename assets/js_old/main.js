var price_1 = $("#price").val();
var price_50 = $("#price_1").val();
var price_5k = $("#price_2").val();
var price_over_5k = $("#price_3").val();

(function ($) {
  "use strict";

jQuery(document).ready(function ($) {
    $(".shippingCheck").click(function () {
        $(".shipping-details-area").toggle();
        if ($(".shipping-details-area").is(":hidden")) {
            $(".shipping-details-area").find("input").prop("required", false);
        } else {
            $(".shipping-details-area").find("input").prop("required", true);
        }
    });

    $(".product-carousel-list").owlCarousel({
        items: 6,
        autoplay: true,
        margin: 0,
        loop: true,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
      smartSpeed: 300,
      //pauseOnHover: true,
      autoplayHoverPause: true,
      //pauseOnFocus: true,
      //    responsive : {
      // 	0 : {
      // 		items: 1,
      // 	},
      // 	768 : {
      // 		items: 2,
      // 	},
      // 	992 : {
      // 		items: 4,
      // 	},
      // 	1200 : {
      // 		items: 3,
      // 	},
      // },

        responsive: {
            0: {
              items: 2,
              nav: false,
            },
            600: {
              items: 2,
              //   nav: false,
            },
            992: {
              items: 4,
            },
            1200: {
              items: 3,
            },
        },
    });

    $(".product-review-owl-carousel").owlCarousel({
        items: 4,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        dots: false,
        loop: true,
        autoplay: true,
        smartSpeed: 800,
    });

    $(".product-zoom").zoom({
        on: "mouseover",
        magnify: 1.5,
        onZoomIn: function () {
            $(this).css("cursor", "zoom-out");
        },
        onZoomOut: function () {
            $(this).css("cursor", "zoom-in");
        },
    });

    $(".blog-area-slider").owlCarousel({
        items: 3,
        autoplay: true,
        margin: 60,
        loop: true,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        smartSpeed: 800,
        responsive: {
            0: {
              items: 1,
            },
            768: {
              items: 2,
            },
            992: {
              items: 3,
            },
        },
    });

    $(".logo-carousel").owlCarousel({
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
        slidesToShow: 10,
        pauseOnHover: true,
        slidesToScroll: 1,
        loop: true,
        autoWidth: true,
        items: 10,
        nav: true,
        dots: false,
        margin: 30,
        // autoplaySpeed: 100,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
        ],
        // smartSpeed: 300,
        responsive: {
    		0 : {
    			items: 3,
    		},
    		768 : {
    			items: 10,
    		},
    		992 : {
    			items: 10,
    		}
            // 0: {
            //   items: 3,
            //   nav: false,
            // },
            // 768: {
            //   items: 10,
            // },
            // 992: {
            //   items: 10,
            // },
        },
    });

    $(".testimonial-section").owlCarousel({
      items: 1,
      autoplay: 3000,
      margin: 60,
      loop: true,
      nav: true,
      navText: [
        "<i class='fa fa-chevron-left'></i>",
        "<i class='fa fa-chevron-right'></i>",
      ],
      smartSpeed: 800,
    });

    new WOW().init();
    getCart();
  });
  $("#secondsearchdata").keypress(function (event) {
    if (event.which == 13) {
      event.preventDefault();
      if ($("#secondsearchdata").val() != "") {
        window.location = mainurl + "/search/" + $("#secondsearchdata").val();
      } else {
        window.location = mainurl + "/search/none";
      }
    }
  });

  $("#searchdata").keypress(function (event) {
    if (event.which == 13) {
      event.preventDefault();
      if ($("#searchdata").val() != "") {
        window.location = mainurl + "/search/" + $("#searchdata").val();
      } else {
        window.location = mainurl + "/search/none";
      }
    }
  });

  $("#product-size span").click(function () {
    $("#product-size span").removeClass("selected-size");
    $(this).addClass("selected-size");
    var size = $(this).html();
    $("#size").val(size);
  });

  $("#qty-add").click(function () {
    var product = $(".addtocart-form input[name=product]").val();
    var productattr = $(".addtocart-form input[name=attrColor]").val();
    var qty = parseInt($("#pqty").val());
    var total = qty + 1;
    $("#pqty").val(total);
    // $('#quantity').val(total);
    updateProductPageQty(total);
    checkProductQty(product, total, qty, productattr);
    /*var total = qty + 1;
		$('#pqty').text(total);
        $('#quantity').val(total);
        var price = parseFloat($('#price').val());
        var cost =  parseFloat(total) * price;
        $('#cost').val(cost.toFixed(2));*/
  });

  $(".input-number").change(function () {
    var total = $("#pqty").val();
    updateProductPageQty(total);
  });

  function updateProductPageQty(total) {
    $("#pqty").val(total);
    $("#quantity").val(total);
    var price = parseFloat($("#price").val());

    if (total == 1) {
      price = price_1;
      var cost = parseFloat(total) * price;
      $("#cost").val(cost.toFixed(2));
    } else if (total >= 2 && total <= 49) {
      price = price_50;
      var cost = parseFloat(total) * price;
      $("#cost").val(cost.toFixed(2));
    } else if (total >= 50 && total <= 4999) {
      price = price_5k;
      var cost = parseFloat(total) * price;
      $("#cost").val(cost.toFixed(2));
    } else if (total >= 5000) {
      price = price_over_5k;
      var cost = parseFloat(total) * price;
      $("#cost").val(cost.toFixed(2));
    }
  }

  function checkProductQty(product, currentQty, preQty) {
    var formData = { product: product, quantity: currentQty, checkQty: true };
    $.ajax({
      type: "POST",
      url: mainurl + "/cartupdate",
      data: formData,
      success: function (data) {
        if (typeof data.error != "undefined" && data.error) {
          updateProductPageQty(preQty);
          $.notify(data.response, "error");
        }
      },
      error: function (data) {
        //console.log('Error:', data);
      },
    });
  }

  $("#qty-minus").click(function () {
    var qty = parseInt($("#pqty").val());
    var total = qty - 1;
    $("#pqty").val(total < 1 ? 1 : total);
    $("#quantity").val(total);
    var price = parseFloat($("#price").val());
    var cost = parseFloat(total) * price;
    $("#cost").val(cost.toFixed(2));
  });

  function updatecartonboard(id, prices, total, color) {
    $("#number" + id + color).text(total < 1 ? 1 : total);
    var ttl = prices * total;
    $("#cost" + id + color).val(ttl.toFixed(2));
    $("#quantity" + id + color).val(total);
    $("#price" + id + color).html(prices);
    $("#price_update" + id + color).val(prices);
    $("#subtotal" + id + color).html(ttl.toFixed(2));
    var sum = 0;
    $(".subtotal").each(function () {
      sum += parseFloat(
        $(this)
          .text()
          .replace(/[^\d.]/g, "")
      ); // Or this.innerHTML, this.innerText
    });
    $("#grandtotal").html(sum);
    // console.log(ttl);
  }

  $(".quantity-cart-plus").on("click", function () {
    var color = $(this).attr("data");
    var id = $(this).attr("attr");
    var prices = parseFloat(
      $("#price" + id + color)
        .html()
        .replace(/[^\d.]/g, "")
    );
    var quan = parseInt(
      $("#number" + id + color)
        .html()
        .replace(/[^\d.]/g, "")
    );

    var main_price = parseFloat($("#main_price" + id + color).val());
    let rangenameone = $("#rangenameone" + id).val();
    let rangenameoneSlit = rangenameone.split("-");
    let rangenametwo = $("#rangenametwo" + id).val();
    let rangenametwoSlit = rangenametwo.split("-");
    let rangenamethree = $("#rangenamethree" + id).val();
    let rangenamethreeSlit = rangenamethree.split("-");

    let discount_one = parseFloat($("#discount_one" + id).val());
    let discount_two = parseFloat($("#discount_two" + id).val());
    let discount_three = parseFloat($("#discount_three" + id).val());

    var quantity = quan - 1;
    let discount_amt1 = (main_price * discount_one) / 100;
    let discount_amt2 = (main_price * discount_two) / 100;
    let discount_amt3 = (main_price * discount_three) / 100;

    var quantity = quan + 1;

    // Default will be main price
    prices = main_price;

    if (rangenameone != "") {
      let $range1one = parseInt(rangenameoneSlit[0]);
      let $range1two = parseInt(rangenameoneSlit[1]);
      if (quantity >= $range1one && quantity <= $range1two) {
        prices = main_price - discount_amt1;
      }
    }

    if (rangenametwo != "") {
      let $range2one = parseInt(rangenametwoSlit[0]);
      let $range2two = parseInt(rangenametwoSlit[1]);
      if (quantity >= $range2one && quantity <= $range2two) {
        prices = main_price - discount_amt2;
      }
    }

    if (rangenamethree != "") {
      let $range3one = parseInt(rangenamethreeSlit[0]);
      let $range3two = parseInt(rangenamethreeSlit[1]);
      if (quantity >= $range3one && quantity <= $range3two) {
        prices = main_price - discount_amt3;
      } else if (quantity > $range3two) {
        prices = main_price - discount_amt3;
      }
    }

    updatecartonboard(id, prices, quantity, color);

    if ($("#citem" + id + color).length !== 0) {
      var formData = $("#citem" + id + color).serializeArray();
      $.ajax({
        type: "POST",
        url: mainurl + "/cartupdate",
        data: formData,
        success: function (data) {
          if (typeof data.error != "undefined" && data.error) {
            updatecartonboard(id, prices, quan, color);
            $.notify(data.response, "error");
          } else {
            getCart();
          }
        },
        error: function (data) {
          //console.log('Error:', data);
        },
      });
    }
  });

  $(".quantity-cart-minus").on("click", function () {
    var color = $(this).attr("data");
    var id = $(this).attr("attr");
    var prices = parseFloat(
      $("#price" + id + color)
        .html()
        .replace(/[^\d.]/g, "")
    );
    var quan = parseInt(
      $("#number" + id + color)
        .html()
        .replace(/[^\d.]/g, "")
    );
    var main_price = parseFloat($("#main_price" + id + color).val());

    let rangenameone = $("#rangenameone" + id).val();
    let rangenameoneSlit = rangenameone.split("-");
    let rangenametwo = $("#rangenametwo" + id).val();
    let rangenametwoSlit = rangenametwo.split("-");
    let rangenamethree = $("#rangenamethree" + id).val();
    let rangenamethreeSlit = rangenamethree.split("-");

    let discount_one = parseFloat($("#discount_one" + id).val());
    let discount_two = parseFloat($("#discount_two" + id).val());
    let discount_three = parseFloat($("#discount_three" + id).val());

    var quantity = quan - 1;

    let discount_amt1 = (main_price * discount_one) / 100;
    let discount_amt2 = (main_price * discount_two) / 100;
    let discount_amt3 = (main_price * discount_three) / 100;

    // Default will be main price
    prices = main_price;

    // For whole sell range
    if (rangenameone != "") {
      let $range1one = parseInt(rangenameoneSlit[0]);
      let $range1two = parseInt(rangenameoneSlit[1]);
      if (quantity >= $range1one && quantity <= $range1two) {
        prices = main_price - discount_amt1;
      }
    }

    if (rangenametwo != "") {
      let $range2one = parseInt(rangenametwoSlit[0]);
      let $range2two = parseInt(rangenametwoSlit[1]);
      if (quantity >= $range2one && quantity <= $range2two) {
        prices = main_price - discount_amt2;
      }
    }

    if (rangenamethree != "") {
      let $range3one = parseInt(rangenamethreeSlit[0]);
      let $range3two = parseInt(rangenamethreeSlit[1]);
      if (quantity >= $range3one && quantity <= $range3two) {
        prices = main_price - discount_amt3;
      } else if (quantity > $range3two) {
        prices = main_price - discount_amt3;
      }
    }
    // End whole sell range
    if (quantity >= 1) {
      $("#number" + id + color).text(quantity);
      var ttl = prices * quantity;
      $("#cost" + id + color).val(ttl.toFixed(2));
      $("#quantity" + id + color).val(quantity);
      $("#price" + id + color).html(prices);
      $("#price_update" + id + color).val(prices);
      $("#subtotal" + id + color).html(ttl.toFixed(2));
      var sum = 0;
      $(".subtotal").each(function () {
        sum += parseFloat(
          $(this)
            .text()
            .replace(/[^\d.]/g, "")
        ); // Or this.innerHTML, this.innerText
      });
      $("#grandtotal").html(sum);

      if ($("#citem" + id + color).length !== 0) {
        var formData = $("#citem" + id + color).serializeArray();
        $.ajax({
          type: "POST",
          url: mainurl + "/cartupdate",
          data: formData,
          success: function (data) {
            getCart();
          },
          error: function (data) {
            //console.log('Error:', data);
          },
        });
      }
    }
  });

  $("#ex2").slider({});
  $("#ex2").on("slide", function (slideRange) {
    var totals = slideRange.value;
    var value = totals.toString().split(",");
    $("#price-min").val(value[0]);
    $("#price-max").val(value[1]);
  });

  // jQuery(window).load(function(){
  //     setTimeout(function(){
  //         $('#cover').fadeOut(500);
  //     },500);
  // });

  // cover page time reduce
  jQuery(window).load(function () {
    $("#cover").fadeOut(400);
  });
})(jQuery);

function productGallery(file) {
  var image = $("#" + file).attr("src");
  $("#imageDiv").attr("src", image);
  $(".zoomImg").attr("src", image);
}

function productattrGallery(file) {
  var image = $("#" + file).attr("src");
  $("#imageDiv").attr("src", image);
  $(".zoomImg").attr("src", image);
}

function getQuickView(id) {
  var product = id.toString();
  $.get(mainurl + "/quick-view/" + product, function (response) {
    $("#viewProduct").html(response);
  });
}

//Cart System By ShaOn//
function getCart() {
  $.get(mainurl + "/cartupdate", function (response) {
    var total = 0;
    $("#goCart").html("");
    $.each(response, function (i, cart) {
      $.each(cart, function (index, data) {
        //for (var i = 0; i <= index; i++){
        var title = data.title.toLowerCase();
        title = title.split(" ").join("-");
        url = mainurl + "/product/" + data.product + "/" + title;
        total = parseFloat(total) + parseFloat(data.cost);
        $("#goCart").append(
          '<div class="cart-entry"> <div class="content"> <a class="title" href="' +
            url +
            '">' +
            data.title +
            '</a> <div class="quantity">' +
            language.quantity +
            ": " +
            data.quantity +
            '</div><div class="price">' +
            currency +
            data.cost +
            '</div></div><div class="button-x"><i class="fa fa-close" onclick="getDelete(' +
            data.product +
            ", " +
            data.cartcolor +
            ')"></i></div></div>'
        );
        $("#grandttl").html(currency + total.toFixed(2));
        $("#carttotal").html(currency + total.toFixed(2));
        $("#emptycart").html("");
      });
    });
  });
}

function getDelete(id, color) {
  var color2 = color.replace(" ", "-");
  $.get(mainurl + "/cartdelete/" + id + "/" + color, function (response) {
    $("#grandttl").html(currency + "0.00");
    $("#carttotal").html(currency + "0.00");
    $("#grandtotal").html("0.00");
    $("#emptycart").html(language.empty_cart);
    $("#cartempty").html("<td><h3>" + language.empty_cart + "</h3></td>");
    $("#item" + id + color2).remove();
    var total = 0;
    var url = "";
    $("#goCart").html("");
    $.each(response, function (i, cart) {
      $.each(cart, function (index, data) {
        var title = data.title.toLowerCase();
        title = title.split(" ").join("-");
        url = mainurl + "/product/" + data.product + "/" + title;
        total = parseFloat(total) + parseFloat(data.cost);
        $("#goCart").append(
          '<div class="cart-entry"> <div class="content"> <a class="title" href="' +
            url +
            '">' +
            data.title +
            '</a> <div class="quantity">' +
            language.quantity +
            ": " +
            data.quantity +
            '</div><div class="price">' +
            currency +
            data.cost +
            ' FCFA</div></div><div class="button-x"><i class="fa fa-close" onclick="getDelete(' +
            data.product +
            ", " +
            data.cartcolor +
            ')"></i></div></div>'
        );
        $("#grandttl").html(currency + total.toFixed(2));
        $("#carttotal").html(currency + total.toFixed(2));
        $("#grandtotal").html(currency + total.toFixed(2));
        $("#emptycart").html("");
        $("#cartempty").html("");
      });
    });
  });
}

var presData = JSON.parse(window.localStorage.getItem("formObject"));
var lenseData = [];
function addCartProduct() {
  var formData = $(".addtocart-form").serializeArray();
  lenseData = formData.concat(presData);
  url = mainurl + "/cartupdate";
  $.ajax({
    type: "POST",
    url: url,
    data: lenseData,
    success: function (data) {
      getCart();
      $.notify(language.added_to_cart, "success");
      if (data.status == 200) {
        window.localStorage.clear();
        window.location.href = mainurl + "/cart";
      }
    },
    error: function (data) {
      //console.log('Error:', data);
    },
  });
}

function toCart(btn) {
  var formData = $(btn).parents("form:first").serializeArray();
  $.ajax({
    type: "POST",
    url: mainurl + "/cartupdate",
    data: formData,
    success: function (data) {
      getCart();
      $.notify(language.added_to_cart, "success");
    },
    error: function (data) {
      //console.log('Error:', data);
    },
  });
}

// Email validate function
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

//Subscription Button
$("#subs").click(function () {
  if (isEmail($("#subform input[name=email]").val())) {
    var datas = $("#subform").serializeArray();
    var action = $("#subform").attr("action");
    $.post(action, datas, function (data, textStatus, xhr) {
      setTimeout(function () {
        $("#resp").html(data);
      }, 100);
    });
    return false;
  }
});

$(function () {
  var current = location.pathname;
  $(".dashboard-mainmenu li a").each(function () {
    var $this = $(this);
    // if the current path is like this link, make it active
    if ($this.attr("href").indexOf(current) !== -1) {
      $this.parents("li").addClass("active");
    }
  });
});

//Start Review Scripts Start
var slice = [].slice;
(function ($, window) {
  var Starrr;
  window.Starrr = Starrr = (function () {
    Starrr.prototype.defaults = {
      rating: void 0,
      max: 5,
      readOnly: false,
      emptyClass: "fa fa-star-o",
      fullClass: "fa fa-star",
      change: function (e, value) {},
    };

    function Starrr($el, options) {
      this.options = $.extend({}, this.defaults, options);
      this.$el = $el;
      this.createStars();
      this.syncRating();
      if (this.options.readOnly) {
        return;
      }
      this.$el.on(
        "mouseover.starrr",
        "a",
        (function (_this) {
          return function (e) {
            return _this.syncRating(
              _this.getStars().index(e.currentTarget) + 1
            );
          };
        })(this)
      );
      this.$el.on(
        "mouseout.starrr",
        (function (_this) {
          return function () {
            return _this.syncRating();
          };
        })(this)
      );
      this.$el.on(
        "click.starrr",
        "a",
        (function (_this) {
          return function (e) {
            return _this.setRating(_this.getStars().index(e.currentTarget) + 1);
          };
        })(this)
      );
      this.$el.on("starrr:change", this.options.change);
    }

    Starrr.prototype.getStars = function () {
      return this.$el.find("a");
    };

    Starrr.prototype.createStars = function () {
      var j, ref, results;
      results = [];
      for (
        j = 1, ref = this.options.max;
        1 <= ref ? j <= ref : j >= ref;
        1 <= ref ? j++ : j--
      ) {
        results.push(this.$el.append("<a href='javascript:;' />"));
      }
      return results;
    };

    Starrr.prototype.setRating = function (rating) {
      if (this.options.rating === rating) {
        rating = void 0;
      }
      this.options.rating = rating;
      this.syncRating();
      return this.$el.trigger("starrr:change", rating);
    };

    Starrr.prototype.getRating = function () {
      return this.options.rating;
    };

    Starrr.prototype.syncRating = function (rating) {
      var $stars, i, j, ref, results;
      rating || (rating = this.options.rating);
      $stars = this.getStars();
      results = [];
      for (
        i = j = 1, ref = this.options.max;
        1 <= ref ? j <= ref : j >= ref;
        i = 1 <= ref ? ++j : --j
      ) {
        results.push(
          $stars
            .eq(i - 1)
            .removeClass(
              rating >= i ? this.options.emptyClass : this.options.fullClass
            )
            .addClass(
              rating >= i ? this.options.fullClass : this.options.emptyClass
            )
        );
      }
      return results;
    };
    return Starrr;
  })();

  return $.fn.extend({
    starrr: function () {
      var args, option;
      (option = arguments[0]),
        (args = 2 <= arguments.length ? slice.call(arguments, 1) : []);
      return this.each(function () {
        var data;
        data = $(this).data("starrr");
        if (!data) {
          $(this).data("starrr", (data = new Starrr($(this), option)));
        }
        if (typeof option === "string") {
          return data[option].apply(data, args);
        }
      });
    },
  });
})(window.jQuery, window);

$(document).ready(function () {
  var submitIcon = $(".searchbox-icon");
  var inputBox = $(".searchbox-input");
  var searchBox = $(".searchbox");
  var isOpen = false;
  submitIcon.click(function () {
    if (isOpen == false) {
      searchBox.addClass("searchbox-open");
      inputBox.focus();
      isOpen = true;
    } else {
      searchBox.removeClass("searchbox-open");
      inputBox.focusout();
      isOpen = false;
    }
  });
  submitIcon.mouseup(function () {
    return false;
  });
  searchBox.mouseup(function () {
    return false;
  });
  $(document).mouseup(function () {
    if (isOpen == true) {
      $(".searchbox-icon").css("display", "block");
      submitIcon.click();
    }
  });
});

function buttonUp() {
  var inputVal = $(".searchbox-input").val();
  inputVal = $.trim(inputVal).length;
  if (inputVal !== 0) {
    $(".searchbox-icon").css("display", "none");
  } else {
    $(".searchbox-input").val("");
    $(".searchbox-icon").css("display", "block");
  }
}

//Start Review Scripts End
