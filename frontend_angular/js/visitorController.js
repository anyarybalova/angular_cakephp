
function VisitorCtrl($scope, $http, $stateParams, $state, $cookieStore){

    
    $scope.checkPass = function(){
        var pass = $scope.password;
        $scope.error_pass = false;
        $scope.message_pass = "" ;
        
        if(pass.length < 6){
            $scope.error_pass = true;
            $scope.message_pass = ' six characters';
            return;
        }

        var regLower = new RegExp(/[a-z]/);
        if(!regLower.test(pass)){
            $scope.error_pass = true;
            $scope.message_pass = " one Lowercase characters (a through z)" ;
            return;
        }

        var regUpper = new RegExp(/[A-Z]/);
        if(!regUpper.test(pass)){
            $scope.error_pass = true;
            $scope.message_pass = " one Uppercase characters (A through Z)" ;
            return;
        }

        var regNumber = new RegExp(/[0-9]/);
        if(!regNumber.test(pass)){
            $scope.error_pass = true;
            $scope.message_pass = " Numeric (0 through 9)" ;
            return;
        }
        
        var regSpecial = /([.*-+?^~!@#$%&,<>;:{}()|\[\]\/\\])/g;
        if(!regSpecial.test(pass)){
            $scope.error_pass = true;
            $scope.message_pass = "Special characters: ~!@#$%^&*_­+=`|(){}[]:;\"'<>,.?/";
            return;
        }
    };

	 $scope.submitSignUp = function(){
        $scope.errors_signup = false;
        
        if(this.checkEmptyField() && !$scope.error_pass){
            $scope.errors_signup = true;
        }else{

            var Visitor = {
                    first_name : $scope.first_name,
                    last_name : $scope.last_name,
                    company_name : $scope.company_name,
                    location : "ca",
                    email : $scope.email,
                    password : $scope.password
            };
            var data = {Visitor:Visitor};
            
            var url =  $scope.url_back + "/visitors/add";
                $http.post(url, data).success(function(response){
                    if(response.success){
                        $scope.errors_signup = false;
                        $scope.cancel();
                        $scope.visitor_id = response.content.Visitor.id;
                        $cookieStore.put('visitor_id', $scope.visitor_id);
                        $state.go($state.current, {}, {reload: true});
                    }else{
                        //$scope.form_errors = response.errors;
                        $scope.errors_signup = true;
                        alert("Please capture mandatory information.");
                        return false;
                    }    
            });
        }       
    };

    $scope.submitSignIn = function(){
        $scope.errors_signin = false;
        
        if($scope.email && $scope.pass){

            var Visitor = {
                    email : $scope.email,
                    password : $scope.password
            };

            var data = {Visitor:Visitor};
            
            var url =  $scope.url_back + "/visitors/signin";
                $http.post(url, data).success(function(response){
                    if(response.success){
                        $scope.errors_signin = false;
                        $scope.cancel();
                        $scope.visitor_id = response.content.Visitor.id;
                        $cookieStore.put('visitor_id', $scope.visitor_id);
                        $state.go($state.current, {}, {reload: true});
                    }else{
                        //$scope.form_errors = response.errors;
                        $scope.errors_signup = true;
                        alert("Invalid email or password.");
                        return false;
                    }    
            });
        }       
    };


    $scope.checkEmptyField = function(){
        if(!$scope.first_name || !$scope.last_name || !$scope.company_name || !$scope.email || !$scope.password ){

            return true;
        }else{
            return false;
        }
    };

    $scope.cancelSubmit = function(){
        if($scope.first_name || $scope.last_name || $scope.company_name || $scope.email || $scope.password ){
            if(confirm( "“Your data will be lost, please save the data first”")){
                }else{
                    $scope.cancel();
                }
        }
        else{
            $scope.cancel();
        }
    };

    $scope.countTotal = function(){
        var products = $scope.items_to_buy;
        $scope.totalPrice = 0;
        angular.forEach(products, function(prod, index){
            $scope.totalPrice += parseInt(prod.price);
        });
    };

    $scope.removeProduct = function(prod_id){

        var products = $scope.items_to_buy;

        angular.forEach($scope.items_to_buy, function(prod, index){
            if(prod.prod_id == prod_id){
                $scope.totalPrice -= prod.price;
                $scope.items_to_buy.splice(index, 1);
            }
        });


        $cookieStore.put('items_to_buy', $scope.items_to_buy);

        if($scope.items_to_buy.length == 0){
            $scope.totalPrice = 0;
            $state.go("index.main");
        }
    };
};
