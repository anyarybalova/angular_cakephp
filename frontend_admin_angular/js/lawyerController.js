function LawyerCtrl($scope, $http, $stateParams, $modal, $state, Pagination){
	
	$scope.getLawyerList = function(){
		$scope.lawyers = {};
        var num_rows =  $scope.PAGER_LAWYER_ROWS;
        $scope.paginationLawyer = Pagination.getNew(num_rows);


		var url =  $scope.url_back +"/lawyers";
	        $http.get(url).success(function(respuesta){
	        $scope.lawyers = respuesta;
            $scope.paginationLawyer.numPages = Math.ceil($scope.lawyers.length/$scope.paginationLawyer.perPage);
	    });
    }

    $scope.getLawyerDetail = function(){
    	$scope.lawyer = {};
    	var url =  $scope.url_back +"/lawyers/view/"+$stateParams.lawyer_id;
	        $http.get(url).success(function(respuesta){
                if(respuesta.Lawyer == undefined ){
                    $state.go("index.lawyers");
                }
	        $scope.lawyer = respuesta;
	    });
    }

    
    $scope.$on('deleteLawyer', function(event, obj) {    	
    	var url =  $scope.url_back + "/lawyers/delete/"+obj.id;
	        $http.get(url).success(function(respuesta){
	    });
    });

    $scope.openModalDelete = function (lawyer_id, lawyer_first_name, lawyer_last_name) {
    	$scope.first_name = lawyer_first_name;
    	$scope.last_name = lawyer_last_name;
    	$scope.lawyer_id = lawyer_id;

        var modalInstance = $modal.open({
            templateUrl: '/lexstart/lexstart_admin/views/lawyer/deleteLawyer.html',
            controller: ModalInstanceCtrl,
            windowClass: 'small-Modal',
  			scope: $scope
        });
    };

    $scope.getWorkAreas = function(){
    	$scope.areas = []; 
		var url =  $scope.url_back + "/workareas";
	        $http.get(url).success(function(response){
	        var areas = [];
            angular.forEach(response, function(area, index) {
                angular.forEach(area, function(a, item) {
                        areas.push(a);
                });
            });
            $scope.areas = areas;
	    });
      
     //$scope.work_area_id = $scope.areas[$scope.work_area_id];
    }

    $scope.submitFormLawyer = function(){
        var Lawyer = {
                first_name : $scope.first_name,
                last_name : $scope.last_name,
                phone : $scope.phone,
                address : $scope.address,
                work_area_id : $scope.work_area_id ? parseInt($scope.work_area_id.id) : "",
                email : $scope.email,
                password : $scope.password,
                pass_2 : $scope.pass_2,
                company_name : $scope.company_name,
                company_web : $scope.company_web
        };
        var data = {Lawyer:Lawyer};


        var url =  $scope.url_back + "/lawyers/add";
            $http.post(url, data).success(function(response){
                 if(response.success){
                    $state.go("index.lawyers");
                }else{
                    $scope.form_errors = response.errors;
                    return false;
                }  
        });
    };


    $scope.getLawyerDataEdit = function(){
        $scope.fd = new FormData();
        $scope.lawyer = {};
        $scope.lawyer_id = $stateParams.lawyer_id;
        var url =  $scope.url_back +"/lawyers/view/"+$stateParams.lawyer_id;
            $http.get(url).success(function(respuesta){
            var lawyer = respuesta.Lawyer;
            $scope.first_name   = lawyer.first_name;
            $scope.last_name    = lawyer.last_name;
            $scope.phone        = lawyer.phone;
            $scope.address      = lawyer.address;
            $scope.email        = lawyer.email;
            $scope.work_area_id = $scope.areas[parseInt(lawyer.work_area_id) - 1 ];
            $scope.company_name = lawyer.company_name;
            $scope.company_web  = lawyer.company_web;
            $scope.biography    = lawyer.biography;
            $scope.avatar       = lawyer.avatar;
        });

    };

    $scope.editFormLawyer = function(lawyer_id){
        var Lawyer = {
                id : lawyer_id,
                first_name : $scope.first_name,
                last_name : $scope.last_name,
                avatar : $scope.avatar,
                phone : $scope.phone,
                address : $scope.address,
                work_area_id : $scope.work_area_id ? parseInt($scope.work_area_id.id) : "",
                email : $scope.email,
                password : $scope.password,
                pass_2 :  $scope.pass_2,
                company_name : $scope.company_name,
                company_web : $scope.company_web,
                biography : $scope.biography
        };


        var data = {Lawyer:Lawyer};
        $scope.fd.append('data',JSON.stringify(data));

        var url =  $scope.url_back + "/lawyers/edit/"+lawyer_id;
            $http.post(url, $scope.fd ,{
            headers: {'Content-Type': undefined}}).success(function(response){
                    if(response.success){
                        $state.go("index.lawyers");
                    }else{
                        $scope.form_errors = response.errors;
                        return false;
                    }  
        });
    };


    $scope.$on("fileSelected", function (event, args) {
        $scope.$apply(function () {            
            //add the file object to the scope's files collection
            //$scope.files.push(args.file);
        });
       
        $scope.fd.append('file',args.file);
        $scope.file = args.file;
    });

};