var mControllers = angular.module('myApp', []);

mControllers.controller('MainCtrl', ['$scope', '$http', function($scope, $http) {
	$scope.actions = {};
	$scope.list = {};
	$scope.search = {};

	$scope.actions.searchPhotos = function() {
		var requestUrl = "php/search.php";
		var text = $scope.search.text;
		requestUrl += "?action=1&text=" + text;

		$http.get(requestUrl).success(function(response) {
			console.log(response);
			$scope.list.photoList = response.photos.photo;
		});
	};
	$scope.actions.searchPhotosByLatlng = function() {
		var requestUrl = "php/search.php";
		var lat = $scope.search.lat;
		var lon = $scope.search.lon;
		requestUrl += "?action=2&lat=" + lat + "&lon=" + lon;

		$http.get(requestUrl).success(function(response) {
			console.log(response);
			$scope.list.photoList = response.photos.photo;
		});
	};
}]);