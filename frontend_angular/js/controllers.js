
function MainCtrl($scope,$http, $modal, $cookieStore) {

    $scope.url_back = "http://oficina.vnstudios.com/lexstart/lexstar";
    $scope.img_src = "http://oficina.vnstudios.com/lexstart/lexstart_front/img";

    this.reload = function() {
       $state.go($state.current, {}, {reload: true});
  	};

    $http.get($scope.url_back+'/main/getPathImg').success(function(respuesta){
        $scope.url_lawyer_img = respuesta+'/lawyers_img/';
    });
    

    $scope.paneConfig = {
        showArrows: true,
        autoReinitialise: true
    }
    
    $scope.visitor_id = undefined;
    $scope.items_to_buy = [];
    $scope.items_to_buy = $cookieStore.get('items_to_buy');
    $cookieStore.put('visitor_id', 1);

    $scope.openSignIn = function(){
        var modalInstance = $modal.open({
            templateUrl: '/lexstart/lexstart_front/views/templates/signin.html',
            controller: ModalInstanceCtrl,
            scope: $scope
        });
    };

    $scope.openSignUp = function(){
        var modalInstance = $modal.open({
            templateUrl: '/lexstart/lexstart_front/views/signup.html',
            controller: ModalInstanceCtrl,
            scope: $scope,
            backdrop: 'static',
            keyboard: false
        });
    };

    $scope.openFirstBy = function(){
        var modalInstance = $modal.open({
            templateUrl: '/lexstart/lexstart_front/views/templates/first_by.html',
            controller: ModalInstanceCtrl,
            scope: $scope
        });
    };

    $scope.signup = function(){
        this.cancel();
        this.openSignUp();
    };

};

function ModalInstanceCtrl ($scope, $modalInstance, $state, $cookies) {

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
    .module('lexstart')
    .controller('MainCtrl', MainCtrl)
    .controller('Pagination', Pagination)
    .controller('ContractCtrl', ContractCtrl)
    .controller('PackageCtrl', PackageCtrl)
    .controller('LawyerCtrl', LawyerCtrl)
    .controller('VisitorCtrl', VisitorCtrl)