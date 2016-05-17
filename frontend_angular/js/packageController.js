function PackageCtrl($scope, $http, $stateParams, $modal, $state, Pagination, $cookieStore){
	
    $scope.showPackages = function(){
        $scope.packages = {};
        var num_rows = 4
        $scope.paginationPackage = Pagination.getNew(num_rows);

        var url =  $scope.url_back +"/packages";

        $http.get(url).success(function(respuesta){
            $scope.packages = respuesta;
            $scope.paginationPackage.numPages = Math.ceil($scope.packages.length/$scope.paginationPackage.perPage);
        });
    };
    
	$scope.getPackageList = function(){
		$scope.packages = {};

		var url =  $scope.url_back +"/packages";
	        $http.get(url).success(function(respuesta){
	        $scope.packages = respuesta;
            //$scope.packages.push(data);

            if($stateParams.package_id){
                $scope.package_id = $stateParams.package_id;

                $scope.selectedPackage = $scope.packages[0];
                $scope.contracts = $scope.selectedPackage.Contract;

                angular.forEach($scope.packages, function(pack, index){
                        if(pack.Package.id == $scope.package_id){
                            $scope.selectedPackage = pack;
                            $scope.contracts = pack.Contract;
                        }
                });

                if($stateParams.contract_id){
                    var Contract = {
                        id : '-1',
                        title: 'All Contracts'
                    };
                    var data = {Contract:Contract};
                    $scope.contracts.push(Contract);
                    $scope.contract_id = $stateParams.contract_id;
                    $scope.selectedContract = $scope.contracts[0];

                    angular.forEach($scope.contracts, function(pack, index){
                            angular.forEach($scope.contracts, function(contract, index){
                                if(contract.id == $scope.contract_id){
                                    $scope.selectedContract = contract;
                                }
                            });
                    });
                }  
            }
            
           
	    });
    };
    

    $scope.showPackageContract = function(){    
        var Contract = {
                    id : '-1',
                    title: 'All Contracts'
        };
        var data = {Contract:Contract};

        $scope.package_id = $scope.selectedPackage.Package.id;
            console.log("PAck: " + $scope.package_id);
            var url =  $scope.url_back+"/packages/view/"+$scope.package_id;
            $http.get(url).success(function(respuesta){
                $scope.contracts = respuesta.Contract;
                $scope.contracts.push(Contract);
                $scope.selectedContract = $scope.contracts[0];
                $scope.contract_id =  $scope.selectedContract.id;
            });
    };
    

    $scope.changeContract = function(){
       
        $scope.package_id = $scope.selectedPackage.Package.id;
        $scope.contract_id = $scope.selectedContract.id;
        
    };

    $scope.addToCartContract = function(pack_id, contract){
        if(!$scope.visitor_id){
            console.log("Please login");
        }

        var Product = {
            type : 'Contract',
            prod_id : $scope.items_to_buy.length,
            price : contract.price,
            pack : $scope.selectedPackage.Package,
            contract : contract
        };

        $scope.items_to_buy.push(Product);
        $cookieStore.put('items_to_buy', $scope.items_to_buy);

        if($scope.items_to_buy.length == 1){
            console.log("Its a first");
           // $scope.openFirstBy();
        }else{
            console.log("total items to buy : "+$scope.items_to_buy.length)
        }
    }

    $scope.addToCartPackage = function(pack){
        if(!$scope.visitor_id){
            console.log("Please login");
        }
        
        var Product = {
            type : 'Package',
            prod_id : $scope.items_to_buy.length,
            price : pack.Package.price,
            pack : pack
        };

        $scope.items_to_buy.push(Product);
        $cookieStore.put('items_to_buy', $scope.items_to_buy);
        if($scope.items_to_buy.length == 1){
            console.log("Its a first");
            //$scope.openFirstBy();
        }else{
            console.log("total items to buy : "+$scope.items_to_buy.length)
        }
    }

    
};