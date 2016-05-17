/**
 * INSPINIA - Responsive Admin Theme
 * Copyright 2015 Webapplayers.com
 *
 */

/**
 * MainCtrl - controller
 */
function MainCtrl($scope, $http, $state) {

    this.userName = 'Administrator';
    this.helloText = 'Welcome to Lexstart';
    this.descriptionText = '';

    $scope.url_back = "http://oficina.vnstudios.com/lexstart/lexstar";
    
    $scope.PAGER_CONTRACT_ROWS = 5;
    $scope.PAGER_PACKAGE_ROWS  = 5;
    $scope.PAGER_LAWYER_ROWS   = 6;

    $scope.refresh = function() {
       $state.go($state.current, {}, {reload: true});
  	};

    $http.get($scope.url_back+'/main/getPathImg').success(function(respuesta){
        $scope.url_lawyer_img = respuesta+'/lawyers_img/';
    });
};


function ModalInstanceCtrl ($scope, $modalInstance, $state) {

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    $scope.ok = function (func_ok,id) {
    	$scope.$emit(func_ok, {
	        id: id
    	});
    	$state.go($state.current, {}, {reload: true});
        $modalInstance.close();
    };
};


function Pagination($scope, Pagination){
    //var num_rows = 4
    //$scope.pagination = Pagination.getNew(num_rows);
};

angular
    .module('inspinia')
    .controller('MainCtrl', MainCtrl)
    .controller('Pagination', Pagination)
    .controller('ContractCtrl', ContractCtrl)
    .controller('PackageCtrl', PackageCtrl)
    .controller('LawyerCtrl', LawyerCtrl)