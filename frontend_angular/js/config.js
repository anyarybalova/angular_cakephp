
function config($stateProvider, $urlRouterProvider, $ocLazyLoadProvider) {
    $urlRouterProvider.otherwise("/index/main");

    $ocLazyLoadProvider.config({
        debug: false
    });

    $stateProvider

        .state('index', {
            abstract: true,
            url: "/index",
            templateUrl: "views/common/content.html",
        })
        .state('index.main', {
            url: "/main",
            templateUrl: "views/main.html",
            data: { pageTitle: 'Home' }
        })
        .state('index.contract', {
            url: "/package/:package_id/contract/:contract_id",
            templateUrl: "views/contract.html",
            data: { pageTitle: 'Contract' }
        })
        .state('index.lawyers', {
            url: "/lawyers",
            templateUrl: "views/lawyers.html",
            data: { pageTitle: 'Our lawyers' }
        })
        .state('index.askalawyer', {
            url: "/askalawyer",
            templateUrl: "views/askalawyer.html",
            data: { pageTitle: 'Ask a lawyer' }
        })
        .state('index.checkout', {
            url: "/checkout",
            templateUrl: "views/checkout.html",
            data: { pageTitle: 'Checkout' }
        })
}
angular
    .module('lexstart')
    .config(config)
    .run(function($rootScope, $state) {
        $rootScope.$state = $state;
    });
