@extends('adminlte::page')

@section('title', 'ApointMe')

<style>

body{
      margin-top: 100px;
      font-family: 'Trebuchet MS', serif;
      line-height: 1.6
   }
   .container{
      width: 800px;
      margin: 0 auto;
   }

   ul.tabs{
      margin: 0px;
      padding: 0px;
      list-style: none;
   }
   ul.tabs li{
      background: none;
      color: #222;
      display: inline-block;
      padding: 10px 15px;
      cursor: pointer;  
   }

   ul.tabs li.current{
      background: #ededed;
         border-bottom: 1px solid
      color: #222;
   }

   .tab-content{
      display: none;
      /* background: #ededed; */
      padding: 15px;
   }

   .tab-content.current{
      display: inherit; 
   }


   .modal-dialog-full-width {
      width: 100% !important;
      height: 100% !important;
      /* margin: 0 !important; */
      padding: 0 !important;
      max-width:none !important;
      margin-left: 7px;
    }

    .modal-content-full-width  {
      height: auto !important;
      min-height: 100% !important;
      border-radius: 0 !important;
      background-color: #ececec !important 
    }

    .modal-header-full-width  {
        border-bottom: 1px solid #9ea2a2 !important;
    }

    .modal-footer-full-width  {
        border-top: 1px solid #9ea2a2 !important;
    }
</style>

@section('content_header')
<div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title m-0 text-dark">Sensei's</h1>
            </div>
        </div>
    </div>
</div>
    <!-- <h1 class="m-0 text-dark">Senseis</h1> -->
   @if(Session::has('message'))
      <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      {{Session::get('message')}}
      </div>
   @endif

@stop

@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <!-- <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
            </div> -->
         <!-- /.card-header -->
         <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Profile</th>
                     <th>Sensei Name</th>
                     <th>Email</th>
                     <th>Bio</th>
                     <th>Department</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody class="sensei_list">
            </table>
         </div>
         <!-- /.card-body -->
      </div>
   </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background: #003e80;color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Update Bio</h5>
         </div>
         <div class="modal-body">
            <ul class="tabs">
               <li class="tab-link current" data-tab="tab-1">General</li>
               <li class="tab-link" data-tab="tab-2">Calender</li>
            </ul>
            <div id="tab-1" class="tab-content current">
               <form role="form" id="quickForm">
                  <div class="card-body">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" >
                     </div>
                     <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea class="form-control" rows='5' name="desc" id="desc"></textarea>
                     </div>
                  </div>
               </form>
               <div style="float: right;">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Submit</button>
               </div>
            </div>
            <div id="tab-2" class="tab-content">
               <div class="form-horizontal" style="margin-top:39px">
                  <div class="form-group" ng-class="{'has-error':form.authorization.$invalid&amp;&amp;form.authorization.$touched}">
                     <div class="col-md-4">
                        <label class="control-label">Calendar Account</label>
                        <p class="help-block">Each
                           <var bookable-type="" class="ng-binding">mentor</var> has a Google or Office 365 account where bookings are added, and availability is checked.
                        </p>
                     </div>
                     <div class="col-md-8">
                        <!-- ngIf: !authorizations.length -->
                        <!-- ngIf: authorizations.length -->
                        <authorization-picker ng-if="authorizations.length" ng-model="bookable.authorization" options="authorizations" class="ng-pristine ng-untouched ng-valid ng-scope ng-isolate-scope ng-not-empty ">
                           <div class="ui-select-container selectize-control single" ng-class="{'open': $select.open}" notranslate="">
                              <div class="selectize-input" ng-class="{'focus': $select.open, 'disabled': $select.disabled, 'selectize-focus' : $select.focus}" ng-click="$select.open &amp;&amp; !$select.searchEnabled ? $select.toggle($event) : $select.activate()">
                                 <div ng-hide="($select.open || $select.isEmpty())" class="ui-select-match" ng-transclude="" placeholder="Choose a calendar account">
                                    <!-- ngIf: $select.selected -->
                                    <div class="authorization-picker-unit ng-scope" ng-if="$select.selected">
                                       <img static-src="img/backends/google-icon.png" src="https://www.appointletcdn.com/04eb57c0ed5be8b45f0d8d4afdd7eb4a7827d890/admin/img/backends/google-icon.png">
                                       <span class="ng-binding">
                                          Sean Naughton <!-- ngIf: $select.selected.description -->
                                          <small class="text-muted ng-binding ng-scope" ng-if="$select.selected.description"> - seannaughton921@gmail.com</small><!-- end ngIf: $select.selected.description -->
                                       </span>
                                    </div>
                                    <!-- end ngIf: $select.selected -->
                                 </div>
                                 <select  autocomplete="off" tabindex="-1" class="form-control ui-select-search ui-select-toggle senesei_list " placeholder="Choose a calendar account" aria-label="Select box"></select>
                              </div>
                              <!-- <div ng-show="$select.open" class="ui-select-choices ui-select-dropdown selectize-dropdown single ng-scope ng-hide" repeat="authorization in authorizations | filter:{$:$select.search}">
                                 <div class="ui-select-choices-content selectize-dropdown-content">
                                    <div class="ui-select-choices-group optgroup" role="listbox">
                                       <div ng-show="$select.isGrouped" class="ui-select-choices-group-label optgroup-header ng-binding ng-hide" ng-bind="$group.name"></div>
                                      
                                    </div>
                                 </div>
                                 </div> -->
                              <ui-select-single></ui-select-single>
                              <!-- <input ng-disabled="$select.disabled" class=" form-control ui-select-focusser ui-select-offscreen " type="text" id="focusser-11" aria-label="Select box focus" aria-haspopup="true" role="button"> -->
                           </div>
                        </authorization-picker>
                        <!-- end ngIf: authorizations.length -->
                        <!-- ngIf: authorizations.length -->
                        <div ng-if="authorizations.length" style="margin-top: 10px;" class="ng-scope">
                        <!-- @if(Auth::user()->is_sync)
                           <div class="alert alert-warning alert-dismissible" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                           {{Session::get('message')}}
                           </div>
                        @endif -->



                           <button type="button" class="btn btn-sm btn-success" id="createAuth">Connect Another</button>
                           <button type="button" class="btn btn-sm btn-success" id="getCalenderEvents" style="float: right;">Get Calender</button>
                        </div>
                        <!-- end ngIf: authorizations.length -->
                     </div>
                  </div>
                  <!-- ngIf: bookable.authorization -->
                  <div ng-if="bookable.authorization" class="ng-scope">
                     <div class="form-group">
                        <div class="col-md-4">
                           <label class="control-label">Bookings Calendar</label>
                           <p class="help-block">This is the calendar where your new bookings will be placed.</p>
                        </div>
                        <div class="col-md-8">
                           <calendar-picker ng-model="bookable.calendar" choices="calendars" class="ng-pristine ng-untouched ng-valid ng-isolate-scope ng-not-empty">
                              <div class="ui-select-container selectize-control single" ng-class="{'open': $select.open}">
                                 <div class="selectize-input" ng-class="{'focus': $select.open, 'disabled': $select.disabled, 'selectize-focus' : $select.focus}" ng-click="$select.open &amp;&amp; !$select.searchEnabled ? $select.toggle($event) : $select.activate()">
                                    <div ng-hide="($select.open || $select.isEmpty())" class="ui-select-match" ng-transclude="" placeholder="Choose a Calendar">
                                       <div class="calendar-picker-unit ng-scope">
                                          <div class="calendar-picker-color" ng-style="{'background-color':$select.selected.color}" style="background-color: rgb(159, 225, 231);"></div>
                                          <span notranslate="" class="ng-binding">seannaughton921@gmail.com</span>
                                       </div>
                                    </div>
                                    <input type="text" autocomplete="off" tabindex="-1" class="ui-select-search ui-select-toggle form-control" ng-click="$select.toggle($event)" placeholder="Choose a Calendar" ng-model="$select.search" ng-hide="!$select.searchEnabled || ($select.selected &amp;&amp; !$select.open)" ng-disabled="$select.disabled" aria-label="Select box">
                                 </div>
                                 <!--   <div ng-show="$select.open" class="ui-select-choices ui-select-dropdown selectize-dropdown single ng-scope ng-hide" repeat="cal in calendars | filter:{name:$select.search}" ui-disable-choice="cal.role==='reader'||cal.role==='freeBusyReader'">
                                    <div class="ui-select-choices-content selectize-dropdown-content">
                                       <div class="ui-select-choices-group optgroup" role="listbox">
                                          <div ng-show="$select.isGrouped" class="ui-select-choices-group-label optgroup-header "></div>
                                        
                                       </div>
                                    </div>
                                    </div> -->
                                 <ui-select-single></ui-select-single>
                                 <!--  <input ng-disabled="$select.disabled" class="ui-select-focusser ui-select-offscreen form-control" type="text" id="focusser-12" aria-label="Select box focus" aria-haspopup="true" role="button"> -->
                              </div>
                           </calendar-picker>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="col-md-4">
                           <label class="control-label">Availability Calendars</label>
                           <p class="help-block">These are the calendars that will be checked for conflicts so that you aren't double-booked.</p>
                        </div>
                        <div class="col-md-8">
                           <!-- ngIf: ::!organization.features.calendar_sync -->
                           <div class="radio ng-scope" ng-if="::!organization.features.calendar_sync">
                              <input type="radio" name="busy_calendars" ng-model="bookable.busy_calendars" ng-value="null" id="bookable-busy_calendars-all" class="ng-pristine ng-untouched ng-valid ng-not-empty">
                              <label for="bookable-busy_calendars-all">
                              <strong>All Calendars</strong>
                              <span>-</span>
                              <span>Check all calendars for conflicts</span>
                              </label>
                           </div>
                           <!-- end ngIf: ::!organization.features.calendar_sync -->
                           <!-- ngIf: ::!organization.features.calendar_sync -->
                           <div class="radio ng-scope" ng-if="::!organization.features.calendar_sync">
                              <input type="radio" name="busy_calendars" ng-checked="bookable.busy_calendars" id="bookable-busy_calendars-some" checked="checked">
                              <label for="bookable-busy_calendars-some">
                              <strong>Specific Calendars</strong>
                              <span>-</span>
                              <span>Check only the following calendars for conflicts:</span>
                              </label>
                           </div>
                           <!-- end ngIf: ::!organization.features.calendar_sync -->
                           <ul class="collection-list">
                              <!-- ngRepeat: cal in calendars --><!-- ngIf: !calendarsLoading -->
                              <li ng-repeat="cal in calendars" ng-if="!calendarsLoading" class="ng-scope">
                                 <input type="checkbox" checklist-value="cal.id" name="busy_calendars" id="bookable-busy_calendars-spiderhound@producerdojo.com" ng-model="checked" class="ng-scope ng-pristine ng-untouched ng-valid ng-empty">
                                 <label for="bookable-busy_calendars-spiderhound@producerdojo.com" notranslate="" class="ng-binding">spiderhound@producerdojo.com</label>
                              </li>
                              <!-- end ngIf: !calendarsLoading --><!-- end ngRepeat: cal in calendars --><!-- ngIf: !calendarsLoading -->
                              <li ng-repeat="cal in calendars" ng-if="!calendarsLoading" class="ng-scope">
                                 <input type="checkbox" checklist-value="cal.id" name="busy_calendars" id="bookable-busy_calendars-seannaughton921@gmail.com" ng-model="checked" class="ng-scope ng-pristine ng-untouched ng-valid ng-not-empty">
                                 <label for="bookable-busy_calendars-seannaughton921@gmail.com" notranslate="" class="ng-binding">seannaughton921@gmail.com</label>
                              </li>
                              <!-- end ngIf: !calendarsLoading --><!-- end ngRepeat: cal in calendars --><!-- ngIf: !calendarsLoading -->
                              <li ng-repeat="cal in calendars" ng-if="!calendarsLoading" class="ng-scope">
                                 <input type="checkbox" checklist-value="cal.id" name="busy_calendars" id="bookable-busy_calendars-addressbook#contacts@group.v.calendar.google.com" ng-model="checked" class="ng-scope ng-pristine ng-untouched ng-valid ng-empty">
                                 <label for="bookable-busy_calendars-addressbook#contacts@group.v.calendar.google.com" notranslate="" class="ng-binding">Contacts</label>
                              </li>
                              <!-- end ngIf: !calendarsLoading --><!-- end ngRepeat: cal in calendars --><!-- ngIf: !calendarsLoading -->
                              <li ng-repeat="cal in calendars" ng-if="!calendarsLoading" class="ng-scope">
                                 <input type="checkbox" checklist-value="cal.id" name="busy_calendars" id="bookable-busy_calendars-en.usa#holiday@group.v.calendar.google.com" ng-model="checked" class="ng-scope ng-pristine ng-untouched ng-valid ng-empty">
                                 <label for="bookable-busy_calendars-en.usa#holiday@group.v.calendar.google.com" notranslate="" class="ng-binding">Holidays in United States</label>
                              </li>
                              <!-- end ngIf: !calendarsLoading --><!-- end ngRepeat: cal in calendars -->
                           </ul>
                        </div>
                     </div>
                  </div>
                  <!-- end ngIf: bookable.authorization -->
               </div>
            </div>
         </div>
         <div class="modal-footer">
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="remove_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header" style="    background-color: #003e80;color: whitesmoke;">
            <h5 class="modal-title" id="exampleModalLongTitle">Delete Sensei :</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <span>Are you sure want to delete this sensei ?</span>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Delete</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="google_connect_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="modal-title">Connect Calendar Account</h3><br />
           
         </div>
         <p class="text-muted" style="text-align: center;">We only request access to your calendar and email address</p>
         <div class="modal-body">
            <button class="btn btn-primary btn-block btn-xl ladda-button google_connect"  ladda="saving[backends[0].slug]" data-style="zoom-in"><span class="ladda-label">Connect Google Calendar</span><span class="ladda-spinner"></span></button>
            <!-- <button class="btn btn-danger btn-block btn-xl ladda-button" ladda="saving[backends[1].slug]" data-style="zoom-in"><span class="ladda-label">Connect Office 365</span><span class="ladda-spinner"></span></button> -->

         </div>
         <div class="modal-footer">
            <div id="office365-error" uib-collapse="!error.outlook" class="collapse" style="height: 0px;">
               <a href="http://www.appointlet.help/calendar-and-availability/troubleshooting/troubleshooting-office-365" target="_blank"><span class="label label-danger">Hey!</span> Having trouble connecting Office 365?</a>
            </div>
         </div>
      </div>
   </div>
</div>



@stop

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script>
$(document).ready(function() {
    getList('list');

    function getList(url) {
        $.ajax({
            url:url,
            dataType:'json',
            success:function(res) {
                console.log(res)
               var trHtml='';
               var list = '';

               $.each(res, function (i, item) {
                trHtml +='<tr><td>'+(item.pic_url ?' <img src='+(item.pic_url) + ' class="img-circle" style="width:50px"/>' : '')+'</td><td>'+ 
                ((item.first_name || item.last_name)  ?  (item.first_name + '' + item.last_name) : '' ) +'</td><td>'+item.email+'</td><td>'+(item.bio ? item.bio : '---')+'</td><td>'+
                    (item.dept ? item.dept : '---')+'</td><td>'+(item.status=='active' ? '<span class="label info">active</span>' : '<span class="label danger">in-active</span>')+
                    '</td><td>'+'<span>'+
                        '  <a href="sensei/details/'+item.id+'"><span class="fa fa-edit "></span></a>' + 
                        '  <a><span class="fa fa-window-close remove_list"></span></a>'
                    +'</span>'+'</td></tr>'
               })

               $.each(res, function (i, item) {
                  list +='<option> '+
                    ((item.first_name || item.last_name)  ?  (item.first_name + '' + item.last_name + 
                    ' <small class="text-muted ng-binding ng-scope" ng-if="$select.selected.description"> - '+item.email+'</small>') : '' ) +'</option>'
               });


               $('.sensei_list').html(trHtml)
               $('.senesei_list').append(list);

                $("#example1").DataTable({
                  "responsive": true,
                  "autoWidth": true,
                });

               
            }
        })
    }


    // Connect with google login
    $('body').on('click', '.google_connect', function () {
       var url = '/google-calendar/connect';
      //  window.open(url, '_blank');
       window.location.href = url;
    })

    // Open google login modal
    $('body').on('click', '#createAuth', function () {
       var url = '/google-calendar/connect';

      $('#exampleModal').modal('hide')
      $('#google_connect_modal').modal('show')

    })

    $('body').on('click', '#getCalenderEvents', function() {
         $.ajax({
            url:'/get-resource',
            dataType:'json',
            success:function(res) {
                console.log('response = ')
               console.log('response = ', res)
            }
         })
    })

    $('body').on('click', '.past_meeting', function() {
        alert('working')
    })

    $('body').on('click', '.edit_list', function() {
        $('#exampleModal').modal('show')
    })

    $('body').on('click', '.remove_list', function() {
        $('#remove_modal').modal('show')
        
    })
})

$(document).ready(function(){



   
    	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})
</script>



