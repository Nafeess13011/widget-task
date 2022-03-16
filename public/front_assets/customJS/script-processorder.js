var myApp = angular.module('project',["smart-table"], function(){});
myApp.controller('projectinfo',function($scope,$rootScope,$timeout,$http,$location,$window,$filter,$q,$routeParams) {
   
	$scope.widget = {};
	$scope.widget.size = "";
	$scope.salelist = "";

	 $scope.processorder = function(){
    var obj = new Object();
    obj.widget =  $scope.widget;
    var temp = $.param({widgets:$scope.widget.size});
    $http({
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        data: temp,
        url: siteurl+"processorder",
        method: "POST"
    }).success(function (data) {
        if(data.flag == false){
            toastr.error(data.msg,'',{timeOut:150})
        }
        else{
            $scope.salelist = data.total_occurrences;
			$scope.displayedCollectionsale = $scope.salelist;
        }
    })
   }

	
	
})
.config(function ($httpProvider, $provide) {
    $provide.factory('httpInterceptor', function ($q, $rootScope) {
        return {
            'request': function (config) {
            	
            	//$.LoadingOverlay("show"); 
            	
                $rootScope.$broadcast('httpRequest', config);
                return config || $q.when(config);
            },
            'response': function (response) {
            	//$.LoadingOverlay("hide");
            	if(typeof response.data != 'object'){ //might have some error
            		 
            		var temp = response.data.toLowerCase();
            		if(temp.indexOf("error") >= 0){  //result may have error
            			console.log("Response is not obj and has Error");
            			$("div#error").html(response.data);
                    	jQuery("#errorModal").modal('show');
                    	return
                	}
                	
            	}
            	$rootScope.$broadcast('httpResponse', response);
                return response || $q.when(response);
            },
            'requestError': function (rejection) {
            	console.log("requestError");
            	//$.LoadingOverlay("hide");
            	$("div#error").html(rejection.data);
            	jQuery("#errorModal").modal('show');
            	$rootScope.$broadcast('httpRequestError', rejection);
                return $q.reject(rejection);
            },
            'responseError': function (rejection) {
            	//$.LoadingOverlay("hide");
            	console.log("responseError");
            	$("div#error").html(rejection.data);
            	jQuery("#errorModal").modal('show');
            	 $rootScope.$broadcast('httpResponseError', rejection);
                return $q.reject(rejection);
            }
        };
    });
    $httpProvider.interceptors.push('httpInterceptor');
})

