var app = angular.module("EvoteApp", []);

app.controller("LoginCtrl", function ($scope, $http) {
  $scope.user = {};
  $scope.errorMsg = "";

  $scope.login = function () {
    if (!$scope.user.username || !$scope.user.password) {
      $scope.errorMsg = "Please enter username and password!";
      return;
    }

    $http
      .post("http://localhost/evote-app/api/login.php", $scope.user)
      .then(function (response) {
        if (response.data.success) {
          // ✅ Save logged-in voter username for later use
          localStorage.setItem("voter_username", $scope.user.username);

          // ✅ Redirect to vote page instead of index.html
          window.location.href = "vote.html";
        } else {
          $scope.errorMsg = response.data.message;
        }
      })
      .catch(function (error) {
        console.error(error);
        $scope.errorMsg = "Server error. Please try again.";
      });
  };
});


app.controller("RegisterCtrl", function ($scope, $http) {
  $scope.voter = {};
  $scope.successMsg = "";
  $scope.errorMsg = "";

  $scope.register = function () {
    if (
      !$scope.voter.name ||
      !$scope.voter.email ||
      !$scope.voter.username ||
      !$scope.voter.password
    ) {
      $scope.errorMsg = "⚠️ Please fill all required fields!";
      $scope.successMsg = "";
      return;
    }

    // ✅ Make sure the path matches your actual folder
    $http.post("http://localhost/evote-app/api/register.php", $scope.voter)
      .then(function (response) {
        if (response.data.success) {
          $scope.successMsg = response.data.message;
          $scope.errorMsg = "";

          // Clear form
          $scope.voter = {};

          // Redirect to login after 2 seconds
          setTimeout(function () {
            window.location.href = "login.html";
          }, 2000);
        } else {
          $scope.errorMsg = response.data.message;
          $scope.successMsg = "";
        }
      })
      .catch(function (error) {
        console.error(error);
        $scope.errorMsg = "Server error. Please try again later.";
      });
  };
});

app.controller("HeaderCtrl", function ($scope) {
  $scope.logout = function () {
    localStorage.removeItem("username");
    window.location.href = "login.html";
  };
});

app.controller("VoteCtrl", function($scope, $http) {
  $scope.candidates = [];
  $scope.selectedCandidate = null;
  $scope.message = "";

  // load all candidates
  $http.get("http://localhost/evote-app/api/get_candidates.php")
  .then(function(response) {
    $scope.candidates = response.data;
  });

  // submit vote
  $scope.submitVote = function() {
    let voter_username = localStorage.getItem("voter_username");
    if (!voter_username) {
      alert("Please login first!");
      window.location.href = "login.html";
      return;
    }

    if (!$scope.selectedCandidate) {
      alert("Please select a candidate!");
      return;
    }

    let data = {
      voter_username: voter_username,
      candidate_id: $scope.selectedCandidate
    };

    $http.post("http://localhost/evote-app/api/submit_vote.php", data)
    .then(function(response) {
      $scope.message = response.data.message;
      if (response.data.success) {
        alert("Vote submitted successfully!");
      } else {
        alert(response.data.message);
      }
    });
  };
});

app.controller("ResultsCtrl", function ($scope, $http) {
  $scope.candidates = [];

  $http.get("http://localhost/evote-app/api/view_results.php")
  .then(function (response) {
    $scope.candidates = response.data;
  });
});

