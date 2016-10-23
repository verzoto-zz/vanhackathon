var app = angular.module('app', []);
var nextAction = undefined;


app.controller('video', function($scope, $http, $location)
{
    var index = 0;
    $scope.video;
    
    $scope.actions = [];
    $scope.currentAction = [];
    $scope.responses = [];
    
    $scope.GetVideoActions = function()
    {
        $http.get('../../api/video/'+video_id).then(function(response){
           $scope.actions = response['data'];
           
           $scope.currentAction = $scope.actions[index];
           nextAction = $scope.currentAction;
           console.log(nextAction);
        });
    }
    
    
    /**
     * 
     * 
     */
    $scope.SendResponses = function()
    {
        $http.put('../../api/choice/'+$scope.responses.selected).then(function(response){
            
            if (response.status == 200)
            {
                player.playVideo();
                $('.overlay').fadeOut('fast');
                
                $scope.GetActionChoices($scope.currentAction.action_description, $scope.currentAction.action_id);
                
                index++;
                if (index < $scope.actions.length)
                {
                    nextAction = $scope.actions[index];
                    $scope.currentAction = nextAction;
                }
                else
                {
                    nextAction = undefined;
                }                
                
            }
            
        });

    }
    
    
    /**
     * 
     * 
     */
    $scope.GetActionChoices = function(action_description, action_id)
    {
        $http.get('../../api/choices/'+action_id).then(function(response){
           $scope.responses = response['data']; 
           $scope.responses.action_description = action_description;
           $('#results').fadeIn('slow');
        });
    }
    
    
    
    $scope.loadVideo = function()
    {
        var video_id = $scope.video.url;
        video_id = video_id.split('?v=');
        player.loadVideoById(video_id[1], 5, "large");
        
        $('#player').fadeIn('slow');
    }
    
    
});


app.controller('form', function($scope){
   
   $scope.form;
   
   $scope.fields = [];
   $scope.fields.push("");
   
   $scope.response = [];
   
   $scope.addField = function()
   {
       $scope.fields.push("");
   }
   
   $scope.AddResponse = function()
   {
       $scope.response.push("");
   }   
   
   $scope.GetVideoDuration = function()
   {
       return videoDuration;
   }
    
});




app.filter('secondsToDateTime', [function() {
    return function(seconds) {
        return new Date(1970, 0, 1).setSeconds(seconds);
    };
}])