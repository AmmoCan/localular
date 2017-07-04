angular
  .module('localular')
  .component('project', {
    template: `
      <section class="tool-bar grid-block small-up-1 medium-up-3">
      
        <span class="fa fa-search" aria-hidden="true"></span>
    		<input type="text" id="search" class="form-control" placeholder="Search project" ng-model="$ctrl.search">
    	
      	<div class="total">
        	<span>Found {{($ctrl.projects | filter:$ctrl.search).length}} of {{$ctrl.projects.length}} Projects</span>
      	</div>
    	
        <div class="date-filter">
      		<a href="" title="Filter by date" ng-class="(byDate) ? 'active' : '' " ng-click="reverse=!reverse;$ctrl.order('date_format', reverse);byName=false;byDate=true;">Date</a>
      	</div>
      	
      	<div class="name-filter">
          <a href="" title="Filter by name" ng-class="(byName) ? 'active' : '' " ng-click="reverse=false;$ctrl.order('file', false);byName=true;byDate=false;">Name</a>
      	</div>
    
      </section>
      
      <div class="line">
        <hr/>
      </div>
    	
      <section class="project-list grid-block small-up-1 medium-up-3">
        <div class="project-wrap grid-content" ng-repeat="project in (filteredItems = ($ctrl.projects | filter: $ctrl.search))" ng-class="($index == 0) ? 'active' : '' ; ">
          
          <div class="card">
            <span class="fa-stack fa-3x">
              <i class="fa fa-circle fa-stack-2x" aria-hidden="true"></i>
              <i class="{{project.icon}} fa-stack-1x fa-inverse" aria-hidden="true"></i>
            </span>
            <!-- <i class="{{project.icon}}" aria-hidden="true"></i> -->
            <div class="card-divider">
              <a href="//{{project.server}}{{project.file}}/" title="{{project.file}}">{{project.file}}</a>
            </div>
            <div class="card-section">
              <span>Last modified:</span>
              <time>{{project.date}}</time>
            </div>
          </div>
          
        </div>
      </section>
      `,
    bindings: {
      project: '='
    },
    controller:
      function ($scope, $filter, $timeout) {
        var orderBy = $filter('orderBy');
        this.projects = list;
        this.order = function (predicate, reverse) {
          this.projects = orderBy(this.projects, predicate, reverse);
        };
        this.order('-date_format', false);
        // Search and active state interactivity.
        $timeout(function () {
          angular.element('body').fadeIn(300, function () {
            angular.element('#search').focus();
          });
          angular.element(document).keydown(function (e) {
            // If key pressed is Esc.
            if (e.keyCode === 27) {
              this.search = '';
              angular.element('.project-list .project-wrap.active').removeClass('active');
              angular.element('.project-list .project-wrap:first-child').removeClass('active');
              // Else if key pressed is Enter.
            } else if (e.keyCode === 13) {
              if (this.filteredItems.length = 0) {
                return false;
              }
              if (angular.element('section .project-wrap.active .card-divider a')) {
                window.location = angular.element('section .project-wrap.active .card-divider a').attr('href');
              } else {
                window.location = angular.element('section .project-wrap:visible .card-divider a').eq(0).attr('href');
              }
            }
            
            // If greater than or equal to 0 and less than or equal to Z.
            if (e.keyCode >= 48 && e.keyCode <= 90) {
              console.log(e);
              if (!angular.element('#search').is(':focus')) {
                angular.element('#search').focus();
              }
            }
        
            // If arrow right.
            if (e.keyCode === 39) {
              if (!angular.element('.project-list .project-wrap.active').is(':last-child')) {
                console.log('this');
                angular.element('.project-list .project-wrap.active').removeClass('active').next().addClass('active');
              }
            }
            
            // If arrow left.
            if (e.keyCode === 37) {
              if (!angular.element('.project-list .project-wrap.active').is(':first-child')) {
                angular.element('.project-list .project-wrap.active').removeClass('active').prev().addClass('active');
              }
            }
        
            // If arrow up.
            if (e.keyCode === 38) {
              $index = angular.element('.project-list .project-wrap.active').index() - 3;
              if ($index >= 0) {
                angular.element('.project-list .project-wrap').removeClass('active').eq($index).addClass('active');
              }
            }
        
            // If arrow down.
            if (e.keyCode === 40) {
              $index = angular.element('.project-list .project-wrap.active').index() + 3;
              if ($index < this.filteredItems.length) {
                angular.element('.project-list .project-wrap').removeClass('active').eq($index).addClass('active');
              }
            }
          });
        });
      }
  });