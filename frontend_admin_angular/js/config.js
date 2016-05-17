/**
 * INSPINIA - Responsive Admin Theme
 * Copyright 2015 Webapplayers.com
 *
 * Inspinia theme use AngularUI Router to manage routing and views
 * Each view are defined as state.
 * Initial there are written state for all view in theme.
 *
 */
function config($stateProvider, $urlRouterProvider, $ocLazyLoadProvider) {
    $urlRouterProvider.otherwise("/index/main");

    $ocLazyLoadProvider.config({
        // Set to true if you want to see what and when is dynamically loaded
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
            data: { pageTitle: 'Example view' }
        })
        .state('index.contract', {
            url: "/contract/:id",
            templateUrl: "views/contract/detail.html",
            data: { pageTitle: 'Contract Information' }
        })
        .state('index.add_contract', {
            url: "/add_contract",
            templateUrl: "views/contract/add_contract.html",
            data: { pageTitle: 'Add Contract' },
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            name: 'summernote',
                            files: ['css/plugins/summernote/summernote.css','css/plugins/summernote/summernote-bs3.css','js/plugins/summernote/summernote.min.js','js/plugins/summernote/angular-summernote.min.js']
                        }
                    ]);
                }
            }
        })
        .state('index.edit_contract', {
            url: "/edit_contract/:contract_id",
            templateUrl: "views/contract/edit_contract.html",
            data: { pageTitle: 'Edit Contract' },
            resolve: {
                loadPlugin: function ($ocLazyLoad) {
                    return $ocLazyLoad.load([
                        {
                            name: 'summernote',
                            files: ['css/plugins/summernote/summernote.css','css/plugins/summernote/summernote-bs3.css','js/plugins/summernote/summernote.min.js','js/plugins/summernote/angular-summernote.min.js']
                        }
                    ]);
                }
            }
        })
        .state('index.contracts', {
            url: "/contracts",
            templateUrl: "views/contracts.html",
            data: { pageTitle: 'Contracts' }
        })
        .state('index.package', {
            url: "/package/:package_id",
            templateUrl: "views/package/detail.html",
            data: { pageTitle: 'Package Information' }
        })
        .state('index.add_package', {
            url: "/add_package",
            templateUrl: "views/package/add_package.html",
            data: { pageTitle: 'Add Package' }
        })
        .state('index.edit_package', {
            url: "/edit_package/:package_id",
            templateUrl: "views/package/edit_package.html",
            data: { pageTitle: 'Edit Package' }
        })
        .state('index.packages', {
            url: "/packages",
            templateUrl: "views/packages.html",
            data: { pageTitle: 'Packages' }
        })
        .state('index.lawyer', {
            url: "/lawyer/:lawyer_id",
            templateUrl: "views/lawyer/detail.html",
            data: { pageTitle: 'Lawyer Information' }
        })
        .state('index.add_lawyer', {
            url: "/add_lawyer",
            templateUrl: "views/lawyer/add_lawyer.html",
            data: { pageTitle: 'Add Lawyer' }
        })
        .state('index.edit_lawyer', {
            url: "/edit_lawyer/:lawyer_id",
            templateUrl: "views/lawyer/edit_lawyer.html",
            data: { pageTitle: 'Edit Lawyer' }
        })
        .state('index.lawyers', {
            url: "/lawyers",
            templateUrl: "views/lawyers.html",
            data: { pageTitle: 'Lawyers' }
        })
 
}
angular
    .module('inspinia')
    .config(config)
    .run(function($rootScope, $state) {
        $rootScope.$state = $state;
    });
