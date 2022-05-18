/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
$(document).ready(function () {
  var productLists = $('.product-container');
  $.ajax({
    type: 'get',
    url: "data/",
    success: function success(data) {
      data.forEach(function (element, index) {
        var attributes = '<td class="product-attribute">';

        for (var i = 0; i < element[index].attribute.length; i++) {
          attributes += '<div class="attribute-item">' + '<div class="attribute-title">' + element[index].attribute[i]['title'] + ': </div>' + '<span class="attribute-description">' + element[index].attribute[i]['description'][0] + "</span>" + '</div>';
        }

        attributes += '</td>';
        var product = "";
        product += '<tr>';
        product += '<td class="product-id"><div><div>' + element[index].id + '</div><div class="product-title">' + element[index].title + '</div></div></td>';
        product += '<td class="product-price">' + element[index].price + '</td>'; // product += '<td>'+element[index].price+'</td>';

        product += attributes;
        product += '<td class="product-categories">' + element[index].categories + '</td>';
        product += '</tr>';
        productLists.append(product);
      });
    }
  });
});
/******/ })()
;