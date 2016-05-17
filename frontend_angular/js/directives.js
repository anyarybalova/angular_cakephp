
function pageTitle($rootScope, $timeout) {
    return {
        link: function(scope, element) {
            var listener = function(event, toState, toParams, fromState, fromParams) {
                // Default title - load on Dashboard 1
                var title = 'LEXSTART | Responsive Admin Theme';
                // Create your own title pattern
                if (toState.data && toState.data.pageTitle) title = 'LEXSTART | ' + toState.data.pageTitle;
                $timeout(function() {
                    element.text(title);
                });
            };
            $rootScope.$on('$stateChangeStart', listener);
        }
    }
};

function changed() {
  return {
        templateUrl: 'views/templates/contract_list.html',
        link: function (scope, el, attrs) {
            el.bind('change', function (event) { 
            });
        }
    }
};



function removeElement() {
      return {
            transclude : true,
            link: function(scope,element,attrs)
            {
                    element.bind("click",function() {
                        element.remove();
                    });
            }
      }

};


angular
    .module('lexstart')
    .directive('pageTitle', pageTitle)
    .directive('changed', changed)
    .directive('removeElement' , removeElement)