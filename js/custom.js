// $(document).ready(function(){
//   $( ".col-sm-5.col-md-4 > .thumbnail " ).hover(function(){
//     new WOW().init();
//     $(".col-sm-5.col-md-4 > .thumbnail").addClass( "wow shake");       
//   });
// });


var myModule = angular.module('myModule', []);

myModule.controller('workerController',['$scope','$http', function($scope,$http){
    $http.get('http://localhost/Andrew/php/action.php',{params: {action:"workers"}}).then(function(response){
     // console.log(response);
      // console.log(response.data[0].name);
      // console.log(response.data[0].qualities);
      // console.log(response.data[0].available);
      $scope.workers =response.data;
      // $scope.available = response.data[0].available;
      // console.log($scope.workers); 
    });

}]); 

myModule.controller('commentController',['$scope','$http',function($scope,$http){
  //console.log("data data");
   $http.get('http://localhost/Andrew/php/action.php',{params: {action:"comments"}}).then(function(response){
        //console.log(response);
        $scope.comments = response.data;
    });
}]);


myModule.controller('postingComments',['$scope','$http',function($scope,$http){
    $scope.toForm = function(){
      var commentDetails = {
        key : 'postingComments',
        name : $scope.name,
        comment : $scope.comment
      };

       console.log(commentDetails);
      //$http.post('http://localhost/test/action.php',{params: {action: commentDetails}}).then(function(response){
      $http.post('http://localhost/Andrew/php/action.php',{data : commentDetails}).then(function(response){
        console.log(response.data);
        alert(response.data['response']);
        //$scope.message = response.data;
      });
    }
   
}]);

// $(document).ready(function(){
//   $.get('action.php',{action : 'action'},function(data){
//         workerArray = data;
//   });
// });
