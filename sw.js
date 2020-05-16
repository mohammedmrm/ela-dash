importScripts(
  "https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js"
);

self.addEventListener("message", (event) => {
  if (event.data && event.data.type === "SKIP_WAITING") {
    self.skipWaiting();
  }
});

workbox.routing.registerRoute(
  // Cache js files.
  /\.js/,
  // Use cache but update in the background.
  new workbox.strategies.StaleWhileRevalidate({
    // Use a custom cache name.
    cacheName: "js-cache-client",
  })
);
/*workbox.routing.registerRoute(
  // Cache js files.
  /\.php/,
  // Use cache but update in the background.
  new workbox.strategies.StaleWhileRevalidate({
    // Use a custom cache name.
    cacheName: "php-cache-client",
  })
);*/

workbox.routing.registerRoute(
  // Cache CSS files.
  /\.css/,
  // Use cache but update in the background.
  new workbox.strategies.StaleWhileRevalidate({
    // Use a custom cache name.
    cacheName: "css-cache-client",
  })
);

workbox.routing.registerRoute(
  // Cache image files.
  /\.(?:png|jpg|jpeg|svg|gif)$/,
  // Use the cache if it's available.
  new workbox.strategies.StaleWhileRevalidate({
    // Use a custom cache name.
    cacheName: "image-cache-client",
    plugins: [
      new workbox.expiration.Plugin({
        // Cache only 20 images.
        maxEntries: 20,
        // Cache for a maximum of a week.
        maxAgeSeconds: 7 * 24 * 60 * 60,
      }),
    ],
  })
);

/**
 * The workboxSW.precacheAndRoute() method efficiently caches and responds to
 * requests for URLs in the manifest.
 * See https://goo.gl/S9QRab
 */
self.__precacheManifest = [
  {
    url: "_layout.php",
    revision: "87c56f81355eb5393263a10c471d8929",
  },
  {
    url: "assets/css/demo1/pages/blog/grid-v2.css",
    revision: "765031d1a53f937f67c264f72de16cea",
  },
  {
    url: "assets/css/demo1/pages/blog/grid-v2.rtl.css",
    revision: "56ad11d8be3ae5ba5c3cdf623ac63756",
  },
  {
    url: "assets/css/demo1/pages/blog/grid.css",
    revision: "a2dbf16eee41ff0ef8cf19ce18ea868a",
  },
  {
    url: "assets/css/demo1/pages/blog/grid.rtl.css",
    revision: "a2dbf16eee41ff0ef8cf19ce18ea868a",
  },
  {
    url: "assets/css/demo1/pages/blog/list.css",
    revision: "6c01212134fb988744549705bc3dd3d3",
  },
  {
    url: "assets/css/demo1/pages/blog/list.rtl.css",
    revision: "cf91dd7ad0e34d106e2ffc57139d444a",
  },
  {
    url: "assets/css/demo1/pages/blog/post.css",
    revision: "d8308c9d08136e4e0ba1a7aa55d010ce",
  },
  {
    url: "assets/css/demo1/pages/blog/post.rtl.css",
    revision: "1d47fbab38e192dd5439447f42f73888",
  },
  {
    url: "assets/css/demo1/pages/error/404-v1.css",
    revision: "f7afe2287af5bb86370494558b47bb8b",
  },
  {
    url: "assets/css/demo1/pages/error/404-v1.rtl.css",
    revision: "f7afe2287af5bb86370494558b47bb8b",
  },
  {
    url: "assets/css/demo1/pages/error/404-v2.css",
    revision: "255b0afd608bf769f1b9828a2991896c",
  },
  {
    url: "assets/css/demo1/pages/error/404-v2.rtl.css",
    revision: "255b0afd608bf769f1b9828a2991896c",
  },
  {
    url: "assets/css/demo1/pages/error/404-v3.css",
    revision: "15ee2fd0dd1f252b8037032d4a9bfc5b",
  },
  {
    url: "assets/css/demo1/pages/error/404-v3.rtl.css",
    revision: "15ee2fd0dd1f252b8037032d4a9bfc5b",
  },
  {
    url: "assets/css/demo1/pages/error/404-v4.css",
    revision: "b435d270c07603e727f43c1bc63db8b8",
  },
  {
    url: "assets/css/demo1/pages/error/404-v4.rtl.css",
    revision: "b435d270c07603e727f43c1bc63db8b8",
  },
  {
    url: "assets/css/demo1/pages/invoice/invoice-v1.css",
    revision: "9f13721369c219cbda4e6219eefc43c2",
  },
  {
    url: "assets/css/demo1/pages/invoice/invoice-v1.rtl.css",
    revision: "f12d81998379ffe4f8ad8989b9712128",
  },
  {
    url: "assets/css/demo1/pages/invoice/invoice-v2.css",
    revision: "e695da74f63b43c873a42a3b6034520a",
  },
  {
    url: "assets/css/demo1/pages/invoice/invoice-v2.rtl.css",
    revision: "55a98ef65a566c37be5d7f1562b222f3",
  },
  {
    url: "assets/css/demo1/pages/login/login-v1.css",
    revision: "48f786bde04e31f89e1ab12e7c28e8ae",
  },
  {
    url: "assets/css/demo1/pages/login/login-v1.rtl.css",
    revision: "e9cbfc851b0371afdaa72711db0bf897",
  },
  {
    url: "assets/css/demo1/pages/login/login-v2.css",
    revision: "8c223eadc2225f939996eaeda550640c",
  },
  {
    url: "assets/css/demo1/pages/login/login-v2.rtl.css",
    revision: "fa0d69e9619c123958d83b78c2918e6f",
  },
  {
    url: "assets/css/demo1/pages/login/profile-v1.css",
    revision: "0ce09b78aafefe5dce28494dce8a1584",
  },
  {
    url: "assets/css/demo1/pages/login/profile-v1.rtl.css",
    revision: "5e7ea58fd1fc7199b7cc74030a7060c6",
  },
  {
    url: "assets/css/demo1/pages/pricing/pricing-v1.css",
    revision: "c343725976a9a12ac28060771c5176bd",
  },
  {
    url: "assets/css/demo1/pages/pricing/pricing-v1.rtl.css",
    revision: "f226d88e0014bdcce375848e727c5d1d",
  },
  {
    url: "assets/css/demo1/pages/pricing/pricing-v2.css",
    revision: "0cbe0afc7e4260bb8ca8d7deb7ab6c8b",
  },
  {
    url: "assets/css/demo1/pages/pricing/pricing-v2.rtl.css",
    revision: "6353b09e107d83af5706e5b23300689e",
  },
  {
    url: "assets/css/demo1/pages/wizards/wizard-v1.css",
    revision: "525273058c85b44a7546759ea61b29a1",
  },
  {
    url: "assets/css/demo1/pages/wizards/wizard-v1.rtl.css",
    revision: "8960586b293102f8183fe0b36ab6f26c",
  },
  {
    url: "assets/css/demo1/pages/wizards/wizard-v2.css",
    revision: "1e5da6bb2f831f32710a6d0ef1d676e8",
  },
  {
    url: "assets/css/demo1/pages/wizards/wizard-v2.rtl.css",
    revision: "452afe7c351fa45884eeb3f24be6ee63",
  },
  {
    url: "assets/css/demo1/pages/wizards/wizard-v3.css",
    revision: "51ead2d0dc841a02c142c3a1fc8bc719",
  },
  {
    url: "assets/css/demo1/pages/wizards/wizard-v3.rtl.css",
    revision: "0f5b59a9f898cd38375f36758eee521f",
  },
  {
    url: "assets/css/demo1/skins/aside/brand.css",
    revision: "a3323fd222c102598adcc2f1287cc1a2",
  },
  {
    url: "assets/css/demo1/skins/aside/brand.js",
    revision: "e1fc8758c645d255e129ccd94bf0e8ba",
  },
  {
    url: "assets/css/demo1/skins/aside/brand.rtl.css",
    revision: "a3323fd222c102598adcc2f1287cc1a2",
  },
  {
    url: "assets/css/demo1/skins/aside/light.css",
    revision: "6122d2d4c4cfc5c288a3a659c8a053cd",
  },
  {
    url: "assets/css/demo1/skins/aside/light.js",
    revision: "f16e94c4727645ccf1b3cbf1a47c5a82",
  },
  {
    url: "assets/css/demo1/skins/aside/light.rtl.css",
    revision: "6122d2d4c4cfc5c288a3a659c8a053cd",
  },
  {
    url: "assets/css/demo1/skins/aside/navy.css",
    revision: "20a62655645f688477d7860a8a05e21e",
  },
  {
    url: "assets/css/demo1/skins/aside/navy.js",
    revision: "41c6b837524005ceabff3259c5df4c67",
  },
  {
    url: "assets/css/demo1/skins/aside/navy.rtl.css",
    revision: "20a62655645f688477d7860a8a05e21e",
  },
  {
    url: "assets/css/demo1/skins/brand/brand.css",
    revision: "add7d05bda478f4595abea7705e00c54",
  },
  {
    url: "assets/css/demo1/skins/brand/brand.js",
    revision: "198f877790c32e2cfc0a43ac68494636",
  },
  {
    url: "assets/css/demo1/skins/brand/brand.rtl.css",
    revision: "add7d05bda478f4595abea7705e00c54",
  },
  {
    url: "assets/css/demo1/skins/brand/light.css",
    revision: "202f064a181b986249028aa3e89afca6",
  },
  {
    url: "assets/css/demo1/skins/brand/light.js",
    revision: "600b2394aabccaebf895a833136791b4",
  },
  {
    url: "assets/css/demo1/skins/brand/light.rtl.css",
    revision: "202f064a181b986249028aa3e89afca6",
  },
  {
    url: "assets/css/demo1/skins/brand/navy.css",
    revision: "bc444ca000f8c6c9417b3165e9f6152f",
  },
  {
    url: "assets/css/demo1/skins/brand/navy.js",
    revision: "d9731ce1820a21b95859dc3155773bf8",
  },
  {
    url: "assets/css/demo1/skins/brand/navy.rtl.css",
    revision: "bc444ca000f8c6c9417b3165e9f6152f",
  },
  {
    url: "assets/css/demo1/skins/header/base/brand.css",
    revision: "968688cd15a6c4f18fd601759f1d13ed",
  },
  {
    url: "assets/css/demo1/skins/header/base/brand.rtl.css",
    revision: "6dfd4e75951597dfc829608ad3303195",
  },
  {
    url: "assets/css/demo1/skins/header/base/light.css",
    revision: "c159632d46f56b9807a485a0732dd01d",
  },
  {
    url: "assets/css/demo1/skins/header/base/light.rtl.css",
    revision: "5a1f23e1f47a6c9154bed2f55c4fd388",
  },
  {
    url: "assets/css/demo1/skins/header/base/navy.css",
    revision: "0cbda6c0e2577119bf5ecf79966cf9f7",
  },
  {
    url: "assets/css/demo1/skins/header/base/navy.rtl.css",
    revision: "e1c991d778ae30c4a6b60e1c0f6c3307",
  },
  {
    url: "assets/css/demo1/skins/header/menu/dark.css",
    revision: "d41d8cd98f00b204e9800998ecf8427e",
  },
  {
    url: "assets/css/demo1/skins/header/menu/dark.rtl.css",
    revision: "d41d8cd98f00b204e9800998ecf8427e",
  },
  {
    url: "assets/css/demo1/skins/header/menu/light.css",
    revision: "ab37a7bbc046c724329537849cba092a",
  },
  {
    url: "assets/css/demo1/skins/header/menu/light.rtl.css",
    revision: "e8e18130dc57e1d45a01aa29a875a32d",
  },
  {
    url: "assets/css/demo1/style.bundle.css",
    revision: "551e14128c8e019ca61bdde8881d03d9",
  },
  {
    url: "assets/css/demo1/style.bundle.js",
    revision: "fcda0f6cd5f0700ffb4337cf2a2eba53",
  },
  {
    url: "assets/css/demo1/style.bundle.rtl.css",
    revision: "24be48ca0eee28f9cb306299a59c3bb2",
  },
  {
    url: "assets/js/demo1/pages/components/base/popovers.js",
    revision: "5a285d5ac480f14dffc26c08104ec436",
  },
  {
    url: "assets/js/demo1/pages/components/base/toasts.js",
    revision: "8dccb4743bf074d17e98f6cdbefc4dbd",
  },
  {
    url: "assets/js/demo1/pages/components/base/tooltips.js",
    revision: "0e646f8a085e37e29c7d65cb1eacc726",
  },
  {
    url: "assets/js/demo1/pages/components/calendar/agenda-week.js",
    revision: "46a5840e881d3bc10525f63ad1ca540f",
  },
  {
    url: "assets/js/demo1/pages/components/calendar/basic.js",
    revision: "3202fe168ab94262f2cb04fefb1dd4f2",
  },
  {
    url: "assets/js/demo1/pages/components/calendar/external.js",
    revision: "93c4c270ab8119fb9791758892b79072",
  },
  {
    url: "assets/js/demo1/pages/components/calendar/google.js",
    revision: "804d4084640e96fa26181988cb90450e",
  },
  {
    url: "assets/js/demo1/pages/components/calendar/list-view.js",
    revision: "12148e4f8d1371aa8e965b9403739834",
  },
  {
    url: "assets/js/demo1/pages/components/calendar/rendering.js",
    revision: "dbbeabf7c14e5a684be674d95d292036",
  },
  {
    url: "assets/js/demo1/pages/components/charts/chart-js.js",
    revision: "f63178ec1976b0ea331da88ab4e6161a",
  },
  {
    url: "assets/js/demo1/pages/components/charts/flotcharts.js",
    revision: "507be530f417a922bf5afa565ca9f239",
  },
  {
    url: "assets/js/demo1/pages/components/charts/google-charts.js",
    revision: "946bf6419a0e0f87b621181f2c1e1266",
  },
  {
    url: "assets/js/demo1/pages/components/charts/morris-charts.js",
    revision: "9526414138e00db1efe76ec151c96aa5",
  },
  {
    url:
      "assets/js/demo1/pages/components/datatables/advanced/column-rendering.js",
    revision: "d06fad24c39cc0a210569700454672db",
  },
  {
    url:
      "assets/js/demo1/pages/components/datatables/advanced/column-visibility.js",
    revision: "0c1f09dcb07686516fd8fe76b471ec7d",
  },
  {
    url:
      "assets/js/demo1/pages/components/datatables/advanced/footer-callback.js",
    revision: "f503081c36eb8b2aaac8568063233340",
  },
  {
    url:
      "assets/js/demo1/pages/components/datatables/advanced/multiple-controls.js",
    revision: "5918a61d6d1877136d4c954b1c54327c",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/advanced/row-callback.js",
    revision: "ecae8887cdb4977e45cc0406d3d14285",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/advanced/row-grouping.js",
    revision: "326e2b8b824285fd38796ff3b20f4355",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/basic/basic.js",
    revision: "a69bbd418620feeea93f82ee067101d3",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/basic/headers.js",
    revision: "a226dd340b54bd5fcc70dccec381918d",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/basic/paginations.js",
    revision: "8da81dca2cdd0ce6571877aaaac7a32a",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/basic/scrollable.js",
    revision: "01ad337a02dfadf50e9391bc6129ee21",
  },
  {
    url:
      "assets/js/demo1/pages/components/datatables/data-sources/ajax-client-side.js",
    revision: "03e2f2d46e2a9513a319f0adb77dd8a1",
  },
  {
    url:
      "assets/js/demo1/pages/components/datatables/data-sources/ajax-server-side.js",
    revision: "179531d0967e6fe7f5660b0c1871e62d",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/data-sources/html.js",
    revision: "a74cba6b72bbd477398fc4687b9a5914",
  },
  {
    url:
      "assets/js/demo1/pages/components/datatables/data-sources/javascript.js",
    revision: "fd8eb295d50c964f043c275ed523b2e7",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/extensions/buttons.js",
    revision: "7b3299f1e35e2378991483bbe64f206b",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/extensions/colreorder.js",
    revision: "26b07ba8ed6d11aaee6f393fcf8df4ef",
  },
  {
    url:
      "assets/js/demo1/pages/components/datatables/extensions/fixedcolumns.js",
    revision: "af748fb4734829159fc5c309c5ed9689",
  },
  {
    url:
      "assets/js/demo1/pages/components/datatables/extensions/fixedheader.js",
    revision: "1be5ef0a6daa2197444a70e0903c1d4d",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/extensions/keytable.js",
    revision: "ac254794e7625a559fe5f48e4f35f6f7",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/extensions/responsive.js",
    revision: "84050680c257cec1620c715945e9fc5a",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/extensions/rowgroup.js",
    revision: "677841913d9b4b31aa0ac326e3c324b9",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/extensions/rowreorder.js",
    revision: "6ba10db91a0c432c30b4e55bb167f719",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/extensions/scroller.js",
    revision: "a690d9101b092a3fe15151355f687c78",
  },
  {
    url: "assets/js/demo1/pages/components/datatables/extensions/select.js",
    revision: "41957bc18fce5aa18d3b72c977748782",
  },
  {
    url:
      "assets/js/demo1/pages/components/datatables/search-options/advanced-search.js",
    revision: "b3bfaab564dc74c8e6b0169726abd3a9",
  },
  {
    url:
      "assets/js/demo1/pages/components/datatables/search-options/column-search.js",
    revision: "6189a29be6b3bcc92ab922eb0b041e90",
  },
  {
    url: "assets/js/demo1/pages/components/extended/blockui.js",
    revision: "04eae66f22725d813e19180eb22a22ce",
  },
  {
    url: "assets/js/demo1/pages/components/extended/dual-listbox.js",
    revision: "39acce11ea288c13fd7a9b89f03f86a6",
  },
  {
    url: "assets/js/demo1/pages/components/extended/idle-timer.js",
    revision: "0c261bccaab56be9901997edfccfcb4f",
  },
  {
    url: "assets/js/demo1/pages/components/extended/session-timeout.js",
    revision: "15155c3833240b6cb14fa913ab5d4e9d",
  },
  {
    url: "assets/js/demo1/pages/components/extended/sticky-panels.js",
    revision: "8a135c6ca6a9e608123be284b65a076a",
  },
  {
    url: "assets/js/demo1/pages/components/extended/sweetalert2.js",
    revision: "947803c3b31e7cd15246154334342524",
  },
  {
    url: "assets/js/demo1/pages/components/extended/toastr.js",
    revision: "cdbee5300c310cfd97dd40cbb34669ac",
  },
  {
    url: "assets/js/demo1/pages/components/extended/treeview.js",
    revision: "27aefa6bb932ab3a4ce303b778a64077",
  },
  {
    url: "assets/js/demo1/pages/components/extended/uppy.js",
    revision: "947c81f1b8f267641f2aa4edd0941bc4",
  },
  {
    url: "assets/js/demo1/pages/components/forms/controls/avatar.js",
    revision: "07505cc87f83d1c90857d7ac1d67220f",
  },
  {
    url: "assets/js/demo1/pages/components/forms/layouts/repeater.js",
    revision: "509dc86e09f0405aaf92d10d1b82595f",
  },
  {
    url: "assets/js/demo1/pages/components/forms/validation/controls.js",
    revision: "13ad727c713baa807b6c770d02e799ef",
  },
  {
    url: "assets/js/demo1/pages/components/forms/validation/widgets.js",
    revision: "08c2e53f74f74ed71fd68d7fae27d13b",
  },
  {
    url: "assets/js/demo1/pages/components/forms/widgets/autosize.js",
    revision: "4d49a25096813508b92303bb4e2e3b39",
  },
  {
    url:
      "assets/js/demo1/pages/components/forms/widgets/bootstrap-datepicker.js",
    revision: "a269126f28a4a33960da6309c331754f",
  },
  {
    url:
      "assets/js/demo1/pages/components/forms/widgets/bootstrap-daterangepicker.js",
    revision: "d34b78ea817446ca6e9c183bdaedfe50",
  },
  {
    url:
      "assets/js/demo1/pages/components/forms/widgets/bootstrap-datetimepicker.js",
    revision: "e6fa49b0f93dddb28704591db78100e9",
  },
  {
    url: "assets/js/demo1/pages/components/forms/widgets/bootstrap-markdown.js",
    revision: "f6f223ae4f671a733649fd90fca5ae40",
  },
  {
    url:
      "assets/js/demo1/pages/components/forms/widgets/bootstrap-maxlength.js",
    revision: "53ec28b4624c176e2020170001503379",
  },
  {
    url:
      "assets/js/demo1/pages/components/forms/widgets/bootstrap-multipleselectsplitter.js",
    revision: "636494d8c6905d0d42103443cb21ce8c",
  },
  {
    url: "assets/js/demo1/pages/components/forms/widgets/bootstrap-select.js",
    revision: "42c6dd7bb5ccc34196b1d3bf4c8ebd91",
  },
  {
    url:
      "assets/js/demo1/pages/components/forms/widgets/bootstrap-timepicker.js",
    revision: "df5c1cba0899d39900dc25700a4eb364",
  },
  {
    url:
      "assets/js/demo1/pages/components/forms/widgets/bootstrap-touchspin.js",
    revision: "25b49ea886a6dbbb0589d32fe396ebed",
  },
  {
    url: "assets/js/demo1/pages/components/forms/widgets/clipboard.js",
    revision: "6d0b119bb8071ab7c400f67f38362645",
  },
  {
    url: "assets/js/demo1/pages/components/forms/widgets/dropzone.js",
    revision: "87531fc3260b6c9778bb1060932c66f0",
  },
  {
    url: "assets/js/demo1/pages/components/forms/widgets/input-mask.js",
    revision: "cba424899ac050095544519c4ea4edaa",
  },
  {
    url: "assets/js/demo1/pages/components/forms/widgets/nouislider.js",
    revision: "136af76ace5fa8fcbd8803ba44e2bfcc",
  },
  {
    url: "assets/js/demo1/pages/components/forms/widgets/quill.js",
    revision: "e42ffaa0781329a9326b4f0e3280793e",
  },
  {
    url: "assets/js/demo1/pages/components/forms/widgets/summernote.js",
    revision: "e01394a6560d322ecb1cc45415d54e8b",
  },
  {
    url: "assets/js/demo1/pages/components/forms/widgets/typeahead.js",
    revision: "0f43b1a76378db72ec3bbda446c41bb8",
  },
  {
    url:
      "assets/js/demo1/pages/components/keen-datatable/advanced/column-rendering.js",
    revision: "828153ed7f87116532306c15c0d668fd",
  },
  {
    url:
      "assets/js/demo1/pages/components/keen-datatable/advanced/column-width.js",
    revision: "8514fc9b1e866622f8629cd3a5704c0e",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/advanced/modal.js",
    revision: "8d30eb778f64683b1b0907ebc363d57a",
  },
  {
    url:
      "assets/js/demo1/pages/components/keen-datatable/advanced/record-selection.js",
    revision: "ebb41e283ae81d1739a1cd72f30bc814",
  },
  {
    url:
      "assets/js/demo1/pages/components/keen-datatable/advanced/row-details.js",
    revision: "53c24b738d1b68f4de1b1a307555bf85",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/api/events.js",
    revision: "c86127c504efc0f49b17d3b2095c13c2",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/api/methods.js",
    revision: "48b83b594a1512c31cc348db7c377f98",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/base/data-ajax.js",
    revision: "2764e90fa23478d47af3f87b20b0103b",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/base/data-json.js",
    revision: "6378bf65821baee46359b8674459745d",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/base/data-local.js",
    revision: "a7c1e49bdb028bb15177468b6724cf5e",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/base/html-table.js",
    revision: "8bf12295beb372f2a647b04a497f6d32",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/base/local-sort.js",
    revision: "bdb0f8c12a171757f8fec9078470df34",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/base/translation.js",
    revision: "636b5e79e9ee1047519ad604730d94d5",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/child/data-ajax.js",
    revision: "038a88aef122dfcacced279c844af2af",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/child/data-local.js",
    revision: "7d537f930e6014de073f7aacd34bba07",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/locked/both.js",
    revision: "843b8979b1f004eb93446b7f3daaa20e",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/locked/html-table.js",
    revision: "4ef3b5aab4a4790aa23ad3b4064a8242",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/locked/left.js",
    revision: "edb27ee6a5f08407c6fbf87b3e5bea18",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/locked/right.js",
    revision: "18da7deefe196ec81ba0d5afd2e9aac7",
  },
  {
    url: "assets/js/demo1/pages/components/keen-datatable/scrolling/both.js",
    revision: "d0b7fc27a52f582bb7ed32c7d6999320",
  },
  {
    url:
      "assets/js/demo1/pages/components/keen-datatable/scrolling/horizontal.js",
    revision: "62bfbe1eb9e0a6c4d3c2fb7ec778cbd8",
  },
  {
    url:
      "assets/js/demo1/pages/components/keen-datatable/scrolling/vertical.js",
    revision: "f0924fcc02f1be28921ae01d3c7b253d",
  },
  {
    url: "assets/js/demo1/pages/components/portlets/draggable.js",
    revision: "9280523cf3ece0615b2e147a031b8eb3",
  },
  {
    url: "assets/js/demo1/pages/components/portlets/tools.js",
    revision: "82329b206122ec0694f290078df5337f",
  },
  {
    url: "assets/js/demo1/pages/custom/profile/overview-1.js",
    revision: "d6341e61a3a254a80166b7060fd86dab",
  },
  {
    url: "assets/js/demo1/pages/custom/profile/overview-2.js",
    revision: "d41d8cd98f00b204e9800998ecf8427e",
  },
  {
    url: "assets/js/demo1/pages/custom/profile/overview-3.js",
    revision: "634e8586febadb593a342d09fd80a4fd",
  },
  {
    url: "assets/js/demo1/pages/custom/profile/profile.js",
    revision: "726a00319580d30e15ab668d6262f2a2",
  },
  {
    url: "assets/js/demo1/pages/custom/user/login.js",
    revision: "8971778a9cc0ad74eeea6d9ed8a7b87f",
  },
  {
    url: "assets/js/demo1/pages/custom/user/profile.js",
    revision: "d5cae55ebea2adfdcefa272b2892b384",
  },
  {
    url: "assets/js/demo1/pages/custom/users/add.js",
    revision: "739b8040f1d07abafc6ba8bc8c1162ab",
  },
  {
    url: "assets/js/demo1/pages/custom/users/edit.js",
    revision: "3519d63664df783d8350d27c59c3de42",
  },
  {
    url: "assets/js/demo1/pages/custom/users/list-columns.js",
    revision: "30737ecb480efd745cd428a672cb9bdc",
  },
  {
    url: "assets/js/demo1/pages/custom/users/list-datatable.js",
    revision: "c9913b888fe334a45c6232a63677abf3",
  },
  {
    url: "assets/js/demo1/pages/custom/users/list-row.js",
    revision: "d1beeb37013d4ca7d4d1fdb2992c44a8",
  },
  {
    url: "assets/js/demo1/pages/custom/wizards/wizard-v1.js",
    revision: "cb1b3727854ccd891dd8396debf2a878",
  },
  {
    url: "assets/js/demo1/pages/custom/wizards/wizard-v2.js",
    revision: "6b4675c86671b329b4adbd34fb445379",
  },
  {
    url: "assets/js/demo1/pages/custom/wizards/wizard-v3.js",
    revision: "822aa437ac1f73433414147b88018e70",
  },
  {
    url: "assets/js/demo1/pages/custom/wizards/wizard-v4.js",
    revision: "45972a53975b8f9b1ab35380968ba49a",
  },
  {
    url: "assets/js/demo1/pages/dashboard.js",
    revision: "04855f70dbf736ff18827a0889807ab1",
  },
  {
    url: "assets/js/demo1/pages/layout/builder.js",
    revision: "55d6798e55da4813e485e1cf959b07a5",
  },
  {
    url: "assets/js/demo1/scripts.bundle.js",
    revision: "faaaed9e685c8313bfe60468d9ef3c79",
  },
  
  {
    url: "assets/vendors/custom/datatables/datatables.bundle.css",
    revision: "0de183e3ea37a7248ff95c427697612e",
  },
  {
    url: "assets/vendors/custom/datatables/datatables.bundle.rtl.css",
    revision: "585ea12a2f08d4c7ce8292643439a596",
  },
  {
    url: "assets/vendors/custom/flot/flot.bundle.js",
    revision: "1e6e29460609299bcda5b1329a6c6fd2",
  },
  {
    url: "assets/vendors/custom/fullcalendar/fullcalendar.bundle.css",
    revision: "08a70707afa6453b25e4660397661647",
  },
  {
    url: "assets/vendors/custom/fullcalendar/fullcalendar.bundle.js",
    revision: "850feba2313fe622cb81b1cd68e3cb73",
  },
  {
    url: "assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css",
    revision: "95a5349d46a95d1faf864801dd196dc5",
  },
  {
    url: "assets/vendors/custom/gmaps/gmaps.js",
    revision: "f37c72e6faee5bff49ae5c7cb05af356",
  },
  {
    url: "assets/vendors/custom/jquery-ui/images/ui-icons_444444_256x240.png",
    revision: "f4ebe485bc50abaf580cf6ae9895dde5",
  },
  {
    url: "assets/vendors/custom/jquery-ui/images/ui-icons_555555_256x240.png",
    revision: "d70c49a1750e399344e77737be6eac71",
  },
  {
    url: "assets/vendors/custom/jquery-ui/images/ui-icons_777620_256x240.png",
    revision: "03c85664fb3ba7db61e1b0c6da73b1ae",
  },
  {
    url: "assets/vendors/custom/jquery-ui/images/ui-icons_777777_256x240.png",
    revision: "6d28e77dd32aa1e61433d5ba3d93ca86",
  },
  {
    url: "assets/vendors/custom/jquery-ui/images/ui-icons_cc0000_256x240.png",
    revision: "bd6996f9c0921f5e744aba81d3dadd84",
  },
  {
    url: "assets/vendors/custom/jquery-ui/images/ui-icons_ffffff_256x240.png",
    revision: "e33c878c8e1b176d439484ca0a094ec4",
  },
  {
    url: "assets/vendors/custom/jquery-ui/jquery-ui.bundle.css",
    revision: "6b50e9b4d54d34f45aa0838348f4d046",
  },
  {
    url: "assets/vendors/custom/jquery-ui/jquery-ui.bundle.js",
    revision: "09bd53a0a522f7929ebbad0db56431aa",
  },
  {
    url: "assets/vendors/custom/jquery-ui/jquery-ui.bundle.rtl.css",
    revision: "086d06738556ffb274e094548db71312",
  },
  {
    url: "assets/vendors/custom/jstree/images/32px.png",
    revision: "e1d0c01e695c145fdd66ecc07e06268e",
  },
  {
    url: "assets/vendors/custom/jstree/images/throbber.gif",
    revision: "5e55c38fe2e0190f5aaa9f6bc250e428",
  },
  {
    url: "assets/vendors/custom/jstree/jstree.bundle.css",
    revision: "6028ba9f4c140b840b9b6a0dcc8888fd",
  },
  {
    url: "assets/vendors/custom/jstree/jstree.bundle.js",
    revision: "eeb830a71f511a57f23c2a74f36cbb66",
  },
  {
    url: "assets/vendors/custom/jstree/jstree.bundle.rtl.css",
    revision: "1bdbe429ac6f7a628425dcc6278fb93d",
  },
  {
    url: "assets/vendors/custom/uppy/uppy.bundle.css",
    revision: "0572b24b085c90e60ff1c3ec43ef8113",
  },
  {
    url: "assets/vendors/custom/uppy/uppy.bundle.js",
    revision: "b32e87b15c2c4390ee21cdb66b4c5584",
  },
  {
    url: "assets/vendors/custom/uppy/uppy.bundle.rtl.css",
    revision: "2a0b46de4dcb4354719ef6edeefdab4c",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-brands-400.eot",
    revision: "14c590d124662eb50efa4c00f027b79c",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-brands-400.svg",
    revision: "bfa9c38bd6081dafe7278dedc4aad1d9",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-brands-400.ttf",
    revision: "5e8aa9ea0ebcd2218178f554cdd8e6b0",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-brands-400.woff",
    revision: "df02c782834b113d605d8329368737b4",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-brands-400.woff2",
    revision: "3e1b2a654a784ceb385157140b4ccd71",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-regular-400.eot",
    revision: "aa66d0e0e38c75666e98db33abae955e",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-regular-400.svg",
    revision: "95f13e0be408d117bd3d9b366084a3ef",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-regular-400.ttf",
    revision: "285a9d2a28886ad64c4e45cbd733cf7c",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-regular-400.woff",
    revision: "5623624dd1b017c66c29d1ac69cdcfa3",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-regular-400.woff2",
    revision: "ac21cac3f22cc9642f5af32e0c750797",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-solid-900.eot",
    revision: "42e1fbd2cf655a0b44a2dfae9ca2f8c1",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-solid-900.svg",
    revision: "6ed5e3bc9018d2a03e2f1fadbf8a0a4a",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-solid-900.ttf",
    revision: "896e20e26ad07dc63c9526ed814117e9",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-solid-900.woff",
    revision: "3ded831d708bf90b2da86756551b5c1c",
  },
  {
    url: "assets/vendors/global/fonts/@fortawesome/fa-solid-900.woff2",
    revision: "d6d8d5da9214dc7d46b297672a602d55",
  },
  {
    url: "assets/vendors/global/fonts/cairo/Cairo.woff",
    revision: "2e7f0fea12a5a76e6e06e699fee09da5",
  },
  {
    url: "assets/vendors/global/fonts/cairo/example.html",
    revision: "e83e5dc3519ae542672d647c71d5c735",
  },
  {
    url: "assets/vendors/global/fonts/cairo/style.css",
    revision: "714385caac0ee8a533970feec4864e62",
  },
  {
    url: "assets/vendors/global/fonts/flaticon/Flaticon.eot",
    revision: "35d544eaaa4cf3c6355866280d53ba73",
  },
  {
    url: "assets/vendors/global/fonts/flaticon/Flaticon.svg",
    revision: "c1729513a8741b7b61bae040816e426f",
  },
  {
    url: "assets/vendors/global/fonts/flaticon/Flaticon.ttf",
    revision: "3e4331ee31764c999add7e0b048c4ba3",
  },
  {
    url: "assets/vendors/global/fonts/flaticon/Flaticon.woff",
    revision: "5be3e43c13c3eb021d15e6682d098d4c",
  },
  {
    url: "assets/vendors/global/fonts/flaticon2/Flaticon2.eot",
    revision: "a690b82a14a1bc812847d18e66001b50",
  },
  {
    url: "assets/vendors/global/fonts/flaticon2/Flaticon2.svg",
    revision: "74a2255d5d8e3a266ab12da6081a7fc3",
  },
  {
    url: "assets/vendors/global/fonts/flaticon2/Flaticon2.ttf",
    revision: "2b7289d4090e4467c289dc8ceac58a73",
  },
  {
    url: "assets/vendors/global/fonts/flaticon2/Flaticon2.woff",
    revision: "5c31a036f8866cb7e22a8e3b44e4f023",
  },
  {
    url: "assets/vendors/global/fonts/flaticon2/Flaticon2.woff2",
    revision: "378c03df9b99ec321f4482a80864da8f",
  },
  {
    url: "assets/vendors/global/fonts/line-awesome/line-awesome.eot",
    revision: "3f85d8035b4ccd91d2a1808dd22b7684",
  },
  {
    url: "assets/vendors/global/fonts/line-awesome/line-awesome.svg",
    revision: "131b7f1e91a652791f08f5ccfe702645",
  },
  {
    url: "assets/vendors/global/fonts/line-awesome/line-awesome.ttf",
    revision: "4d42f5f0c62a8f51e876c14575354a6e",
  },
  {
    url: "assets/vendors/global/fonts/line-awesome/line-awesome.woff",
    revision: "8b1290595e57e1d49d95ff3fa1129ecc",
  },
  {
    url: "assets/vendors/global/fonts/line-awesome/line-awesome.woff2",
    revision: "452a5b42cb4819f09d35bcf6cbdb24c1",
  },
  {
    url: "assets/vendors/global/fonts/socicon/socicon.eot",
    revision: "60e5857089e98edd838074c264d6c951",
  },
  {
    url: "assets/vendors/global/fonts/socicon/socicon.svg",
    revision: "a35b65744f557fab5424e99bb6d4e980",
  },
  {
    url: "assets/vendors/global/fonts/socicon/socicon.ttf",
    revision: "9a64ef938f9e55a70a4defc6ac9790bf",
  },
  {
    url: "assets/vendors/global/fonts/socicon/socicon.woff",
    revision: "944f06f5f65ef84a3a36e6c1c2d4b7ad",
  },
  {
    url: "assets/vendors/global/fonts/summernote/summernote.eot",
    revision: "132b3ed5981617f7629851206740db7b",
  },
  {
    url: "assets/vendors/global/fonts/summernote/summernote.ttf",
    revision: "c7cbf18f23352fb73b7caef86b9aa19e",
  },
  {
    url: "assets/vendors/global/fonts/summernote/summernote.woff",
    revision: "c93a01efecac5681ee7e9dba08a79630",
  },
  {
    url: "assets/vendors/global/img/owl.carousel/ajax-loader.gif",
    revision: "01000918725acebd286de3787fca4ee0",
  },
  {
    url: "assets/vendors/global/img/owl.carousel/owl.video.play.png",
    revision: "4a37f8008959c75f619bf0a3a4e2d7a2",
  },
  {
    url: "assets/vendors/global/vendors.bundle.css",
    revision: "a9f91eb8d329ba26039b4ad925d3ab99",
  },
  {
    url: "assets/vendors/global/vendors.bundle.min.js",
    revision: "40151f207c637d2837be6747a666eb43",
  },
  {
    url: "assets/vendors/global/vendors.bundle.rtl.css",
    revision: "2371f9169b64d29414f2acb33b2ea8f1",
  },
  {
    url: "bootstrap-4.3.1-dist/css/bootstrap-grid.css",
    revision: "59e3488e09a8bc96de5884586f3c67ec",
  },
  {
    url: "bootstrap-4.3.1-dist/css/bootstrap-grid.min.css",
    revision: "7aba9868c6ffadaf2c45d1bafe86d2c3",
  },
  {
    url: "bootstrap-4.3.1-dist/css/bootstrap-reboot.css",
    revision: "b53d1eaf9daeab26f2772281ae060120",
  },
  {
    url: "bootstrap-4.3.1-dist/css/bootstrap-reboot.min.css",
    revision: "220e4dc01283a9e9c5c146f984eb8934",
  },
  {
    url: "bootstrap-4.3.1-dist/css/bootstrap.css",
    revision: "bd551f56ce2be3eba2812e605ab4f5b2",
  },
  {
    url: "bootstrap-4.3.1-dist/css/bootstrap.min.css",
    revision: "a15c2ac3234aa8f6064ef9c1f7383c37",
  },
  {
    url: "bootstrap-4.3.1-dist/css/toast.css",
    revision: "c277b74bb7960f4a79c2fa7e6530a4f7",
  },
  {
    url: "bootstrap-4.3.1-dist/js/bootstrap.bundle.js",
    revision: "a9247b1fe21ee409d0b37e74100de687",
  },
  {
    url: "bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js",
    revision: "a454220fc07088bf1fdd19313b6bfd50",
  },
  {
    url: "bootstrap-4.3.1-dist/js/bootstrap.js",
    revision: "7f827fe484ec04346553202782b0664b",
  },
  {
    url: "bootstrap-4.3.1-dist/js/bootstrap.min.js",
    revision: "e1d98d47689e00f8ecbc5d9f61bdb42e",
  },
  {
    url: "bootstrap-4.3.1-dist/js/jquery-3.2.1.min.js",
    revision: "c9f5aeeca3ad37bf2aa006139b935f0a",
  },
  { url: "Cairo.ttf", revision: "0387a0b8b59d6b26cb736ec76d5045b0" },
  {
    url: "Cairofont.woff2",
    revision: "2bc71088819b2156b8b135db52f95065",
  },
  {
    url: "Cairofont2.woff2",
    revision: "0f76f616dfdcbec3148d8e934486ba97",
  },
  
  { url: "index.php", revision: "f1c474e85b8bb6edfd2667844d257df5" },
  { url: "install.php", revision: "23736ba16f9cf4d7c1eb3fde1eded1e7" },
  { url: "js/alert.js", revision: "f13b73a2ea45588cc618f355731216be" },
  { url: "js/app.js", revision: "d41d8cd98f00b204e9800998ecf8427e" },
  { url: "js/charts.js", revision: "e6b351a021414530cd42a228f0ae0427" },
  {
    url: "js/firebase-sw.js",
    revision: "1a1038b37f3a2b124fc877a838a3f046",
  },
  {
    url: "js/getAllDrivers.js",
    revision: "bf742a8f8127d051503cd267934d8eb5",
  },
  {
    url: "js/getBraches.js",
    revision: "6bca9c786f09fb356e82829026b52393",
  },
  {
    url: "js/getCities.js",
    revision: "7f31ad2532e72f3e7dc494a398d05ab0",
  },
  {
    url: "js/getClients.js",
    revision: "ac53111ca01de4428695183defc84796",
  },
  {
    url: "js/getDrivers.js",
    revision: "1e64af85296e71c32461996f76f5d85d",
  },
  {
    url: "js/getManagers.js",
    revision: "d08e848f9dc9ca43ea9e8bcf45e3130c",
  },
  {
    url: "js/getorderStatus.js",
    revision: "cb96f388f3e178a58b1232590c375893",
  },
  { url: "js/getRoles.js", revision: "97bbbb71e8388061fb249338015d9f35" },
  {
    url: "js/getStores.js",
    revision: "c0260a6f59f6fe2d7dd67f166b73baf9",
  },
  { url: "js/getTowns.js", revision: "0694794ac52bb803616192c23b3243e2" },
  { url: "js/location.js", revision: "a82468c64c8f410b6d486eb68bc88068" },
  { url: "js/popover.js", revision: "36affe2ca6cb85233ee7362c5d8b7893" },
  {
    url: "js/scanner-jquery.js",
    revision: "eb712613eef143d2754bbeaf7c5c4496",
  },
  { url: "js/toast.js", revision: "fae7f854c415e506d7f8d298fa9228e3" },
  { url: "js/webfont.js", revision: "9224f101e832356c17974cffa186ade2" },
  { url: "login.php", revision: "e38f0869b5071a461bb57d65b7dcd7d3" },
 
   {
     url: "pages/addorder.php",
     revision: "1db0e8f3057c2edc830c7259c344c32e",
   },
  {
    url: "pages/addorders.php",
    revision: "22601595f10da0d469c5c6078ab2f460",
  },
  {
    url: "pages/branches.php",
    revision: "adb615e1cf1426c9e6a9c845af5c22ac",
  },
  {
    url: "pages/clients.php",
    revision: "44fcfcc1ce76761a98de46a17f8f865c",
  },
  {
    url: "pages/clientsDetails.php",
    revision: "ec8d873d5acbd9bcbad078dc63bfdbdb",
  },
  {
    url: "pages/companies.php",
    revision: "7e9e595ebb5f2e08b986a0b98e8beb55",
  },
  {
    url: "pages/companyReceipt.php",
    revision: "a66269048f71e80838e2a0cc45eba8fe",
  },
  {
    url: "pages/driverInvoices.php",
    revision: "811109cbfb187f4428b7e24691829188",
  },
  {
    url: "pages/earnings.php",
    revision: "b75430baa89c1bb6d5779a6ef57cc69a",
  },
  {
    url: "pages/editDeleteOrder.php",
    revision: "7264652cc55a902e45116e010980f72e",
  },
  {
    url: "pages/emergencyAccoutn.php",
    revision: "3d10dee9deb4c73ef89e39daad6ec3a7",
  },
  {
    url: "pages/invoices.php",
    revision: "3ba3cf632b6828c9d5851ae7627781b1",
  },
  {
    url: "pages/notefaction.php",
    revision: "3986dd9af7aad4ff496a00cc4b83f293",
  },
  {
    url: "pages/orders.php",
    revision: "b4035607637a93fe8d5d7f9ec8c21eb2",
  },
  {
    url: "pages/ordersActions.php",
    revision: "ba563d968b4bd9d414360a0ce3543dc8",
  },
  {
    url: "pages/orderStatus.php",
    revision: "a04b5e9214e16513a70df4c9dfae23a4",
  },
  {
    url: "pages/posponded.php",
    revision: "93898a2d37f79eaac262a66f83faef4e",
  },
  {
    url: "pages/profile.php",
    revision: "33d6f13bbe613a621a126149ecf3ddd0",
  },
  {
    url: "pages/receipt.php",
    revision: "0542d7a7c5d29f31d456e061e752d0bb",
  },
  {
    url: "pages/reports.php",
    revision: "9f4667682a19be11d246e844cb9ff3f3",
  },
  {
    url: "pages/returned.php",
    revision: "81c25637c0ebd792193c9f6a07474060",
  },
  {
    url: "pages/returnedToCityStore.php",
    revision: "566db89f8af0ed43aeaf987e2774bf20",
  },
  {
    url: "pages/staff.php",
    revision: "4aa00dc864cfce8ae0e0b4a7656c5b19",
  },
  {
    url: "pages/stores.php",
    revision: "0c0ad04042bcb482890c062bfb2fa1c6",
  },
  {
    url: "pages/towns.php",
    revision: "af826206fcadef1de25abbf6596541be",
  },
  {
    url: "partials/_aside-base.php",
    revision: "e5b553f1ba972490b34049bfdbbf342f",
  },
  {
    url: "partials/_aside-brand.php",
    revision: "86d8b9f2667e0b546e766d8c24d0728b",
  },
  {
    url: "partials/_aside-footer.php",
    revision: "a7286832e0e64c59b2c797e332a2409e",
  },
  {
    url: "partials/_aside-menu.php",
    revision: "a0f8656d001816912cde3f85f2991f49",
  },
  {
    url: "partials/_content-base.php",
    revision: "b3ee0f1ca03ee84b22f64dfdef7984b3",
  },
  {
    url: "partials/_dropdown-languages.php",
    revision: "10e9c9bca3c29ffd9bcf5a8e4378d1a5",
  },
  {
    url: "partials/_dropdown-notifications-solid.php",
    revision: "b769cacce958eaa320990a2213efe486",
  },
  {
    url: "partials/_dropdown-search-dropdown.php",
    revision: "4f336840f194c7bbc9803308228e613c",
  },
  {
    url: "partials/_dropdown-user-solid.php",
    revision: "a5168cdd8b93311c4b754d5c23da46b8",
  },
  {
    url: "partials/_footer-base.php",
    revision: "650bc16b6b1af605830afa0f4b9f1bc1",
  },
  {
    url: "partials/_header-base-mobile.php",
    revision: "cd9958c7b313e50a184fc5c4aec179a7",
  },
  {
    url: "partials/_header-base.php",
    revision: "fef285b3789f13a931f749e34f7895ee",
  },
  {
    url: "partials/_header-menu.php",
    revision: "56f1b210efbdf61f263c7414e0adcbd8",
  },
  {
    url: "partials/_layout-demo-panel.php",
    revision: "62e577d147a943c502284ca1eac77f5f",
  },
  {
    url: "partials/_layout-page-loader.php",
    revision: "2c37fdc1d51bd4f979cf6f6fcf6e8995",
  },
  {
    url: "partials/_layout-quick-panel.php",
    revision: "dafdb270c498522ef7d85caede63e7a0",
  },
  {
    url: "partials/_layout-scrolltop.php",
    revision: "b103dd55f1de10665b5b02fc98006eb2",
  },
  {
    url: "partials/_layout-toolbar.php",
    revision: "a79a519cda4d1188a4b764534fbe8701",
  },
  {
    url: "partials/_offcanvas-quick-actions.php",
    revision: "9c7e43a9032259da3b4b2fae56fdb802",
  },
  {
    url: "partials/_subheader-subheader-v1.php",
    revision: "e4f9e801f619abb3aadcd004b4cb55bb",
  },
  {
    url: "partials/_topbar-base.php",
    revision: "d034e2889e27e1c0f899229cf2dea071",
  },
  {
    url: "partials/_topbar-languages.php",
    revision: "52ec386c63c1d669209216400269aa4f",
  },
  {
    url: "partials/_topbar-notifications.php",
    revision: "d9a3d4f49832a72da2574943254575fb",
  },
  {
    url: "partials/_topbar-quick-actions.php",
    revision: "beaa7d5109f3112952f2ce4d7e88b251",
  },
  {
    url: "partials/_topbar-quick-panel.php",
    revision: "6308aa48ef51a0509f066164490944bd",
  },
  {
    url: "partials/_topbar-search.php",
    revision: "1ed2f1a0fd9b2c674b337405c9fe2a94",
  },
  {
    url: "partials/_topbar-user.php",
    revision: "4fe31afb6bb56f004568f7f565283d5b",
  },
  { url: "README.md", revision: "12bfa1ca2343d74d54f4ef19c7c5ce0a" },
].concat(self.__precacheManifest || []);
workbox.precaching.precacheAndRoute(self.__precacheManifest, {});
